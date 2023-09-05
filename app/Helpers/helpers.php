<?php

use Illuminate\Support\Carbon;

if (!function_exists('formatDateYDM')) {
    function formatDateYDM($date, $format = 'Y/d/m') {
        if ($date instanceof Carbon) {
            return $date->format($format);
        }

        return $date;
    }
}

if (!function_exists('formatDateDMY')) {
    function formatDateDMY($date, $format = 'd/m/Y') {
        if ($date instanceof Carbon) {
            return $date->format($format);
        }

        return $date;
    }
}
