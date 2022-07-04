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

$b_ssn=$_POST['delete'] ?? null;
if(!$b_ssn){
    header("Location: _birth.php");
    exit;
}

$statement = $pdo->prepare('DELETE FROM birth_table WHERE b_ssn = :b_ssn');
$statement->bindValue(':b_ssn', $b_ssn);
$statement->execute();

header('Location: _birth.php');

?>