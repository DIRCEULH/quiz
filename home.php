<?php
require 'inc/connection.php';

	$sql = 'SELECT body FROM questions';
	$stm = $connection->prepare($sql);
	$stm->execute();
	$data_result = $stm->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dados</title>
	<link rel="icon" href="img/home.png" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" />
	<link href="css/font-awesome.min.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.min.js" ></script>
    <script type="text/javascript" src="js/bootstrap.min.js" ></script>
</head>

<body style="font-family:verdana;">
    <div class="container">
	<div class="jumbotron">

	<center><h3> Preparado para o Desafio?</h3></center>
	<center><h2>Quiz</h2></center>
	
<table class="table table-bordered"><br></br>
<center><h4>Perguntas</h4></center>
<?php foreach($data_result as $data)
{ 
?>
  <tr>
    <td><?=$data->body?></td>
  </tr>
<?php }	?>		
</table>
	<p><a class="btn btn-default btn-lg btn-block" href='login.php' role="button">Iniciar Teste <i class="fa fa-sign-in" aria-hidden="true"></i> </a></p>
    </div>
    </div>
</body>
</html>