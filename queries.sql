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
    (1, null, '2014 Rossignol District Snowboard', null, 'img/lot-1.jpg', 10999, null, 50, 1, null, null),
    (null, null, 'DC Ply Mens 2016/2017 Snowboard', null, 'img/lot-2.jpg', 159999, null, null, 1, null, null),
    (null, null, 'Крепления Union Contact Pro 2015 года размер L/XL', null, 'img/lot-3.jpg', 8000, null, null, 2, null, null),
    (null, null, 'Ботинки для сноуборда DC Mutiny Charocal', null, 'img/lot-4.jpg', 10999, null, 50, 3, null, null),
    (null, null, 'Куртка для сноуборда DC Mutiny Charocal', null, 'img/lot-5.jpg', 7500, null, null, 4, null, null),
    (null, null, 'Маска Oakley Canopy', null, 'img/lot-6.jpg', 5400, null, null, 6, null, null);

insert into rate(rate_id, date_rate, summa, user_id, lot_id) values
    (1, null, 12500, 1, 2),
    (null, null, 11500, 2, 2),
    (null, null, 11500, 3, 2);



/*получить все категории*/
select categories_name from categories
/*получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории;*/
select lot_id, lot_name,start_price,image, summa, categories_id from lot, rate
    where to_days(now()) - to_days(date_start) <= 30;
/*показать лот по его id. Получите также название категории, к которой принадлежит лот*/
select * from lot as c left join categories as u on c.categories_id = u.categories_id
    where lot_id = 1;
/*обновить название лота по его идентификатору*/
update lot set lot_name = 'Новое имя'
    where lot_id = '1';
/*получить список самых свежих ставок для лота по его идентификатору*/
select summa from rate
    where lot_id = 1
    order by summa desc
    limit 0, 5;