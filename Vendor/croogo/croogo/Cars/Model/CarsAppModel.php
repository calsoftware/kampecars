<?php

App::uses('AppModel', 'Model');

/**
 * Cars App Model
 */
class CarsAppModel extends AppModel {
//ALTER TABLE `crb5_car_models`  ADD `status` INT(1) NOT NULL DEFAULT '0'
//ALTER TABLE `crb5_car_makes`  ADD `status` INT(1) NOT NULL DEFAULT '0'
//ALTER TABLE `crb5_cars`  ADD `status` INT(1) NOT NULL DEFAULT '0'

/*
 * 
 
--
-- Table structure for table `crb5_cars`
--

CREATE TABLE IF NOT EXISTS `crb5_cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `crb5_car_extras`
--

CREATE TABLE IF NOT EXISTS `crb5_car_extras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `crb5_car_features`
--

CREATE TABLE IF NOT EXISTS `crb5_car_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `feature_type_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `crb5_car_feature_types`
--

CREATE TABLE IF NOT EXISTS `crb5_car_feature_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `crb5_car_makes`
--

CREATE TABLE IF NOT EXISTS `crb5_car_makes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `crb5_car_models`
--

CREATE TABLE IF NOT EXISTS `crb5_car_models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(256) NOT NULL,
  `make_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;
*/

}
