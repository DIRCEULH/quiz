<?php
require_once "inc/init.php";


if(!isset($_SESSION['completed_at'])) 
{
	header("Location: quiz.php");
	die();
}
// realiza update na tabela do  usuario e insere a data e hora final do teste
updateUser($connection);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Resultados</title>
	<link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.min.js" ></script>
    <script type="text/javascript" src="js/bootbox.min.js" ></script> 
    <script type="text/javascript" src="js/bootstrap.min.js" ></script></head>
<body style="font-family:verdana;">
<nav class="navbar navbar-default">
       <div class="container-fluid">
          <ul class="nav navbar-nav">
             <li class="active"><a href="index.php">Quiz</a></li>
             <li><a href="add-question.php">Administrador</a></li>
             <li><a href="quiz_destroy.php">Voltar ao topo</a></li>
          </ul>
       </div>
</nav>
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<h1>Resultados</h1>
			<p>De <?=$_SESSION['total_questions_count']?> Questões: <strong><?=$_SESSION['correct_answers_count']?></strong> você respondeu corretamente!</p>
			<p>Você completou em <?=($_SESSION['completed_at']-$_SESSION['started_at'])?> segundos</p>

			<a href="details.php" class="btn btn-default btn-lg btn-block">Ver detalhes</a>

		</div>
	</div>
</body>
</html>