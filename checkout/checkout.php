<?php
session_start();

if (!isset($_SESSION['checkout'])) {
  header("location: ../");
  exit;
}

if (isset($_POST['bayar'])) {
  $nominalUang = htmlspecialchars($_POST['nominalUang']);
  $_SESSION['nominalUang'] = $nominalUang;

  if ($nominalUang < $_SESSION['total']) {
    include '../components/lessMoney.php';
  } else {
    $_SESSION['struk'] = true;
    header('Location: struck.php?p=1');
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
  </style>
</head>

<body class="px-5 text-xs md:text-sm lg:text-base" >
  <div class="max-w-xl mx-auto">
    <h1 class="text-slate-800 font-semibold text-xl md:text-3xl text-center my-14">
      Bayar sekarang
    </h1>

    <form action="" method="post" class="text-slate-600 space-y-4">
      <label for="nominalUang" class="block ">Masukan nominal uang</label>
      <input type="number" required name="nominalUang" id="nominalUang" placeholder="Nominal uang" class="w-full py-2.5 px-4 bg-gray-100 rounded-sm focus:outline-maincolor ">
      <span class="block font-semibold text-slate-800 ">
        Total yang harus dibayarkan Rp<?= number_format($_SESSION['total'], 2, ',', '.') ?>
      </span>
      <button class="py-2 px-4 rounded-sm text-white w-full  block bg-maincolor" name="bayar" type="submit">
        Bayar
      </button>
      <Button class="py-2 px-4 rounded-sm text-white w-full  block bg-gray-500">
        <a href="../">Kembali</a>
      </Button>
    </form>
  </div>

  <script src="../script.js" ></script>
</body>

</html>