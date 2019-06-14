-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия на сървъра:            10.1.31-MariaDB - mariadb.org binary distribution
-- ОС на сървъра:                Win32
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дъмп структура за таблица php_web_test.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `author_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_answers_author_id__users_id` (`author_id`),
  KEY `FK_answers_question_id__questions_id` (`question_id`),
  CONSTRAINT `FK_answers_author_id__users_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_answers_question_id__questions_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица php_web_test.answers: ~10 rows (approximately)
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` (`id`, `body`, `author_id`, `question_id`, `created_on`) VALUES
	(1, 'nqkav otgovor', 2, 2, '2019-05-30 20:49:02'),
	(2, 'drug otgovor', 2, 2, '2019-05-30 20:49:19'),
	(3, 'treti otgowor', 2, 2, '2019-05-30 20:49:50'),
	(4, 'esfgdbwefsvbgwRFESDVWEDS', 1, 2, '2019-05-30 20:50:14'),
	(5, '<font color=red>asdfsg</font>', 1, 2, '2019-05-30 20:50:27'),
	(6, 'trudno :(', 2, 4, '2019-05-30 20:52:13'),
	(7, 'dsgdfgdgh', 2, 1, '2019-05-30 20:55:54'),
	(8, 'esgdnmhtyjtergf', 4, 2, '2019-05-30 20:57:53'),
	(9, 'wfegrfbdvdef', 4, 1, '2019-05-30 20:58:34'),
	(10, 'gfbefagtrhrwsfr1111111', 4, 1, '2019-05-30 20:59:09');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.authentications
CREATE TABLE IF NOT EXISTS `authentications` (
  `auth_string` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`auth_string`),
  KEY `FK_authentications_user_id__users_id` (`user_id`),
  CONSTRAINT `FK_authentications_user_id__users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Дъмп данни за таблица php_web_test.authentications: ~3 rows (approximately)
/*!40000 ALTER TABLE `authentications` DISABLE KEYS */;
INSERT INTO `authentications` (`auth_string`, `user_id`) VALUES
	('5cf0216e9e8b5', 1),
	('5cf0255e2316c', 2),
	('5cf02641a5457', 6);
/*!40000 ALTER TABLE `authentications` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Дъмп данни за таблица php_web_test.categories: ~3 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Programming'),
	(2, 'Databases'),
	(3, 'Chat'),
	(4, 'Education');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(11) NOT NULL,
  `facebook_url` varchar(200) DEFAULT NULL,
  `born_on` date DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `FK_profiles_user_id__users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Дъмп данни за таблица php_web_test.profiles: ~2 rows (approximately)
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` (`user_id`, `facebook_url`, `born_on`) VALUES
	(1, 'fb.com/a', NULL),
	(2, NULL, '2019-05-27');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `body` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_questions_category_id__categories_id` (`category_id`),
  KEY `FK_questions_author_id__users_id` (`author_id`),
  CONSTRAINT `FK_questions_author_id__users_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_questions_category_id__categories_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Дъмп данни за таблица php_web_test.questions: ~6 rows (approximately)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`id`, `title`, `body`, `category_id`, `author_id`, `created_on`) VALUES
	(1, 'Nov vapros', 'Tui e nov vapros molq\r\nTui e nov vapros molq\r\nTui e nov vapros molq\r\nTui e nov vapros molq', 3, 2, '2019-05-30 20:07:42'),
	(2, 'Vtori vapros', 'I tui e vapros', 3, 2, '2019-05-30 20:09:17'),
	(3, 'Treti vapros', 'wvfbgwesvgeqfavdgrf', 2, 2, '2019-05-30 20:31:34'),
	(4, 'Kak se pishe na PHP', 'Molq da mi kajete', 1, 1, '2019-05-30 20:52:00'),
	(5, 'dsfbds', 'vbdsvxbgd', 3, 4, '2019-05-30 20:57:46'),
	(6, 'fdvsc', 'vfdscswcvfcx', 4, 2, '2019-05-30 21:24:53');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.questions_tags
CREATE TABLE IF NOT EXISTS `questions_tags` (
  `question_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`,`tag_id`),
  KEY `FK_questions_tags_tag_id__tags_id` (`tag_id`),
  CONSTRAINT `FK_questions_tags_question_id__questions_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `FK_questions_tags_tag_id__tags_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица php_web_test.questions_tags: ~17 rows (approximately)
/*!40000 ALTER TABLE `questions_tags` DISABLE KEYS */;
INSERT INTO `questions_tags` (`question_id`, `tag_id`) VALUES
	(1, 1),
	(1, 3),
	(1, 4),
	(2, 1),
	(2, 4),
	(2, 5),
	(3, 3),
	(3, 5),
	(3, 6),
	(4, 1),
	(4, 2),
	(5, 1),
	(5, 4),
	(5, 7),
	(6, 3),
	(6, 4),
	(6, 6);
/*!40000 ALTER TABLE `questions_tags` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Дъмп данни за таблица php_web_test.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'USER'),
	(2, 'ADMIN');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Дъмп данни за таблица php_web_test.tags: ~7 rows (approximately)
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`id`, `name`) VALUES
	(1, 'PHP'),
	(2, 'SQL'),
	(3, 'Java'),
	(4, 'Chushki'),
	(5, 'NewTag'),
	(6, ''),
	(7, 'Dryjki');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `deleted_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица php_web_test.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `deleted_on`) VALUES
	(1, 'pesho', '$argon2i$v=19$m=1024,t=2,p=2$NG9SZjNZZkpGTVVYN3AwNQ$DcdgRavrrxpZ1gVipHZreRIvyVff1ZD/T2U4rxFty8I', NULL),
	(2, 'gosho', '$argon2i$v=19$m=1024,t=2,p=2$cVV4OXhJeldCMkloOWFCRQ$h2KYTcu4bwOx2jsY6an/kPCU8M+DBMqbJrGFu+tafFY', NULL),
	(3, ' nov_user', '$argon2i$v=19$m=1024,t=2,p=2$VEU3WE9SWi9BL3dTcmpZZA$fPAU9Kk2geg1DRzwIiCWWNyH5b6lMDBEU/BKLHxdRv0', NULL),
	(4, 'nov_user_1', '$argon2i$v=19$m=1024,t=2,p=2$czBjWU90MnBiRlN1dy5Bbg$P7tUT4VmHWAQl1R9tD6pG/xCjTZ5cQfqG1w00iZ7IhU', NULL),
	(5, 'newUser', '$argon2i$v=19$m=1024,t=2,p=2$OWRrYzVXeldibWhDYVd4Qg$0jSqUpyQ9RUNDXlzpAug/7BJocYp4f2fhYbEfU8xONs', NULL),
	(6, 'asdsfdsg', '$argon2i$v=19$m=1024,t=2,p=2$VGZRZHFLY1gvVWkuUEltdQ$UAkYAgOMvNEVgfRw2n0o/s9WFP9zDKIj7sm/7h/2RNo', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.users_roles
CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  KEY `FK_users_roles_role_id__roles_id` (`role_id`),
  KEY `FK_users_roles_user_id__users_id` (`user_id`),
  CONSTRAINT `FK_users_roles_role_id__roles_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `FK_users_roles_user_id__users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Дъмп данни за таблица php_web_test.users_roles: ~7 rows (approximately)
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(1, 2),
	(5, 1),
	(6, 1);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;

-- Дъмп структура за таблица php_web_test.user_likes
CREATE TABLE IF NOT EXISTS `user_likes` (
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`question_id`),
  KEY `user_likes_questions_id_fk` (`question_id`),
  CONSTRAINT `user_likes_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `user_likes_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Дъмп данни за таблица php_web_test.user_likes: ~7 rows (approximately)
/*!40000 ALTER TABLE `user_likes` DISABLE KEYS */;
INSERT INTO `user_likes` (`user_id`, `question_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 5),
	(2, 1),
	(2, 2),
	(6, 1);
/*!40000 ALTER TABLE `user_likes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
