<?php


function redirectIfNotStarted()
{
	if(!isset($_SESSION['started_at'])) 
	{
		header("Location:index.php");
		die();
	}
}

function checkAnswer($con)
{
	if( isset($_POST['question_id']) AND isset($_POST['answer'])) 
	{
		$answeredQuestionId = $_POST['question_id'];
		$answerId = $_POST['answer'];

		$_SESSION['answered_questions'][] = $answeredQuestionId;


		$isCorrect = $con->query("SELECT id FROM questions WHERE id = $answeredQuestionId AND answer_id = $answerId")->rowCount();
		
		$addAnswerUserQuery = $con->query("INSERT INTO answer_user_id (user,answers_id) VALUES ('".$_SESSION['user']."',$answerId ) ");
		
	
		if($isCorrect == 1) 
		{
			$_SESSION['correct_answers_count']++;
			
	    }

	}
}


function insertUser($con)
{
		
	if( isset($_SESSION['user']))  
	{
		
	    $addAnswerUserQuery = $con->query("INSERT INTO answer_user (user,created_at) VALUES ('".$_SESSION['user']."',NOW())");
	
	}
}

function updateUser($con)
{
		
	if( isset($_SESSION['user']) AND isset($_SESSION['correct_answers_count']) ) 
	{

		$error = $_SESSION['total_questions_count'] - $_SESSION['correct_answers_count'];
		
	    $update = $con->exec("UPDATE answer_user SET hits = '".$_SESSION['correct_answers_count']."' ,error = '$error', finalized_at = NOW() WHERE user = '".$_SESSION['user']."' ");

	

	}
}

function getRandomQuestion($con)
{
	$answeredQuestionsListString = implode(",", $_SESSION['answered_questions']);

	$getRandomQuestion = $con->query("SELECT * FROM questions WHERE id NOT IN ($answeredQuestionsListString) ORDER BY RAND() LIMIT 1");

	$question = $getRandomQuestion->fetchObject();

	return $question;
}


function endQuiz()
{
	$_SESSION['completed_at'] = time();
	
	header("Location: result.php");
	die();
}




