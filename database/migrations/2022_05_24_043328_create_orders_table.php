<?php

use App\Models\Seat;
use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu_reservasi')->nullable();
            // $table->integer('diskon');
            $table->bigInteger('total_harga')->nullable();
            $table->enum('order_status', ['1', '2', '3', '4'])->comment('1=pending, 2=selesai, 3=dibatalkan, 4=tidak_datang')->nullable();
            $table->foreignIdFor(Customer::class);
            $table->foreignIdFor(Seat::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
