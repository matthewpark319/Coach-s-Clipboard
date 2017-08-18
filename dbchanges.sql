ALTER TABLE `clipboard`.`users` 
CHANGE COLUMN `email` `username` VARCHAR(255) NOT NULL ;

CREATE TABLE `season` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `clipboard`.`schedule_event` 
ADD COLUMN `season_id` INT UNSIGNED NULL AFTER `team_id`,
ADD INDEX `fk_sched_season_idx` (`season_id` ASC);
ALTER TABLE `clipboard`.`schedule_event` 
ADD CONSTRAINT `fk_sched_season`
  FOREIGN KEY (`season_id`)
  REFERENCES `clipboard`.`season` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

insert into season (year, name) values ('2017', 'Outdoor Track');

update schedule_event set season_id = 1;

ALTER TABLE `clipboard`.`athlete` 
ADD COLUMN `grad_year` YEAR NOT NULL AFTER `id`;

ALTER TABLE `clipboard`.`athlete` 
DROP FOREIGN KEY `fk_athlete_team`;
ALTER TABLE `clipboard`.`athlete` 
CHANGE COLUMN `team` `team_id` INT(10) UNSIGNED NOT NULL ;
ALTER TABLE `clipboard`.`athlete` 
ADD CONSTRAINT `fk_athlete_team`
  FOREIGN KEY (`team_id`)
  REFERENCES `clipboard`.`team` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

update athlete set grad_year = 2018;
update athlete set grad_year = 2017 where user_id in (47, 49);
update athlete set grad_year = 2019 where user_id in (46, 50, 51);

ALTER TABLE `clipboard`.`season` 
ADD COLUMN `team_id` INT UNSIGNED NULL AFTER `name`,
ADD INDEX `fk_season_team_idx` (`team_id` ASC);
ALTER TABLE `clipboard`.`season` 
ADD CONSTRAINT `fk_season_team`
  FOREIGN KEY (`team_id`)
  REFERENCES `clipboard`.`team` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
