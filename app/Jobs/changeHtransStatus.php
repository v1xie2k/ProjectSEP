<?php

namespace App\Jobs;

use App\Models\Htrans;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class changeHtransStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $time = Carbon::now();
        $trans = Htrans::where('status_trans', 1)->get();
        foreach ($trans as $val => $value) {
            $transDate = $val->created_at;
            $transDate-> addDays(1);
            $val->status_trans = 0;
            // if($val->status_trans == 100 ){
            // }
            $val->save();
            $trans->touch();
            $time->touch();
        }
        sleep(60);
    }
}
