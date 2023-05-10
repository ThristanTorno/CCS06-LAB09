<?php

require "config.php";

use App\Pets;

// Save the Student information, and automatically redirect to index

try {
	$id = $_POST['id'];
	$pet_name = $_POST['pet_name'];
	$pet_gender = $_POST['pet_gender'];
	$pet_birthdate = $_POST['pet_birthdate'];
	$pet_owner = $_POST['pet_owner'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$contact_number = $_POST['contact_number'];
	$result = Pets::update($id, $pet_name, $pet_gender, $pet_birthdate, $pet_owner, $email, $address, $contact_number);

	if ($result) {
		header('Location: index.php');
	}

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}