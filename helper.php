<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

if (! function_exists('convert_date')) {
    function convert_date($date) {
        if ($date) {
            return Carbon::parse($date)->format('d M Y');
        }

        return null;
    }
}

if (! function_exists('panic')) {
    function panic($errorMessage, $message='Sorry, something went wrong.') {
        Log::info($errorMessage);
        return response()->json(['message'=>$message, 'errorMessage'=>$errorMessage], 500);
    }
}

if (! function_exists('notice')) {
    function notice($label, $message)
    {
        $notices = ['label' => $label, 'message' => $message];

        Session::put('notice', $notices);
    }
}