CREATE TABLE `student_exam` 
( 
    `student_exam_id` INT NOT NULL AUTO_INCREMENT ,  
    `student_id` VARCHAR(225) NOT NULL ,   
    `exam_id` INT NOT NULL ,  `score` INT NOT NULL ,  
    `attempts` INT NOT NULL ,  `remarks` INT NOT NULL ,   
    PRIMARY KEY  (`student_exam_id`)
) 
ENGINE = InnoDB;