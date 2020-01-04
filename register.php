<?php
require_once 'core/init.php';

if(Input::exists()){
	if (Token::check(Input::get('token'))) {
		
		$validate=new Validate();
		$validation=$validate->check($_POST, array(
			'username'=>array(
				'required'=>true,
				'min'=>2,
				'max'=>20,
				'unique'=>'users'
			),
			'password'=>array(
				'required'=>true,
				'min'=>8			
			),
			'password_again'=>array(
				'required'=>true,
				'matches'=>'password'
			),
			'name'=>array(
				'required'=>true,
				'min'=>2,
				'max'=>20
			)
		));

		if ($validation->passed()) {
			$user= new User();

			$salt=Hash::salt(32);
			try {

				$user->create(array(
				'username'=>Input::get('username'),
				'password'=>Hash::make(Input::get('password'),$salt),
				'salt'=>$salt,
				'name'=>Input::get('name'),
				'joined'=>date('Y-m-d H:i:s'),
				'group'=>1
			));
			Session::flash('home', 'You have registered successfully!');
			Redirect::to('index.php');
			} catch (Exception $e) {
				die($e->getMessage());
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
	<label for="password_again">Confirm Password</label>
	<input type="password" name="password_again" id="password_again">
	</div>
	<div class="field">
	<label for="name">Name</label>
	<input type="text" name="name" id="name" value="<?php echo Input::get('name') ?>">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="submit">
</form>
</body>
</html>
