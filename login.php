<?php
require 'core/init.php';
if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate= new Validate();
		$validation=$validate->check($_POST, array(
			'username'=>array('required'=>true),
			'password'=>array('required'=>true)
		));

		if($validation->passed()){
			$user= new User();
			$remember=(Input::get('remember')==='on') ? true : false;
			$login=$user->login(Input::get('username'), Input::get('password'),$remember);
			if($login){
				Redirect::to('index.php');

			}else{
				echo "Sorry you can not Login";
			}
		}
		else{
			foreach ($validation->errors() as $error) {
				echo $error . '<br>';
			}
		}
	}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<form action="" method="post">
	<div class="field">
	<label for="Username">Username</label>
	<input type="text" id="Username" name="username" value="<?php echo Input::get('username') ?>">
	</div>
	<div class="field">
	<label for="password">Password</label>
	<input type="password" name="password" id="password">
	</div>
	<div class="field">
		<label for="remember">
			<input type="checkbox" name="remember" id="remember"> Remember me
		</label>
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="submit">
</form>
</body>
</html>