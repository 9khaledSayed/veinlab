<?php

namespace App\Console\Commands;

use App\LeaveBalance;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CarriedDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carried:days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $leaveBalances = LeaveBalance::all();
        $year = Carbon::now()->year;

        foreach( $leaveBalances as $leaveBalance)
        {
            $no_days = $leaveBalance->vacation_type->no_days;
            LeaveBalance::create([
                    'vacation_id'     => $leaveBalance->vacation_id,
                    'employee_id'     => $leaveBalance->employee_id,
                    'no_days'         => $no_days,
                    'balance'         => $leaveBalance->balance,
                    'no_days_carried' => $leaveBalance->no_days,
                    'year'            => $year
                ]);
        }
    }
}
