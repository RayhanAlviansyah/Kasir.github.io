<?php
session_start();

// Ambil informasi pembelian dari URL
$totalHarga = isset($_GET['total_harga']) ? $_GET['total_harga']:0;
$uangDibayar = isset($_GET['uang_dibayar']) ? $_GET['uang_dibayar']:0;
$kembalian = isset($_GET['kembalian']) ? $_GET['kembalian']:0;

$data_belanjaan = isset($_SESSION["data_belanjaan"]) ? $_SESSION["data_belanjaan"] : [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Rincian Pembelian</title>

    <style>
        /* CSS styles */
    </style>
</head>
<body>
<div class="container">
    <h1>Rincian Pembelian</h1>
    
    <!-- Informasi pembelian -->
    <h2>Barang yang dibeli:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($data_belanjaan)): ?>
        <?php foreach ($data_belanjaan as $item): ?>
        <tr>
            <td><?=htmlspecialchars($item["nama"]) ?></td>
            <td><?= htmlspecialchars($item["harga"]) ?></td>
            <td><?= htmlspecialchars($item["jumlah"]) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">tidak ada barang yang di beli.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Informasi Pembayaran :</h2>
    <p>Total Harga : <?=htmlspecialchars($totalHarga)  ?></p>
    <p>Uang Dibayar : <?= htmlspecialchars($uangDibayar) ?></p>
    <p>Kembalian : <?= htmlspecialchars($kembalian) ?></p>
</div>
</body>
</html>