<?php 
if(eregi('users.php', $_SERVER['PHP_SELF'])) {
	header("Location: ./");
	exit();
}

function hasAccess($user_id, $type){
	$user_id = (int)$user_id;
	$type 	 = (int)$type;
	
	return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE user_id='$user_id' AND type=$type"), 0) == 1) ? true : false;
}


function gantiSampulProfil($user_id, $fileTmp, $fileExtn) {
	$pathFile = sanitize('images/profile/'.substr(date('d_m_y-').(time()), 0). '.' .$fileExtn);
	mysql_query("UPDATE users SET img='$pathFile' WHERE user_id=$user_id");

	move_uploaded_file($fileTmp, $pathFile);
}

function recover($email) {
	$email = sanitize($email);
	$password = substr(str_shuffle('RISKYMUAJISETYAPRANA1893'), 0, 7);
	email($email , 'Lupa Password Lan\'s Musik Studio', "Dear {$email}, \n\nKami telah memulihkan akun kamu di Lan's Musik Studio.\n Silahkan login dengan password: {$password}\n\nSegera ganti password kamu setelah logn.\n~Lan's Musik Studio");

	return (mysql_query("UPDATE users SET password=sha1('$password') WHERE email='$email'")) ? true : false;

}

function updateUser($updateData) {
	$update = array();
	array_walk($updateData, 'arraySanitize');

	foreach ($updateData as $field=>$data) {
		$update[] = "{$field}='{$data}'";
	}
	$userData = implode(', ', $update);
	$user_id = (int)$_SESSION['user_id'];
	return (mysql_query("UPDATE users SET $userData WHERE user_id=$user_id")) ? true : false;
}

function activate($email, $email_code) {
	$email 		= sanitize($email);
	$email_code = sanitize($email_code);
	if(mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE email='$email' AND email_code='$email_code'"), 0) == 1) {
		mysql_query("UPDATE users SET active=1 WHERE email='$email' AND email_code='$email_code'");
		return true;
	} else {
		return false;
	}
}

function gantiPass($user_id, $password) {
	$user_id  = (int)$user_id;
	$password = sha1(sanitize($password));

	return (mysql_query("UPDATE users SET password='$password' WHERE user_id=$user_id")) ? true : false;
}

function registerUser($registerData) {
	$registerData['password'] = sha1($registerData['password']);
	$fields = implode(', ', array_keys($registerData));
	$data 	= '\''. implode('\', \'', $registerData) .'\'';

	email($registerData['email'], 'Aktivasi akun Lan\'s Musik Studio', "Dear ". $registerData['email'] .", \n\nAnda baru saja bergabung untuk menjadi member di Lan's Musik Studio. \nUntuk mengkonfirmasi bahwa email ini adalah email Anda, silahkan klik link berikut:\n\nhttp://localhost/myproject/Lan's Musikstudio/activate.php?email=". $registerData['email'] ."&email_code=". $registerData['email_code'] ." \n\n Jika Anda merasa tidak pernah mendaftarkan akun di Lan's Musik Studio, mohon abaikan email ini. \n\n ~Lan's Musik Studio");
	return (mysql_query("INSERT INTO users ($fields) VALUES ($data)")) ? true : false;
}

function userData($user_id) {
	$data 	 = array();
	$user_id = (int)$user_id;

	$funcNumArgs = func_num_args();
	$funcGetArgs = func_get_args();

	if($funcNumArgs > 1){
		unset($funcGetArgs[0]);
		$fields = implode(', ', $funcGetArgs);
		$data 	= mysql_fetch_assoc(mysql_query("SELECT $fields FROM users WHERE user_id=$user_id"));
	}
	return $data;
}

function loggedIn() {
	return (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) ? true : false;
}

function emailExists($email) {
	$email = sanitize($email);
	return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE email='$email'"), 0) == 1) ? true : false;
}

function usernameExists($username) {
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE username='$username'"), 0) == 1) ? true : false;
}

function userActive($email) {
	return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE email='$email' AND active=1"), 0) == 1) ? true : false;
}

function user_id($email) {
	$email = sanitize($email);
	return mysql_result(mysql_query("SELECT user_id FROM users WHERE email='$email' or username='$email'"), 0, 'user_id');
}

function login($email, $password) {
	$user_id  = user_id($email);
	$email 	  = sanitize($email);
	$password = sha1($password);
	return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE email='$email' AND password='$password'"), 0) == 1) ? $user_id : false;
}