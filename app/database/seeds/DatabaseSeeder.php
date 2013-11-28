<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('RoleTableSeeder');
		$this->command->info('Roles table seeded!');
		$this->call('YearsTableSeeder');
		$this->command->info('Years table seeded!');
		$this->call('RegisteredStatesTableSeeder');
		$this->command->info('Registered States table seeded!');
		$this->call('StudentsTableSeeder');
		$this->command->info('Students table seeded!');
		$this->call('StaffsTableSeeder');
		$this->command->info('Staffs table seeded!');
		$this->call('NexusClassTypesTableSeeder');
		$this->command->info('Nexus Class Types table seeded!');
		$this->call('NexusClassesTableSeeder');
		$this->command->info('Nexus Class table seeded!');
		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');
		$this->call('IosAppTableSeeder');
		$this->command->info('App table seeded!');
		$this->call('CertificateTypeTableSeeder');
		$this->command->info('Certificate Type table seeded!');
		$this->call('CertificateTableSeeder');
		$this->command->info('Certificate table seeded!');
		$this->call('ServerTableSeeder');
		$this->command->info('Server table seeded!');
		$this->call('CertificateServerTableSeeder');
		$this->command->info('Certificate Server table seeded!');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        $user2 = User::create(array('apple_id' => 'alex.scott@appleid.com'));
        $user2->roles()->attach(2);
        $staff = Staff::where('surname', '=', 'Scott')->first();
        $staff->user()->associate($user2);
        $staff->save();
        $user3 = User::create(array('apple_id' => 'pete.merrylees@appleid.com'));
        $user3->roles()->attach(3);
        $staff2 = Staff::where('surname', '=', 'Merrylees')->first();
        $staff2->user()->associate($user3);
        $staff2->save();
    }

}

class IosAppTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ios_apps')->delete();
        IosApp::create(array('ios_app_bundle_identifier' => 'com.nexanapps.Nexus-Hub'));
    }

}

class CertificateTableSeeder extends Seeder {

    public function run()
    {
        DB::table('certificates')->delete();
        Certificate::create(array('certificate_name' => 'Nexus-Hub Dev', 
        	'ios_app_id' => 1, 'key_cert_file' => 'nexus_hub_ck_dev.pem', 
        	'passphrase' => 'Monger87!', 'certificate_type_id' => 1));
    }

}

class CertificateTypeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('certificate_types')->delete();
        CertificateType::create(array('certificate_type_name' => 'Development Push SSL Certificate'));
        CertificateType::create(array('certificate_type_name' => 'Production Push SSL Certificate'));
        CertificateType::create(array('certificate_type_name' => 'Development Feedback SSL Certificate'));
        CertificateType::create(array('certificate_type_name' => 'Production Feedback SSL Certificate'));
    }

}

class CertificateServerTableSeeder extends Seeder {

    public function run()
    {
        DB::table('certificate_server')->delete();
        CertificateServer::create(array('server_id' => 1, 'certificate_id' => 1));
    }

}

class ServerTableSeeder extends Seeder {

    public function run()
    {
        DB::table('servers')->delete();
        Server::create(array('server_name' => 'Development - Push Notitification Server', 'server_url' => 'ssl://gateway.sandbox.push.apple.com:2195', 'server_type_id' => 1));
        Server::create(array('server_name' => 'Production - Push Notification Server', 'server_url' => 'ssl://gateway.push.apple.com:2195', 'server_type_id' => 1));
        Server::create(array('server_name' => 'Development - Feedback Server', 'server_url' => 'ssl://feedback.sandbox.push.apple.com:2196', 'server_type_id' => 2));
        Server::create(array('server_name' => 'Production - Feedback Server', 'server_url' => 'ssl://feedback.push.apple.com:2196', 'server_type_id' => 2));
    }

}

class RoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();
        Role::create(array('role_name' => 'Tutor'));
        Role::create(array('role_name' => 'Student'));
        Role::create(array('role_name' => 'Admin'));
    }

}

class NexusClassTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('nexus_class_types')->delete();
        NexusClassType::create(array('name' => 'Discovery Group'));
        NexusClassType::create(array('name' => 'Bible Overview'));
        NexusClassType::create(array('name' => 'Bible Themes'));
        NexusClassType::create(array('name' => 'Vocal Core Class'));
    }

}

class NexusClassesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('nexus_classes')->delete();
        $alexsFirstYearDiscoGroup = NexusClass::create(array('year_id' => 1, 'nexus_class_type_id' => 1, 'description' => 'Alex Scott first year disco group'));
        $alexsFirstYearDiscoGroup->students()->sync(array(1, 2, 3));
        $alexsFirstYearDiscoGroup->staffs()->attach(Staff::where('surname', '=', 'Scott')->first()->id);
        $alexsSecondYearVocalCoreClass = NexusClass::create(array('year_id' => 2, 'nexus_class_type_id' => 4, 'description' => 'Alex Scott second year vocal core class'));
        $alexsSecondYearVocalCoreClass->students()->sync(array(1, 2, 3));
        $alexsSecondYearVocalCoreClass->staffs()->sync(array(Staff::where('surname', '=', 'Donald')->first()->id, Staff::where('surname', '=', 'Scott')->first()->id));
        $alexsFirstYearVocalCoreClass = NexusClass::create(array('year_id' => 1, 'nexus_class_type_id' => 4, 'description' => 'Alex Scott first year vocal core class'));
        $alexsFirstYearVocalCoreClass->students()->sync(array(1, 2, 3));
        $alexsFirstYearVocalCoreClass->staffs()->attach(Staff::where('surname', '=', 'Scott')->first()->id);
    }

}

class StaffsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('staffs')->delete();
        Staff::create(array('forename' => 'Alex', 'surname' => 'Scott'));
        Staff::create(array('forename' => 'Peter', 'surname' => 'Merrylees'));
        Staff::create(array('forename' => 'Matt', 'surname' => 'Donald'));
    }

}

class StudentsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('students')->delete();
        Student::create(array('forename' => 'John', 'surname' => 'Jefferys'));
        Student::create(array('forename' => 'Phillippa', 'surname' => 'Peters'));
        Student::create(array('forename' => 'Tom', 'surname' => 'Thomason'));
    }

}

class RegisteredStatesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('registered_states')->delete();
        RegisteredState::create(array('registered_state_name' => 'Present'));
        RegisteredState::create(array('registered_state_name' => 'Late'));
        RegisteredState::create(array('registered_state_name' => 'Authorised Absence'));
        RegisteredState::create(array('registered_state_name' => 'Unauthorised Absence'));
    }

}

class YearsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('years')->delete();
        Year::create(array('year_number' => 1));
        Year::create(array('year_number' => 2));
        Year::create(array('year_number' => 3));
    }

}
