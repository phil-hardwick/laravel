<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessMessageQueue extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:ProcessMessageQueue';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Takes all the messages from the Message table in the Database and sends them to apple to push to devices.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->info("<br/>Started processing message queue");

		//get the certificates
		$certificate = Certificate::where('certificate_type_id', '=', 1)->first();
		
		//connect to apple push notification server with the app credentials
		$certificatePath = app_path() . '/apns/ApnsPHP/certificates' . '/' . $certificate->key_cert_file;
		$this->info($certificatePath);

		$server = $certificate->servers()->first();
		$apns = new Apns($server->server_url, $certificatePath, $certificate->passphrase);

		$timeStartedPlusAnHour = new DateTime();
		$timeStartedPlusAnHour->add(new DateInterval('PT20S'));
		$timeAtEndOfEachExecution = new DateTime();
		while($timeStartedPlusAnHour > $timeAtEndOfEachExecution) {

				//get N new messages from queue. We can get more messages on the next schedule
				$this->info("Getting messages for: [{$certificate->id}]");
				//var_dump($certificate);
				$messages = Message::where('certificate_id', '=', $certificate->id)->where('status', '=', 0)->take(1000)->get();
 				$this->info(count($messages));

				//if no messages for app continue with next
				if (count($messages) == 0) {
						sleep(5);
						$timeAtEndOfEachExecution = new DateTime();
						continue;
				}

				//send each message
				foreach ($messages as $message) {
						$device = Device::find($message->device_id);
						$this->info('device token: ' . $device->device_token);
						//send payload to device
						$apns->sendMessage($device->device_token, $message->message, $message->badge, $message->sound, $message->data);

						//mark as sent
						$message->status = 2;
						$message->save();
				}
				sleep(5);
				$timeAtEndOfEachExecution = new DateTime();
		}
		//execute the APNS destructor so the connection is closed.
		unset($apns);
		$this->info("Completed processing messages queue");
	}

}