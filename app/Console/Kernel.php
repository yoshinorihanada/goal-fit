<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
        $schedule->call(function (){
            $users = DB::table('users')->get();

            foreach($users as $user){
                $goalsToday = DB::table('goals')->where('user_id', $user->id)->whereDate('due_date', Carbon::today())->get();
                $completedGoalsToday = DB::table('goals')->where('user_id', $user->id)->whereDate('completed_at', Carbon::today())->get();

                $goalsTodayCount = count($goalsToday);
                $completedGoalsTodayCount = count($goalsTodayCount);

                if($goalsTodayCount == $completedGoalsTodayCount){
                    DB::table('users')->where('id', $user->id)->update(['point'=> DB::raw('point+5')]);
                }
            }
            
            
        })->daily();
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
