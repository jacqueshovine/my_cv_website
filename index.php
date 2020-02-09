<?php
require_once('include/init.inc.php'); //Connexion à la base
$titre_fr = 'Jacques Hovine -  Mon CV';
$titre_en = 'Jacques Hovine - My CV';
$captcha_answer = '/4|quatre|four/i';

// INSERTION ----------------------------------------------------------------------- 

if(isset($_POST['message']))
{
	if(!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['contenu']) && !empty($_POST['captcha']) && preg_match($captcha_answer, $_POST['captcha']))
	{
    $bot_check = '/https?:\/\//'; // Vérification de bot envoyant des liens
    if(preg_match($bot_check, $_POST['contenu'])) {
      $confirmation = '<div class="hidden msgnolink"></div>';
    } 
    else 
    {
      ini_set('display_errors', 1);
      $insert = $pdo->prepare('INSERT INTO messages(nom_message, email_message, contenu_message, date_message) VALUES (:nom, :email, :contenu, NOW() )');
      $insert->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
      $insert->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
      $insert->bindValue(':contenu', $_POST['contenu'], PDO::PARAM_STR);
      $insert->execute();

      
      // MAIL -----------------------------------------------------------------------------------------

      $to = 'contact@jhovine.fr';
      $subject = 'Nouveau message sur jhovine.fr !';
      $message = 'De la part de ' . htmlspecialchars($_POST['nom']) . " : \n\n" . htmlspecialchars($_POST['contenu']);
      $headers = 'From: ' . htmlspecialchars($_POST['email']) . "\r\n";

      mail($to, $subject, $message, $headers);

      $confirmation = '<div class="hidden msgok"></div>';
    }
	}
	else
	{
		$confirmation = '<div class="hidden msgnok"></div>';
	}
}

// AFFICHAGES ----------------------------------------------------------------------

include('include/req.inc.php');

include('include/haut.inc.php');

?>
<!-- DESCRIPTION -->
<meta name="description" content="Bienvenue sur mon site-CV ! Je m'appelle Jacques Hovine, je suis étudiant dans le domaine du web, spécialisé dans le développement et la gestion de projet.">
</head>
<body class="flex-col flex-c-c">

 <?php if(!empty($confirmation)){echo $confirmation;} ?>

 <?php include "include/nav.inc.php" ?>

<main class="flex-col">
	<div class="fixed-action-btn">
   <a class="btn-floating btn tooltipped" data-position="left" data-delay="50" data-tooltip="<?= $telecharger ?>" target="_blank" href="<?= 'assets/upload/' . $cv_actuel ?>" style="background-color:#FF404C"><i class="material-icons">file_download</i></a>
  </div>

	<section class="flex flex-sb flex-align text-j" id="presentation">
		<div id="lang" class="flex-row right">
			<a href="<?= $_SERVER['PHP_SELF'] ?>?lang=fr" lang="fr"><img src="assets/image/cv/France.png" alt="FR" class="pad-10"/></a>
			<a href="<?= $_SERVER['PHP_SELF'] ?>?lang=en" lang="en"><img src="assets/image/cv/United-kingdom.png" class="pad-10" alt="EN"/></a>
		</div>

		<div class="flex flex-c-c w100 marg-20">
			<div class="flex flex-c-c  marg-10 l4 m12 s12">
				<img src="assets/image/cv/jacques_02.jpg"/>
			</div>

			<div class="flex-col flex-sa h100 marg-10 l8 m12 s12">
				<h1><?= $langue == 'fr' ? $titre_fr : $titre_en ?></h1>
				<?= $apropos_texte ?>
				<a class="waves-effect waves-light btn-large" id="likeButton"><i class="material-icons left">thumb_up</i><?= $bouton_like ?></a>
				<span class="hidden" id="likeCount"><?= $data_likes["count"] ?></span>
			</div>
		</div>
	</section>

	<section class="flex-col flex-sb flex-wrap" id="experiences">
		<div class="flex flex-c-c center hide-on-small-only" style="background-color:#00708C">
			<span><i class="material-icons left">arrow_downward</i><?= $statutActuel ?><i class="material-icons right">arrow_downward</i></span>
		</div>

		<div class="flex flex-sb">
			<div class="flex-col flex-sa l8 m12 s12">
				<div>
					<h2><?= $experiences_professionnelles ?></h2>
				</div>

        <div class="flex-col marg-20-ver" style="margin-right:20px;" id="xp_pro">
					<?php
					foreach($data_exp as $key_exp => $onedata) :
					?>
					<div class="marg-10-ver">
						<div class="cv_entete">
							<h3><?= ($onedata['date_debut']); ?> - <?= ($onedata['date_fin']) == '9999/12' ? $present : ($onedata['date_fin']); ?> : <span class="titrexp" style="color:#FF404C"><?= ($onedata['titre_exp_' . $langue]); ?></span></h3>
							<h4 style="color:#00708C"><?= ($onedata['entreprise_exp']); ?> - <?= ($onedata['lieu_exp_' . $langue]); ?></h4>
						</div>
						<div class="cv_details">
							<?= ($onedata['detail_exp_' . $langue]); ?>
						</div>
					</div>
					<?php
					endforeach;
					?>
				</div>

				<div class="flex-col flex-sa marg-20-ver" style="margin-right:20px">
					<div>
						<h2><?= $formation ?></h2>
					</div>

					<?php
					foreach($data_form as $key_form => $onedata) :
					?>
					<div class="marg-10-ver">
						<div class="flex-col flex-sa">
							<div class="cv_entete">
								<h3><?= ($onedata['date_debut']); ?> - <?= ($onedata['date_fin']); ?> : <span class="titrexp" style="color:#FF404C"><?= ($onedata['titre_exp_' . $langue]); ?></span></h3>
								<h4 style="color:#00708C"><?= ($onedata['entreprise_exp']); ?> - <?= ($onedata['lieu_exp_' . $langue]); ?></h4>
							</div>
						</div>
					</div>
					<?php
					endforeach;
					?>
				</div>
			</div>

			<div class="flex-col l4 m12 s12">
				<div class="flex-col flex-sb m6 s12">
					<div>
						<h2><?= $competences ?></h2>
					</div>
					<div class="cv_entete">
						<h3><?= $developpement_web ?></h3>
						<div class="flex marg-10-ver">
							<div>
								<div class="chip white-text">HTML</div>
								<div class="chip white-text">CSS</div>
								<div class="chip white-text">Javascript</div>
								<div class="chip white-text">PHP</div>
                <div class="chip white-text">MySQL</div>
                <div class="chip white-text">Python</div>
                <div class="chip white-text">Ruby</div>
                <div class="chip white-text">Materialize CSS</div>
                <div class="chip white-text">Bootstrap</div>
                <div class="chip white-text">Vue JS</div>
                <div class="chip white-text">Angular JS</div>
                <div class="chip white-text">Git</div>
							</div>
						</div>
          </div> 
          
          <div class="cv_entete">
						<h3><?= $web_analytics ?></h3>
						<div class="flex  marg-10-ver">
							<div>
								<div class="chip white-text">Google Analytics (Certified)</div>
								<div class="chip white-text">BigQuery</div>
								<div class="chip white-text">Data Studio</div>
								<div class="chip white-text">GTM</div>
							</div>
						</div>
					</div>

					<div class="cv_entete">
						<h3><?= $autres ?></h3>
						<div class="flex  marg-10-ver">
							<div>
								<div class="chip white-text">Photoshop</div>
								<div class="chip white-text">Word</div>
								<div class="chip white-text">Excel</div>
								<div class="chip white-text">Powerpoint</div>
							</div>
						</div>
					</div>
				</div>

				<div class="flex-col m6 s12">
					<div>
						<h2><?= $langues ?></h2>
					</div>

					<div class="cv_entete">
						<div class="flex marg-10-ver">
							<ul><?= $liste_langues ?></ul>
						</div>
					</div>

					<div>
						<h2><?= $activites ?></h2>
					</div>

					<div class="cv_entete">
						<div class="flex marg-10-ver">
							<ul><?= $liste_activites ?></ul>
						</div>
					</div>
				</div>
			</div>
	</section>

	<section class="flex-col flex-sb flex-wrap text-j" id="projets">
		<div>
			<h2><?= $mes_projets ?></h2>
		</div>
		<div class="flex flex-sa flex-wrap">
			<?php
			foreach($data_projets as $key_projets => $onedata) :
			?>
		  <div class="card marg-10 l4 m6 s12">
		    <div class="card-image waves-effect waves-block waves-light">
		      <img class="activator" src="assets/image/cv/<?= ($onedata['image_projet']); ?>">
		    </div>
		    <div class="card-content">
		      <span class="card-title activator grey-text text-darken-4"><?= ($onedata['titre_projet_' . $langue]); ?><i class="material-icons right">more_vert</i></span>
		      <p><a target="_blank" href="<?= ($onedata['lien_projet_' . $langue]); ?>"><?= ($onedata['libelle_lien_projet_' . $langue]); ?></a></p>
		    </div>
		    <div class="card-reveal">
		      <span class="card-title grey-text text-darken-4"><?= ($onedata['titre_reveal_projet_' . $langue]); ?><i class="material-icons right">close</i></span>
					<?= ($onedata['detail_projet_' . $langue]); ?>
		    </div>
		  </div>
		  <?php
			endforeach;
		  ?>
		  <div class="card-panel marg-10 flex-col flex-c-c l4 m6 s12 hide-on-med-and-down">
		  	<span><i class="material-icons">add</i></span>
		  	<span><?= $prochain_projet ?></span>
		  </div>
		</div>
	</section>

	<section class="flex-col flex-sb flex-wrap text-j" id="contact">
		<div>
			<h2><?= $me_contacter ?></h2>
		</div>

		<div class="flex flex-sb">
			<div class="flex-col l9 m8 s12 marg-10-ver">
				<div>
					<h3><?= $envoyez_message ?></h3>
				</div>
				<form method="post" action="">
	        <div class="input-field col s12">
	          <input id="nom" name="nom" type="text" class="validate" required>
	          <label for="nom"><?= $label_form_nom ?></label>
	        </div>
	        <div class="input-field col s12">
	          <input id="mail" name="email" type="email" class="validate" required>
	          <label for="mail"><?= $label_form_mail ?></label>
	        </div>
	        <div class="input-field col s12">
	          <textarea id="message" name="contenu" class="materialize-textarea" required></textarea>
	          <label for="message"><?= $label_form_message ?></label>
	        </div>
	        <div class="input-field col s12">
	          <input id="captcha" name="captcha" type="text" class="validate" required>
	          <label for="captcha"><?= $label_form_captcha ?></label>
	        </div>
	        <div>
    			  <button class="btn waves-effect waves-light" style="background-color:#FF404C;" type="submit" name="message"><?= $label_form_envoyer ?>
    			    <i class="material-icons right">send</i>
    			  </button>
    			</div>
				</form>
			</div>

			<div class="flex-col l3 m4 s12 marg-10-ver" id="infoperso">
				<h3><?= $info_perso ?></h3>
				<div>
					<h3>Jacques Hovine</h3>
				</div>
				<span><?= $date_naissance ?></span>
				<span><?= $nationalite ?></span>
				<span class="flex-row flex-align"><i class="material-icons" style="color:#00708C;">phone</i> <a href="tel:+33650225479" style="color:#00708C;">(+33)06 50 22 54 79</a></span>
				<span class="flex-row flex-align"><i class="material-icons" style="color:#00708C;">mail</i> <a href="mailto:contact@jhovine.fr" style="color:#00708C;">contact@jhovine.fr</a></span>
				<p class="pad-10"><a href="https://www.linkedin.com/in/jacques-hovine/"><i class="ti-linkedin" style="font-size:3em;color:#00708C;"></i></a></p>
			</div>
	</section>
</main>

<?php include('include/bas.inc.php') ?>