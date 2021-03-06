﻿<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $value): ?>
            <li class='promo_item <?=$value['css_class'];?>'>
                <a class="promo__link" href="all-lots.html"><?=$value['categories_name'];?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($table as $key => $item): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=$item['image'];?>" width="350" height="260" alt="Сноуборд">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$item['categories_name']; ?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$item['lot_id'];?>"><?=htmlspecialchars($item['lot_name']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=htmlspecialchars(price_decor($item['start_price'])); ?></span>
                        </div>
                        <div class="lot__timer timer">
                            <?= show_timer(strtotime($item['date_end']));?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>