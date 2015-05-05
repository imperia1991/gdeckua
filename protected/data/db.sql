ALTER TABLE `users` ADD `full_name` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL AFTER `password` ,
ADD `phone_add` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL AFTER `mobile` ,
ADD `site` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL AFTER `phone_add` ;
ALTER TABLE `users` ADD `photo` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL AFTER `site` ;


CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `text` mediumtext NOT NULL,
  `short_text` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-активный, 2-неактивный,3-удален',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `alias` (`alias`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category_blog` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8


