<?php

use Carbon\Carbon;

if (! function_exists('convert_date')) {
    function convert_date($date) {
        if ($date) {
            return Carbon::parse($date)->format('d M Y');
        }

        return null;
    }
}