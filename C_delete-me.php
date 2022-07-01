<?php
session_start();

$ssn = $_SESSION['ssn'];


$pdo = new PDO('mysql:host=localhost;port=3306;dbname=dawit', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if($ssn){
  $statement = $pdo->prepare('DELETE FROM person_table WHERE ssn = :ssn');
$statement->bindValue(':ssn', $ssn);
$statement->execute();

unset($_SESSION['ssn']);
unset($_SESSION['email']);
unset($_SESSION['pass']);
unset($_SESSION['name']);

header('Location: index.php');  
}



?>