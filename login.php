<?php
require_once('include/init.inc.php'); //Connexion à la base
$titre_fr = 'Connexion au back office';
$titre_en = 'Login';

$confirmation = '';

if($_SESSION['login'])
{
	header('Location:admin/home_back.php');
}

if(isset($_GET))
{
	if(!empty($_GET['action']) && $_GET['action'] === 'logout')
	{
		$confirmation = '<h3 class="center green-text">Déconnecté avec succès</h3>';
	}
	else if(!empty($_GET['action']) && $_GET['action'] === 'redirect')
	{
		$confirmation = '<h3 class="center red-text">Connexion requise !</h3>';
	}
}

if($_POST)
{
	if(!empty($_POST['login']) && !empty($_POST['password']))
	{
		$check = $pdo->prepare('SELECT * FROM info_login WHERE login = :login');
		$check->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
		$check->execute();

		$check_user = $check->fetch(PDO::FETCH_ASSOC);

		if($check_user['password'] === $_POST['password'])
		{
			$_SESSION['login'] = $check_user['login'];
			header('Location:admin/home_back.php');
		}
		else
		{
			$confirmation = '<h3 class="center red-text">Login ou mot de passe incorrect</h3>';
		}
	}
	else
	{
		$confirmation = '<h3 class="center red-text">Veuillez remplir tous les champs !</h3>';
	}
}

//echo $_SERVER['DOCUMENT_ROOT'];

include('include/req.inc.php'); 
include('include/haut.inc.php');
?>
<!-- DESCRIPTION -->
<meta name="description" content="L'accès au back office de mon site-CV.">
</head>
<body class="flex-col flex-c-c">

<?php include('include/nav.inc.php'); ?>

<main class="flex-col">
	<div class="row center marg-20-ver">
		<h1><?= $langue == 'fr' ? $titre_fr : $titre_en ?></h1>
	</div>

	<?php if(!empty($confirmation)){echo $confirmation;} ?>

	<section class="flex-col flex-c-c">
			<form method="post" action="login.php">
				<div class="input-field col s12">
					<input id="login" name="login" type="text" class="validate" required>
					<label for="login">Login</label>
				</div>
				<div class="input-field col s12">
					<input id="password" name="password" type="password" class="validate" required>
					<label for="password">Password</label>
				</div>
				<div class="center">
					<button class="btn waves-effect waves-light" type="submit" name="connexion" style="background-color:#FF404C"><?= $connexion_admin ?></button>
				</div>
			</form>
	</section>
</main>

<?php include('include/bas.inc.php'); ?>
