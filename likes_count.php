<?php

include 'include/init.inc.php';
include 'include/functions.inc.php';

try{
  $query = 'UPDATE counters SET count = '. $_POST["likes"] .' WHERE id = 1';
  $req = $pdo->prepare($query);
  $req->execute();

  $query = selectOne('counters', 1);

  $msg = array(
    "likes" => $query['count']
  );

  echo json_encode($msg);
}
catch(Exception $e){
  echo 0;
}