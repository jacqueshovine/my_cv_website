<?php

function selectOne($table, $id) {

  global $pdo; // je recupere $pdo de l'exterieur de la fonction
  $rowToGet = $pdo->prepare('SELECT * FROM ' . $table . ' WHERE id = :id');
  $rowToGet->bindValue(':id', $id, PDO::PARAM_INT);
  $rowToGet->execute();
  $row = $rowToGet->fetch(PDO::FETCH_ASSOC);

  return $row;
}

function selectAll($table){
  global $pdo; //On récupère le $pdo dans la fonction
  $rowsToGet = $pdo->query('SELECT * FROM ' . $table);
  $rows = $rowsToGet->fetchAll(PDO::FETCH_ASSOC);

  return $rows;
}