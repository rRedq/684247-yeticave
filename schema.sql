create table lot (
    lot_id int auto_increment primary key ,
    date_start datetime,
    lot_name char(128),
    description_lot char(255),
    image char(128),
    start_price int,
    date_end date,
    step_bet int,
    categories_id int,
    user_win_id int,
    user_author_id int,
    foreign key(categories_id) references categories(categories_id),
    foreign key(user_win_id) references user(user_id),
    foreign key(user_author_id) references user(user_id)
);
create table categories (
    categories_id int auto_increment primary key,
    categories_name char(64),
    css_class varchar(128)
);
create table rate (
    rate_id int auto_increment primary key,
    date_rate datetime,
    summa int,
    user_id int,
    lot_id int,
    foreign key(user_id) references user(user_id),
    foreign key(lot_id) references lot(lot_id)
);
create table user (
    user_id int auto_increment primary key,
    date_registration datetime,
    email char(64),
    name char(64),
    password char(255),
    avatar char(128),
    contacts char(255)
);
create unique index ui_categories_name on categories(categories_name);
create unique index ui_user_email on user(email);
create unique index ui_user_name on user(name);
create fulltext index i_lot_name on lot(lot_name);
create index i_lot_categories on lot(categories_id);
create index lot_win on lot(user_win_id, date_end);
create fulltext index i_lot_description on lot(description_lot);
create fulltext index i_lot_name on lot(lot_name);
create index i_user_email on user(email);