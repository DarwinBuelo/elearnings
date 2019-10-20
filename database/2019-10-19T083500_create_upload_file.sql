CREATE TABLE `elearning`.`uploaded_file` 
    ( 
      `uploaded_file_id` INT NOT NULL AUTO_INCREMENT ,
      `name` VARCHAR(255) NOT NULL ,
      `type` VARCHAR(255) NOT NULL ,
      `date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY  (`uploaded_file_id`)
    )
     ENGINE = InnoDB;