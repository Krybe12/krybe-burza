<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateChangePriceEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //adasdasd
/*       DB::unprepared('
      CREATE EVENT e_change_prices
        ON SCHEDULE EVERY 1 HOUR
        DO 
        BEGIN
          CALL p_change_prices();
        END
      '); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      /* DB::unprepared('DROP EVENT `e_change_prices`'); */
    }
}
