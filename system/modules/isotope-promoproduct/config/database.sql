-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

-- 
-- Table `tl_member`
-- 

CREATE TABLE `tl_member` (
  `salutation` varchar(32) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- 
-- Table `tl_page`
-- 

CREATE TABLE `tl_page` (
  `iso_promo_product` blob NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `iso_promo_image` text NULL,
  `iso_promo_headline` varchar(255) NOT NULL default ''
  `iso_promo_caption` varchar(255) NOT NULL default ''
  `iso_promo_link` int(10) unsigned NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
