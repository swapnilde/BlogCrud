<?php
	session_start();

	session_destroy();

	header("Location: /BlogApp/login.php");
