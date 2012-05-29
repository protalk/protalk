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
INSERT INTO `Speaker` (`name`, biography ) VALUES ('Cal Evans','PHP community legend.');
INSERT INTO `Speaker` (`name`, biography ) VALUES ('Derick Rethans','Creator of Xdebug and general PHP genius.');
INSERT INTO `Speaker` (`name`, biography ) VALUES ('Chris Hartjes','The Grumpy Programmer');
INSERT INTO `Speaker` (`name`, biography ) VALUES ('Ed Finkler','DevHell podcaster');

/* Delete all Media-speaker records then re-load sample data */

TRUNCATE TABLE `Media_speaker`;

INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('1', '6');
INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('3', '7');
INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('2', '5');
INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('3', '8');
INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('4', '9');
INSERT INTO `Media_speaker` (media_id, speaker_id ) VALUES ('4', '10');

/* Delete all Category records then re-load sample data */

TRUNCATE TABLE `Category`;

INSERT INTO `Category` (`name`) VALUES ('Tootie Frootie'),('Candi Bonbons'),('Toffee Apple'),('Rhubarb & Custard'),('Hard Boiled Sweets'),('Chewy Chews'),('Jam Donut');

/* Delete all Media records then re-load sample data */

TRUNCATE TABLE `Media`;

INSERT INTO `Media` (mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug ) VALUES (1, null,'A talk about peripheral tools that aid web development', '1hr 20mins', '5', '450', '<iframe src="http://player.vimeo.com/video/30012690" width="500" height="409" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>','<div style="width:425px" id="__ss_9285199"><iframe src="http://www.slideshare.net/slideshow/embed_code/9285199" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe></div>',null,'en', 'Tool Up Your Lamp Stack', 'tool-up-your-lamp-stack');

INSERT INTO `Media` (mediatype_id, `date`,`length`, rating, visits, content, joindin, `language`, title, slug ) VALUES (1, null, '40mins', '4', '32', '<iframe class="player" frameborder="0" scrolling="no" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/web//player-html5-568.html" width="400" height="300"><noframes><img alt="&lt;h2&gt;3 Mars Session 05 Symfony&lt;/h2&gt;" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-193143/photo_1.jpg" /><h2>3 Mars Session 05 Symfony</h2></noframes></iframe>','2597','en', 'phpBB4: Building end-user applications with Symfony2', 'phpbb4-building-end-user-applications-with-symfony2' );

INSERT INTO `Media` (mediatype_id,`date`, description, `length`, rating, visits, content, `language`, title, slug ) VALUES (2,'2012-05-15','A Voices of the ElePHPant Interview with Derick Rethans by Cal Evans, sponsored by EngineYard.', '11mins', '3.5', '6', 'http://voices.of.the.elephpant.s3.amazonaws.com/vote_052.mp3','en', 'Interview with Derick Rethans', 'interview-with-derick-rethans');

INSERT INTO `Media` (mediatype_id,`date`, description, `length`, rating, visits, content, `language`, title, slug ) VALUES (2,'2012-04-26','Episode 11 of the DevHell postcase series. "This time out we are blessed by the presence of Joël Perras, PHP developer extraordinaire and Fictive Kin brosef of Ed. We explore Joël’s rags-to-riches story: a young academic schlepping coffee and 44oz soft drinks at a gas station, where he’s discovered by a grizzled dev team manager in need of Java skills. From there it’s been a whirlwind of web sites, programming languages, and more ops than you can shake a stick at."', '1hr 31mins', '3.5', '6', 'http://devhell.s3.amazonaws.com/ep11-64mono.mp3','en', 'From Gas Station Attendant to Java Developer', 'from-gas-station-attendant-to-java-developer');

/* Delete all Media_category records then re-load sample data */

TRUNCATE TABLE `Media_category`;

INSERT INTO Media_category (media_id, category_id) VALUES (1, 1);

/* Delete all Media_tag records then re-load sample data */

TRUNCATE TABLE `Media_tag`;

INSERT INTO Media_tag (media_id, tag_id) VALUES (1, 2);

/* Delete all Mediatype records then re-load sample data */

TRUNCATE TABLE `Mediatype`;

INSERT INTO `Mediatype` (`name`, `type`) VALUES ('video', 'video');
INSERT INTO `Mediatype` (`name`, `type`) VALUES ('podcast', 'podcast');

/* Delete all Comment records then re-load sample data */

TRUNCATE TABLE `Comment`;

INSERT INTO `Comment` (media_id, author, email, website, content, datetime ) VALUES ('1', 'Kim Rowan', 'kim.rowan@cancer.org.uk', 'http://protalk.me', 'Awesome site! Great talk too', '2012-05-19 09:01:36' );
INSERT INTO `Comment` (media_id, author, email, website, content, datetime) VALUES ('1', 'Michelle Sanver', 'michelle@sanver.com', 'http://www.jippey.com', 'I learned a lot from this amazing talk.  Great topic.', '2012-06-02 13:25:52' );


/* Reenable foreign key constrain checks in MySQL */

SET foreign_key_checks = 1;
