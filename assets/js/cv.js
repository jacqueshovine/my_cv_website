// -------------------------------------------------------------------- LANGUE DEFAUT
var langue = $("html").attr('lang');
//console.log(langue);

// --------------------------------------------------------------------  COOKIES LANGUES
$("#lang a").click(function(e){
  e.preventDefault;
  langue = this.getAttribute("lang");
  //console.log(langue);
  document.cookie = "langue ="+langue+";expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/"; //Pour éviter les doublons on utilise path
});

// --------------------------------------------------------------------  COOKIE LIKE

/* Vérification de l'existence du cookie */
function getCookie(cname){
  var name = cname + "="
  var decodedCookie = decodeURIComponent(document.cookie);
  console.log('DECODED COOKIE : '+ decodedCookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++)
  {
    var c = ca[i];
    while(c.charAt(0) == ' ')
    {
      c = c.substring(1);
    }
    if(c.indexOf(name) == 0) //Si on trouve le cookie (sinon vaut -1)
    {
      return c.substring(name.length, c.length); //On retourne le nom du cookie seul
    }
  }
  return "";
}

//On vérifie les cookies au chargement de la page
window.onload = function(){
  var cookieLike = getCookie('like'); //On cherche si un cookie 'like' est déjà présent 
  console.log(cookieLike);
  if(cookieLike.length > 0) //Si un cookie 'like' est déjà présent
  {
    document.getElementById('likeButton').classList.add('disabled'); //On désactive le bouton après le like. 
    if(langue == 'fr')
    {
      document.getElementById('likeButton').innerHTML = '<i class="material-icons left">tag_faces</i>Merci !';
    }
    else
    {
      document.getElementById('likeButton').innerHTML = '<i class="material-icons left">tag_faces</i>Thank you, I like you too !';
    }
  }
}



var likes = document.getElementById('likeCount').innerText;
//console.log(likes);

/* Création du cookie like au click sur le bouton puis post en ajax pour ajouter un like en bdd */
$('#likeButton').click(function(e){
  e.preventDefault;

  document.cookie = "like='like'";

  likes++;

  var info_post = {};
  info_post.likes = likes;

  $.post('likes_count.php', info_post, function(msg){
    if(msg == 0)
    {
      alert("Nope");
    }
    else
    {
      var reponse = JSON.parse(msg);
      //console.log(reponse);
      document.getElementById('likeButton').classList.add('disabled'); //On désactive le bouton après le like. 
      if(langue == 'fr')
      {
        document.getElementById('likeButton').innerHTML = '<i class="material-icons left">tag_faces</i>Merci !';
      }
      else
      {
        document.getElementById('likeButton').innerHTML = '<i class="material-icons left">tag_faces</i>Thank you, I like you too !';
      }
    }
  });
})



// --------------------------------------------------------------------  Gestion des notifications d'envoi de message
var msgok = document.getElementsByClassName('msgok');
var msgnok = document.getElementsByClassName('msgnok');
var msgnolink = document.getElementsByClassName('msgnolink');

if(msgok.length > 0)
{
  if(langue == 'fr'){
    Materialize.toast('Votre message a bien été envoyé !', 4000);
  }
  else
  {
    Materialize.toast('Message sent !', 4000);
  }
}
else if(msgnolink.length > 0) {
  if(langue == 'fr'){
    Materialize.toast('Échec de l\'envoi du message. Pas de liens svp !', 4000);
  }
  else
  {
    Materialize.toast('Error : Message not sent. No links please !', 4000);
  }
}
else if(msgnok.length > 0)
{
  if(langue = 'fr'){
    Materialize.toast('Échec de l\'envoi du message...', 4000);
  }
  else
  {
    Materialize.toast('Error : Message not sent.', 4000);
  }
	
}

$(".button-collapse").sideNav();

/* --------------------------------------------------------------------   PDF */

/*
var pdfcount = 1;
var pdf = $('#pdf');

pdf.click(function(){
	$('.tap-target').tapTarget('open');
});
*/

$('.fixed-action-btn').openFAB();
$('.fixed-action-btn').closeFAB();
$('.fixed-action-btn.toolbar').openToolbar();
$('.fixed-action-btn.toolbar').closeToolbar();