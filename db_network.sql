/*
Таблица пользователей соц сети (профиль).
 user_latitude, user_longitude - координаты пользователя на карте.
*/

DROP TABLE IF EXISTS  users ;
CREATE TABLE  users (
  user_name CHAR(30) NOT NULL,
  family_name  CHAR(50) NOT NULL,
  passwd CHAR(40) NOT NULL,
  user_email VARCHAR(40) NOT NULL,
  user_age CHAR(3) NOT NULL,
  user_birthday_visibility_id INT(1) NOT NULL DEFAULT '1',
  user_birthday VARCHAR(100) NOT NULL DEFAULT '',
  user_telephone CHAR(20) NOT NULL,
  user_photos  CHAR(30),
  user_latitude CHAR(50) NOT NULL,
  user_longitude CHAR(50) NOT NULL,
  user_hobby  text, 
  favorite_music text,
  favorite_shows text,
  favorite_movies text,
  favorite_books text,
  favorite_games text,
  about_me text,
  user_id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(user_id)
);

INSERT INTO `users` VALUES('Ekaterina', 'Khlebnikova', '123456', 'eka1308@yandex.ru', '28', 1, '13.08.1985', '89516712948', '1', '123456', '4233112', 'reading', 'grang', 'doctor who', 'sherloc', 'bulgakov', 'uno', 'funny', 1);

SELECT CONCAT( user_name,  ' ', family_name ) 
FROM  `users` 

/*
Таблица категорий событий
*/

DROP TABLE IF EXISTS events_category;
CREATE TABLE events_category (
  event_category_id INT(20) NOT NULL auto_increment,
  event_category_name VARCHAR(150) DEFAULT NULL,
  PRIMARY KEY  (event_category_id)
);

INSERT INTO `events_category` (`event_category_name`) VALUES('Birthday Party');
INSERT INTO `events_category` (`event_category_name`) VALUES('Cocktail Party');
INSERT INTO `events_category` (`event_category_name`) VALUES('Holiday Party');
INSERT INTO `events_category` (`event_category_name`) VALUES('Movie/TV Night');
INSERT INTO `events_category` (`event_category_name`) VALUES('Games');
INSERT INTO `events_category` (`event_category_name`) VALUES('Board Games');
INSERT INTO `events_category` (`event_category_name`) VALUES('Study Group');
INSERT INTO `events_category` (`event_category_name`) VALUES('Lecture');
INSERT INTO `events_category` (`event_category_name`) VALUES('Workshop');
INSERT INTO `events_category` (`event_category_name`) VALUES('Sports Practice');
INSERT INTO `events_category` (`event_category_name`) VALUES('Sports Games');
INSERT INTO `events_category` (`event_category_name`) VALUES('Networking Party');


/*
Таблица - подробное описание событий (фото, координаты, статус, пригласить друзей, дата проведения и дата публикации, дата изменения), 
связана внешним ключом с таблицей events_category
*/
DROP TABLE IF EXISTS  events;
CREATE TABLE  events (
  event_name CHAR(100) NOT NULL,
  user_name CHAR(30) NOT NULL,
  event_description  text,
  event_photos  CHAR(30),
  event_price  DECIMAL(10,2) DEFAULT NULL,
  event_latitude VARCHAR(255) NOT NULL,
  event_longitude VARCHAR(255) NOT NULL,
  event_startdate DATE  NOT NULL,
  event_start_time VARCHAR(40) NOT NULL,
  event_end_time VARCHAR(40) NOT NULL,
  event_address CHAR(150) NOT NULL,
  event_city CHAR(150) NOT NULL,
  event_bring_friends enum('yes','no') NOT NULL DEFAULT 'yes',
  event_show_guest enum('yes','no') NOT NULL DEFAULT 'yes',
  event_type enum('open','secret','closed') NOT NULL DEFAULT 'open',
  event_date_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  event_status enum('ok','blocked','deleted') NOT NULL DEFAULT 'ok',
  event_phone varchar(20) NOT NULL,
  event_date_modified timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  event_category_number INT NOT NULL DEFAULT '0',
  event_id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(event_id),
  INDEX (event_category_number),
  FOREIGN KEY (event_category_number) REFERENCES events_category (event_category_id)
);


INSERT INTO `test`.`events` (`event_name`, `user_name`, `event_description`, `event_photos`, `event_price`, `event_latitude`, `event_longitude`, `event_startdate`, `event_start_time`, `event_end_time`, `event_address`, `event_city`, `event_bring_friends`, `event_show_guest`, `event_type`, `event_date_added`, `event_status`, `event_phone`, `event_date_modified`, `event_category_number`, `event_id`) VALUES ('Game 3', 'Kristina', 'test 3, friends and games', NULL, '1000', '35363656', '56456464', '2013-12-31', '22.00', '04.00', 'Dvortsovaya', 'St-Petersburg', 'yes', 'yes', 'open', CURRENT_TIMESTAMP, 'ok', '4532534634', '0000-00-00 00:00:00', '3', NULL);
 INSERT INTO `u32827_t`.`events` (
`event_name` ,
`user_name` ,
`event_description` ,
`event_photos` ,
`event_price` ,
`event_latitude` ,
`event_longitude` ,
`event_startdate` ,
`event_start_time` ,
`event_end_time` ,
`event_address` ,
`event_city` ,
`event_bring_friends` ,
`event_show_guest` ,
`event_type` ,
`event_date_added` ,
`event_status` ,
`event_phone` ,
`event_date_modified` ,
`event_category_number` ,
`event_id`
)
VALUES (
'Game 2', 'Ekaterina', 'good game, much fun', '8796969', '0', '678686886', '47467688', '2013-12-19', '19.30', '22.30', 'Пионерская, 21', 'Санкт-Петербург', 'yes', 'yes', 'open',
CURRENT_TIMESTAMP , 'ok', '479675935', '0000-00-00 00:00:00', '4', NULL
)

/*
Таблица показывает какие пользователи в каком событии участвуют (объединяет таблицы users и events)
*/
DROP TABLE IF EXISTS  eventslist;
CREATE TABLE eventslist (
  user_number INT NOT NULL DEFAULT '0',
  event_number INT NOT NULL DEFAULT '0',
  id  INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  INDEX (user_number),
  INDEX (event_number),
  FOREIGN KEY (user_number) REFERENCES users (user_id),
  FOREIGN KEY (event_number) REFERENCES events (event_id)
  );
  
  INSERT INTO `test`.`eventslist` (`user_number`, `event_number`, `id`) VALUES ('1', '5', NULL), ('2', '1', NULL);
  
 /*
Таблица показывает каким пользователям какое событие понравилось, рекомендации (объединяет таблицы users и events)
*/
  DROP TABLE IF EXISTS  eventslike;
  CREATE TABLE eventslike (
  user_like INT NOT NULL DEFAULT '0',
  event_number INT NOT NULL DEFAULT '0',
  id  INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  INDEX (user_like),
  INDEX (event_number),
  FOREIGN KEY (user_like) REFERENCES users (user_id),
  FOREIGN KEY (event_number) REFERENCES events (event_id)
  );
 
 INSERT INTO `test`.`eventslike` (`user_like`, `event_number`, `id`) VALUES ('2', '1', NULL), ('5', '3', NULL);
 /*
Список друзей пользователя
*/
 
 DROP TABLE IF EXISTS friends;
 CREATE TABLE friends (
  id int NOT NULL AUTO_INCREMENT,
  user_number INT NOT NULL DEFAULT '0',
  friend_number INT NOT NULL DEFAULT '0',
  PRIMARY KEY  (id),
  INDEX (user_number),
  INDEX (friend_number),
  FOREIGN KEY (user_number) REFERENCES users (user_id),
  FOREIGN KEY (friend_number) REFERENCES users (user_id)
); 

INSERT INTO `test`.`friends` (`id`, `user_number`, `friend_number`) VALUES (NULL, '2', '1'), (NULL, '2', '3');

 /*
Обсуждение событий, комментарии
postid - идентификатор сообщения,
parent - идентификатор родительского сообщения,
posted - дата и время отправки
*/
DROP TABLE IF EXISTS  header_eventdiscussion ;
CREATE TABLE  header_eventdiscussion (
  parent INT NOT NULL,
  user_name CHAR(30) NOT NULL,
  user_id INT NOT NULL,
  title CHAR(20) NOT NULL,
  children INT NOT NULL DEFAULT '0',
  area INT NOT NULL DEFAULT '1',
  posted datetime NOT NULL,
  postid INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY
);

DROP TABLE IF EXISTS  body_eventdiscussion ;
CREATE TABLE  body_eventdiscussion
(
  postid INT unsigned NOT NULL PRIMARY KEY,
  message TEXT
);

INSERT INTO `test`.`body_eventdiscussion` (`postid`, `message`) VALUES ('1', 'text 1'), ('2', 'text 2');

/*
Маркеры для отображения событий на карте
*/

DROP TABLE IF EXISTS  marker;
CREATE TABLE marker (
  marker_id INT(11) NOT NULL AUTO_INCREMENT,
  marker_category_id INT(11) DEFAULT NULL,
  marker_marker_type_id INT(11) DEFAULT NULL,
  marker_latitude VARCHAR(255) DEFAULT NULL,
  marker_longitude VARCHAR(255) DEFAULT NULL,
  marker_image VARCHAR(255) DEFAULT NULL,
  marker_size_x INT(11) DEFAULT NULL,
  marker_size_y INT(11) DEFAULT NULL,
  marker_point1_x INT(11) DEFAULT NULL,
  marker_point1_y INT(11) DEFAULT NULL,
  marker_point2_x INT(11) DEFAULT NULL,
  marker_point2_y INT(11) DEFAULT NULL,
  marker_title_ru VARCHAR(255) DEFAULT NULL,
  marker_title_en VARCHAR(255) DEFAULT NULL,
  marker_content_en VARCHAR(255) DEFAULT NULL,
  marker_type char(10) DEFAULT NULL,
  marker_content_ru VARCHAR(255) DEFAULT NULL,
  marker_address VARCHAR(255) NOT NULL,
  PRIMARY KEY (marker_id),
  KEY `FK_Reference_33` (marker_category_id),
  KEY `FK_Reference_34` (marker_marker_type_id)
);

CREATE TABLE IF NOT EXISTS `marker_type` (
  marker_type_id INT(11) NOT NULL AUTO_INCREMENT,
  marker_type_name VARCHAR(255) DEFAULT NULL,
  marker_type_acronym VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (marker_type_id)
);

select concat (user_name, " ", family_name) as Fr from users where user_id in
(select friend_number from friends where user_number = 2; 
/*
показать список  друзей
*/

select concat (user_name, " ", family_name) as FrU from users where user_id in
(select user_number from eventslist where event_number = 3); 
/*
ФИО друзей, которые участвуют в мероприятии 3
*/