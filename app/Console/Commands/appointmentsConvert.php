<?php

namespace App\Console\Commands;

use App\Appointment;
use App\Libs\appointmentImport;
use Illuminate\Console\Command;

class appointmentsConvert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:Appt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Appt';

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
     * @return mixed
     */
    public function handle()
    {
        $appt = new appointmentImport();
        
        $appt->getAppointments();
    }
}
