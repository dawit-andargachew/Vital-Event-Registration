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

$m_ssn=$_POST['delete'] ?? null;
if(!$m_ssn){
    header("Location: _marriage.php");
    exit;
}

$statement = $pdo->prepare('DELETE FROM marriage_table WHERE m_ssn = :m_ssn');
$statement->bindValue(':m_ssn', $m_ssn);
$statement->execute();
header('Location: _marriage.php');

?>