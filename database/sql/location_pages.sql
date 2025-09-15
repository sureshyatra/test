CREATE TABLE IF NOT EXISTS `location_pages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_type` VARCHAR(50) NOT NULL,
  `location_id` INT UNSIGNED NOT NULL,
  `page_key` ENUM('overview') NOT NULL DEFAULT 'overview',
  `title` VARCHAR(255) DEFAULT NULL,
  `content` LONGTEXT,
  `meta_title` VARCHAR(255) DEFAULT NULL,
  `meta_description` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  UNIQUE KEY `unique_location_page` (`location_type`,`location_id`,`page_key`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
