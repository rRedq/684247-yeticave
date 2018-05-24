<?php $classname = isset($errors) ? "form--invalid" : "";?>
<form class="form container <?=($classname);?>" action="sign-up.php" method="post" enctype="multipart/form-data">
    <h2>Регистрация нового аккаунта</h2>
    <?php $classname = isset($errors['email']) ? "form__item--invalid" : "";
    $value = isset($form['email']) ? $form['email'] : ""; ?>
    <div class="form__item <?=$classname;?>">
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$value;?>">
        <span class="form__error"><?= (isset($errors['email'])) ? $errors['email'] : '' ?></span>
    </div>
    <?php $classname = isset($errors['password']) ? "form__item--invalid" : "";
    $value = isset($form['password']) ? $form['password'] : ""; ?>
    <div class="form__item <?=$classname;?>">
        <label for="password">Пароль*</label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" >
        <span class="form__error"><?= (isset($errors['password'])) ? $errors['password'] : '' ?></span>
    </div>
    <?php $classname = isset($errors['name']) ? "form__item--invalid" : "";
    $value = isset($form['name']) ? $form['name'] : ""; ?>
    <div class="form__item <?=$classname;?>">
        <label for="name">Имя*</label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=$value;?>">
        <span class="form__error"><?= (isset($errors['name'])) ? $errors['name'] : '' ?></span>
    </div>
    <?php $classname = isset($errors['message']) ? "form__item--invalid" : "";
    $value = isset($form['message']) ? $form['message'] : ""; ?>
    <div class="form__item <?=$classname;?>">
        <label for="message">Контактные данные*</label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться" ><?=$value;?></textarea>
        <span class="form__error"><?= (isset($errors['message'])) ? $errors['message'] : '' ?></span>
    </div>
    <?php $classname = isset($form['avatar']) ? "form__item--uploaded" : "";?>
    <?php $avatar = isset($form['avatar']) ? $form['avatar'] : "";?>
    <div class="form__item form__item--file form__item--last">
        <label>Аватар</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="<?=$avatar;?>" width="113" height="113" alt="Ваш аватар">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="photo2" name="avatar" value="">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
</form>