<?php

namespace App\Console\Commands;

use App\Appointment;
use Illuminate\Console\Command;

class LoadNonBookableDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Load:NonBookable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load non bookable days once a year';

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
		$this->appointments->loadNonBookable($this->appointments->getNonBookableDays());
    }
}
