<nav>
	<div class="nav-wrapper">
		<span><?= $titre_nav ?></span>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul class="right hide-on-med-and-down">
			<?php
			foreach($data_nav as $key_nav => $onedata) :
			?>
			<li><a href="<?= PUBLIC_URL . ($onedata['lien']) ?>"><?= $langue == 'fr' ? ($onedata['label_onglet_fr']) : ($onedata['label_onglet_en'])?></a></li>
			<?php
			endforeach;
			?>
			<li style="background-color:#0077B5"><a href="https://www.linkedin.com/in/jacques-hovine/"><i class="ti-linkedin white-text"></i></a></li>
		</ul>
		<ul class="side-nav" id="mobile-demo">
			<?php
			foreach($data_nav as $key_nav => $onedata) :
			?>
			<li><a href="<?= PUBLIC_URL . ($onedata['lien']) ?>"><?= $langue == 'fr' ? ($onedata['label_onglet_fr']) : ($onedata['label_onglet_en'])?></a></li>
			<?php
			endforeach;
			?>
			<li style="background-color:#0077B5"><a href="https://www.linkedin.com/in/jacques-hovine/"><i class="ti-linkedin white-text"></i></a></li>
		</ul>
	</div>
</nav>