<?php /**@var $data \TaskManagement\DTO\UserDTO|null
 *
 */ ?>
<?php foreach ($errors as $error): ?>
<p style="color:red;"><?=$error;?></p>
<?php endforeach; ?>
<form method="post">
    Username: <input value="<?=$data != null ? $data->getUsername() : ""; ?>" type="text" name="username"/><br/>
    Password: <input value="<?=$data != null ? $data->getPassword() : ""; ?>" type="password" name="password"<br/>
    <input type="submit" name="login" value="Login!"/>
</form>

