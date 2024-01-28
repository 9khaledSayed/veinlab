<?php

namespace App\Console\Commands;

use App\Exports;
use App\Invoice;
use App\Patient;
use App\Revenue;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'daily report about financials';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $revenueAmounts   = Revenue::whereDate('created_at' , Carbon::tomorrow())->pluck('amount')->toArray();
        $sumRevenue = array_sum($revenueAmounts);

        $exportsAmounts   = Exports::whereDate('created_at' , Carbon::tomorrow())->pluck('amount')->toArray();
        $sumExports = array_sum($exportsAmounts);

        $no_patients      = Invoice::whereDate('created_at' , Carbon::tomorrow())->count();

        $no_new_patients  = Patient::whereDate('created_at' , Carbon::tomorrow())->count();

        $profit = $sumRevenue - $sumExports;

        $data = ['sumRevenue' => $sumRevenue,
            'sumExports' => $sumExports,
            'no_patients' => $no_patients,
            'no_new_patients' => $no_new_patients,
            'profit' => $profit];

        Mail::to('ahmmaad.gamal1999@gmail.com')
            ->send(new \App\Mail\DailyReport($data));
    }
}
