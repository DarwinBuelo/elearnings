ALTER TABLE `exams` ADD `title` TEXT NOT NULL AFTER `date_created`;
ALTER TABLE `exams` ADD `attempts` INT NOT NULL AFTER `items`;
ALTER TABLE `exams` ADD `passing_score` INT NOT NULL AFTER `attempts`;
ALTER TABLE `exams` ADD `exam_date` DATETIME NOT NULL AFTER `passing_score`;
ALTER TABLE `exams` ADD `exam_due` DATETIME NOT NULL AFTER `exam_date`;
ALTER TABLE `exams` CHANGE `date_created` `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;