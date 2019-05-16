<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOrderNumLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      \DB::statement('ALTER TABLE `payments` MODIFY invoice_num INT ZEROFILL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
      \DB::statement('ALTER TABLE `payments` MODIFY invoice_num BIGINT ZEROFILL AUTO_INCREMENT');
    }
}
