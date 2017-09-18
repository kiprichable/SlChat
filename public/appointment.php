<?php
	include('../config.php');
	$query = $_POST;
	$fname = $query['fname'];
	$lname = $query['lname'];
	$city = $query['city'];
	$state = $query['state'];
	$contact= $query['contact'];
	$members = $query['members'];
	$age = $query['age'];
	$dd214 = $query['dd214'];
	$veteran = $query['veteran'];
	$names = $query['names'];
	$stay = $query['stay'];
	$date = $query['date'];
	$startTime = date('H:i:s', strtotime($query['start']));
	$end_time = date('H:i:s', strtotime("+30 minutes", strtotime($startTime)));
	

##########################################################################################################
//SQL Queries
##########################################################################################################

##Event with the same date and time
	$appointmentExistsSQL = "SELECT * FROM app_appointments
                                 WHERE date = '$date'
                                 AND start_time >= '$startTime'
                                 AND start_time <= '$end_time'
                                 AND is_deleted <> 'Y'";

##Existing client record
	$clientSQL = "SELECT * FROM app_clients
                                WHERE first_name = '$fname'
                                AND last_name ='$lname'";
	
	$takenTimes = "SELECT * FROM app_appointments
                                 WHERE date = '$date'
                                 AND is_deleted <> 'Y'";


##insert client query
	$insertClientSQL = "INSERT INTO app_clients (first_name,last_name,city,state,contact,additional_family,additional_names,age,veteran, dd214,last_night_residence)
                        VALUES ('$fname','$lname','$city','$state','$contact','$members','$names','$age','$veteran','$dd214','$stay')";

###get the confirmation number
	$length = 6;
	$str = "";
	$characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++)
	{
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	$confirmation = $str;

##########################################################################################################
//STEP 0: controls
##########################################################################################################
	if ($date == '')
	{
		echo 'Date is required <br>';
	}
	if (date('l', strtotime($date)) == 'Tuesday' || date('l', strtotime($date)) == 'Thursday')
	{
		if ($fname != '' && $lname != '' && $city != '' && $state != '' && $date != '')
		{
			##########################################################################################################
			//STEP 1: Check if the current client is in the database - if yes update them else create them
			##########################################################################################################
			$result = $conn->query($clientSQL);
			
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc())
				{
					$userID = $row["id"];
					
				}
				##update client query
				$updateSQL = "UPDATE app_clients SET first_name ='$fname',last_name='$lname',city ='$city', state ='$state',contact ='$contact',
                                        additional_family ='$members',additional_names ='$names',veteran ='$veteran',age ='$age',dd214 ='$dd214',
                                        last_night_residence ='$stay' WHERE id='$userID'";
				
				//update client
				if ($conn->query($updateSQL) === TRUE)
				{
					echo "Record updated<br>";
					
				} else
				{
					echo "Error: " . $updateSQL . "<br>" . $conn->error;
				}
			} else
			{
				//update client
				if ($conn->query($insertClientSQL) === TRUE)
				{
					echo '<label>' . $fname . ' ' . $lname . ' ' . ' You request has been received. <br>' . '</label>';
					
				} else
				{
					echo "Error: " . $updateSQL . "<br>" . $conn->error;
				}
			}
			
			
			##########################################################################################################
			//STEP 2 :: Create appointment - check if the client has an existing appointment - if yes inform else create new
			##########################################################################################################
			##Appointment query for existing appointment
			$appointmentSQL = "SELECT * FROM app_appointments
                                        WHERE user_id ='$userID'
                                        AND is_deleted <> 'Y'";
			
			
			
			$appointmentResults = $conn->query($appointmentSQL);
			
			
			if($appointmentResults->num_rows > 0)
			{
				
				$appdate = '';
				$appstart = '';
				$confirmation_number = '';
				$status = '';
				while ($row = $appointmentResults->fetch_assoc())
				{
					$appdate = $row['date'];
					$appstart = $row['start_time'];
					$status = $row["status"];

				}
			}
			else
				{
					
					$taken = $conn->query($takenTimes);
					
					$taken_T = array();
					while ($row = $taken->fetch_assoc())
					{
						$start_time = $row['start_time'];
						$endtime = $row['end_time'];
						
						
						if($startTime >= $start_time && $startTime <= $endtime)
						{
							$taken_T[] = $start_time .' - '. $endtime;
						}
						
					}
					
					if($taken_T)
					{
						
						echo '<label>' . $fname . ' ' . $lname . ' ' . 'The time you selected has been booked on ' . $date . '
                                        .Please select another time not between these times ['.implode(",",$taken_T).'] that will work for
                                         you and try again<br>' .
							 '</label>';
					}
					else
					{
						$result = $conn->query($clientSQL);
						
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$userID = $row["id"];
								
							}
						}
						
						##insert appointment query
						$insertAppointmentSQL = "INSERT INTO app_appointments(user_id,date,start_time,end_time,confirmation,status,is_deleted)
                                                        VALUES ('$userID','$date','$startTime','$end_time','$confirmation','pending','N')";
						
						//insert appointment
						if ($conn->query($insertAppointmentSQL) === TRUE)
						{
							echo '<label>' . $fname . ' ' . $lname . ' ' . ' your appointment request was successful.
                                                Please use this ' . $confirmation . ' confirmation code to check the status of your request. <br>' . '</label>';
							
						}
						else
						{
							
							echo "Error: " . $insertAppointmentSQL . "<br>" . $conn->error;
						}
					}
					
				}
			}
			else
			{
				if ($fname == '')
				{
					echo 'First Name is required <br>';
				}
				
				if ($lname == '')
				{
					echo 'Last Name is required <br>';
				}
				if ($city == '')
				{
					echo 'City is required <br>';
				}
				
				if ($state == '')
				{
					echo 'State is required <br>';
				}
				if ($contact == '')
				{
					echo 'Contact is required <br>';
				}
			}
		}
		else
		{
			echo 'Appointments request can only be made for Tuesday and Thursday <br>';
		}






?>