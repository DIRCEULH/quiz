<?php 

require 'inc/init.php';


if (!empty($_GET['user']))
{
	$sql = "SELECT *FROM answer_user where user = '".$_GET['user']."' ORDER BY id DESC LIMIT 1";
	$stm = $connection->prepare($sql);
	$stm->execute();
	$data = $stm->fetchAll(PDO::FETCH_OBJ);
}
else
{
	echo("<script type='text/javascript'> bootbox.alert('Usuário não logado');</script>");
	header("Location: login.php");
}
if (!empty($_GET['user']))
{
	$sql = "SELECT *FROM questions";
	$stm = $connection->prepare($sql);
	$stm->execute();
	$data_result = $stm->fetchAll(PDO::FETCH_OBJ);
}
else
{
	echo("<script type='text/javascript'> bootbox.alert('Usuário não logado');</script>");
	header("Location: login.php");
}
if (!empty($_GET['user']))
{
	$sql = "SELECT  answers_id FROM answer_user_id where user = '".$_GET['user']."'";
	$stm = $connection->prepare($sql);
	$stm->execute();
	$data_resulter = $stm->fetchAll(PDO::FETCH_OBJ);

}
else
{
	echo("<script type='text/javascript'> bootbox.alert('Usuário não logado');</script>");
	header("Location: login.php");
}

if (!empty($_GET['user']))
{
		$sql = " SELECT *FROM answer_user_id e WHERE e.answers_id  NOT IN (SELECT answer_id FROM questions  ) and e.user = '".$_GET['user']."'";  
	$stm = $connection->prepare($sql);
	$stm->execute();
	$data_resul = $stm->fetchAll(PDO::FETCH_OBJ);


}
else
{
	echo("<script type='text/javascript'> bootbox.alert('Usuário não logado');</script>");
	header("Location: login.php");
}
?>
<!DOCTYPE HTML>
<html>
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
<body body style="font-family:verdana;">
    <nav class="navbar navbar-default">
       <div class="container-fluid">
          <ul class="nav navbar-nav">
             <li class="active"><a href="index.php">Quiz</a></li>
             <li><a href="add-question.php">Administrador</a></li>
			 <li><a href="questions_answers.php">Perguntas e respostas</a></li>
			 <li><a href="answers_users.php">Respostas de Usuários</a></li>			 
             <li><a href="quiz_destroy.php">Voltar ao topo</a></li>
          </ul>
       </div>
    </nav>
</nav>
<div class="container">
   <table class="table table-bordered">
		<tr >
				<th>Usuário</th>
				<th>Acertos</th>
				<th>Erros</th>
				<th>Teste iniciado em</th>
				<th>Teste terminado em</th>
				<th>Realizado em</th>				

		</tr>
<?php foreach($data as $d){ 
 $finalized_at = $d->finalized_at;
 $created_at = $d->created_at;
 $date_time  = new DateTime($created_at);
 $diff       = $date_time->diff( new DateTime($finalized_at));
?>
		<tr>
			<td><?=$d->user?></td>		
			<td><?=$d->hits?></td>
			<td><?=$d->error?></td>
			<td><?= date("d/m/Y H:i:s", strtotime($d->created_at)); ?></td>
			<td><?= date("d/m/Y H:i:s", strtotime($d->finalized_at)); ?></td>
            <td><?=$diff->format('%s segundo(s)');?></td>
		</tr>
       <?php } ?>		
    </table>
</div>

<div class="container">
   <table class="table table-bordered">
		<tr >
				<th>Pergunta</th>
				<th>Resposta Correta</th>

        <?php foreach($data_result as $data){ ?>

		<tr>
			<td><?=$data->body?></td>
			<td><?=$data->description_options?></td>

		</tr>
       <?php } ?>		
    </table>
</div>

<div class="container">
   <table class="table table-bordered">
		<tr >

				<th>Perguntas que você acertou</th>
				<th>Sua Resposta</th>
        <?php foreach($data_resulter as $data_r){
            $sql = "SELECT  body,description_options FROM questions where answer_id = '".$data_r->answers_id. "'";
			$stm = $connection->prepare($sql);
	        $stm->execute();
	        $data_answer = $stm->fetchAll(PDO::FETCH_OBJ);
		?>
        </tr>
		<tr>
		 <?php foreach($data_answer as $data_a){?>
			<td><?=$data_a->body?></td>
			<td><?=$data_a->description_options?> <i class="fa fa-check"></i></td>
	
       <?php } ?>	
		</tr>
       <?php } ?>		
    </table>
</div>

<div class="container">
   <table class="table table-bordered">
		<tr >
				<th>Pergunta que você errou</th>
				<th>Sua resposta</th>

        <?php foreach ($data_resul as $e ){
            $sql = "SELECT  question_id , body FROM question_options where id = '".$e->answers_id."' ";
			$stm = $connection->prepare($sql);
	        $stm->execute();
	        $data_answer_not = $stm->fetchAll(PDO::FETCH_OBJ);
			?>
        </tr>
		<tr>
			<?php foreach($data_answer_not as $data_a_n)
			$sql = "SELECT  body FROM questions where id = '".$data_a_n->question_id."' ";
			$stm = $connection->prepare($sql);
	        $stm->execute();
	        $data_answer_question_not = $stm->fetchAll(PDO::FETCH_OBJ);
			{?>
			<?php foreach($data_answer_question_not as $data_a_q_n) { ?>
			<td><?=$data_a_q_n->body?></td>
			<?php } ?>
			<td><?=$data_a_n->body?> <i class="fa fa-close"></i></td>
       <?php } ?>
		</tr>
       <?php } ?>		
    </table>
</div>

</body>
</html>