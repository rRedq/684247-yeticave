<?php $classname = isset($errors) ? "form--invalid" : "";?>
<form class="form container <?=($classname);?>" action="login.php" method="post" enctype="multipart/form-data">
    <h2>Вход</h2>
    <?php $classname = isset($errors['email']) ? "form__item--invalid" : "";
    $value = isset($form['email']) ? $form['email'] : ""; ?>
    <div class="form__item <?=($classname);?>">
        <label for="email"><E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$value;?>">
        <span class="form__error"><?= (isset($errors['email'])) ? $errors['email'] : '' ?></span>
    </div>
    <?php $classname = isset($errors['password']) ? "form__item--invalid" : "";
    $value = isset($form['password']) ? $form['password'] : ""; ?>
    <div class="form__item form__item--last <?=($classname);?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль" >
        <span class="form__error"><?= (isset($errors['password'])) ? $errors['password'] : '' ?></span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>