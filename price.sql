SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `goods_promo`
--

CREATE TABLE IF NOT EXISTS `tovari` (
  `id` int(11) NOT NULL auto_increment,
  `nam` varchar(255) NOT NULL,
  `price_old` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `pic_link` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

