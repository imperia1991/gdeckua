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

CREATE TABLE comments (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	message TEXT NOT NULL,
	created_at DATETIME NOT NULL,
	place_id INT(11) NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT comments_places_place_id FOREIGN KEY (place_id) REFERENCES places (id) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
