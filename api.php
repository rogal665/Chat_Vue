<?php 

session_start();

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

$info = (object)[];

//check if logged in
if(!isset($_SESSION['userid']))
{

	if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != "login" && $DATA_OBJ->data_type != "signup")
	{
		
		$info->logged_in = false;
		echo json_encode($info);
		die;	
	}
	
}

require_once("classes/autoload.php");
$DB = new Database();

$Error = "";

//proccess the data
if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup")
{

	//signup
	include("includes/signup.php");

}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "login")
{
	//login
	include("includes/login.php");

}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "logout")
{
	include("includes/logout.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info")
{

	//user info
	include("includes/user_info.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "contacts")
{
	//user info
	include("includes/contacts.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "contacts_vue")
{
	//user info
	include("includes/contacts_vue.php");
}elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "chats" || $DATA_OBJ->data_type == "chats_refresh"))
{
	//user info
	include("includes/chats.php");
}elseif(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "chats_vue" || $DATA_OBJ->data_type == "chats_refresh_vue"))
{
	//user info
	include("includes/chats_vue.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "settings")
{
	//user info
	include("includes/settings.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "save_settings")
{
	//user info
	include("includes/save_settings.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_message")
{
	 //send message
	include("includes/send_message.php");
	
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_message_vue")
{
	 //send message
	include("includes/send_message_vue.php");
	
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_message")
{
	 //send message
	include("includes/delete_message.php");
}elseif(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_thread")
{
	 //send message
	include("includes/delete_thread.php");
}


function message_left($data,$row)
{
	$image = ($row->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
	if(file_exists($row->image)){
		$image = $row->image;
	}

	$a[] = new stdClass;
	
	$a[] = "$data->message";

		if($data->files != "" && file_exists($data->files)){
			
		}
		
	
	$a[] = $data->id;
	$a[] = $data->date;
	$a[] = 'left';
	if($data->files != "" && file_exists($data->files)){
		$a[] = $data->files;	
	}

	

	
	return $a;
}

function message_right($data,$row)
{
	$image = ($row->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
	if(file_exists($row->image)){
		$image = $row->image;
	}
	
	$a[] = new stdClass;
	
	
	

	$a[] = "$data->message";

		
		
	$a[] = $data->id;
	$a[] = $data->date;
	$a[] = 'right';
	if($data->files != "" && file_exists($data->files)){
		$a[] = $data->files;	
	}else{
		$a[] = null;
	}
	

	if($data->seen){
		$a[] = 'seen';
	}elseif($data->received){
		$a[] = 'received';
	}

	

	return $a;
}




