<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\Material;
use App\Models\Price_log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
          $mats = DB::table('materials')->get();
          foreach($mats as $mat){
            $currentPrice = $mat->price;
            $maxPlus = ($currentPrice / 100) * 5;
            $maxMinus = ($currentPrice / 100) * 4.60;
            $newPrice = rand(0,1) === 1 ? $currentPrice + mt_rand(0,$maxPlus * 10) / 10 : $currentPrice - mt_rand(0,$maxMinus * 10) / 10;
            $newPriceFormated = number_format((float)$newPrice, 1, '.', '');
            $priceChangeFormated = number_format((float)$newPrice - $currentPrice, 1, '.', '');
            Material::where('id', $mat->id)
            ->update([
                'price' => $newPriceFormated,
                'price_change' => $priceChangeFormated
            ]);
            $log = new Price_log;
            $log->material_id = $mat->id;
            $log->price = $newPriceFormated;
            $log->save();
          }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
