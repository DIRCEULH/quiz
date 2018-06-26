<?php

require_once "inc/init.php";

// conta quantas questões esdtão cadastradas
$questionsCount = $connection->query("SELECT COUNT(id) as count FROM questions")->fetch();

// verifica se o usuario finalizou ou nao as questões
$validUser = $connection->query("SELECT finalized_at FROM answer_user WHERE user = '".$_SESSION['user']."'")->fetch();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Bem Vindo ao Quiz</title>
<link rel="icon" href="img/home.png" type="image/x-icon" />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/bootbox.min.js" ></script> 
<script type="text/javascript" src="js/bootstrap.min.js" ></script>

</head>
<body style="font-family:verdana;">

    <nav class="navbar navbar-default">
       <div class="container-fluid">
          <ul class="nav navbar-nav">
             <li class="active"><a href="index.php">Quiz</a></li>
             <li><a href="add-question.php">Administrador</a></li>
			 	<?php
	            if ($validUser['finalized_at'] !== null)
	            { ?>
             <li><a href="details.php">Detalhes</a></li>
			    <?php } ?>
             <li><a href="quiz_destroy.php">Voltar ao topo</a></li>
          </ul>
       </div>
    </nav>
	<?php
	if ($validUser['finalized_at'] == null)
	{ ?>
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<h1>Bem vindo ao teste</h1>
			<p>Em breve você vai enfrentar <?=$questionsCount['count']?> perguntas</p>
		<a href='start.php' class="btn btn-default btn-lg btn-block">Iniciar Teste  <i class="fa fa-sign-in" aria-hidden="true"></i> </a>
		</div>
	</div>
	<?php } 
	else
	{
	echo("<div class='alert alert-danger' role='alert'>Usuário já realizou o teste!! </div>");

	} ?>
	
</body>
</html>