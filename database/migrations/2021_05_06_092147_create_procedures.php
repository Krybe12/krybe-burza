<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* DB::unprepared('
        CREATE OR REPLACE PROCEDURE p_change_prices()
            BEGIN
                DECLARE curFinished INTEGER DEFAULT 0;
                DECLARE currentPrice INTEGER DEFAULT 0;
                DECLARE matID INTEGER DEFAULT 0;

                DECLARE curPrice
                    CURSOR FOR
                        SELECT id, price FROM materials;

                DECLARE CONTINUE HANDLER FOR NOT FOUND SET curFinished = 1;

                OPEN curPrice;
                curLoop: LOOP
                    FETCH curPrice INTO matID, currentPrice;
                    IF curFinished = 1 THEN
                        LEAVE curLoop;
                    END IF;
                    SET @maxPlus = (currentPrice / 100) * 5;
                    SET @maxMinus = (currentPrice / 100) * 4.8;
                    IF FLOOR(RAND() * 2) = 1 THEN
                        SET @newPrice = currentPrice + ROUND(RAND() * @maxPlus, 1);
                    ELSE
                        SET @newPrice = currentPrice - ROUND(RAND() * @maxMinus, 1);
                    END IF;
                    SET @priceChange = @newPrice - currentPrice;
                    UPDATE materials SET price = @newPrice, price_change = @priceChange WHERE id = matID;

                END LOOP curLoop;
                CLOSE curPrice;
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
        /* DB::unprepared('DROP PROCEDURE `p_change_prices`'); */
    }
}
