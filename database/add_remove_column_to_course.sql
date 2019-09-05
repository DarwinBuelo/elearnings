/*
* Add the remove column to the table course table
*/
ALTER TABLE `courses` ADD `remove` INT NOT NULL DEFAULT '0' AFTER `creator`;