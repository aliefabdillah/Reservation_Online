<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->timestamp("ts_dibayar")->nullable();
            $table->enum('jenis_pembayaran', ['dp', 'sisa']);
            $table->bigInteger('sisa');
            $table->string('number', 16)->nullable()->unique();
            $table->bigInteger('total_price');
            $table->enum('payment_status', ['1', '2', '3'])->comment('1=pending 2=success, 3=failed')->nullable();
            $table->string('snap_token', 36)->nullable();
            $table->foreignIdFor(Transaction::class);
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
        Schema::dropIfExists('transaction_details');
    }
}
