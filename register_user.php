
<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>PHP Login Form</title>
<meta name="description" content="">
<link rel="icon" href="img/home.png" type="image/x-icon" />
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
         <form name="form_login" method="post" action="register_user.php" role="form">
                <fieldset>
             <h2 class="btn btn-lg btn-default btn-block">Cadastro de usuário <i class="fa fa-sign-in" aria-hidden="true"></i></h2>
             <hr class="colorgraph">
             <div class="input-group">
                <input name="user" type="email" required  class="form-control input-lg" placeholder="Usuário"> 
			    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>      
             </div></br></br>
            <div class="input-group">
               <input type="password" name="password" required  class="form-control input-lg" placeholder="Senha">
			   <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>  
            </div><hr class="colorgraph">          
            <div class="row">
               <div class="col-xs-6 col-sm-6 col-md-6">
                <button type="submit" name="search" value="Login" class="btn btn-lg btn-default btn-block">Cadastrar <i class="fa fa-sign-in" aria-hidden="true"></i></button>  
                </fieldset>
               </div>
           </div>
	     </form>
   </div>
  </div>
</div>  
</body>
</html>
<?php
require_once('inc/connection.php');


if(!empty($_POST['search']))
{
	
$user = $_POST['user'];
$password = $_POST['password'];


$error ='';
$ok ='';
$e ='';

if (empty($user))
{
	$error .= 'Usuário esta vazio';
}
if (empty($password))
{
	$error .= 'O password não pode estar vazio.';
}


$user = strip_tags (filter_var($user));
$password = strip_tags (filter_var($password));


if (!$user ){
	$error .= 'A user tem caracteres não permitidos.';
}
if (!$password){
	$error .= 'O password não é valido.';
}
    //faz a confirmação de que não existe  usuário cadastrado
    $sql = "SELECT user FROM user_admin WHERE user = '" . $user . "'   "; 
    $Query = $connection->prepare($sql);
    $Query->execute();
	$count = $Query->rowCount();
if ($count > 0){
	$error .= 'usuário já existe';
} 
try{
	if (!empty($error)){
		throw new Exception($e);
	}
  
	$sql =  "INSERT INTO user_admin (user,password,created_at) VALUES (?,?,NOW())";
    $insertion = $connection->prepare($sql);
    $ok = $insertion->execute(array($user,$password));
	}
	catch (PDOException $error)
	{
	$error .= $error->getMessage();

    }
	catch (Exception $e)
	{
	$error .= $e->getMessage();
    }
	finally
	{
	
	if (!$ok || !empty($error))
	{

	echo("<script type='text/javascript'> bootbox.alert('Erro na inclusão, $error'); </script>");

	}
	else
	{
	
	echo("<script type='text/javascript'> bootbox.alert('Usuário cadastrado com sucesso!!'); location.href='quiz_destroy.php'</script>");
	}
	
	}
		
}


?>
