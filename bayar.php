<?php
session_start();

$totalHarga = 0;
$totalBarang = 0;

// Hitung total barang dan total harga
if(isset($_SESSION["data_belanjaan"]) && is_array($_SESSION["data_belanjaan"])) {
    foreach ($_SESSION["data_belanjaan"] as $item) {
        $totalBarang += $item["jumlah"];
        $totalHarga += $item["harga"] * $item["jumlah"];
    }
}


// Proses pembayaran
if(isset($_POST["bayar"])) {
    $uangDibayar = $_POST["uang_dibayar"];
    $kembalian = $uangDibayar - $totalHarga;

    if($uangDibayar < $totalHarga) {
        $pesan_kurang = '<div class="alert alert-danger" role="alert">
                            Uang yang dibayarkan kurang. Kekurangan: ' . ($totalHarga - $uangDibayar) . '
                        </div>';
    } else {
        $pesan = '<div class="alert alert-success" role="alert">
                    Pembayaran berhasil! Kembalian: ' . $kembalian . '
                </div>';

        header("Location: struk.php?total_harga= " . urlencode($totalHarga) . "&uang_dibayar=" . urlencode($uangDibayar). "&kembalian=" . urlencode($kembalian));
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Pembayaran</title>

    <style>
        /* CSS styles */
    </style>
</head>
<body>
<div class="container">
    <h1>Pembayaran</h1>
    
    <!-- Informasi total harga -->
    <p>Total yang harus dibayar: <?= $totalHarga ?></p>

    <!-- Informasi barang yang akan dibeli -->
<h2>Barang yang akan Dibeli:</h2>
<table class="table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION["data_belanjaan"] as $item): ?>
        <tr>
            <td><?=htmlspecialchars($item["nama"]) ?></td>
            <td><?= htmlspecialchars($item["harga"]) ?></td>
            <td><?= htmlspecialchars($item["jumlah"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    
    <!-- Form pembayaran -->
    <form action="" method="post">
        <div class="mb-3">
            <label for="uang_dibayar" class="form-label">Uang Dibayar</label>
            <input type="number" name="uang_dibayar" id="uang_dibayar" class="form-control" required>
        </div>
        <button type="submit" name="bayar" class="btn btn-primary">Bayar</button>
    </form>


    <!-- Pesan hasil pembayaran -->
    <?php if(isset($pesan)) echo $pesan; ?>
    <!-- Pesan kesalahan jika nominal yang dibayarkan kurang -->
<?php if(isset($pesan_kurang)) echo $pesan_kurang; ?>

</div>
</body>
</html>
