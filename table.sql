--
-- Table structure for table `review`
--

CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `email` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `text` text collate utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;