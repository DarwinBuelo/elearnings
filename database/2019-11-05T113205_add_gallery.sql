/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Darwin.Buelo
 * Created: 5 Nov 2019
 */

CREATE TABLE `elearning`.`gallery` ( `image_id` INT NOT NULL AUTO_INCREMENT ,  `filename` VARCHAR(255) NOT NULL ,  `description` VARCHAR(255) NOT NULL ,  `remove` INT NOT NULL ,    PRIMARY KEY  (`image_id`)) ENGINE = InnoDB;