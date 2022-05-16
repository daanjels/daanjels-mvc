<?php if (!isset($_SESSION['user_id'])) { ?>
<nav class="topmenu">
	<ul>
		<?php 
			if ($data['page'] == "index") {
					echo '<li><em class="sitename">da:njəls</em></li>';
			} else {
					echo '<li><a href="'.URLROOT.'/" class="sitename">'.SITENAME.'</a></li>';
			};
			if ($data['page'] == "about") {
					echo '<li><em>'.$data['menu'].'</em></li>';
			} else {
					echo '<li><a href="'.URLROOT.'/about">Wie?</a></li>';
			};
			if ($data['page'] == "expo" && $data['menu'] == "Expo") {
				echo '<li><em>'.$data['menu'].'</em></li>';
			} else if ($data['page'] == "expo" && $data['menu'] == "Prijzen") {
				echo '<li><a href="'.URLROOT.'/expo">Expo</a></li>';
				echo '<li><em>Prijzen</em></li>';
			} else {
				echo '<li><a href="'.URLROOT.'/expo">Expo</a></li>';
			};
			if ($data['page'] == "contact") {
					echo '<li><em>'.$data['menu'].'</em></li>';
			} else {
					echo '<li><a href="'.URLROOT.'/contact">Contact</a></li>';
			} ?>
	</ul>
</nav>
<?php } else { ?>
<nav class="topmenu admin">
	<ul>
	<?php
		if ($data['page'] == "admin") {
				echo '<li><em>admin</em></li>';
			} else {
				echo '<li><a href="'.URLROOT.'/admin/index">admin</a></li>';
			};
		if ($data['page'] == "contacts") {
				echo '<li><em>Contacten</em></li>';
			} else {
				echo '<li><a href="'.URLROOT.'/admin/contacts">Contacten</a></li>';
			};
	?>
        <li><a href="<?= URLROOT ?>/admin/logout">Logout</a></li>    
    </ul>
</nav>
<?php } ?>
