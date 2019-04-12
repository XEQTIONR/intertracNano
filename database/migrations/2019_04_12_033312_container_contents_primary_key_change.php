<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContainerContentsPrimaryKeyChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      \DB::statement('ALTER TABLE `container_contents`
        DROP PRIMARY KEY, ADD PRIMARY KEY(Container_num,BOL,tyre_id,unit_price)
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
      \DB::statement('ALTER TABLE `container_contents`
        DROP PRIMARY KEY, ADD PRIMARY KEY(Container_num,BOL,tyre_id)
        ');
    }
}
