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
