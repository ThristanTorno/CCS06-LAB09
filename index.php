<?php

require "config.php";

use App\Pets;

$pets = Pets::list();
?>

<h1>Pets</h1>

<table border="1" cellpadding="5">
	<?php foreach ($pets as $pet) : ?>
		<tr>
			<td><?php echo $pet->getId(); ?></td>
			<td><?php echo $pet->getPetName(); ?></td>
			<td><?php echo $pet->getPetGender(); ?></td>
			<td><?php echo $pet->getPetBirthdate(); ?></td>
			<td><?php echo $pet->getEmail(); ?></td>
			<td><?php echo $pet->getPetOwner(); ?></td>
			<td><?php echo $pet->getAddress(); ?></td>
			<td><?php echo $pet->getContactNumber(); ?></td>
			<td>
				<a href="edit-pets.php?id=<?php echo $pet->getId(); ?>">EDIT</a>
			</td>
			<td>
				<a href="delete-pets.php?id=<?php echo $pet->getId(); ?>">DELETE</a>
			</td>
		</tr>
	<?php endforeach ?>
</table>