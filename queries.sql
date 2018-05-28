insert into categories(categories_id, categories_name, css_class) values
    (1, 'Доски и лыжи', 'promo__item--boards'),
    (null, 'Крепления', 'promo__item--attachment'),
    (null, 'Ботинки', 'promo__item--boots'),
    (null, 'Одежда', 'promo__item--clothing'),
    (null, 'Инструменты', 'promo__item--tools'),
    (null, 'Разное', 'promo__item--other');

insert into user(user_id, date_registration, email, name, password, avatar, contacts) values
    (1, null, 'ignat.v@gmail.com' ,'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', null, null),
    (null, null, 'kitty_93@li.ru', 'Леночка', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', null, null ),
    (null, null, 'warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', null, null );

insert into lot(lot_id, date_start, lot_name, description_lot, image, start_price, date_end, step_bet, categories_id, user_win_id, user_author_id) values
    (1, '2018-05-28 00:58:58', '2014 Rossignol District Snowboard', null, 'img/lot-1.jpg', 10999, '2018-06-28', 50, 1, null, 1),
    (null, '2018-05-28 00:58:58', 'DC Ply Mens 2016/2017 Snowboard', null, 'img/lot-2.jpg', 159999, '2018-06-21', 100, 1, null, 2),
    (null, '2018-05-28 00:58:58', 'Крепления Union Contact Pro 2015 года размер L/XL', null, 'img/lot-3.jpg', 8000, '2018-06-23', 100, 2, null, 3),
    (null, '2018-05-28 00:58:58', 'Ботинки для сноуборда DC Mutiny Charocal', null, 'img/lot-4.jpg', 10999, '2018-06-18', 50, 3, null, 2),
    (null, '2018-05-28 00:58:58', 'Куртка для сноуборда DC Mutiny Charocal', null, 'img/lot-5.jpg', 7500, '2018-06-11', 100, 4, null,3),
    (null, '2018-05-28 00:58:58', 'Маска Oakley Canopy', null, 'img/lot-6.jpg', 5400, '2018-06-19', 100, 6, null, 1);

insert into rate(rate_id, date_rate, summa, user_id, lot_id) values
    (1, '2018-05-28 00:58:58', 12500, 1, 1),
    (null, '2018-05-28 03:50:58', 11500, 2, 1),
    (null, '2018-05-29 15:18:51', 11500, 3, 1);