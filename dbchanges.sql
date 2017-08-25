CREATE TABLE `clipboard`.`xc_course` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `team_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_course_team_idx` (`team_id` ASC),
  CONSTRAINT `fk_course_team`
    FOREIGN KEY (`team_id`)
    REFERENCES `clipboard`.`team` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

ALTER TABLE `clipboard`.`schedule_event` 
ADD COLUMN `xc_course_id` INT UNSIGNED NULL AFTER `season_id`,
ADD INDEX `fk_sched_course_idx` (`xc_course_id` ASC);
ALTER TABLE `clipboard`.`schedule_event` 
ADD CONSTRAINT `fk_sched_course`
  FOREIGN KEY (`xc_course_id`)
  REFERENCES `clipboard`.`xc_course` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `clipboard`.`xc_course` 
ADD COLUMN `created_at` TIMESTAMP NULL DEFAULT NULL AFTER `team_id`,
ADD COLUMN `updated_at` TIMESTAMP NULL DEFAULT NULL AFTER `created_at`;

ALTER TABLE `clipboard`.`event` 
CHANGE COLUMN `open` `open` INT(11) NOT NULL DEFAULT 1 ;

insert into event (name, type, open) values ('5K', 4, 0);
insert into event (name, type, open) values ('4K', 4, 0);
insert into event (name, type, open) values ('Freshman Course', 4, 0);
insert into event (name, type, open) values ('5K - JV', 4, 0);