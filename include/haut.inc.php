<!DOCTYPE html>
<html lang="<?= $langue == 'fr' ? 'fr' : 'en' ?>">
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112408193-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-112408193-1');
  </script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <!-- RESET -->
  <link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
  <!-- Import Material icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Import Materialize -->
  <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
  <!-- Import Animate -->
  <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
  <!-- Import Themify -->
  <link rel="stylesheet" type="text/css" href="assets/css/themify-icons.css">
  <!-- Style perso -->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="icon" type="image/png" href="assets/image/cv/curriculum.png">
  <title><?= $langue == 'fr' ? $titre_fr : $titre_en ?></title>

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#2c3e50"
    },
    "button": {
      "background": "#00708c"
    }
  },
  "position": "bottom-left",
  "content": {
    "message": "<?= $cookies_message ?>",
    "link": "<?= $cookies_link ?>",
    "dismiss": "<?= $cookies_dismiss ?>"
  }
})});
</script>

