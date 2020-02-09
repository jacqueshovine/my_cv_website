<?php
session_start();

if(!isset($_SESSION['login']))
{
  header('Location:/login.php?action=redirect');
}

require_once($_SERVER['DOCUMENT_ROOT']. '/include/init.inc.php'); //Connexion à la base
$titre_fr = 'Accueil - Back office';
$titre_en = 'Home - Back office';

// RECUPERATION DES MESSAGES

include($_SERVER['DOCUMENT_ROOT']. '/include/functions.inc.php');

$messages = selectAll('messages');

include($_SERVER['DOCUMENT_ROOT'] . '/include/req.inc.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/include/haut.inc.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/nav.inc.php' );

?>

<main class="flex-col">
  <div class="center">
    <h2><?= 'Bonjour, ' . $_SESSION['login'] ?></h2>
    <a href="/deconnexion.php">Déconnexion</a>
  </div>

  <section class="flex-col flex-sb flex-wrap">
    <div>
      <h2>Messages reçus</h2>
    </div>

    <table class="centered responsive-table striped">
      <thead>
        <tr>
          <?php foreach($messages[0] as $titles => $value) : ?>
          <th><?= $titles ?></th>
          <?php endforeach; ?>
          <th>Supprimer</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($messages as $key => $value) : ?>
          <tr>
            <td><?= $value['id_message'] ?></td>
            <td><?= $value['date_message'] ?></td>
            <td><?= htmlspecialchars($value['nom_message']) ?></td>
            <td><?= htmlspecialchars($value['email_message']) ?></td>
            <td><?= htmlspecialchars($value['contenu_message']) ?></td>
            <td>Supprimer</td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/include/bas.inc.php'); ?>