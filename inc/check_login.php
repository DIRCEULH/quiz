<?php
//session_start();

if ($_SESSION['login']!='ok')
{
	
	
	$msg='<p class="alert alert-warning"> você não está logado!! </p>';
	header('location:login.php?mens='.$msg);
	
}
	if (isset($_SESSION['start']))
	{
		$tempodecorrido= time()- $_SESSION['start'];
		if( $tempodecorrido> $_SESSION['life']){
			session_destroy();
			$msg= '<p class= "alert alert-warning">A sua sessão expirou!!</p>';
			header('location:login.php?mens='.$msg);
			
		}//posso dar mais 600 seg
		else
		{
			$_SESSION['start']= time();
			session_regenerate_id(true);//requinte de crueldade
			
			
		}
		
	
	}
	else
	{
		
		print_r($error);
		$msg= '<p class= "alert alert-warning">Você não está logado!!</p>';
			header('location:login.php?mens='.$msg);
	}



?>