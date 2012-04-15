/*
* Use this file to load in some default data.
*
* mysql -u root -p protalk < /path/to/protalk/doc/db/seed_data.sql
*
*/


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

INSERT INTO `Speaker` (`name`, photo, biography ) VALUES ('Cookie_Monster','cookie.png','Likes to eat biscuits. Chocolate chip cookies are his favourite');
INSERT INTO `Speaker` (`name`, photo, biography ) VALUES ('Ernie','ernie.png','Best friends with Bert.  They do everything together.');
INSERT INTO `Speaker` (`name`, photo, biography ) VALUES ('Fozzie','fozzie.png','Really friendly muppet.  Kids love him and he is so nice.');
INSERT INTO `Speaker` (`name`, photo, biography ) VALUES ('Gonzo','gonzo.png','Mischevious but loveable.  Is moody at times but generally good natured, if a little naughty.');


/* Delete all Category records then re-load sample data */

TRUNCATE TABLE `Category`;

INSERT INTO `Category` (`name`) VALUES ('Tootie Frootie'),('Candi Bonbons'),('Toffee Apple'),('Rhubarb & Custard'),('Hard Boiled Sweets'),('Chewy Chews'),('Jam Donut');