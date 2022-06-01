<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

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
        Order::whereRaw("TIMESTAMPDIFF(MINUTE, waktu_reservasi, now()) > 15")->update(['order_status' => '4']);
        return 0;
    }
}
