/*
* Use this file to load in some default data.
*
* Be sure to import the database using the UTF8 character set!
* $ mysql -u root -p --default_character_set utf8  protalk < /path/to/protalk/doc/db/seed_data.sql
*
*/

/* Enable deletion of rows with foreign key constraints by disabled checks */

SET foreign_key_checks = 0;


/* Delete all Page records then re-load sample data */

TRUNCATE TABLE `Page`;

INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('contact','Contact Us','Contact','We\'d really appreciate any feedback you have about the site. Bug reports are also very welcome. Go on, let us know what you think: </p><p>Email: <a href="mailto:info@protalk.me">info@protalk.me</a><br>Twitter: <a href="http://twitter.com/pro_talk">@pro_talk</a></p><p>You can also subscribe to our mailing list to keep in touch via our newsletter:<form action="http://protalk.us4.list-manage.com/subscribe/post?u=4192f6a464ac9b433d406efff&amp;id=e97aea0468" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
<input id="subscribeEmail" class="subscribe" name="EMAIL" type="email" placeholder="Enter your email address here"/>
<input id="subscribeButton" class="subscribe" type="image" src="http://protalk.me/images/subscribe_btn.png" />
</form>');
INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('contribute','How to Contribute','Contribute','Contributing to ProTalk couldn\'t be easier. All you need to do is find a video or audio recording about PHP that you enjoyed and think others could learn from, complete the form below and we\'ll take it from there.</p><p>Once we\'ve verified that we\'re allowed to embed the material, we\'ll publish it on the site and send you an email letting you know its available. Well….what are you waiting for?</p><p>If you want to help us develop ProTalk and make it even better, watch this space for details on how to do that. We have plans to open source the project real soon and look forward to building a thriving community around the site.');
INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('about','About Us','About','ProTalk is the brain child of Kim Rowan and Lineke Kerckhoffs-Willems. A spark of an idea on IRC in July 2011 transformed into the site you see before you and we really hope you like it.</p><p>ProTalk\'s mission is to provide a central point of access to online audio / video content with a PHP focus. We hope to expand and include other programming languages in the future, but for now we\'re focussing solely on PHP and surrounding tools and skills.</p><p>ProTalk aims to be a community resource and, as such, we will depend on you to <a href="http://protalk.me/contribute">contribute content</a>. Just send us links to recorded talks, postcasts, screencasts, etc., that are already online or hosted elsewhere and we\'ll do the rest.');


/* Delete all Tag records then re-load sample data */

TRUNCATE TABLE `Tag`;

INSERT INTO `Tag` (id, name) VALUES
    (1, 'PHP'),
    (2, 'Quality Assurance'),
    (3, 'MySQL'),
    (4, 'php|tek'),
    (5, 'Arrays'),
    (6, 'PHPUnit'),
    (7, 'Refactoring'),
    (8, 'Tools'),
    (9, 'Build Process'),
    (10, 'Deployment'),
    (11, 'Integration'),
    (12, 'dpc12'),
    (13, 'PHPDocumentor'),
    (14, 'Security'),
    (15, 'Design Patterns'),
    (16, 'phpnw11'),
    (17, 'dpc11'),
    (18, 'Webservices'),
    (19, 'Optimisation'),
    (20, 'CouchDB'),
    (21, 'Scalability'),
    (22, 'Zend Framework'),
    (23, 'Zend Framework 2'),
    (24, 'symfony_live11' ),
	(25, 'Dependency Injection'),
	(26, 'AOP'),
	(27, 'Apostrophe'),
	(28, 'CMS'),
	(29, 'Git')
    ;


/* Delete all Speaker records then re-load sample data */

TRUNCATE TABLE `Speaker`;

INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (5, 'Nils Adermann','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (6, 'Lorna Mitchell','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (7, 'Cal Evans','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (8, 'Derick Rethans','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (9, 'Chris Hartjes','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (10, 'Ed Finkler','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (11, 'Harrie Verveer','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (12, 'Aral Balkan','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (13, 'Rowan Merewood','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (14, 'Sebastian Bergmann','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (15, 'Tobias Schlitt','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (16, 'Kore Nordmann','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (17, 'Christopher Jones','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (18, 'Paul Matthews','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (19, 'Martin de Keijzer','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (20, 'Helgi Þormar Þorbjörnsson','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (21, 'Ian Barber','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (22, 'Enrico Zimuel','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (23, 'Scott MacVicar','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (24, 'Laura Beth Denker','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (25, 'Josh Holmes','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (26, 'Johannes Schmidt','');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (27, 'Tom Boutell', '');
INSERT INTO `Speaker` (`id`, `name`, biography )        VALUES (28, 'Scott Chacon', '');

/* Delete all Media-speaker records then re-load sample data */

TRUNCATE TABLE `media_speaker`;

INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES ('1', '6');
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES ('3', '7');
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES ('2', '5');
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES ('3', '8');
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES ('4', '9');
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES ('4', '10');

/* Delete all Category records then re-load sample data */

TRUNCATE TABLE `Category`;

INSERT INTO `Category` (`id`, `parent_id`, `name`, slug) VALUES
(8, NULL, 'PHP', 'php'),
(9, 8, 'Quality Assurance', 'quality-assurance'),
(10, NULL, 'Databases', 'databases'),
(11, 10, 'MySQL', 'mysql'),
(12, 9, 'Test Driven Development', 'test-driven-development'),
(13, 8, 'Object Orientation', 'object-orientation'),
(14, 13, 'Design Patterns', 'design-pattersn'),
(15, 10, 'CouchDB', 'couchdb'),
(16, 8, 'Frameworks', 'frameworks'),
(17, 16, 'Zend Framework', 'zend-framework'),
(18, 16, 'Symfony', 'symfony'),
(19, 16, 'Symfony2', 'symfony2'),
(20, 8, 'Webservices', 'webservices'),
(21, NULL, 'Version Control Systems', 'version-control-systems'),
(22, 21, 'Git', 'git'),
(23, 21, 'Subversion', 'subversion'),
(24, 20, 'Restful API', 'restful-api'),
(25, 9, 'Technical Debt', 'technical-debt'),
(26, NULL, 'User Experience', 'user-experience'),
(27, 9, 'Best Practices', 'best-practices'),
(28, NULL, 'Tools', 'tools'),
(29, 28, 'Solr', 'solr'),
(30, NULL, 'Soft skills', 'soft-skills'),
(31, 16, 'Zend Framework 2', 'zend-framework-2'),
(32, 30, 'Keynote / Inspirational', 'keynote-inspirational'),
(33, NULL, 'Open Source', 'open-source' )
;

/* Delete all Media records then re-load sample data */

TRUNCATE TABLE `Media`;

INSERT INTO `Media` (mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, thumbnail, hostName, hostUrl ) VALUES (1, null,'A talk about peripheral tools that aid web development', '1hr 20mins', '0', '0', '<iframe src="http://player.vimeo.com/video/30012690" width="500" height="409" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>','<div style="width:425px" id="__ss_9285199"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/lornajane/tool-up-your-lamp-stack" title="Tool Up Your LAMP Stack" target="_blank">Tool Up Your LAMP Stack</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/9285199" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/" target="_blank">presentations</a> from <a href="http://www.slideshare.net/lornajane" target="_blank">Lorna Mitchell</a> </div> </div>',null,'en', 'Tool Up Your Lamp Stack', 'tool-up-your-lamp-stack', '1', 'images/thumbnails/thumbnail_1.png', 'Vimeo', 'http://vimeo.com/30012690/');

INSERT INTO `Media` (mediatype_id, `date`,`length`, rating, visits, content, joindin, `language`, title, slug, isPublished, thumbnail, hostName, hostUrl) VALUES (1, NULL, '40:00', '0', '0', '<iframe class="player" frameborder="0" scrolling="no" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/web//player-html5-568.html" width="400" height="300"><noframes><img alt="&lt;h2&gt;3 Mars Session 05 Symfony&lt;/h2&gt;" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-193143/photo_1.jpg" /><h2>3 Mars Session 05 Symfony</h2></noframes></iframe>','2597','en', 'phpBB4: Building end-user applications with Symfony2', 'phpbb4-building-end-user-applications-with-symfony2', '1', 'http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-193143/photo_1.jpg', 'Symfony', 'http://symfony.com/video/Paris2011/568' );

INSERT INTO `Media` (mediatype_id,`date`, description, `length`, rating, visits, content, `language`, title, slug, isPublished, hostName, hostUrl ) VALUES (3,'2012-05-15','A Voices of the ElePHPant Interview with Derick Rethans by Cal Evans, sponsored by EngineYard.', '11mins', '0', '0', 'http://voices.of.the.elephpant.s3.amazonaws.com/vote_052.mp3','en', 'Interview with Derick Rethans', 'interview-with-derick-rethans', '1', 'Voices of the Elephpant', 'http://voicesoftheelephpant.com/2012/05/15/interview-with-derick-rethans-2/');

INSERT INTO `Media` (mediatype_id,`date`, description, `length`, rating, visits, content, `language`, title, slug, isPublished, hostName, hostUrl ) VALUES (3,'2012-04-26','Episode 11 of the DevHell postcase series. "This time out we are blessed by the presence of Joël Perras, PHP developer extraordinaire and Fictive Kin brosef of Ed. We explore Joël’s rags-to-riches story: a young academic schlepping coffee and 44oz soft drinks at a gas station, where he’s discovered by a grizzled dev team manager in need of Java skills. From there it’s been a whirlwind of web sites, programming languages, and more ops than you can shake a stick at."', '1hr 31mins', '0', '0', 'http://devhell.s3.amazonaws.com/ep11-64mono.mp3','en', 'From Gas Station Attendant to Java Developer', 'from-gas-station-attendant-to-java-developer', '1', 'DevHell', 'http://devhell.info/post/2012-04-26/from-gas-station-attendant-to-java-developer/');

/* Delete all media_category records then re-load sample data */

TRUNCATE TABLE `media_category`;

/* Delete all Media_tag records then re-load sample data */

TRUNCATE TABLE `media_tag`;

INSERT INTO media_tag (media_id, tag_id) VALUES (1, 2);

/* Delete all Mediatype records then re-load sample data */

TRUNCATE TABLE `Mediatype`;

INSERT INTO `Mediatype` (`id`, `name`, `type`) VALUES (1, 'video', 'video');
INSERT INTO `Mediatype` (`id`, `name`, `type`) VALUES (2, 'conference video', 'video');
INSERT INTO `Mediatype` (`id`, `name`, `type`) VALUES (3, 'podcast', 'podcast');
INSERT INTO `Mediatype` (`id`, `name`, `type`) VALUES (4, 'conference podcast', 'podcast');

/* Delete all Comment records then re-load sample data */

TRUNCATE TABLE `Comment`;

INSERT INTO `Comment` (media_id, author, email, website, content, datetime ) VALUES ('1', 'Kim Rowan', 'kim.rowan@cancer.org.uk', 'http://protalk.me', 'Awesome site! Great talk too', '2012-05-19 09:01:36' );
INSERT INTO `Comment` (media_id, author, email, website, content, datetime) VALUES ('1', 'Michelle Sanver', 'michelle@sanver.com', 'http://www.jippey.com', 'I learned a lot from this amazing talk.  Great topic.', '2012-06-02 13:25:52' );

/*
 *
 * DPC 2011 talks and associated data
 *
 */

/*
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (x, mediatype_id, null, 'Description',
    'time', '5', 0,
    'Source',
    'slides',
    joindinid, 'en', 'Title', 'URL', 1, 'name of the source', 'direct url to the page where to find this specific talk');

*/

/* Making the new everyday things  */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (5, 4, '2011-05-20', 'We are the makers of the new everyday things. We design and develop the virtual pens, telephones, newspapers, calendars, and door-handles that people interact with every single day. We are the virtual architects and the products that we design and develop have the power to determine whether people have a good day or a bad day.

In this session, Aral Balkan will outline the important role that user experience design plays in the making of virtual products and inspire you to see that it is your job – regardless of whether you make web sites, mobile apps, intranet systems, or ticket machines – to make this new world that we are crafting together not only usable and accessible but beautiful, fun, inspiring, pleasurable, delightful, and – dare I say – magical.',
    '56:42', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_013.mp3',
    '',
    3375, 'en', 'Making the new everyday things', 'making-the-new-everyday-things', 1, 'DPCRadio', 'http://techportal.inviqa.com/2012/04/27/dpc-radio-keynote-the-art-of-the-user-experience-making-beautiful-delightful-fun-things/');

INSERT INTO media_category (media_id, category_id) VALUES (5, 26), (5, 32);
INSERT INTO media_tag (media_id, tag_id) VALUES (5, 17);
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES (5, 12);

/* TDD and getting paid  */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (6, 4, '2011-05-20', 'Test-driven development is generally regarded as a good move: it should result in simple decoupled design, your tests tend to cover behaviour not methods, and far fewer bugs. However, just getting unit tests in on a real, commercial project is hard - switching to TDD is even harder. Often you can start a project with good intentions and coverage, then the deadline looms and the tests go out then the hacks come in. So, instead of beating ourselves up about not being perfect let\'s look at an interative approach to adopting TDD principles. We\'ll look at tactics for selling TDD to your client, boss and colleagues. This talk will also cover methods for making TDD easier for you by showing you what tools you can use to integrate it into your development environment. In the project itself, we\'ll examine how we can make small but permanent steps towards full TDD, without losing that progress when deadlines hit. We\'ll also cover a few methods for learning on your own time and how the whole process can actually be made quite enjoyable.',
    '51:50', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_017.mp3',
    '<div style="width:425px" id="__ss_7510674"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/rowan_m/tdd-and-getting-paid" title="TDD and Getting Paid" target="_blank">TDD and Getting Paid</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/7510674" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/" target="_blank">presentations</a> from <a href="http://www.slideshare.net/rowan_m" target="_blank">Rowan Merewood</a> </div> </div>',
    3218, 'en', 'TDD and getting paid', 'tdd-and-getting-paid', 1, 'DPCRadio', 'http://techportal.inviqa.com/2012/04/10/dpc-radio-tdd-and-getting-paid/');

INSERT INTO media_category (media_id, category_id) VALUES (6, 9), (6, 12);
INSERT INTO media_tag (media_id, tag_id) VALUES (6, 2), (6, 6), (6, 8), (6, 17);
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES (6, 13);

/* Clean PHP */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (7, 4, '2011-05-20', 'Even bad code can function. But if code isn\'t clean, it can bring a development organization to its knees. Every year, countless hours and significant resources are lost because of poorly written code. But it doesn\'t have to be that way. In this session you will learn how you can offset your technical debt with clean code that is readable and testable as well as reusable.',
    '47:55', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_003.mp3',
    '',
    3235, 'en', 'Clean PHP', 'clean-php', 1, 'DPCRadio', 'http://techportal.inviqa.com/2012/03/22/dpc-radio-clean-php/');

INSERT INTO media_category (media_id, category_id) VALUES (7, 8), (7, 27);
INSERT INTO media_tag (media_id, tag_id) VALUES (7, 1), (7, 17);
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES (7, 14);

/* Implementing OAuth */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (8, 4, '2011-05-21', 'With Twitter moving its API to OAuth the idea of using tokens rather than passwords for authentication went mainstream. Many explanations of OAuth make it seem complicated whereas in reality the "OAuth Dance" is a series of simple steps executed in sequence. This talk covers consuming and providing OAuth services, includes implementation examples, and is recommended for all technical leads, architects, and integration specialists.',
    '45:55', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_010.mp3',
    '<div style="width:425px" id="__ss_7990565"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/lornajane/oauth-7990565" title="Implementing OAuth with PHP" target="_blank">Implementing OAuth with PHP</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/7990565" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/" target="_blank">presentations</a> from <a href="http://www.slideshare.net/lornajane" target="_blank">Lorna Mitchell</a> </div> </div>',
    3243, 'en', 'Implementing OAuth', 'implementing-oauth', 1, 'DPCRadio', 'http://techportal.inviqa.com/2012/02/08/dpc-radio-implementing-oauth/');

INSERT INTO media_category (media_id, category_id) VALUES (8, 20), (8, 24), (8, 27);
INSERT INTO media_tag (media_id, tag_id) VALUES (8, 17), (8, 18);
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES (8, 6);

/* Advanced OO Patterns */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (9, 4, '2011-05-20', 'You already know Singleton, Signal/Observer, Factory and friends. But, which object oriented patterns are en vogue in the PHP world and how can you seize their power? This talk gives you an overview on Dependency Injection, Data Mapper and more OO patterns the PHP world talks about right know, using practical code examples.',
    '43:41', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_001.mp3',
    'http://qafoo.com/presentations.html',
    3240, 'en', 'Advanced OO Patterns', 'advanced-oo-patterns', 1, 'DPCRadio', 'http://techportal.inviqa.com/2012/01/17/dpc-radio-advanced-oo-patterns/');

INSERT INTO media_category (media_id, category_id) VALUES (9, 8), (9, 13), (9, 14);
INSERT INTO media_tag (media_id, tag_id) VALUES (9, 1), (9, 15), (9, 17);
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES (9, 15);

/* Profiling PHP Applications */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (10, 4, '2011-05-21', 'The web is full of useful advice focussed on pushing out the last bit of performance of your code. They mention trivial changes. like changing every occurrence of print with echo even suggesting to use for instead of foreach. These optimisations help, but you are not going to notice it unless they\'re in a tight loop with many iterations. It is also a wrong approach for tackling performance issues. Before you can optimise, you need to find out if your codeis actually slow; then you need to *understand* the code; and *then* you need to find out where you can optimise it. This talk introduces tools and concepts to optimise the optimisation of your PHP applications.',
    '48:50', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_015.mp3',
    'http://derickrethans.nl/talks/profiling-dpc11.pdf',
    3242, 'en', 'Profiling PHP Applications', 'profiling-php-applications', 1, 'DPCRadio', 'http://techportal.inviqa.com/2011/12/14/dpc-radio-profiling-php-applications/');

INSERT INTO media_category (media_id, category_id) VALUES (10, 8), (10, 27);
INSERT INTO media_tag (media_id, tag_id) VALUES (10, 1), (10, 17), (10, 19);
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES (10, 8);

/* Distributed Couch Apps - Embracing eventual consistency */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (11, 4, '2011-05-20', 'CouchDB is a prominent representative of the NoSQL movement. Using its integrated web server and eventual consistent replication you can not only distribute data, but also full application code. This even works for clients which are not always connected to the internet, like e.g. mobile devices. This session gives you an insight Couch apps, their beauty and pitfalls.',
    '42:12', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_006.mp3',
    'http://qafoo.com/presentations.html',
    3236, 'en', 'Distributed Couch Apps - Embracing eventual consistency', 'distributed-couch-apps-embracing-eventual-consistency', 1, 'DPCRadio', 'http://techportal.inviqa.com/2011/11/21/dpc-radio-distributed-couch-apps-embracing-eventual-consistency/');

INSERT INTO media_category (media_id, category_id) VALUES (11, 10), (11, 15);
INSERT INTO media_tag (media_id, tag_id) VALUES (11, 17), (11, 20), (11, 21);
INSERT INTO `media_speaker` (media_id, speaker_id ) VALUES (11, 16);

/* Developing and Deploying High Performance PHP Applications */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (12, 4, '2011-05-20', 'This session starts with a brief but important overview about the growing Oracle technology eco-system. It shows what Oracle\'s direction means for PHP application development and deployment.

The majority of the talk then highlights techniques on building high performance PHP applications with the very widely used Oracle Database. Techniques include connection pooling, application monitoring, automatic data privacy for PHP application users, online application upgrades, caching for performance, and how to suspend and resume database transactions to effectively build stateful web applications.',
    '49:50', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_005.mp3',
    'http://www.oracle.com/technetwork/topics/php/highperf-php-preso-405765.pdf',
    3225, 'en', 'Developing and Deploying High Performance PHP Applications', 'developing-and-deploying-high-performance-php-applications', 1, 'DPCRadio', 'http://techportal.inviqa.com/2011/11/10/dpc-radio-developing-and-deploying-high-performance-php-applications/');

INSERT INTO media_category (media_id, category_id) VALUES (12, 8), (12, 27);
INSERT INTO media_tag (media_id, tag_id) VALUES (12, 1), (12, 9), (12, 10), (12, 17), (12, 19);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (12, 17);

/* Searching with Solr - Why, When, and How */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (13, 4, '2011-05-20', 'With Google constantly pushing the customer expectations of searching, is it time to move away from our database full-text search in pursuit of a more targeted platform? Can implementing Solr offer more than an answer to a search? Implementing a search platform isn\'t always suitable for all applications, but in this talk we\'ll look at identifying the right search solution, choosing the best way to integrate it into our application and exploring all the benefits a search server can offer.',
    '44:54', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_016.mp3',
    '<div style="width:425px" id="__ss_8040150"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/paulmatthews86/search-with-solr" title="Search with Solr" target="_blank">Search with Solr</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/8040150" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/thecroaker/death-by-powerpoint" target="_blank">PowerPoint</a> from <a href="http://www.slideshare.net/paulmatthews86" target="_blank">Paul Matthews</a> </div> </div>',
    3221, 'en', 'Searching with Solr - Why, When, and How', 'searching-with-solr-why-when-and-how', 1, 'DPCRadio', 'http://techportal.inviqa.com/2011/10/05/dpc-radio-searching-with-solr-why-when-and-how/');

INSERT INTO media_category (media_id, category_id) VALUES (13, 29);
INSERT INTO media_tag (media_id, tag_id) VALUES (13, 8), (13, 17);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (13, 18);

/* Let's take over the world with Zend Framework */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (14, 4, '2011-05-21', 'Many people use Zend Framework for it\'s MVC implementation, but it has a lot of hidden gems. Internationalization (i18n) is one of them. We will look how you can create an application that will have the right languages, currencies, dates and times all based on the location of the visiting user. This session will take away a lot of headaches in international projects and will improve the quality in overall.',
    '42:13', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_012.mp3',
    '<div style="width:425px" id="__ss_8063834"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/Martin82/lets-take-over-the-world-with-zend-framework-8063834" title="Let&#39;s take over the world with Zend Framework" target="_blank">Let&#39;s take over the world with Zend Framework</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/8063834" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/" target="_blank">presentations</a> from <a href="http://www.slideshare.net/Martin82" target="_blank">Martin de Keijzer</a> </div> </div>',
    3253, 'en', 'Let\'s take over the world with Zend Framework', 'lets-take-over-the-world-with-zend-framework', 1, 'DPCRadio', 'http://techportal.inviqa.com/2011/09/21/dpc-radio-lets-take-over-the-world-with-zend-framework/');

INSERT INTO media_category (media_id, category_id) VALUES (14, 8), (14, 16), (14, 17);
INSERT INTO media_tag (media_id, tag_id) VALUES (14, 1), (14, 17), (14, 22);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (14, 19);

/* Keynote - First Class APIs */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl )
VALUES
    (15, 4, '2011-05-21', 'APIs are commonly an afterthought, like a hot tub awkwardly attached to a house — a shoehorned approach that produces a suboptimal app with scarce support that lacks documentation. In effect, APIs are the ugly stepchild of the Web.

This is a sad reality that we are faced with, because many companies make their living consuming third-party APIs and mixing in their own data to create amazing and interesting mashups. In the initial phases of development, there is rarely enough money to develop the app and its API. By the time there’s both demand and money, it can be hard to fit an API on top of the architecture in such a way that the whole thing won\'t fall over. APIs should be first class citizens of the Web. Inconceivable? Possimpible? Not at all!

In this talk we will dive deeper into why APIs are an afterthought, how we can change that. We will also touch on how that can benefit your product down the line in terms of resource savings and infrastructure efficiency, as well as the impact it will have on your infrastructure.',
    '52:08', 0, 0,
    'http://dpcradio.s3.amazonaws.com/2011_007.mp3',
    '<div style="width:425px" id="__ss_8081619"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/helgith/firstclass-apis-dpc-2011-amsterdam" title="First-Class APIs, DPC 2011, Amsterdam" target="_blank">First-Class APIs, DPC 2011, Amsterdam</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/8081619" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/" target="_blank">presentations</a> from <a href="http://www.slideshare.net/helgith" target="_blank">Helgi Þormar Þorbjörnsson</a> </div> </div>',
    3241, 'en', 'Keynote - First Class APIs', 'keynote-first-class-apis', 1, 'DPCRadio', 'http://techportal.inviqa.com/2011/09/13/dpc-radio-keynote-first-class-apis/');

INSERT INTO media_category (media_id, category_id) VALUES (15, 20), (15, 24);
INSERT INTO media_tag (media_id, tag_id) VALUES (15, 17), (15, 18);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (15, 20);

/*
 * PHPNW11 talks
 */

/*
How to Stand on the Shoulders of Giants
http://a.images.blip.tv/Phpcodemonkey-69107169.png
*/
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )
VALUES
    (16, 2, '2011-10-08', 'Every great breakthrough is built on the work that has come before it.

The most successful innovators in our industry ignore the conventional wisdom of the moment and draw on the rich history of computing, the internet and the web to transform the simplest of ideas into defining pieces of technology.

As software engineers, we all have the potential to navigate the history of our industry, tease out the genius from what has come before, and build a platform for our own ideas. By doing so, we can see that little bit further and in turn provide the foundations for others to build on what we have done.

In this session we\'ll look at how the history of the web itself is rooted in sharing information and how modern giants like Google and Facebook are founded on what came before them, while being driven forwards by the ecosystems they helped build. We\'ll see how successful open source projects leverage the past, and how by following some simple principles we can make use of the information, projects and people around us to improve ourselves and our careers.',
    '30:58', 0, 0,
    '<iframe src="http://blip.tv/play/h75rguDRYwI.html?p=1" width="500" height="334" frameborder="0" allowfullscreen></iframe><embed type="application/x-shockwave-flash" src="http://a.blip.tv/api.swf#h75rguDRYwI" style="display:none"></embed>',
    '<div style="width:425px" id="__ss_9605304"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/IanBarber/how-to-stand-on-the-shoulders-of-giants" title="How to stand on the shoulders of giants" target="_blank">How to stand on the shoulders of giants</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/9605304" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/" target="_blank">presentations</a> from <a href="http://www.slideshare.net/IanBarber" target="_blank">Ian Barber</a> </div> </div>',
    3582, 'en', 'How to Stand on the Shoulders of Giants', 'how-to-stand-on-the-shoulders-of-giants', 1, 'Blip.TV', 'http://blip.tv/phpnw/phpnw11-keynote-ian-barber-how-to-stand-on-the-shoulders-of-giants-5777535',
    'http://a.images.blip.tv/Phpcodemonkey-69107169.png');

INSERT INTO media_category (media_id, category_id) VALUES (16, 32);
INSERT INTO media_tag (media_id, tag_id) VALUES (16, 16);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (16, 21);

/*
Zend Framework 2 - State of the Art
http://a.images.blip.tv/Phpcodemonkey-19803918.png
*/
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )
VALUES
    (17, 2, '2011-10-08', 'In this talk we will present the state of the art of the Zend Framework 2 project. We will discuss the new architecture, the new features, the performance improvement and the new classes of the 2.0 release. Moreover, we will discuss about the differences between ZF1 and ZF2 and how to migrate a ZF1 project to the new version.',
    '48:21', 0, 0,
    '<iframe src="http://blip.tv/play/h75rguW_agI.html?p=1" width="532" height="334" frameborder="0" allowfullscreen></iframe><embed type="application/x-shockwave-flash" src="http://a.blip.tv/api.swf#h75rguW_agI" style="display:none"></embed>',
    '',
    3584, 'en', 'Zend Framework 2 - State of the Art', 'zend-framework-2-state-of-the-art', 1, 'Blip.TV', 'http://blip.tv/phpnw/phpnw11-enrico-zimuel-zend-framework-2-state-of-the-art-5857158',
    'http://a.images.blip.tv/Phpcodemonkey-19803918.png');

INSERT INTO media_category (media_id, category_id) VALUES (17, 8), (17, 16), (17, 31);
INSERT INTO media_tag (media_id, tag_id) VALUES (17, 1), (17, 16), (17, 23);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (17, 22);

/* PHP Tester's Toolbox - http://a.images.blip.tv/Phpcodemonkey-33878487.png */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )
VALUES
    (18, 2, '2011-10-08', 'Various testing tools exist to test the different aspects and layers of PHP applications. There is PHPUnit for Unit Testing (and Test-Driven Development), Behat and PHPSpec for Acceptance Testing (and Behaviour-Driven Development), Selenium for System Testing, and a plethora of tools for testing non-functional aspects such as performance and security.
This presentation provides an overview of the goals of each of these tools and shows the first steps to leveraging them in your daily routine.',
    '60:00', 0, 0,
    '<iframe src="http://blip.tv/play/h75rguXJSAI.html?p=1" width="532" height="334" frameborder="0" allowfullscreen></iframe><embed type="application/x-shockwave-flash" src="http://a.blip.tv/api.swf#h75rguXJSAI" style="display:none"></embed>',
    '',
    3585, 'en', 'PHP Tester\'s Toolbox', 'php-testers-toolbox', 1, 'Blip.TV', 'http://blip.tv/phpnw/phpnw11-sebastian-bergmann-php-tester-s-toolbox-5858404',
    'http://a.images.blip.tv/Phpcodemonkey-33878487.png');

INSERT INTO media_category (media_id, category_id) VALUES (18, 8), (18, 9), (18, 12), (18, 28);
INSERT INTO media_tag (media_id, tag_id) VALUES (18, 1), (18, 2), (18, 6), (18, 8), (18, 16);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (18, 14);

/* Scaling Your Development Team - http://a.images.blip.tv/Phpcodemonkey-67840256.png */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )
VALUES
    (19, 2, '2011-10-08', '10 people working on a single code base can be considered high, but what about 600 people? At Facebook code is pushed 5 times a week to over 500 million people, the small amount of downtime is down to the practices our engineering team use and the process in which we do a release. This talk is going to cover everything that goes into the development of a feature at Facebook and how that code is pushed. We\'ll try to cover as much as possible about the underlying technology stack and the open source software we use and release to make it all happen.',
    '58:55', 0, 0,
    '<iframe src="http://blip.tv/play/h75rguXJbgI.html?p=1" width="532" height="334" frameborder="0" allowfullscreen></iframe><embed type="application/x-shockwave-flash" src="http://a.blip.tv/api.swf#h75rguXJbgI" style="display:none"></embed>',
    '',
    3593, 'en', 'Scaling your Development Team', 'scaling-your-development-team', 1, 'Blip.TV', 'http://blip.tv/phpnw/phpnw11-scott-macvicar-scaling-your-development-team-5858442',
    'http://a.images.blip.tv/Phpcodemonkey-67840256.png');

INSERT INTO media_category (media_id, category_id) VALUES (19, 8), (19, 9);
INSERT INTO media_tag (media_id, tag_id) VALUES (19, 1), (19, 11), (19, 16), (19, 21);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (19, 23);


/* Estimation or 'How To Dig Your Own Grave' - http://a.images.blip.tv/Phpcodemonkey-56226257.png */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )
VALUES
    (20, 2, '2011-10-08', 'Clients need to know how much a project will cost. Waterfall development is always late and over-budget. Agile development is done when it\'s done. You\'re left with estimates that you know are too low and then you squeeze them anyway. It shouldn\'t be this way. We\'ll look at how this happens, early warning signs, ways out and ways of avoiding it in the first place.',
    '45:24', 0, 0,
    '<iframe src="http://blip.tv/play/h75rguXJJwI.html?p=1" width="532" height="334" frameborder="0" allowfullscreen></iframe><embed type="application/x-shockwave-flash" src="http://a.blip.tv/api.swf#h75rguXJJwI" style="display:none"></embed>',
    '<div style="width:425px" id="__ss_9609415"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/rowan_m/estimation-or-how-to-dig-your-grave" title="Estimation or, &quot;How to Dig your Grave&quot;" target="_blank">Estimation or, &quot;How to Dig your Grave&quot;</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/9609415" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/" target="_blank">presentations</a> from <a href="http://www.slideshare.net/rowan_m" target="_blank">Rowan Merewood</a> </div> </div> ',
    3599, 'en', 'Estimation or \'How To Dig Your Own Grave\'', 'estimation-or-how-to-dig-your-own-grave', 1, 'Blip.TV', 'http://blip.tv/phpnw/phpnw11-rowan-merewood-estimation-or-how-to-dig-your-own-grave-5858371',
    'http://a.images.blip.tv/Phpcodemonkey-56226257.png');

INSERT INTO media_category (media_id, category_id) VALUES (20, 27);
INSERT INTO media_tag (media_id, tag_id) VALUES (20, 16);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (20, 13);


/* Are Your Tests Really Helping? - http://a.images.blip.tv/Phpcodemonkey-41122137.png */
INSERT INTO `Media`
    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )
VALUES
    (21, 2, '2011-10-08', 'Developer testing can reduce debug time, serve as executable documentation, build confidence, expose questionable patterns running rampant in your code, and in general, increase the speed of development and deployment. Tests can also cost you time, sanity, and agility.This session will not be the same old re-hash of the Misko Hevry talk on testability. Instead of a talk that is generic, syntactically translated from Java to PHP, and neglectful the major coding patterns prevalent in existing PHP 5 code bases, all of which results in the majority of the audience as un-sold, we will look at coding and testing patterns inspired by a real PHP project. We will also discuss how to identify patterns and make small adjustments where testing is and is not helping. The end result will be a toolbox of habits we can use to improve testability and forward momentum in development.',
    '58:54', 0, 0,
    '<iframe src="http://blip.tv/play/h75rguXKBwI.html?p=1" width="532" height="334" frameborder="0" allowfullscreen></iframe><embed type="application/x-shockwave-flash" src="http://a.blip.tv/api.swf#h75rguXKBwI" style="display:none"></embed>',
    '<div style="width:425px" id="__ss_9618458"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/elblinkin/are-your-tests-really-helping-you" title="Are Your Tests Really Helping You?" target="_blank">Are Your Tests Really Helping You?</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/9618458?rel=0" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more presentations from <a href="http://www.slideshare.net/elblinkin" target="_blank">LB Denker</a> </div> </div>',
    3583, 'en', 'Are Your Tests Really Helping?', 'are-your-tests-really-helping', 1, 'Blip.TV', 'http://blip.tv/phpnw/phpnw11-laura-beth-denker-are-your-tests-really-helping-5858467',
    'http://a.images.blip.tv/Phpcodemonkey-41122137.png');

INSERT INTO media_category (media_id, category_id) VALUES (21, 8), (21, 9), (21, 12), (21, 27), (21, 28);
INSERT INTO media_tag (media_id, tag_id) VALUES (21, 1), (21, 2), (21, 6), (21, 8), (21, 16);
INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (21, 24);



/* The Lost Art of Simplicity */

INSERT INTO `Media`

    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )

VALUES

    (22, 2, '2011-03-03', 'Simplicity is a lost art in the application development space. The Wikipedia definition of simplicity is "Simplicity is the property, condition, or quality of being simple or un-combined. It often denotes beauty, purity or clarity. Simple things are usually easier to explain and understand than complicated ones. Simplicity can mean freedom from hardship, effort or confusion." This is a beautiful statement that we often lose sight of when we are building our applications. Instead we are on a never ending quest to fill out a checklist of features or to build something clever forgetting about the actual needs of our users to get a specific task done. This session takes complexity to task and challenges you to bring simplicity to the centre of your development with some straightforward ideas and guidance.',

    '48:51', 0, 0,

    '<iframe class="player" frameborder="0" scrolling="no" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/web//player-html5-570.html" width="400" height="334"><noframes><img alt="&lt;h2&gt;3 Mars Introduction Symfony&lt;/h2&gt;" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110310-095044/photo_1.jpg" /><h2>3 Mars Introduction Symfony</h2></noframes></iframe>',

    '<div style="width:425px" id="__ss_1360628"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/joshholmes/the-lost-art-of-simplicity" title="The Lost Art of Simplicity" target="_blank">The Lost Art of Simplicity</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/1360628" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/thecroaker/death-by-powerpoint" target="_blank">PowerPoint</a> from <a href="http://www.slideshare.net/joshholmes" target="_blank">Josh Holmes</a> </div> </div>',

    2741, 'en', 'The Lost Art of Simplicity', 'the-lost-art-of-simplicity', 1, 'Symfony', 'http://symfony.com/video/Paris2011/570',

    'http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110310-095044/photo_1.jpg'

    );

INSERT INTO media_category (media_id, category_id) VALUES (22, 9);  /* Quality Assurance  */

INSERT INTO media_tag (media_id, tag_id) VALUES (22, 2), (22, 24) ;  /* Quality Assurance / symfony_live11 */

INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (22, 25);  /*Josh Holmes */



/* Application Security, Dependency Injection and AOP in Symfony2 */

INSERT INTO `Media`

    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )

VALUES

    (23, 2, '2011-03-03', 'Security is a crucial aspect in most, if not all, applications and as such it is a concern that crosses application\'s functionality. In the first part of this talk, we will take a deeper look at the Symfony2 Security Component. In the second part, we will then unleash the power of the Dependency Injection container to add AOP capabilities, and see how you can secure your application without changing a single line of application code.',

    '40:01', 0, 0,

    '<iframe class="player" frameborder="0" scrolling="no" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/web//player-html5-566.html" width="400" height="300"><noframes><img alt="&lt;h2&gt;3 Mars Session 01 Symfony &lt;/h2&gt;" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-164915/photo_1.jpg" /><h2>3 Mars Session 01 Symfony </h2></noframes></iframe> ',

    NULL,

    2742, 'en', 'Application Security, Dependency Injection and AOP in Symfony2', 'application-security-dependency-injection-and-aop-in-symfony2', 1, 'Symfony', 'http://symfony.com/video/Paris2011/566',

    'http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-164915/photo_1.jpg'

    );



INSERT INTO media_category (media_id, category_id) VALUES  (23, 19);  /* Symfony2 */

INSERT INTO media_tag (media_id, tag_id) VALUES (23, 24), (23, 14), (23, 25), (23, 26) ;  /* symfony_live11 / Security / Dependency Injection / AOP */

INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (23, 26);  /*Johannes Schmidt */




/* Apostrophe: a Symfony-powered CMS your clients will love */

INSERT INTO `Media`

    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )

VALUES

    (24, 2, '2011-03-03', 'Apostrophe is a Symfony-powered, open-source CMS. Apostrophe rejects "back end" applications in favor of an enhanced experience for editors. We at P\'unk Avenue believe your client can manage their site without special study. Learn to integrate your own Symfony modules and plugins with Apostrophe. Includes a discussion of Apostrophe 2.0.',

    '36:31', 0, 0,

    '<iframe class="player" frameborder="0" scrolling="no" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/web//player-html5-565.html" width="400" height="300"><noframes><img alt="&lt;h2&gt;3 Mars Session 02 Symfony &lt;/h2&gt;" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-164059/photo_1.jpg" /><h2>3 Mars Session 02 Symfony </h2></noframes></iframe>',

    NULL,

    2744, 'en', 'Apostrophe: a Symfony-powered CMS your clients will love', 'apostrophe-a-symfony-powered-cms-your-clients-will-love', 1, 'Symfony', 'http://symfony.com/video/Paris2011/565',

    'http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-164059/photo_1.jpg'

    );



INSERT INTO media_category (media_id, category_id) VALUES (24, 19);  /*  Symfony2  */

INSERT INTO media_tag (media_id, tag_id) VALUES (24, 24), (24, 27), (24, 28) ;  /* symfony_live11 / Apostrophe / CMS */

INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (24, 27);  /* Tom Boutell */




/* Contributing with Git: Reducing the frictions of Open Source collaboration with the Git VCS */

INSERT INTO `Media`

    (`id`, mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, hostName, hostUrl, thumbnail )

VALUES

    (25, 2, '2011-03-03', 'This talk will describe how Git has eased the collaboration process for thousands of open source projects. From projects using mailing lists and patch series to small groups using centralized repositories to huge projects like the Linux kernel, Git enables several workflows to make the process of collaborating on source code as easy as possible for the developer and the project maintainer. We will go over each of the major workflows that open source and proprietary projects use and what tools each member of the team need and how to use them effectively. This talk should be helpful if you are a project contributor, a project maintainer, or both.',

    '51:01', 0, 0,

    '<iframe class="player" frameborder="0" scrolling="no" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/web//player-html5-567.html" width="400" height="300"><noframes><img alt="&lt;h2&gt;3 Mars Session 03 Symfony&lt;/h2&gt;" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-183215/photo_1.jpg" /><h2>3 Mars Session 03 Symfony</h2></noframes></iframe> ',

    NULL,

    2747, 'en', 'Contributing with Git: Reducing the frictions of Open Source collaboration with the Git VCS', 'contributing-with-git-reducing-the-frictions-of-open-source-collaboration-with-the-git-vcs', 1, 'Symfony', 'http://symfony.com/video/Paris2011/567',

    'http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-183215/photo_1.jpg'

    );



INSERT INTO media_category (media_id, category_id) VALUES (25, 33), (25, 22);  /*  / Open Source / Git */

INSERT INTO media_tag (media_id, tag_id) VALUES (25, 24), (25, 29) ;  /* symfony_live11 / Git  */

INSERT INTO `media_speaker` (media_id, speaker_id) VALUES (25, 28);  /* Scott Chacon */


/* Reenable foreign key constrain checks in MySQL */

SET foreign_key_checks = 1;
