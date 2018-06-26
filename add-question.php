<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Adicionar Perguntas</title>
<link rel="icon" href="img/home.png" type="image/x-icon" />
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
	     <li><a href="questions_answers.php">Perguntas e respostas</a></li>
	     <li><a href="answers_users.php">Respostas de Usuários</a></li>			 
             <li><a href="quiz_destroy.php">Voltar ao topo</a></li>
          </ul>
       </div>
    </nav>
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
		<?php if(isset($message)): ?> 
		<br>
		<div class="alert <?=$alertBoxClass?>">
		<?=$message?>
		</div>
		<?php endif; ?>
			<h1>Adicionar nova pergunta.</h1>
			<form class="form" method="POST">
				<textarea name="question_body" class="form-control" rows="2" required placeholder="Coloque aqui sua pergunta"></textarea>
				<hr>
				<h2>Digite e marque a resposta correta.</h2>
				<?php for($i=0; $i<4; $i++): ?>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<input type="radio" name="correct" required value="<?=$i?>">
							</span>
							<input type="text" class="form-control" placeholder=" Digite a resposta" required name="question_option[<?=$i?>]" id="opt<?=$i?>">
							<span class="input-group-addon btn btn-danger clear-text" data-inp="opt<?=$i?>">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</span>
						</div>
					</div>
				<?php endfor; ?>
	
				<button name="search" class="btn btn-default" >Adicionar pergunta</button>
			</form>
		</div>
	</div>
<script>
	
		$(document).ready(function(){
			//	
			$(".clear-text").click(function(e){
				$("#" + $(this).data('inp')).val("");
			});
		});
</script>
<?php
require "inc/init.php";

if ($_SESSION['user'] !== 'trezo')
{

	echo("<script type='text/javascript'> bootbox.alert(' Usuário não autorizado!!');window.location.href='quiz_destroy.php';</script>");

}

/**

* usaremos este arquivo para adicionar novas questões ao seu banco de dados *

*/

if(isset($_POST['search']))
{
	
	try{
	
		$connection->beginTransaction(); 

		$addQuestionQuery = $connection->prepare("INSERT INTO questions (questions.body,questions.created_at) VALUES (?,NOW())");

		$questionBody = trim(strip_tags($_POST['question_body']));

		$isQuestionAdded = $addQuestionQuery->execute(array($questionBody));

		$questionId = $connection->lastInsertId();

		$rightAnswerId = NULL;

		//estamos preparando nossa consulta para adicionar cada opção
		$addQuestionOptionQuery = $connection->prepare("INSERT INTO question_options (question_options.question_id, question_options.body,question_options.created_at) VALUES (?, ?,NOW())");

		//Vamos percorrer as respostas do POST e adicionar cada uma delas


		foreach ($_POST['question_option'] as $key => $value) 
		{

			//nós enviamos o valor da opção relevante como o parâmetro de consulta preparado e estamos executando
			$addQuestionOptionQuery->execute(array($questionId, $value));

			//Se esta opção for especificada como verdadeira, então nós escrevemos o valor id desta opção até o final, porque nós iremos atualizar a pergunta com o valor id da resposta correta.
              

			if($_POST['correct']==$key ) 
			{
				$rightAnswerId = $connection->lastInsertId();
				
			}

		}
   

	//	todas as respostas adicionadas, agora vamos escrever o ID da resposta correta ao lado da pergunta
        $body = $_POST['correct'];
		
        $description_options = $_POST['question_option'][$body];
		
	$update = $connection->exec("UPDATE questions SET answer_id = $rightAnswerId ,description_options = '$description_options' WHERE id = $questionId");

	//garantimos que as consultas ao banco de dados sejam processadas no banco de dados.
	$connection->commit();

        echo("<script type='text/javascript'> bootbox.alert(' Pergunta Adicionada com sucesso!!');</script>");	

	
	} 
	catch( PDOException $e )
	{
	//	Se ocorreu uma exceção de PDO (se o erro ocorreu), rebobinamos as alterações feitas no banco de dados a essa falha
	$connection->rollback();
	echo("<script type='text/javascript'> bootbox.alert(' Nenhuma Pergunta Adicionada!!');</script>");
            // echo 'Exceção capturada: ',  $e->getMessage(), "\n";
	}
}

?>
</body>
</html>
