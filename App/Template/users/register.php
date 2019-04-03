<h1>REGISTER NEW USER</h1>
<?php /** @var \App\DTO\UserDTO $data */ ?>
<?php foreach ($errors as $error): ?>
    <p style="color:red"><?=$error;?></p>
<?php endforeach; ?>
<form method="POST">
    Username: <input value="<?= $data != null ? $data->getUsername() : "" ; ?>" type="text" name="username"/><br/>
    Password: <input value="<?= $data != null ? $data->getPassword() : "" ; ?>" type="password" name="password"/><br/>
    Confirm Password: <input type="password" name="confirm_password"/><br/>
    Full Name: <input value="<?= $data != null ? $data->getFirstName() : "" ; ?>" type="text" name="full_name"/><br/>
    Born On: <input value="<?= $data != null ? $data->getBornON() : "mm/dd/yyyy" ; ?>" type="date" name="born_on"/><br/>
    <input type="submit" name="register" value="Register!"/>
</form>