-- create additional databases
CREATE DATABASE IF NOT EXISTS `testing` CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci';

-- create additional users and grant rights
CREATE USER `testing`@`%` IDENTIFIED WITH mysql_native_password BY 'testing';
GRANT Alter, Alter Routine, Create, Create Routine, Create Temporary Tables, Create View, Delete, Drop, Event, Execute, Index, Insert, Lock Tables, References, Select, Show View, Trigger, Update ON `testing`.* TO `testing`@`%`;
