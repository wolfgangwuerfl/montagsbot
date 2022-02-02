<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Telegram\Montagsbot\Basic;

class BasicBot extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'Telegram:BasicBot';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Montagsbot Basis';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        $basic = new Basic();
        $basic->getMe();
        $basic->getUpdates();
        $basic->sendMessage();
        // $schedule->command(static::class)->everyMinute();
    }
}
