<?php
session_start();

// Tambah data
if (!isset($_SESSION['dataBarang'])) {
  $_SESSION['dataBarang'] = [];
}


if (isset($_POST['tambahBarang'])) {
    $namaBarang = strtolower(htmlspecialchars($_POST['namaBarang']));
    $hargaBarang = htmlspecialchars($_POST['hargaBarang']);
    $jumlahBarang = htmlspecialchars($_POST['jumlahBarang']);

    if (empty($namaBarang) || $hargaBarang < 1 || $jumlahBarang < 1) {
    include './components/error.php';
    } else {
        $barangSudahAda = false;
        if (!isset($_SESSION['dataBarang'])) {
            $_SESSION['dataBarang'] = [];
        }
        foreach ($_SESSION['dataBarang'] as &$item) {
            if ($item['namaBarang'] === $namaBarang) {
                $item['jumlahBarang'] += $jumlahBarang;
                $barangSudahAda = true;
                $_SESSION['notification'] = 'update';
                break;
            }
        }
        if (!$barangSudahAda) {
            $data = [
                'hargaBarang' => $hargaBarang,
                'jumlahBarang' => $jumlahBarang,
                'namaBarang' => $namaBarang
            ];
            $_SESSION['notification'] = 'succes';
            array_push($_SESSION['dataBarang'], $data);
        }

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}


// Hapus Data

if (isset($_GET['hapus'])) {
  $index = $_GET['hapus'];
  unset($_SESSION['dataBarang'][$index]);
}

// checkout

if (isset($_POST['checkout'])) {
    $_SESSION['checkout'] = true;
    header("location: ./checkout/checkout.php");
    exit;
}