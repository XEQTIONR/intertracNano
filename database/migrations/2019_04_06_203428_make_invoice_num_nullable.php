<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeInvoiceNumNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      \DB::statement('ALTER TABLE `lcs`
        MODIFY `invoice_no` VARCHAR(30)  DEFAULT NULL;
          ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
      \DB::statement('ALTER TABLE `lcs`
        MODIFY `invoice_no` VARCHAR(30) NOT NULL;
          ');
    }
}
