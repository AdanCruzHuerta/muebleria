<?php

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('ProveedorTableSeeder');
	}

}

/*class ProveedorTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		for($i = 0; $i < 20; $i++)
		{
			Proveedor::create([
				'nombre'		=>	$faker->company,
				'domicilio'		=>	$faker->streetAddress,
				'responsable'	=>	$faker->name($gender = null|'male'|'female'),
				'municipios_id'	=>	37,
				'ciudad'		=>	"Colima",
				'telefono'		=>	$faker->phoneNumber,
				'email'			=>	$faker->email
			]);
		}
	}
}*/

/*class FleteraTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		for($i = 0; $i < 20; $i++)
		{
			Fletera::create([
				'nombre' 		=>	$faker->company,
				'municipios_id'	=>	37,
				'ciudad'		=>	"Colima",
				'domicilio'		=>	$faker->streetAddress,
				'responsable'	=>	$faker->name($gender = null|'male'|'female'),
				'telefono'		=>	$faker->phoneNumber,
				'email'			=>	$faker->email
			]);
		}
	}
}*/
