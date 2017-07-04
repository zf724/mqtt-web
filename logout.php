<?php
session_start();
include 'functions.php';

if (isset($_SESSION['user']))
{
	destroySession();
}

redirect('login.php');

?>