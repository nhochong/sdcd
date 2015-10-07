DROP TABLE IF EXISTS `loai_su_diep`;
CREATE TABLE `loai_su_diep` (
  `loai_su_diep_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) DEFAULT NULL,
  `muc` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`loai_su_diep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `loai_su_diep` (`ten`, `muc`) VALUES
('Sứ Điệp Chúa Cha', 1),
('Sứ Điệp Chúa Giêsu', 1),
('Sứ Điệp Chúa Thánh Thần', 1),
('Sứ Điệp Đức Mẹ', 1),
('Ấn Tín', 2),
('Mẹ Cứu Rỗi', 2),
('Con Chíp 666', 2),
('Cuộc Cảnh Báo', 2),
('Phản Kitô', 3),
('Tiên Tri Giả', 3),
('Tân Phúc Âm Hóa', 3),
('Tôn Giáo Mới', 3),
('Chiến Dịch Cầu Nguyện', 4),
('Sứ Điệp Ứng Nghiệm', 4),
('Sách Khải Huyền', 4),
('Trời Mới Đất Mới', 4);


DROP TABLE IF EXISTS `su_diep`;
CREATE TABLE `su_diep` (
  `su_diep_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `loai_su_diep_id` int(11) NOT NULL,
  PRIMARY KEY (`su_diep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `loai_tin_tuc`;
CREATE TABLE `loai_tin_tuc` (
  `loai_tin_tuc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) DEFAULT NULL,
  `parent_id` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`loai_tin_tuc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `loai_tin_tuc` (`ten`, `parent_id`) VALUES
('Giáo hội', 0),
('Xã hội', 0),
('Tin chính', 0),
('Tổng hợp', 0),
('Đức giáo hoàng', 1),
('Vatican', 1),
('Giáo hội hoàn vũ', 1),
('Giáo hội việt nam', 1),
('Tin thế giới', 2),
('Tin việt nam', 2),
('Chiến tranh', 2),
('Thiên tai', 2),
('Tin tức 2015', 3),
('Tin tức 2014', 3),
('Tin công giáo', 3),
('Tin xã hội', 3),
('Kỳ lạ', 4),
('Hội tam điểm', 4),
('HỘi thờ quỷ', 4),
('Bí ẩn', 4);


DROP TABLE IF EXISTS `tin_tuc`;
CREATE TABLE `tin_tuc` (
  `tin_tuc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `loai_tin_tuc_id` int(11) NOT NULL,
  PRIMARY KEY (`tin_tuc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `loai_dgh`;
CREATE TABLE `loai_dgh` (
  `loai_dgh_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`loai_dgh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `loai_dgh` (`ten`) VALUES
('Đức Giáo Hoàng Phanxicô 1'),
('Đức Giáo Hoàng Phanxicô 2'),
('Đức Giáo Hoàng Benedicto 1'),
('Đức Giáo Hoàng Benedicto 2'),
('Các vị khác');


DROP TABLE IF EXISTS `dgh`;
CREATE TABLE `dgh` (
  `dgh_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `loai_dgh_id` int(11) NOT NULL,
  PRIMARY KEY (`dgh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;