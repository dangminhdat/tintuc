CREATE TABLE `taikhoan` (
  `id_tk` int(11) NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `ten_hien_thi` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` text CHARACTER SET utf8 NOT NULL,
  `quyen` int(11) NOT NULL,
  `trang_thai` int(11) NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `facebook` text CHARACTER SET utf8 NOT NULL,
  `google` text CHARACTER SET utf8 NOT NULL,
  `twitter` text CHARACTER SET utf8 NOT NULL,
  `phone` int(11) NOT NULL,
  `mieu_ta` longtext CHARACTER SET utf8 NOT NULL,
  `url_avatar` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id_tk`);
ALTER TABLE `taikhoan`
  MODIFY `id_tk` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `chuyenmuc`(
	`id_cate` int(11) NOT NULL,
    `ten_chuyen_muc` varchar(100) NOT NULL,
    `url` varchar(100) NOT NULL,
    `type` int(11) NOT NULL,
    `sort` int(11) NOT NULL,
    `id_parent` int(11) NOT NULL,
    `ngay_tao` datetime NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `chuyenmuc` ADD PRIMARY KEY(`id_cate`);
ALTER TABLE `chuyenmuc` MODIFY `id_cate` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `website`(
	`tieu_de` text COLLATE utf8_unicode_ci NOT NULL,
    `mieu_ta` text COLLATE utf8_unicode_ci NOT NULL,
    `tu_khoa` text COLLATE utf8_unicode_ci NOT NULL,
    `trang_thai` int(11) NOT NULL
)ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `website` VALUES('tintuc','','datdang','0');

CREATE TABLE `baiviet`(
	`id_post` int(11) NOT NULL,
    `tieu_de` text COLLATE utf8_unicode_ci NOT NULL,
    `mieu_ta` text COLLATE utf8_unicode_ci NOT NULL,
    `url` text COLLATE utf8_unicode_ci NOT NULL,
    `slug` text COLLATE utf8_unicode_ci NOT NULL,
    `tu_khoa` text COLLATE utf8_unicode_ci NOT NULL,
    `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
    `cate_1_id` int(11) NOT NULL,
    `cate_2_id` int(11) NOT NULL,
    `cate_3_id` int(11) NOT NULL,
    `tac_gia` text COLLATE utf8_unicode_ci NOT NULL,
    `trang_thai` int(11) NOT NULL,
    `luot_xem` int(11) NOT NULL,
    `ngay_tao` datetime NOT NULL
)ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `baiviet` ADD PRIMARY KEY(`id_post`);
ALTER TABLE `baiviet` MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `hinhanh`(
	`id_img` int(11) NOT NULL,
    `url` text COLLATE utf8_unicode_ci NOT NULL,
    `type` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
    `size` int(11) NOT NULL,
    `ngay_tao` datetime NOT NULL
) ENGINE=INNODB DEFAULT charset=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `hinhanh` ADD PRIMARY KEY(`id_img`);
ALTER TABLE `hinhanh` MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `hinhanh` ADD `tac_gia` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `size`;