<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $blood_group = $_POST['blood_group'];
    $phone = $_POST['phone'];

    $stmt = $pdo->prepare("INSERT INTO donors (name, address, birthdate, blood_group, phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $address, $birthdate, $blood_group, $phone]);

    header("Location: index.php");
}
?>
