<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['struk'])) {
  header('Location: ../');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
  </style>
</head>

<body class="px-5 pb-5 text-xs sm:text-sm md:text-lg lg:text-base" >
  <div class="max-w-xl mx-auto">
    <div class="my-14">
      <h1 class="text-slate-800 font-semibold text-xl lg:text-3xl text-center mb-5">
        Bukti pembayaran
      </h1>

      <p class=" text-center to-slate-600">
        Jl. Raya Wangun, Sindangsari, Kec. Bogor Tim., Kota Bogor, Jawa Barat 16146
      </p>
    </div>

    <div class="text-slate-600 ">
      <div class="flex justify-between py-2 mb-5">
        <span>BON</span>
        <span>#<?= rand(100000000000, 999999999999); ?></span>
      </div>

      <?php
      $totalBarang = 0;
      $subtotal = 0;
      $no = 1;
      ?>

      <div class="mb-7">
        <table class="w-full text-slate-700 border-y border-gray-300 table-fixed">
          <?php foreach ($_SESSION['dataBarang'] as $key => $value) : ?>
            <tr class="py-2">
              <td class="py-2.5 capitalize"><?= $value['namaBarang'] ?></td>
              <td class="py-2.5 px-4 text-right">x<?= $value['jumlahBarang'] ?></td>
              <td class="py-2.5 whitespace-nowrap text-right">Rp<?= number_format($value['hargaBarang'], 2, ',', '.') ?></td>
            </tr>

            <?php
            $totalBarang += $value['jumlahBarang'];
            $subtotal += $value['hargaBarang'] * $value['jumlahBarang'];
            $total = $subtotal + ($subtotal * 0.05);
            ?>
          <?php endforeach; ?>
        </table>
      </div>

      <div class="">
        <table class="w-full text-slate-700 border-b border-gray-300">
          <tr>
            <td class="py-1.5 font-semibold text-slate-800">Total item</td>
            <td class="py-1.5 whitespace-nowrap text-right"><?= $totalBarang ?></td>
          </tr>
          <tr>
            <td class="py-1.5 font-semibold text-slate-800">Total belanja</td>
            <td class="py-1.5 whitespace-nowrap text-right">Rp<?= number_format($total, 2, ',', '.')  ?></td>
          </tr>
          <tr>
            <td class="py-1.5 font-semibold text-slate-800">Tunai</td>
            <td class="py-1.5 whitespace-nowrap text-right">Rp<?= number_format($_SESSION['nominalUang'], 2, ',', '.')  ?></td>
          </tr>
          <tr>
            <td class="pt-1.5 pb-8 font-semibold text-slate-800">Kembalian</td>
            <td class="pt-1.5 pb-8 whitespace-nowrap text-right">Rp. <?= number_format($_SESSION['nominalUang'] - $_SESSION['total'], 2, ',', '.')  ?></td>
          </tr>
        </table>
      </div>

      <div class="flex justify-between mt-5">
        <span>Tgl.</span>
        <span><?= date('d/m/y H:m:s') ?></span>
      </div>

      <div class="text-center mt-12">
        Terimakasih telah berbelanja di WK store

        <span class="block text-blue-800 underline"><a href="../">Kembali</a></span>
      </div>
    </div>
  </div>
</body>

</html>

<?php
session_unset();

session_destroy();
?>