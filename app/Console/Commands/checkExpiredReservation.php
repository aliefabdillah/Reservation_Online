<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Seat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class checkExpiredReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reservationUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::raw("UPDATE orders o, seats s SET o.order_status = '4', s.is_available = 1 WHERE TIMESTAMPDIFF(MINUTE, waktu_reservasi, now()) > 15 AND order_status = '1'");
        return 0;
    }
}
