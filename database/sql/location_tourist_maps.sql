CREATE TABLE IF NOT EXISTS `location_tourist_maps` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_type` VARCHAR(50) NOT NULL,
  `location_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) DEFAULT NULL,
  `content` LONGTEXT,
  `data` JSON DEFAULT NULL,
  `meta_title` VARCHAR(255) DEFAULT NULL,
  `meta_description` TEXT DEFAULT NULL,
  `published_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  UNIQUE KEY `unique_location_tourist_maps_loc` (`location_type`,`location_id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
