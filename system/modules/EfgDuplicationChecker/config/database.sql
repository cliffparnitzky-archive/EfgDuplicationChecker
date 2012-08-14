-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

--
-- Table `tl_form`
--
CREATE TABLE `tl_form` (
  `duplicationCheckingActive` char(1) NOT NULL default '',
  `duplicationCheckingFields` blob NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
