<div class="absolute left-1/2 z-50 -translate-x-1/2 top-2 " id="notification">
  <div role="alert" class="rounded w-auto  border-s-4 border-red-500 bg-red-50 p-4">
    <div class="flex items-center gap-2 text-red-800 whitespace-nowrap">
      <i class="fa-solid fa-triangle-exclamation"></i>

      <strong class="block font-medium text-sm md:text-base">Something went wrong</strong>
    </div>

    <p class="mt-2 text-xs md:text-sm text-red-700">
      You don't have enough funds. You are short by Rp<?= number_format($_SESSION['total'] - $_POST['nominalUang'], 2, ',', '.')  ?>.
    </p>
  </div>
</div>