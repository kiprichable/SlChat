<?php
namespace App;

use function array_rand;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libs\googleCalendarEvents;
use Illuminate\Support\Facades\DB;
use function strtotime;

/**
 * Class Appointment
 *
 * @package App
 * @property string $client
 * @property string $employee
 * @property string $start_time
 * @property string $finish_time
 * @property text $comments
*/
class Appointment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    

    /**
     * Set to null if empty
     * @param $input
//     */
//    public function setClientIdAttribute($input)
//    {
//        $this->attributes['client_id'] = $input ? $input : null;
//    }
//
//    /**
//     * Set to null if empty
//     * @param $input
//     */
//    public function setEmployeeIdAttribute($input)
//    {
//        $this->attributes['employee_id'] = $input ? $input : null;
//    }
//
//    /**
//     * Set attribute to date format
//     * @param $input
//     */
//    public function setStartTimeAttribute($input)
//    {
//        if ($input != null && $input != '') {
//            $this->attributes['start_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
//        } else {
//            $this->attributes['start_time'] = null;
//        }
//    }
//
//    /**
//     * Get attribute from date format
//     * @param $input
//     *
//     * @return string
//     */
//    public function getStartTimeAttribute($input)
//    {
//        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');
//
//        if ($input != $zeroDate && $input != null) {
//            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
//        } else {
//            return '';
//        }
//    }
//
//    /**
//     * Set attribute to date format
//     * @param $input
//     */
//    public function setFinishTimeAttribute($input)
//    {
//        if ($input != null && $input != '') {
//            $this->attributes['finish_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
//        } else {
//            $this->attributes['finish_time'] = null;
//        }
//    }
//
//    /**
//     * Get attribute from date format
//     * @param $input
//     *
//     * @return string
//     */
//    public function getFinishTimeAttribute($input)
//    {
//        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');
//
//        if ($input != $zeroDate && $input != null) {
//            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
//        } else {
//            return '';
//        }
//    }
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->withTrashed();
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id')->withTrashed();
    }
    /**
	 *
	 * return weekends
	 * @param $user
	 */
    
    public function getNonBookableDays()
	{
		$NonBookableDays = array();
		$type = CAL_GREGORIAN;
		//$month = date('m'); // Month ID, 1 through to 12.
		$year = date('Y'); // Year in 4 digit 2017 format.
		//$day_count = cal_days_in_month($type, $month, $year); // Get the amount of days
		
		$months = ['1','2','3','4','5','6','7','8','9','10','11','12'];
		
		foreach($months as $month) {
			$day_count = cal_days_in_month ($type, $month, $year);
			//loop through all days
			for($i = 1; $i <= $day_count; $i++) {
				
				$date = $year . '-' . $month . '-' . $i; //format date
				$get_name = date ('l', strtotime ($date)); //get week day
				$day_name = substr ($get_name, 0, 3); // Trim day name to 3 chars
				
				//if not a weekend add day to array
				if ( $day_name == 'Sun' || $day_name == 'Mon' || $day_name == 'Wed' || $day_name == 'Fri' || $day_name == 'Sat' ) {
					
					$NonBookableDays[] = date_format (date_create ($date), 'Y-m-d');
				}
				
			}
		}
		
		return $NonBookableDays;
	
	}
	
	/**
	 * Add to persist nonbookable days
	 * @param $NonBookableDays
	 */
	
	public function loadNonBookable($NonBookableDays)
	{
		
		foreach($NonBookableDays as $NonBookableDay)
		{
			$appointment = Appointment::firstOrNew(
				['start_time' => $NonBookableDay.' 00:00:00'],
				['finish_time' => $NonBookableDay.' 23:59:00']
			);
			
			
			$appointment->client_id = '1';
			$appointment->employee_id = '1';
			$appointment->start_time = $NonBookableDay. '00:00:00';
			$appointment->finish_time= $NonBookableDay. '23:59:00';
			$appointment->created_at = $NonBookableDay. '00:00:00';
			$appointment->updated_at = $NonBookableDay. '00:00:00';
			$appointment->comments = 'NonBookable';
			
			$appointment->save();
			
		}
		
		
	}
	
	
	public function getGoogleCalendarEvents()
	{
		
		$events = new googleCalendarEvents();
		
		
		$results = $events->getMyEvents();
		
		if (count($results->getItems()) == 0) {
			print "No upcoming events found.\n";
		} else {
			print "Upcoming events:\n";
			foreach ($results->getItems() as $event) {
				$start = $event->start->dateTime;
				if (empty($start)) {
					$start = $event->start->date;
				}
				printf("%s (%s)\n", $event->getSummary(), $start);
			}
		}
		
		
	}
	
	public function getNextAvailableUser()
	{
		$appointments = Appointment::where('start_time','>',Date('Y-m-d'))->get();
		
		//employees with upcoming appointments
		$employees = array();
		foreach($appointments as $appointment)
		{
			$employees[] = $appointment->employee_id;
		}
		
		//employees with no upcoming appointments
		$availableEmployees = Employee::whereNotIn('id',$employees)->get();
		
		
		//if their is no available employee's get employee with with the least appointment
		if(count($availableEmployees->toArray()) < 1)
		{
		$sql = "select employee_id, count(employee_id) from appointments group by employee_id ORDER by count(employee_id) asc";
		
		$id = DB::select( DB::raw($sql))[0]->employee_id;
		
		}
		else
		{
			$array = array();
			foreach($availableEmployees->toArray() as $emp)
			{
				$array[] = $emp['id'];
			}
			
			$id = $array[array_rand($array)];
			
		}
		
	return $id;
		
	}
}
