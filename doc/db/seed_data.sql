/*
* Use this file to load in some default data.
*
* mysql -u root -p protalk < /path/to/protalk/doc/db/seed_data.sql
*
*/

/* Enable deletion of rows with foreign key constraints by disabled checks */

SET foreign_key_checks = 0;


/* Delete all Page records then re-load sample data */

TRUNCATE TABLE `Page`;

INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('contact','Contact Us','Contact','Some dummy text for contact page');
INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('contribute','How to Contribute','Contribute','Some dummy text for contribute page');
INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('about','About Us','About','Some dummy text for about page');


/* Delete all Tag records then re-load sample data */

TRUNCATE TABLE `Tag`;

INSERT INTO `Tag` (name) VALUES ('PHP'),('Quality Assurance'),('MySQL'),('php|tek'),('Arrays'),('PHPUnit'),('Refactoring'),('Tools'), ('Build Process'),('Deployment'), ('Integration'), ('DPC2012'),('PHPDocumentor'), ('Security'),('Design Patterns'),('PHPNW2011');


/* Delete all Speaker records then re-load sample data */

TRUNCATE TABLE `Speaker`;

INSERT INTO `Speaker` (`name`, photo, biography ) VALUES ('Cookie Monster','cookie.png','Likes to eat biscuits. Chocolate chip cookies are his favourite');
INSERT INTO `Speaker` (`name`, photo, biography ) VALUES ('Ernie','ernie.png','Best friends with Bert.  They do everything together.');
INSERT INTO `Speaker` (`name`, photo, biography ) VALUES ('Fozzie','fozzie.png','Really friendly muppet.  Kids love him and he is so nice.');
INSERT INTO `Speaker` (`name`, photo, biography ) VALUES ('Gonzo','gonzo.png','Mischevious but loveable.  Is moody at times but generally good natured, if a little naughty.');


/* Delete all Category records then re-load sample data */

TRUNCATE TABLE `Category`;

INSERT INTO `Category` (`name`) VALUES ('Tootie Frootie'),('Candi Bonbons'),('Toffee Apple'),('Rhubarb & Custard'),('Hard Boiled Sweets'),('Chewy Chews'),('Jam Donut');

/* Delete all Media records then re-load sample data */

TRUNCATE TABLE `Media`;

INSERT INTO `Media` (speaker_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title ) VALUES ('1', '2011-04-19','A fascinating talk about how ProTalk was created to help people learn PHP and programming in general', '2hrs 42mins', '5', '450', 'Content Goes Here','Slides goes here','joindin goes here','en', 'ProTalking All Over The World');

INSERT INTO `Media` (speaker_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title ) VALUES ('2', '2012-03-14','How to get started with Symfony2', '1hr 30mins', '4', '32', 'Content Goes Here','Slides goes here','joindin goes here','en', 'Getting Started With Symfony2');

INSERT INTO `Media` (speaker_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title ) VALUES ('3', '2012-01-11','Testing whether the very long talk title fits in the main Latest Talks lists', '65mins', '3.5', '6', 'Content Goes Here','Slides goes here','joindin goes here','en', 'Another Great PHP Talk With A Very Long Title That We Need To Make Fit');


/* Reenable foreign key constrain checks in MySQL */

SET foreign_key_checks = 1;
