<?php
    session_start();
    $buttonbayar = null;

    $dataSiswa = null;
    if(isset($_POST["btn"])){
        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $jumlah = $_POST["jumlah"];
        $dataAwal = false;


        if(isset($_SESSION["data_belanjaan"])) {
            foreach($_SESSION["data_belanjaan"] as $data) {
                if($data ["nama"] == $nama ){
                    $dataAwal = true;
                    break;
                }
            }
        }

        if($dataAwal) {
            echo'<div class="alert alert-danger" role="alert">
            Data Sudah ada
        </div>';
        }else {
            $_SESSION["data_belanjaan"][] = [
                "nama" => $nama,
                "harga" => $harga,
                "jumlah" => $jumlah
            ];
        }
    }


    if(isset($_SESSION["data_belanjaan"]) && !empty($_SESSION["data_belanjaan"])) {
        $buttonbayar = '<a href="bayar.php"><button type="submit">Beli</button></a>';
    }

    $totalBarang = null;
    $totalHarga = null;

    // Hitung total barang dan total harga
    if(isset($_SESSION["data_belanjaan"]) && is_array($_SESSION["data_belanjaan"])) {
        foreach ($_SESSION["data_belanjaan"] as $item) {
            $totalBarang += $item["jumlah"];
            $totalHarga += $item["harga"] * $item["jumlah"];
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Halaman utama</title>

    <style>

    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .alert {
        padding: 15px;
        background-color: #f44336;
        color: white;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }

    </style>

</head>

<body>
<div class="container">

    <form action="" method="post">
        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1; margin-right: 10px;">
                <label for="nama">Nama Siswa</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div style="flex: 1; margin-right: 10px;">
                <label for="harga">harga</label>
                <input type="number" name="harga" id="harga" required>
            </div>
            <div style="flex: 1;">
                <label for="jumlah">jumlah</label>
                <input type="text" name="jumlah" id="jumlah" required>
            </div>
        </div>
        <button type="submit" name="btn" id="btn">Input Data</button>
    </form>
    
    <?= $buttonbayar; ?>

    <table>
        <tr>
            <th>Nama</th>
            <th>harga</th>
            <th>jumlah</th>
            <th>aksi</th>
        </tr>

        <?php if(isset($_SESSION["data_belanjaan"]) && is_array($_SESSION["data_belanjaan"])):?>
            <?php foreach ($_SESSION["data_belanjaan"] as $key => $item) :?>
                <tr>
                    <td><?=htmlspecialchars($item["nama"]) ?></td>
                    <td><?=htmlspecialchars($item["harga"] )?></td>
                    <td><?=htmlspecialchars($item["jumlah"]) ?></td>
                    <td><a href="hapus.php?id=<?= $key ; ?>">Hapus</a></td>
                </tr>
            <?php endforeach;?>
        <?php endif; ?>
    </table>

    <!-- Total barang dan total harga hanya ditampilkan sekali -->
    <table>
        <tr>
            <th>Total Barang</th>
            <td><?= $totalBarang ?></td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td><?= $totalHarga ?></td>
        </tr>
    </table>
</div>
</body>
</html>
