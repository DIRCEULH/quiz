<?php
require_once "inc/init.php";
/**
*	Quando um novo usuário inicia o QUIZ, iniciamos todas as descrições e a sessão começa aqui
*/


// insere a data do  inicio do teste na tabela answer_users
insertUser($connection);

//	Inicia uma nova session
if(! isset($_SESSION['started_at'])) {
	$_SESSION['started_at'] = time();
	$_SESSION['total_questions_count'] = $connection->query("SELECT id FROM questions")->rowCount();
	$_SESSION['correct_answers_count'] = 0;
	$_SESSION['answered_questions'] = [0];
}

header("Location: quiz.php");