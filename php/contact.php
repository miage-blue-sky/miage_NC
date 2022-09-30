<?php

	$errors = array();

	// Vérifie si le nom à bien était insérer
	if (!isset($_POST['name'])) {
		$errors['name'] = 'Entrer votre nom';
	}

	// Vérifie si le mail à bien était insérer et si il est valide
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Entrer votre adresse mail';
	}

	// Vérifie si le message à bien était insérer
	if (!isset($_POST['message'])) {
		$errors['message'] = 'Entrer votre message';
	}

	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}



	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$from = $email;
	//$to = 'contact-iae@unc.nc';
	$to = 'rsdim@hotmail.fr'; // mail pour test
	$subject = 'Site Miage NC : mail d\'information';

	$body = "From: $name\n E-Mail: $email\n Message:\n $message";

	$headers = "From: ".$from;


	// Envoie de l'email
	$result = '';
	if (mail($to, $subject, $body, $headers)) {
		$result .= '<div class="alert alert-success alert-dismissible" role="alert">';
 		$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= 'Merci de nous avoir contacter !';
		$result .= '</div>';

		echo $result;
		die();
	}

	$result = '';
	$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
	$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	$result .= 'Une erreur c\'est produite lors de l\'envoie. Réssayer plus tard';
	$result .= '</div>';

	echo $result;
