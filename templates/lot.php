<section class="lot-item container">
    <h2><?=htmlspecialchars($lot['lot_name']);?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?=$lot['image'];?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?=$lot['categories_name'];?></span></p>
            <p class="lot-item__description"><?=htmlspecialchars($lot['description_lot']);?></p>
        </div>
        <div class="lot-item__right">
            <?php foreach ($users as $user) :?>
            <?php $bet_owner = intval($authenticated_user['user_id']);?>
            <?php endforeach;?>
            <?php if (isset($authenticated_user)
                && ($lot['user_author_id']) !== intval($authenticated_user['user_id'])
                && strtotime($lot['date_end']) >= time()
                && (isset($users[$bet_owner])) !== true)
                 : ?>
            <div class="lot-item__state">
                <div class="lot-item__timer timer">
                    <?= show_timer(strtotime($lot['date_end'])) ;?>
                </div>
                <div class="lot-item__cost-state">
                    <?php $price = $max_summa >= $lot['start_price'] ? $max_summa : $lot['start_price']; ?>
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?=price_decor($price);?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?=price_decor($price + $lot['step_bet']);?></span>
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
                    <?php foreach ($rate as $key) : ?>
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