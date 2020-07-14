<?php require_once APPROOT.'/resources/portfolio-list.php'; ?>
<nav class="dropmenu">
    <button class="menu-open" aria-label="open menu" onclick="toggleMenu()" >☰</button></li>
    <ul class="menu menu-wrapper is-closed">
        <button class="menu-open" aria-label="open menu" onclick="toggleMenu()" >&times;</button>
        <?php
            foreach($PORTFOLIO as $key => $value) {
                if($key == $data['page']) { ?>
                    <li><em><?= $value ?></em></li>
                <?php } else { ?>
                    <li><a href="<?= URLROOT.'/portfolios/'.$key ?>"><?= $value ?></a></li>
                <?php }
            } ?>
    </ul>
</nav>