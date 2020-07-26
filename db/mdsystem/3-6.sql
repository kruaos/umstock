
DROP TABLE IF EXISTS `book_register`;
CREATE TABLE `book_register` (
  `book_re_id` int(10) NOT NULL auto_increment,
  `book_re_name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `book_no_start` varchar(16) collate utf8_unicode_ci default NULL,
  `book_re_type` varchar(200) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`book_re_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_register`
--

/*!40000 ALTER TABLE `book_register` DISABLE KEYS */;
INSERT INTO `book_register` (`book_re_id`,`book_re_name`,`book_no_start`,`book_re_type`) VALUES 
 (1,'งานธุรการ(ทั่วไป)','000001','หนังสือรับ'),
 (2,'งานธุรการสภา','100001','G01');
/*!40000 ALTER TABLE `book_register` ENABLE KEYS */;


--
-- Definition of table `book_secret`
--

DROP TABLE IF EXISTS `book_secret`;
CREATE TABLE `book_secret` (
  `Book_secret_id` int(11) NOT NULL auto_increment,
  `Book_secret_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`Book_secret_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_secret`
--

/*!40000 ALTER TABLE `book_secret` DISABLE KEYS */;
INSERT INTO `book_secret` (`Book_secret_id`,`Book_secret_name`) VALUES 
 (1,'ทั่วไป'),
 (2,'ปกปิด'),
 (3,'ลับ'),
 (4,'ลับมาก'),
 (5,'ลับที่สุด');
/*!40000 ALTER TABLE `book_secret` ENABLE KEYS */;


--
-- Definition of table `book_status`
--

DROP TABLE IF EXISTS `book_status`;
CREATE TABLE `book_status` (
  `Book_status_id` int(11) NOT NULL auto_increment,
  `Book_status_name` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`Book_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_status`
--

/*!40000 ALTER TABLE `book_status` DISABLE KEYS */;
INSERT INTO `book_status` (`Book_status_id`,`Book_status_name`) VALUES 
 (1,'ทั่วไป'),
 (2,'ด่วน'),
 (3,'ด่วนมาก'),
 (4,'ด่วนที่สุด');
/*!40000 ALTER TABLE `book_status` ENABLE KEYS */;


--
-- Definition of table `book_type`
--

DROP TABLE IF EXISTS `book_type`;
CREATE TABLE `book_type` (
  `Book_type_id` int(11) NOT NULL auto_increment,
  `Book_type_name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `Book_type_for` int(1) default NULL,
  `Book_group` int(1) default NULL,
  PRIMARY KEY  (`Book_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_type`
--

/*!40000 ALTER TABLE `book_type` DISABLE KEYS */;
INSERT INTO `book_type` (`Book_type_id`,`Book_type_name`,`Book_type_for`,`Book_group`) VALUES 
 (2,'หนังสือทั่วไป',3,1),
 (3,'หนังสือกฏหมาย',1,1),
 (4,'หนังสือประชุม',1,1),
 (5,'หนังสือเวียน',2,1),
 (6,'หนังสือรับรอง',2,1),
 (7,'หนังสือเข้ามาศึกษาดูงาน',1,1),
 (8,'หนังสืออบรม',1,1),
 (9,'ญัตติ',1,2),
 (10,'กระทู้ถาม',1,2),
 (12,'หนังสือทั่วไป',2,2),
 (13,'หนังสือเวียน',2,2),
 (14,'หนังสือร้องทุกข์ขอความช่วยเหลือ',1,1),
 (15,'หนังสือทั่วไป..',1,2),
 (16,'ขอข้อมูลข่าวสารเทศบาลฯ',1,1),
 (17,'หนังสือเลือกตั้งฯ',1,1);
/*!40000 ALTER TABLE `book_type` ENABLE KEYS */;

