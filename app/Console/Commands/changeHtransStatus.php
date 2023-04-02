<?php

namespace App\Console\Commands;

use App\Models\Htrans;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;

class changeHtransStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'midtrans:changeStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $testTanggal = Carbon::now();
        // $testTanggal->addMonths(6);
        // $testTanggal->addDays(2);
        // $order = Order::whereNot('order.status_order',"Selesai Sewa")->get();
        // foreach ($order as $o) {
        //     $interval2 = $testTanggal->diffInDays($o->tanggal_selesai);
        //     $hari = $interval2+1;
        //     if($testTanggal>=$o->tanggal_selesai){
        //         $o->total_denda = ($hari * 1/100 * (int)$o->harga_kamar);
        //         $o->total_terlambat = $hari;
        //         $o->save();
        //     }
        // }
        $time = Carbon::now();
        $trans = Htrans::all();
        foreach ($trans as $val) {
            $transDate = $val->created_at;
            $transDate-> addDays(1);
            if($transDate < $time && $val->status_trans == 1){
                $val->status_trans = 0;
            }
            $val->save();
            $val->touch();
            // $trans->touch();
            // $time->touch();
        }
        // return Command::SUCCESS;
    }
}
