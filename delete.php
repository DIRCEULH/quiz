<?php
    require 'inc/connection.php';

    $id = $_REQUEST['id'];
    $sql = "DELETE FROM questions, question_options USING questions INNER JOIN question_options WHERE questions.id = question_options.question_id AND questions.id = :id";
    $stm = $connection->prepare($sql);
    $stm->bindValue(':id', $id);  
    $stm->execute();
	
header('location: questions_answers.php');
?>
