<?php 
require 'inc/init.php';

$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)):


	$sql = 'SELECT id, hits, error, created_at, finalized_at,user FROM answer_user';
	$stm = $connection->prepare($sql);
	$stm->execute();
	$data_result = $stm->fetchAll(PDO::FETCH_OBJ);

else:
	// Executa uma consulta baseada no termo de pesquisa passado como parâmetro

	$sql = 'SELECT id, hits, error, created_at, finalized_at,user FROM answer_user WHERE user LIKE :user or hits LIKE :hits ';
	$stm = $connection->prepare($sql);
	$stm->bindValue(':user', $termo.'%');
	$stm->bindValue(':hits', $termo.'%');
	$stm->execute();
	$data_result = $stm->fetchAll(PDO::FETCH_OBJ);
endif;

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

<body style="font-family:verdana;">
    <nav class="navbar navbar-default">
       <div class="container-fluid">
          <ul class="nav navbar-nav">
             <li class="active"><a href="index.php">Quiz</a></li>
             <li><a href="add-question.php">Cadastro de perguntas</a></li>
			 <li><a href="questions_answers.php">Perguntas e respostas</a></li>
			 <li><a href="answers_users.php">Respostas de users</a></li>			 
             <li><a href="quiz_destroy.php">Voltar ao topo</a></li>
          </ul>
       </div>
    </nav>
<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <input  style="min-width:250px;" class="form-control mr-sm-2" type="search" placeholder="Pesquisar por usuários e acertos"  name="termo"  aria-label="Search">
    <button class="btn btn-outline-default my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar</button>
  </form>
</nav>


<table class="table table-bordered">
  <tr >
    <th>Usuário</th>
    <th>Acertos</th>
    <th>Erros</th>
    <th>Realizado em</th>
    <th>Finalizado em</th>
	<th>Finalalizou em</th>
	<th>Detalhes</th>

  </tr>
<?php foreach($data_result as $data){ 

 $finalized_at = $data->finalized_at;
 $created_at = $data->created_at;
 $date_time  = new DateTime($created_at);
 $diff       = $date_time->diff( new DateTime($finalized_at));

?>
  <tr>
    <td><?=$data->user?></td>
    <td><?=$data->hits?></td>
    <td><?=$data->error?></td>
	<td><?= date("d/m/Y H:i:s", strtotime($data->created_at)); ?></td>
	<td><?= date("d/m/Y H:i:s", strtotime($data->finalized_at)); ?></td>
    <td><?=$diff->format('%s segundo(s)');?></td>
	<td><a  href="details_adm.php?user=<?=$data->user?>" class="btn btn-success">Detalhes <i class="fa fa-sign-in" aria-hidden="true"></i> </a></td>

  </tr>
<?php }	?>		
</table>
</body>
</html>