<?php 

require 'inc/init.php';

if (!empty($_SESSION['user']))
{
	$sql = "SELECT *FROM questions  ";
	$stm = $connection->prepare($sql);
	$stm->execute();
	$data = $stm->fetchAll(PDO::FETCH_OBJ);
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
<title>Perguntas</title>
<link rel="icon" href="img/home.png" type="image/x-icon" />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/bootbox.min.js" ></script> 
<script type="text/javascript" src="js/bootstrap.min.js" ></script></head>
</head>
<body style="font-family:verdana;">
<script>
function DeleteConfirm(id) {

	bootbox.confirm({
    message: "Atenção!! Ao excluir estas perguntas isto intervirá no relátório dos Usuários que já realizaram o teste das mesmas .Deseja remover esse registro mesmo assim?",
    buttons: {
        confirm: {
            label: 'Sim',
            className: 'btn-success'
        },
        cancel: {
            label: 'Não',
            className: 'btn-danger'
        }
    },
    callback: function (result)
	{
		if (result)
		{
        window.location.href = "delete.php?id="+id;
		}
    }
	
});
}
</script>
    <nav class="navbar navbar-default">
       <div class="container-fluid">
          <ul class="nav navbar-nav">
             <li class="active"><a href="index.php">Quiz</a></li>
             <li><a href="add-question.php">Cadastro de perguntas</a></li>
			 <li><a href="questions_answers.php">Perguntas e respostas</a></li>
			 <li><a href="answers_users.php">Respostas de Users</a></li>			 
             <li><a href="quiz_destroy.php">Voltar ao topo</a></li>
          </ul>
       </div>
    </nav>
<div class="container">
   <table class="table table-bordered">
		<tr >
		    <th>Pergunta</th>
			<th>Resposta Correta</th>
			<th>Criada em</th>				
			<th>Excluir</th>
        <?php foreach($data as $d){ ?>
		<tr>
			<td><?=$d->body?></td>
			<td><?=$d->description_options?></td>
            <td><?=date("d/m/Y H:i:s", strtotime($d->created_at));?></td>
			<td><a  href="javascript:func()" class="btn btn-danger" onclick="DeleteConfirm(<?=$d->id ?>)" >Excluir  <i class="fa fa-trash" aria-hidden="true"></i> </a></td>

		</tr>
       <?php } ?>		
    </table>
</div>
</body>
</html>