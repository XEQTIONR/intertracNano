<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePaymentsTablePrimaryKeyName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      \DB::statement('ALTER TABLE `payments` CHANGE `invoice_num` `transaction_id`  INT( 10 ) NOT NULL AUTO_INCREMENT ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
      \DB::statement('ALTER TABLE `payments` CHANGE `transaction_id` `invoice_num`  INT( 10 ) NOT NULL AUTO_INCREMENT ');
    }
}
