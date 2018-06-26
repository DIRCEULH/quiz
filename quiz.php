<?php
require_once('inc/init.php');
// inicia as o teste e rediciona
redirectIfNotStarted();

checkAnswer($connection);

//precisamos trazer a próxima pergunta e mostrá-la na tela
$question = getRandomQuestion($connection);

//de acordo com o que não recebemos novas perguntas, todas respondidas, encerramos o teste
if( ! $question ) endQuiz();




?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Teste</title>
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
             <li><a href="quiz_destroy.php">Voltar ao topo</a></li>
          </ul>
       </div>
    </nav>
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<form method="post" class="form">
				<h1><?=$question->body?></h1>
				<p><small><?=count($_SESSION['answered_questions'])?> / <?=$_SESSION['total_questions_count']?></small></p>
				<?php foreach($connection->query("SELECT * FROM question_options WHERE question_id = $question->id ORDER BY RAND()") as $option ): ?>
					<input type="radio" name="answer" value="<?=$option['id']?>" id="opt<?=$option['id']?>">
					<label for="opt<?=$option['id']?>"><?=$option['body']?></label><hr>
				<?php endforeach; ?>

				<input type="hidden" name="question_id" value="<?=$question->id?>">
				<button type="submit" class="btn btn-default btn-lg btn-block">Responder  <i class="fa fa-sign-in" aria-hidden="true"></i> </button>
			</form>
		</div>
	</div>
	

</body>
</html>