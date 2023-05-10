<?php

namespace App;

use PDO;

class Pets
{
	protected $id;
	protected $pet_name;
	protected $pet_gender;
	protected $pet_birthdate;
	protected $pet_owner;
	protected $email;
	protected $address;
	protected $contact_number;
	protected $created_at;

	public function getId()
	{
		return $this->id;
	}

	public function getPetName()
	{
		return $this->pet_name;
	}

	public function getPetGender()
	{
		return $this->pet_gender;
	}

	public function getPetBirthdate()
	{
		return $this->pet_birthdate;
	}

	public function getPetOwner()
	{
		return $this->pet_owner;
	}

	public function getEmail()
	{
		return $this->email;
	}
	public function getAddress()
	{
		return $this->address;
	}
	public function getContactNumber()
	{
		return $this->contact_number;
	}

	public static function list()
	{
		global $conn;

		try {
			$sql = "SELECT * FROM pets";
			$statement = $conn->query($sql);
			
			$pets = [];
			while ($row = $statement->fetchObject('App\Pets')) {
				array_push($pets, $row);
			}

			return $pets;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function getById($id)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM pets
				WHERE id=:id
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'id' => $id
			]);
			$result = $statement->fetchObject('App\Pets');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function register($pet_name, $pet_gender, $pet_birthdate, $pet_owner, $email, $address, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				INSERT INTO pets (pet_name, pet_gender, pet_birthdate, pet_owner, email, address, contact_number)
				VALUES ('$pet_name', '$pet_gender', '$pet_birthdate', '$pet_owner', '$email', '$address', '$contact_number')
			";
			$conn->exec($sql);

			return $conn->lastInsertId();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function registerMany($users)
    {
        global $conn;

        try {
            foreach ($users as $user) {
                $sql = "
                    INSERT INTO pets
                    SET
                        pet_name=\"{$user['pet_name']}\",
                        pet_gender=\"{$user['pet_gender']}\",
                        pet_birthdate=\"{$user['pet_birthdate']}\",
                        pet_owner=\"{$user['pet_owner']}\",
                        email=\"{$user['email']}\",
						address=\"{$user['address']}\",
                        contact_number=\"{$user['contact_number']}\"
                ";
                $conn->exec($sql);
            }
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return false;
    }

	public static function update($id,$pet_name, $pet_gender, $pet_birthdate, $pet_owner, $email, $address, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				UPDATE pets
				SET
					pet_name=?,
					pet_gender=?,
					pet_birthdate=?,
					pet_owner=?,
					email=?,
					address=?,
					contact_number=?
				WHERE id=?
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				$pet_name, 
				$pet_gender, 
				$pet_birthdate, 
				$pet_owner, 
				$email,
				$address, 
				$contact_number,
				$id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function updateUsingPlaceholder($id, $pet_name, $pet_gender, $pet_birthdate, $owner_name, $email,  $address, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				UPDATE pets
				SET
					pet_name=:pet_name,
					pet_gender=:pet_gender,
					pet_birthdate=:pet_birthdate,
					pet_owner=:pet_owner,
					email=:email,
					address=:address,
					contact_number=:contact_number
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'pet_name' => $pet_name,
				'pet_gender' => $pet_gender,
				'pet_birthdate' => $pet_birthdate,
				'pet_owner' => $pet_owner,
				'email' => $email,
				'address' => $address,
				'contact_number' => $contact_number,
				'id' => $id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function deleteById($id)
	{
		global $conn;

		try {
			$sql = "
				DELETE FROM pets
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'id' => $id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function clearTable()
	{
		global $conn;

		try {
			$sql = "TRUNCATE TABLE pets";
			$statement = $conn->prepare($sql);
			return $statement->execute();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}
}