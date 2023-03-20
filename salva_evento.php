<?php

$id = $_GET['id'];

session_start();
$_SESSION['evento_id'] = $id;
header('Location: frente.php');

exit;

?>