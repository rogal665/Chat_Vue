<?php 
	
	$myid = $_SESSION['userid'];
	$sql = "select * from users where userid != '$myid' limit 10";
	$myusers = $DB->read($sql,[]);

	$mydatauser = (Object)[];
	class User
	{
		public $userid;
		public $src;
		public $username;
		public $msgs;
	}
	$mydata[] = new stdClass;
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

			$i = 0;
			foreach ($myusers as $row) {
  				
  				$image = ($row->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
  				if(file_exists($row->image)){
  					$image = $row->image;
  				}
				
				$mydata[$i] = new User();
				$mydata[$i]-> userid=$row->userid;
				$mydata[$i]-> src=$image;
				$mydata[$i]-> username=$row->username;
				


				//$mydatauser->userid=$row->userid;
				//$mydatauser->src=$image;
				//$mydatauser->username=$row->username;

					if(count($msgs) > 0 && isset($msgs[$row->userid])){
						//$mydatauser->$msgs[$row->userid];
						$mydata[$i]-> msgs=$msgs[$row->userid];
					}

				//$mydata[0] = new $mydatauser();
				$i = $i+1;
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
