<?php
include 'bloqsession.php';
	//Destruye las sessiones que se almacenan en las variables al ingresar al sistema

	$_SESSION["ok"]="";
	$_SESSION["user_session"]="";
	$_SESSION["pass_session"]="";
	//Destruye la session
	session_unset();
	session_destroy();
	header("location:../");
	exit();


  ?>