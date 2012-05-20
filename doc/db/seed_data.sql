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
INSERT INTO `Speaker` (`name`, biography ) VALUES ('Nils Adermann','I could not find a bio for him online. Presumably we are going to have to email speakers and ask them to provide us with something?  Even if we find something online we probably should not use it without asking first.  Photos are also probably going to be tricky(?)');
INSERT INTO `Speaker` (`name`, biography ) VALUES ('Lorna Mitchell','PHP specialist, writer, speaker, consultant and trainer.');

/* Delete all Media-speaker records then re-load sample data */

TRUNCATE TABLE `Media_speaker`;

INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('1', '6');
INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('3', '2');
INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('2', '5');
INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('3', '3');


/* Delete all Category records then re-load sample data */

TRUNCATE TABLE `Category`;

INSERT INTO `Category` (`name`) VALUES ('Tootie Frootie'),('Candi Bonbons'),('Toffee Apple'),('Rhubarb & Custard'),('Hard Boiled Sweets'),('Chewy Chews'),('Jam Donut');

/* Delete all Media records then re-load sample data */

TRUNCATE TABLE `Media`;

INSERT INTO `Media` (`date`, description, `length`, rating, visits, content, slides, joindin, `language`, title ) VALUES (null,'A talk about peripheral tools that aid web development', '1hr 20mins', '5', '450', '<iframe src="http://player.vimeo.com/video/30012690" width="500" height="409" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>','<div style="width:425px" id="__ss_9285199"><iframe src="http://www.slideshare.net/slideshow/embed_code/9285199" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe></div>',null,'en', 'Tool Up Your Lamp Stack');

INSERT INTO `Media` (`date`,`length`, rating, visits, content, joindin, `language`, title ) VALUES (null, '40mins', '4', '32', '<iframe class="player" frameborder="0" scrolling="no" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/web//player-html5-568.html" width="400" height="300"><noframes><img alt="&lt;h2&gt;3 Mars Session 05 Symfony&lt;/h2&gt;" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-193143/photo_1.jpg" /><h2>3 Mars Session 05 Symfony</h2></noframes></iframe>','2597','en', 'phpBB4: Building end-user applications with Symfony2' );

INSERT INTO `Media` (`date`, description, `length`, rating, visits, content, slides, joindin, `language`, title ) VALUES ('2012-01-11','Testing whether the very long talk title fits in the main Latest Talks lists', '65mins', '3.5', '6', 'Content Goes Here','Slides goes here','joindin goes here','en', 'Another Great PHP Talk With A Very Long Title That We Need To Make Fit');


/* Reenable foreign key constrain checks in MySQL */

SET foreign_key_checks = 1;
