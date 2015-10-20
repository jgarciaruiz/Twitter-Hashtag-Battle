DROP TABLE IF EXISTS `tw_db`;

CREATE TABLE `tw_db` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tw_id_str` bigint(20) DEFAULT NULL,
  `tw_name` varchar(56) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tw_screen_name` varchar(56) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tw_text` varchar(256) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tw_query` varchar(256) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
