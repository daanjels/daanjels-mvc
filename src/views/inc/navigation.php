<nav class="left">
    <ul>
        <li><a href="<?= URLROOT ?>/">Home</a></li>
        <li><a href="<?= URLROOT ?>/about">About</a></li>
    </ul>
</nav>
<nav class="right">
    <ul>
    <?php if (isset($_SESSION['user_id'])) { ?>
        <li><a href="<?= URLROOT ?>/users/logout">Logout</a></li>    
    <?php } else { ?>
        <li><a href="<?= URLROOT ?>/users/register">Register</a></li>
        <li><a href="<?= URLROOT ?>/users/login">Login</a></li>
    <?php } ?>
    </ul>
</nav>