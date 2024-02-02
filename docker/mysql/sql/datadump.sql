DROP DATABASE IF EXISTS `exadsdatabase`;
CREATE DATABASE IF NOT EXISTS `exadsdatabase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `exadsdatabase`;

CREATE TABLE IF NOT EXISTS `tv_series` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `channel` varchar(100) NOT NULL,
    `gender` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tv_series_intervals` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tv_series_id` bigint unsigned NOT NULL,
    `week_day` tinyint unsigned NOT NULL,
    `show_time` time NOT NULL,
    CONSTRAINT `tv_series_intervals_tv_series_id_foreign` FOREIGN KEY (`tv_series_id`) REFERENCES `tv_series` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

USE `exadsdatabase`;

INSERT INTO tv_series (title, channel, gender)
VALUES   ('The Last of Us', 'HBO Max', 'drama'),
        ('Yu Yu Hakusho', 'Netflix', 'action'),
        ('One Piece', 'Netflix', 'adventure'),
        ('Percy Jackson and the Olympians', 'Disney Plus', 'adventure'),
        ('Blue Eye Samurai', 'Netflix', 'animation');

INSERT INTO tv_series_intervals (tv_series_id, week_day, show_time)
VALUES   (1, 2, '20:00:00'),
        (1, 4, '10:30:00'),
        (1, 1, '22:00:00'),
        (1, 6, '08:00:00'),
        (1, 5, '19:30:00'),
        (2, 4, '9:00:00'),
        (2, 0, '20:30:00'),
        (2, 5, '23:00:00'),
        (3, 3, '21:00:00'),
        (3, 6, '22:30:00'),
        (4, 1, '22:00:00'),
        (4, 3, '11:30:00'),
        (4, 5, '20:00:00'),
        (4, 4, '19:00:00'),
        (5, 1, '22:00:00'),
        (5, 0, '10:00:00'),
        (5, 6, '08:30:00'),
        (5, 3, '19:00:00'),
        (5, 2, '18:30:00');
