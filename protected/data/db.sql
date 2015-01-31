ALTER TABLE `posters` ADD `place_id` INT NULL
AFTER `category_poster_id`,
ADD INDEX (`place_id`);
ALTER TABLE `posters` ADD CONSTRAINT `FK1_places` FOREIGN KEY (`place_id`) REFERENCES `gdeckua`.`places` (
  `id`
)
  ON DELETE SET NULL
  ON UPDATE SET NULL;


CREATE TABLE comments_photo_city (
  id            INT(11)      NOT NULL AUTO_INCREMENT,
  name          VARCHAR(255) NOT NULL,
  message       TEXT         NOT NULL,
  created_at    DATETIME     NOT NULL,
  photo_city_id BIGINT(20)   NOT NULL,
  PRIMARY KEY (id),
  INDEX FK1_photo_city_comments (photo_city_id),
  CONSTRAINT FK1_photo_city_comments FOREIGN KEY (photo_city_id) REFERENCES photo_city (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)
  COLLATE ='utf8_general_ci'
  ENGINE =InnoDB;
