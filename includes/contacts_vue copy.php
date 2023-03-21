<?php 
	
	$myid = $_SESSION['userid'];
	$sql = "select * from users where userid != '$myid' limit 10";
	$myusers = $DB->read($sql,[]);

	$mydata =(Object)[];
		
		if(is_array($myusers)){

			//check for new messages
			$msgs = array();
			$me = $_SESSION['userid'];
			$query = "select * from messages where receiver = '$me' && received = 0";
			$mymgs = $DB->read($query,[]);

			if(is_array($mymgs)){

				foreach ($mymgs as $row2) {
					$sender = $row2->sender;

					if(isset($msgs[$sender])){
						$msgs[$sender]++;
					}else{
 						$msgs[$sender] = 1;
					}
				}
			}

			foreach ($myusers as $row) {
  				
  				$image = ($row->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
  				if(file_exists($row->image)){
  					$image = $row->image;
  				}
 
				$mydata .= "
				userid='$row->userid'
					src='$image'
					$row->username";

					if(count($msgs) > 0 && isset($msgs[$row->userid])){
						$mydata .= $msgs[$row->userid];
					}

				
			}
		}
 
 	

	//$result = $result[0];
	$info->message = $mydata;
	$info->data_type = "contacts";
	echo json_encode($info);

	die;

	$info->message = "No contacts were found";
	$info->data_type = "error";
	echo json_encode($info);

?>
