<?php

namespace App\Console\Commands;

use App\Exports;
use App\Profit;
use App\Revenue;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CalcProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calc:profit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'calc the profit everyday';

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
        $revenueAmounts = Revenue::whereDate('created_at' , Carbon::today())->pluck('amount')->toArray();
        $sumRevenue = array_sum($revenueAmounts);

        $exportsAmounts = Exports::whereDate('created_at' , Carbon::today())->pluck('amount')->toArray();
        $sumExports = array_sum($exportsAmounts);

        Profit::create([
            'value' => ($sumRevenue - $sumExports)
        ]);

    }
}
