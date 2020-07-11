<?php require APPROOT . '/views/inc/header.php'; ?>
<h1><?php echo $data['title']; ?></h1>
<p><?php echo $data['description']; ?></p>
<form method="POST" action="<?= URLROOT; ?>/users/register">
    <label class="<?php if ($data['name_error'] != 'Name:') echo 'is-invalid'; ?>" 
        for="name"><?= $data['name_error']; ?></label>
    <input type="text" name="name" value="<?= $data['name']; ?>">
    <label class="<?php if ($data['email_error'] != 'Email:') echo 'is-invalid'; ?>"
        for="name"><?= $data['email_error']; ?></label>
    <input type="email" name="email" value="<?= $data['email']; ?>">
    <label class="<?php if ($data['password_error'] != 'Password:') echo 'is-invalid'; ?>"
        for="name"><?= $data['password_error']; ?></label>
    <input type="password" name="password" value="<?= $data['password']; ?>">
    <label class="<?php if ($data['confirm_error'] != 'Confirm password:') echo 'is-invalid'; ?>"
        for="name"><?= $data['confirm_error']; ?></label>
    <input type="password" name="confirm" value="<?= $data['confirm']; ?>">
    <input type="submit" value="Register">
    <a href="<?= URLROOT; ?>/users/login">or login</a>
</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>