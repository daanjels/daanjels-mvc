<?php require APPROOT . '/views/inc/header.php'; ?>
<h1><?php echo $data['title']; ?></h1>
<?php flash('register_success'); ?>
<form method="POST" action="<?= URLROOT; ?>/users/login">
    <label class="<?php if ($data['email_error'] != 'Email:') echo 'is-invalid'; ?>"
        for="name"><?= $data['email_error']; ?></label>
    <input type="email" name="email" value="<?= $data['email']; ?>">
    <label class="<?php if ($data['password_error'] != 'Password:') echo 'is-invalid'; ?>"
        for="name"><?= $data['password_error']; ?></label>
    <input type="password" name="password" value="<?= $data['password']; ?>">
    <input type="submit" value="Login">
</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>