<nav class="dropmenu">
    <button class="menu-open" aria-label="open menu" onclick="toggleMenu()" >☰</button></li>
    <ul class="menu menu-wrapper is-closed">
        <button class="menu-open" aria-label="open menu" onclick="toggleMenu()" >&times;</button>
        <?php
						// Use the navigationmodel to access the database and retrieve all portfolio sets
						$folios = $this->navigationModel->getPortfolio();

						// Build the navigation
						foreach($folios as $key => $value) {
                if($key == $data['page']) { ?>
                    <li><em><?= $value ?></em></li>
                <?php } else { ?>
                    <li><a href="<?= URLROOT.'/portfolios/'.$key ?>"><?= $value ?></a></li>
                <?php }
            } ?>
    </ul>
</nav>