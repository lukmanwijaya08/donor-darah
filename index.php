
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pendonor Darah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Pendaftaran Pendonor Darah</h2>

    
    <form action="save_donor.php" method="POST">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>

        <label for="address">Alamat:</label>
        <input type="text" id="address" name="address" required>

        <label for="birthdate">Tempat, Tanggal Lahir:</label>
        <input type="text" id="birthdate" name="birthdate" placeholder="Contoh: Jakarta, 12-12-1990" required>

        <label for="blood_group">Golongan Darah:</label>
        <input type="text" id="blood_group" name="blood_group" required>

        <label for="phone">Nomor HP:</label>
        <input type="text" id="phone" name="phone" required>

        <button type="submit">Daftar Pendonor</button>
    </form>

    <h3>Cari Pendonor Berdasarkan Golongan Darah</h3>
    <input type="text" id="bloodSearch" placeholder="Cari golongan darah" onkeyup="searchBloodGroup()">
    
    <h3>Daftar Pendonor</h3>
    <table id="donorTable">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Golongan Darah</th>
                <th>Nomor HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include 'db.php';
                $query = $pdo->query("SELECT * FROM donors");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr id='row{$row['id']}'>
                        <td>{$row['name']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['birthdate']}</td>
                        <td>{$row['blood_group']}</td>
                        <td>{$row['phone']}</td>
                        <td>
                            <a href='edit_donor.php?id={$row['id']}'>Edit</a> | 
                            <a href='delete_donor.php?id={$row['id']}'>Delete</a>
                        </td>
                    </tr>";
                }
            ?>
        </tbody>
    </table>

    <script>
        function searchBloodGroup() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("bloodSearch");
            filter = input.value.toUpperCase();
            table = document.getElementById("donorTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>
