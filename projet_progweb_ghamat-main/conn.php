<?php

try
{
    $db = new PDO('sqlite:films.db');
}
catch (PDOException $e)
{
  echo 'Connection failed: ' . $e->getMessage();
}

?>