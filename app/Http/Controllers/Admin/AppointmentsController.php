<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppointmentsRequest;
use App\Http\Requests\Admin\UpdateAppointmentsRequest;
use Illuminate\Support\Facades\View;

class AppointmentsController extends Controller
{
	public function __construct()
	{
		$this->appointments = new Appointment();
	}
    /**
     * Display a listing of Appointment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (! Gate::allows('appointment_access')) {
//            return abort(401);
//        }
	
		$user = \Auth::User();
		
		
			$appointments =  Appointment::all();
			
			$relations = [
				
				'clients' =>\App\Client::get()->pluck('last_name', 'id')->prepend('Please select', ''),
				'employees' => \App\Employee::get()->pluck('first_name', 'id')->prepend('Please select', ''),
			];
		
		
        return view('admin.appointments.index', $relations,compact('appointments','user'));
    }

    /**
     * Show the form for creating new Appointment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if (! Gate::allows('appointment_create')) {
//            return abort(401);
//        }
        
        if(\Auth::user()['role_id'] == '1')
		{
			$relations = [
				
				'clients' => \App\Client::all()
					->pluck('last_name', 'id')
					->prepend('Please select', ''),
				'employees' => \App\Employee::get()
					->pluck('first_name', 'id')
					->prepend('Please select', ''),
			];
		}
		else
		{
			$relations = [
				
				'clients' => \App\Client::where('email',Auth::user()['email'])
					->pluck('last_name', 'id')
					->prepend('Please select', ''),
				'employees' => \App\Employee::get()
					->pluck('first_name', 'id')
					->prepend('Please select', ''),
			];
		}
		
        

        return view('admin.appointments.create', $relations);
    }

    /**
     * Store a newly created Appointment in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentsRequest $request)
    {
//        if (! Gate::allows('appointment_create')) {
//            return abort(401);
//        }
	
        $appointment = new Appointment();
        $appointment->start_time = $request->input('date'). ' ' .$request->input('start_time');
        $appointment->finish_time = $request->input('date'). ' '.$request->input('finish_time');
        $appointment->comments = $request->input('comments');
        $appointment->client_id = $request->input('client_id');
        $appointment->employee_id = $request->input('employee_id');
        $appointment->created_at = Carbon::now();
		$appointment->save();

        return redirect()->route('admin.appointments.index');
    }


    /**
     * Show the form for editing Appointment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        if (! Gate::allows('appointment_edit')) {
//            return abort(401);
//        }
        $relations = [
            'clients' => \App\Client::get()->pluck('first_name', 'id')->prepend('Please select', ''),
            'employees' => \App\Employee::get()->pluck('first_name', 'id')->prepend('Please select', ''),
        ];

        $appointment = Appointment::findOrFail($id);

        return view('admin.appointments.edit', compact('appointment') + $relations);
    }

    /**
     * Update Appointment in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentsRequest $request, $id)
    {
//        if (! Gate::allows('appointment_edit')) {
//            return abort(401);
//        }
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());



        return redirect()->route('admin.appointments.index');
    }


    /**
     * Display Appointment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        if (! Gate::allows('appointment_view')) {
//            return abort(401);
//        }
        $relations = [
            'clients' => \App\Client::get()->pluck('first_name', 'id')->prepend('Please select', ''),
            'employees' => \App\Employee::get()->pluck('first_name', 'id')->prepend('Please select', ''),
        ];

        $appointment = Appointment::findOrFail($id);

        return view('admin.appointments.show', compact('appointment') + $relations);
    }


    /**
     * Remove Appointment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        if (! Gate::allows('appointment_delete')) {
//            return abort(401);
//        }
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.appointments.index');
    }

    /**
     * Delete all selected Appointment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
//        if (! Gate::allows('appointment_delete')) {
//            return abort(401);
//        }
        if ($request->input('ids')) {
            $entries = Appointment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
