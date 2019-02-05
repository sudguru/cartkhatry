# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.17)
# Database: cartkhatry
# Generation Time: 2019-02-05 11:40:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table banners
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `bannertype_id` int(30) unsigned NOT NULL,
  `banner` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(50) DEFAULT NULL,
  `subtitle` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `textat` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;

INSERT INTO `banners` (`id`, `display_order`, `bannertype_id`, `banner`, `title`, `subtitle`, `link`, `textat`, `created_at`, `updated_at`)
VALUES
	(23,1,1,'1547967134.jpg',NULL,NULL,'http://www.asanjogroup.com/',NULL,'2019-01-20 06:52:14','2019-01-20 06:52:19'),
	(24,2,1,'1547967903.jpg',NULL,NULL,'http://khatry.co.uk/',NULL,'2019-01-20 07:05:03','2019-01-20 07:05:03'),
	(25,1,5,'1547969251.jpg',NULL,NULL,'http://baskotagroup.com/',NULL,'2019-01-20 07:27:31','2019-01-20 07:27:36'),
	(26,1,3,'1547969789.jpg',NULL,NULL,'https://www.facebook.com/ilamteahousenepal/',NULL,'2019-01-20 07:36:29','2019-01-20 08:08:39'),
	(27,1,2,'1547970001.jpg',NULL,NULL,'https://www.naturoearth.com/',NULL,'2019-01-20 07:40:01','2019-01-20 07:40:07'),
	(28,3,2,'1547970146.jpg',NULL,NULL,'http://whitelotusorganic.com.np/',NULL,'2019-01-20 07:42:26','2019-01-20 07:42:26'),
	(30,2,2,'1547970445.jpg',NULL,NULL,'https://www.facebook.com/bagmyearth/',NULL,'2019-01-20 07:47:25','2019-01-20 07:47:30'),
	(31,2,3,'1547971429.jpg',NULL,NULL,'http://www.forulift.com/',NULL,'2019-01-20 08:03:49','2019-01-20 08:08:39'),
	(33,3,3,'1547972491.jpg',NULL,NULL,'http://www.aussglobalstudy.com.au/',NULL,'2019-01-20 08:21:31','2019-01-20 08:21:31'),
	(35,2,5,'1547977544.jpg',NULL,NULL,'https://www.facebook.com/musthaves015/',NULL,'2019-01-20 09:45:44','2019-01-20 09:45:44');

/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bannertypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bannertypes`;

CREATE TABLE `bannertypes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `bannertype` varchar(30) NOT NULL DEFAULT '',
  `needsTitle` tinyint(4) DEFAULT NULL,
  `needsSubtitle` tinyint(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bannertypes` WRITE;
/*!40000 ALTER TABLE `bannertypes` DISABLE KEYS */;

INSERT INTO `bannertypes` (`id`, `display_order`, `bannertype`, `needsTitle`, `needsSubtitle`, `created_at`, `updated_at`)
VALUES
	(1,1,'HP Sliders',1,1,'2018-10-31 06:17:21','2019-01-18 08:26:22'),
	(2,2,'HP Banners R1',NULL,NULL,'2018-10-31 06:17:55','2019-01-18 08:26:41'),
	(3,3,'HP Banners R2',NULL,NULL,'2019-01-18 08:26:51','2019-01-18 08:26:51'),
	(4,4,'HP Banners R3',NULL,NULL,'2019-01-18 08:27:01','2019-01-18 08:27:01'),
	(5,5,'HP Banners Vert',NULL,NULL,'2019-01-18 08:27:34','2019-01-18 08:27:34');

/*!40000 ALTER TABLE `bannertypes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table brands
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(30) DEFAULT NULL,
  `pic_path` varchar(50) DEFAULT NULL,
  `description` varchar(300) DEFAULT '',
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;

INSERT INTO `brands` (`id`, `brand`, `pic_path`, `description`, `display_order`, `created_at`, `updated_at`)
VALUES
	(1,'Not Applicable',NULL,NULL,1,'2018-11-24 14:24:11','2018-11-24 14:24:11'),
	(2,'Nike','1543126201.png','nikes',2,'2018-11-25 05:54:05','2019-01-13 10:04:45');

/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cart
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `banner` varchar(100) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `slug` varchar(50) NOT NULL DEFAULT '',
  `parent_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `category`, `description`, `banner`, `display_order`, `slug`, `parent_id`, `created_at`, `updated_at`)
VALUES
	(31,'Electronics & Computers',NULL,NULL,4,'electronics-computers',NULL,'2019-01-04 09:38:58','2019-01-17 09:44:04'),
	(32,'Toys & Hobbies',NULL,NULL,5,'toys-hobbies',NULL,'2019-01-04 09:38:58','2019-01-17 09:44:04'),
	(33,'Home & Garden',NULL,NULL,6,'home-garden',NULL,'2019-01-04 09:38:58','2019-01-17 09:44:04'),
	(34,'Decor & Furniture',NULL,NULL,7,'decor-furniture',NULL,'2019-01-04 09:38:58','2019-01-17 09:44:04'),
	(35,'Sports & Fitness',NULL,NULL,8,'sports-fitness',NULL,'2019-01-04 09:38:58','2019-01-17 09:44:04'),
	(36,'Gifts',NULL,NULL,9,'gifts',NULL,'2019-01-04 09:38:58','2019-01-17 09:44:04'),
	(37,'Auto & Accessories',NULL,NULL,10,'auto-accessories',NULL,'2019-01-04 09:45:02','2019-01-17 09:44:04'),
	(38,'Handicrafts',NULL,NULL,1,'handicrafts',NULL,'2019-01-13 10:00:13','2019-01-13 10:00:13'),
	(46,'Felt',NULL,NULL,2,'felt',38,'2019-01-17 09:16:04','2019-01-17 09:16:04'),
	(47,'Handknitted Clothes',NULL,NULL,3,'handknitted-clothes',38,'2019-01-17 09:16:04','2019-01-17 09:16:04'),
	(51,'Industrial Plants, Machinery & Equipment',NULL,NULL,11,'industrial-plants-machinery-equipment',NULL,'2019-01-17 09:41:00','2019-01-17 09:44:04'),
	(52,'Apparel, Clothing & Garments',NULL,NULL,12,'apparel-clothing-garments',NULL,'2019-01-17 09:41:00','2019-01-17 09:44:04'),
	(53,'Women',NULL,NULL,13,'women',52,'2019-01-17 09:41:45','2019-01-17 09:44:04'),
	(54,'Man',NULL,NULL,14,'man',52,'2019-01-17 09:41:45','2019-01-17 09:44:04'),
	(55,'Children',NULL,NULL,15,'children',52,'2019-01-17 09:41:45','2019-01-17 09:44:04'),
	(56,'Food & Beverages',NULL,NULL,16,'food-beverages',NULL,'2019-01-17 09:44:04','2019-01-17 09:44:04'),
	(57,'Mechanical Parts & Spares',NULL,NULL,17,'mechanical-parts-spares',NULL,'2019-01-18 06:33:14','2019-01-18 06:33:14');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contents`;

CREATE TABLE `contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `slug` tinytext NOT NULL,
  `content` mediumtext NOT NULL,
  `contenttype_id` int(11) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;

INSERT INTO `contents` (`id`, `title`, `slug`, `content`, `contenttype_id`, `display_order`, `created_at`, `updated_at`)
VALUES
	(2,'About Us','about-us','<p>Late Mr. Kalyan Raj KC established Khatry Poultry business in Nepal in 1963. By early 1975 he already had renewed name in poultry field then after he established life stock business and hatchery and so on………. By 1980 his business was well-known in SAARC countries. By then it had got branded recognition in all neighboring countries especially in SAARC. He was even awarded in different segmentsof life respectively in poultry business in India, Bangladesh and Srilanka.</p><p>In 1985 he moved into Food Chain Restaurant and in Import and Export business. He started selling pharmaceuticals products like vitamins, minerals and chemicals. By early 1992 Khatry Traders Pvt.Ltd was formed by his elder son Mr. GaganKhatry for trading Agency representatives business. In 1995 GaganKhatry took over firm&nbsp; business and younger son honored into livestock and feed business. One year carrier in active participation of GagnKhatry . Nepal made handicrafts, he exported to SAARC countries.</p><p>By 2000 Khatry Traders Pvt.Ltd was holding more than 200 and forty- three companies worldwide with the representation of Sole Agent inside the country and in SAARC countries as well. Khatry had already made a branded name in world wide. Because of political stability in the country no-new project got opportunity though there were several in pipe line. Unfortunately founder of Khatry Industry MrKalyanKhatry passed away on 29thMarch 2001.</p><p>Immediately after the whole responsibility come in the shoulder of his two sons being backed by their respective family friends. Recently during six years of period Gagan took command of his late father\'s business which was almost all destroyed in insurgent. He again brought this business in light firm grass root. He established Khatry Groups Pvt.Ltd which is actively engaged in reconstructing all in complete old business with new spirit.</p><p>Khatry and company got registered in UK, two years back in 1916 by his younger son MrGambhir Raj Kc under the umbrella of this company. Whatever they are doing is clearly stated in Website of this company.</p>',2,1,NULL,'2018-12-08 16:08:07'),
	(3,'How it Works ?','how-it-works','This is information <b>ok&lt;script&gt;alert(\'hello\')&lt;/script&gt;</b>',2,5,NULL,'2018-12-08 16:09:29'),
	(4,'Contact Us','contact-us','&lt;p&gt;Sem, gravida phasellus et etiam. Lacus. Adipiscing tempor nunc fermentum pede montes fames eleifend justo rutrum ornare. Sollicitudin interdum interdum et condimentum. Posuere dapibus. Massa consequat.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Mi sagittis.Sagittis fusce fermentum dictumst pharetra parturient scelerisque pellentesque justo lobortis sit primis nisl integer cursus Ipsum lobortis. Non cras ut hymenaeos class. Tellus ante phasellus orci vivamus fames eu metus eget tincidunt tellus rhoncus.Ridiculus donec vehicula. Sit conubia velit fringilla lacus et laoreet integer. Dignissim aliquam sagittis cum etiam.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Inceptos viverra consequat a parturient tempor netus metus, quam sem erat torquent convallis. Volutpat fermentum curae; Aptent nulla. Ornare nunc quisque hymenaeos.&lt;/p&gt;',2,7,NULL,'2018-12-08 16:09:29'),
	(5,'FAQ','faq','&lt;p&gt;Sem, gravida phasellus et etiam. Lacus. Adipiscing tempor nunc fermentum pede montes fames eleifend justo rutrum ornare. Sollicitudin interdum interdum et condimentum. Posuere dapibus. Massa consequat.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Mi sagittis.Sagittis fusce fermentum dictumst pharetra parturient scelerisque pellentesque justo lobortis sit primis nisl integer cursus Ipsum lobortis. Non cras ut hymenaeos class. Tellus ante phasellus orci vivamus fames eu metus eget tincidunt tellus rhoncus.Ridiculus donec vehicula.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Sit conubia velit fringilla lacus et laoreet integer. Dignissim aliquam sagittis cum etiam. Inceptos viverra consequat a parturient tempor netus metus, quam sem erat torquent convallis. Volutpat fermentum curae; Aptent nulla. Ornare nunc quisque hymenaeos.&lt;/p&gt;',2,6,NULL,'2018-12-08 16:09:29'),
	(6,'Terms & Conditions','terms-conditions','&lt;p&gt;Sem, gravida phasellus et etiam. Lacus. Adipiscing tempor nunc fermentum pede montes fames eleifend justo rutrum ornare.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Sollicitudin interdum interdum et condimentum. Posuere dapibus. Massa consequat. Mi sagittis.Sagittis fusce fermentum dictumst pharetra parturient scelerisque pellentesque justo lobortis sit primis nisl integer cursus Ipsum lobortis. Non cras ut hymenaeos class. Tellus ante phasellus orci vivamus fames eu metus eget tincidunt tellus rhoncus.Ridiculus donec vehicula. Sit conubia velit fringilla lacus et laoreet integer. Dignissim aliquam sagittis cum etiam.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Inceptos viverra consequat a parturient tempor netus metus, quam sem erat torquent convallis. Volutpat fermentum curae; Aptent nulla. Ornare nunc quisque hymenaeos.&lt;/p&gt;',3,1,NULL,'2018-10-30 10:17:51'),
	(7,'Privacy Policy','privacy-policy','<p>Sem, gravida phasellus et etiam. Lacus. Adipiscing tempor nunc fermentum pede montes fames eleifend justo rutrum ornare. Sollicitudin interdum interdum et condimentum. Posuere dapibus. Massa consequat.</p><p>Mi sagittis.Sagittis fusce fermentum dictumst pharetra parturient scelerisque pellentesque justo lobortis sit primis nisl integer cursus Ipsum lobortis. Non cras ut hymenaeos class. Tellus ante phasellus orci vivamus fames eu metus eget tincidunt tellus rhoncus.Ridiculus donec vehicula.</p><p>Sit conubia velit fringilla lacus et laoreet integer. Dignissim aliquam sagittis cum etiam. Inceptos viverra consequat a parturient tempor netus metus, quam sem erat torquent convallis. Volutpat fermentum curae; Aptent nulla. Ornare nunc quisque hymenaeos.</p>',3,7,NULL,'2018-12-08 16:03:19'),
	(8,'This is a blog','this-is-a-blog','<p>                dfasdf asdfd</p><ul><li>asdfasdfadsf</li><li>asdfadsf</li><li>asdfdsaf</li><li>asdf ffsf xxx</li><li>asdfdsaf</li></ul><p><br></p>',1,2,NULL,'2018-11-23 03:17:16'),
	(9,'How to Make a payment ?','how-to-make-a-payment','<i>                This</i> is how you make payment. honey.',2,4,'2018-10-18 17:06:44','2018-12-08 16:09:29'),
	(10,'New Blog Content','new-blog-content','<p>fasdf <b>alsdf</b> dsf</p><p>asdfadsf<br></p>',1,1,'2018-10-19 04:34:51','2018-11-02 08:31:26'),
	(11,'This is cool content, actually youtube and image and link','this-is-cool-content-actually-youtube-and-image-and-link','<p><a href=\"http://yahoo.com\">Hello there</a></p><p><img style=\"width: 588px;\" src=\"data:image/jpeg;base64,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\" data-filename=\"boudhastupa.jpg\"><br></p><p><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/tqQXpfOrGKM\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br></p>',1,3,'2018-10-30 06:31:18','2018-11-23 03:17:16'),
	(12,'asdfasdf','asdfasdf','asdfadsfdasfsdsad',4,1,'2018-11-02 05:45:08','2018-11-02 05:45:28'),
	(13,'Services','services','<p><img src=\"data:image/png;base64,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\" data-filename=\"icons8-manufacturing-100.png\" style=\"width: 100px; float: left;\" class=\"note-float-left\"><b>As Manufacturer</b><br>From poultry feed to human food, garments clothes to fabric, hand-made and machine made we are engaged in manufacturing to buying. We have four decades of experiences in this. Our sister companies khatry food products, khatry livestock and khatry and companies etc. will confirm.</p><p><br></p><p><img src=\"data:image/png;base64,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\" data-filename=\"icons8-reseller-filled-100.png\" style=\"width: 100px; float: left;\" class=\"note-float-left\"><span style=\"font-size: 1.4rem;\"><b>Distributer dealer</b><br>Some of our partner companies have been appointed as the local dealer for some of the world class products. Likewise many multinational companies are in process.<br></span></p><p><span style=\"font-size: 1.4rem;\"><br></span><br></p><p><img src=\"data:image/png;base64,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\" data-filename=\"icons8-admin-settings-male-filled-100.png\" style=\"width: 100px; float: left;\" class=\"note-float-left\"><b>Sourcing Agent</b><br><span style=\"font-size: 1.4rem;\">Because of having 5 decades of regular services providing to the clients of all over the world. We can proudly say along with our associates with a pictures and specification within no time. We can source any products from Nepal likewise within the time frame regard to other countries.</span></p><p><br></p><p><img src=\"data:image/png;base64,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\" data-filename=\"icons8-administrator-male-filled-100.png\" style=\"width: 100px; float: left;\" class=\"note-float-left\"><span style=\"font-size: 1.4rem;\"><b>As Sole Agent</b><br>From two decades of frame khatry food Pvt.Ltd as well-known name in international market has been appointed as a sole agent for more than 300 companies worldwide and we are very pleased with the authority.</span></p><p><span style=\"font-size: 1.4rem;\"><br></span></p><p><img src=\"data:image/png;base64,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\" data-filename=\"icons8-handshake-100.png\" style=\"width: 100px; float: left;\" class=\"note-float-left\"><span style=\"font-size: 1.4rem;\"><b>As a Representative</b><br>Because of our honesty, open mind and willingness, national and multinational companies have trusted us and given us authority as representative to complete their open tasks to final touch.</span><br></p><p><br><br></p><p><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAP7SURBVHhe7d1PyFRVHMbxt8zSMqKkRRgZphhYLTLSMNqUEgbVQhJU2gRuXESIBNUmUCiK0KgwxFokBWHkpkVBEbVQ3JhIixK0WmRFUaZYmf35PjiLV/mNM3P/nHPnPc8XPvvxN/OO984999wJ55xzzjnnnHMjdRHmYBGW4T7ciQW4Eq7lZuABvIq9+B3/9fEPvsBW6M1yDXYjXsFJRMMfxofQX5Or0WV4DqcRDXlU3+BauArdgIOIBlvH13gZj0BvuBuieTiKaKBNOoZNmAbXp8vRxl/GhXwKf5X1SV8n0dDatg/6MLhJzcffiAaWwja4Se1ANKhU9GFYCEc66TuOaFApvQRHDyEaUGo68nL0PKIB5eCvLfoY0XByWIPiO4JoODk8heL7C9Fwcij+8Hc6osHk8hqK7ipEg8ml+DfkCkSDycVn7JTzJ5PzPYPi+xnRcHJ4FMWn69/RcHK4B8W3B9FwcpiL4nsB0XBS+wVaXlR8qxENKLWP4EjX0aMBpfYsXK+fEA0ppeVwvT5ANKRUTsBLgya1BdGgUtHqRtfrVugTGg0qlTN4GI7eRzSk1A7DkY7/owHlcB2K7zdEw8lB64qLryuXcHVfiS4HFN9uRANK7Us4egzRgFJ7EY5m4UdEQ0pFCy1ugut1L3Kdi+gcZD3ceekTmvqcZD8Ww/VJt5tFg2uLf+EdkM4DosG1ZSXcgHT4GQ2vaX9ABxRuQBsRDbBpu+CGaDZOIRpik7zCZITeQDTEphyCFzSMkH51bfM2txVwI/Y4omHWpXMdVyHtsvAeoqFWpe01vFFAjS7Gr4iGW8UdcDX7FtFwq9D1e1czvyEdy29Ix/oB0XCruA2uZk1eJ7kbrmbRYKu6H65GTd+luwquRtp7JBpsVRvgavQmosFWpTVgl8JV6EFo8Vo02Dq0laAbMb0ZfyIaaBM2Qz/LuAHNhG4C/RfRIJuke0K8uLpP+mV3LZo8Kx+GznGehjfw73U1tKFxis2TL0QXw7TnYrGrF/WYie2os8l+G3QQoY0MtJJyyl/i1U2V6/A5omF0zVfQChgtuphS6T50rSzv0iYzo9DR3ltYgrHudrwLLWaO/qHj6DPowTJjlbYNfwcpDl1z0dfuUnS6S/Ak2jyh6xJ94F5HJw+Z9UghPWUgeuFTnX4f09dzZ9Jl0e8QvdhS6ASzEyvp9Zi6JpfpjDPtHZl1ReQ10O4H0Ysrle65vxlZehvRiyrdAST/JfkuTOXD2rp0q3fSPkH0Quys76HTgCRdD/91DJbsP/gnEL0AO9dOJCn3dnzjQo97TZIPdYejayt64Fmr6T+qph4YXIJb0Gpa06SHydtwdPLsnHPOOeecc865MWti4n/GBW6SAm/iygAAAABJRU5ErkJggg==\" data-filename=\"icons8-user-filled-100.png\" style=\"width: 100px; float: left;\" class=\"note-float-left\"><b>Mediator<br></b>For emerging market in the developing countries mediators have the states of the prime minister. Since our locality been admired by most respected personals, we have been time to time approached to give source of our free time.</p><p><br></p><p><img src=\"data:image/png;base64,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\" data-filename=\"icons8-cargo-ship-filled-100.png\" style=\"width: 100px; float: left;\" class=\"note-float-left\"><b>As an Importer</b><br>When there was no roads in Nepal, the human carrier if you search the word \'khatry\' you well find the name itself as the oldest trader engaged in import and export business. We have been embodying food grain, pharmaceuticals raw to house hold garments and machinery likewise exporting Nepalese handicrafts, foods. Fabric, tea, coffee and industrial forma and minerals.</p><div><br></div>',2,2,'2018-12-08 15:56:19','2018-12-08 16:01:45'),
	(14,'Our Team','our-team','<p>Mr Gagan Khatry – Chief Executive Officer (CEO)</p><p>Mr. Gambhir Raj KC – Managing Director (MD) Recently based in UK</p><p>Mr. Yagya Prasad Kuikel – Account Officer</p><p>Mr. Pranil Pandey – Chartered certified Accountant</p><p>Mr. Ram Chandra Ojha – Legal Advisor</p><p>Mrs. Pratikxya Magar – Office Secretary</p><p>Mr. Dhurba Lama – Marketing Director (Organic &amp; Holistic)</p><p>Dr. Pandey – Advisor&nbsp;</p><p>Mr. Prithivi Raj Khatry – Marketing Director (Europe)</p><p>Mrs. Siska Tuladhar – Marketing Director&nbsp;</p><p>Mr. Gopal Khadka – Eastern Europe</p><p>Valeria – Northen Europe</p><p>Mr. Amit Rana – Advisor (India)</p><p>Mr. RP Khurana – Advisor (Delhi)</p><p>Mr. Yadav Tandan – Advisor Director (Real Estate Associate)</p><p>Mr. Dipendra Tandukar– Advisor (USA)</p><p>Mr. Khrishna Ghale _ Advisor (Japan)</p><p>Mr. Nidup Dorjy -Advisor (Bhutan)</p><p>Dr.Renuka - Advisor (Delhi)</p><p>Mr. DB Malla – Advisor (Philippians)</p><p>Mr. sunil Sharma – Advisor (USA)</p><p>Mr.Prakash Gupta – Advisor (USA)</p><p>Mr. MallaRai – Advisor (Canada)</p><p>Mr. Ravi Basnet – Advisor (Canada)</p><p>Mr.Puna Bhandari – Advisor (Australia)</p><p>Mr. Noya France – Philippians</p><p>Mr.Dharma Raj Pandey – (USA)</p><p>Mr. Carley Brawn – (Ireland)</p><p>Mr. Maja – (Denmark)</p><p>Asha Ram Luitel – (Sweden)</p><p>SabitaThapa–(Hongkan)</p><p>Bal Krishna Joshi – (Newyork,USA)</p><p>Junuroehing- (Australia)</p><p>Sanjiv Shrestha – (USA)</p><div><br></div>',2,3,'2018-12-08 16:09:23','2018-12-08 16:09:29');

/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contenttypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contenttypes`;

CREATE TABLE `contenttypes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contenttype` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(50) NOT NULL DEFAULT '',
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `contenttypes` WRITE;
/*!40000 ALTER TABLE `contenttypes` DISABLE KEYS */;

INSERT INTO `contenttypes` (`id`, `contenttype`, `icon`, `display_order`, `created_at`, `updated_at`)
VALUES
	(1,'Blog','fas fa-comment',1,'2018-10-29 03:05:47','2018-11-23 03:16:39'),
	(2,'Information','fas fa-info',2,'2018-10-29 03:07:34','2018-11-23 03:16:39'),
	(3,'Miscellaneous','fas fa-square',4,'2018-10-29 03:44:25','2018-11-23 03:16:39');

/*!40000 ALTER TABLE `contenttypes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table countries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;

INSERT INTO `countries` (`name`)
VALUES
	('Afghanistan '),
	('Albania '),
	('Algeria '),
	('American Samoa '),
	('Andorra '),
	('Angola '),
	('Anguilla '),
	('Antigua & Barbuda '),
	('Argentina '),
	('Armenia '),
	('Aruba '),
	('Australia '),
	('Austria '),
	('Azerbaijan '),
	('Bahamas'),
	('Bahrain '),
	('Bangladesh '),
	('Barbados '),
	('Belarus '),
	('Belgium '),
	('Belize '),
	('Benin '),
	('Bermuda '),
	('Bhutan '),
	('Bolivia '),
	('Bosnia & Herzegovina '),
	('Botswana '),
	('Brazil '),
	('British Virgin Is. '),
	('Brunei '),
	('Bulgaria '),
	('Burkina Faso '),
	('Burma '),
	('Burundi '),
	('Cambodia '),
	('Cameroon '),
	('Canada '),
	('Cape Verde '),
	('Cayman Islands '),
	('Central African Rep. '),
	('Chad '),
	('Chile '),
	('China '),
	('Colombia '),
	('Comoros '),
	('Congo'),
	('Congo'),
	('Cook Islands '),
	('Costa Rica '),
	('Cote d\'Ivoire '),
	('Croatia '),
	('Cuba '),
	('Cyprus '),
	('Czech Republic '),
	('Denmark '),
	('Djibouti '),
	('Dominica '),
	('Dominican Republic '),
	('East Timor '),
	('Ecuador '),
	('Egypt '),
	('El Salvador '),
	('Equatorial Guinea '),
	('Eritrea '),
	('Estonia '),
	('Ethiopia '),
	('Faroe Islands '),
	('Fiji '),
	('Finland '),
	('France '),
	('French Guiana '),
	('French Polynesia '),
	('Gabon '),
	('Gambia'),
	('Gaza Strip '),
	('Georgia '),
	('Germany '),
	('Ghana '),
	('Gibraltar '),
	('Greece '),
	('Greenland '),
	('Grenada '),
	('Guadeloupe '),
	('Guam '),
	('Guatemala '),
	('Guernsey '),
	('Guinea '),
	('Guinea-Bissau '),
	('Guyana '),
	('Haiti '),
	('Honduras '),
	('Hong Kong '),
	('Hungary '),
	('Iceland '),
	('India '),
	('Indonesia '),
	('Iran '),
	('Iraq '),
	('Ireland '),
	('Isle of Man '),
	('Israel '),
	('Italy '),
	('Jamaica '),
	('Japan '),
	('Jersey '),
	('Jordan '),
	('Kazakhstan '),
	('Kenya '),
	('Kiribati '),
	('Korea'),
	('Korea'),
	('Kuwait '),
	('Kyrgyzstan '),
	('Laos '),
	('Latvia '),
	('Lebanon '),
	('Lesotho '),
	('Liberia '),
	('Libya '),
	('Liechtenstein '),
	('Lithuania '),
	('Luxembourg '),
	('Macau '),
	('Macedonia '),
	('Madagascar '),
	('Malawi '),
	('Malaysia '),
	('Maldives '),
	('Mali '),
	('Malta '),
	('Marshall Islands '),
	('Martinique '),
	('Mauritania '),
	('Mauritius '),
	('Mayotte '),
	('Mexico '),
	('Micronesia'),
	('Moldova '),
	('Monaco '),
	('Mongolia '),
	('Montserrat '),
	('Morocco '),
	('Mozambique '),
	('Namibia '),
	('Nauru '),
	('Nepal '),
	('Netherlands '),
	('Netherlands Antilles '),
	('New Caledonia '),
	('New Zealand '),
	('Nicaragua '),
	('Niger '),
	('Nigeria '),
	('N. Mariana Islands '),
	('Norway '),
	('Oman '),
	('Pakistan '),
	('Palau '),
	('Panama '),
	('Papua New Guinea '),
	('Paraguay '),
	('Peru '),
	('Philippines '),
	('Poland '),
	('Portugal '),
	('Puerto Rico '),
	('Qatar '),
	('Reunion '),
	('Romania '),
	('Russia '),
	('Rwanda '),
	('Saint Helena '),
	('Saint Kitts & Nevis '),
	('Saint Lucia '),
	('St Pierre & Miquelon '),
	('Saint Vincent and the Grenadines '),
	('Samoa '),
	('San Marino '),
	('Sao Tome & Principe '),
	('Saudi Arabia '),
	('Senegal '),
	('Serbia '),
	('Seychelles '),
	('Sierra Leone '),
	('Singapore '),
	('Slovakia '),
	('Slovenia '),
	('Solomon Islands '),
	('Somalia '),
	('South Africa '),
	('Spain '),
	('Sri Lanka '),
	('Sudan '),
	('Suriname '),
	('Swaziland '),
	('Sweden '),
	('Switzerland '),
	('Syria '),
	('Taiwan '),
	('Tajikistan '),
	('Tanzania '),
	('Thailand '),
	('Togo '),
	('Tonga '),
	('Trinidad & Tobago '),
	('Tunisia '),
	('Turkey '),
	('Turkmenistan '),
	('Turks & Caicos Is '),
	('Tuvalu '),
	('Uganda '),
	('Ukraine '),
	('United Arab Emirates '),
	('United Kingdom '),
	('United States '),
	('Uruguay '),
	('Uzbekistan '),
	('Vanuatu '),
	('Venezuela '),
	('Vietnam '),
	('Virgin Islands '),
	('Wallis and Futuna '),
	('West Bank '),
	('Western Sahara '),
	('Yemen '),
	('Zambia '),
	('Zimbabwe ');

/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table exchangerates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exchangerates`;

CREATE TABLE `exchangerates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `EUR` double(12,5) DEFAULT NULL,
  `NPR` double(12,5) NOT NULL,
  `INR` double(12,5) DEFAULT NULL,
  `USD` double(12,5) DEFAULT NULL,
  `CAD` double(12,5) DEFAULT NULL,
  `AUD` double(12,5) DEFAULT NULL,
  `JPY` double(12,5) DEFAULT NULL,
  `CNY` double(12,5) DEFAULT NULL,
  `HKD` double(12,5) DEFAULT NULL,
  `KRW` double(12,5) DEFAULT NULL,
  `SGD` double(12,5) DEFAULT NULL,
  `CHF` double(12,5) DEFAULT NULL,
  `SEK` double(12,5) DEFAULT NULL,
  `DKK` double(12,5) DEFAULT NULL,
  `GBP` double(12,5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `exchangerates` WRITE;
/*!40000 ALTER TABLE `exchangerates` DISABLE KEYS */;

INSERT INTO `exchangerates` (`id`, `date`, `EUR`, `NPR`, `INR`, `USD`, `CAD`, `AUD`, `JPY`, `CNY`, `HKD`, `KRW`, `SGD`, `CHF`, `SEK`, `DKK`, `GBP`, `created_at`, `updated_at`)
VALUES
	(1,'2019-02-05',1.00000,131.20300,81.86358,1.14191,1.49656,1.57653,125.62791,7.70195,8.95812,1277.92365,1.54455,1.14302,10.41171,7.46508,0.87723,'2019-02-05 16:18:38','2019-02-05 10:45:05');

/*!40000 ALTER TABLE `exchangerates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table infos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `infos`;

CREATE TABLE `infos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '',
  `subtitle` varchar(200) NOT NULL DEFAULT '',
  `link` varchar(200) DEFAULT '',
  `icon` varchar(50) NOT NULL DEFAULT '',
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `infos` WRITE;
/*!40000 ALTER TABLE `infos` DISABLE KEYS */;

INSERT INTO `infos` (`id`, `title`, `subtitle`, `link`, `icon`, `display_order`, `created_at`, `updated_at`)
VALUES
	(1,'FREE SHIPPING & RETURN','Free shipping on all orders over Rs 100',NULL,'fas fa-truck',1,'2018-10-28 17:01:31','2018-11-23 03:15:57'),
	(2,'MONEY BACK GUARANTEE','100% Money Back Guarantee','http://localhost:8080','fas fa-money-bill-wave',2,'2018-10-28 18:06:46','2018-11-23 03:15:57'),
	(3,'ONLINE SUPPORT 24/7','Track Your Delivery Online','http://localhost:8080','fas fa-handshake',3,'2018-10-28 18:07:41','2018-10-28 18:07:41');

/*!40000 ALTER TABLE `infos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table outlets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `outlets`;

CREATE TABLE `outlets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `outlet` varchar(100) NOT NULL DEFAULT '',
  `description` mediumtext,
  `contact_person` varchar(100) NOT NULL DEFAULT '',
  `address` text,
  `phone` text,
  `email` text,
  `viber` varchar(30) DEFAULT '',
  `whatsapp` varchar(30) DEFAULT '',
  `skype` varchar(30) DEFAULT '',
  `lat` decimal(15,12) DEFAULT NULL,
  `lng` decimal(15,12) DEFAULT NULL,
  `slug` varchar(100) NOT NULL DEFAULT '',
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;

INSERT INTO `password_resets` (`email`, `token`, `created_at`)
VALUES
	('sg@gmail.com','$2y$10$pZxs8D9oiAa64Ba9uA0INuCDwf3I1KNVnSEIWN.aN6Bg6M/IBGRa2','2018-10-27 05:31:43');

/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table paymentmethods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `paymentmethods`;

CREATE TABLE `paymentmethods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(50) NOT NULL DEFAULT '',
  `slug` varchar(50) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `paymentmethods` WRITE;
/*!40000 ALTER TABLE `paymentmethods` DISABLE KEYS */;

INSERT INTO `paymentmethods` (`id`, `payment_method`, `slug`, `display_order`, `created_at`, `updated_at`)
VALUES
	(2,'Cash On Delivery','cash-on-delivery',2,NULL,'2018-11-03 12:09:12'),
	(3,'Bank Deposits','bank-deposits',4,NULL,'2018-11-22 13:55:47'),
	(5,'ESewa','esewa',1,'2018-10-17 17:41:30','2018-11-03 12:09:20'),
	(6,'iPay','ipay',5,'2018-11-03 12:09:27','2018-11-22 13:55:47'),
	(7,'Khalti','khalti',6,'2018-11-03 12:09:33','2018-11-22 13:55:47'),
	(8,'Goji','goji',7,'2018-11-03 12:11:23','2018-11-22 13:55:47'),
	(9,'nPay','npay',8,'2018-11-03 12:18:28','2018-11-22 13:55:47'),
	(10,'Himalayan Bank Cards','himalayan-bank-cards',10,'2018-11-03 12:18:41','2018-11-23 04:06:43'),
	(11,'SCT MoCo','sct-moco',9,'2018-11-03 12:19:11','2018-11-23 04:06:43'),
	(12,'Cash on Pickup','cash-on-pickup',3,'2018-11-22 13:54:59','2018-11-22 13:55:47');

/*!40000 ALTER TABLE `paymentmethods` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pic_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pic_product`;

CREATE TABLE `pic_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `pic_id` int(11) unsigned NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  `caption` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pic_prod` (`product_id`,`pic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pic_product` WRITE;
/*!40000 ALTER TABLE `pic_product` DISABLE KEYS */;

INSERT INTO `pic_product` (`id`, `product_id`, `pic_id`, `display_order`, `caption`)
VALUES
	(40,12,36,2,'Car Back Seat Organizer'),
	(41,12,37,1,'Fashion Car Seat'),
	(42,13,38,1,'5 Tier Shoe Rack'),
	(43,14,39,1,'6 Tier Covered Shoes Rack DIY Storage Shelf'),
	(44,15,40,1,'Coffee Mixture'),
	(45,16,41,1,'Shoe Organizer'),
	(47,17,42,1,'Shoe Organizer'),
	(48,18,43,1,'Refrigerator Box'),
	(49,19,44,1,'Dolphin Massager'),
	(50,20,45,1,'Wireless Massager'),
	(52,22,47,1,'Electric Egg Boiler'),
	(54,21,48,1,'Double Egg Boiler'),
	(55,23,49,2,'Nail Polish'),
	(56,23,50,1,'Nail Polish 2');

/*!40000 ALTER TABLE `pic_product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pics
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pics`;

CREATE TABLE `pics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pic_path` varchar(50) NOT NULL DEFAULT '',
  `lg` tinyint(4) NOT NULL,
  `md` tinyint(4) NOT NULL,
  `sm` tinyint(4) NOT NULL,
  `xs` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pics` WRITE;
/*!40000 ALTER TABLE `pics` DISABLE KEYS */;

INSERT INTO `pics` (`id`, `user_id`, `pic_path`, `lg`, `md`, `sm`, `xs`, `created_at`, `updated_at`)
VALUES
	(36,1,'1546595865.jpg',0,1,1,1,'2019-01-04 09:57:45','2019-01-04 09:57:45'),
	(37,1,'1546595898.jpg',0,0,1,1,'2019-01-04 09:58:18','2019-01-04 09:58:18'),
	(38,1,'1546611123.jpg',0,0,1,1,'2019-01-04 14:12:03','2019-01-04 14:12:03'),
	(39,1,'1546756896.jpg',0,0,1,1,'2019-01-06 06:41:36','2019-01-06 06:41:36'),
	(40,1,'1546765650.jpg',0,0,1,1,'2019-01-06 09:07:30','2019-01-06 09:07:30'),
	(41,1,'1546765875.jpg',0,1,1,1,'2019-01-06 09:11:15','2019-01-06 09:11:15'),
	(42,1,'1546765896.jpg',0,0,1,1,'2019-01-06 09:11:36','2019-01-06 09:11:36'),
	(43,1,'1546766283.jpg',0,1,1,1,'2019-01-06 09:18:03','2019-01-06 09:18:03'),
	(44,1,'1546766403.jpg',0,0,1,1,'2019-01-06 09:20:03','2019-01-06 09:20:03'),
	(45,1,'1546766948.jpg',0,0,1,1,'2019-01-06 09:29:08','2019-01-06 09:29:08'),
	(46,1,'1546767073.jpg',0,0,1,1,'2019-01-06 09:31:13','2019-01-06 09:31:13'),
	(47,1,'1546767133.jpg',0,0,1,1,'2019-01-06 09:32:13','2019-01-06 09:32:13'),
	(48,1,'1546767160.jpg',0,0,1,1,'2019-01-06 09:32:40','2019-01-06 09:32:40'),
	(49,7,'1547372157.jpg',0,0,1,1,'2019-01-13 09:35:57','2019-01-13 09:35:57'),
	(50,7,'1547372185.jpg',0,0,1,1,'2019-01-13 09:36:25','2019-01-13 09:36:25');

/*!40000 ALTER TABLE `pics` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table productlists
# ------------------------------------------------------------

DROP TABLE IF EXISTS `productlists`;

CREATE TABLE `productlists` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `listname` varchar(30) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `productlists` WRITE;
/*!40000 ALTER TABLE `productlists` DISABLE KEYS */;

INSERT INTO `productlists` (`id`, `product_id`, `listname`, `display_order`, `created_at`, `updated_at`)
VALUES
	(57,12,'new',8,'2019-01-04 09:58:37','2019-01-06 09:35:00'),
	(58,12,'featured',8,'2019-01-04 09:58:41','2019-01-13 09:46:35'),
	(59,13,'featured',10,'2019-01-04 14:12:46','2019-01-13 09:46:35'),
	(60,13,'new',7,'2019-01-04 14:12:51','2019-01-06 09:35:00'),
	(61,14,'new',6,'2019-01-06 06:42:11','2019-01-06 09:35:00'),
	(62,14,'featured',9,'2019-01-06 06:42:15','2019-01-13 09:46:35'),
	(63,15,'new',5,'2019-01-06 09:08:31','2019-01-06 09:35:00'),
	(64,16,'featured',7,'2019-01-06 09:12:11','2019-01-13 09:46:35'),
	(65,17,'new',4,'2019-01-06 09:15:36','2019-01-06 09:35:00'),
	(66,19,'featured',6,'2019-01-06 09:20:42','2019-01-13 09:46:35'),
	(67,18,'featured',5,'2019-01-06 09:20:43','2019-01-13 09:46:34'),
	(68,20,'new',3,'2019-01-06 09:29:32','2019-01-06 09:34:59'),
	(69,19,'new',2,'2019-01-06 09:29:34','2019-01-06 09:34:59'),
	(70,22,'new',1,'2019-01-06 09:34:59','2019-01-06 09:34:59'),
	(71,21,'featured',4,'2019-01-06 09:35:05','2019-01-13 09:46:34'),
	(72,20,'featured',3,'2019-01-06 09:35:07','2019-01-13 09:46:34'),
	(73,15,'featured',2,'2019-01-06 09:39:02','2019-01-13 09:46:34');

/*!40000 ALTER TABLE `productlists` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table productprices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `productprices`;

CREATE TABLE `productprices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `size_id` varchar(50) NOT NULL DEFAULT '',
  `regular` double(15,2) NOT NULL,
  `discounted` double(15,2) NOT NULL DEFAULT '0.00',
  `discount_valid_until` date DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `productprices` WRITE;
/*!40000 ALTER TABLE `productprices` DISABLE KEYS */;

INSERT INTO `productprices` (`id`, `product_id`, `size_id`, `regular`, `discounted`, `discount_valid_until`, `display_order`, `created_at`, `updated_at`)
VALUES
	(53,12,'1',1380.00,1150.00,NULL,NULL,'2019-01-04 09:57:22','2019-01-04 09:57:22'),
	(54,13,'1',1350.00,1300.00,NULL,NULL,'2019-01-04 14:12:32','2019-01-04 14:12:32'),
	(55,14,'1',3500.00,2450.00,NULL,NULL,'2019-01-06 06:43:08','2019-01-06 06:43:08'),
	(56,15,'1',300.00,250.00,NULL,NULL,'2019-01-06 09:08:11','2019-01-06 09:08:11'),
	(57,16,'1',1100.00,799.00,NULL,NULL,'2019-01-06 09:10:44','2019-01-06 09:10:44'),
	(58,17,'1',1150.00,950.00,NULL,NULL,'2019-01-06 09:15:11','2019-01-06 09:15:11'),
	(59,18,'1',425.00,350.00,NULL,NULL,'2019-01-06 09:17:50','2019-01-06 09:17:50'),
	(60,19,'1',1500.00,1099.00,NULL,NULL,'2019-01-06 09:21:30','2019-01-06 09:21:30'),
	(61,20,'1',5400.00,4500.00,NULL,NULL,'2019-01-06 09:29:24','2019-01-06 09:29:24'),
	(62,21,'1',2200.00,1800.00,NULL,NULL,'2019-01-06 09:31:33','2019-01-06 09:31:33'),
	(63,22,'1',1100.00,940.00,NULL,NULL,'2019-01-06 09:35:41','2019-01-06 09:35:41'),
	(64,23,'1',500.00,400.00,NULL,NULL,'2019-01-13 09:40:57','2019-01-13 09:40:57'),
	(66,23,'3',500.00,400.00,NULL,NULL,'2019-01-13 09:42:15','2019-01-13 09:42:15');

/*!40000 ALTER TABLE `productprices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `model` varchar(50) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `description` text,
  `specification` mediumtext,
  `user_id` int(10) unsigned NOT NULL,
  `last_modified_user_id` int(11) DEFAULT NULL,
  `category_order` int(11) DEFAULT NULL,
  `viewed_rank` int(11) DEFAULT NULL,
  `approved` tinyint(4) DEFAULT NULL,
  `delivery_available` tinyint(4) DEFAULT NULL,
  `delivery_day_from` int(11) DEFAULT NULL,
  `delivery_day_to` int(11) DEFAULT NULL,
  `delivery_charge_local` int(11) DEFAULT NULL,
  `delivery_charge_intercity` int(11) DEFAULT NULL,
  `delivery_charge_intl` int(11) DEFAULT NULL,
  `manufactured_at` int(11) unsigned NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paymentmanagedby` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `name`, `model`, `slug`, `description`, `specification`, `user_id`, `last_modified_user_id`, `category_order`, `viewed_rank`, `approved`, `delivery_available`, `delivery_day_from`, `delivery_day_to`, `delivery_charge_local`, `delivery_charge_intercity`, `delivery_charge_intl`, `manufactured_at`, `currency`, `created_at`, `updated_at`, `paymentmanagedby`)
VALUES
	(12,37,1,'Car Back Seat Organizer','1','12-car-back-seat-organizer','<p>Multifunctional Seat Bag Automobile Storage Box Hanging Bag Leather Chair Storage Bag Car Accessories Car-styling<br></p>','Multifunctional Seat Bag Automobile Storage Box Hanging Bag Leather Chair Storage Bag Car Accessories Car-styling',1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-04 09:57:01','2019-01-04 09:57:01','KhatryOnline.com'),
	(13,33,1,'5 Tier shoe Rack','1','13-5-tier-shoe-rack','<p>5 Tier X Shaped Shoe Rack Organizer is portable and easy to assemble, it can store up to 15 Pairs of shoes.<br></p>','It Helps Maintain Shoe Shape. This Product Is Loved and used by Millions Of People As Soon As It Appeared On Television.',1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-04 14:11:47','2019-01-04 14:11:47','KhatryOnline.com'),
	(14,34,1,'6 Tier Covered Shoes Rack DIY Storage Shelf','1','14-6-tier-covered-shoes-rack-diy-storage-shelf','<div>6 Tier Covered Shoes Rack DIY Storage Shelf is portable and easy to assemble, it can store up to 15 Pairs of shoes.</div><div>It Helps Maintain Shoe Shape. This Product Is Loved and used by Millions Of People As Soon As It Appeared On Television.</div>','<div><br></div>',1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-06 06:41:15','2019-01-06 06:41:15','KhatryOnline.com'),
	(15,33,1,'Coffee Mixer','1','15-coffee-mixer','<p>Best Quality,&nbsp;<span style=\"font-size: 1.4rem;\">Easy to use,&nbsp;</span><span style=\"font-size: 1.4rem;\">Best Result</span></p>',NULL,1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-06 09:07:19','2019-01-06 09:07:19','KhatryOnline.com'),
	(16,33,1,'Shoe Organizer','1','16-shoe-organizer','<p><span style=\"font-size: 1.4rem;\">100% Cotton,&nbsp;</span><span style=\"font-size: 1.4rem;\">Imported,&nbsp;</span><span style=\"font-size: 1.4rem;\">Ventil Air breathable</span></p>',NULL,1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-06 09:10:20','2019-01-06 09:10:20','KhatryOnline.com'),
	(17,34,1,'Shoe Organizer','2','17-shoe-organizer','<p>100% SATISFACTION GUARANTEED,&nbsp;<span style=\"font-size: 1.4rem;\">1 Set ñ 6 Piece,&nbsp;</span><span style=\"font-size: 1.4rem;\">Space Saver</span></p>',NULL,1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-06 09:14:49','2019-01-06 09:14:49','KhatryOnline.com'),
	(18,30,1,'Refrigerator Box',NULL,'18-refrigerator-box','<p><span style=\"font-size: 1.4rem;\">Made of ABS, non-toxic and wear resistant.&nbsp;</span><span style=\"font-size: 1.4rem;\">his is a convenient storage organizer for your refrigerator or in the kitchen.&nbsp;</span><span style=\"font-size: 1.4rem;\">Cab to be used in refrigerator, kitchen pantry or for storing fruits, eggs, snacks etc.</span></p>','<p>Size: 20.3cm * 14.7cm * 6.7cm</p><p>Heart-shaped hollow out design for ventilation and drainage of water.</p><div><br></div>',1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-06 09:17:25','2019-01-06 09:17:25','KhatryOnline.com'),
	(19,35,1,'Dolphin Massager',NULL,'19-dolphin-massager','<p><span style=\"font-size: 1.4rem;\">Burn fat and partly lose weight (messager)</span><br></p><p><br></p>',NULL,1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-06 09:19:49','2019-01-06 09:19:49','KhatryOnline.com'),
	(20,30,1,'Wireless Massager',NULL,'20-wireless-massager',NULL,NULL,1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-06 09:28:47','2019-01-06 09:28:47','KhatryOnline.com'),
	(21,30,1,'Double Egg Boiler',NULL,'21-double-egg-boiler','<div><span style=\"font-size: 1.4rem;\">14 egg slots,&nbsp;</span><span style=\"font-size: 1.4rem;\">easy and convenient</span></div>','<div><br></div>',1,1,NULL,NULL,NULL,1,NULL,5,200,500,2000,0,'NPR','2019-01-06 09:31:01','2019-01-06 12:52:22','KhatryOnline.com'),
	(22,30,1,'Electric Egg Boiler',NULL,'22-electric-egg-boiler',NULL,NULL,1,1,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-06 09:32:03','2019-01-06 09:32:03','KhatryOnline.com'),
	(23,28,1,'Nail Polish Pink',NULL,'23-nail-polish-pink','Very Nice Product','More specifications',7,7,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-13 09:35:23','2019-01-13 09:35:23','KhatryOnline.com'),
	(24,38,1,'abc',NULL,'24-abc',NULL,NULL,8,8,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-13 10:21:09','2019-01-13 10:21:09','Self'),
	(25,30,1,'coke',NULL,'25-coke',NULL,NULL,8,8,NULL,NULL,NULL,1,2,5,200,500,2000,0,'NPR','2019-01-13 10:32:09','2019-01-13 10:32:09','Self');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table promos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `promos`;

CREATE TABLE `promos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `promos` WRITE;
/*!40000 ALTER TABLE `promos` DISABLE KEYS */;

INSERT INTO `promos` (`id`, `title`, `link`, `display_order`, `created_at`, `updated_at`)
VALUES
	(21,'This site is under construction.','http://khatrygroups.com',2,'2018-10-28 10:12:29','2019-01-13 09:53:50'),
	(24,'We will be ready within a few days','http://khatrygroups.com',3,'2018-10-28 14:41:12','2019-01-13 09:53:50');

/*!40000 ALTER TABLE `promos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) DEFAULT '',
  `phone1` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `order_email` varchar(50) DEFAULT NULL,
  `description` text,
  `facebook` varchar(200) DEFAULT NULL,
  `googleplus` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `youtube` varchar(200) DEFAULT NULL,
  `viber` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `skype` varchar(50) DEFAULT NULL,
  `delivery_charge_local` int(11) DEFAULT NULL,
  `delivery_charge_intercity` int(11) DEFAULT NULL,
  `delivery_charge_intl` int(11) DEFAULT NULL,
  `payment_methods` varchar(100) DEFAULT NULL,
  `bank_info` varchar(300) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `site_name`, `phone1`, `phone2`, `address`, `email`, `order_email`, `description`, `facebook`, `googleplus`, `twitter`, `youtube`, `viber`, `whatsapp`, `skype`, `delivery_charge_local`, `delivery_charge_intercity`, `delivery_charge_intl`, `payment_methods`, `bank_info`, `created_at`, `updated_at`)
VALUES
	(1,'Khatry Online','977 1 4416695','977 1 9823432345','Dhumbarahi','contact@khatryonline.com','order@khatryonline.com','Your Local market. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nulla natus nisi adipisci vel voluptate, sint ducimus minus! Officia dolorum id eligendi, vero, aliquid delectus unde architecto dolores voluptas maiores aliquam?xxx','https://www.facebook.com/khatryonline','khatryonline','khatryonline','khatryonline','977 1 9823432345','977 1 9823432345','977 1 9823432345',200,500,2000,'5,2,12,3,6,7,8,9,11,10',NULL,NULL,'2019-01-04 09:29:48');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sizes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sizes`;

CREATE TABLE `sizes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `size` varchar(10) NOT NULL DEFAULT '',
  `slug` varchar(10) NOT NULL DEFAULT '',
  `display_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_At` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;

INSERT INTO `sizes` (`id`, `size`, `slug`, `display_order`, `created_at`, `updated_At`)
VALUES
	(1,'Regular','regular',1,'2018-11-22 15:42:21','2018-11-22 15:42:21'),
	(2,'Small','small',2,'2018-11-22 15:42:56','2018-11-22 15:42:56'),
	(3,'Medium','medium',3,'2018-11-22 15:43:03','2018-11-22 15:43:03'),
	(4,'Large','large',4,'2018-11-22 15:43:55','2018-11-22 15:43:55'),
	(5,'XLarge','xlarge',5,'2018-11-22 15:44:27','2018-11-22 15:44:27'),
	(6,'XXLarge','xxlarge',6,'2018-11-22 15:44:37','2018-11-22 15:44:37'),
	(7,'XXXLarge','xxxlarge',7,'2018-11-22 15:44:43','2018-11-22 15:44:43'),
	(8,'200 GM','200-gm',9,'2018-11-22 15:45:01','2019-01-13 10:10:34'),
	(9,'500 GM','500-gm',10,'2018-11-22 15:45:08','2019-01-13 10:10:34'),
	(10,'2 KG','2-kg',12,'2018-11-22 15:45:14','2019-01-13 10:10:34'),
	(11,'1 KG','1-kg',11,'2018-11-22 15:45:20','2019-01-13 10:10:34'),
	(12,'5 Kg','5-kg',13,'2018-11-22 15:45:57','2019-01-13 10:10:34'),
	(13,'10 KG','10-kg',14,'2018-11-22 15:46:04','2019-01-13 10:10:34'),
	(14,'20 KG','20-kg',15,'2018-11-22 15:46:11','2019-01-13 10:10:34'),
	(15,'30 KG','30-kg',16,'2018-11-22 15:47:07','2019-01-13 10:10:34'),
	(16,'40 KG','40-kg',17,'2018-11-22 15:47:12','2019-01-13 10:10:34'),
	(17,'50 KG','50-kg',18,'2018-11-22 15:47:39','2019-01-13 10:10:34'),
	(18,'100 GM','100-gm',8,'2019-01-13 10:10:26','2019-01-13 10:10:34');

/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table userdetails
# ------------------------------------------------------------

DROP TABLE IF EXISTS `userdetails`;

CREATE TABLE `userdetails` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(4) NOT NULL,
  `is_super` tinyint(4) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paymentlink` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `userdetails` WRITE;
/*!40000 ALTER TABLE `userdetails` DISABLE KEYS */;

INSERT INTO `userdetails` (`id`, `is_admin`, `is_super`, `company_name`, `address`, `phone`, `state`, `postal_code`, `city`, `country`, `mobile`, `website`, `created_at`, `updated_at`, `paymentlink`)
VALUES
	(1,1,0,NULL,'Balaju','98324237987','Three','54487','kathmandu','Nepal','9832749§','webtree.com.np',NULL,'2018-11-22 16:13:02',''),
	(6,1,0,NULL,'Dhumbarahi','977 1 4416695','3','44600','Kathmandu','Nepal','9808293528','http://www.khatryonline.com','2019-01-13 07:24:03','2019-01-13 09:00:30',NULL),
	(7,0,0,NULL,'Manamaiju','9840528889','3','44600','Kahtmandu','Nepal','9849541971','www.webtree.com','2019-01-13 09:13:17','2019-01-13 09:23:48','www.esewa.com/sulav'),
	(8,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-01-13 10:16:02','2019-01-13 10:16:02',NULL),
	(9,0,0,NULL,'13 Essex street RG20EH reading',NULL,'Berkshire','RG20EH','Reading','England','+447476333252','www.khatry.co.uk','2019-01-18 12:59:32','2019-01-18 13:01:35',NULL);

/*!40000 ALTER TABLE `userdetails` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Sudeep Gurungs','sg@gmail.com',NULL,'$2y$10$81bY687sdF.qtxijw2lO8.RsiRvgXCkvdK.Nia4QMWnkB5YqDUYP6','GMkIz3X77wcVuw9yuOOusMEzXB5ZoaWq2SLyc6R8RkoL2TNWxk0LjdlJSB6t','2018-10-27 05:25:03','2019-01-02 16:30:58'),
	(6,'Khatry Online','khatryonline@gmail.com','2019-01-13 07:24:58','$2y$10$4i/khLksrsEci805RTkSReQAOSz59jknUzIAxvo/qi/sn1dPrPgXm','H5O2SkgvVHmS1h0AZR7BEUBR2nwqve8BmSBqMhdQkgxMPq8qeHWdJlENmRwT','2019-01-13 07:23:53','2019-01-13 07:24:58'),
	(7,'Sulav Gurung','sudeepgurung.sg@gmail.com','2019-01-13 09:25:04','$2y$10$xwXOW7YpAn7h.1NtnBifyuiLGLOKk1JRzlonouCSRgp1dnfw/U98K','XmffO7zV6DERGrpI7MTGLxUDvSCmcme9vuNOTUyBAqPZeAJlaYDlBAE0XDeI','2019-01-13 09:13:08','2019-01-13 09:25:04'),
	(8,'gagan','gagankhatry0@gmail.com','2019-01-13 10:17:24','$2y$10$adlbWTzMMtb9jnGwFuysGuOMrDw48nT55FDcg35297d2wtazlgbiK','Y7ipKegC8kBLIJ5hLx4DEuMkrBsOoV6l7y1VEsW3AL5TFvV5aL0zwoHs86tI','2019-01-13 10:15:54','2019-01-13 10:17:24'),
	(9,'Gambhir Raj KC','grkhatry@gmail.com','2019-01-18 13:03:50','$2y$10$43mDvCN/.IkAghvaHKj4neMRaTj7AHGZPU7MxvW0sKgIezeTf3x.m',NULL,'2019-01-18 12:58:55','2019-01-18 13:03:50');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wishlist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wishlist`;

CREATE TABLE `wishlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
