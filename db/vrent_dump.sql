--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `currency_code`, `account`, `payment_method_id`, `selected`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 'tipu5040-buyer@gmail.com', 1, 'Yes', '2019-05-02 01:04:47', '2019-05-02 01:04:47'),
(2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 'test@techvill.net', 1, 'Yes', '2019-05-02 01:12:02', '2019-05-02 01:12:02'),
(3, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 'mahfuzasinthy@gmail.com', 1, 'Yes', '2019-05-02 01:15:51', '2019-05-02 01:15:51'),
(4, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 'customer@techvill.net', 1, 'No', '2019-05-02 04:52:48', '2019-05-02 04:52:48');


--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `profile_image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@techvill.net', '$2y$10$iqWncX1VDtz5MsnK9r4KFeI2tYNkOMlOxL0IUu24L/QkHI26rI2EG', NULL, 'Active', 'MTKy07qQPDkwLJViWD61axqJlvLklFDIVe0KOiC7D5M8NhiQfaeRp8VWTLWa', NOW(), NULL);

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `title`, `description`, `symbol`, `type_id`, `status`) VALUES
(1, 'Essentials', 'Towels, bed sheets, soap and toilet paper', 'essentials', 1, 'Active'),
(2, 'TV', '', 'tv', 1, 'Active'),
(3, 'Cable TV', '', 'desktop', 1, 'Active'),
(4, 'Air Conditioning ', '', 'air-conditioning', 1, 'Active'),
(5, 'Heating', 'Heating', 'heating', 1, 'Active'),
(6, 'Kitchen', 'Kitchen', 'meal', 1, 'Active'),
(7, 'Internet', 'Internet', 'internet', 1, 'Active'),
(8, 'Gym', 'Gym', 'gym', 1, 'Active'),
(9, 'Elevator in Building', '', 'elevator', 1, 'Active'),
(10, 'Indoor Fireplace', '', 'fireplace', 1, 'Active'),
(11, 'Buzzer/Wireless Intercom', '', 'intercom', 1, 'Active'),
(12, 'Doorman', '', 'doorman', 1, 'Active'),
(13, 'Shampoo', '', 'smoking', 1, 'Active'),
(14, 'Wireless Internet', 'Wireless Internet', 'wifi', 1, 'Active'),
(15, 'Hot Tub', '', 'hot-tub', 1, 'Active'),
(16, 'Washer', 'Washer', 'washer', 1, 'Active'),
(17, 'Pool', 'Pool', 'pool', 1, 'Active'),
(18, 'Dryer', 'Dryer', 'dryer', 1, 'Active'),
(19, 'Breakfast', 'Breakfast', 'cup', 1, 'Active'),
(20, 'Free Parking on Premises', '', 'parking', 1, 'Active'),
(21, 'Family/Kid Friendly', 'Family/Kid Friendly', 'family', 1, 'Active'),
(22, 'Smoking Allowed', '', 'smoking', 1, 'Active'),
(23, 'Suitable for Events', 'Suitable for Events', 'balloons', 1, 'Active'),
(24, 'Pets Allowed', '', 'paw', 1, 'Active'),
(25, 'Pets live on this property', '', 'ok', 1, 'Active'),
(26, 'Wheelchair Accessible', 'Wheelchair Accessible', 'accessible', 1, 'Active'),
(27, 'Smoke Detector', 'Smoke Detector', 'ok', 2, 'Active'),
(28, 'Carbon Monoxide Detector', 'Carbon Monoxide Detector', 'ok', 2, 'Active'),
(29, 'First Aid Kit', '', 'ok', 2, 'Active'),
(30, 'Safety Card', 'Safety Card', 'ok', 2, 'Active'),
(31, 'Fire Extinguisher', 'Essentials', 'ok', 2, 'Active');


--
-- Dumping data for table `amenity_type`
--

INSERT INTO `amenity_type` (`id`, `name`, `description`) VALUES
(1, 'Common Amenities', ''),
(2, 'Safety Amenities', '');


--
-- Dumping data for table `backups`
--

INSERT INTO `backups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '2019-05-02-104215.sql', '2019-05-02 04:42:15', NULL),
(2, '2019-05-02-104304.sql', '2019-05-02 04:43:04', NULL);


--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `heading`, `subheading`, `image`, `status`) VALUES
(1, 'Welcome to Hotel', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'banner_1.jpg', 'Active'),
(2, 'Feel Like Your Home', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'banner_2.jpg', 'Active'),
(3, 'Luxury Vacation Rentals Around the World', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'banner_3.jpg', 'Active');


--
-- Dumping data for table `bed_type`
--

INSERT INTO `bed_type` (`id`, `name`) VALUES
(1, 'king'),
(2, 'Queen'),
(3, 'Double'),
(4, 'Single'),
(5, 'Sofa bed'),
(6, 'Sofa'),
(7, 'Sofa bed'),
(8, 'Bunk bed'),
(9, 'Air mattress'),
(10, 'Floor mattress'),
(11, 'Toddler bed'),
(12, 'Crib'),
(13, 'Water bed'),
(14, 'Hammock');

--
-- Dumping data for table `bookings`
--

-- INSERT INTO `bookings` (`id`, `property_id`, `code`, `host_id`, `user_id`, `start_date`, `end_date`, `status`, `guest`, `total_night`, `per_night`, `base_price`, `cleaning_charge`, `guest_charge`, `service_charge`, `security_money`, `host_fee`, `total`, `booking_type`, `currency_code`, `cancellation`, `transaction_id`, `payment_method_id`, `accepted_at`, `expired_at`, `declined_at`, `cancelled_at`, `cancelled_by`, `created_at`, `updated_at`) VALUES
-- (1, 2, 'ERxu5C', 1, 2, CURDATE(), CURDATE()+7, 'Accepted', 1, 2, 12, 26, 1, 0, 1, 0, 0, 26, 'instant', 'USD', 'Flexible', 'ch_1CFfC8DpvvQP5tMR0U6VKv8X', 2, NULL, NULL, NULL, NULL, NULL, '2018-04-11 16:24:48', '2018-04-11 16:24:48'),
-- (2, 3, 'm0wtUO', 1, 2, CURDATE(), CURDATE()+7, 'Declined', 1, 3, 4, 16, 3, 0, 1, 0, 0, 16, 'request', 'EUR', 'Flexible', '9P049291CP579571C', 1, NULL, NULL, '2018-04-11 18:05:58', NULL, NULL, '2018-04-11 17:04:47', '2018-04-11 18:05:58'),
-- (3, 4, 'Q9MB6r', 1, 2, CURDATE()-7, CURDATE()-1, 'Accepted', 1, 3, 22, 69, 0, 0, 3, 0, 0, 69, 'instant', 'BRL', 'Flexible', '0EX08288RJ3218715', 1, NULL, NULL, NULL, NULL, NULL, '2018-04-11 17:50:13', '2018-04-11 17:50:13'),
-- (4, 5, 'ZOQy3s', 1, 2, CURDATE(), CURDATE()+7, 'Expired', 1, 2, 5, 11, 0, 0, 1, 0, 0, 11, 'request', 'USD', 'Flexible', '58W067956A932224U', 1, NULL, '2018-04-15 12:20:23', NULL, NULL, NULL, '2018-04-11 18:29:14', '2018-04-15 12:20:23'),
-- (5, 7, 'P5RhtR', 1, 2, CURDATE()-7, CURDATE()-1, 'Expired', 1, 5, 7, 37, 0, 0, 2, 0, 0, 37, 'request', 'CAD', 'Flexible', 'ch_1CFhEkDpvvQP5tMRkT8Thy3D', 2, NULL, '2018-04-15 12:20:23', NULL, NULL, NULL, '2018-04-11 18:35:38', '2018-04-15 12:20:23'),
-- (6, 11, 'Pru3id', 1, 2, CURDATE(), CURDATE()+7, 'Expired', 1, 2, 9, 19, 0, 0, 1, 0, 0, 19, 'request', 'EUR', 'Flexible', 'ch_1CFzu1DpvvQP5tMRJJJFAcyr', 2, NULL, '2018-04-15 12:20:23', NULL, NULL, NULL, '2018-04-12 14:31:29', '2018-04-15 12:20:23'),
-- (7, 2, '3nVe9i', 1, 2, CURDATE(), CURDATE()+7, 'Accepted', 1, 2, 47, 103, 4, 0, 5, 0, 0, 103, 'instant', 'BRL', 'Flexible', 'ch_1CG0MoDpvvQP5tMRYdmp7FUh', 2, NULL, NULL, NULL, NULL, NULL, '2018-04-12 15:01:15', '2018-04-12 15:01:15'),
-- (8, 6, 'YW9suc', 1, 2, CURDATE(), CURDATE()+7, 'Accepted', 1, 1, 20, 21, 0, 0, 1, 0, 0, 21, 'instant', 'BRL', 'Flexible', 'ch_1CG0TODpvvQP5tMRKNd2UbxJ', 2, NULL, NULL, NULL, NULL, NULL, '2018-04-12 15:08:02', '2018-04-12 15:08:02');


--
-- Dumping data for table `booking_details`
--

-- INSERT INTO `booking_details` (`id`, `booking_id`, `field`, `value`) VALUES
-- (1, 1, 'country', 'AU'),
-- (2, 2, 'country', 'BD'),
-- (3, 3, 'country', 'BD'),
-- (4, 2, 'decline_reason', 'dates_not_available'),
-- (5, 4, 'country', 'AU'),
-- (6, 5, 'country', 'CA'),
-- (7, 6, 'country', 'BD'),
-- (8, 7, 'country', 'BR'),
-- (9, 8, 'country', 'BD');

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `short_name`, `name`, `iso3`, `number_code`, `phone_code`) VALUES
(1, 'AF', 'Afghanistan', 'AFG', '4', '93'),
(2, 'AL', 'Albania', 'ALB', '8', '355'),
(3, 'DZ', 'Algeria', 'DZA', '12', '213'),
(4, 'AS', 'American Samoa', 'ASM', '16', '1684'),
(5, 'AD', 'Andorra', 'AND', '20', '376'),
(6, 'AO', 'Angola', 'AGO', '24', '244'),
(7, 'AI', 'Anguilla', 'AIA', '660', '1264'),
(8, 'AQ', 'Antarctica', NULL, NULL, '0'),
(9, 'AG', 'Antigua and Barbuda', 'ATG', '28', '1268'),
(10, 'AR', 'Argentina', 'ARG', '32', '54'),
(11, 'AM', 'Armenia', 'ARM', '51', '374'),
(12, 'AW', 'Aruba', 'ABW', '533', '297'),
(13, 'AU', 'Australia', 'AUS', '36', '61'),
(14, 'AT', 'Austria', 'AUT', '40', '43'),
(15, 'AZ', 'Azerbaijan', 'AZE', '31', '994'),
(16, 'BS', 'Bahamas', 'BHS', '44', '1242'),
(17, 'BH', 'Bahrain', 'BHR', '48', '973'),
(18, 'BD', 'Bangladesh', 'BGD', '50', '880'),
(19, 'BB', 'Barbados', 'BRB', '52', '1246'),
(20, 'BY', 'Belarus', 'BLR', '112', '375'),
(21, 'BE', 'Belgium', 'BEL', '56', '32'),
(22, 'BZ', 'Belize', 'BLZ', '84', '501'),
(23, 'BJ', 'Benin', 'BEN', '204', '229'),
(24, 'BM', 'Bermuda', 'BMU', '60', '1441'),
(25, 'BT', 'Bhutan', 'BTN', '64', '975'),
(26, 'BO', 'Bolivia', 'BOL', '68', '591'),
(27, 'BA', 'Bosnia and Herzegovina', 'BIH', '70', '387'),
(28, 'BW', 'Botswana', 'BWA', '72', '267'),
(29, 'BV', 'Bouvet Island', NULL, NULL, '0'),
(30, 'BR', 'Brazil', 'BRA', '76', '55'),
(31, 'IO', 'British Indian Ocean Territory', NULL, NULL, '246'),
(32, 'BN', 'Brunei Darussalam', 'BRN', '96', '673'),
(33, 'BG', 'Bulgaria', 'BGR', '100', '359'),
(34, 'BF', 'Burkina Faso', 'BFA', '854', '226'),
(35, 'BI', 'Burundi', 'BDI', '108', '257'),
(36, 'KH', 'Cambodia', 'KHM', '116', '855'),
(37, 'CM', 'Cameroon', 'CMR', '120', '237'),
(38, 'CA', 'Canada', 'CAN', '124', '1'),
(39, 'CV', 'Cape Verde', 'CPV', '132', '238'),
(40, 'KY', 'Cayman Islands', 'CYM', '136', '1345'),
(41, 'CF', 'Central African Republic', 'CAF', '140', '236'),
(42, 'TD', 'Chad', 'TCD', '148', '235'),
(43, 'CL', 'Chile', 'CHL', '152', '56'),
(44, 'CN', 'China', 'CHN', '156', '86'),
(45, 'CX', 'Christmas Island', NULL, NULL, '61'),
(46, 'CC', 'Cocos (Keeling) Islands', NULL, NULL, '672'),
(47, 'CO', 'Colombia', 'COL', '170', '57'),
(48, 'KM', 'Comoros', 'COM', '174', '269'),
(49, 'CG', 'Congo', 'COG', '178', '242'),
(50, 'CD', 'Congo, the Democratic Republic of the', 'COD', '180', '242'),
(51, 'CK', 'Cook Islands', 'COK', '184', '682'),
(52, 'CR', 'Costa Rica', 'CRI', '188', '506'),
(53, 'CI', 'Cote D\'Ivoire', 'CIV', '384', '225'),
(54, 'HR', 'Croatia', 'HRV', '191', '385'),
(55, 'CU', 'Cuba', 'CUB', '192', '53'),
(56, 'CY', 'Cyprus', 'CYP', '196', '357'),
(57, 'CZ', 'Czech Republic', 'CZE', '203', '420'),
(58, 'DK', 'Denmark', 'DNK', '208', '45'),
(59, 'DJ', 'Djibouti', 'DJI', '262', '253'),
(60, 'DM', 'Dominica', 'DMA', '212', '1767'),
(61, 'DO', 'Dominican Republic', 'DOM', '214', '1809'),
(62, 'EC', 'Ecuador', 'ECU', '218', '593'),
(63, 'EG', 'Egypt', 'EGY', '818', '20'),
(64, 'SV', 'El Salvador', 'SLV', '222', '503'),
(65, 'GQ', 'Equatorial Guinea', 'GNQ', '226', '240'),
(66, 'ER', 'Eritrea', 'ERI', '232', '291'),
(67, 'EE', 'Estonia', 'EST', '233', '372'),
(68, 'ET', 'Ethiopia', 'ETH', '231', '251'),
(69, 'FK', 'Falkland Islands (Malvinas)', 'FLK', '238', '500'),
(70, 'FO', 'Faroe Islands', 'FRO', '234', '298'),
(71, 'FJ', 'Fiji', 'FJI', '242', '679'),
(72, 'FI', 'Finland', 'FIN', '246', '358'),
(73, 'FR', 'France', 'FRA', '250', '33'),
(74, 'GF', 'French Guiana', 'GUF', '254', '594'),
(75, 'PF', 'French Polynesia', 'PYF', '258', '689'),
(76, 'TF', 'French Southern Territories', NULL, NULL, '0'),
(77, 'GA', 'Gabon', 'GAB', '266', '241'),
(78, 'GM', 'Gambia', 'GMB', '270', '220'),
(79, 'GE', 'Georgia', 'GEO', '268', '995'),
(80, 'DE', 'Germany', 'DEU', '276', '49'),
(81, 'GH', 'Ghana', 'GHA', '288', '233'),
(82, 'GI', 'Gibraltar', 'GIB', '292', '350'),
(83, 'GR', 'Greece', 'GRC', '300', '30'),
(84, 'GL', 'Greenland', 'GRL', '304', '299'),
(85, 'GD', 'Grenada', 'GRD', '308', '1473'),
(86, 'GP', 'Guadeloupe', 'GLP', '312', '590'),
(87, 'GU', 'Guam', 'GUM', '316', '1671'),
(88, 'GT', 'Guatemala', 'GTM', '320', '502'),
(89, 'GN', 'Guinea', 'GIN', '324', '224'),
(90, 'GW', 'Guinea-Bissau', 'GNB', '624', '245'),
(91, 'GY', 'Guyana', 'GUY', '328', '592'),
(92, 'HT', 'Haiti', 'HTI', '332', '509'),
(93, 'HM', 'Heard Island and Mcdonald Islands', NULL, NULL, '0'),
(94, 'VA', 'Holy See (Vatican City State)', 'VAT', '336', '39'),
(95, 'HN', 'Honduras', 'HND', '340', '504'),
(96, 'HK', 'Hong Kong', 'HKG', '344', '852'),
(97, 'HU', 'Hungary', 'HUN', '348', '36'),
(98, 'IS', 'Iceland', 'ISL', '352', '354'),
(99, 'IN', 'India', 'IND', '356', '91'),
(100, 'ID', 'Indonesia', 'IDN', '360', '62'),
(101, 'IR', 'Iran, Islamic Republic of', 'IRN', '364', '98'),
(102, 'IQ', 'Iraq', 'IRQ', '368', '964'),
(103, 'IE', 'Ireland', 'IRL', '372', '353'),
(104, 'IL', 'Israel', 'ISR', '376', '972'),
(105, 'IT', 'Italy', 'ITA', '380', '39'),
(106, 'JM', 'Jamaica', 'JAM', '388', '1876'),
(107, 'JP', 'Japan', 'JPN', '392', '81'),
(108, 'JO', 'Jordan', 'JOR', '400', '962'),
(109, 'KZ', 'Kazakhstan', 'KAZ', '398', '7'),
(110, 'KE', 'Kenya', 'KEN', '404', '254'),
(111, 'KI', 'Kiribati', 'KIR', '296', '686'),
(112, 'KP', 'Korea, Democratic People\'s Republic of', 'PRK', '408', '850'),
(113, 'KR', 'Korea, Republic of', 'KOR', '410', '82'),
(114, 'KW', 'Kuwait', 'KWT', '414', '965'),
(115, 'KG', 'Kyrgyzstan', 'KGZ', '417', '996'),
(116, 'LA', 'Lao People\'s Democratic Republic', 'LAO', '418', '856'),
(117, 'LV', 'Latvia', 'LVA', '428', '371'),
(118, 'LB', 'Lebanon', 'LBN', '422', '961'),
(119, 'LS', 'Lesotho', 'LSO', '426', '266'),
(120, 'LR', 'Liberia', 'LBR', '430', '231'),
(121, 'LY', 'Libyan Arab Jamahiriya', 'LBY', '434', '218'),
(122, 'LI', 'Liechtenstein', 'LIE', '438', '423'),
(123, 'LT', 'Lithuania', 'LTU', '440', '370'),
(124, 'LU', 'Luxembourg', 'LUX', '442', '352'),
(125, 'MO', 'Macao', 'MAC', '446', '853'),
(126, 'MK', 'Macedonia, the Former Yugoslav Republic of', 'MKD', '807', '389'),
(127, 'MG', 'Madagascar', 'MDG', '450', '261'),
(128, 'MW', 'Malawi', 'MWI', '454', '265'),
(129, 'MY', 'Malaysia', 'MYS', '458', '60'),
(130, 'MV', 'Maldives', 'MDV', '462', '960'),
(131, 'ML', 'Mali', 'MLI', '466', '223'),
(132, 'MT', 'Malta', 'MLT', '470', '356'),
(133, 'MH', 'Marshall Islands', 'MHL', '584', '692'),
(134, 'MQ', 'Martinique', 'MTQ', '474', '596'),
(135, 'MR', 'Mauritania', 'MRT', '478', '222'),
(136, 'MU', 'Mauritius', 'MUS', '480', '230'),
(137, 'YT', 'Mayotte', NULL, NULL, '269'),
(138, 'MX', 'Mexico', 'MEX', '484', '52'),
(139, 'FM', 'Micronesia, Federated States of', 'FSM', '583', '691'),
(140, 'MD', 'Moldova, Republic of', 'MDA', '498', '373'),
(141, 'MC', 'Monaco', 'MCO', '492', '377'),
(142, 'MN', 'Mongolia', 'MNG', '496', '976'),
(143, 'MS', 'Montserrat', 'MSR', '500', '1664'),
(144, 'MA', 'Morocco', 'MAR', '504', '212'),
(145, 'MZ', 'Mozambique', 'MOZ', '508', '258'),
(146, 'MM', 'Myanmar', 'MMR', '104', '95'),
(147, 'NA', 'Namibia', 'NAM', '516', '264'),
(148, 'NR', 'Nauru', 'NRU', '520', '674'),
(149, 'NP', 'Nepal', 'NPL', '524', '977'),
(150, 'NL', 'Netherlands', 'NLD', '528', '31'),
(151, 'AN', 'Netherlands Antilles', 'ANT', '530', '599'),
(152, 'NC', 'New Caledonia', 'NCL', '540', '687'),
(153, 'NZ', 'New Zealand', 'NZL', '554', '64'),
(154, 'NI', 'Nicaragua', 'NIC', '558', '505'),
(155, 'NE', 'Niger', 'NER', '562', '227'),
(156, 'NG', 'Nigeria', 'NGA', '566', '234'),
(157, 'NU', 'Niue', 'NIU', '570', '683'),
(158, 'NF', 'Norfolk Island', 'NFK', '574', '672'),
(159, 'MP', 'Northern Mariana Islands', 'MNP', '580', '1670'),
(160, 'NO', 'Norway', 'NOR', '578', '47'),
(161, 'OM', 'Oman', 'OMN', '512', '968'),
(162, 'PK', 'Pakistan', 'PAK', '586', '92'),
(163, 'PW', 'Palau', 'PLW', '585', '680'),
(164, 'PS', 'Palestinian Territory, Occupied', NULL, NULL, '970'),
(165, 'PA', 'Panama', 'PAN', '591', '507'),
(166, 'PG', 'Papua New Guinea', 'PNG', '598', '675'),
(167, 'PY', 'Paraguay', 'PRY', '600', '595'),
(168, 'PE', 'Peru', 'PER', '604', '51'),
(169, 'PH', 'Philippines', 'PHL', '608', '63'),
(170, 'PN', 'Pitcairn', 'PCN', '612', '0'),
(171, 'PL', 'Poland', 'POL', '616', '48'),
(172, 'PT', 'Portugal', 'PRT', '620', '351'),
(173, 'PR', 'Puerto Rico', 'PRI', '630', '1787'),
(174, 'QA', 'Qatar', 'QAT', '634', '974'),
(175, 'RE', 'Reunion', 'REU', '638', '262'),
(176, 'RO', 'Romania', 'ROM', '642', '40'),
(177, 'RU', 'Russian Federation', 'RUS', '643', '70'),
(178, 'RW', 'Rwanda', 'RWA', '646', '250'),
(179, 'SH', 'Saint Helena', 'SHN', '654', '290'),
(180, 'KN', 'Saint Kitts and Nevis', 'KNA', '659', '1869'),
(181, 'LC', 'Saint Lucia', 'LCA', '662', '1758'),
(182, 'PM', 'Saint Pierre and Miquelon', 'SPM', '666', '508'),
(183, 'VC', 'Saint Vincent and the Grenadines', 'VCT', '670', '1784'),
(184, 'WS', 'Samoa', 'WSM', '882', '684'),
(185, 'SM', 'San Marino', 'SMR', '674', '378'),
(186, 'ST', 'Sao Tome and Principe', 'STP', '678', '239'),
(187, 'SA', 'Saudi Arabia', 'SAU', '682', '966'),
(188, 'SN', 'Senegal', 'SEN', '686', '221'),
(189, 'CS', 'Serbia and Montenegro', NULL, NULL, '381'),
(190, 'SC', 'Seychelles', 'SYC', '690', '248'),
(191, 'SL', 'Sierra Leone', 'SLE', '694', '232'),
(192, 'SG', 'Singapore', 'SGP', '702', '65'),
(193, 'SK', 'Slovakia', 'SVK', '703', '421'),
(194, 'SI', 'Slovenia', 'SVN', '705', '386'),
(195, 'SB', 'Solomon Islands', 'SLB', '90', '677'),
(196, 'SO', 'Somalia', 'SOM', '706', '252'),
(197, 'ZA', 'South Africa', 'ZAF', '710', '27'),
(198, 'GS', 'South Georgia and the South Sandwich Islands', NULL, NULL, '0'),
(199, 'ES', 'Spain', 'ESP', '724', '34'),
(200, 'LK', 'Sri Lanka', 'LKA', '144', '94'),
(201, 'SD', 'Sudan', 'SDN', '736', '249'),
(202, 'SR', 'Suriname', 'SUR', '740', '597'),
(203, 'SJ', 'Svalbard and Jan Mayen', 'SJM', '744', '47'),
(204, 'SZ', 'Swaziland', 'SWZ', '748', '268'),
(205, 'SE', 'Sweden', 'SWE', '752', '46'),
(206, 'CH', 'Switzerland', 'CHE', '756', '41'),
(207, 'SY', 'Syrian Arab Republic', 'SYR', '760', '963'),
(208, 'TW', 'Taiwan, Province of China', 'TWN', '158', '886'),
(209, 'TJ', 'Tajikistan', 'TJK', '762', '992'),
(210, 'TZ', 'Tanzania, United Republic of', 'TZA', '834', '255'),
(211, 'TH', 'Thailand', 'THA', '764', '66'),
(212, 'TL', 'Timor-Leste', NULL, NULL, '670'),
(213, 'TG', 'Togo', 'TGO', '768', '228'),
(214, 'TK', 'Tokelau', 'TKL', '772', '690'),
(215, 'TO', 'Tonga', 'TON', '776', '676'),
(216, 'TT', 'Trinidad and Tobago', 'TTO', '780', '1868'),
(217, 'TN', 'Tunisia', 'TUN', '788', '216'),
(218, 'TR', 'Turkey', 'TUR', '792', '90'),
(219, 'TM', 'Turkmenistan', 'TKM', '795', '7370'),
(220, 'TC', 'Turks and Caicos Islands', 'TCA', '796', '1649'),
(221, 'TV', 'Tuvalu', 'TUV', '798', '688'),
(222, 'UG', 'Uganda', 'UGA', '800', '256'),
(223, 'UA', 'Ukraine', 'UKR', '804', '380'),
(224, 'AE', 'United Arab Emirates', 'ARE', '784', '971'),
(225, 'GB', 'United Kingdom', 'GBR', '826', '44'),
(226, 'US', 'United States', 'USA', '840', '1'),
(227, 'UM', 'United States Minor Outlying Islands', NULL, NULL, '1'),
(228, 'UY', 'Uruguay', 'URY', '858', '598'),
(229, 'UZ', 'Uzbekistan', 'UZB', '860', '998'),
(230, 'VU', 'Vanuatu', 'VUT', '548', '678'),
(231, 'VE', 'Venezuela', 'VEN', '862', '58'),
(232, 'VN', 'Viet Nam', 'VNM', '704', '84'),
(233, 'VG', 'Virgin Islands, British', 'VGB', '92', '1284'),
(234, 'VI', 'Virgin Islands, U.s.', 'VIR', '850', '1340'),
(235, 'WF', 'Wallis and Futuna', 'WLF', '876', '681'),
(236, 'EH', 'Western Sahara', 'ESH', '732', '212'),
(237, 'YE', 'Yemen', 'YEM', '887', '967'),
(238, 'ZM', 'Zambia', 'ZMB', '894', '260'),
(239, 'ZW', 'Zimbabwe', 'ZWE', '716', '263');


--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `code`, `symbol`, `rate`, `status`, `default`) VALUES
(1, 'US Dollar', 'USD', '$', '1.00', 'Active', '1'),
(2, 'Pound Sterling', 'GBP', '&pound;', '0.65', 'Active', '0'),
(3, 'Europe', 'EUR', '&euro;', '0.88', 'Active', '0'),
(4, 'Australian Dollar', 'AUD', '&#36;', '1.41', 'Active', '0'),
(5, 'Singapore', 'SGD', '$', '1.41', 'Active', '0'),
(6, 'Swedish Krona', 'SEK', 'kr', '8.24', 'Active', '0'),
(7, 'Danish Krone', 'DKK', 'kr', '6.58', 'Active', '0'),
(8, 'Mexican Peso', 'MXN', '$', '16.83', 'Active', '0'),
(9, 'Brazilian Real', 'BRL', 'R$', '3.88', 'Active', '0'),
(10, 'Malaysian Ringgit', 'MYR', 'RM', '4.31', 'Active', '0'),
(11, 'Philippine Peso', 'PHP', 'P', '46.73', 'Active', '0'),
(12, 'Swiss Franc', 'CHF', '&euro;', '0.97', 'Active', '0'),
(13, 'India', 'INR', '&#x20B9;', '66.24', 'Active', '0'),
(14, 'Argentine Peso', 'ARS', '&#36;', '9.35', 'Active', '0'),
(15, 'Canadian Dollar', 'CAD', '&#36;', '1.33', 'Active', '0'),
(16, 'Chinese Yuan', 'CNY', '&#165;', '6.37', 'Active', '0'),
(17, 'Czech Republic Koruna', 'CZK', 'K&#269;', '23.91', 'Active', '0'),
(18, 'Hong Kong Dollar', 'HKD', '&#36;', '7.75', 'Active', '0'),
(19, 'Hungarian Forint', 'HUF', 'Ft', '276.41', 'Active', '0'),
(20, 'Indonesian Rupiah', 'IDR', 'Rp', '14249.50', 'Active', '0'),
(21, 'Israeli New Sheqel', 'ILS', '&#8362;', '3.86', 'Active', '0'),
(22, 'Japanese Yen', 'JPY', '&#165;', '120.59', 'Active', '0'),
(23, 'South Korean Won', 'KRW', '&#8361;', '1182.69', 'Active', '0'),
(24, 'Norwegian Krone', 'NOK', 'kr', '8.15', 'Active', '0'),
(25, 'New Zealand Dollar', 'NZD', '&#36;', '1.58', 'Active', '0'),
(26, 'Polish Zloty', 'PLN', 'z&#322;', '3.71', 'Active', '0'),
(27, 'Russian Ruble', 'RUB', 'p', '67.75', 'Active', '0'),
(28, 'Thai Baht', 'THB', '&#3647;', '36.03', 'Active', '0'),
(29, 'Turkish Lira', 'TRY', '&#8378;', '3.05', 'Active', '0'),
(30, 'New Taiwan Dollar', 'TWD', '&#36;', '32.47', 'Active', '0'),
(31, 'Vietnamese Dong', 'VND', '₫', '22471.00', 'Active', '0'),
(32, 'South African Rand', 'ZAR', 'R', '13.55', 'Active', '0');


--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `temp_id`, `subject`, `body`, `link_text`, `lang`, `type`, `lang_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Your Payout information has been updated in {site_name}', 'Hi {first_name},\n                            <br><br>\n                            We hope this message finds you well. Your {site_name} payout account information was recently changed on {date_time}. To help keep your account secure, we wanted to reach out to confirm that you made this change. Feel free to disregard this message if you updated your payout account information on {date_time}.\n                            <br><br>\n                            If you did not make this change to your account, please contact us.<br>', NULL, 'en', 'email', 1, NULL, NULL),
(2, 2, 'Your Payout information has been updated in {site_name}', 'Hi {first_name},\n                            <br><br>\n                            Your {site_name} payout information was updated on {date_time}.<br>', NULL, 'en', 'email', 1, NULL, NULL),
(3, 3, 'Your Payout information has been deleted in {site_name}', 'Hi {first_name},\n                            <br><br>\n                            Your {site_name} payout information was deleted on {date_time}.<br>', NULL, 'en', 'email', 1, NULL, NULL),
(4, 4, 'Booking inquiry for {property_name}', 'Hi {owner_first_name},\n                            <br><br>\n            				<h1>Respond to {user_first_name}’s Inquiry</h1>\n            				<br>\n            				{total_night} {night/nights} at {property_name}\n            				<br>\n            				{messages_message}\n            				<br>\n            				Property Name:  {property_name}\n            				<br>\n            				Number of Guest: {total_guest}\n            				<br>\n            				Number of Night: {total_night}\n            				<br>\n                            Check in Time: {start_date}', NULL, 'en', 'email', 1, NULL, NULL),
(5, 5, 'Please confirm your e-mail address', 'Hi {first_name},\n                            <br><br>\n                            Welcome to {site_name}! Please confirm your account.', NULL, 'en', 'email', 1, NULL, NULL),
(6, 6, 'Reset your Password', 'Hi {first_name},\n                            <br><br>\n                            Your requested password reset link is below. If you didn\'t make the request, just ignore this email.', NULL, 'en', 'email', 1, NULL, NULL),
(7, 7, 'Please set a payment account', 'Hi {first_name},\n                            <br><br>\n                            Amount {currency_symbol}{payout_amount} is waiting for you but you did not add any payout account to send the money. Please add a payout method.', NULL, 'en', 'email', 1, NULL, NULL),
(8, 8, 'Payout Sent', 'Hi {first_name},\n                            <br><br>\n                            We\'ve issued you a payout of  {currency_symbol}{payout_amount} via PayPal. This payout should arrive in your account, taking into consideration weekends and holidays.', NULL, 'en', 'email', 1, NULL, NULL),
(9, 9, 'Booking Cancelled', 'Hi {owner_first_name},\n                            <br><br>\n                            {user_first_name} cancelled booking of {property_name}.<br>', NULL, 'en', 'email', 1, NULL, NULL),
(10, 10, 'Booking {Accepted/Declined}', 'Hi {guest_first_name},\n                            <br><br>\n                            {host_first_name} {Accepted/Declined} the booking of {property_name}.<br>', NULL, 'en', 'email', 1, NULL, NULL);


--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `short_name`, `status`, `default`) VALUES
(1, 'English', 'en', 'Active', '1'),
(2, 'عربى', 'ar', 'Active', '0'),
(3, '中文 (繁體)', 'ch', 'Active', '0'),
(4, 'Français', 'fr', 'Active', '0'),
(5, 'Português', 'pt', 'Inactive', '0'),
(6, 'Русский', 'ru', 'Active', '0'),
(7, 'Español', 'es', 'Active', '0'),
(8, 'Türkçe', 'tr', 'Active', '0');


--
-- Table structure for table `messages`
-- Dumping data for table `messages`
--

-- INSERT INTO `messages` (`id`, `property_id`, `booking_id`, `sender_id`, `receiver_id`, `message`, `type_id`, `read`, `archive`, `star`, `created_at`, `updated_at`) VALUES
-- (1, 2, 1, 2, 1, 'Dear host,\r\nPlease confirm my booking & let me know.\r\n\r\nThank you.', 4, 1, 0, 0, '2018-04-11 16:24:48', '2018-04-11 17:02:17'),
-- (2, 3, 2, 2, 1, NULL, 4, 1, 0, 0, '2018-04-11 17:04:47', '2018-04-11 17:59:48'),
-- (3, 4, 3, 2, 1, NULL, 4, 1, 0, 0, '2018-04-11 17:50:13', '2018-04-11 18:03:44'),
-- (4, 4, 3, 1, 2, 'Dear Guset,\r\nYour booking is confirmed. Have a nice journey.\r\n\r\nThank you.', 1, 1, 0, 0, '2018-04-11 18:00:56', '2018-04-11 18:01:06'),
-- (5, 4, 3, 2, 1, 'Hello,\r\nThank you.', 1, 1, 0, 0, '2018-04-11 18:01:24', '2018-04-11 18:03:44'),
-- (6, 3, 2, 1, 2, NULL, 6, 1, 0, 0, '2018-04-11 18:05:58', '2018-04-11 18:11:41'),
-- (7, 5, 4, 2, 1, NULL, 4, 1, 0, 0, '2018-04-11 18:29:14', '2018-04-11 18:29:44'),
-- (8, 7, 5, 2, 1, NULL, 4, 1, 0, 0, '2018-04-11 18:35:38', '2018-04-11 18:36:20'),
-- (9, 11, 6, 2, 1, NULL, 4, 1, 0, 0, '2018-04-12 14:31:29', '2018-04-12 14:56:31'),
-- (10, 2, 7, 2, 1, NULL, 4, 1, 0, 0, '2018-04-12 15:01:15', '2018-04-12 17:28:39'),
-- (11, 6, 8, 2, 1, NULL, 4, 1, 0, 0, '2018-04-12 15:08:02', '2018-04-12 17:28:27'),
-- (12, 5, 4, 2, 2, '', 7, 0, 0, 0, '2018-04-15 12:20:23', '2018-04-15 12:20:23'),
-- (13, 7, 5, 2, 2, '', 7, 0, 0, 0, '2018-04-15 12:20:23', '2018-04-15 12:20:23'),
-- (14, 11, 6, 2, 2, '', 7, 0, 0, 0, '2018-04-15 12:20:23', '2018-04-15 12:20:23');


-- Dumping data for table `message_type`
--

INSERT INTO `message_type` (`id`, `name`, `description`) VALUES
(1, 'query', NULL),
(2, 'guest_cancellation', NULL),
(3, 'host_cancellation', NULL),
(4, 'booking_request', NULL),
(5, 'booking_accecpt', NULL),
(6, 'booking_decline', NULL),
(7, 'booking_expire', NULL);

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `content`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Help', 'help', 'Help page coming soon.', NULL, 'Active', NULL, NULL),
(2, 'Why Host', 'Why Host', '<h1><strong>Why Host</strong></h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.</p>\r\n\r\n<p>Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.</p>\r\n\r\n<p>Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.</p>\r\n\r\n<p>&nbsp;</p>', 'first', 'Active', '2018-04-12 06:44:25', '2018-04-12 12:23:49'),
(3, 'Responsible Hosting', 'Responsible Hosting', '<h1>Responsible Hosting</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>', 'first', 'Active', '2018-04-12 06:48:41', '2018-04-12 06:48:41'),
(4, 'Trust & Safety', 'Trust & Safety', '<h1>Trust &amp; Safety</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.&nbsp;</p>', 'first', 'Active', '2018-04-12 06:50:02', '2018-04-12 06:50:02'),
(5, 'About Us', 'About us', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.&nbsp;</p>', 'second', 'Active', '2018-04-12 06:53:52', '2018-04-12 06:53:52'),
(6, 'Polices', 'Polices', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.&nbsp;</p>', 'second', 'Active', '2018-04-12 06:54:25', '2018-04-12 06:54:25'),
(7, 'Terms', 'Terms', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.&nbsp;</p>', 'second', 'Active', '2018-04-12 06:54:49', '2018-04-12 06:54:49'),
(8, 'Privacy', 'Privacy', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.&nbsp;</p>', 'second', 'Active', '2018-04-12 06:55:35', '2018-04-12 06:55:35');


-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('test@techvill.net', '9XgNNv3Y71FqvYSL4N8lbEmKsjkkz6OrXRvJIKyK5sxB5fNEMJPsMj5MZgUKngvUsw2yYwmAO0rHk1MH3WrPKBv20JjJ3YG7IEmm', '2019-04-30 04:06:17'),
('customer@techvill.net', 'O1PewEd0ZWn50nDUUXR1x5a2lne2E1GqZsMB3LOvNnYIJl9uYwOb5smkTx5NrsNpEZVUNOQfshgQ6WNhfN76jIEtO2Jcqcw1z4TJ', '2019-05-02 00:21:18'),
('mahfuzasinthy@gmail.com', 'bBUPKnyHrywTbAcBv3xTHfbxQ8rcOrdPyyWEZMgLkpPI3qEf7L7Lq3WgB4nm7JSZKf3FdtTEp9suufUDYeYfyQKsGUYH0EU9QYJn', '2019-05-02 00:34:02');


--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `status`) VALUES
(1, 'Paypal', 'Active'),
(2, 'Stripe', 'Active');


--
-- Dumping data for table `payouts`
--

-- INSERT INTO `payouts` (`id`, `booking_id`, `user_id`, `property_id`, `user_type`, `account`, `amount`, `penalty_amount`, `status`, `currency_code`, `created_at`, `updated_at`) VALUES
-- (1, 1, 1, 2, 'Host', 'borna.techvill@gmail.com', 31, 0, 'Completed', 'EUR', '2018-04-11 16:24:48', '2018-04-11 16:28:23'),
-- (2, 3, 1, 0, 'Host', NULL, 66, 0, 'Future', 'BRL', '2018-04-11 17:50:13', '2018-04-11 17:50:13'),
-- (3, 2, 2, 3, 'Guest', 'customer@techvill.net', 20, 0, 'Completed', 'EUR', '2018-04-11 18:05:58', '2018-04-11 18:24:50'),
-- (4, 7, 1, 0, 'Host', NULL, 98, 0, 'Future', 'BRL', '2018-04-12 15:01:15', '2018-04-12 15:01:15'),
-- (5, 8, 1, 6, 'Host', 'borna.techvill@gmail.com', 1, 0, 'Completed', 'EUR', '2018-04-12 15:08:02', '2018-04-12 15:09:17'),
-- (6, 4, 2, 5, 'Guest', NULL, 11, 0, 'Future', 'USD', '2018-04-15 12:20:23', '2018-04-15 12:20:23'),
-- (7, 5, 2, 7, 'Guest', NULL, 28, 0, 'Future', 'CAD', '2018-04-15 12:20:23', '2018-04-15 12:20:23'),
-- (8, 6, 2, 11, 'Guest', NULL, 22, 0, 'Future', 'EUR', '2018-04-15 12:20:23', '2018-04-15 12:20:23');


--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'manage_admin', 'Manage Admin', 'Manage Admin Users', NULL, NULL),
(2, 'customers', 'View Customers', 'View Customer', NULL, NULL),
(3, 'add_customer', 'Add Customer', 'Add Customer', NULL, NULL),
(4, 'edit_customer', 'Edit Customer', 'Edit Customer', NULL, NULL),
(5, 'properties', 'View Properties', 'View Properties', NULL, NULL),
(6, 'add_properties', 'Add Properties', 'Add Properties', NULL, NULL),
(7, 'edit_properties', 'Edit Properties', 'Edit Properties', NULL, NULL),
(8, 'delete_property', 'Delete Property', 'Delete Property', NULL, NULL),
(9, 'manage_bookings', 'Manage Bookings', 'Manage Bookings', NULL, NULL),
(10, 'manage_email_template', 'Manage Email Template', 'Manage Email Template', NULL, NULL),
(11, 'view_payouts', 'View Payouts', 'View Payouts', NULL, NULL),
(12, 'manage_amenities', 'Manage Amenities', 'Manage Amenities', NULL, NULL),
(13, 'manage_pages', 'Manage Pages', 'Manage Pages', NULL, NULL),
(14, 'manage_reviews', 'Manage Reviews', 'Manage Reviews', NULL, NULL),
(15, 'view_reports', 'View Reports', 'View Reports', NULL, NULL),
(16, 'general_setting', 'Settings', 'Settings', NULL, NULL),
(17, 'preference', 'Preference', 'Preference', NULL, NULL),
(18, 'manage_banners', 'Manage Banners', 'Manage Banners', NULL, NULL),
(19, 'starting_cities_settings', 'Starting Cities Settings', 'Starting Cities Settings', NULL, NULL),
(20, 'manage_property_type', 'Manage Property Type', 'Manage Property Type', NULL, NULL),
(21, 'space_type_setting', 'Space Type Setting', 'Space Type Setting', NULL, NULL),
(22, 'manage_bed_type', 'Manage Bed Type', 'Manage Bed Type', NULL, NULL),
(23, 'manage_currency', 'Manage Currency', 'Manage Currency', NULL, NULL),
(24, 'manage_country', 'Manage Country', 'Manage Country', NULL, NULL),
(25, 'manage_amenities_type', 'Manage Amenities Type', 'Manage Amenities Type', NULL, NULL),
(26, 'email_settings', 'Email Settings', 'Email Settings', NULL, NULL),
(27, 'manage_fees', 'Manage Fees', 'Manage Fees', NULL, NULL),
(28, 'manage_language', 'Manage Language', 'Manage Language', NULL, NULL),
(29, 'manage_metas', 'Manage Metas', 'Manage Metas', NULL, NULL),
(30, 'api_informations', 'Api Credentials', 'Api Credentials', NULL, NULL),
(31, 'payment_settings', 'Payment Settings', 'Payment Settings', NULL, NULL),
(32, 'social_links', 'Social Links', 'Social Links', NULL, NULL),
(33, 'manage_roles', 'Manage Roles', 'Manage Roles', NULL, NULL),
(34, 'database_backup', 'Database Backup', 'Database Backup', NULL, NULL);
(35, 'manage_sms', 'Manage SMS', 'Manage SMS', NULL, NULL);
(36, 'manage_messages', 'Manage Messages', 'Manage Messages', NULL, NULL);
(37, 'edit_messages', 'Edit Messages', 'Edit Messages', NULL, NULL);


--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1);
(35, 1);
(36, 1);
(37, 1);

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `url_name`, `host_id`, `bedrooms`, `beds`, `bed_type`, `bathrooms`, `amenities`, `property_type`, `space_type`, `accommodates`, `booking_type`, `cancellation`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Beautiful overview of Central Park', NULL, 1, 2, 4, 1, 3.00, '2,4,6,7,27,29', 1, 2, 2, 'instant', 'Flexible', 'Listed', NULL, '2018-04-11 13:28:14', '2018-04-11 13:39:51'),
(2, 'France\'s gift to America-Statue of Liberty', NULL, 1, 2, 2, 1, 2.00, '6,7,15,27', 5, 2, 1, 'instant', 'Flexible', 'Listed', NULL, '2018-04-11 13:53:16', '2018-04-11 14:03:34'),
(3, 'Time square Evening  View- Hotel Hyatt', NULL, 1, 1, 1, 1, 0.50, '3,14,15,17,19,20,21,27', 1, 1, 1, 'request', 'Flexible', 'Listed', NULL, '2018-04-11 14:18:26', '2018-04-11 14:53:33'),
(4, 'Entire home/apt in Paris', NULL, 1, 1, 1, 1, 0.50, '1,4,7,30,31', 17, 1, 1, 'instant', 'Flexible', 'Listed', NULL, '2018-04-11 14:55:37', '2018-04-11 15:01:56'),
(5, 'City of Light meets city of sin at Paris Las Vegas', NULL, 1, 1, 1, 1, 0.50, '2,7,8,27,31', 1, 1, 1, 'request', 'Flexible', 'Listed', NULL, '2018-04-11 15:05:28', '2018-04-11 15:08:49'),
(6, 'Entire home/apt in Zürich', NULL, 1, 1, 1, 1, 0.50, '1,8,21,29,30', 1, 1, 1, 'instant', 'Flexible', 'Listed', NULL, '2018-04-11 15:13:30', '2018-04-11 15:20:53'),
(7, 'Entire home/apt in Lausanne', NULL, 1, 1, 1, 1, 0.50, '3,29,30', 1, 1, 1, 'request', 'Flexible', 'Listed', NULL, '2018-04-11 15:59:59', '2018-04-11 16:04:03'),
(8, 'Entire home/apt in Barcelona', NULL, 1, 1, 1, 1, 0.50, NULL, 1, 1, 1, 'request', 'Flexible', 'Unlisted', NULL, '2018-04-11 16:09:27', '2018-04-11 16:15:50'),
(9, 'Entire home/apt in ', NULL, 1, 2, 2, 1, 2.00, NULL, 1, 1, 1, 'request', 'Flexible', 'Unlisted', NULL, '2018-04-11 16:14:35', '2018-04-11 16:14:45'),
(10, 'Entire home/apt in', NULL, 1, 1, 1, 1, 0.50, NULL, 1, 1, 1, 'request', 'Flexible', 'Unlisted', NULL, '2018-04-11 17:39:28', '2018-04-11 17:41:54'),
(11, 'Brooklyn Bridge-New York', NULL, 1, 1, 1, 1, 0.50, '2,4,5,7,15,27', 1, 1, 1, 'request', 'Flexible', 'Listed', NULL, '2018-04-12 14:03:10', '2018-04-12 14:07:33'),
(12, 'Metropolitan Museum New York', NULL, 1, 2, 2, 4, 2.00, '4,28', 1, 1, 2, 'instant', 'Flexible', 'Listed', NULL, '2018-04-12 15:39:44', '2018-04-12 15:43:56'),
(13, 'Entire home/apt in Tambon Nong Chaeng', NULL, 3, 1, 1, 1, 0.50, '2,3,6,7,8,27,30', 1, 1, 2, 'instant', 'Flexible', 'Listed', NULL, '2018-04-12 15:56:43', '2018-04-12 15:58:52'),
(14, 'Entire home/apt in Sydney', NULL, 3, 1, 1, 1, 0.50, '1,2,3,4,6,7,17,18,19,21,24,27', 1, 1, 1, 'instant', 'Flexible', 'Listed', NULL, '2018-04-12 16:07:14', '2018-04-12 16:14:22'),
(15, 'Australian National Maritime Museum-Sydney', NULL, 3, 1, 1, 1, 0.50, '3', 1, 1, 1, 'instant', 'Flexible', 'Listed', NULL, '2018-04-12 16:17:29', '2018-04-12 16:27:39'),
(16, 'Entire home/apt in Sydney', NULL, 3, 1, 1, 1, 0.50, '4,5,6,7,27,30,31', 1, 2, 1, 'instant', 'Flexible', 'Listed', NULL, '2018-04-12 16:28:41', '2018-04-12 16:34:37'),
(17, 'Entire home/apt in Barcelona', NULL, 3, 1, 1, 1, 0.50, '2', 1, 1, 6, 'instant', 'Flexible', 'Listed', NULL, '2018-04-12 16:48:52', '2018-04-12 17:10:14');

-- --------------------------------------------------------
--
-- Dumping data for table `property_address`
--

INSERT INTO `property_address` (`id`, `property_id`, `address_line_1`, `address_line_2`, `latitude`, `longitude`, `city`, `state`, `country`, `postal_code`) VALUES
(1, 1, '422 Greenwich St, New York, NY 10013, USA', NULL, '40.7219357', '-74.0098003', 'New York', 'New York', 'US', '10013'),
(2, 2, '1 Liberty Island - Ellis Island, New York, NY 10004, USA', NULL, '40.6892494', '-74.0445004', 'New York', 'New York', 'US', '10004'),
(3, 3, 'New York City Hall, 11 Centre St, New York, NY 10007, USA', NULL, '40.7127753', '-74.0059728', 'New York', 'New York', 'US', '10007'),
(4, 4, 'Hôtel de Ville, 75004 Paris, France', NULL, '48.85661400000001', '2.3522219000000177', 'Paris', 'Île-de-France', 'FR', '75004'),
(5, 5, 'Paris , Île-de-France , France', NULL, '48.8583698', '2.2944833000000244', 'Paris', 'Île-de-France', 'FR', '75007'),
(6, 6, 'switzerland', NULL, '46.2049398', '6.14230120000002', 'Genève', 'Genève', 'CH', '1204'),
(7, 7, 'Unnamed Road, 6072 Sachseln, Switzerland', NULL, '46.818188', '8.227511999999933', 'Sachseln', 'Obwalden', 'CH', '6072'),
(8, 8, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL),
(9, 9, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL),
(10, 10, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL),
(11, 11, 'New York City Hall, 11 Centre St, New York, NY 10007, USA', NULL, '40.7127753', '-74.0059728', 'New York', 'New York', 'US', '10007'),
(12, 12, '20 Washington Square N, New York, NY 10012, USA', NULL, '40.73082279999999', '-73.99733200000003', 'New York', 'New York', 'US', '10012'),
(13, 13, '1 Dinso Rd, Khwaeng Wat Bowon Niwet, Khet Phra Nakhon, Krung Thep Maha Nakhon 10200, Thailand', NULL, '13.7563309', '100.50176510000006', 'กทม', 'Krung Thep Maha Nakhon', 'TH', '10200'),
(14, 14, 'MLC Centre, Sydney NSW 2000, Australia', NULL, '-33.8567844', '151.21529669999995', 'Sydney', 'New South Wales', 'AU', '2000'),
(15, 15, 'MLC Centre, Sydney NSW 2000, Australia', NULL, '-33.8688197', '151.20929550000005', 'Sydney', 'New South Wales', 'AU', '2000'),
(16, 16, 'MLC Centre, Sydney NSW 2000, Australia', NULL, '-33.8688197', '151.20929550000005', 'Sydney', 'New South Wales', 'AU', '2000'),
(17, 17, 'Carrer de la Canuda, 45, 08002 Barcelona, Spain', NULL, '41.38506389999999', '2.1734034999999494', 'Barcelona', 'Catalunya', 'ES', '08002');

-- --------------------------------------------------------
--
-- Dumping data for table `property_dates`
--

-- INSERT INTO `property_dates` (`id`, `property_id`, `status`, `price`, `date`, `created_at`, `updated_at`) VALUES
-- (1, 1, 'Available', 9, CURDATE()+30, '2018-04-11 13:37:36', '2018-04-11 13:37:36'),
-- (2, 7, 'Available', 5, CURDATE()+30, '2018-04-11 16:04:16', '2018-04-11 16:04:16'),
-- (3, 7, 'Available', 5, CURDATE()+30, '2018-04-11 16:04:26', '2018-04-11 16:04:26'),
-- (4, 2, 'Available', 0, CURDATE()+30, '2018-04-11 16:24:48', '2018-04-11 16:24:48'),
-- (5, 2, 'Available', 0, CURDATE()+30, '2018-04-11 16:24:48', '2018-04-11 16:24:48'),
-- (6, 3, 'Available', 0, CURDATE()+30, '2018-04-11 17:04:47', '2018-04-11 17:04:47'),
-- (7, 3, 'Available', 0, CURDATE()+30, '2018-04-11 17:04:47', '2018-04-11 17:04:47'),
-- (8, 3, 'Available', 0, CURDATE()+30, '2018-04-11 17:04:47', '2018-04-11 17:04:47'),
-- (9, 4, 'Available', 0, CURDATE()+30, '2018-04-11 17:50:13', '2018-04-11 17:50:13'),
-- (10, 4, 'Available', 0, CURDATE()+30, '2018-04-11 17:50:13', '2018-04-11 17:50:13'),
-- (11, 4, 'Available', 0, CURDATE()+30, '2018-04-11 17:50:13', '2018-04-11 17:50:13'),
-- (19, 11, 'Available', 10, CURDATE()+30, '2018-04-12 14:08:08', '2018-04-12 14:08:08'),
-- (20, 11, 'Available', 10, CURDATE()+30, '2018-04-12 14:08:21', '2018-04-12 14:08:21'),
-- (21, 11, 'Available', 10, CURDATE()+30, '2018-04-12 14:08:21', '2018-04-12 14:08:21'),
-- (24, 2, 'Available', 0, CURDATE()+30, '2018-04-12 15:01:15', '2018-04-12 15:01:15'),
-- (25, 2, 'Available', 0, CURDATE()+30, '2018-04-12 15:01:15', '2018-04-12 15:01:15'),
-- (26, 6, 'Available', 0, CURDATE()+30, '2018-04-12 15:08:02', '2018-04-12 15:08:02'),
-- (27, 17, 'Available', 10, CURDATE()+30, '2018-04-12 18:03:40', '2018-04-12 18:03:40'),
-- (28, 17, 'Available', 10, CURDATE()+30, '2018-04-12 18:03:49', '2018-04-12 18:03:49');

-- --------------------------------------------------------

--
-- Dumping data for table `property_description`
--

INSERT INTO `property_description` (`id`, `property_id`, `summary`, `place_is_great_for`, `about_place`, `guest_can_access`, `interaction_guests`, `other`, `about_neighborhood`, `get_around`) VALUES
(1, 1, 'Located in Times Square, this Manhattan hotel is within 7 minutes’ walk of Rockefeller Center and Radio City Music Hall. Guests can enjoy the convenience of a concierge service and on-site dining.\r\nServing traditional American cuisine with views of Times Square, the Brasserie 1605 prepares breakfast, lunch and dinner. Guests at the Times Square Crowne Plaza can also have drinks at the Broadway 49 Bar.', 'The Central Park Zoo features more than 100 species of animals from the tropics, polar regions, and the California Coast. An equatorial rain forest houses monkeys and free-flying birds while penguins inhabit the Arctic section. Other animal highlights include polar bears, snow leopards, and red pandas. Near the entrance is the charming Delacorte Clock, where bronze musical animals encircle the time piece and play nursery chimes every half-hour.', 'A walk, peddle, or carriage ride through the crisscrossing pathways of Central Park is a must-do on anyone\'s New York City itinerary. In winter, you can even lace up your skates and glide across Wollman Rink. This huge park in the city center, a half-mile wide and 2.5 miles long, is one of the things that makes New York such a beautiful and livable city. Besides being a great place to experience a little nature, Central Park has many attractions within its borders, including the Belvedere Castle, Strawberry Fields, the Central Park Zoo, and the Lake', NULL, NULL, NULL, 'Located within Central Park, Strawberry Fields is a memorial for John Lennon, who was tragically murdered in front of the Dakota apartments just off the west side of the park. A mosaic is set in the pathway with the word \"Imagine\" inscribed, named after Lennon\'s 1971 song. The landscape was designed by Vaux and Olmstead and features 161 species of plants (one from every country in the world).', NULL),
(2, 2, 'At the crossroads of Tribeca and the Financial District, just a block from the World Trade Center, Four Seasons Hotel New York Downtown adds its classic architectural profile to the world’s most famous skyline. Discover a New York luxury hotel with Downtown’s creativity and confidence, surrounded by the non-stop, dynamic scenes of the new New York.', 'On a tour to the Statue of Liberty, you have the option to stop at Ellis Island and explore the Immigration Museum. This fantastic museum is located in the historic immigration station complex, where thousands of immigrants were processed before entering the United States. Displays focus on the process, the experiences, and the stories of the people who came through here on their journey to the United States. You can even search the on-site computer database to see a record of immigrants who came through here.', 'The Statue of Liberty was France\'s gift to America. Built in 1886, it remains a famous world symbol of freedom and one of the greatest American icons. It is one of the world\'s largest statues, standing just under 152 feet tall from the base to the torch, and weighing approximately 450,000 pounds.\r\nYou can see the statue from land, with particularly good views from Battery Park, on the southern tip of Manhattan. However, to truly appreciate the Statue of Liberty, it\'s best to take a short boat trip to Liberty Island and see it up close. You can walk around the base, enter the pedestal, or, with advance reservations, go right up to the crown.', NULL, 'Tickets to go inside the statue sell out. Pre-purchasing tickets is a must during the high season and a good idea at any time of year. The Statue of Liberty and Ellis Island Guided Tour is a three-hour trip that takes you to both the Statue of Liberty and Ellis Island. Note: Buying tickets at the ferry can be tricky, with hawkers claiming to be \"official representatives\" trying to sell you more expensive tickets before you can find the ticket booth.', NULL, NULL, NULL),
(3, 3, 'It may be hard to believe, but when it officially opens today, the Park Hyatt New York will be the first five-star hotel to debut in Gotham in over a decade. Indeed, ever since the opening of the nearby Mandarin-Oriental in 2003, New York has been awash in small-scale, chic-boutiques rather than pricey, full-service grand-dames. But as it opens today, the Park Hyatt intends to return the City’s hotel culture back to its high-glamour— and high-priced — roots.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 'Set in the trendy Oberkampf quarter, this hip, no-frills hotel is a 5-minute walk from Ménilmontant metro station, 9 minutes from the Parc de Belleville, and 1.6 km from Père Lachaise Cemetery.\r\n\r\nThe bright, casual rooms are accessed by stairs only, and feature free Wi-Fi and flat-screen TVs, as well as minibars, and tea and coffeemaking equipment. Family rooms add extra beds.\r\n\r\nContinental breakfast is free. There are coin-operated laundry facilities available for a surcharge.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, 'The City of Light meets the city of sin at Paris Las Vegas. The centrally-located Parisian-themed hotel boasts a replica Eiffel Tower, a mock Arc de Triomphe and French restaurants mixed with a Las Vegas-style nightclub and shows.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, 'Offering luxury guest rooms, the lovely Boutique Hotel Wellenberg lies within a 5-minute walk from Town Hall . Residing in a 5-story historical building, the hotel was renovated in 2009.The property is about 550 meters away from Paradeplatz. Nestled in the museum district and 1 km from the city center.\r\n\r\nA shopping street and boutiques are also set close by.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, 'Elegant and authentic, Beau-Rivage is an exceptional house, with its incredible view on the iconic Jet d\'Eau, the lake, the Mont-Blanc, the snowy summits and the city. Through its history, contribute to extend the list of extraordinary personalities who have stayed at Beau-Rivage.\r\n\r\nWith its humanity and attention to detail, together we will make your stay unique.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 8, 'Located on Paral·lel Avenue, where long tradition theaters come together with the trendiest restaurants in the city, Hotel Barcelona Universal is just 5 minutes away from Barcelona\'s emblematic promenade that connects Plaza Catalunya to the port.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 10, 'Hotel details\r\nIn Bangkok\'s vibrant Pratunam area, this upscale contemporary hotel is 9 minutes from the CentralWorld shopping mall, and 6 km from Wat Phra Kaew temple. \r\n\r\nFeaturing city, garden or pool views, the warm rooms come with free Wi-Fi, flat-screen TVs and DVD players, as well as tea and coffeemakers, minifridges and safes. Suites add whirlpool tubs. Club rooms have access to a private lounge offering free breakfast and cocktails.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 11, 'Discover a destination at once bohemian, sophisticated and inspiring. SIXTY SoHo hotel mirrors its stylish surroundings, standing as an inimitable hotel in one of New York City’s most vibrant neighborhoods. Stay in big city style, relax in newly renovated guestrooms and suites, and imbibe at stunning spaces at this upscale SoHo hotel.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 12, 'Located in Chelsea, Hotel Pennsylvania is within a 5-minute walk of  Penn Station and within 15 minutes of other popular attractions like Macy\'s. This 1705-room hotel has a restaurant along with conveniences like a fitness center and a 24-hour business center. Centrally located in New York, the hotel is also a short walk from Empire State Building and Times Square', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 13, 'In Bangkok\'s vibrant Pratunam area, this upscale contemporary hotel is 9 minutes from the CentralWorld shopping mall, and 6 km from Wat Phra Kaew temple. \r\n\r\nFeaturing city, garden or pool views, the warm rooms come with free Wi-Fi, flat-screen TVs and DVD players, as well as tea and coffeemakers, minifridges and safes. Suites add whirlpool tubs. Club rooms have access to a private lounge offering free breakfast and cocktails.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 14, 'Set amid the pubs and craft shops of The Rocks district, this industrial-chic hotel in a redbrick 1887 building, is a 5-minute walk from Circular Quay train station and a 15-minute walk from both Sydney Opera House and Sydney Harbour Bridge.\r\n\r\nFeaturing bold fabrics, the chic rooms and suites have free Wi-Fi, flat-screens, minibars, room service, and tea and coffeemakers. Upgraded rooms add iPod docks, sitting areas and/or sofabeds, while some suites offer harbour views.', NULL, 'The Sydney Opera House, a world-class performing arts venue and iconic Australian landmark, defines the Sydney Harbour in the heart of the city. Designed by Danish architect Jorn Utzon, the structure is a masterpiece of late 20th-century architecture, despite challenges that plagued the 15-year project before it was formally opened by Queen Elizabeth II in 1973. Distinguished by soaring halls with a white ceramic-tiled exterior shaped to evoke the sails of a yacht, this UNESCO World Heritage Site is a must-see Sydney attraction.', NULL, NULL, NULL, NULL, NULL),
(15, 15, 'Set in the Central Business District, this sophisticated hotel is a 5-minute walk from Wynyard train station and 1.5 km from the Sydney Opera House. \r\n\r\nThe warm polished apartments feature paid Wi-Fi, flat-screen TVs, and minibars. All also offer kitchens, washer/dryers and room service, and some have balconies. Upgraded apartments add sofabeds, and there\'s also a 3-bedroom penthouse apartment with a whirlpool bath and a terrace.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 16, 'This bright and modern hotel, set in the Central Business District, is across the street from Hyde Park and a 7-minute walk from Town Hall railway station. It’s also 2.4 km from the Sydney Opera House.\r\n\r\nThe colourful rooms feature free Wi-Fi, flat-screen TVs with DVD players, and tea and coffeemaking equipment. Upgraded rooms add microwaves, minifridges, wet bars and sitting areas; some add private balconies and park views. The 2-bedroom apartments feature full kitchens.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 17, 'Set in the 22@ business district, this modern hotel is a 5-minute walk from the Llacuna metro station and 1.9 km from Mar Bella beach. \r\n\r\nColorful rooms come with complimentary Wi-Fi, flat-screen TVs, and coffeemakers. Upgraded rooms add pull-out sofas. Kids 18 and under stay free with a parent.\r\n\r\nBreakfast is served in a contemporary dining room for a fee. There\'s also a bar, a business center and a meeting room.', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Dumping data for table `property_fees`
--

INSERT INTO `property_fees` (`id`, `field`, `value`) VALUES
(1, 'more_then_seven', '5'),
(2, 'less_then_seven', '5'),
(3, 'host_service_charge', '0'),
(4, 'guest_service_charge', '5'),
(5, 'cancel_limit', '0'),
(6, 'currency', 'USD'),
(7, 'host_penalty', '0');

-- --------------------------------------------------------

--
-- Dumping data for table `property_photos`
--

INSERT INTO `property_photos` (`id`, `property_id`, `photo`, `message`, `cover_photo`, `serial`) VALUES
(2, 1, '1523428499_43289202.jpg', NULL, 0, 2),
(3, 1, '1523428511_89826496.jpg', NULL, 0, 3),
(4, 1, '1523428522_43289251.jpg', NULL, 0, 4),
(5, 1, '1523428546_43289305.jpg', NULL, 0, 5),
(6, 1, '1523429218_crowne-plaza-jamaica-2589646442-2x1.jpg', NULL, 1, 6),
(7, 2, '1523430028_Property-FourSeasonsHotelNewYorkDowntown-Hotel-GuestroomSuite-RoyalSuiteDiningArea-FourSeasonsHotelsLimited.jpg', NULL, 1, 1),
(19, 2, '1523430750_four-seasons-hotel-new-york-downtown_5a1e97058efda.jpg', NULL, 0, 3),
(20, 2, '1523430777_hotel-bathrooms-around-the-world-that-are-bigger-than-your-bathroom-large-four-seasons-hotel-l-cf7c00a31f146ef9.jpg', NULL, 0, 3),
(22, 2, '1523430857_four-seasons-hotel-new-york-downtown_5a1e97058efda.jpg', NULL, 0, 5),
(24, 2, '1523430957_Four-Seasons-Hotel-New-York.jpg', NULL, 0, 5),
(25, 3, '1523431422_ie_hyatt_andaz_palm_springs_rendering.jpg', NULL, 1, 1),
(26, 3, '1523431431_cambria-dbl.jpg', NULL, 0, 2),
(27, 3, '1523431439_hotel-new-york-park-hyatt-spa-lounge.jpg', NULL, 0, 3),
(28, 3, '1523431461_p19140h20i1mj91uid1djij2s1r8r41.jpg', NULL, 0, 4),
(29, 3, '1523431483_who97502gr12.jpg', NULL, 0, 5),
(30, 4, '1523433599_maxresdefault.jpg', NULL, 1, 1),
(31, 4, '1523433609_4cc673c4-b370-40bf-ac59-e39ade71c161.jpg', NULL, 0, 2),
(32, 4, '1523433624_bellagio-hotel-salone-suite-bed.tif.jpg', NULL, 0, 3),
(33, 4, '1523433674_Hotels-private-pool-Las-Vegas-Bellagio2.jpg', NULL, 0, 4),
(34, 4, '1523433687_140596_216_z.jpg', NULL, 0, 5),
(35, 5, '1523434041_Las-Vegas-Hotels.jpg', NULL, 1, 1),
(36, 5, '1523434055_Executive-Suite-Living-Room-FINAL.jpg', NULL, 0, 2),
(37, 5, '1523434067_6-1200x900.jpg', NULL, 0, 3),
(38, 5, '1523434078_las-vegas-suite-cityscape-suite.jpg', NULL, 0, 4),
(39, 5, '1523434097_hotel-room-opt.jpg', NULL, 0, 5),
(40, 6, '1523434661_zrhdt-studio-0191-hor-feat.jpg', NULL, 1, 1),
(41, 6, '1523434691_6a0128763ee05d970c01b7c7673976970b.jpg', NULL, 0, 2),
(42, 6, '1523434712_00028506_m.jpg', NULL, 0, 3),
(43, 6, '1523434727_zurich-marriott-hotel-17_4822.jpg', NULL, 0, 4),
(44, 7, '1523437368_2012Apr-Exploring-Geneva-index.jpg', NULL, 1, 1),
(45, 7, '1523437381_117a93f7c6ea8761035a920430b09030.jpg', NULL, 0, 2),
(46, 7, '1523437391_hotel-beau-rivage-room.jpg', NULL, 0, 3),
(47, 7, '1523437404_rooms-deluxe-room-1300x720.jpg', NULL, 0, 4),
(48, 7, '1523437418_luxury_hotels_in_lausanne_beau_rivage_palace_junior_suite_living-942.jpg', NULL, 0, 5),
(49, 11, '1523516744_15850998750_c204bb3d34_k_d.0.jpg', NULL, 0, 1),
(50, 11, '1523516763_AG1447_SIXTYSOHO_SHOT9-e1500388487251.jpg', NULL, 0, 2),
(51, 11, '1523516772_bedroom-boutique-city-modern.jpg', NULL, 0, 3),
(52, 11, '1523516801_hotelhugo.png', NULL, 1, 4),
(53, 12, '1523522542_leonardo-1253861-bg-exterior-night2-2_S-image.jpg', NULL, 1, 1),
(54, 12, '1523522551_12887_134_z.jpg', NULL, 0, 2),
(55, 12, '1523522561_57330112.jpg', NULL, 0, 3),
(56, 12, '1523522570_67384088.jpg', NULL, 0, 4),
(57, 12, '1523522580_Penn-5000-Club-Single-1024x683.jpg', NULL, 0, 5),
(58, 12, '1523522590_New-York-Hotel-Edison-the-rum-house-900x400px.jpg', NULL, 0, 6),
(59, 13, '1523523486_240229_14080521030020700086.jpg', NULL, 1, 1),
(60, 14, '1523524372_1.jpeg', NULL, 1, 1),
(61, 14, '1523524387_2.jpg', NULL, 0, 2),
(62, 14, '1523524424_3.jpg', NULL, 0, 3),
(63, 15, '1523524708_3.jpg', NULL, 0, 1),
(64, 15, '1523525093_img1.jpg', NULL, 1, 2),
(65, 15, '1523525129_img2.jpg', NULL, 0, 3),
(66, 15, '1523525150_img3.jpg', NULL, 0, 4),
(67, 16, '1523525610_22.jpg', NULL, 0, 1),
(68, 16, '1523525622_33.jpg', NULL, 1, 2),
(69, 16, '1523525647_44.jpg', NULL, 0, 3),
(70, 17, '1523527743_holiday.jpg', NULL, 1, 1),
(71, 17, '1523527761_holiday-inn-express-barcelona-2531990657-2x1.jpg', NULL, 0, 2),
(72, 17, '1523527783_hotel-indigo-barcelona-4512483595-2x1.jpg', NULL, 0, 3),
(75, 13, '1556783929_1521786119_cleopatra-palace-hotel-mare-nostrum-resort-1.jpg', NULL, 0, 2),
(76, 13, '1556783964_1521786112_masthead-the-charles-hotel-harvard-square.jpg', NULL, 0, 3);

-- --------------------------------------------------------

--
-- Dumping data for table `property_price`
--

INSERT INTO `property_price` (`id`, `property_id`, `cleaning_fee`, `guest_after`, `guest_fee`, `security_fee`, `price`, `weekend_price`, `weekly_discount`, `monthly_discount`, `currency_code`) VALUES
(1, 1, 5, 1, 5, 2, 10, 0, 0, 0, 'USD'),
(2, 2, 1, 1, 2, 0, 12, 0, 0, 0, 'USD'),
(3, 3, 3, 1, 0, 0, 5, 0, 0, 0, 'USD'),
(4, 4, 0, 1, 0, 0, 5, 0, 0, 0, 'EUR'),
(5, 5, 0, 1, 0, 0, 5, 0, 0, 0, 'USD'),
(6, 6, 0, 1, 0, 0, 5, 0, 0, 0, 'CHF'),
(7, 7, 0, 1, 0, 0, 5, 0, 0, 0, 'USD'),
(8, 8, 0, 0, 0, 0, 0, 0, 0, 0, 'USD'),
(9, 9, 0, 0, 0, 0, 0, 0, 0, 0, 'USD'),
(10, 10, 0, 0, 0, 0, 0, 0, 0, 0, 'USD'),
(11, 11, 0, 1, 7, 0, 10, 0, 0, 0, 'USD'),
(12, 12, 2, 1, 0, 0, 10, 15, 0, 0, 'EUR'),
(13, 13, 0, 1, 0, 0, 5, 10, 0, 0, 'THB'),
(14, 14, 0, 1, 0, 0, 6, 10, 0, 0, 'MXN'),
(15, 15, 0, 1, 0, 0, 5, 0, 0, 0, 'USD'),
(16, 16, 0, 1, 0, 0, 7, 0, 0, 0, 'USD'),
(17, 17, 0, 1, 0, 0, 10, 12, 0, 0, 'USD');

-- --------------------------------------------------------

--
-- Dumping data for table `property_steps`
--

INSERT INTO `property_steps` (`id`, `property_id`, `basics`, `description`, `location`, `photos`, `pricing`, `booking`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 1, 1, 1),
(3, 3, 1, 1, 1, 1, 1, 1),
(4, 4, 1, 1, 1, 1, 1, 1),
(5, 5, 1, 1, 1, 1, 1, 1),
(6, 6, 1, 1, 1, 1, 1, 1),
(7, 7, 1, 1, 1, 1, 1, 1),
(8, 8, 1, 1, 0, 0, 0, 0),
(9, 9, 1, 0, 0, 0, 0, 0),
(10, 10, 1, 1, 0, 0, 0, 0),
(11, 11, 1, 1, 1, 1, 1, 1),
(12, 12, 1, 1, 1, 1, 1, 1),
(13, 13, 1, 1, 1, 1, 1, 1),
(14, 14, 1, 1, 1, 1, 1, 1),
(15, 15, 1, 1, 1, 1, 1, 1),
(16, 16, 1, 1, 1, 1, 1, 1),
(17, 17, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`id`, `name`, `description`, `status`) VALUES
(1, 'Apartment', 'Apartment', 'Active'),
(2, 'House', 'House', 'Active'),
(3, 'Bed & Break Fast', 'Bed & Break Fast', 'Active'),
(5, 'Townhouse', 'Townhouse', 'Active'),
(6, 'Condominium', 'Condominium', 'Active'),
(7, 'Bungalow', 'Bungalow', 'Active'),
(8, 'Cabin', 'Cabin', 'Active'),
(9, 'Villa', 'Villa', 'Active'),
(10, 'Castle', 'Castle', 'Active'),
(11, 'Dorm', 'Dorm', 'Active'),
(12, 'Treehouse', 'Treehouse', 'Active'),
(13, 'Boat', 'Boat', 'Active'),
(14, 'Plane', 'Plane', 'Active'),
(15, 'Camper/RV', 'Camper/RV', 'Active'),
(16, 'Lgloo', 'Lgloo', 'Active'),
(17, 'Lighthouse', 'Lighthouse', 'Active'),
(18, 'Yurt', 'Yurt', 'Active'),
(19, 'Tipi', 'Tipi', 'Active'),
(20, 'Cave', 'Cave', 'Active'),
(21, 'Island', 'Island', 'Active'),
(22, 'Chalet', 'Chalet', 'Active'),
(23, 'Earth House', 'Earth House', 'Active'),
(24, 'Hut', 'Hut', 'Active'),
(25, 'Train', 'Train', 'Active'),
(26, 'Tent', 'Tent', 'Active'),
(27, 'Other', 'Other', 'Active');


--
-- Dumping data for table `reviews`
--

-- INSERT INTO `reviews` (`id`, `sender_id`, `receiver_id`, `booking_id`, `property_id`, `reviewer`, `message`, `secret_feedback`, `comments`, `improve_message`, `rating`, `accuracy`, `accuracy_message`, `location`, `location_message`, `communication`, `communication_message`, `checkin`, `checkin_message`, `cleanliness`, `cleanliness_message`, `amenities`, `amenities_message`, `value`, `value_message`, `house_rules`, `recommend`, `created_at`, `updated_at`) VALUES
-- (1, 1, 2, 1, 2, 'host', 'Dear Guest,\nHope so it was a nice tour with your family and you liked our accommodation too.\n\n Thank you for visiting', 'Hello,\nHope so it was a nice tour with your family and you liked our accommodation too.  \n\n Thank you for visiting', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, 3, 1, '2018-04-12 18:43:58', '2018-04-15 12:52:10'),
-- (2, 2, 1, 1, 2, 'guest', 'The apartment was in a great location, friendly helpful host. He arranged for us to stash our bags on arrival before place was ready for us. foods was so tasty and in dinner there was an special menu that was really good.Overall it was a nice trips .\nThank you.', NULL, 'Have not that much issue about your apartment instead of air condition problem. Have a little look on it.\n\nThank you.', NULL, 4, 3, NULL, 4, NULL, 5, NULL, 5, 'They were really good as much we didn\'t expect!', 3, NULL, 5, NULL, 2, NULL, NULL, 1, '2018-04-12 18:51:22', '2018-04-15 13:11:01'),
-- (3, 1, 2, 8, 6, 'host', 'Dear Guest,\nThank you for visiting our apartment.', 'Had a nice trips?', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, 3, 1, '2018-04-15 13:14:07', '2018-04-15 13:14:34');

-- --------------------------------------------------------

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin User', NULL, NULL);

-- --------------------------------------------------------

--
-- Dumping data for table `role_admin`
--

INSERT INTO `role_admin` (`admin_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `message`, `status`) VALUES
(1, 'Suitable for children (2-12 years)', 'Active'),
(2, 'Suitable for infants (Under 2 years)', 'Active'),
(3, 'Suitable for pets', 'Active'),
(4, 'Smoking allowed', 'Active'),
(5, 'Events or parties allowed', 'Active');

-- --------------------------------------------------------

--
-- Dumping data for table `seo_metas`
--

INSERT INTO `seo_metas` (`id`, `url`, `title`, `description`, `keywords`) VALUES
(1, '/', 'Home | Vrent Home', 'Vacation Rental Marketplace', 'vrent'),
(2, 'login', 'Log In', 'Log In', ''),
(3, 'register', 'Register', 'Register', ''),
(4, 'newest', 'Newest Photos', 'Newest Photos', ''),
(5, 'forgot_password', 'Forgot Password', 'Forgot Password', ''),
(6, 'dashboard', 'Feeds', 'Feeds', ''),
(7, 'uploads', 'Uploads', 'Uploads', ''),
(8, 'notification', 'Notification', 'Notification', ''),
(9, 'profile', 'Profile', 'Profile', ''),
(10, 'profile/{id}', 'Profile', 'Profile', ''),
(11, 'manage-photos', 'Manage Photos', 'Manage Photos', ''),
(12, 'earning', 'Earning', 'Earning', ''),
(13, 'purchase', 'Purchase', 'Purchase', ''),
(14, 'settings', 'Settings', 'Settings', ''),
(15, 'settings/account', 'Settings', 'Settings', ''),
(16, 'settings/payment', 'Settings', 'Settings', ''),
(17, 'photo/single/{id}', 'Photo Single', 'Photo Single', ''),
(18, 'payments/success', 'Payment Success', 'Payment Success', ''),
(19, 'payments/cancel', 'Payment Cancel', 'Payment Cancel', ''),
(20, 'profile-uploads/{type}', 'Profile Uploads', 'Profile Uploads', ''),
(21, 'photo-details/{id}', 'Photo Details', 'Photo Details', ''),
(22, 'withdraws', 'Withdraws', 'Withdraws', ''),
(23, 'photos/download/{id}', 'Photos Download', 'Photos Download', ''),
(24, 'users/reset_password/{secret?}', 'Reset Password', 'Reset Password', ''),
(25, 'search/{word}', 'Search Result', 'Search Result', ''),
(26, 'search/user/{word}', 'Search User Result', 'Search User Result', ''),
(27, 'signup', 'Signup', 'Signup', ''),
(28, 'property/create', 'Create New Property', 'Create New Property', ''),
(29, 'listing/{id}/{step}', 'Property Listing', 'Property Listing', ''),
(30, 'properties', 'Properties', 'Properties', ''),
(31, 'my_bookings', 'My Bookings', 'My Bookings', ''),
(32, 'trips/active', 'Your Trips', 'Your Trips', ''),
(33, 'users/profile', 'Edit Profile', 'Edit Profile', ''),
(34, 'users/account_preferences', 'Account Preferences', 'Account Preferences', ''),
(35, 'users/transaction_history', 'Transaction History', 'Transaction History', ''),
(36, 'users/security', 'Security', 'Security', ''),
(37, 'search', 'Search', 'Search', ''),
(38, 'inbox', 'Inbox', 'Inbox', ''),
(39, 'users/profile/media', 'Profile Photo', 'Profile Photo', ''),
(40, 'booking/requested', 'Payment Completed', 'Payment Completed', '');

-- --------------------------------------------------------

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `type`) VALUES
(1, 'name', 'Vrent', 'general'),
(2, 'logo', 'logo.png', 'general'),
(3, 'favicon', 'favicon.ico', 'general'),
(4, 'head_code', '', 'general'),
(5, 'default_currency', '1', 'general'),
(6, 'default_language', '1', 'general'),
(7, 'email_logo', 'email_logo.png', 'general'),
(8, 'username', 'techvillage_business_api1.gmail.com', 'PayPal'),
(9, 'password', '9DDYZX2JLA6QL668', 'PayPal'),
(10, 'signature', 'AFcWxV21C7fd0v3bYYYRCpSSRl31ABayz5pdk84jno7.Udj6-U8ffwbT', 'PayPal'),
(11, 'mode', 'sandbox', 'PayPal'),
(12, 'paypal_status', '1', 'PayPal'),
(13, 'publishable', 'pk_test_c2TDWXsjPkimdM8PIltO6d8H', 'Stripe'),
(14, 'secret', 'sk_test_UWTgGYIdj8igmbVMgTi0ILPm', 'Stripe'),
(15, 'stripe_status', '1', 'Stripe'),
(16, 'driver', 'smtp', 'email'),
(17, 'host', 'smtp.gmail.com', 'email'),
(18, 'port', '587', 'email'),
(19, 'from_address', 'helptechvill@gmail.com', 'email'),
(20, 'from_name', 'Vrent', 'email'),
(21, 'encryption', 'tls', 'email'),
(22, 'username', 'helptechvill@gmail.com', 'email'),
(23, 'password', 'helptechvillage', 'email'),
(24, 'facebook', '#', 'join_us'),
(25, 'google_plus', '#', 'join_us'),
(26, 'twitter', '#', 'join_us'),
(27, 'linkedin', '#', 'join_us'),
(28, 'pinterest', '#', 'join_us'),
(29, 'youtube', '#', 'join_us'),
(30, 'instagram', '#', 'join_us'),
(31, 'key', 'AIzaSyDnYDGdfNhkX5imZZo79c_a5VrVoEaD668', 'googleMap'),
(32, 'client_id', '155732176097-s2b8liiqj6v8l39r25baq31vm3adg8uv.apps.googleusercontent.com', 'google'),
(33, 'client_secret', 'ltyqX9vFSqkaRjo4-rxphynm', 'google'),
(34, 'client_id', '166441230733266', 'facebook'),
(35, 'client_secret', '0787364d54422d8ff0bbb646c7f3231e', 'facebook'),
(36, 'email_status', '1', 'email'),
(37, 'row_per_page', '25', 'preferences');
(38, 'date_separator', '-', 'preferences');
(39, 'date_format', '2', 'preferences');
(40, 'dflt_timezone', 'Asia/Dhaka', 'preferences');
(41, 'money_format', 'before', 'preferences');
(42, 'date_format_type', 'mm-dd-yyyy', 'preferences');
(43, 'front_date_format_type', 'mm-dd-yy', 'preferences');
(44, 'search_date_format_type', 'm-d-yy', 'preferences');

-- --------------------------------------------------------

--
-- Dumping data for table `space_type`
--

INSERT INTO `space_type` (`id`, `name`, `description`, `status`) VALUES
(1, 'Entire home/apt', 'Entire home/apt', 'Active'),
(2, 'Private room', 'Private room', 'Active'),
(3, 'Shared room', 'Shared room', 'Active');

-- --------------------------------------------------------

--
-- Dumping data for table `starting_cities`
--

INSERT INTO `starting_cities` (`id`, `name`, `image`, `status`) VALUES
(1, 'New York', 'starting_city_1.jpg', 'Active'),
(2, 'Sydney', 'starting_city_2.jpg', 'Active'),
(3, 'Paris', 'starting_city_3.jpg', 'Active'),
(4, 'Barcelona', 'starting_city_4.jpg', 'Active'),
(5, 'Thailand', 'starting_city_5.jpg', 'Active'),
(6, 'Switzerland', 'starting_city_6.jpg', 'Active');

-- --------------------------------------------------------

--
-- Dumping data for table `timezone`
--

INSERT INTO `timezone` (`id`, `zone`, `value`) VALUES
(1, '(GMT-11:00) International Date Line West', 'Pacific/Kwajalein'),
(2, '(GMT-11:00) Midway Island', 'Pacific/Midway'),
(3, '(GMT-11:00) Samoa', 'Pacific/Samoa'),
(4, '(GMT-10:00) Hawaii', 'Pacific/Honolulu'),
(5, '(GMT-10:00) Pacific/Honolulu', 'Pacific/Honolulu'),
(6, '(GMT-09:00) Alaska', 'US/Alaska'),
(7, '(GMT-08:00) America/Los_Angeles', 'America/Los_Angeles'),
(8, '(GMT-08:00) Pacific Time (US &amp; Canada)', 'America/Los_Angeles'),
(9, '(GMT-08:00) Tijuana', 'America/Tijuana'),
(10, '(GMT-07:00) America/Denver', 'America/Denver'),
(11, '(GMT-07:00) America/Phoenix', 'America/Phoenix'),
(12, '(GMT-07:00) Arizona', 'US/Arizona'),
(13, '(GMT-07:00) Chihuahua', 'America/Chihuahua'),
(14, '(GMT-07:00) Mazatlan', 'America/Mazatlan'),
(15, '(GMT-07:00) Mountain Time (US &amp; Canada)', 'US/Mountain'),
(16, '(GMT-06:00) America/Chicago', 'America/Chicago'),
(17, '(GMT-06:00) America/Mexico_City', 'America/Mexico_City'),
(18, '(GMT-06:00) Central America', 'America/Managua'),
(19, '(GMT-06:00) Central Time (US &amp; Canada)', 'US/Central'),
(20, '(GMT-06:00) Guadalajara', 'America/Mexico_City'),
(21, '(GMT-06:00) Mexico City', 'America/Mexico_City'),
(22, '(GMT-06:00) Monterrey', 'America/Monterrey'),
(23, '(GMT-06:00) Saskatchewan', 'Canada/Saskatchewan'),
(24, '(GMT-05:00) America/Nassau', 'America/Nassau'),
(25, '(GMT-05:00) America/New_York', 'America/New_York'),
(26, '(GMT-05:00) America/Port-au-Prince', 'America/Port-au-Prince'),
(27, '(GMT-05:00) America/Toronto', 'America/Toronto'),
(28, '(GMT-05:00) Bogota', 'America/Bogota'),
(29, '(GMT-05:00) Eastern Time (US &amp; Canada)', 'US/Eastern'),
(30, '(GMT-05:00) Indiana (East)', 'US/East-Indiana'),
(31, '(GMT-05:00) Lima', 'America/Lima'),
(32, '(GMT-05:00) Quito', 'America/Bogota'),
(33, '(GMT-04:30) Caracas', 'America/Caracas'),
(34, '(GMT-04:00) Atlantic Time (Canada)', 'Canada/Atlantic'),
(35, '(GMT-04:00) Georgetown', 'America/Argentina/Buenos_Aires'),
(36, '(GMT-04:00) La Paz', 'America/La_Paz'),
(37, '(GMT-03:30) Newfoundland', 'Canada/Newfoundland'),
(38, '(GMT-03:00) America/Argentina/Buenos_Aires', 'America/Argentina/Buenos_Aires'),
(39, '(GMT-03:00) America/Cordoba', 'America/Cordoba'),
(40, '(GMT-03:00) America/Fortaleza', 'America/Fortaleza'),
(41, '(GMT-03:00) America/Montevideo', 'America/Montevideo'),
(42, '(GMT-03:00) America/Santiago', 'America/Santiago'),
(43, '(GMT-03:00) America/Sao_Paulo', 'America/Sao_Paulo'),
(44, '(GMT-03:00) Brasilia', 'America/Sao_Paulo'),
(45, '(GMT-03:00) Buenos Aires', 'America/Argentina/Buenos_Aires'),
(46, '(GMT-03:00) Greenland', 'America/Godthab'),
(47, '(GMT-03:00) Santiago', 'America/Santiago'),
(48, '(GMT-02:00) Mid-Atlantic', 'America/Noronha'),
(49, '(GMT-01:00) Azores', 'Atlantic/Azores'),
(50, '(GMT-01:00) Cape Verde Is.', 'Atlantic/Cape_Verde'),
(51, '(GMT+00:00) Africa/Casablanca', 'Africa/Casablanca'),
(52, '(GMT+00:00) Atlantic/Canary', 'Atlantic/Canary'),
(53, '(GMT+00:00) Atlantic/Reykjavik', 'Atlantic/Reykjavik'),
(54, '(GMT+00:00) Casablanca', 'Africa/Casablanca'),
(55, '(GMT+00:00) Dublin', 'Etc/Greenwich'),
(56, '(GMT+00:00) Edinburgh', 'Europe/London'),
(57, '(GMT+00:00) Europe/Dublin', 'Europe/Dublin'),
(58, '(GMT+00:00) Europe/Lisbon', 'Europe/Lisbon'),
(59, '(GMT+00:00) Europe/London', 'Europe/London'),
(60, '(GMT+00:00) Lisbon', 'Europe/Lisbon'),
(61, '(GMT+00:00) London', 'Europe/London'),
(62, '(GMT+00:00) Monrovia', 'Africa/Monrovia'),
(63, '(GMT+00:00) UTC', 'UTC'),
(64, '(GMT+01:00) Amsterdam', 'Europe/Amsterdam'),
(65, '(GMT+01:00) Belgrade', 'Europe/Belgrade'),
(66, '(GMT+01:00) Berlin', 'Europe/Berlin'),
(67, '(GMT+01:00) Bern', 'Europe/Berlin'),
(68, '(GMT+01:00) Bratislava', 'Europe/Bratislava'),
(69, '(GMT+01:00) Brussels', 'Europe/Brussels'),
(70, '(GMT+01:00) Budapest', 'Europe/Budapest'),
(71, '(GMT+01:00) Copenhagen', 'Europe/Copenhagen'),
(72, '(GMT+01:00) Europe/Amsterdam', 'Europe/Amsterdam'),
(73, '(GMT+01:00) Europe/Belgrade', 'Europe/Belgrade'),
(74, '(GMT+01:00) Europe/Berlin', 'Europe/Berlin'),
(75, '(GMT+01:00) Europe/Bratislava', 'Europe/Bratislava'),
(76, '(GMT+01:00) Europe/Brussels', 'Europe/Brussels'),
(77, '(GMT+01:00) Europe/Budapest', 'Europe/Budapest'),
(78, '(GMT+01:00) Europe/Copenhagen', 'Europe/Copenhagen'),
(79, '(GMT+01:00) Europe/Ljubljana', 'Europe/Ljubljana'),
(80, '(GMT+01:00) Europe/Madrid', 'Europe/Madrid'),
(81, '(GMT+01:00) Europe/Monaco', 'Europe/Monaco'),
(82, '(GMT+01:00) Europe/Oslo', 'Europe/Oslo'),
(83, '(GMT+01:00) Europe/Paris', 'Europe/Paris'),
(84, '(GMT+01:00) Europe/Podgorica', 'Europe/Podgorica'),
(85, '(GMT+01:00) Europe/Prague', 'Europe/Prague'),
(86, '(GMT+01:00) Europe/Rome', 'Europe/Rome'),
(87, '(GMT+01:00) Europe/Stockholm', 'Europe/Stockholm'),
(88, '(GMT+01:00) Europe/Tirane', 'Europe/Tirane'),
(89, '(GMT+01:00) Europe/Vienna', 'Europe/Vienna'),
(90, '(GMT+01:00) Europe/Warsaw', 'Europe/Warsaw'),
(91, '(GMT+01:00) Europe/Zagreb', 'Europe/Zagreb'),
(92, '(GMT+01:00) Europe/Zurich', 'Europe/Zurich'),
(93, '(GMT+01:00) Ljubljana', 'Europe/Ljubljana'),
(94, '(GMT+01:00) Madrid', 'Europe/Madrid'),
(95, '(GMT+01:00) Paris', 'Europe/Paris'),
(96, '(GMT+01:00) Prague', 'Europe/Prague'),
(97, '(GMT+01:00) Rome', 'Europe/Rome'),
(98, '(GMT+01:00) Sarajevo', 'Europe/Sarajevo'),
(99, '(GMT+01:00) Skopje', 'Europe/Skopje'),
(100, '(GMT+01:00) Stockholm', 'Europe/Stockholm'),
(101, '(GMT+01:00) Vienna', 'Europe/Vienna'),
(102, '(GMT+01:00) Warsaw', 'Europe/Warsaw'),
(103, '(GMT+01:00) West Central Africa', 'Africa/Lagos'),
(104, '(GMT+01:00) Zagreb', 'Europe/Zagreb'),
(105, '(GMT+02:00) Asia/Beirut', 'Asia/Beirut'),
(106, '(GMT+02:00) Asia/Jerusalem', 'Asia/Jerusalem'),
(107, '(GMT+02:00) Asia/Nicosia', 'Asia/Nicosia'),
(108, '(GMT+02:00) Athens', 'Europe/Athens'),
(109, '(GMT+02:00) Bucharest', 'Europe/Bucharest'),
(110, '(GMT+02:00) Cairo', 'Africa/Cairo'),
(111, '(GMT+02:00) Europe/Athens', 'Europe/Athens'),
(112, '(GMT+02:00) Europe/Helsinki', 'Europe/Helsinki'),
(113, '(GMT+02:00) Europe/Istanbul', 'Europe/Istanbul'),
(114, '(GMT+02:00) Europe/Riga', 'Europe/Riga'),
(115, '(GMT+02:00) Europe/Sofia', 'Europe/Sofia'),
(116, '(GMT+02:00) Harare', 'Africa/Harare'),
(117, '(GMT+02:00) Helsinki', 'Europe/Helsinki'),
(118, '(GMT+02:00) Istanbul', 'Europe/Istanbul'),
(119, '(GMT+02:00) Jerusalem', 'Asia/Jerusalem'),
(120, '(GMT+02:00) Kyiv', 'Europe/Helsinki'),
(121, '(GMT+02:00) Pretoria', 'Africa/Johannesburg'),
(122, '(GMT+02:00) Riga', 'Europe/Riga'),
(123, '(GMT+02:00) Sofia', 'Europe/Sofia'),
(124, '(GMT+02:00) Tallinn', 'Europe/Tallinn'),
(125, '(GMT+02:00) Vilnius', 'Europe/Vilnius'),
(126, '(GMT+03:00) Baghdad', 'Asia/Baghdad'),
(127, '(GMT+03:00) Europe/Minsk', 'Europe/Minsk'),
(128, '(GMT+03:00) Europe/Moscow', 'Europe/Moscow'),
(129, '(GMT+03:00) Kuwait', 'Asia/Kuwait'),
(130, '(GMT+03:00) Minsk', 'Europe/Minsk'),
(131, '(GMT+03:00) Moscow', 'Europe/Moscow'),
(132, '(GMT+03:00) Nairobi', 'Africa/Nairobi'),
(133, '(GMT+03:00) Riyadh', 'Asia/Riyadh'),
(134, '(GMT+03:00) St. Petersburg', 'Europe/Moscow'),
(135, '(GMT+03:00) Volgograd', 'Europe/Volgograd'),
(136, '(GMT+03:30) Tehran', 'Asia/Tehran'),
(137, '(GMT+04:00) Abu Dhabi', 'Asia/Muscat'),
(138, '(GMT+04:00) Asia/Dubai', 'Asia/Dubai'),
(139, '(GMT+04:00) Asia/Tbilisi', 'Asia/Tbilisi'),
(140, '(GMT+04:00) Baku', 'Asia/Baku'),
(141, '(GMT+04:00) Muscat', 'Asia/Muscat'),
(142, '(GMT+04:00) Tbilisi', 'Asia/Tbilisi'),
(143, '(GMT+04:00) Yerevan', 'Asia/Yerevan'),
(144, '(GMT+04:30) Kabul', 'Asia/Kabul'),
(145, '(GMT+05:00) Ekaterinburg', 'Asia/Yekaterinburg'),
(146, '(GMT+05:00) Indian/Maldives', 'Indian/Maldives'),
(147, '(GMT+05:00) Islamabad', 'Asia/Karachi'),
(148, '(GMT+05:00) Karachi', 'Asia/Karachi'),
(149, '(GMT+05:00) Tashkent', 'Asia/Tashkent'),
(150, '(GMT+05:30) Asia/Calcutta', 'Asia/Calcutta'),
(151, '(GMT+05:30) Asia/Colombo', 'Asia/Colombo'),
(152, '(GMT+05:30) Chennai', 'Asia/Calcutta'),
(153, '(GMT+05:30) Kolkata', 'Asia/Kolkata'),
(154, '(GMT+05:30) Mumbai', 'Asia/Calcutta'),
(155, '(GMT+05:30) New Delhi', 'Asia/Calcutta'),
(156, '(GMT+05:30) Sri Jayawardenepura', 'Asia/Calcutta'),
(157, '(GMT+05:45) Kathmandu', 'Asia/Katmandu'),
(158, '(GMT+06:00) Almaty', 'Asia/Almaty'),
(159, '(GMT+06:00) Astana', 'Asia/Dhaka'),
(160, '(GMT+06:00) Dhaka', 'Asia/Dhaka'),
(161, '(GMT+06:00) Novosibirsk', 'Asia/Novosibirsk'),
(162, '(GMT+06:00) Urumqi', 'Asia/Urumqi'),
(163, '(GMT+06:30) Rangoon', 'Asia/Rangoon'),
(164, '(GMT+07:00) Asia/Bangkok', 'Asia/Bangkok'),
(165, '(GMT+07:00) Asia/Jakarta', 'Asia/Jakarta'),
(166, '(GMT+07:00) Bangkok', 'Asia/Bangkok'),
(167, '(GMT+07:00) Hanoi', 'Asia/Bangkok'),
(168, '(GMT+07:00) Jakarta', 'Asia/Jakarta'),
(169, '(GMT+07:00) Krasnoyarsk', 'Asia/Krasnoyarsk'),
(170, '(GMT+08:00) Asia/Chongqing', 'Asia/Chongqing'),
(171, '(GMT+08:00) Asia/Hong_Kong', 'Asia/Hong_Kong'),
(172, '(GMT+08:00) Asia/Kuala_Lumpur', 'Asia/Kuala_Lumpur'),
(173, '(GMT+08:00) Asia/Macau', 'Asia/Macau'),
(174, '(GMT+08:00) Asia/Makassar', 'Asia/Makassar'),
(175, '(GMT+08:00) Asia/Shanghai', 'Asia/Shanghai'),
(176, '(GMT+08:00) Asia/Taipei', 'Asia/Taipei'),
(177, '(GMT+08:00) Beijing', 'Asia/Hong_Kong'),
(178, '(GMT+08:00) Chongqing', 'Asia/Chongqing'),
(179, '(GMT+08:00) Hong Kong', 'Asia/Hong_Kong'),
(180, '(GMT+08:00) Irkutsk', 'Asia/Irkutsk'),
(181, '(GMT+08:00) Kuala Lumpur', 'Asia/Kuala_Lumpur'),
(182, '(GMT+08:00) Perth', 'Australia/Perth'),
(183, '(GMT+08:00) Singapore', 'Asia/Singapore'),
(184, '(GMT+08:00) Taipei', 'Asia/Taipei'),
(185, '(GMT+08:00) Ulaan Bataar', 'Asia/Ulan_Bator'),
(186, '(GMT+09:00) Asia/Seoul', 'Asia/Seoul'),
(187, '(GMT+09:00) Asia/Tokyo', 'Asia/Tokyo'),
(188, '(GMT+09:00) Osaka', 'Asia/Tokyo'),
(189, '(GMT+09:00) Sapporo', 'Asia/Tokyo'),
(190, '(GMT+09:00) Seoul', 'Asia/Seoul'),
(191, '(GMT+09:00) Tokyo', 'Asia/Tokyo'),
(192, '(GMT+09:00) Yakutsk', 'Asia/Yakutsk'),
(193, '(GMT+09:30) Adelaide', 'Australia/Adelaide'),
(194, '(GMT+09:30) Darwin', 'Australia/Darwin'),
(195, '(GMT+10:00) Australia/Brisbane', 'Australia/Brisbane'),
(196, '(GMT+10:00) Australia/Hobart', 'Australia/Hobart'),
(197, '(GMT+10:00) Australia/Melbourne', 'Australia/Melbourne'),
(198, '(GMT+10:00) Australia/Sydney', 'Australia/Sydney'),
(199, '(GMT+10:00) Brisbane', 'Australia/Brisbane'),
(200, '(GMT+10:00) Canberra', 'Australia/Canberra'),
(201, '(GMT+10:00) Guam', 'Pacific/Guam'),
(202, '(GMT+10:00) Hobart', 'Australia/Hobart'),
(203, '(GMT+10:00) Magadan', 'Asia/Magadan'),
(204, '(GMT+10:00) Melbourne', 'Australia/Melbourne'),
(205, '(GMT+10:00) Port Moresby', 'Pacific/Port_Moresby'),
(206, '(GMT+10:00) Solomon Is.', 'Asia/Magadan'),
(207, '(GMT+10:00) Sydney', 'Australia/Sydney'),
(208, '(GMT+10:00) Vladivostok', 'Asia/Vladivostok'),
(209, '(GMT+11:00) New Caledonia', 'Asia/Magadan'),
(210, '(GMT+12:00) Auckland', 'Pacific/Auckland'),
(211, '(GMT+12:00) Fiji', 'Pacific/Fiji'),
(212, '(GMT+12:00) Kamchatka', 'Asia/Kamchatka'),
(213, '(GMT+12:00) Marshall Is.', 'Pacific/Fiji'),
(214, '(GMT+12:00) Pacific/Auckland', 'Pacific/Auckland'),
(215, '(GMT+12:00) Wellington', 'Pacific/Auckland'),
(216, '(GMT+13:00) Nuku&#39;alofa', 'Pacific/Tongatapu');

-- --------------------------------------------------------

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `profile_image`, `balance`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Smith', 'test@techvill.net', '$2y$10$EozWLe4sccue8fR0xQhCu.sT07ndtvyqfv36vvg//3oEPruP.3b.K', 'profile_1523427162.png', 0, 'Active', 'wLzyfQQ9mhA7sumBX2vRnI7DrDk9zj5Qe5CipWQx89pTUB33u265qBj3Z30m', '2019-04-30 04:06:17', '2019-05-02 00:26:21'),
(2, 'Customer', 'Customer', 'customer@techvill.net', '$2y$10$4HBgF6eHiS3L1z3WdkNLu.RVL./Tkt1f7myshn0g3cquAv7f2nSmG', 'profile_1523427507.jpg', 0, 'Active', '2yuJJAuGqy0jtK66gvdWHrvD3FVeaIsTv8YsEw2KaaD3NaGrRLke3sMXU7Hj', '2019-05-02 00:21:18', '2019-05-02 00:24:15'),
(3, 'Mahfuza', 'Sinthy', 'mahfuzasinthy@gmail.com', '$2y$10$HIkcV14lt3KpEXkxE1PZFOP1LbIQTaEav8rxk7tjKAG.2tfz.8qai', 'profile_1523525839.png', 0, 'Active', NULL, '2019-05-02 00:34:02', '2019-05-02 00:34:35');

-- --------------------------------------------------------

--
-- Dumping data for table `users_verification`
--

INSERT INTO `users_verification` (`id`, `user_id`, `email`, `facebook`, `google`, `linkedin`, `phone`, `fb_id`, `google_id`, `linkedin_id`) VALUES
(1, 1, 'yes', 'yes', 'yes', 'no', 'no', '112802396600335739450', '112802396600335739450', NULL),
(2, 2, 'yes', 'no', 'no', 'no', 'no', NULL, NULL, NULL),
(3, 3, 'yes', 'no', 'no', 'no', 'no', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `field`, `value`) VALUES
(1, 1, 'date_of_birth', '1992-8-18'),
(2, 2, 'date_of_birth', '1983-5-15'),
(3, 3, 'date_of_birth', '1994-5-10');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenity_type`
--
ALTER TABLE `amenity_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_type`
--
ALTER TABLE `bed_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_short_name_unique` (`short_name`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_code_unique` (`code`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_type`
--
ALTER TABLE `message_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payout_penalties`
--
ALTER TABLE `payout_penalties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_address`
--
ALTER TABLE `property_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_beds`
--
ALTER TABLE `property_beds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_dates`
--
ALTER TABLE `property_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_description`
--
ALTER TABLE `property_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_details`
--
ALTER TABLE `property_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_fees`
--
ALTER TABLE `property_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_photos`
--
ALTER TABLE `property_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_price`
--
ALTER TABLE `property_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_rules`
--
ALTER TABLE `property_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_steps`
--
ALTER TABLE `property_steps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_admin`
--
ALTER TABLE `role_admin`
  ADD PRIMARY KEY (`admin_id`,`role_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_metas`
--
ALTER TABLE `seo_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `space_type`
--
ALTER TABLE `space_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `starting_cities`
--
ALTER TABLE `starting_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezone`
--
ALTER TABLE `timezone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_verification`
--
ALTER TABLE `users_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `amenity_type`
--
ALTER TABLE `amenity_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `backups`
--
ALTER TABLE `backups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bed_type`
--
ALTER TABLE `bed_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `message_type`
--
ALTER TABLE `message_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payout_penalties`
--
ALTER TABLE `payout_penalties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `property_address`
--
ALTER TABLE `property_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `property_beds`
--
ALTER TABLE `property_beds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_dates`
--
ALTER TABLE `property_dates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `property_description`
--
ALTER TABLE `property_description`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `property_details`
--
ALTER TABLE `property_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_fees`
--
ALTER TABLE `property_fees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `property_photos`
--
ALTER TABLE `property_photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `property_price`
--
ALTER TABLE `property_price`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `property_rules`
--
ALTER TABLE `property_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_steps`
--
ALTER TABLE `property_steps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seo_metas`
--
ALTER TABLE `seo_metas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `space_type`
--
ALTER TABLE `space_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `starting_cities`
--
ALTER TABLE `starting_cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `timezone`
--
ALTER TABLE `timezone`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_verification`
--
ALTER TABLE `users_verification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
