<?php

if(isset($_COOKIE['langue']))
{
  $langue = $_COOKIE['langue'];
}
else
{
  $_COOKIE['langue'] = "en";
  $langue = $_COOKIE['langue'];
}

//Requête likes

$req_likes = $pdo->query('SELECT count FROM counters WHERE name = "compteur_likes"');
$data_likes = $req_likes->fetch(PDO::FETCH_ASSOC);


if($langue == 'fr'){                                  //AFFICHAGE LANGUE FR
  //Appel du dictionnaire de variables FR
  include $env_path . '/include/frvar.inc.php';
} 
else{                                                 // AFFICHAGE LANGUE EN
  //Appel du dictionnaire de variables EN
  include $env_path . '/include/envar.inc.php';
}

//Requête contenant les menus
$req_nav = $pdo->query('SELECT id, label_onglet_fr, label_onglet_en, lien FROM navbar');
$data_nav = $req_nav->fetchAll(PDO::FETCH_ASSOC);

//Requête contenant les expériences professionnelles
$req_exp = $pdo->query('SELECT id_exp,
                               DATE_FORMAT(date_debut, "%Y/%m") AS date_debut,
                               DATE_FORMAT(date_fin, "%Y/%m") AS date_fin, 
                               titre_exp_' . $langue . ', 
                               entreprise_exp, 
                               lieu_exp_' . $langue . ',
                               detail_exp_' . $langue . ',
                               type_exp FROM experience_01 WHERE type_exp = 1 ORDER BY date_fin DESC');
$data_exp = $req_exp->fetchAll(PDO::FETCH_ASSOC);

//Requête contenant les formations
$req_form = $pdo->query('SELECT id_exp,
                               DATE_FORMAT(date_debut, "%Y") AS date_debut,
                               DATE_FORMAT(date_fin, "%Y") AS date_fin, 
                               titre_exp_' . $langue . ', 
                               entreprise_exp, 
                               lieu_exp_' . $langue . ',
                               detail_exp_' . $langue . ',
                               type_exp FROM experience_01 WHERE type_exp = 0 ORDER BY date_fin DESC');
$data_form = $req_form->fetchAll(PDO::FETCH_ASSOC);

//Requête contenant les projets
$req_projets = $pdo->query('SELECT id_projet,
                                   image_projet,
                                   titre_projet_' . $langue . ',
                                   lien_projet_' . $langue . ',
                                   libelle_lien_projet_' . $langue . ',
                                   titre_reveal_projet_' . $langue . ',
                                   detail_projet_' . $langue . ',
                                   date_projet FROM projets_01 ORDER BY date_projet DESC');
$data_projets = $req_projets->fetchAll(PDO::FETCH_ASSOC);