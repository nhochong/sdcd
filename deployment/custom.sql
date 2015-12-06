DROP TABLE IF EXISTS `loai_su_diep`;
CREATE TABLE `loai_su_diep` (
  `loai_su_diep_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) DEFAULT NULL,
  `parent_id` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`loai_su_diep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `loai_su_diep` (`ten`, `parent_id`) VALUES
('Mục 1', 0),
('Mục 2', 0),
('Mục 3', 0),
('Mục 4', 0),
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
  `soundcloud_embed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `youtube_embed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
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
('Hội thờ quỷ', 4),
('Bí ẩn', 4);


DROP TABLE IF EXISTS `tin_tuc`;
CREATE TABLE `tin_tuc` (
  `tin_tuc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
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
  `file` varchar(255) DEFAULT NULL,
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `loai_dgh_id` int(11) NOT NULL,
  PRIMARY KEY (`dgh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `loai_bai_viet`;
CREATE TABLE `loai_bai_viet` (
  `loai_bai_viet_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`loai_bai_viet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `loai_bai_viet` (`ten`) VALUES
('Bài của Giám Mục'),
('Bài của Linh Mục'),
('Bài của Tu Sĩ'),
('Bài của giáo dân'),
('Cha Linh Hướng'),
('Đức Cha Bùi Tuấn'),
('Linh Mục Đồng Trung'),
('Tu Sĩ Hèn mọn');

DROP TABLE IF EXISTS `bai_viet`;
CREATE TABLE `bai_viet` (
  `bai_viet_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `loai_bai_viet_id` int(11) NOT NULL,
  PRIMARY KEY (`bai_viet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `loai_thong_tin`;
CREATE TABLE `loai_thong_tin` (
  `loai_thong_tin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) DEFAULT NULL,
  `parent_id` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`loai_thong_tin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `loai_thong_tin` (`ten`, `parent_id`) VALUES
('Sống Đạo', 0),
('Công Giáo', 0),
('Đời Sống', 0),
('Video', 0),
('Sống đạo tốt', 1),
('Kinh nguyện', 1),
('Cầu nguyện', 1),
('Tử đạo', 1),
('Thiên Đàng', 2),
('Hỏa ngục', 2),
('Luyện ngục', 2),
('Phép lạ', 2),
('Phá thai', 3),
('Lẽ sống', 3),
('Tiên tri', 3),
('Các thánh', 3),
('Hình ảnh', 4),
('Liên Hệ', 4),
('Gương Sáng', 4),
('Download - Tải về', 4);


DROP TABLE IF EXISTS `thong_tin`;
CREATE TABLE `thong_tin` (
  `thong_tin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `loai_thong_tin_id` int(11) NOT NULL,
  PRIMARY KEY (`thong_tin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `chien_dich_cau_nguyen`;
CREATE TABLE `chien_dich_cau_nguyen` (
  `chien_dich_cau_nguyen_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`chien_dich_cau_nguyen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `download`;
CREATE TABLE `download` (
  `download_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `ten_file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `bai_giang`;
CREATE TABLE `bai_giang` (
  `bai_giang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  `soundcloud_embed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `youtube_embed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_nct` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_mp3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bai_giang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `loai_audio`;
CREATE TABLE `loai_audio` (
  `loai_audio_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`loai_audio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `loai_audio` (`ten`) VALUES
('Audio Sứ Điệp'),
('Audio Bài Giảng'),
('Audio Đọc Sách'),
('Audio Nên Thánh');

DROP TABLE IF EXISTS `audio`;
CREATE TABLE `audio` (
  `audio_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `soundcloud_embed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `loai_audio_id` int(11) NOT NULL,
  PRIMARY KEY (`audio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `loai_video`;
CREATE TABLE `loai_video` (
  `loai_video_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`loai_video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `loai_video` (`ten`) VALUES
('Video Sứ Điệp Mới'),
('Video Bài Giảng');

DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `video_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `loai_video_id` int(11) NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `youtube_channel`;
CREATE TABLE `youtube_channel` (
  `youtube_channel_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  PRIMARY KEY (`youtube_channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `video_lien_ket`;
CREATE TABLE `video_lien_ket` (
  `video_lien_ket_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  PRIMARY KEY (`video_lien_ket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT IGNORE INTO `youtube_channel` (`tieu_de`, `link`) VALUES
('Video Sứ Điệp Chúa Đến', 'https://www.youtube.com/channel/UCYb-_FPIYqkBwXBZMP1Ji0Q/videos'),
('Video Sứ Điệp Chúa Đến', 'https://www.youtube.com/channel/UCYb-_FPIYqkBwXBZMP1Ji0Q/videos'),
('Video Sứ Điệp Chúa Đến', 'https://www.youtube.com/channel/UCYb-_FPIYqkBwXBZMP1Ji0Q/videos'),
;

INSERT IGNORE INTO `searchtypes` (`type`, `title`, `enabled`, `order`) VALUES
('default_su_diep', 'Sứ điệp', 1, 1),
('default_tin_tuc', 'Tin tức', 1, 2),
('default_dgh', 'Đức Giáo Hoàng', 1, 3),
('default_bai_viet', 'Bài viết', 1, 4),
('default_thong_tin', 'Thông tin', 1, 5),
('default_chien_dich_cau_nguyen', 'Chiến dịch cầu nguyện', 1, 6),
('default_download', 'Download', 1, 7),
('default_bai_giang', 'Bài giảng', 1, 8),
('default_audio', 'Audio', 1, 9),
('default_video', 'Video', 1, 10);