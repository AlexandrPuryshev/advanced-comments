CREATE DATABASE IF NOT EXISTS `yii2advanced`;
CREATE DATABASE IF NOT EXISTS `yii2advanced_test`;

CREATE TABLE yii2advanced.social_category (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE yii2advanced_test.social_category (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE yii2advanced.social_comment (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_author` (`authorId`),
KEY `FK_comment_post` (`postId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE yii2advanced_test.social_comment (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_author` (`authorId`),
KEY `FK_comment_post` (`postId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE yii2advanced.social_migration (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE yii2advanced_test.social_migration (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE yii2advanced.social_post (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `anons` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publishStatus` enum('draft','publish') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `FK_post_author` (`authorId`),
KEY `FK_post_category` (`categoryId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE yii2advanced_test.social_post (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `anons` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publishStatus` enum('draft','publish') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `FK_post_author` (`authorId`),
KEY `FK_post_category` (`categoryId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE yii2advanced.social_user (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `authKey` varchar(32) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `passwordResetToken` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `passwordResetToken` (`passwordResetToken`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


CREATE TABLE yii2advanced_test.social_user (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `authKey` varchar(32) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `passwordResetToken` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `passwordResetToken` (`passwordResetToken`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO yii2advanced.social_user (`id`, `username`, `authKey`, `passwordHash`, `passwordResetToken`, `email`, `role`, `status`, `createdAt`, `updatedAt`)
  SELECT * FROM (SELECT '1', 'admin', 'XpymfHPnUkW5kH4Om0zccYkWIQ-gUV9U', '$2y$13$aEEt.w9.q1iYsjlqxpHNSOhaGdFSYaUsUsVF/wp.gbkH2OIhc5vu2', 't5GU9NwpuGYSfb7FEZMAxqtuz2PkEvv', 'Kronos0041@gmail.com', '10', '100', '2017-10-17 11:24:24', '2017-10-17 11:24:25') AS tmp
  WHERE NOT EXISTS (
      SELECT email FROM yii2advanced_test.social_user WHERE email = 'admin@example.com'
  ) LIMIT 1;

INSERT INTO yii2advanced.social_category (`id`, `name`, `description`)
  SELECT * FROM (SELECT '1', 'Первая категория', 'Описание') AS tmp
  WHERE NOT EXISTS (
      SELECT name FROM yii2advanced_test.social_category WHERE name = 'Первая категория'
  ) LIMIT 1;

INSERT INTO yii2advanced.social_category (`id`, `name`, `description`)
  SELECT * FROM (SELECT '2', 'Вторая категория', 'Описание') AS tmp
  WHERE NOT EXISTS (
      SELECT name FROM yii2advanced_test.social_category WHERE name = 'Вторая категория'
  ) LIMIT 1;

INSERT INTO yii2advanced.social_post (`id`, `title`, `anons`, `content`, `categoryId`, `authorId`, `image`, `publishStatus`, `createdAt`, `updatedAt`)
  SELECT * FROM (SELECT '3', 'Как мы искали квартир', 'Навеял этот пост https://pikabu.ru/story/kak_chuzhaya_zhadnost_ot_katastrofyi_uberegla_5425636', 'Года три назад мы с мужем решили взять квартиру в ипотеку.  Больше месяца искали подходящие по стоимости и расположению варианты,  но ничего не подходило.  И в один вечер видим новое объявление, 5 минут как поместили.  Тут же звоню,  договариваюсь о встрече.  На следующий день встречаемся,  смотрим квартиру.  Она требует ремонта,  но мы и понимали,  что наши возможности квартиру с ремонтом не потянут. Цена устраивает,  расположение тоже.  Договорились уже на следующий день внести задаток и заключить договор.  Приезжаю с деньгами,  а хозяин говорит,  что они решили устроить торги.  Типа,  ещё желающие объявились, и так им риэлтор посоветовала. Я говорю:  "Так мы же первые пришли,  какие торги?".  Хозяин отвечает,  что это их окончательное решение,  завтра будут торги,  приходите,  если предложите больше,  квартира ваша.  Психую,  говорю,  что нам это нахер не надо,  и ухожу.
На следующий день -  звонок от этого юмориста.  Предлагает подумать ещё раз, ведь супервыгодное предложение,  мы такую квартиру нигде не найдем.  Я вежливо отказываюсь и поздравляю наших конкурентов с приобретением квартиры мечты.
Через день -  опять звонок.  Мне сообщают,  что хозяева передумали с торгами и готовы продать квартиру нам,  но немного дороже.  Отказываюсь уже не очень вежливо.
На следующий день -  очередной звонок с предложением купить квартиру уже за старую стоимость.  Меня эта ситуация начинает крепко бесить,  и связываться с такими людьми,  определённо,  не хочу.  Отказываюсь и прошу больше не звонить.  Звонков было ещё около пяти.  Хозяин кричал в трубку,  что им срочно нужны были деньги,  у них тяжёлая ситуация,  они на нас надеялись,  а мы,  такие сволочи,  их подвели.  Трубку я больше не брала.  Звонил потом с нового номера их риэлторша и тоже несла какую-то хрень.
Эта волшебная квартира висела на продаже больше года,  итоговая стоимость была ниже тысяч на 150. Потом объявление убрали.  Может,  продали,  а может передумали продавать. ', '2', '1', NULL, 'publish', '2017-10-21 18:20:38', '2017-10-21 18:20:39') AS tmp
  WHERE NOT EXISTS (
      SELECT title FROM yii2advanced_test.social_post WHERE title = 'Как мы искали квартир'
  ) LIMIT 1;
INSERT INTO yii2advanced_test.social_user (`id`, `username`, `authKey`, `passwordHash`, `passwordResetToken`, `email`, `role`, `status`, `createdAt`, `updatedAt`)
  SELECT * FROM (SELECT '2', 'admin', 'XpymfHPnUkW5kH4Om0zccYkWIQ-gUV9U', '$2y$13$aEEt.w9.q1iYsjlqxpHNSOhaGdFSYaUsUsVF/wp.gbkH2OIhc5vu2', 't5GU9NwpuGYSfb7FEZMAxqtuz2PkEvv', 'Kronos0041@gmail.com', '100', '1', '2017-10-17 11:24:24', '2017-10-17 11:24:25') AS tmp
  WHERE NOT EXISTS (
      SELECT email FROM yii2advanced_test.social_user WHERE email = 'admin@example.com'
  ) LIMIT 1;
INSERT INTO yii2advanced_test.social_category (`id`, `name`, `description`)
  SELECT * FROM (SELECT '1', 'Первая категория', 'Описание') AS tmp
  WHERE NOT EXISTS (
      SELECT name FROM yii2advanced_test.social_category WHERE name = 'Первая категория'
  ) LIMIT 1;
INSERT INTO yii2advanced_test.social_category (`id`, `name`, `description`)
  SELECT * FROM (SELECT '2', 'Вторая категория', 'Описание') AS tmp
  WHERE NOT EXISTS (
      SELECT name FROM yii2advanced_test.social_category WHERE name = 'Вторая категория'
  ) LIMIT 1;
INSERT INTO yii2advanced_test.social_post (`id`, `title`, `anons`, `content`, `categoryId`, `authorId`, `image`, `publishStatus`, `createdAt`, `updatedAt`)
  SELECT * FROM (SELECT '3', 'Как мы искали квартир', 'Навеял этот пост https://pikabu.ru/story/kak_chuzhaya_zhadnost_ot_katastrofyi_uberegla_5425636', 'Года три назад мы с мужем решили взять квартиру в ипотеку.  Больше месяца искали подходящие по стоимости и расположению варианты,  но ничего не подходило.  И в один вечер видим новое объявление, 5 минут как поместили.  Тут же звоню,  договариваюсь о встрече.  На следующий день встречаемся,  смотрим квартиру.  Она требует ремонта,  но мы и понимали,  что наши возможности квартиру с ремонтом не потянут. Цена устраивает,  расположение тоже.  Договорились уже на следующий день внести задаток и заключить договор.  Приезжаю с деньгами,  а хозяин говорит,  что они решили устроить торги.  Типа,  ещё желающие объявились, и так им риэлтор посоветовала. Я говорю:  "Так мы же первые пришли,  какие торги?".  Хозяин отвечает,  что это их окончательное решение,  завтра будут торги,  приходите,  если предложите больше,  квартира ваша.  Психую,  говорю,  что нам это нахер не надо,  и ухожу.
На следующий день -  звонок от этого юмориста.  Предлагает подумать ещё раз, ведь супервыгодное предложение,  мы такую квартиру нигде не найдем.  Я вежливо отказываюсь и поздравляю наших конкурентов с приобретением квартиры мечты.
Через день -  опять звонок.  Мне сообщают,  что хозяева передумали с торгами и готовы продать квартиру нам,  но немного дороже.  Отказываюсь уже не очень вежливо.
На следующий день -  очередной звонок с предложением купить квартиру уже за старую стоимость.  Меня эта ситуация начинает крепко бесить,  и связываться с такими людьми,  определённо,  не хочу.  Отказываюсь и прошу больше не звонить.  Звонков было ещё около пяти.  Хозяин кричал в трубку,  что им срочно нужны были деньги,  у них тяжёлая ситуация,  они на нас надеялись,  а мы,  такие сволочи,  их подвели.  Трубку я больше не брала.  Звонил потом с нового номера их риэлторша и тоже несла какую-то хрень.
Эта волшебная квартира висела на продаже больше года,  итоговая стоимость была ниже тысяч на 150. Потом объявление убрали.  Может,  продали,  а может передумали продавать. ', '2', '1', NULL, 'publish', '2017-10-21 18:20:38', '2017-10-21 18:20:39') AS tmp
  WHERE NOT EXISTS (
      SELECT title FROM yii2advanced_test.social_post WHERE title = 'Как мы искали квартир'
  ) LIMIT 1;