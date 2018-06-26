<?php

try{
     $connection = new PDO('mysql:host=localhost;dbname=quiz;charset-UTF-8','','');
     $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

   } catch(PDOException $e) {
	
     echo '<b><p  > Conexao  nao foi possível!!</p></b>';
  
}
?>