<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Login</title>
<meta name="description" content="">
<link rel="icon" href="img/login.png" type="image/x-icon" />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/bootbox.min.js" ></script> 
<script type="text/javascript" src="js/bootstrap.min.js" ></script>

</head>
<body style="font-family:verdana;">
<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form name="form_login" method="post" action="login.php" role="form">
        <fieldset>
          <h2 class="btn btn-lg btn-default btn-block">LOGIN <i class="fa fa-sign-in" aria-hidden="true"></i></h2>
          <hr class="colorgraph">

          <div class="input-group">
            <input name="user" type="text"  required class="form-control input-lg" placeholder="Usuário"> 
			<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>  
       
          </div></br></br>
          <div class="input-group">
            <input type="password" name="password"  required class="form-control input-lg" placeholder="Senha">
			<span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>  
			

          </div></br>
          <span class="button-checkbox">
          <a href="register_user.php" type="button" class="btn btn-default" data-color="info">Não possui usuário? Cadastre aqui <i class="fa fa-sign-in"></i></a>
          <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
          <hr class="colorgraph">
     <div class="row">
     <div class="col-xs-6 col-sm-6 col-md-6">
              <button type="submit" name="search" value="Login" class="btn btn-lg btn-default btn-block">Entrar <i class="fa fa-unlock-alt" aria-hidden="true"></i></button>  
        </fieldset>
      </form>
    </div>
   </div>
  </div>
 </div>
</div>
<?php
session_start();
error_reporting(0);
ini_set("display_errors", 0 );
require_once ('inc/connection.php');


    if (isset($_POST['search'])) 
    {   // só inicia a busca se clicar em 'entrar'

    if ((!empty($_POST['user'])) and (!empty($_POST['password']))) 
	{  // verifica se os campos são diferentes de vazio
     
    $user = trim($_POST['user']);
    $password = trim($_POST['password']);

    //faz a confirmação de nome e senha no bd
    $sql = "SELECT user, password FROM user_admin WHERE user = '" . $user . "' AND password = '" . $password . "'  "; 
    $Query = $connection->prepare($sql);
    $Query->execute();
    $data = $Query->fetchAll(PDO::FETCH_ASSOC);
	
	
	foreach ($data as $r) 
	{
			
	 $_SESSION['login'] = 'ok';
	 $_SESSION['user'] = $r['user'];
	 $_SESSION['start'] = time(); //carimbo de entrada no sistema
	 $_SESSION['life'] = 600; // 60s = 1min    //tempo de permanencia
	           
	header('location:index.php');	
		
	} 
	if ($user !== $r['user'] && $password !== $r['password']) 
	{	
	 echo("<script type='text/javascript'> bootbox.alert(' Usuário ou senha incorreto(a)!!');</script>");		 
    } 
    }
    }             
                                        
?> 
</body>
</html>
