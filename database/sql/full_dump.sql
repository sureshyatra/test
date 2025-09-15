-- Full SQL dump: schema + seed data

CREATE TABLE IF NOT EXISTS `countries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `iso2` CHAR(2) DEFAULT NULL,
  `meta` JSON DEFAULT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `location_best_time_to_visit` (
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
  UNIQUE KEY `unique_location_best_time_to_visit_loc` (`location_type`,`location_id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `location_cities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED DEFAULT NULL,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `meta` JSON DEFAULT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  UNIQUE KEY `unique_location_city` (`country_id`,`state_id`,`slug`),
  PRIMARY KEY (`id`),
  CONSTRAINT `location_cities_country_fk` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `location_cities_state_fk` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `location_hotels` (
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
  UNIQUE KEY `unique_location_hotels_loc` (`location_type`,`location_id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `location_how_to_reach` (
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
  UNIQUE KEY `unique_location_how_to_reach_loc` (`location_type`,`location_id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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


CREATE TABLE IF NOT EXISTS `location_places_to_visit` (
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
  UNIQUE KEY `unique_location_places_to_visit_loc` (`location_type`,`location_id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `location_things_to_do` (
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
  UNIQUE KEY `unique_location_things_to_do_loc` (`location_type`,`location_id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `location_tour_guides` (
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
  UNIQUE KEY `unique_location_tour_guides_loc` (`location_type`,`location_id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `location_tour_packages` (
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
  UNIQUE KEY `unique_location_tour_packages_loc` (`location_type`,`location_id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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


CREATE TABLE IF NOT EXISTS `location_travel_agencies` (
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
  UNIQUE KEY `unique_location_travel_agencies_loc` (`location_type`,`location_id`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `states` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `meta` JSON DEFAULT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  UNIQUE KEY `unique_state` (`country_id`,`slug`),
  PRIMARY KEY (`id`),
  CONSTRAINT `states_country_fk` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- Sample data inserts
INSERT INTO `countries` (`id`,`name`,`slug`,`iso2`) VALUES
(1,'India','india','IN'),
(2,'United States','united-states','US');

INSERT INTO `states` (`id`,`country_id`,`name`,`slug`) VALUES
(1,1,'Rajasthan','rajasthan'),
(2,2,'California','california');

INSERT INTO `location_cities` (`id`,`country_id`,`state_id`,`name`,`slug`) VALUES
(1,1,1,'Jaipur','jaipur'),
(2,2,2,'Los Angeles','los-angeles');

INSERT INTO `location_pages` (`id`,`location_type`,`location_id`,`page_key`,`title`,`content`) VALUES
(1,'country',1,'overview','About India','Welcome to India overview...'),
(2,'state',1,'overview','About Rajasthan','Welcome to Rajasthan overview...'),
(3,'city',1,'overview','About Jaipur','Welcome to Jaipur overview...');

-- Subpage sample inserts (one row per subpage table for Jaipur)
INSERT INTO `location_tour_packages` (`id`,`location_type`,`location_id`,`title`,`content`,`published_at`) VALUES
(1,'city',1,'Jaipur Heritage Tour','<p>2 days heritage tour...</p>','2025-09-04 11:40:16');

INSERT INTO `location_best_time_to_visit` (`id`,`location_type`,`location_id`,`title`,`content`,`published_at`) VALUES
(1,'city',1,'Best Time for Jaipur','<p>October to March.</p>','2025-09-04 11:40:16');

INSERT INTO `location_how_to_reach` (`id`,`location_type`,`location_id`,`title`,`content`,`published_at`) VALUES
(1,'city',1,'How to Reach Jaipur','<p>By air, road, rail.</p>','2025-09-04 11:40:16');

INSERT INTO `location_places_to_visit` (`id`,`location_type`,`location_id`,`title`,`content`,`published_at`) VALUES
(1,'city',1,'Places in Jaipur','<p>Hawa Mahal, Amber Fort...</p>','2025-09-04 11:40:16');

INSERT INTO `location_travel_agencies` (`id`,`location_type`,`location_id`,`title`,`content`,`published_at`) VALUES
(1,'city',1,'Jaipur Travel Agencies','<p>Agency A, Agency B</p>','2025-09-04 11:40:16');

INSERT INTO `location_tour_guides` (`id`,`location_type`,`location_id`,`title`,`content`,`published_at`) VALUES
(1,'city',1,'Jaipur Tour Guides','<p>Guide X, Guide Y</p>','2025-09-04 11:40:16');

INSERT INTO `location_things_to_do` (`id`,`location_type`,`location_id`,`title`,`content`,`published_at`) VALUES
(1,'city',1,'Things to do in Jaipur','<p>Shopping, Food, Sightseeing</p>','2025-09-04 11:40:16');

INSERT INTO `location_tourist_maps` (`id`,`location_type`,`location_id`,`title`,`content`,`published_at`) VALUES
(1,'city',1,'Tourist Map - Jaipur','<p>Map content here</p>','2025-09-04 11:40:16');

INSERT INTO `location_hotels` (`id`,`location_type`,`location_id`,`title`,`content`,`published_at`) VALUES
(1,'city',1,'Hotels in Jaipur','<p>Hotel A, Hotel B</p>','2025-09-04 11:40:16');
