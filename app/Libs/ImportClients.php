<?php
	
	namespace App\Libs;
	use App\Client;
	use Illuminate\Support\Facades\DB;
	
	
	class ImportClients
	{
		
		public function getClients()
		{
			$clients = DB::table('app_clients')->get();
			foreach($clients as $client)
			{
				$newClient = Client::firstOrCreate(['first_name' => $client->first_name,'last_name' =>
					$client->last_name]);
				$newClient->id = $client->id;
				$newClient->first_name = $client->first_name;
				if (!filter_var($client->contact, FILTER_VALIDATE_EMAIL)) {
					$newClient->phone = $client->contact;
				}
				else
				{
					$newClient->email = $client->contact;
					
				}
				$newClient->last_name = $client->last_name;
				$newClient->city = $client->city;
				$newClient->state = $client->state;
				$newClient->additional_family = $client->additional_family;
				$newClient->additional_names = $client->additional_names;
				$newClient->age = $client->age;
				$newClient->veteran = $client->veteran;
				$newClient->dd214 = $client->dd214;
				$newClient->last_night_residence =$client->last_night_residence;
				$newClient->created_at =$client->created_at;
				$newClient->save();
			}
		}
		
	}