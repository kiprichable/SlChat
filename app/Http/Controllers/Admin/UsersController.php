<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Client;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
	
	public function __construct()
	{
		$user = \Auth::user();
		
		View::share('user_level', $user);
	}
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (! Gate::allows('user_access')) {
//            return abort(401);
//        }
	
		if(\Auth::user()['role_id'] == '1')
		{
			$users = User::all();
		}
		else
		{
			$users = User::where('email',\Auth::user()['email'])->get();
		}

     

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if (! Gate::allows('user_create')) {
//            return abort(401);
//        }
		
		if(Auth::guest())
		{
			$relations = [
				'roles' => \App\Role::where('id','!=','1')->pluck('title', 'id')->prepend('Please select', ''),
			];
			
		}
		else
		{
			if(\Auth::user()['role_id'] == '1')
			{
				$relations = [
					'roles' => \App\Role::get()->pluck('title', 'id')->prepend('Please select', ''),
				];
			}
			else
			{
				$relations = [
					'roles' => \App\Role::where('id','!=','1')->pluck('title', 'id')->prepend('Please select', ''),
				];
			}
			
			
		}
	
       
		

        return view('admin.users.create', $relations);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
		
		$user = User::firstOrCreate(['email' => $request->input('email')]);
		$user->first_name = $request->input('first_name');
		$user->last_name = $request->input('last_name');
		$user->email = $request->input('email');
		$user->role_id = $request->input('role_id');
		$user->password = Hash::make($request->input('password'));
		$user->created_at = Carbon::now();
		$user->save();
        	
        if($request->input('role_id') == '3')
		{
			$client = Client::firstOrCreate(['email' => $request->input('email')]);
			$client->first_name = $request->input('first_name');
			$client->last_name = $request->input('last_name');
			$client->email = $request->input('email');
			$client->city = $request->input('city');
			$client->state = $request->input('state');
			$client->additional_family = $request->input('members');
			$client->additional_names = $request->input('names');
			$client->age = $request->input('age');
			$client->veteran = $request->input('veteran');
			$client->dd214 = $request->input('dd214');
			$client->last_night_residence = $request->input('lastnight');
			$client->created_at = Carbon::now();
			$client->save();
			
			
		}
		else
		{
			$employee = Employee::firstOrCreate(['email' => $request->input('email')]);
			$employee->first_name = $request->input('first_name');
			$employee->last_name = $request->input('last_name');
			$employee->email = $request->input('email');
			$employee->created_at = Carbon::now();
			$employee->save();
		}
		
        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $relations = [
            'roles' => \App\Role::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user') + $relations);
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->update($request->all());



        return redirect()->route('admin.users.index');
    }


    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_view')) {
            return abort(401);
        }
        $relations = [
            'roles' => \App\Role::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user') + $relations);
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
