/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : demo

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2014-07-11 21:38:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for amenities
-- ----------------------------
DROP TABLE IF EXISTS `amenities`;
CREATE TABLE `amenities` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for cities
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `county_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) DEFAULT NULL,
  `full_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `content` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso_alpha2` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso_alpha3` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso_numeric` int(11) DEFAULT NULL,
  `currency_code` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_name` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'Afghanistan', 'AF', 'AFG', '4', 'AFN', 'Afg', '؋', 'AF.png');
INSERT INTO `countries` VALUES ('2', 'Albania', 'AL', 'ALB', '8', 'ALL', 'Lek', 'Lek', 'AL.png');
INSERT INTO `countries` VALUES ('3', 'Algeria', 'DZ', 'DZA', '12', 'DZD', 'Din', null, 'DZ.png');
INSERT INTO `countries` VALUES ('4', 'American Samoa', 'AS', 'ASM', '16', 'USD', 'Dol', '$', 'AS.png');
INSERT INTO `countries` VALUES ('5', 'Andorra', 'AD', 'AND', '20', 'EUR', 'Eur', '€', 'AD.png');
INSERT INTO `countries` VALUES ('6', 'Angola', 'AO', 'AGO', '24', 'AOA', 'Kwa', 'Kz', 'AO.png');
INSERT INTO `countries` VALUES ('7', 'Anguilla', 'AI', 'AIA', '660', 'XCD', 'Dol', '$', 'AI.png');
INSERT INTO `countries` VALUES ('8', 'Antarctica', 'AQ', 'ATA', '10', '', '', null, 'AQ.png');
INSERT INTO `countries` VALUES ('9', 'Antigua and Barbuda', 'AG', 'ATG', '28', 'XCD', 'Dol', '$', 'AG.png');
INSERT INTO `countries` VALUES ('10', 'Argentina', 'AR', 'ARG', '32', 'ARS', 'Pes', '$', 'AR.png');
INSERT INTO `countries` VALUES ('11', 'Armenia', 'AM', 'ARM', '51', 'AMD', 'Dra', null, 'AM.png');
INSERT INTO `countries` VALUES ('12', 'Aruba', 'AW', 'ABW', '533', 'AWG', 'Gui', 'ƒ', 'AW.png');
INSERT INTO `countries` VALUES ('13', 'Australia', 'AU', 'AUS', '36', 'AUD', 'Dol', '$', 'AU.png');
INSERT INTO `countries` VALUES ('14', 'Austria', 'AT', 'AUT', '40', 'EUR', 'Eur', '€', 'AT.png');
INSERT INTO `countries` VALUES ('15', 'Azerbaijan', 'AZ', 'AZE', '31', 'AZN', 'Man', 'ман', 'AZ.png');
INSERT INTO `countries` VALUES ('16', 'Bahamas', 'BS', 'BHS', '44', 'BSD', 'Dol', '$', 'BS.png');
INSERT INTO `countries` VALUES ('17', 'Bahrain', 'BH', 'BHR', '48', 'BHD', 'Din', null, 'BH.png');
INSERT INTO `countries` VALUES ('18', 'Bangladesh', 'BD', 'BGD', '50', 'BDT', 'Tak', null, 'BD.png');
INSERT INTO `countries` VALUES ('19', 'Barbados', 'BB', 'BRB', '52', 'BBD', 'Dol', '$', 'BB.png');
INSERT INTO `countries` VALUES ('20', 'Belarus', 'BY', 'BLR', '112', 'BYR', 'Rub', 'p.', 'BY.png');
INSERT INTO `countries` VALUES ('21', 'Belgium', 'BE', 'BEL', '56', 'EUR', 'Eur', '€', 'BE.png');
INSERT INTO `countries` VALUES ('22', 'Belize', 'BZ', 'BLZ', '84', 'BZD', 'Dol', 'BZ$', 'BZ.png');
INSERT INTO `countries` VALUES ('23', 'Benin', 'BJ', 'BEN', '204', 'XOF', 'Fra', null, 'BJ.png');
INSERT INTO `countries` VALUES ('24', 'Bermuda', 'BM', 'BMU', '60', 'BMD', 'Dol', '$', 'BM.png');
INSERT INTO `countries` VALUES ('25', 'Bhutan', 'BT', 'BTN', '64', 'BTN', 'Ngu', null, 'BT.png');
INSERT INTO `countries` VALUES ('26', 'Bolivia', 'BO', 'BOL', '68', 'BOB', 'Bol', '$b', 'BO.png');
INSERT INTO `countries` VALUES ('27', 'Bosnia and Herzegovina', 'BA', 'BIH', '70', 'BAM', 'Mar', 'KM', 'BA.png');
INSERT INTO `countries` VALUES ('28', 'Botswana', 'BW', 'BWA', '72', 'BWP', 'Pul', 'P', 'BW.png');
INSERT INTO `countries` VALUES ('29', 'Bouvet Island', 'BV', 'BVT', '74', 'NOK', 'Kro', 'kr', 'BV.png');
INSERT INTO `countries` VALUES ('30', 'Brazil', 'BR', 'BRA', '76', 'BRL', 'Rea', 'R$', 'BR.png');
INSERT INTO `countries` VALUES ('31', 'British Indian Ocean Territory', 'IO', 'IOT', '86', 'USD', 'Dol', '$', 'IO.png');
INSERT INTO `countries` VALUES ('32', 'British Virgin Islands', 'VG', 'VGB', '92', 'USD', 'Dol', '$', 'VG.png');
INSERT INTO `countries` VALUES ('33', 'Brunei', 'BN', 'BRN', '96', 'BND', 'Dol', '$', 'BN.png');
INSERT INTO `countries` VALUES ('34', 'Bulgaria', 'BG', 'BGR', '100', 'BGN', 'Lev', 'лв', 'BG.png');
INSERT INTO `countries` VALUES ('35', 'Burkina Faso', 'BF', 'BFA', '854', 'XOF', 'Fra', null, 'BF.png');
INSERT INTO `countries` VALUES ('36', 'Burundi', 'BI', 'BDI', '108', 'BIF', 'Fra', null, 'BI.png');
INSERT INTO `countries` VALUES ('37', 'Cambodia', 'KH', 'KHM', '116', 'KHR', 'Rie', '៛', 'KH.png');
INSERT INTO `countries` VALUES ('38', 'Cameroon', 'CM', 'CMR', '120', 'XAF', 'Fra', 'FCF', 'CM.png');
INSERT INTO `countries` VALUES ('39', 'Canada', 'CA', 'CAN', '124', 'CAD', 'Dol', '$', 'CA.png');
INSERT INTO `countries` VALUES ('40', 'Cape Verde', 'CV', 'CPV', '132', 'CVE', 'Esc', null, 'CV.png');
INSERT INTO `countries` VALUES ('41', 'Cayman Islands', 'KY', 'CYM', '136', 'KYD', 'Dol', '$', 'KY.png');
INSERT INTO `countries` VALUES ('42', 'Central African Republic', 'CF', 'CAF', '140', 'XAF', 'Fra', 'FCF', 'CF.png');
INSERT INTO `countries` VALUES ('43', 'Chad', 'TD', 'TCD', '148', 'XAF', 'Fra', null, 'TD.png');
INSERT INTO `countries` VALUES ('44', 'Chile', 'CL', 'CHL', '152', 'CLP', 'Pes', null, 'CL.png');
INSERT INTO `countries` VALUES ('45', 'China', 'CN', 'CHN', '156', 'CNY', 'Yua', '¥', 'CN.png');
INSERT INTO `countries` VALUES ('46', 'Christmas Island', 'CX', 'CXR', '162', 'AUD', 'Dol', '$', 'CX.png');
INSERT INTO `countries` VALUES ('47', 'Cocos Islands', 'CC', 'CCK', '166', 'AUD', 'Dol', '$', 'CC.png');
INSERT INTO `countries` VALUES ('48', 'Colombia', 'CO', 'COL', '170', 'COP', 'Pes', '$', 'CO.png');
INSERT INTO `countries` VALUES ('49', 'Comoros', 'KM', 'COM', '174', 'KMF', 'Fra', null, 'KM.png');
INSERT INTO `countries` VALUES ('50', 'Cook Islands', 'CK', 'COK', '184', 'NZD', 'Dol', '$', 'CK.png');
INSERT INTO `countries` VALUES ('51', 'Costa Rica', 'CR', 'CRI', '188', 'CRC', 'Col', '₡', 'CR.png');
INSERT INTO `countries` VALUES ('52', 'Croatia', 'HR', 'HRV', '191', 'HRK', 'Kun', 'kn', 'HR.png');
INSERT INTO `countries` VALUES ('53', 'Cuba', 'CU', 'CUB', '192', 'CUP', 'Pes', '₱', 'CU.png');
INSERT INTO `countries` VALUES ('54', 'Cyprus', 'CY', 'CYP', '196', 'CYP', 'Pou', null, 'CY.png');
INSERT INTO `countries` VALUES ('55', 'Czech Republic', 'CZ', 'CZE', '203', 'CZK', 'Kor', 'Kč', 'CZ.png');
INSERT INTO `countries` VALUES ('56', 'Democratic Republic of the Congo', 'CD', 'COD', '180', 'CDF', 'Fra', null, 'CD.png');
INSERT INTO `countries` VALUES ('57', 'Denmark', 'DK', 'DNK', '208', 'DKK', 'Kro', 'kr', 'DK.png');
INSERT INTO `countries` VALUES ('58', 'Djibouti', 'DJ', 'DJI', '262', 'DJF', 'Fra', null, 'DJ.png');
INSERT INTO `countries` VALUES ('59', 'Dominica', 'DM', 'DMA', '212', 'XCD', 'Dol', '$', 'DM.png');
INSERT INTO `countries` VALUES ('60', 'Dominican Republic', 'DO', 'DOM', '214', 'DOP', 'Pes', 'RD$', 'DO.png');
INSERT INTO `countries` VALUES ('61', 'East Timor', 'TL', 'TLS', '626', 'USD', 'Dol', '$', 'TL.png');
INSERT INTO `countries` VALUES ('62', 'Ecuador', 'EC', 'ECU', '218', 'USD', 'Dol', '$', 'EC.png');
INSERT INTO `countries` VALUES ('63', 'Egypt', 'EG', 'EGY', '818', 'EGP', 'Pou', '£', 'EG.png');
INSERT INTO `countries` VALUES ('64', 'El Salvador', 'SV', 'SLV', '222', 'SVC', 'Col', '$', 'SV.png');
INSERT INTO `countries` VALUES ('65', 'Equatorial Guinea', 'GQ', 'GNQ', '226', 'XAF', 'Fra', 'FCF', 'GQ.png');
INSERT INTO `countries` VALUES ('66', 'Eritrea', 'ER', 'ERI', '232', 'ERN', 'Nak', 'Nfk', 'ER.png');
INSERT INTO `countries` VALUES ('67', 'Estonia', 'EE', 'EST', '233', 'EEK', 'Kro', 'kr', 'EE.png');
INSERT INTO `countries` VALUES ('68', 'Ethiopia', 'ET', 'ETH', '231', 'ETB', 'Bir', null, 'ET.png');
INSERT INTO `countries` VALUES ('69', 'Falkland Islands', 'FK', 'FLK', '238', 'FKP', 'Pou', '£', 'FK.png');
INSERT INTO `countries` VALUES ('70', 'Faroe Islands', 'FO', 'FRO', '234', 'DKK', 'Kro', 'kr', 'FO.png');
INSERT INTO `countries` VALUES ('71', 'Fiji', 'FJ', 'FJI', '242', 'FJD', 'Dol', '$', 'FJ.png');
INSERT INTO `countries` VALUES ('72', 'Finland', 'FI', 'FIN', '246', 'EUR', 'Eur', '€', 'FI.png');
INSERT INTO `countries` VALUES ('73', 'France', 'FR', 'FRA', '250', 'EUR', 'Eur', '€', 'FR.png');
INSERT INTO `countries` VALUES ('74', 'French Guiana', 'GF', 'GUF', '254', 'EUR', 'Eur', '€', 'GF.png');
INSERT INTO `countries` VALUES ('75', 'French Polynesia', 'PF', 'PYF', '258', 'XPF', 'Fra', null, 'PF.png');
INSERT INTO `countries` VALUES ('76', 'French Southern Territories', 'TF', 'ATF', '260', 'EUR', 'Eur', '€', 'TF.png');
INSERT INTO `countries` VALUES ('77', 'Gabon', 'GA', 'GAB', '266', 'XAF', 'Fra', 'FCF', 'GA.png');
INSERT INTO `countries` VALUES ('78', 'Gambia', 'GM', 'GMB', '270', 'GMD', 'Dal', 'D', 'GM.png');
INSERT INTO `countries` VALUES ('79', 'Georgia', 'GE', 'GEO', '268', 'GEL', 'Lar', null, 'GE.png');
INSERT INTO `countries` VALUES ('80', 'Germany', 'DE', 'DEU', '276', 'EUR', 'Eur', '€', 'DE.png');
INSERT INTO `countries` VALUES ('81', 'Ghana', 'GH', 'GHA', '288', 'GHC', 'Ced', '¢', 'GH.png');
INSERT INTO `countries` VALUES ('82', 'Gibraltar', 'GI', 'GIB', '292', 'GIP', 'Pou', '£', 'GI.png');
INSERT INTO `countries` VALUES ('83', 'Greece', 'GR', 'GRC', '300', 'EUR', 'Eur', '€', 'GR.png');
INSERT INTO `countries` VALUES ('84', 'Greenland', 'GL', 'GRL', '304', 'DKK', 'Kro', 'kr', 'GL.png');
INSERT INTO `countries` VALUES ('85', 'Grenada', 'GD', 'GRD', '308', 'XCD', 'Dol', '$', 'GD.png');
INSERT INTO `countries` VALUES ('86', 'Guadeloupe', 'GP', 'GLP', '312', 'EUR', 'Eur', '€', 'GP.png');
INSERT INTO `countries` VALUES ('87', 'Guam', 'GU', 'GUM', '316', 'USD', 'Dol', '$', 'GU.png');
INSERT INTO `countries` VALUES ('88', 'Guatemala', 'GT', 'GTM', '320', 'GTQ', 'Que', 'Q', 'GT.png');
INSERT INTO `countries` VALUES ('89', 'Guinea', 'GN', 'GIN', '324', 'GNF', 'Fra', null, 'GN.png');
INSERT INTO `countries` VALUES ('90', 'Guinea-Bissau', 'GW', 'GNB', '624', 'XOF', 'Fra', null, 'GW.png');
INSERT INTO `countries` VALUES ('91', 'Guyana', 'GY', 'GUY', '328', 'GYD', 'Dol', '$', 'GY.png');
INSERT INTO `countries` VALUES ('92', 'Haiti', 'HT', 'HTI', '332', 'HTG', 'Gou', 'G', 'HT.png');
INSERT INTO `countries` VALUES ('93', 'Heard Island and McDonald Islands', 'HM', 'HMD', '334', 'AUD', 'Dol', '$', 'HM.png');
INSERT INTO `countries` VALUES ('94', 'Honduras', 'HN', 'HND', '340', 'HNL', 'Lem', 'L', 'HN.png');
INSERT INTO `countries` VALUES ('95', 'Hong Kong', 'HK', 'HKG', '344', 'HKD', 'Dol', '$', 'HK.png');
INSERT INTO `countries` VALUES ('96', 'Hungary', 'HU', 'HUN', '348', 'HUF', 'For', 'Ft', 'HU.png');
INSERT INTO `countries` VALUES ('97', 'Iceland', 'IS', 'ISL', '352', 'ISK', 'Kro', 'kr', 'IS.png');
INSERT INTO `countries` VALUES ('98', 'India', 'IN', 'IND', '356', 'INR', 'Rup', '₹', 'IN.png');
INSERT INTO `countries` VALUES ('99', 'Indonesia', 'ID', 'IDN', '360', 'IDR', 'Rup', 'Rp', 'ID.png');
INSERT INTO `countries` VALUES ('100', 'Iran', 'IR', 'IRN', '364', 'IRR', 'Ria', '﷼', 'IR.png');
INSERT INTO `countries` VALUES ('101', 'Iraq', 'IQ', 'IRQ', '368', 'IQD', 'Din', null, 'IQ.png');
INSERT INTO `countries` VALUES ('102', 'Ireland', 'IE', 'IRL', '372', 'EUR', 'Eur', '€', 'IE.png');
INSERT INTO `countries` VALUES ('103', 'Israel', 'IL', 'ISR', '376', 'ILS', 'She', '₪', 'IL.png');
INSERT INTO `countries` VALUES ('104', 'Italy', 'IT', 'ITA', '380', 'EUR', 'Eur', '€', 'IT.png');
INSERT INTO `countries` VALUES ('105', 'Ivory Coast', 'CI', 'CIV', '384', 'XOF', 'Fra', null, 'CI.png');
INSERT INTO `countries` VALUES ('106', 'Jamaica', 'JM', 'JAM', '388', 'JMD', 'Dol', '$', 'JM.png');
INSERT INTO `countries` VALUES ('107', 'Japan', 'JP', 'JPN', '392', 'JPY', 'Yen', '¥', 'JP.png');
INSERT INTO `countries` VALUES ('108', 'Jordan', 'JO', 'JOR', '400', 'JOD', 'Din', null, 'JO.png');
INSERT INTO `countries` VALUES ('109', 'Kazakhstan', 'KZ', 'KAZ', '398', 'KZT', 'Ten', 'лв', 'KZ.png');
INSERT INTO `countries` VALUES ('110', 'Kenya', 'KE', 'KEN', '404', 'KES', 'Shi', null, 'KE.png');
INSERT INTO `countries` VALUES ('111', 'Kiribati', 'KI', 'KIR', '296', 'AUD', 'Dol', '$', 'KI.png');
INSERT INTO `countries` VALUES ('112', 'Kuwait', 'KW', 'KWT', '414', 'KWD', 'Din', null, 'KW.png');
INSERT INTO `countries` VALUES ('113', 'Kyrgyzstan', 'KG', 'KGZ', '417', 'KGS', 'Som', 'лв', 'KG.png');
INSERT INTO `countries` VALUES ('114', 'Laos', 'LA', 'LAO', '418', 'LAK', 'Kip', '₭', 'LA.png');
INSERT INTO `countries` VALUES ('115', 'Latvia', 'LV', 'LVA', '428', 'LVL', 'Lat', 'Ls', 'LV.png');
INSERT INTO `countries` VALUES ('116', 'Lebanon', 'LB', 'LBN', '422', 'LBP', 'Pou', '£', 'LB.png');
INSERT INTO `countries` VALUES ('117', 'Lesotho', 'LS', 'LSO', '426', 'LSL', 'Lot', 'L', 'LS.png');
INSERT INTO `countries` VALUES ('118', 'Liberia', 'LR', 'LBR', '430', 'LRD', 'Dol', '$', 'LR.png');
INSERT INTO `countries` VALUES ('119', 'Libya', 'LY', 'LBY', '434', 'LYD', 'Din', null, 'LY.png');
INSERT INTO `countries` VALUES ('120', 'Liechtenstein', 'LI', 'LIE', '438', 'CHF', 'Fra', 'CHF', 'LI.png');
INSERT INTO `countries` VALUES ('121', 'Lithuania', 'LT', 'LTU', '440', 'LTL', 'Lit', 'Lt', 'LT.png');
INSERT INTO `countries` VALUES ('122', 'Luxembourg', 'LU', 'LUX', '442', 'EUR', 'Eur', '€', 'LU.png');
INSERT INTO `countries` VALUES ('123', 'Macao', 'MO', 'MAC', '446', 'MOP', 'Pat', 'MOP', 'MO.png');
INSERT INTO `countries` VALUES ('124', 'Macedonia', 'MK', 'MKD', '807', 'MKD', 'Den', 'ден', 'MK.png');
INSERT INTO `countries` VALUES ('125', 'Madagascar', 'MG', 'MDG', '450', 'MGA', 'Ari', null, 'MG.png');
INSERT INTO `countries` VALUES ('126', 'Malawi', 'MW', 'MWI', '454', 'MWK', 'Kwa', 'MK', 'MW.png');
INSERT INTO `countries` VALUES ('127', 'Malaysia', 'MY', 'MYS', '458', 'MYR', 'Rin', 'RM', 'MY.png');
INSERT INTO `countries` VALUES ('128', 'Maldives', 'MV', 'MDV', '462', 'MVR', 'Ruf', 'Rf', 'MV.png');
INSERT INTO `countries` VALUES ('129', 'Mali', 'ML', 'MLI', '466', 'XOF', 'Fra', null, 'ML.png');
INSERT INTO `countries` VALUES ('130', 'Malta', 'MT', 'MLT', '470', 'MTL', 'Lir', null, 'MT.png');
INSERT INTO `countries` VALUES ('131', 'Marshall Islands', 'MH', 'MHL', '584', 'USD', 'Dol', '$', 'MH.png');
INSERT INTO `countries` VALUES ('132', 'Martinique', 'MQ', 'MTQ', '474', 'EUR', 'Eur', '€', 'MQ.png');
INSERT INTO `countries` VALUES ('133', 'Mauritania', 'MR', 'MRT', '478', 'MRO', 'Oug', 'UM', 'MR.png');
INSERT INTO `countries` VALUES ('134', 'Mauritius', 'MU', 'MUS', '480', 'MUR', 'Rup', '₨', 'MU.png');
INSERT INTO `countries` VALUES ('135', 'Mayotte', 'YT', 'MYT', '175', 'EUR', 'Eur', '€', 'YT.png');
INSERT INTO `countries` VALUES ('136', 'Mexico', 'MX', 'MEX', '484', 'MXN', 'Pes', '$', 'MX.png');
INSERT INTO `countries` VALUES ('137', 'Micronesia', 'FM', 'FSM', '583', 'USD', 'Dol', '$', 'FM.png');
INSERT INTO `countries` VALUES ('138', 'Moldova', 'MD', 'MDA', '498', 'MDL', 'Leu', null, 'MD.png');
INSERT INTO `countries` VALUES ('139', 'Monaco', 'MC', 'MCO', '492', 'EUR', 'Eur', '€', 'MC.png');
INSERT INTO `countries` VALUES ('140', 'Mongolia', 'MN', 'MNG', '496', 'MNT', 'Tug', '₮', 'MN.png');
INSERT INTO `countries` VALUES ('141', 'Montserrat', 'MS', 'MSR', '500', 'XCD', 'Dol', '$', 'MS.png');
INSERT INTO `countries` VALUES ('142', 'Morocco', 'MA', 'MAR', '504', 'MAD', 'Dir', null, 'MA.png');
INSERT INTO `countries` VALUES ('143', 'Mozambique', 'MZ', 'MOZ', '508', 'MZN', 'Met', 'MT', 'MZ.png');
INSERT INTO `countries` VALUES ('144', 'Myanmar', 'MM', 'MMR', '104', 'MMK', 'Kya', 'K', 'MM.png');
INSERT INTO `countries` VALUES ('145', 'Namibia', 'NA', 'NAM', '516', 'NAD', 'Dol', '$', 'NA.png');
INSERT INTO `countries` VALUES ('146', 'Nauru', 'NR', 'NRU', '520', 'AUD', 'Dol', '$', 'NR.png');
INSERT INTO `countries` VALUES ('147', 'Nepal', 'NP', 'NPL', '524', 'NPR', 'Rup', '₨', 'NP.png');
INSERT INTO `countries` VALUES ('148', 'Netherlands', 'NL', 'NLD', '528', 'EUR', 'Eur', '€', 'NL.png');
INSERT INTO `countries` VALUES ('149', 'Netherlands Antilles', 'AN', 'ANT', '530', 'ANG', 'Gui', 'ƒ', 'AN.png');
INSERT INTO `countries` VALUES ('150', 'New Caledonia', 'NC', 'NCL', '540', 'XPF', 'Fra', null, 'NC.png');
INSERT INTO `countries` VALUES ('151', 'New Zealand', 'NZ', 'NZL', '554', 'NZD', 'Dol', '$', 'NZ.png');
INSERT INTO `countries` VALUES ('152', 'Nicaragua', 'NI', 'NIC', '558', 'NIO', 'Cor', 'C$', 'NI.png');
INSERT INTO `countries` VALUES ('153', 'Niger', 'NE', 'NER', '562', 'XOF', 'Fra', null, 'NE.png');
INSERT INTO `countries` VALUES ('154', 'Nigeria', 'NG', 'NGA', '566', 'NGN', 'Nai', '₦', 'NG.png');
INSERT INTO `countries` VALUES ('155', 'Niue', 'NU', 'NIU', '570', 'NZD', 'Dol', '$', 'NU.png');
INSERT INTO `countries` VALUES ('156', 'Norfolk Island', 'NF', 'NFK', '574', 'AUD', 'Dol', '$', 'NF.png');
INSERT INTO `countries` VALUES ('157', 'North Korea', 'KP', 'PRK', '408', 'KPW', 'Won', '₩', 'KP.png');
INSERT INTO `countries` VALUES ('158', 'Northern Mariana Islands', 'MP', 'MNP', '580', 'USD', 'Dol', '$', 'MP.png');
INSERT INTO `countries` VALUES ('159', 'Norway', 'NO', 'NOR', '578', 'NOK', 'Kro', 'kr', 'NO.png');
INSERT INTO `countries` VALUES ('160', 'Oman', 'OM', 'OMN', '512', 'OMR', 'Ria', '﷼', 'OM.png');
INSERT INTO `countries` VALUES ('161', 'Pakistan', 'PK', 'PAK', '586', 'PKR', 'Rup', '₨', 'PK.png');
INSERT INTO `countries` VALUES ('162', 'Palau', 'PW', 'PLW', '585', 'USD', 'Dol', '$', 'PW.png');
INSERT INTO `countries` VALUES ('163', 'Palestinian Territory', 'PS', 'PSE', '275', 'ILS', 'She', '₪', 'PS.png');
INSERT INTO `countries` VALUES ('164', 'Panama', 'PA', 'PAN', '591', 'PAB', 'Bal', 'B/.', 'PA.png');
INSERT INTO `countries` VALUES ('165', 'Papua New Guinea', 'PG', 'PNG', '598', 'PGK', 'Kin', null, 'PG.png');
INSERT INTO `countries` VALUES ('166', 'Paraguay', 'PY', 'PRY', '600', 'PYG', 'Gua', 'Gs', 'PY.png');
INSERT INTO `countries` VALUES ('167', 'Peru', 'PE', 'PER', '604', 'PEN', 'Sol', 'S/.', 'PE.png');
INSERT INTO `countries` VALUES ('168', 'Philippines', 'PH', 'PHL', '608', 'PHP', 'Pes', 'Php', 'PH.png');
INSERT INTO `countries` VALUES ('169', 'Pitcairn', 'PN', 'PCN', '612', 'NZD', 'Dol', '$', 'PN.png');
INSERT INTO `countries` VALUES ('170', 'Poland', 'PL', 'POL', '616', 'PLN', 'Zlo', 'zł', 'PL.png');
INSERT INTO `countries` VALUES ('171', 'Portugal', 'PT', 'PRT', '620', 'EUR', 'Eur', '€', 'PT.png');
INSERT INTO `countries` VALUES ('172', 'Puerto Rico', 'PR', 'PRI', '630', 'USD', 'Dol', '$', 'PR.png');
INSERT INTO `countries` VALUES ('173', 'Qatar', 'QA', 'QAT', '634', 'QAR', 'Ria', '﷼', 'QA.png');
INSERT INTO `countries` VALUES ('174', 'Republic of the Congo', 'CG', 'COG', '178', 'XAF', 'Fra', 'FCF', 'CG.png');
INSERT INTO `countries` VALUES ('175', 'Reunion', 'RE', 'REU', '638', 'EUR', 'Eur', '€', 'RE.png');
INSERT INTO `countries` VALUES ('176', 'Romania', 'RO', 'ROU', '642', 'RON', 'Leu', 'lei', 'RO.png');
INSERT INTO `countries` VALUES ('177', 'Russia', 'RU', 'RUS', '643', 'RUB', 'Rub', 'руб', 'RU.png');
INSERT INTO `countries` VALUES ('178', 'Rwanda', 'RW', 'RWA', '646', 'RWF', 'Fra', null, 'RW.png');
INSERT INTO `countries` VALUES ('179', 'Saint Helena', 'SH', 'SHN', '654', 'SHP', 'Pou', '£', 'SH.png');
INSERT INTO `countries` VALUES ('180', 'Saint Kitts and Nevis', 'KN', 'KNA', '659', 'XCD', 'Dol', '$', 'KN.png');
INSERT INTO `countries` VALUES ('181', 'Saint Lucia', 'LC', 'LCA', '662', 'XCD', 'Dol', '$', 'LC.png');
INSERT INTO `countries` VALUES ('182', 'Saint Pierre and Miquelon', 'PM', 'SPM', '666', 'EUR', 'Eur', '€', 'PM.png');
INSERT INTO `countries` VALUES ('183', 'Saint Vincent and the Grenadines', 'VC', 'VCT', '670', 'XCD', 'Dol', '$', 'VC.png');
INSERT INTO `countries` VALUES ('184', 'Samoa', 'WS', 'WSM', '882', 'WST', 'Tal', 'WS$', 'WS.png');
INSERT INTO `countries` VALUES ('185', 'San Marino', 'SM', 'SMR', '674', 'EUR', 'Eur', '€', 'SM.png');
INSERT INTO `countries` VALUES ('186', 'Sao Tome and Principe', 'ST', 'STP', '678', 'STD', 'Dob', 'Db', 'ST.png');
INSERT INTO `countries` VALUES ('187', 'Saudi Arabia', 'SA', 'SAU', '682', 'SAR', 'Ria', '﷼', 'SA.png');
INSERT INTO `countries` VALUES ('188', 'Senegal', 'SN', 'SEN', '686', 'XOF', 'Fra', null, 'SN.png');
INSERT INTO `countries` VALUES ('189', 'Serbia and Montenegro', 'CS', 'SCG', '891', 'RSD', 'Din', 'Дин', 'CS.png');
INSERT INTO `countries` VALUES ('190', 'Seychelles', 'SC', 'SYC', '690', 'SCR', 'Rup', '₨', 'SC.png');
INSERT INTO `countries` VALUES ('191', 'Sierra Leone', 'SL', 'SLE', '694', 'SLL', 'Leo', 'Le', 'SL.png');
INSERT INTO `countries` VALUES ('192', 'Singapore', 'SG', 'SGP', '702', 'SGD', 'Dol', '$', 'SG.png');
INSERT INTO `countries` VALUES ('193', 'Slovakia', 'SK', 'SVK', '703', 'SKK', 'Kor', 'Sk', 'SK.png');
INSERT INTO `countries` VALUES ('194', 'Slovenia', 'SI', 'SVN', '705', 'EUR', 'Eur', '€', 'SI.png');
INSERT INTO `countries` VALUES ('195', 'Solomon Islands', 'SB', 'SLB', '90', 'SBD', 'Dol', '$', 'SB.png');
INSERT INTO `countries` VALUES ('196', 'Somalia', 'SO', 'SOM', '706', 'SOS', 'Shi', 'S', 'SO.png');
INSERT INTO `countries` VALUES ('197', 'South Africa', 'ZA', 'ZAF', '710', 'ZAR', 'Ran', 'R', 'ZA.png');
INSERT INTO `countries` VALUES ('198', 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', '239', 'GBP', 'Pou', '£', 'GS.png');
INSERT INTO `countries` VALUES ('199', 'South Korea', 'KR', 'KOR', '410', 'KRW', 'Won', '₩', 'KR.png');
INSERT INTO `countries` VALUES ('200', 'Spain', 'ES', 'ESP', '724', 'EUR', 'Eur', '€', 'ES.png');
INSERT INTO `countries` VALUES ('201', 'Sri Lanka', 'LK', 'LKA', '144', 'LKR', 'Rup', '₨', 'LK.png');
INSERT INTO `countries` VALUES ('202', 'Sudan', 'SD', 'SDN', '736', 'SDD', 'Din', null, 'SD.png');
INSERT INTO `countries` VALUES ('203', 'Suriname', 'SR', 'SUR', '740', 'SRD', 'Dol', '$', 'SR.png');
INSERT INTO `countries` VALUES ('204', 'Svalbard and Jan Mayen', 'SJ', 'SJM', '744', 'NOK', 'Kro', 'kr', 'SJ.png');
INSERT INTO `countries` VALUES ('205', 'Swaziland', 'SZ', 'SWZ', '748', 'SZL', 'Lil', null, 'SZ.png');
INSERT INTO `countries` VALUES ('206', 'Sweden', 'SE', 'SWE', '752', 'SEK', 'Kro', 'kr', 'SE.png');
INSERT INTO `countries` VALUES ('207', 'Switzerland', 'CH', 'CHE', '756', 'CHF', 'Fra', 'CHF', 'CH.png');
INSERT INTO `countries` VALUES ('208', 'Syria', 'SY', 'SYR', '760', 'SYP', 'Pou', '£', 'SY.png');
INSERT INTO `countries` VALUES ('209', 'Taiwan', 'TW', 'TWN', '158', 'TWD', 'Dol', 'NT$', 'TW.png');
INSERT INTO `countries` VALUES ('210', 'Tajikistan', 'TJ', 'TJK', '762', 'TJS', 'Som', null, 'TJ.png');
INSERT INTO `countries` VALUES ('211', 'Tanzania', 'TZ', 'TZA', '834', 'TZS', 'Shi', null, 'TZ.png');
INSERT INTO `countries` VALUES ('212', 'Thailand', 'TH', 'THA', '764', 'THB', 'Bah', '฿', 'TH.png');
INSERT INTO `countries` VALUES ('213', 'Togo', 'TG', 'TGO', '768', 'XOF', 'Fra', null, 'TG.png');
INSERT INTO `countries` VALUES ('214', 'Tokelau', 'TK', 'TKL', '772', 'NZD', 'Dol', '$', 'TK.png');
INSERT INTO `countries` VALUES ('215', 'Tonga', 'TO', 'TON', '776', 'TOP', 'Pa\'', 'T$', 'TO.png');
INSERT INTO `countries` VALUES ('216', 'Trinidad and Tobago', 'TT', 'TTO', '780', 'TTD', 'Dol', 'TT$', 'TT.png');
INSERT INTO `countries` VALUES ('217', 'Tunisia', 'TN', 'TUN', '788', 'TND', 'Din', null, 'TN.png');
INSERT INTO `countries` VALUES ('218', 'Turkey', 'TR', 'TUR', '792', 'TRY', 'Lir', 'YTL', 'TR.png');
INSERT INTO `countries` VALUES ('219', 'Turkmenistan', 'TM', 'TKM', '795', 'TMM', 'Man', 'm', 'TM.png');
INSERT INTO `countries` VALUES ('220', 'Turks and Caicos Islands', 'TC', 'TCA', '796', 'USD', 'Dol', '$', 'TC.png');
INSERT INTO `countries` VALUES ('221', 'Tuvalu', 'TV', 'TUV', '798', 'AUD', 'Dol', '$', 'TV.png');
INSERT INTO `countries` VALUES ('222', 'U.S. Virgin Islands', 'VI', 'VIR', '850', 'USD', 'Dol', '$', 'VI.png');
INSERT INTO `countries` VALUES ('223', 'Uganda', 'UG', 'UGA', '800', 'UGX', 'Shi', null, 'UG.png');
INSERT INTO `countries` VALUES ('224', 'Ukraine', 'UA', 'UKR', '804', 'UAH', 'Hry', '₴', 'UA.png');
INSERT INTO `countries` VALUES ('225', 'United Arab Emirates', 'AE', 'ARE', '784', 'AED', 'Dir', null, 'AE.png');
INSERT INTO `countries` VALUES ('226', 'United Kingdom', 'GB', 'GBR', '826', 'GBP', 'Pou', '£', 'GB.png');
INSERT INTO `countries` VALUES ('227', 'United States', 'US', 'USA', '840', 'USD', 'Dol', '$', 'US.png');
INSERT INTO `countries` VALUES ('228', 'United States Minor Outlying Islands', 'UM', 'UMI', '581', 'USD', 'Dol', '$', 'UM.png');
INSERT INTO `countries` VALUES ('229', 'Uruguay', 'UY', 'URY', '858', 'UYU', 'Pes', '$U', 'UY.png');
INSERT INTO `countries` VALUES ('230', 'Uzbekistan', 'UZ', 'UZB', '860', 'UZS', 'Som', 'лв', 'UZ.png');
INSERT INTO `countries` VALUES ('231', 'Vanuatu', 'VU', 'VUT', '548', 'VUV', 'Vat', 'Vt', 'VU.png');
INSERT INTO `countries` VALUES ('232', 'Vatican', 'VA', 'VAT', '336', 'EUR', 'Eur', '€', 'VA.png');
INSERT INTO `countries` VALUES ('233', 'Venezuela', 'VE', 'VEN', '862', 'VEF', 'Bol', 'Bs', 'VE.png');
INSERT INTO `countries` VALUES ('234', 'Vietnam', 'VN', 'VNM', '704', 'VND', 'Don', '₫', 'VN.png');
INSERT INTO `countries` VALUES ('235', 'Wallis and Futuna', 'WF', 'WLF', '876', 'XPF', 'Fra', null, 'WF.png');
INSERT INTO `countries` VALUES ('236', 'Western Sahara', 'EH', 'ESH', '732', 'MAD', 'Dir', null, 'EH.png');
INSERT INTO `countries` VALUES ('237', 'Yemen', 'YE', 'YEM', '887', 'YER', 'Ria', '﷼', 'YE.png');
INSERT INTO `countries` VALUES ('238', 'Zambia', 'ZM', 'ZMB', '894', 'ZMK', 'Kwa', 'ZK', 'ZM.png');
INSERT INTO `countries` VALUES ('239', 'Zimbabwe', 'ZW', 'ZWE', '716', 'ZWD', 'Dol', 'Z$', 'ZW.png');

-- ----------------------------
-- Table structure for county
-- ----------------------------
DROP TABLE IF EXISTS `county`;
CREATE TABLE `county` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for estates
-- ----------------------------
DROP TABLE IF EXISTS `estates`;
CREATE TABLE `estates` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `county_id` int(11) DEFAULT NULL,
  `image_path` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `types_id` int(11) DEFAULT NULL,
  `report` tinyint(4) NOT NULL DEFAULT '0',
  `area` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bathrooms` tinyint(4) NOT NULL DEFAULT '0',
  `bedrooms` tinyint(4) DEFAULT '0',
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` tinyint(4) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `activated` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `time_rate` tinyint(4) DEFAULT NULL,
  `cities_id` int(11) DEFAULT NULL,
  `view_counter` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for estates_amenities
-- ----------------------------
DROP TABLE IF EXISTS `estates_amenities`;
CREATE TABLE `estates_amenities` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `estates_id` bigint(20) DEFAULT NULL,
  `amenities_id` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumb_path` varchar(255) NOT NULL,
  `estates_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for marker
-- ----------------------------
DROP TABLE IF EXISTS `marker`;
CREATE TABLE `marker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyword` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_menu` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for spams
-- ----------------------------
DROP TABLE IF EXISTS `spams`;
CREATE TABLE `spams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for types
-- ----------------------------
DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`name`),
  UNIQUE KEY `name` (`name`) USING BTREE,
  UNIQUE KEY `name_2` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fb_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `skype` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `perm` tinyint(4) DEFAULT '2',
  `avt` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `activated` tinyint(4) NOT NULL DEFAULT '1',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `email` (`email`,`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for verified_account
-- ----------------------------
DROP TABLE IF EXISTS `verified_account`;
CREATE TABLE `verified_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(16) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `pwd` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
