<?php

namespace App\Jobs;

use DB;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pathFile = public_path() . '/vietnam.xlsx';
        Excel::filter('chunk')->load($pathFile)->chunk(500, function ($results) {
            foreach ($results as $item) {
                $name = addslashes($item->city);
                $sql  = "INSERT INTO city (name,created_date) VALUES ('" . $name . "','" .date('Y-m-d H:i:s') . "')";
                DB::insert($sql);
            }
        });
    }
}
