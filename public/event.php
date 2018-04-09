<?php

require "functions.php";

if(isset($_GET['id'])){
	list($id, $name, $surname, $passwordd) = get_event(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
	$id=filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
	$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
	$surname = trim(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING));
	$passwordd = trim(filter_input(INPUT_POST, 'passwordd', FILTER_SANITIZE_STRING));

	if(empty($name) ||empty($surname) || empty($passwordd)){
		$error_message= "Please fill in the required fields";
	} else {

		if(add_event($name, $surname, $passwordd, $id)){
			header('Location: index.php');
			exit;
		} else {
			$error_message = "Could not add account";
		}
	}
}

?>

<?php require "templates/header.php"; ?>

<?php 
	if(isset($error_message)){
		echo $error_message;
	}
?>

<h2>
	<?php
		if(!empty($id)){
			echo "Update";
		} else {
			echo "Create your acount";
		}
	?>
</h2>

<form method="post" action="event.php">

	<label for="name">name</label>
	<input type="text" name="name" id="name" value="">

	<label for="surname">surname</label>
	<input type="text" name="surname" id="surname" value="">

	<label for="passwordd">choose your password</label>
	<input type="password" name="passwordd" id="passwordd" value="">

	<?php
		if(!empty($id)){
			echo '<input type="hidden" name="id" value="'.$id.'">';
		}
	?>

	<input type="submit" name="submit" value="Envoyer">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>