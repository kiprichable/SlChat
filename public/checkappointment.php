<?php
	include('../config.php');
	$query = $_POST;
	
	$confirmation= $query['confirmation'];
	
	
	
	$db = mysqli_query($conn, "SELECT * FROM app_appointments WHERE confirmation = '$confirmation'");
	$rows = mysqli_num_rows($db);
	if($rows == 0)
	{
		echo '<label>No Results for ' . $confirmation.'<br>'.'</label>';
	}
	else
	{
		foreach($db as $appoint)
		{
			$date = $appoint['date'];
			$start = $appoint['start_time'];
			$status = $appoint['status'];
		}
		echo '<ion-list>
            <ion-item  class="item item-text-wrap">
                <div>
                    <h2>Appointment Details</h2>
                    <hr>
                        <p>Appointment status: ' . $status .'</p>
                                        <p>Day: ' .date('l', strtotime($date)) .'</p>
                                        <p>Date: ' . $date .'</p>
                                        <p>Time: ' . $start .'</p>
                                        <hr>
                                        <p>If you wish to cancel click cancel below</p>

                </div>
            </ion-item>
                </ion-list>';
	}