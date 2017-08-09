<?php

namespace App\Console\Commands;

use App\Appointment;
use Illuminate\Console\Command;

class GCalendarEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:calendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get google calendar events';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->appointments = new Appointment();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dd($this->appointments->getGoogleCalendarEvents());
    }
}
