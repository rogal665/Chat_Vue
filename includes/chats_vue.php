<?php 
	
	$arr['userid'] = "null";
	if(isset($DATA_OBJ->find->userid)){

		$arr['userid'] = $DATA_OBJ->find->userid;
	}

	$refresh = false;
	$seen = false;
	if($DATA_OBJ->data_type == "chats_refresh_vue"){
		$refresh = true;
		$seen = $DATA_OBJ->find->seen;
	}

	$sql = "select * from users where userid = :userid limit 1";
	$result = $DB->read($sql,$arr);

	if(is_array($result)){

		//user found
 		$row = $result[0];

 				$image = ($row->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
  				if(file_exists($row->image)){
  					$image = $row->image;
  				}

  				$row->image = $image;

  				$mydata = "";
  				
				$messages[] = new stdClass;
				$new_message = false;

				
		 					//read from db
 							$a['sender'] = $_SESSION['userid'];
 							$a['receiver'] = $arr['userid'];

							$sql = "select * from messages where (sender = :sender && receiver = :receiver && deleted_sender = 0) || (receiver = :sender && sender = :receiver && deleted_receiver = 0) order by id desc limit 10";
							$result2 = $DB->read($sql,$a);

							if(is_array($result2)){

								$result2 = array_reverse($result2);
 								foreach ($result2 as $data) {
									# code...
									$myuser = $DB->get_user($data->sender);
									
									//check for new messages
									if($data->receiver == $_SESSION['userid'] && $data->received == 0){
										$new_message = true;
									}

									if($data->receiver == $_SESSION['userid'] && $data->received == 1 && $seen){
										$DB->write("update messages set seen = 1 where id = '$data->id' limit 1");
									}

									if($data->receiver == $_SESSION['userid']){
										$DB->write("update messages set received = 1 where id = '$data->id' limit 1");
									}

 									if($_SESSION['userid'] == $data->sender){
										$messages[] = message_right($data,$myuser);
									}else{
										$messages[] = message_left($data,$myuser);
									}
								}
							}

				



		$info->user = $mydata;
		$info->messages = $messages;
		$info->new_message = $new_message;
		$info->data_type = "chats";
		if($refresh){
			$info->data_type = "chats_refresh";
			
		}
		echo json_encode($info);
 
	}else{

		//user found
		$row = $result[0];

		$image = ($row->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
		 if(file_exists($row->image)){
			 $image = $row->image;
		 }

		 $row->image = $image;

		 $mydata = "";
		
	   
	   $messages[] = new stdClass;
	   $new_message = false;

	   
					//read from db
					$a['sender'] = $_SESSION['userid'];
					$a['receiver'] = $arr['userid'];

				   $sql = "select * from messages where (sender = :sender && receiver = :receiver && deleted_sender = 0) || (receiver = :sender && sender = :receiver && deleted_receiver = 0) order by id desc limit 10";
				   $result2 = $DB->read($sql,$a);

				   if(is_array($result2)){

					   $result2 = array_reverse($result2);
						foreach ($result2 as $data) {
						   # code...
						   $myuser = $DB->get_user($data->sender);
						   
						   //check for new messages
						   if($data->receiver == $_SESSION['userid'] && $data->received == 0){
							   $new_message = true;
						   }

						   if($data->receiver == $_SESSION['userid'] && $data->received == 1 && $seen){
							   $DB->write("update messages set seen = 1 where id = '$data->id' limit 1");
						   }

						   if($data->receiver == $_SESSION['userid']){
							   $DB->write("update messages set received = 1 where id = '$data->id' limit 1");
						   }

							if($_SESSION['userid'] == $data->sender){
							   $messages[] = message_right($data,$myuser);
						   }else{
							   $messages[] = message_left($data,$myuser);
						   }
					   }
				   }

	   



		$info->user = $mydata;
		$info->messages = $messages;
		$info->new_message = $new_message;
		$info->data_type = "chats";
		if($refresh){
		$info->data_type = "chats_refresh";
		
		}
		echo json_encode($info);
	}

	

?>