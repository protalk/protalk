/*
* Use this file to load in some default data.
*
* mysql -u root -p protalk < /path/to/protalk/doc/db/seed_data.sql
*
*/


/* Delete all Page records then re-load sample data */

DELETE FROM `Page`;

INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('contact','Contact Details','ProTalk Contact Details','Some dummy text for contact page');
INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('contribute','How to Contribute','Contribute to ProTalk','Some dummy text for contribute page');
INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('about','About ProTalk','About ProTalk','Some dummy text for about page');


/* Delete all Tag records then re-load sample data */

DELETE FROM `Tag`;

INSERT INTO `Tag` (name) VALUES ('PHP'),('Quality Assurance'),('MySQL'),('Strings'),('Arrays'),('PHPUnit'),('Refactoring'),('Tools'), ('Build Process'),('Deployment'), ('Integration'), ('DocBlox'),('PHPDocumentor'), ('Security'),('Design Patterns');

