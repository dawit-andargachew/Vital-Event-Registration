<?php

// $id = $_POST['id'] ?? null;
// if (!$id) {
//     header('Location: index.php');
//     exit;
// }

// echo "<pre>";
// echo var_dump($_POST);
// echo "<pre>";

// connect the datase
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=vital_registration_database', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$d_ssn=$_POST['delete'] ?? null;
if(!$d_ssn){
    header("Location: _death.php");
    exit;
}

$statement = $pdo->prepare('DELETE FROM death_table WHERE d_ssn = :d_ssn');
$statement->bindValue(':d_ssn', $d_ssn);
$statement->execute();

header('Location: _death.php');

?>