<?php $classname = isset($errors) ? "form--invalid" : ""; ?>
<form class="form form--add-lot container <?=($classname);?>" action="add.php" method="post" enctype="multipart/form-data">
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <?php $classname = isset($errors['lot_name']) ? "form__item--invalid" : "";
        $value = isset($lot['lot_name']) ? $lot['lot_name'] : ""; ?>
        <div class="form__item <?=$classname;?>">
            <label for="lot_name">Наименование</label>
            <input id="lot_name" type="text" name="lot_name" placeholder="Введите название лота" value="<?= $value;?>">
            <span class="form__error"><?= (isset($errors['lot_name'])) ? $errors['lot_name'] : '' ?></span>
        </div>
        <?php $classname = isset($errors['category']) ? "form__item--invalid" : "";
        $value1 = isset($lot['category']) ? $lot['category'] : ""; ?>
        <div class="form__item <?=$classname;?>">
            <label for="category">Категория</label>
            <select id="category" name="category">
                <option disabled selected>Выберите категорию</option>
                <?php foreach ($categories as $category):?>
                    <option value="<?=$category['categories_id'];?>"><?=$category['categories_name'];?></option>
                <?php endforeach; ?>
            </select>
            <span class="form__error"><?= (isset($errors['category'])) ? $errors['category'] : '' ?></span>
        </div>
    </div>
    <?php $classname = isset($errors['description']) ? "form__item--invalid" : "";
    $value = isset($lot['description']) ? $lot['description'] : ""; ?>
    <div class="form__item form__item--wide <?=$classname;?>">
        <label for="description">Описание</label>
        <textarea id="description" name="description" placeholder="Напишите описание лота"><?=$value;?></textarea>
        <span class="form__error"><?= (isset($errors['description'])) ? $errors['description'] : '' ?></span>
    </div>
    <?php $classname = isset($lot['path']) ? "form__item--uploaded" : "";?>
    <?php $img_lot = isset($lot['path']) ? $lot['path'] : "";?>
    <div class="form__item form__item--file <?=$classname;?>">
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="<?=$img_lot;?>" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="photo2" name="lot_img" value="">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
    </div>
    <div class="form__container-three">
        <?php $classname = isset($errors['lot_rate']) ? "form__item--invalid" : "";
        $value = isset($lot['lot_rate']) ? $lot['lot_rate'] : ""; ?>
        <div class="form__item form__item--small <?=$classname;?>">
            <label for="lot_rate">Начальная цена</label>
            <input id="lot_rate" type="number" name="lot_rate" placeholder="0" value="<?=$value;?>">
            <span class="form__error"><?= (isset($errors['lot_rate'])) ? $errors['lot_rate'] : '' ?></span>
        </div>
        <?php $classname = isset($errors['lot_step']) ? "form__item--invalid" : "";
        $value = isset($lot['lot_step']) ? $lot['lot_step'] : ""; ?>
        <div class="form__item form__item--small <?=$classname;?>">
            <label for="lot_step">Шаг ставки</label>
            <input id="lot_step" type="number" name="lot_step" placeholder="0" value="<?=$value;?>">
            <span class="form__error"><?= (isset($errors['lot_step'])) ? $errors['lot_step'] : '' ?></span>
        </div>
        <?php $classname = isset($errors['lot_date']) ? "form__item--invalid" : "";
        $value = isset($lot['lot_date']) ? $lot['lot_date'] : ""; ?>
        <div class="form__item <?=$classname;?>">
            <label for="lot_date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot_date" type="date" name="lot_date" value="<?=$value;?>">
            <span class="form__error"><?= (isset($errors['lot_date'])) ? $errors['lot_date'] : '' ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
 </form>
