<?php

namespace App\Services;

use Carbon\Carbon;

class InvoiceService {
    public static function generateNumber(){
        return Carbon::now()->timestamp . random_int(100000, 999999);
    }
}
