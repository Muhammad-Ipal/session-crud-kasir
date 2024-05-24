<?php
require_once './logic.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WK Store</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    @media (min-width: 1024px) {
      .full-height {
        height: calc(100dvh - 52px);
      }
    }
  </style>
</head>

<?php

if (isset($_SESSION['notification'])) {
  if ($_SESSION['notification'] == 'succes') {
    include './components/succes.php';
    unset($_SESSION['notification']);
  } else {
    include './components/update.php';
    unset($_SESSION['notification']);
  }
}
?>

<body class="font-poppins bg-bg">
  <header class="px-5 md:px-10 lg:px-20 bg-white flex justify-between items-center py-2.5">
    <p class="font-semibold text-slate-700 text-xl md:text-2xl">WK<span class="text-maincolor">Store</span></p>

    <span class="text-slate-700 text-sm sm:text-base">
      <i class="fa-solid fa-user mr-2"></i>
      Admin
    </span>
  </header>

  <main class="px-5 full-height">
    <div class="max-w-2xl md:max-w-5xl mx-auto flex flex-col md:flex-row items-center h-full gap-x-7">
      <div class="w-full md:w-2/5 mb-10 md:mb-0">
        <h2 class="text-slate-700 text-xl md:text-2xl md:mb-10 text-center font-semibold my-10">
          Masukan Data Barang
        </h2>

        <form action="" method="post" class="space-y-3.5 text-sm md:text-base">
          <input type="text" class="block border-2 border-gray-100 bg-white w-full py-3  focus:outline-maincolor  rounded-sm px-5" placeholder="Nama barang" name="namaBarang">
          <input type="number" class="block border-2 border-gray-100 bg-white w-full py-3  focus:outline-maincolor  rounded-sm px-5" placeholder="Harga" name="hargaBarang">
          <input type="number" class="block border-2 border-gray-100 bg-white w-full py-3  focus:outline-maincolor  rounded-sm px-5" placeholder="Kuantitas" name="jumlahBarang">
          <button type="submit" class="block bg-maincolor text-white w-full py-3 rounded-sm" name="tambahBarang">
            Tambah
          </button>
        </form>
      </div>

      <div class="md:w-3/5 w-full bg-white p-2 md:p-6 border-2 relative border-gray-100 h-[80dvh]">
        <h3 class="text-lg text-slate-700 border-b border-gray-200 pb-2 pl-2 mb-2">
          List barang
        </h3>


        <div class="flex flex-col justify-between" style="height: calc(100% - 40px);">
          <?php if (!empty($_SESSION['dataBarang'])) : ?>

            <?php
            $totalBarang = 0;
            $subtotal = 0;
            $no = 1;
            ?>

            <div class="overflow-y-auto pb-12">
              <table class="w-full text-slate-600 overflow-y-auto">
                <?php foreach ($_SESSION['dataBarang'] as $key => $value) : ?>
                  <tr class="py-2 odd:bg-gray-50 md:text-sm text-xs">
                    <td class="w-auto py-2.5">
                      <div class="min-w-[22px] max-w-[22px] max-h-[22px] min-h-[22px] md:min-w-[28px] md:max-w-[28px] md:max-h-[28px] md:min-h-[28px] mr-1 md:mr-5 flex items-center justify-center text-white font-semibold rounded-full bg-maincolor text-xs md:text-base">
                        <?= $no ?>
                      </div>
                    </td>
                    <td class="px-2 w-2/5 py-2.5 capitalize"><?= $value['namaBarang'] ?></td>
                    <td class="px-2 w-[25%] py-2.5 whitespace-nowrap">Rp<?= number_format($value['hargaBarang'], 2, ',', '.') ?></td>
                    <td class="px-2 w-[15%] py-2.5 font-semibold">x<?= $value['jumlahBarang'] ?></td>
                    <td class="px-2 w-[5%] py-2.5">
                      <button class="bg-maincolor px-3 py-1 rounded-full text-xs md:text-sm text-white">
                        <a href="?hapus=<?= $key ?>">Hapus</a>
                      </button>
                    </td>
                  </tr>

                  <?php
                  $totalBarang += $value['jumlahBarang'];
                  $subtotal += $value['hargaBarang'] * $value['jumlahBarang'];
                  $total = $subtotal + ($subtotal * 0.05);
                  $no++;
                  ?>
                <?php endforeach; ?>
              </table>
            </div>

            <?php
            $_SESSION['total'] = $total;
            $_SESSION['totalBarang'] = $totalBarang;
            ?>

            <div class="-mt-[37px] z-10 pt-5 bg-white">
              <h5 class="text-slate-600 text-xs md:text-sm border-b pb-2 border-gray-200">
                Checkout
              </h5>

              <table class="w-full md:text-sm text-xs text-slate-500 mb-3">
                <tr>
                  <td class="py-2 font-semibold whitespace-nowrap text-slate-700">Total barang</td>
                  <td class="py-2 text-right whitespace-nowrap text-slate-700"><?= $totalBarang ?></td>
                </tr>
                <tr>
                  <td class="py-2 font-semibold whitespace-nowrap text-slate-700">Subtotal</td>
                  <td class="py-2 text-right whitespace-nowrap text-slate-700">Rp<?= number_format($subtotal, 2, ',', '.') ?></td>

                </tr>
                <tr class=" border-b border-gray-200">
                  <td class="py-2 font-semibold whitespace-nowrap text-slate-700">Tax</td>
                  <td class="py-2 text-right whitespace-nowrap text-slate-700">5%</td>
                </tr>
                <tr>
                  <td class="py-2 font-semibold whitespace-nowrap text-slate-700">Total</td>
                  <td class="py-2 text-right whitespace-nowrap text-slate-700">Rp<?= number_format($total, 2, ',', '.') ?></td>
                </tr>
              </table>
              <form method="post">
                <button class="block bg-maincolor text-white text-sm md:text-base w-full py-3 rounded-sm" type="submit" name="checkout">
                  Checkout
                </button>
              </form>
            </div>
          <?php else : ?>
            <div class="absolute text-red-500 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 ">
              Tidak ada data
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <footer></footer>
  </main>
  <script src="script.js">
  </script>
</body>

</html>