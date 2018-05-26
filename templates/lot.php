<?php foreach ($lot as $value): ?>
<section class="lot-item container">
    <h2><?=htmlspecialchars($value['lot_name']);?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?=$value['image'];?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?=$value['categories_name'];?></span></p>
            <p class="lot-item__description"><?=htmlspecialchars($value['description_lot']);?></p>
        </div>
        <div class="lot-item__right">
            <?php if (isset($authenticated_user)
                && ($value['user_author_id']) !== intval($authenticated_user['user_id'])
                && strtotime($value['date_end']) >= time()
                && $value['user_id'] !== intval($authenticated_user['user_id'])) : ?>
            <div class="lot-item__state">
                <div class="lot-item__timer timer">
                    <?= show_timer(strtotime($value['date_end'])) ;?>
                </div>
                <div class="lot-item__cost-state">
                    <?php $price = isset($value['summa']) ? $value['summa'] : $value['start_price']; ?>
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?=$price;?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?=$value['step_bet'];?></span>
                    </div>
                </div>
                <?php $classname = isset($error) ? "form__item--invalid" : ""; ?>
                <form class="lot-item__form <?=$classname;?>" action="lot.php?id=<?=$lot_id;?>" method="post" enctype="multipart/form-data">
                    <p class="lot-item__form-item">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="number" name="cost" placeholder="">
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            </div>
            <?php endif ;?>
            <div class="history">
                <h3>История ставок (<span>10</span>)</h3>
                <table class="history__list">
                    <?php foreach ($rate as $key) : ; ?>
                    <tr class="history__item">
                        <td class="history__name"><?=$key['name'];?></td>
                        <td class="history__price"><?=$key['summa'];?></td>
                        <td class="history__time"><?=$key['date_rate'];?></td>
                    </tr>
                    <?php endforeach;?>

                </table>
            </div>
        </div>
    </div>
</section>
<?php endforeach; ?>