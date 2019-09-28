CREATE TABLE `student_exam_answer`
(
    `student_exam_answer_id` INT NOT NULL AUTO_INCREMENT ,
    `student_exam_id` INT NOT NULL ,
    `exams_questions_id` INT NOT NULL ,
    `item_number` INT NOT NULL ,
    `answer` TEXT NOT NULL ,
    `status` BOOLEAN NOT NULL ,
    PRIMARY KEY  (`student_exam_answer_id`)
) ENGINE = InnoDB;