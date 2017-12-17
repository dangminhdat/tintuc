CREATE TABLE `tintucoop`.`theloai` ( 
`id_loai` INT(11) NOT NULL AUTO_INCREMENT , 
`ten_loai` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`slug_loai` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`ngay_tao` TIMESTAMP NOT NULL , 
`ngay_update` TIMESTAMP NOT NULL , 
PRIMARY KEY (`id_loai`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = 'Thể loại';

CREATE TABLE `tintucoop`.`loaitin` (
`id_loaitin` INT(11) NOT NULL AUTO_INCREMENT , 
`id_loai` INT(11) NOT NULL , 
`ten_loaitin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`slug_loaitin` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`ngay_tao` TIMESTAMP NOT NULL , 
`ngay_update` TIMESTAMP NOT NULL , 
PRIMARY KEY (`id_loaitin`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = 'Loại tin';

CREATE TABLE `tintucoop`.`tintuc` ( 
`id_tin` INT(11) NOT NULL AUTO_INCREMENT , 
`tieu_de` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`slug_tintuc` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`tom_tat` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`noidung` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`hinh` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`noi_bat` INT(11) NOT NULL , 
`luot_xem` INT(11) NOT NULL , 
`id_loaitin` INT(11) NOT NULL , 
`ngay_tao` TIMESTAMP NOT NULL , 
`ngay_update` TIMESTAMP NOT NULL , 
PRIMARY KEY (`id_tin`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = 'Tin tức';

CREATE TABLE `tintucoop`.`comment` ( 
`id_cm` INT(11) NOT NULL AUTO_INCREMENT , 
`id_user` INT(11) NOT NULL , 
`id_tin` INT(11) NOT NULL , 
`noi_dung` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`ngay_tao` TIMESTAMP NOT NULL , 
`ngay_update` TIMESTAMP NOT NULL , 
PRIMARY KEY (`id_cm`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = 'Bình luận';

CREATE TABLE `tintucoop`.`slide` ( 
`id_slide` INT(11) NOT NULL AUTO_INCREMENT , 
`ten` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`hinh` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`link` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
`ngay_tao` TIMESTAMP NOT NULL , 
`ngay_update` TIMESTAMP NOT NULL , 
PRIMARY KEY (`id_slide`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = 'Slide';