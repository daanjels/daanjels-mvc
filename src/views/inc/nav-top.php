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
            if ($data['page'] == "contact") {
                echo '<li><em>'.$data['menu'].'</em></li>';
            } else {
                echo '<li><a href="'.URLROOT.'/contact">Contact</a></li>';
            };
        ?>
    </ul>
</nav>
