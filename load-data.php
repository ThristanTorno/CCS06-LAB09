<?php

require "config.php";

use App\Pets;


try {
	Pets::register('Maxy', 'Female', '2003-12-25', ' Thristan Torno', 'torno.thristan@auf.edu.ph', 'Porac Pampanga', '09661653247');
	echo "<li>Added 1 pet";

	$pets = [
		[
			'pet_name' => 'Matty',
			'pet_gender' => 'Male',
			'pet_birthdate' => '2019-06-08',
			'pet_owner' => 'Tentoy Torno',
			'email' => 'torno.thristan@auf.edu.ph',
			'address' => 'Manibaug Pasig Porac Pampanga',
			'contact_number' => '09096771149',
			
		],
		[
			'pet_name' => 'Coco',
			'pet_gender' => 'Male',
			'pet_birthdate' => '2019-11-01',
			'pet_owner' => 'tantoy Torno',
			'email' => 'torno.thristan@auf.edu.ph',
			'address' => 'Manibaug Pasig Porac Pampanga',
			'contact_number' => '090906771153',
		]
	];
	Pets::registerMany($pets);
	echo "<li>Added " . count($pets) . " more pets";
	echo "<br /><a href='index.php'>Proceed to Index Page</a>";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}