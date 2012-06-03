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

INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('contact','Contact Us','Contact','Some dummy text for contact page');
INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('contribute','How to Contribute','Contribute','Some dummy text for contribute page');
INSERT INTO `Page` (url,pagetitle,title,content) VALUES ('about','About Us','About','Some dummy text for about page');


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
    (22, 'Zend Framework')
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

INSERT INTO `Category` (`id`, `parent_id`, `name`) VALUES
(8, NULL, 'PHP'),
(9, 8, 'Quality Assurance'),
(10, NULL, 'Databases'),
(11, 10, 'MySQL'),
(12, 9, 'Test Driven Development'),
(13, 8, 'Object Orientation'),
(14, 13, 'Design Patterns'),
(15, 10, 'CouchDB'),
(16, 8, 'Frameworks'),
(17, 16, 'Zend Framework'),
(18, 16, 'Symfony'),
(19, 16, 'Symfony2'),
(20, 8, 'Webservices'),
(21, NULL, 'Version Control Systems'),
(22, 21, 'Git'),
(23, 21, 'Subversion'),
(24, 20, 'Restful API'),
(25, 9, 'Technical debt'),
(26, NULL, 'User Experience'),
(27, 9, 'Best Practices'),
(28, NULL, 'Tools'),
(29, 28, 'Solr')
;

/* Delete all Media records then re-load sample data */

TRUNCATE TABLE `Media`;

INSERT INTO `Media` (mediatype_id, `date`, description, `length`, rating, visits, content, slides, joindin, `language`, title, slug, isPublished, thumbnail ) VALUES (1, null,'A talk about peripheral tools that aid web development', '1hr 20mins', '0', '0', '<iframe src="http://player.vimeo.com/video/30012690" width="500" height="409" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>','<div style="width:425px" id="__ss_9285199"><iframe src="http://www.slideshare.net/slideshow/embed_code/9285199" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe></div>',null,'en', 'Tool Up Your Lamp Stack', 'tool-up-your-lamp-stack', '1', 'thumbnail_1.png');

INSERT INTO `Media` (mediatype_id, `date`,`length`, rating, visits, content, joindin, `language`, title, slug, isPublished) VALUES (1, null, '40mins', '0', '0', '<iframe class="player" frameborder="0" scrolling="no" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/web//player-html5-568.html" width="400" height="300"><noframes><img alt="&lt;h2&gt;3 Mars Session 05 Symfony&lt;/h2&gt;" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-193143/photo_1.jpg" /><h2>3 Mars Session 05 Symfony</h2></noframes></iframe>','2597','en', 'phpBB4: Building end-user applications with Symfony2', 'phpbb4-building-end-user-applications-with-symfony2', '1' );

INSERT INTO `Media` (mediatype_id,`date`, description, `length`, rating, visits, content, `language`, title, slug, isPublished ) VALUES (3,'2012-05-15','A Voices of the ElePHPant Interview with Derick Rethans by Cal Evans, sponsored by EngineYard.', '11mins', '0', '0', 'http://voices.of.the.elephpant.s3.amazonaws.com/vote_052.mp3','en', 'Interview with Derick Rethans', 'interview-with-derick-rethans', '1');

INSERT INTO `Media` (mediatype_id,`date`, description, `length`, rating, visits, content, `language`, title, slug, isPublished ) VALUES (3,'2012-04-26','Episode 11 of the DevHell postcase series. "This time out we are blessed by the presence of Joël Perras, PHP developer extraordinaire and Fictive Kin brosef of Ed. We explore Joël’s rags-to-riches story: a young academic schlepping coffee and 44oz soft drinks at a gas station, where he’s discovered by a grizzled dev team manager in need of Java skills. From there it’s been a whirlwind of web sites, programming languages, and more ops than you can shake a stick at."', '1hr 31mins', '0', '0', 'http://devhell.s3.amazonaws.com/ep11-64mono.mp3','en', 'From Gas Station Attendant to Java Developer', 'from-gas-station-attendant-to-java-developer', '1');

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
    
INSERT INTO media_category (media_id, category_id) VALUES (5, 26);
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


/* Reenable foreign key constrain checks in MySQL */

SET foreign_key_checks = 1;
