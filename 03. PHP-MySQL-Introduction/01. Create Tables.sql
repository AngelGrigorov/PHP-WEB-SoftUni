CREATE TABLE `minions` (
	`id` INT(11) NOT NULL,
	`name` INT(11) NULL DEFAULT NULL,
	`age` INT(11) NULL DEFAULT NULL,
	`town_id` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;
CREATE TABLE `towns` (
	`id` INT(11) NOT NULL,
	`name` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;
