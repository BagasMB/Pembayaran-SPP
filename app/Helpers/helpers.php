<?php

use Carbon\Carbon;

if (!function_exists('formatRupiah')) {
  function formatRupiah($angka)
  {
    return 'Rp. ' . number_format($angka, 0, ',', '.');
  }
}

if (!function_exists('formatDate')) {
  function formatDate($date, $format = 'l, d F Y', $locale = 'id')
  {
    return Carbon::parse($date)->locale($locale)->translatedFormat($format);
  }
}

if (!function_exists('emailFormat')) {
  function emailFormat($nameUser)
  {
    $emailUsername = strtolower(str_replace([' ', ',', '.', '/', '\'', '-'], '.', $nameUser));

    // Hapus titik ganda yang berulang menggunakan regex
    $emailUsername = preg_replace('/\.+/', '.', $emailUsername);

    // Hapus titik di awal dan akhir agar tidak invalid
    $emailUsername = trim($emailUsername, '.');

    return $emailUsername . '@gmail.com';
  }
}

if (!function_exists('usernameFormat')) {

  function usernameFormat($name)
  {
    // Hanya biarkan huruf dan spasi
    $name = strtolower(preg_replace('/[^a-zA-Z ]/', '', $name));

    // Ubah ke lowercase dan hapus spasi
    return strtolower(str_replace(' ', '', $name));
  }
}
