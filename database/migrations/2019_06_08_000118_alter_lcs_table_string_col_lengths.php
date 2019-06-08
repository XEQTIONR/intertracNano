<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLcsTableStringColLengths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      \DB::statement('ALTER TABLE `lcs` MODIFY applicant VARCHAR(500) NOT NULL');
      \DB::statement('ALTER TABLE `lcs` MODIFY beneficiary VARCHAR(500) NOT NULL');
      \DB::statement('ALTER TABLE `lcs` MODIFY notes VARCHAR(500) NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
      \DB::statement('ALTER TABLE `lcs` MODIFY applicant VARCHAR(100) NOT NULL');
      \DB::statement('ALTER TABLE `lcs` MODIFY beneficiary VARCHAR(100) NOT NULL');
      \DB::statement('ALTER TABLE `lcs` MODIFY notes VARCHAR(100) NOT NULL');
    }
}
