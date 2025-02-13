<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM donors WHERE id = ?");
    $stmt->execute([$id]);
    $donor = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $blood_group = $_POST['blood_group'];
    $phone = $_POST['phone'];

    $stmt = $pdo->prepare("UPDATE donors SET name = ?, address = ?, birthdate = ?, blood_group = ?, phone = ? WHERE id = ?");
    $stmt->execute([$name, $address, $birthdate, $blood_group, $phone, $id]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pendonor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Pendonor</h2>
    <form action="edit_donor.php?id=<?php echo $donor['id']; ?>" method="POST">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?php echo $donor['name']; ?>" required>

        <label for="address">Alamat:</label>
        <input type="text" id="address" name="address" value="<?php echo $donor['address']; ?>" required>

        <label for="birthdate">Tempat, Tanggal Lahir:</label>
        <input type="text" id="birthdate" name="birthdate" value="<?php echo $donor['birthdate']; ?>" required>

        <label for="blood_group">Golongan Darah:</label>
        <input type="text" id="blood_group" name="blood_group" value="<?php echo $donor['blood_group']; ?>" required>

        <label for="phone">Nomor HP:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $donor['phone']; ?>" required>

        <button type="submit">Update Pendonor</button>
    </form>
</body>
</html>
