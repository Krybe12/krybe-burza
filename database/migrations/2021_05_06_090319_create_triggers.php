<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /*  DB::unprepared('
        CREATE TRIGGER t_price AFTER UPDATE ON materials FOR EACH ROW
            BEGIN
            INSERT INTO price_log (material_id, price) VALUES (NEW.id, NEW.price);
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
        /* DB::unprepared('DROP TRIGGER `t_price`'); */
        //dadsadadasd
    }
}
