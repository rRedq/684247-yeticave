insert into categories(categories_id, categories_name) values
    (1, 'Доски и лыжи'),
    (null, 'Крепления'),
    (null, 'Ботинки'),
    (null, 'Одежда'),
    (null, 'Инструменты'),
    (null, 'Разное');

insert into user(user_id, date_registration, email, name, password, avatar, contacts) values
    (1, '2018-05-06 05:31:22', 'rogov@gmail.com' ,'Василий', 'rogovvasya', null, null),
    (null, '2015-03-06', 'katya123@mail.ru', 'Катя', '151713', null, null );

insert into lot(lot_id, date_start, lot_name, description_lot, image, start_price, date_end, step_bet, categories_id, user_win_id, user_author_id) values
    (1, '2018-05-06 05:31:22', 'Лыжный ботинок', 'Лыжный ботинок, но один', null, 100, '2018-08-31', 50, 3, 1, 2),
    (null, '2018-05-03 00:11:01', 'Сноуборд', 'Красный сноуборд', null, 2500, '2018-09-13', 50, 1, 2, 1);

insert into rate(rate_id, date_rate, summa, user_id, lot_id) values
    (1, '2018-06-17 05:13:17', 3000, 2, 1),
    (null, '2018-06-19 05:13:17', 3500, 1, 2);

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