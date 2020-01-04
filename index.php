<?php
require_once 'core/init.php';

/*$user=DB::getInstance()->get('users', array('username', '=','billy'));*/

/*$userInsert=DB::getInstance()->update('users', 5,array(
	'username'=>'updateUsername',
	'password'=>'UpdatePassword',
	'name'=>'UpdateName'
	
));*/
/*
if(!$user->count()){
	echo "no user";
}
else{
	foreach($user->results() as $user){
		echo $user->name, '<br>';
	}
}*/
/*if($userInsert){
	echo "OK";
}else{
	echo "Could not insert";
}*/

if(Session::exists('home')){
	echo Session::flash('home');
}
$user= new User();

if($user->isLoggedIn()){?>
	<p>Hello <a href=""><?php echo escape($user->data()->username); ?> </a></p>
	<ul>
		<li><a href="logout.php">Log out</a></li>
		<li><a href="update.php">Update </a></li>
	</ul>
<?php
	if($user->hasPermission('admin')){
		echo "You are an adminstrator";
	} 
} else{
	echo 'You need to <a href="login.php">Login</a> or <a href="register.php"> register</a>';
}?>
