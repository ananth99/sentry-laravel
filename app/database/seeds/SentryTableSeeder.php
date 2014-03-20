<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SentryTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		DB::table('users')->delete();
		DB::table('groups')->delete();
		DB::table('users_groups')->delete();

		foreach(range(1, 10) as $index)
		{
			Sentry::getUserProvider()->create(array(
				'email'       => $faker->freeEmail,
            	'password'    => "admin",
            	'first_name'  => $faker->firstName,
            	'last_name'   => $faker->lastName,
            	'activated'   => 1,
            ));
		}

			Sentry::getGroupProvider()->create(array(
				'name'        => 'Admin',
            	'permissions' => array('admin' => 1),
			));
	}

}