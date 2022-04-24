--CREATING InnoDB
    CREATE DATABASE IF NOT EXISTS innodb

--CREATING TABLE TV SERIES
    CREATE TABLE `tv_series` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(50) NOT NULL , `channel` INT NOT NULL , `gender` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`));

--*CREATING TABLE TV SERIES INTERVALS

    CREATE TABLE `tv_series_intervals` ( `id_tv_series` INT NOT NULL , `week_day` INT NOT NULL , `show_time` TIMESTAMP NOT NULL);
    ALTER TABLE `tv_series_intervals` ADD CONSTRAINT `fk_tv_series_id` FOREIGN KEY (`id_tv_series`) REFERENCES `tv_series`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--INSERTING INFORMATION
    INSERT INTO `tv_series` (`id`, `title`, `channel`, `gender`) VALUES (NULL, 'title 1', '1', 'gender 1')
    INSERT INTO `tv_series` (`id`, `title`, `channel`, `gender`) VALUES (NULL, 'title 2', '2', 'gender 2')
    INSERT INTO `tv_series` (`id`, `title`, `channel`, `gender`) VALUES (NULL, 'title 3', '3', 'gender 3')
    INSERT INTO `tv_series` (`id`, `title`, `channel`, `gender`) VALUES (NULL, 'title 4', '4', 'gender 1')

    INSERT INTO `tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES ('1', '1', '2022-04-25 13:18:30');
    INSERT INTO `tv_series_intervals` (`id_tv_series`, `week_day`, `show_time`) VALUES ('3', '5', '2022-04-24 18:11:31');