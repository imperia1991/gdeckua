-- ALTER TABLE places ADD category_id INT DEFAULT NULL ;

-- ALTER TABLE categories ADD parent_id INT NULL ,
-- ADD INDEX (parent_id);
-- ALTER TABLE categories ADD FOREIGN KEY (parent_id) REFERENCES categories (id) ON DELETE SET NULL ON UPDATE SET NULL;

-- CREATE TABLE places_categories (
-- 	id INT NOT NULL AUTO_INCREMENT,
-- 	place_id INT NOT NULL,
-- 	category_id INT NOT NULL,
-- 	PRIMARY KEY (id),
-- 	CONSTRAINT places_categories_places_fk FOREIGN KEY (place_id) REFERENCES places (id) ON UPDATE CASCADE ON DELETE CASCADE,
-- 	CONSTRAINT places_categories_categories_fk FOREIGN KEY (category_id) REFERENCES categories (id) ON UPDATE CASCADE ON DELETE CASCADE
-- )
-- COLLATE='utf8_general_ci'
-- ENGINE=InnoDB;
-- 
-- ALTER TABLE places DROP COLUMN category_id;

-- CREATE TABLE comments (
-- 	id INT(11) NOT NULL AUTO_INCREMENT,
-- 	name VARCHAR(255) NOT NULL,
-- 	message TEXT NOT NULL,
-- 	created_at DATETIME NOT NULL,
-- 	place_id INT(11) NOT NULL,
-- 	PRIMARY KEY (id),
-- 	CONSTRAINT comments_places_place_id FOREIGN KEY (place_id) REFERENCES places (id) ON UPDATE CASCADE ON DELETE CASCADE
-- )
-- COLLATE='utf8_general_ci'
-- ENGINE=InnoDB;
-- 
-- ALTER TABLE places ADD COLUMN alias VARCHAR(255) NULL AFTER address_uk;
-- 
-- CREATE TABLE category_news (
-- 	id INT(11) NOT NULL AUTO_INCREMENT,
-- 	title_ru VARCHAR(255) NOT NULL,
-- 	title_uk VARCHAR(255) NOT NULL,
-- 	aliases VARCHAR(255) NOT NULL,
-- 	parent_id INT(11) NULL DEFAULT NULL,
-- 	PRIMARY KEY (id),
-- 	INDEX FK_category_news (parent_id),
-- 	CONSTRAINT FK_category_news FOREIGN KEY (parent_id) REFERENCES category_news (id) ON UPDATE SET NULL ON DELETE SET NULL
-- )
-- COLLATE='utf8_general_ci'
-- ENGINE=InnoDB;
-- 
-- CREATE TABLE news (
-- 	id INT(11) NOT NULL AUTO_INCREMENT,
-- 	category_news_id INT(11) NULL DEFAULT NULL,
-- 	title VARCHAR(255) NOT NULL,
-- 	text TEXT NOT NULL,
-- 	created_at DATETIME NOT NULL,
-- 	is_deleted TINYINT(4) NOT NULL,
-- 	PRIMARY KEY (id),
-- 	INDEX FK_news_category_news (category_news_id),
-- 	CONSTRAINT FK_news_category_news FOREIGN KEY (category_news_id) REFERENCES category_news (id) ON UPDATE SET NULL ON DELETE SET NULL
-- )
-- ENGINE=InnoDB;

-- CREATE TABLE settings (
-- 	id INT(11) NOT NULL AUTO_INCREMENT,
-- 	about TEXT NOT NULL,
-- 	contacts TEXT NOT NULL,
-- 	lat DOUBLE NULL DEFAULT NULL,
-- 	lng DOUBLE NULL DEFAULT NULL,
-- 	PRIMARY KEY (id)
-- )
-- ENGINE=InnoDB;gdeckuagdeckua

-- CREATE TABLE IF NOT EXISTS comments_news (
--   id int(11) NOT NULL AUTO_INCREMENT,
--   name varchar(255) NOT NULL,
--   message text NOT NULL,
--   created_at datetime NOT NULL,
--   news_id int(11) NOT NULL,
--   PRIMARY KEY (id),
--   KEY FK_news_comment_news (news_id)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--
-- CREATE TABLE IF NOT EXISTS photo_blog (
--   id int(11) NOT NULL AUTO_INCREMENT,
--   author varchar(255) NOT NULL,
--   caption varchar(255) NOT NULL,
--   created_at datetime NOT NULL,
--   is_deleted tinyint(1) NOT NULL DEFAULT '0',
--   type tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - ���� ������, 2 - ���� �����������',
--   PRIMARY KEY (id)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--
-- CREATE TABLE IF NOT EXISTS photo_blog_photos (
--   id int(11) NOT NULL AUTO_INCREMENT,
--   caption varchar(255) DEFAULT NULL,
--   photo_blog_id int(11) NOT NULL,
--   created_at datetime NOT NULL,
--   is_deleted tinyint(1) NOT NULL DEFAULT '0',
--   PRIMARY KEY (id),
--   KEY FK_photo_blog_photos (photo_blog_id)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--
-- ALTER TABLE comments_news
--   ADD CONSTRAINT FK_news_comment_news FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- ALTER TABLE photo_blog_photos
--   ADD CONSTRAINT FK_photo_blog_photos FOREIGN KEY (photo_blog_id) REFERENCES photo_blog (id) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- ALTER TABLE news
-- 	ADD COLUMN photo VARCHAR(255) NULL COLLATE 'utf8_general_ci' AFTER is_deleted;
--
-- ALTER TABLE news
-- 	ADD COLUMN short_text VARCHAR(80) NULL COLLATE 'utf8_general_ci' AFTER text;
--
-- CREATE TABLE contacts (
-- 	id INT(11) NOT NULL AUTO_INCREMENT,
-- 	place_id INT(11) NULL DEFAULT NULL,
-- 	phone_city VARCHAR(20) NULL DEFAULT NULL,
-- 	phone_mobile1 VARCHAR(20) NULL DEFAULT NULL,
-- 	phone_mobile2 VARCHAR(20) NULL DEFAULT NULL,
-- 	phax VARCHAR(20) NULL DEFAULT NULL,
-- 	email VARCHAR(50) NULL DEFAULT NULL,
-- 	skype VARCHAR(50) NULL DEFAULT NULL,
-- 	operation_time VARCHAR(255) NULL DEFAULT NULL,
-- 	PRIMARY KEY (id),
-- 	INDEX FK1_place_contacts (place_id),
-- 	CONSTRAINT FK1_place_contacts FOREIGN KEY (place_id) REFERENCES places (id) ON UPDATE CASCADE ON DELETE CASCADE
-- )
-- ENGINE=InnoDB;

ALTER TABLE news
	ADD COLUMN alias VARCHAR(255) NOT NULL AFTER photo;

LTER TABLE news
	ADD COLUMN is_opinion TINYINT(1) NULL DEFAULT '0' AFTER alias;
	
ALTER TABLE places
	ADD COLUMN how_to_get_ru TEXT(1024) NULL COMMENT 'Как добраться' AFTER alias;

ALTER TABLE places
	ADD COLUMN how_to_get_uk TEXT(1024) NULL COMMENT 'Как добраться' AFTER alias;
