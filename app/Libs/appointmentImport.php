<?php
	/**
	 * Created by PhpStorm.
	 * User: danielcheruiyot
	 * Date: 8/7/17
	 * Time: 8:45 PM
	 */
	
	namespace App\Libs;
	
	
	use App\Appointment;
	use Illuminate\Support\Facades\DB;
	
	class appointmentImport
	{
		public function getAppointments()
		{
			$appointments = DB::table('app_appointments')->get();
			foreach($appointments as $appointment)
			{
				$newApp = Appointment::firstOrCreate(['start_time' => $appointment->date .' '. $appointment->start_time]);
				$newApp->client_id = $appointment->user_id;
				$newApp->employee_id = '1';
				$newApp->start_time = $appointment->date .' '. $appointment->start_time;
				$newApp->finish_time = $appointment->date .' '. $appointment->end_time;
				$newApp->comments = $appointment->confirmation;
				$newApp->save();
				
			}
		}
	}