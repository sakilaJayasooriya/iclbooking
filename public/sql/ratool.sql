-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2018 at 07:06 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ratool`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustment_details`
--

CREATE TABLE `adjustment_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `adjustment_id` int(11) NOT NULL,
  `stock_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `quantity` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '2017-12-06-084544.sql', '2017-12-06 02:45:44', NULL),
(2, '2017-12-06-084548.sql', '2017-12-06 02:45:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `gl_account_id` int(11) UNSIGNED NOT NULL,
  `account_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `account_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `bank_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_account` tinyint(4) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `account_type_id`, `gl_account_id`, `account_name`, `account_no`, `bank_name`, `currency`, `bank_address`, `default_account`, `deleted`) VALUES
(1, 1, 71, 'Shahin Alam', '100001', 'Islami Bank Ltd', 'BDT', 'Dhaka', 0, 0),
(2, 4, 22, 'Reza', '200001', 'Dutch bangla bank ltd', 'USD', 'Rajshahi', 0, 0),
(3, 3, 42, 'Aminul Islam', '300001', 'Dhaka Bank', 'USD', '', 0, 0),
(4, 1, 1, 'Asraf Khan', '40003', 'Sonali Bank Ltd', 'USD', '', 0, 0),
(5, 4, 71, 'Pretty Cash', '', '', 'BDT', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_type`
--

CREATE TABLE `bank_account_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank_account_type`
--

INSERT INTO `bank_account_type` (`id`, `name`) VALUES
(1, 'Savings Account'),
(2, 'Chequing Account'),
(3, 'Credit Account'),
(4, 'Cash Account'),
(6, 'CD account');

-- --------------------------------------------------------

--
-- Table structure for table `bank_trans`
--

CREATE TABLE `bank_trans` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `trans_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_no` int(11) NOT NULL,
  `trans_date` date NOT NULL,
  `person_id` int(11) NOT NULL,
  `reference` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `attachment` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank_trans`
--

INSERT INTO `bank_trans` (`id`, `amount`, `trans_type`, `account_no`, `trans_date`, `person_id`, `reference`, `description`, `category_id`, `payment_method`, `attachment`, `created_at`) VALUES
(1, 1000, 'cash-in-by-sale', 2, '2017-12-05', 1, '', 'Payment for INV-0003', 1, 2, '', '2017-12-05 08:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `bank_account_id` int(11) UNSIGNED NOT NULL,
  `reference_id` int(11) UNSIGNED NOT NULL,
  `reference_type` int(11) UNSIGNED NOT NULL,
  `reference` varchar(100) NOT NULL,
  `trans_reference_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `transaction_method_id` int(3) DEFAULT NULL,
  `cheque_no` varchar(50) DEFAULT NULL,
  `person_id` int(11) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`id`, `bank_account_id`, `reference_id`, `reference_type`, `reference`, `trans_reference_id`, `description`, `transaction_method_id`, `cheque_no`, `person_id`, `amount`, `transaction_date`, `created_at`) VALUES
(1, 5, 0, 0, 'opening balance', NULL, NULL, NULL, NULL, 1, 0, '2017-12-13', '2017-12-13 06:10:36'),
(2, 1, 1, 3, 'pretty-cash', NULL, NULL, NULL, NULL, 1, -10002, '2017-12-13', '2017-12-13 06:16:55'),
(3, 5, 1, 3, 'pretty-cash', NULL, NULL, NULL, NULL, 1, 10000, '2017-12-13', '2017-12-13 06:16:55'),
(4, 1, 2, 2, 'depo', NULL, NULL, NULL, NULL, 1, 50000.46, '2017-12-13', '2017-12-13 06:33:33'),
(5, 2, 3, 2, 'conversion', NULL, NULL, NULL, NULL, 1, 500, '2017-12-13', '2017-12-13 06:47:52'),
(44, 1, 12, 6, '003/2017', NULL, '', NULL, NULL, 4, -500, '2017-12-23', '2017-12-20 05:15:07'),
(43, 2, 11, 3, '001/2017', NULL, NULL, NULL, NULL, 1, 800, '2017-12-19', '2017-12-19 12:32:34'),
(42, 1, 11, 3, '001/2017', NULL, NULL, NULL, NULL, 1, -10, '2017-12-19', '2017-12-19 12:32:34'),
(41, 1, 10, 5, '002/2017', 7, 'Payment for INV-0003', 1, '', 1, 40500, '2017-12-19', '2017-12-19 06:39:52'),
(40, 1, 9, 5, '001/2017', 7, 'Payment for INV-0003', 1, '', 1, 9000, '2017-12-19', '2017-12-19 06:34:30'),
(39, 2, 8, 1, '001/2017', NULL, NULL, NULL, NULL, 1, -5, '2017-12-19', '2017-12-19 05:56:42'),
(38, 1, 7, 2, '001/2017', NULL, NULL, NULL, NULL, 1, 200, '2017-12-19', '2017-12-19 05:11:56'),
(37, 1, 6, 4, '001/2017', 1, 'Payment for PO-0001', 1, '', 1, -200, '2017-12-19', '2017-12-19 05:10:48'),
(36, 2, 5, 6, '002/2017', NULL, 'Hello', NULL, NULL, 1, -10, '2017-12-18', '2017-12-18 11:46:18'),
(35, 1, 4, 7, '001/2017', NULL, 'Loan from office', NULL, NULL, 1, 100, '2017-12-18', '2017-12-18 10:05:20'),
(31, 1, 3, 5, '001/2017', 3, 'Payment for INV-0001', 1, '', 1, 34400, '2017-12-18', '2017-12-18 08:10:42'),
(34, 1, 3, 6, '001/2017', NULL, 'Loan from office', NULL, NULL, 1, -2000, '2017-12-18', '2017-12-18 09:26:15'),
(45, 1, 13, 6, '004/2017', NULL, '', NULL, NULL, 4, -100, '2017-12-20', '2017-12-20 05:16:11'),
(46, 1, 14, 6, '005/2017', NULL, '', NULL, NULL, 4, -500, '2017-12-20', '2017-12-20 10:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `attention` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cell_no` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_street` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_zipcode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_street` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_zipcode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `attention`, `cell_no`, `billing_street`, `billing_city`, `billing_state`, `billing_zipcode`, `billing_country`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zipcode`, `shipping_country`) VALUES
(1, 'Ratool apparels Ltd', 'Shahin Alam', '01722113736', 'Vangnahati', NULL, 'Sreepur', '1234', 'Bahrain', 'Vangnahati', 'Gazipur', 'Sreepur', '1234', 'Azerbaijan'),
(2, 'Mirpur Branch1', 'Suny1', '017221138371', '2501', '1', 'Dhaka1', '1216', 'Anguilla', 'Vangnahati1', 'Sreepur1', 'Sreepur1', '12341', 'Angola');

-- --------------------------------------------------------

--
-- Table structure for table `chart_class`
--

CREATE TABLE `chart_class` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_class`
--

INSERT INTO `chart_class` (`id`, `name`, `type`, `status`) VALUES
(1, 'Assets', 1, 1),
(2, 'Liabilities', 2, 1),
(3, 'Income', 3, 1),
(4, 'Costs', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chart_master`
--

CREATE TABLE `chart_master` (
  `id` int(11) NOT NULL,
  `account_type_id` int(11) UNSIGNED NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `account_name` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_master`
--

INSERT INTO `chart_master` (`id`, `account_type_id`, `account_no`, `account_name`, `status`) VALUES
(1, 1, '104', 'EID BONUS A/C', 1),
(2, 1, '105', 'ELECTRICITY BILL A/C', 1),
(3, 1, '106', 'TITAS GAS EXPS A/C', 1),
(4, 1, '107', 'HEAD OFFICE RENT A/C', 1),
(5, 1, '108', 'FACTORY RENT A/C (RODDUR APP )', 1),
(6, 1, '109', 'PRINT FACTORY RENT A/C', 1),
(7, 1, '110', 'CNG EXPS ( BOILER ) A/C', 1),
(8, 1, '111', 'OIL & LUBRICANTS A/C', 1),
(9, 1, '112', 'ENTERTAINMENT A/C', 1),
(10, 1, '113', 'LUNCH BILL EXPS A/C', 1),
(11, 1, '114', 'IFTAR / TIFFIN BILL EXPS A/C', 1),
(12, 1, '115', 'NIGHT ALLOWANCE A/C', 1),
(13, 1, '116', 'LOCAL CONVEYANCE  A/C', 1),
(14, 1, '117', 'MOBILE BILL A/C', 1),
(15, 3, '118', 'SPARE PARTS A/C', 1),
(16, 3, '119', 'NEEDLE PURCHASE A/C', 1),
(17, 3, '120', 'LOCAL PURCHASE A/C', 1),
(18, 3, '122', 'FABRIC / LYCRA PURCHASE A/C', 1),
(19, 3, '121', 'ACCESSORIES PURCHASE A/C', 1),
(20, 3, '123', 'FACTORY SUPPLY A/C', 1),
(21, 3, '124', 'LOCAL CARRYING A/C', 1),
(22, 3, '125', 'CARRYING & HANDLING', 1),
(23, 3, '126', 'POSTAGE & COURIER CHARGE A/C', 1),
(24, 3, '127', 'PRINTING & STATIONERY A/C', 1),
(25, 3, '128', 'ELECTRIC MATERIALS A/C', 1),
(26, 3, '129', 'REPAIR & MAINTENANCE A/C', 1),
(27, 3, '130', 'INTERNET CHARGE A/C', 1),
(28, 3, '131', 'INTERNET ACCESSORIES A/C', 1),
(29, 2, '138', 'FINISHING CHARGE A/C', 1),
(30, 2, '140', 'PRINTING EXPS A/C ', 1),
(31, 2, '139', 'EMBROIDERY EXPS', 1),
(32, 2, '137', 'SEWING CHARGE A/C', 1),
(33, 2, '136', 'SUB-CONTRACT EXPS A/C', 1),
(34, 4, '145', 'FACTORY CONSTRUCTION A/C', 1),
(35, 4, '146', 'PLANT & MACHINERY A/C', 1),
(36, 4, '152', 'ELEC.INSTT & FITTINGS A/C', 1),
(37, 5, '178', 'COMMISSION & BROKERAGE A/C', 1),
(38, 5, '177', 'PHOTOCOPY EXPS A/C', 1),
(39, 5, '162', 'CUSTOMS DUTY EXPS A/C ', 1),
(40, 3, '133', 'CHEMICAL EXPS A/C', 1),
(41, 5, '182', 'INSPECTION FEES A/C ', 1),
(42, 4, '154', 'CONTRACT LABOUR A/C', 1),
(43, 4, '153', 'PAINTING EXPS A/C', 1),
(44, 5, '181', 'LAB TEST FEES A/C', 1),
(45, 4, '151', 'FURNITURE & FIXTURE A/C', 1),
(46, 5, '180', 'MISCELLANEOUS EXPS A/C', 1),
(47, 5, '179', 'BUYING COMMISSION A/C', 1),
(48, 5, '155', 'AIR FREIGHT CHARGE A/C', 1),
(49, 5, '158', 'CLEARANCE & OTHERS A/C', 1),
(50, 5, '172', 'ACCEPTANCE CHARGE A/C', 1),
(51, 5, '171', 'INSURANCE PRIMIUM A/C', 1),
(52, 2, '144', 'KNITTING CHARGE A/C', 1),
(53, 4, '148', 'LAND REGISTRATION A/C', 1),
(54, 4, '150', 'OFFICE / FACTORY EQUIPMENT  A/C', 1),
(55, 4, '149', 'LAND PURPOSE EXPS A/C', 1),
(56, 4, '147', 'LAND PURCHASE', 1),
(57, 5, '159', 'LICENCE RENEWAL FEES A/C', 1),
(58, 5, '160', 'NON-JUDICIAL STAMP A/C', 1),
(59, 5, '173', 'VEHICLE /CAR PURCHASE A/C', 1),
(60, 5, '174', 'FUEL & OIL A/C', 1),
(61, 5, '175', 'VEHICLE MAINTENANCE A/C', 1),
(62, 5, '176', 'CLEANING & SANITATION A/C', 1),
(63, 3, '135', 'MACHINE OIL A/C', 1),
(64, 2, '141', 'PRINTING CHARGE A/C', 1),
(65, 2, '143', 'WASHING CHARGE A/C', 1),
(66, 2, '142', 'DYEING CHARGE A/C', 1),
(67, 5, '161', 'CUSTOMS MISCE EXPS A/C ', 1),
(68, 5, '170', 'C & F EXPS A/C', 1),
(69, 5, '169', 'BB L/C CHARGE A/C / commission charge A/c', 1),
(70, 5, '168', 'L/C ADVISING CHARGE A/C', 1),
(71, 5, '167', 'CASH INSENTIVE EXPS A/C', 1),
(72, 5, '166', 'BANK CHARGE A/C', 1),
(73, 5, '165', 'GOVT. TAX / VAT CHARGE A/C', 1),
(74, 5, '164', 'FOREIGN CREDIT EXPS A/C/ TIME LOAN Refund', 1),
(75, 5, '163', 'MORTGAGE EXPS A/C LAND', 1),
(76, 5, '157', 'LCL SHIPPING CHARGE A/C', 1),
(77, 5, '156', 'GSP EXPS A/C', 1),
(78, 3, '134', 'KNITTING OIL A/C', 1),
(79, 3, '132', 'LOCAL DYEING CHARGE A/C', 1),
(80, 1, '101', 'WAGES A/C', 1),
(81, 1, '102', 'SALARY EXPS A/C', 1),
(82, 1, '103', 'O.T ALLOWANCE A/C', 1),
(83, 5, '183', 'REMUNERATION A/C', 1),
(84, 5, '184', 'SUBSCRIPTION & DONATION A/C', 1),
(85, 5, '185', 'NEWS PAPER & PERIODCALS A/C', 1),
(86, 5, '186', 'MARKETING COMMISSION', 1),
(87, 5, '187', 'COMPLIANCE DEVLOPMENT A/C', 1),
(88, 5, '188', 'FIRE EXTINGUISHER A/C', 1),
(89, 5, '189', 'COMPUTER ACCESSORIES A/C', 1),
(90, 5, '190', 'LAWER CHARGE A/C', 1),
(91, 5, '191', 'REVENUE STAMP A/C', 1),
(92, 5, '192', 'TOURS / TRAVEL ALLOWANCE A/C', 1),
(93, 5, '193', 'ADVERTISEMENT & PUBLICITY A/C', 1),
(94, 5, '194', 'AUDIT FEES A/C ', 1),
(95, 5, '195', 'CROKARIES EXPS A/C', 1),
(96, 5, '196', 'SANITARY MATERIALS A/C', 1),
(97, 5, '197', 'INCOME TAX CHARGE A/C', 1),
(98, 5, '198', 'SERVICE CHARGE A/C', 1),
(99, 5, '199', 'SECURITY & SAFETY CHARGE A/C', 1),
(100, 5, '200', 'GENERAL EXPENDITURE A/C', 1),
(101, 5, '201', 'WELFAIR EXPS A/C', 1),
(102, 5, '202', 'CABLE NETWORK EXPS A/C', 1),
(103, 5, '203', 'GARDENING EXPS A/C', 1),
(104, 5, '204', 'MEDICAL EXPS A/C', 1),
(105, 5, '205', 'ANNUAL FESTIVALS A/C', 1),
(106, 5, '206', 'ONLINE CHARGE A/C', 1),
(107, 5, '207', 'HOUSE RENT A/C ( M.D SIR )', 1),
(108, 5, '208', 'GODOWN RENT A/C', 1),
(109, 5, '209', 'TELEPHONE ,TLX & FAX A/C', 1),
(110, 5, '210', 'MOBILE PURCHSE', 1),
(111, 5, '211', 'MACHINE RENT A/C', 1),
(112, 5, '212', 'KNITTING NEEDLE PURCHASE', 1),
(113, 5, '213', 'HOLIDAY ALLOWANCE ', 1),
(114, 5, '214', 'CONTAINER PURCHASE A/C', 1),
(115, 5, '215', 'HOUSE RENT A/C (HR/ WORKER )', 1),
(116, 5, '216', 'MACHINERY INTEREST CHARGE A/C', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chart_types`
--

CREATE TABLE `chart_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `class_id` int(3) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_types`
--

INSERT INTO `chart_types` (`id`, `name`, `class_id`, `status`) VALUES
(1, 'Current Assets', 1, 1),
(2, 'Inventory Assets', 1, 1),
(3, 'Capital Assets', 1, 1),
(4, 'Current Liabilities', 2, 1),
(5, 'Long Term Liabilities', 2, 1),
(6, 'Share Capital', 2, 1),
(7, 'Retained Earnings', 2, 1),
(8, 'Sales Revenue', 3, 1),
(9, 'Other Revenue', 3, 1),
(10, 'Cost of Goods Sold', 4, 1),
(11, 'Payroll Expenses', 4, 1),
(12, 'General &amp; Administrative expenses', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `code`) VALUES
(1, 'United States', 'US'),
(2, 'Canada', 'CA'),
(3, 'Afghanistan', 'AF'),
(4, 'Albania', 'AL'),
(5, 'Algeria', 'DZ'),
(6, 'American Samoa', 'AS'),
(7, 'Andorra', 'AD'),
(8, 'Angola', 'AO'),
(9, 'Anguilla', 'AI'),
(10, 'Antarctica', 'AQ'),
(11, 'Antigua and/or Barbuda', 'AG'),
(12, 'Argentina', 'AR'),
(13, 'Armenia', 'AM'),
(14, 'Aruba', 'AW'),
(15, 'Australia', 'AU'),
(16, 'Austria', 'AT'),
(17, 'Azerbaijan', 'AZ'),
(18, 'Bahamas', 'BS'),
(19, 'Bahrain', 'BH'),
(20, 'Bangladesh', 'BD'),
(21, 'Barbados', 'BB'),
(22, 'Belarus', 'BY'),
(23, 'Belgium', 'BE'),
(24, 'Belize', 'BZ'),
(25, 'Benin', 'BJ'),
(26, 'Bermuda', 'BM'),
(27, 'Bhutan', 'BT'),
(28, 'Bolivia', 'BO'),
(29, 'Bosnia and Herzegovina', 'BA'),
(30, 'Botswana', 'BW'),
(31, 'Bouvet Island', 'BV'),
(32, 'Brazil', 'BR'),
(33, 'British lndian Ocean Territory', 'IO'),
(34, 'Brunei Darussalam', 'BN'),
(35, 'Bulgaria', 'BG'),
(36, 'Burkina Faso', 'BF'),
(37, 'Burundi', 'BI'),
(38, 'Cambodia', 'KH'),
(39, 'Cameroon', 'CM'),
(40, 'Cape Verde', 'CV'),
(41, 'Cayman Islands', 'KY'),
(42, 'Central African Republic', 'CF'),
(43, 'Chad', 'TD'),
(44, 'Chile', 'CL'),
(45, 'China', 'CN'),
(46, 'Christmas Island', 'CX'),
(47, 'Cocos (Keeling) Islands', 'CC'),
(48, 'Colombia', 'CO'),
(49, 'Comoros', 'KM'),
(50, 'Congo', 'CG'),
(51, 'Cook Islands', 'CK'),
(52, 'Costa Rica', 'CR'),
(53, 'Croatia (Hrvatska)', 'HR'),
(54, 'Cuba', 'CU'),
(55, 'Cyprus', 'CY'),
(56, 'Czech Republic', 'CZ'),
(57, 'Democratic Republic of Congo', 'CD'),
(58, 'Denmark', 'DK'),
(59, 'Djibouti', 'DJ'),
(60, 'Dominica', 'DM'),
(61, 'Dominican Republic', 'DO'),
(62, 'East Timor', 'TP'),
(63, 'Ecudaor', 'EC'),
(64, 'Egypt', 'EG'),
(65, 'El Salvador', 'SV'),
(66, 'Equatorial Guinea', 'GQ'),
(67, 'Eritrea', 'ER'),
(68, 'Estonia', 'EE'),
(69, 'Ethiopia', 'ET'),
(70, 'Falkland Islands (Malvinas)', 'FK'),
(71, 'Faroe Islands', 'FO'),
(72, 'Fiji', 'FJ'),
(73, 'Finland', 'FI'),
(74, 'France', 'FR'),
(75, 'France, Metropolitan', 'FX'),
(76, 'French Guiana', 'GF'),
(77, 'French Polynesia', 'PF'),
(78, 'French Southern Territories', 'TF'),
(79, 'Gabon', 'GA'),
(80, 'Gambia', 'GM'),
(81, 'Georgia', 'GE'),
(82, 'Germany', 'DE'),
(83, 'Ghana', 'GH'),
(84, 'Gibraltar', 'GI'),
(85, 'Greece', 'GR'),
(86, 'Greenland', 'GL'),
(87, 'Grenada', 'GD'),
(88, 'Guadeloupe', 'GP'),
(89, 'Guam', 'GU'),
(90, 'Guatemala', 'GT'),
(91, 'Guinea', 'GN'),
(92, 'Guinea-Bissau', 'GW'),
(93, 'Guyana', 'GY'),
(94, 'Haiti', 'HT'),
(95, 'Heard and Mc Donald Islands', 'HM'),
(96, 'Honduras', 'HN'),
(97, 'Hong Kong', 'HK'),
(98, 'Hungary', 'HU'),
(99, 'Iceland', 'IS'),
(100, 'India', 'IN'),
(101, 'Indonesia', 'ID'),
(102, 'Iran (Islamic Republic of)', 'IR'),
(103, 'Iraq', 'IQ'),
(104, 'Ireland', 'IE'),
(105, 'Israel', 'IL'),
(106, 'Italy', 'IT'),
(107, 'Ivory Coast', 'CI'),
(108, 'Jamaica', 'JM'),
(109, 'Japan', 'JP'),
(110, 'Jordan', 'JO'),
(111, 'Kazakhstan', 'KZ'),
(112, 'Kenya', 'KE'),
(113, 'Kiribati', 'KI'),
(114, 'Korea, Democratic People\'s Republic of', 'KP'),
(115, 'Korea, Republic of', 'KR'),
(116, 'Kuwait', 'KW'),
(117, 'Kyrgyzstan', 'KG'),
(118, 'Lao People\'s Democratic Republic', 'LA'),
(119, 'Latvia', 'LV'),
(120, 'Lebanon', 'LB'),
(121, 'Lesotho', 'LS'),
(122, 'Liberia', 'LR'),
(123, 'Libyan Arab Jamahiriya', 'LY'),
(124, 'Liechtenstein', 'LI'),
(125, 'Lithuania', 'LT'),
(126, 'Luxembourg', 'LU'),
(127, 'Macau', 'MO'),
(128, 'Macedonia', 'MK'),
(129, 'Madagascar', 'MG'),
(130, 'Malawi', 'MW'),
(131, 'Malaysia', 'MY'),
(132, 'Maldives', 'MV'),
(133, 'Mali', 'ML'),
(134, 'Malta', 'MT'),
(135, 'Marshall Islands', 'MH'),
(136, 'Martinique', 'MQ'),
(137, 'Mauritania', 'MR'),
(138, 'Mauritius', 'MU'),
(139, 'Mayotte', 'TY'),
(140, 'Mexico', 'MX'),
(141, 'Micronesia, Federated States of', 'FM'),
(142, 'Moldova, Republic of', 'MD'),
(143, 'Monaco', 'MC'),
(144, 'Mongolia', 'MN'),
(145, 'Montserrat', 'MS'),
(146, 'Morocco', 'MA'),
(147, 'Mozambique', 'MZ'),
(148, 'Myanmar', 'MM'),
(149, 'Namibia', 'NA'),
(150, 'Nauru', 'NR'),
(151, 'Nepal', 'NP'),
(152, 'Netherlands', 'NL'),
(153, 'Netherlands Antilles', 'AN'),
(154, 'New Caledonia', 'NC'),
(155, 'New Zealand', 'NZ'),
(156, 'Nicaragua', 'NI'),
(157, 'Niger', 'NE'),
(158, 'Nigeria', 'NG'),
(159, 'Niue', 'NU'),
(160, 'Norfork Island', 'NF'),
(161, 'Northern Mariana Islands', 'MP'),
(162, 'Norway', 'NO'),
(163, 'Oman', 'OM'),
(164, 'Pakistan', 'PK'),
(165, 'Palau', 'PW'),
(166, 'Panama', 'PA'),
(167, 'Papua New Guinea', 'PG'),
(168, 'Paraguay', 'PY'),
(169, 'Peru', 'PE'),
(170, 'Philippines', 'PH'),
(171, 'Pitcairn', 'PN'),
(172, 'Poland', 'PL'),
(173, 'Portugal', 'PT'),
(174, 'Puerto Rico', 'PR'),
(175, 'Qatar', 'QA'),
(176, 'Republic of South Sudan', 'SS'),
(177, 'Reunion', 'RE'),
(178, 'Romania', 'RO'),
(179, 'Russian Federation', 'RU'),
(180, 'Rwanda', 'RW'),
(181, 'Saint Kitts and Nevis', 'KN'),
(182, 'Saint Lucia', 'LC'),
(183, 'Saint Vincent and the Grenadines', 'VC'),
(184, 'Samoa', 'WS'),
(185, 'San Marino', 'SM'),
(186, 'Sao Tome and Principe', 'ST'),
(187, 'Saudi Arabia', 'SA'),
(188, 'Senegal', 'SN'),
(189, 'Serbia', 'RS'),
(190, 'Seychelles', 'SC'),
(191, 'Sierra Leone', 'SL'),
(192, 'Singapore', 'SG'),
(193, 'Slovakia', 'SK'),
(194, 'Slovenia', 'SI'),
(195, 'Solomon Islands', 'SB'),
(196, 'Somalia', 'SO'),
(197, 'South Africa', 'ZA'),
(198, 'South Georgia South Sandwich Islands', 'GS'),
(199, 'Spain', 'ES'),
(200, 'Sri Lanka', 'LK'),
(201, 'St. Helena', 'SH'),
(202, 'St. Pierre and Miquelon', 'PM'),
(203, 'Sudan', 'SD'),
(204, 'Suriname', 'SR'),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ'),
(206, 'Swaziland', 'SZ'),
(207, 'Sweden', 'SE'),
(208, 'Switzerland', 'CH'),
(209, 'Syrian Arab Republic', 'SY'),
(210, 'Taiwan', 'TW'),
(211, 'Tajikistan', 'TJ'),
(212, 'Tanzania, United Republic of', 'TZ'),
(213, 'Thailand', 'TH'),
(214, 'Togo', 'TG'),
(215, 'Tokelau', 'TK'),
(216, 'Tonga', 'TO'),
(217, 'Trinidad and Tobago', 'TT'),
(218, 'Tunisia', 'TN'),
(219, 'Turkey', 'TR'),
(220, 'Turkmenistan', 'TM'),
(221, 'Turks and Caicos Islands', 'TC'),
(222, 'Tuvalu', 'TV'),
(223, 'Uganda', 'UG'),
(224, 'Ukraine', 'UA'),
(225, 'United Arab Emirates', 'AE'),
(226, 'United Kingdom', 'GB'),
(227, 'United States minor outlying islands', 'UM'),
(228, 'Uruguay', 'UY'),
(229, 'Uzbekistan', 'UZ'),
(230, 'Vanuatu', 'VU'),
(231, 'Vatican City State', 'VA'),
(232, 'Venezuela', 'VE'),
(233, 'Vietnam', 'VN'),
(234, 'Virgin Islands (British)', 'VG'),
(235, 'Virgin Islands (U.S.)', 'VI'),
(236, 'Wallis and Futuna Islands', 'WF'),
(237, 'Western Sahara', 'EH'),
(238, 'Yemen', 'YE'),
(239, 'Yugoslavia', 'YU'),
(240, 'Zaire', 'ZR'),
(241, 'Zambia', 'ZM'),
(242, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hunreds_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `symbol`, `code`, `country`, `hunreds_name`, `status`) VALUES
(1, 'USD', '$', 'USD', '', 'cents', 0),
(2, 'TAKA', 'tk', 'BDT', '', 'paisa', 0),
(3, 'EURO', 'EUR', 'EUR', '', 'cents', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_trannsaction_details`
--

CREATE TABLE `customer_trannsaction_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_transactions_id` int(11) UNSIGNED NOT NULL,
  `customer_trannsaction _type` int(11) UNSIGNED NOT NULL,
  `stock_id` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` double NOT NULL,
  `discount_percent` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_transactions`
--

CREATE TABLE `customer_transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `person_id` int(11) NOT NULL,
  `reference_id` int(11) UNSIGNED NOT NULL,
  `reference_type` int(11) UNSIGNED NOT NULL,
  `reference` varchar(100) NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `invoice_id` int(11) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `currency` varchar(3) NOT NULL,
  `exachange_rate` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `custom_item_orders`
--

CREATE TABLE `custom_item_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `discount_percent` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cust_branch`
--

CREATE TABLE `cust_branch` (
  `branch_code` int(10) UNSIGNED NOT NULL,
  `debtor_no` int(11) NOT NULL,
  `br_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `br_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `br_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_zip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_country_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_zip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_country_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cust_branch`
--

INSERT INTO `cust_branch` (`branch_code`, `debtor_no`, `br_name`, `br_address`, `br_contact`, `billing_street`, `billing_city`, `billing_state`, `billing_zip_code`, `billing_country_id`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip_code`, `shipping_country_id`) VALUES
(1, 1, 'ZXY International', '', '', 'Cha 89/1, Pragati Soroni, North Badda', 'Bir Uttam Rafiqul Islam Ave-1212', 'Dhaka', '', 'BD', 'Cha 89/1, Pragati Soroni, North Badda', 'Bir Uttam Rafiqul Islam Ave-1212', 'Dhaka', '', 'BD'),
(2, 2, 'H & M', '', '', 'HONG KONG', 'HONG KONG', '', '', 'HK', 'Gulsan_1', 'Dhaka', 'Dhaka', '', ''),
(3, 3, 'Fipo Group', '', '', 'Esbjergvej 101  ', '6000 Kolding  Denmark', '', '', 'US', '', '', '', '', ''),
(4, 4, 'fasdf', '', '', 'sdfasdf', 'sdfsdf', 'asdfsf', 'sdfas', 'AD', 'sdfasdf', 'sdfsdf', 'asdfsf', 'sdfas', 'AD');

-- --------------------------------------------------------

--
-- Table structure for table `debtors_master`
--

CREATE TABLE `debtors_master` (
  `debtor_no` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `credit_limit` double NOT NULL,
  `invoice_template` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sales_type` int(11) NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `debtors_master`
--

INSERT INTO `debtors_master` (`debtor_no`, `name`, `email`, `password`, `currency`, `credit_limit`, `invoice_template`, `address`, `phone`, `sales_type`, `remember_token`, `inactive`, `created_at`, `updated_at`) VALUES
(1, 'ZXY International', 'sales@zxyinternational.com', '', 'BDT', 0, 'Template1', '', '880 9613 7777', 0, '', 0, '2017-12-05 10:19:14', NULL),
(2, 'H & M', 'customerservice.hk.en@hm.com', '', 'USD', 0, 'Template4', '', '800 906 312 (Local f', 0, '', 0, '2017-12-05 10:26:17', NULL),
(3, 'Fipo Group', 'info@fipogroup.com', '', 'USD', 0, 'Template4', '', '+45 76 36 35 00', 0, '', 0, '2017-12-05 10:32:22', NULL),
(4, 'fasdf', 'asd@sdf.asdf', '', 'USD', 1000, 'Template3', '', '123411', 0, '', 0, '2017-12-16 23:16:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_protocol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_encryption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_host` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_port` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`id`, `email_protocol`, `email_encryption`, `smtp_host`, `smtp_port`, `smtp_email`, `smtp_username`, `smtp_password`, `from_address`, `from_name`) VALUES
(1, 'smtp', 'tls', 'smtp.gmail.com', '587', 'stockpile.techvill@gmail.com', 'stockpile.techvill@gmail.com', 'xgldhlpedszmglvj', 'stockpile.techvill@gmail.com', 'stockpile.techvill@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `email_temp_details`
--

CREATE TABLE `email_temp_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `temp_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `lang_id` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_temp_details`
--

INSERT INTO `email_temp_details` (`id`, `temp_id`, `subject`, `body`, `lang`, `lang_id`) VALUES
(1, 2, 'Your Quotation # {order_reference_no} from {company_name} has been shipped', 'Hi {customer_name},<br><br>Thank you for your Quotation. Here’s a brief overview of your shipment:<br>Quotation # {order_reference_no} was packed on {packed_date} and shipped on {delivery_date}.<br> <br><b>Shipping address   </b><br><br>{shipping_street}<br>{shipping_city}<br>{shipping_state}<br>{shipping_zip_code}<br>{shipping_country}<br><br><b>Item Summery</b><br>{item_information}<br> <br>If you have any questions, please feel free to reply to this email.<br><br>Regards<br>{company_name}<br><br><br>', 'en', 1),
(2, 2, 'Subject', 'Body', 'ar', 2),
(3, 2, 'Subject', 'Body', 'ch', 3),
(4, 2, 'Subject', 'Body', 'fr', 4),
(5, 2, 'Subject', 'Body', 'po', 5),
(6, 2, 'Subject', 'Body', 'rs', 6),
(7, 2, 'Subject', 'Body', 'sp', 7),
(8, 2, 'Subject', 'Body', 'tu', 8),
(9, 1, 'Payment information for Quotation#{order_reference_no} and Invoice#{invoice_reference_no}.', '<p>Hi {customer_name},</p><p>Thank you for purchase our product and pay for this.</p><p>We just want to confirm a few details about payment information:</p><p><b>Customer Information</b></p><p>{billing_street}</p><p>{billing_city}</p><p>{billing_state}</p><p>{billing_zip_code}</p><p>{billing_country}<br></p><p><b>Payment Summary<br></b></p><p><b></b><i>Payment No : {payment_id}</i></p><p><i>Payment Date : {payment_date}&nbsp;</i></p><p><i>Payment Method : {payment_method} <br></i></p><p><i><b>Total Amount : {total_amount}</b></i></p><p><i>Quotation No : {order_reference_no}</i><br><i></i></p><p><i>Invoice No : {invoice_reference_no}</i><br></p><p><br></p><p>Regards,</p><p>{company_name}<br></p><br><br><br><br><br><br>', 'en', 1),
(10, 1, 'Subject', 'Body', 'ar', 2),
(11, 1, 'Subject', 'Body', 'ch', 3),
(12, 1, 'Subject', 'Body', 'fr', 4),
(13, 1, 'Subject', 'Body', 'po', 5),
(14, 1, 'Subject', 'Body', 'rs', 6),
(15, 1, 'Subject', 'Body', 'sp', 7),
(16, 1, 'Subject', 'Body', 'tu', 8),
(17, 3, 'Payment information for Quotation#{order_reference_no} and Invoice#{invoice_reference_no}.', '<p>Hi {customer_name},</p><p>Thank you for purchase our product and pay for this.</p><p>We just want to confirm a few details about payment information:</p><p><b>Customer Information</b></p><p>{billing_street}</p><p>{billing_city}</p><p>{billing_state}</p><p>{billing_zip_code}<br></p><p>{billing_country}<br>&nbsp; &nbsp; &nbsp; &nbsp; <br></p><p><b>Payment Summary<br></b></p><p><b></b><i>Payment No : {payment_id}</i></p><p><i>Payment Date : {payment_date}&nbsp;</i></p><p><i>Payment Method : {payment_method} <br></i></p><p><i><b>Total Amount : {total_amount}</b><br>Quotation No : {order_reference_no}<br>&nbsp;</i><i>Invoice No : {invoice_reference_no}<br>&nbsp;</i>Regards,</p><p>{company_name} <br></p><br>', 'en', 1),
(18, 3, 'Subject', 'Body', 'ar', 2),
(19, 3, 'Subject', 'Body', 'ch', 3),
(20, 3, 'Subject', 'Body', 'fr', 4),
(21, 3, 'Subject', 'Body', 'po', 5),
(22, 3, 'Subject', 'Body', 'rs', 6),
(23, 3, 'Subject', 'Body', 'sp', 7),
(24, 3, 'Subject', 'Body', 'tu', 8),
(25, 4, 'Your Invoice # {invoice_reference_no} for Quotation #{order_reference_no} from {company_name} has been created.', '<p>Hi {customer_name},</p><p>Thank you for your order. Here’s a brief overview of your invoice: Invoice #{invoice_reference_no} is for Quotation #{order_reference_no}. The invoice total is {currency}{total_amount}, please pay before {due_date}.</p><p>If you have any questions, please feel free to reply to this email. </p><p><b>Billing address</b></p><p>&nbsp;{billing_street}</p><p>&nbsp;{billing_city}</p><p>&nbsp;{billing_state}</p><p>&nbsp;{billing_zip_code}</p><p>&nbsp;{billing_country}<br></p><p><br></p><p><b>Quotation summary<br></b></p><p><b></b>{invoice_summery}<br></p><p>Regards,</p><p>{company_name}<br></p><br><br>', 'en', 1),
(26, 4, 'Subject', 'Body', 'ar', 2),
(27, 4, 'Subject', 'Body', 'ch', 3),
(28, 4, 'Subject', 'Body', 'fr', 4),
(29, 4, 'Subject', 'Body', 'po', 5),
(30, 4, 'Subject', 'Body', 'rs', 6),
(31, 4, 'Subject', 'Body', 'sp', 7),
(32, 4, 'Subject', 'Body', 'tu', 8),
(33, 5, 'Your Quotation # {order_reference_no} from {company_name} has been created.', '<p>Hi {customer_name},</p><p>Thank you for your order. Here’s a brief overview of your Quotation #{order_reference_no} that was created on {order_date}. The order total is {currency}{total_amount}.</p><p>If you have any questions, please feel free to reply to this email. </p><p><b>Billing address</b></p><p>&nbsp;{billing_street}</p><p>&nbsp;{billing_city}</p><p>&nbsp;{billing_state}</p><p>&nbsp;{billing_zip_code}</p><p>&nbsp;{billing_country}<br></p><p><br></p><p><b>Quotation summary<br></b></p><p><b></b>{order_summery}<br></p><p>Regards,</p><p>{company_name}</p><br><br>', 'en', 1),
(34, 5, 'Subject', 'Body', 'ar', 2),
(35, 5, 'Subject', 'Body', 'ch', 3),
(36, 5, 'Subject', 'Body', 'fr', 4),
(37, 5, 'Subject', 'Body', 'po', 5),
(38, 5, 'Subject', 'Body', 'rs', 6),
(39, 5, 'Subject', 'Body', 'sp', 7),
(40, 5, 'Subject', 'Body', 'tu', 8),
(41, 6, 'Your Quotation # {order_reference_no} from {company_name} has been packed', 'Hi {customer_name},<br><br>Thank you for your order. Here’s a brief overview of your shipment:<br>Quotation # {order_reference_no} was packed on {packed_date}.<br> <br><b>Shipping address   </b><br><br>{shipping_street}<br>{shipping_city}<br>{shipping_state}<br>{shipping_zip_code}<br>{shipping_country}<br><br><b>Item Summery</b><br>{item_information}<br> <br>If you have any questions, please feel free to reply to this email.<br><br>Regards<br>{company_name}<br><br><br>', 'en', 1),
(42, 6, 'Subject', 'Body', 'ar', 2),
(43, 6, 'Subject', 'Body', 'ch', 3),
(44, 6, 'Subject', 'Body', 'fr', 4),
(45, 6, 'Subject', 'Body', 'po', 5),
(46, 6, 'Subject', 'Body', 'rs', 6),
(47, 6, 'Subject', 'Body', 'sp', 7),
(48, 6, 'Subject', 'Body', 'tu', 8);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rates`
--

CREATE TABLE `exchange_rates` (
  `id` int(11) NOT NULL,
  `currency_code` varchar(3) NOT NULL,
  `rate` double NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exchange_rates`
--

INSERT INTO `exchange_rates` (`id`, `currency_code`, `rate`, `date`) VALUES
(1, 'BDT', 1, '2017-12-06'),
(2, 'EUR', 95, '2017-12-06'),
(3, 'USD', 80, '2017-12-06'),
(4, 'USD', 81, '2017-12-07'),
(5, 'BDT', 1, '2017-12-07'),
(6, 'EUR', 90, '2017-12-07'),
(7, 'BDT', 0, '2017-12-08'),
(8, 'BDT', 0, '2017-12-08'),
(9, 'BDT', 0, '2017-12-08'),
(10, 'BDT', 0, '2017-12-08'),
(11, 'BDT', 0, '2017-12-08'),
(12, 'USD', 80, '2017-12-08'),
(13, 'BDT', 0, '2017-12-08'),
(14, 'BDT', 0, '2017-12-08'),
(15, 'BDT', 0, '2017-12-10'),
(16, 'BDT', 0, '2017-12-10'),
(17, 'BDT', 0, '2017-12-10'),
(18, 'USD', 80, '2017-12-10'),
(19, 'BDT', 0, '2017-12-10'),
(20, 'USD', 80, '2017-12-10'),
(21, 'BDT', 0, '2017-12-10'),
(22, 'BDT', 0, '2017-12-10'),
(23, 'BDT', 0, '2017-12-10'),
(24, 'EUR', 95, '2017-12-10'),
(25, 'BDT', 0, '2017-12-10'),
(26, 'EUR', 95, '2017-12-10'),
(27, 'EUR', 95, '2017-12-10'),
(28, 'EUR', 95, '2017-12-10'),
(29, 'BDT', 0, '2017-12-10'),
(30, 'USD', 82, '2017-12-11'),
(31, 'EUR', 0, '2017-12-11'),
(32, 'EUR', 96, '2017-12-11'),
(33, 'BDT', 0, '2017-12-11'),
(34, 'BDT', 1, '2017-12-11'),
(35, 'USD', 82, '2017-12-11'),
(36, 'USD', 82, '2017-12-11'),
(37, 'USD', 82, '2017-12-11'),
(38, 'USD', 82, '2017-12-11'),
(39, 'USD', 80, '2017-12-12'),
(40, 'BDT', 1, '2017-12-13'),
(41, 'USD', 82.555, '2017-12-13'),
(42, 'BDT', 0, '2017-12-14'),
(43, 'BDT', 0, '2017-12-17'),
(44, 'BDT', 1, '2017-12-18'),
(45, 'USD', 80, '2017-12-18'),
(46, 'EUR', 90, '2017-12-18'),
(63, 'USD', 80, '2017-12-19'),
(49, 'USD', 80, '2017-12-20'),
(64, 'BDT', 1, '2017-12-19'),
(65, 'EUR', 98, '2017-12-23'),
(66, 'BDT', 1, '2017-12-20'),
(67, 'USD', 0, '2017-12-24'),
(60, 'USD', 0, '2017-12-22'),
(61, 'BDT', 0, '2017-12-21'),
(62, 'BDT', 1, '2017-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `expense_transactions`
--

CREATE TABLE `expense_transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `person_id` int(11) NOT NULL,
  `reference_id` int(11) UNSIGNED NOT NULL,
  `reference_type` int(11) UNSIGNED NOT NULL,
  `reference` varchar(100) NOT NULL,
  `expense_date` date NOT NULL,
  `currency` varchar(3) NOT NULL,
  `exachange_rate` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_ledger_transactions`
--

CREATE TABLE `general_ledger_transactions` (
  `id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_type` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(3) NOT NULL,
  `exchange_rate` double NOT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_ledger_transactions`
--

INSERT INTO `general_ledger_transactions` (`id`, `reference_id`, `reference_type`, `person_id`, `account_id`, `memo`, `amount`, `currency`, `exchange_rate`, `transaction_date`, `created_at`) VALUES
(1, 1, 6, 1, 3, '', 5000, 'BDT', 1, '2017-12-18', '2017-12-18 08:24:40'),
(2, 1, 6, 1, 71, '', -5000, 'BDT', 1, '2017-12-18', '2017-12-18 08:24:40'),
(3, 2, 7, 1, 71, '', 1000, 'BDT', 1, '2017-12-18', '2017-12-18 08:25:17'),
(4, 2, 7, 1, 4, '', -1000, 'BDT', 1, '2017-12-18', '2017-12-18 08:25:17'),
(5, 3, 6, 1, 3, 'Loan From Office', 1500, 'BDT', 1, '2017-12-18', '2017-12-18 09:26:15'),
(6, 3, 6, 1, 71, 'Loan From Office', -1500, 'BDT', 1, '2017-12-18', '2017-12-18 09:26:15'),
(7, 4, 7, 1, 71, '', 500, 'BDT', 1, '2017-12-18', '2017-12-18 10:05:20'),
(8, 4, 7, 1, 4, '', -500, 'BDT', 1, '2017-12-18', '2017-12-18 10:05:20'),
(9, 5, 6, 1, 3, '', 50, 'USD', 80, '2017-12-18', '2017-12-18 11:46:18'),
(10, 5, 6, 1, 22, '', -50, 'USD', 80, '2017-12-18', '2017-12-18 11:46:18'),
(11, 6, 4, 1, 68, 'Payment for PO-0001', 200, 'BDT', 1, '2017-12-19', '2017-12-19 05:10:48'),
(12, 6, 4, 1, 71, 'Payment for PO-0001', -200, 'BDT', 1, '2017-12-19', '2017-12-19 05:10:48'),
(13, 7, 2, 1, 29, '', -200, 'BDT', 1, '2017-12-19', '2017-12-19 05:11:56'),
(14, 7, 2, 1, 71, '', 200, 'BDT', 1, '2017-12-19', '2017-12-19 05:11:56'),
(15, 8, 1, 1, 9, '', 450, 'EUR', 90, '2017-12-19', '2017-12-19 05:56:42'),
(16, 8, 1, 1, 22, '', -450, 'EUR', 90, '2017-12-19', '2017-12-19 05:56:42'),
(17, 9, 5, 1, 71, 'Payment for INV-0003', 9000, 'EUR', 90, '2017-12-19', '2017-12-19 06:34:30'),
(18, 9, 5, 1, 22, 'Payment for INV-0003', -9000, 'EUR', 90, '2017-12-19', '2017-12-19 06:34:30'),
(19, 10, 5, 1, 71, 'Payment for INV-0003', 40500, 'EUR', 90, '2017-12-19', '2017-12-19 06:39:52'),
(20, 10, 5, 1, 22, 'Payment for INV-0003', -40500, 'EUR', 90, '2017-12-19', '2017-12-19 06:39:52'),
(21, 11, 3, 1, 22, '', 800, 'USD', 80, '2017-12-19', '2017-12-19 12:32:34'),
(22, 11, 3, 1, 72, '', 0, 'USD', 80, '2017-12-19', '2017-12-19 12:32:34'),
(23, 11, 3, 1, 71, '', -800, 'USD', 80, '2017-12-19', '2017-12-19 12:32:34'),
(24, 12, 6, 4, 3, '', 49000, 'EUR', 98, '2017-12-23', '2017-12-20 05:15:07'),
(25, 12, 6, 4, 71, '', -49000, 'EUR', 98, '2017-12-23', '2017-12-20 05:15:07'),
(26, 13, 6, 4, 3, '', 8000, 'USD', 80, '2017-12-20', '2017-12-20 05:16:11'),
(27, 13, 6, 4, 71, '', -8000, 'USD', 80, '2017-12-20', '2017-12-20 05:16:11'),
(28, 14, 6, 4, 3, '', 500, 'BDT', 1, '2017-12-20', '2017-12-20 10:57:56'),
(29, 14, 6, 4, 71, '', -500, 'BDT', 1, '2017-12-20', '2017-12-20 10:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `income_expense_categories`
--

CREATE TABLE `income_expense_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `income_expense_categories`
--

INSERT INTO `income_expense_categories` (`id`, `name`, `type`) VALUES
(1, 'Sales', 'income'),
(2, 'Sallery', 'income'),
(3, 'Utility Bill', 'expense'),
(4, 'Repair & MaintEnance', 'expense'),
(5, 'Purchase', 'expense');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment_terms`
--

CREATE TABLE `invoice_payment_terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `terms` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `days_before_due` int(10) NOT NULL,
  `defaults` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_payment_terms`
--

INSERT INTO `invoice_payment_terms` (`id`, `terms`, `days_before_due`, `defaults`) VALUES
(1, 'Net 15', 15, 0),
(2, 'Net 30', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_code`
--

CREATE TABLE `item_code` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_code`
--

INSERT INTO `item_code` (`id`, `stock_id`, `description`, `category_id`, `item_image`, `inactive`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, 'BNS-01', 'BOAT NECK SWEATER', 1, '', 0, 0, '2017-12-05 05:41:04', NULL),
(2, 'JK-01', 'CASHMERE BLEND JACKET', 4, '', 0, 0, '2017-12-05 05:43:07', NULL),
(3, '001', 'CASHMERE SHAWL', 1, 'Lighthouse.jpg', 0, 0, '2017-12-05 07:54:22', '2017-12-05 02:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `item_tax_types`
--

CREATE TABLE `item_tax_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tax_rate` double(8,2) NOT NULL,
  `defaults` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_tax_types`
--

INSERT INTO `item_tax_types` (`id`, `name`, `tax_rate`, `defaults`) VALUES
(1, 'Taxes', 10.00, 1),
(2, 'No Tax', 0.00, 0),
(3, 'Normal', 5.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_unit`
--

CREATE TABLE `item_unit` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_unit`
--

INSERT INTO `item_unit` (`id`, `abbr`, `name`, `inactive`, `created_at`, `updated_at`) VALUES
(1, 'abbr1', 'unit1', 0, '2017-11-18 06:21:39', NULL),
(2, 'DZ', 'Dozon', 0, '2017-11-29 04:27:03', NULL),
(3, 'PC', 'Piece', 0, '2017-11-29 04:27:15', '2017-12-05 01:48:55'),
(4, 'M', 'Miter', 0, '2017-11-29 04:27:27', NULL),
(5, 'CM', 'Centi Miter', 0, '2017-11-29 04:27:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(11) UNSIGNED NOT NULL,
  `reference_id` int(11) UNSIGNED NOT NULL,
  `reference_type` int(11) UNSIGNED NOT NULL,
  `reference` varchar(100) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `exchange_rate` double NOT NULL,
  `amount` double NOT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(10) UNSIGNED NOT NULL,
  `loc_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `location_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_address` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `loc_code`, `location_name`, `delivery_address`, `email`, `phone`, `fax`, `contact`, `inactive`, `created_at`, `updated_at`) VALUES
(1, 'PL', 'RATOOL APPARELS ', 'ANSER ROAD ,VANGNAHATI, SREEPUR, GAZIPUR', 'hossain@ratoolapparels.com', '', '', 'Mr. Hossain', 0, '2017-09-17 05:43:32', '2017-11-14 00:24:37'),
(2, 'JA', 'RODDUR APPARELS', 'sharippur , hariken road , joydebpur, gazipur', 'hossain@ratoolapparels.com', '', '', 'Mr. Hossain', 1, '2017-09-17 05:43:32', '2017-11-14 00:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2015_09_26_161159_entrust_setup_tables', 1),
('2016_08_30_100832_create_users_table', 1),
('2016_08_30_104058_create_security_role_table', 1),
('2016_08_30_104506_create_stock_category_table', 1),
('2016_08_30_105339_create_location_table', 1),
('2016_08_30_110408_create_item_code_table', 1),
('2016_08_30_114231_create_item_unit_table', 1),
('2016_09_02_070031_create_stock_master_table', 1),
('2016_09_20_123717_create_stock_move_table', 1),
('2016_10_05_113244_create_debtor_master_table', 1),
('2016_10_05_113333_create_sales_orders_table', 1),
('2016_10_05_113356_create_sales_order_details_table', 1),
('2016_10_18_060431_create_supplier_table', 1),
('2016_10_18_063931_create_purch_order_table', 1),
('2016_10_18_064211_create_purch_order_detail_table', 1),
('2016_11_15_121343_create_preference_table', 1),
('2016_12_01_130110_create_shipment_table', 1),
('2016_12_01_130443_create_shipment_details_table', 1),
('2016_12_03_051429_create_sale_price_table', 1),
('2016_12_03_052017_create_sales_types_table', 1),
('2016_12_03_061206_create_purchase_price_table', 1),
('2016_12_03_062131_create_payment_term_table', 1),
('2016_12_03_062247_create_payment_history_table', 1),
('2016_12_03_062932_create_item_tax_type_table', 1),
('2016_12_03_063827_create_invoice_payment_term_table', 1),
('2016_12_03_064157_create_email_temp_details_table', 1),
('2016_12_03_064747_create_email_config_table', 1),
('2016_12_03_065532_create_cust_branch_table', 1),
('2016_12_03_065915_create_currency_table', 1),
('2016_12_03_070030_create_country_table', 1),
('2016_12_03_070030_create_stock_transfer_table', 1),
('2016_12_03_071018_create_backup_table', 1),
('2017_03_20_104506_create_bank_account_type_table', 1),
('2017_03_20_104506_create_bank_accounts_table', 1),
('2017_03_20_104506_create_bank_trans_table', 1),
('2017_03_20_104506_create_custom_item_orders_table', 1),
('2017_03_20_104506_create_income_expense_categories_table', 1),
('2017_03_20_104506_create_month_table', 1),
('2017_04_10_062131_create_payment_gateway_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'Appril'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@techvill.net', 'WW9Dc3BwUG1SdVdlTFNURmdBcDV0MnBUSmFiNnZFWUVUdTdmQ2Y4T1lMcz0=', '2017-10-15 23:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway`
--

CREATE TABLE `payment_gateway` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_gateway`
--

INSERT INTO `payment_gateway` (`id`, `name`, `value`, `site`) VALUES
(1, 'username', 'techvillage_business_api1.gmail.com', 'PayPal'),
(2, 'password', '9DDYZX2JLA6QL668', 'PayPal'),
(3, 'signature', 'AFcWxV21C7fd0v3bYYYRCpSSRl31ABayz5pdk84jno7.Udj6-U8ffwbT', 'PayPal'),
(4, 'mode', 'sandbox', 'PayPal');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `order_reference` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_reference` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_date` date NOT NULL,
  `amount` double DEFAULT '0',
  `person_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'completed',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_type` enum('sale','purchase') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_terms`
--

CREATE TABLE `payment_terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `defaults` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_terms`
--

INSERT INTO `payment_terms` (`id`, `name`, `defaults`) VALUES
(1, 'Cash', 0),
(2, 'Bank', 1),
(3, 'Cheque', 0);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'manage_relationship', 'Manage Relationship', 'Manage Relationship', NULL, NULL),
(2, 'manage_customer', 'Manage Customers', 'Manage Customers', NULL, NULL),
(3, 'add_customer', 'Add Customer', 'Add Customer', NULL, NULL),
(4, 'edit_customer', 'Edit Customer', 'Edit Customer', NULL, NULL),
(5, 'delete_customer', 'Delete Customer', 'Delete Customer', NULL, NULL),
(6, 'manage_supplier', 'Manage Suppliers', 'Manage Suppliers', NULL, NULL),
(7, 'add_supplier', 'Add Supplier', 'Add Supplier', NULL, NULL),
(8, 'edit_supplier', 'Edit Supplier', 'Edit Supplier', NULL, NULL),
(9, 'delete_supplier', 'Delete Supplier', 'Delete Supplier', NULL, NULL),
(10, 'manage_item', 'Manage Items', 'Manage Items', NULL, NULL),
(11, 'add_item', 'Add Item', 'Add Item', NULL, NULL),
(12, 'edit_item', 'Edit Item', 'Edit Item', NULL, NULL),
(13, 'delete_item', 'Delete Item', 'Delete Item', NULL, NULL),
(14, 'manage_sale', 'Manage Sales', 'Manage Sales', NULL, NULL),
(15, 'manage_quotation', 'Manage Quotations', 'Manage Quotations', NULL, NULL),
(16, 'add_quotation', 'Add Quotation', 'Add Quotation', NULL, NULL),
(17, 'edit_quotation', 'Edit Quotation', 'Edit Quotation', NULL, NULL),
(18, 'delete_quotation', 'Delete Quotation', 'Delete Quotation', NULL, NULL),
(19, 'manage_invoice', 'Manage Invoices', 'Manage Invoices', NULL, NULL),
(20, 'add_invoice', 'Add Invoice', 'Add Invoice', NULL, NULL),
(21, 'edit_invoice', 'Edit Invoice', 'Edit Invoice', NULL, NULL),
(22, 'delete_invoice', 'Delete Invoice', 'Delete Invoice', NULL, NULL),
(23, 'manage_payment', 'Manage Payment', 'Manage Payment', NULL, NULL),
(24, 'add_payment', 'Add Payment', 'Add Payment', NULL, NULL),
(25, 'edit_payment', 'Edit Payment', 'Edit Payment', NULL, NULL),
(26, 'delete_payment', 'Delete Payment', 'Delete Payment', NULL, NULL),
(27, 'manage_purchase', 'Manage Purchase', 'Manage Purchase', NULL, NULL),
(28, 'add_purchase', 'Add Purchase', 'Add Purchase', NULL, NULL),
(29, 'edit_purchase', 'Edit Purchase', 'Edit Purchase', NULL, NULL),
(30, 'delete_purchase', 'Delete Purchase', 'Delete Purchase', NULL, NULL),
(31, 'manage_banking_transaction', 'Manage Banking & Transactions', 'Manage Banking & Transactions', NULL, NULL),
(32, 'manage_bank_account', 'Manage Bank Accounts', 'Manage Bank Accounts', NULL, NULL),
(33, 'add_bank_account', 'Add Bank Account', 'Add Bank Account', NULL, NULL),
(34, 'edit_bank_account', 'Edit Bank Account', 'Edit Bank Account', NULL, NULL),
(35, 'delete_bank_account', 'Delete Bank Account', 'Delete Bank Account', NULL, NULL),
(36, 'manage_deposit', 'Manage Deposit', 'Manage Deposit', NULL, NULL),
(37, 'add_deposit', 'Add Deposit', 'Add Deposit', NULL, NULL),
(38, 'edit_deposit', 'Edit Deposit', 'Edit Deposit', NULL, NULL),
(39, 'delete_deposit', 'Delete Deposit', 'Delete Deposit', NULL, NULL),
(40, 'manage_balance_transfer', 'Manage Balance Transfer', 'Manage Balance Transfer', NULL, NULL),
(41, 'add_balance_transfer', 'Add Balance Transfer', 'Add Balance Transfer', NULL, NULL),
(42, 'edit_balance_transfer', 'Edit Balance Transfer', 'Edit Balance Transfer', NULL, NULL),
(43, 'delete_balance_transfer', 'Delete Balance Transfer', 'Delete Balance Transfer', NULL, NULL),
(44, 'manage_transaction', 'Manage Transactions', 'Manage Transactions', NULL, NULL),
(45, 'manage_expense', 'Manage Expense', 'Manage Expense', NULL, NULL),
(46, 'add_expense', 'Add Expense', 'Add Expense', NULL, NULL),
(47, 'edit_expense', 'Edit Expense', 'Edit Expense', NULL, NULL),
(48, 'delete_expense', 'Delete Expense', 'Delete Expense', NULL, NULL),
(49, 'manage_report', 'Manage Report', 'Manage Report', NULL, NULL),
(50, 'manage_stock_on_hand', 'Manage Inventory Stock On Hand', 'Manage Inventory Stock On Hand', NULL, NULL),
(51, 'manage_sale_report', 'Manage Sales Report', 'Manage Sales Report', NULL, NULL),
(52, 'manage_sale_history_report', 'Manage Sales History Report', 'Manage Sales History Report', NULL, NULL),
(53, 'manage_purchase_report', 'Manage Purchase Report', 'Manage Purchase Report', NULL, NULL),
(54, 'manage_team_report', 'Manage Team Member Report', 'Manage Team Member Report', NULL, NULL),
(55, 'manage_expense_report', 'Manage Expense Report', 'Manage Expense Report', NULL, NULL),
(56, 'manage_income_report', 'Manage Income Report', 'Manage Income Report', NULL, NULL),
(57, 'manage_income_vs_expense', 'Manage Income vs Expense', 'Manage Income vs Expense', NULL, NULL),
(58, 'manage_setting', 'Manage Settings', 'Manage Settings', NULL, NULL),
(59, 'manage_company_setting', 'Manage Company Setting', 'Manage Company Setting', NULL, NULL),
(60, 'manage_team_member', 'Manage Team Member', 'Manage Team Member', NULL, NULL),
(61, 'add_team_member', 'Add Team Member', 'Add Team Member', NULL, NULL),
(62, 'edit_team_member', 'Edit Team Member', 'Edit Team Member', NULL, NULL),
(63, 'delete_team_member', 'Delete Team Member', 'Delete Team Member', NULL, NULL),
(64, 'manage_role', 'Manage Roles', 'Manage Roles', NULL, NULL),
(65, 'add_role', 'Add Role', 'Add Role', NULL, NULL),
(66, 'edit_role', 'Edit Role', 'Edit Role', NULL, NULL),
(67, 'delete_role', 'Delete Role', 'Delete Role', NULL, NULL),
(68, 'manage_location', 'Manage Location', 'Manage Location', NULL, NULL),
(69, 'add_location', 'Add Location', 'Add Location', NULL, NULL),
(70, 'edit_location', 'Edit Location', 'Edit Location', NULL, NULL),
(71, 'delete_location', 'Delete Location', 'Delete Location', NULL, NULL),
(72, 'manage_general_setting', 'Manage General Settings', 'Manage General Settings', NULL, NULL),
(73, 'manage_item_category', 'Manage Item Category', 'Manage Item Category', NULL, NULL),
(74, 'add_item_category', 'Add Item Category', 'Add Item Category', NULL, NULL),
(75, 'edit_item_category', 'Edit Item Category', 'Edit Item Category', NULL, NULL),
(76, 'delete_item_category', 'Delete Item Category', 'Delete Item Category', NULL, NULL),
(77, 'manage_income_expense_category', 'Manage Income Expense Category', 'Manage Income Expense Category', NULL, NULL),
(78, 'add_income_expense_category', 'Add Income Expense Category', 'Add Income Expense Category', NULL, NULL),
(79, 'edit_income_expense_category', 'Edit Income Expense Category', 'Edit Income Expense Category', NULL, NULL),
(80, 'delete_income_expense_category', 'Delete Income Expense Category', 'Delete Income Expense Category', NULL, NULL),
(81, 'manage_unit', 'Manage Unit', 'Manage Unit', NULL, NULL),
(82, 'add_unit', 'Add Unit', 'Add Unit', NULL, NULL),
(83, 'edit_unit', 'Edit Unit', 'Edit Unit', NULL, NULL),
(84, 'delete_unit', 'Delete Unit', 'Delete Unit', NULL, NULL),
(85, 'manage_db_backup', 'Manage Database Backup', 'Manage Database Backup', NULL, NULL),
(86, 'add_db_backup', 'Add Database Backup', 'Add Database Backup', NULL, NULL),
(87, 'delete_db_backup', 'Delete Database Backup', 'Delete Database Backup', NULL, NULL),
(88, 'manage_email_setup', 'Manage Email Setup', 'Manage Email Setup', NULL, NULL),
(89, 'manage_finance', 'Manage Finance', 'Manage Finance', NULL, NULL),
(90, 'manage_tax', 'Manage Taxs', 'Manage Taxs', NULL, NULL),
(91, 'add_tax', 'Add Tax', 'Add Tax', NULL, NULL),
(92, 'edit_tax', 'Edit Tax', 'Edit Tax', NULL, NULL),
(93, 'delete_tax', 'Delete Tax', 'Delete Tax', NULL, NULL),
(94, 'manage_currency', 'Manage Currency', 'Manage Currency', NULL, NULL),
(95, 'add_currency', 'Add Currency', 'Add Currency', NULL, NULL),
(96, 'edit_currency', 'Edit Currency', 'Edit Currency', NULL, NULL),
(97, 'delete_currency', 'Delete Currency', 'Delete Currency', NULL, NULL),
(98, 'manage_payment_term', 'Manage Payment Term', 'Manage Payment Term', NULL, NULL),
(99, 'add_payment_term', 'Add Payment Term', 'Add Payment Term', NULL, NULL),
(100, 'edit_payment_term', 'Edit Payment Term', 'Edit Payment Term', NULL, NULL),
(101, 'delete_payment_term', 'Delete Payment Term', 'Delete Payment Term', NULL, NULL),
(102, 'manage_payment_method', 'Manage Payment Method', 'Manage Payment Method', NULL, NULL),
(103, 'add_payment_method', 'Add Payment Method', 'Add Payment Method', NULL, NULL),
(104, 'edit_payment_method', 'Edit Payment Method', 'Edit Payment Method', NULL, NULL),
(105, 'delete_payment_method', 'Delete Payment Method', 'Delete Payment Method', NULL, NULL),
(106, 'manage_payment_gateway', 'Manage Payment Method', 'Manage Payment Gateway', NULL, NULL),
(107, 'manage_email_template', 'Manage Email Template', 'Manage Email Template', NULL, NULL),
(108, 'manage_quotation_email_template', 'Manage Quotation Template', 'Manage Quotation Email Template', NULL, NULL),
(109, 'manage_invoice_email_template', 'Manage Invoice Email Template', 'Manage Invoice Email Template', NULL, NULL),
(110, 'manage_payment_email_template', 'Manage Payment Email Template', 'Manage Payment Email Template', NULL, NULL),
(111, 'manage_preference', 'Manage Preference', 'Manage Preference', NULL, NULL),
(112, 'manage_barcode', 'Manage barcode/label', 'Manage barcode/label', NULL, NULL),
(113, 'download_db_backup', 'Download Database Backup', 'Download Database Backup', NULL, NULL),
(114, 'manage_transfer', 'Manage Transfer', 'Manage Transfer', NULL, NULL),
(115, 'delete_transfer', 'Delete Transfer', 'Delete Transfer', NULL, NULL),
(116, 'add_transfer', 'Add Transfer', 'Add Transfer', NULL, NULL),
(117, 'manage_adjustment', 'Add Adjustment', 'Add Adjustment', NULL, NULL),
(118, 'add_adjustment', 'Add adjustment', 'Add adjustment', NULL, NULL),
(119, 'delete_adjustment', 'Delete adjustment', 'Delete adjustment', NULL, NULL),
(120, 'edit_adjustment', 'Edit adjustment', 'Edit adjustment', NULL, NULL),
(121, 'manage_general_ledger', 'Manage General Ledger', 'Manage General Ledger', NULL, NULL),
(122, 'manage_gl_account_group', 'Manage GL Account Group', 'Manage GL Account Group', NULL, NULL),
(123, 'add_gl_account_group', 'Add GL Account Group', 'Add GL Account Group', NULL, NULL),
(124, 'edit_gl_account_group', 'Edit GL Account Group', 'Edit GL Account Group', NULL, NULL),
(125, 'manage_gl_account', 'Manage GL Account', 'Manage GL Account', NULL, NULL),
(126, 'add_gl_account', 'Add GL Account', 'Add GL Account', NULL, NULL),
(127, 'edit_gl_account', 'Edit GL Account', 'Edit GL Account', NULL, NULL),
(128, 'manage_gl_transaction', 'Manage GL Transaction', 'Manage GL Transaction', NULL, NULL),
(129, 'add_gl_Payment', 'Add GL Payment', 'Add GL Payment', NULL, NULL),
(130, 'edit_gl_Payment', 'Edit GL Payment', 'Edit GL Payment', NULL, NULL),
(131, 'manage_bank_transaction', 'Manage bank Transaction', 'Manage bank Transaction', NULL, NULL),
(132, 'manage_bank_account_type', 'Manage Bank Account Type', 'Manage Bank Account Type', NULL, NULL),
(133, 'add_bank_account_type', 'Add Bank Account Type', 'Add Bank Account Type', NULL, NULL),
(134, 'edit_bank_account_type', 'Edit Bank Account Type', 'Edit Bank Account Type', NULL, NULL),
(135, 'delete_bank_account_type', 'Delete Bank Account Type', 'Delete Bank Account Type', NULL, NULL),
(136, 'manage_person_transaction', 'Manage User Transaction', 'Manage User Transaction', NULL, NULL),
(137, 'add_employee_transaction', 'Add User Transaction', 'Add User Transaction', NULL, NULL),
(138, 'manage_user_group', 'Manage User Group', 'Manage User Group', NULL, NULL),
(139, 'add_user_group', 'Add User Group', 'Add User Group', NULL, NULL),
(140, 'edit_user_group', 'Edit User Group', 'Edit User Group', NULL, NULL),
(141, 'delete_user_group', 'Delete User Group', 'Delete User Group', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(44, 3),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(121, 2),
(122, 1),
(122, 2),
(123, 1),
(123, 2),
(124, 1),
(124, 2),
(125, 1),
(125, 2),
(126, 1),
(126, 2),
(127, 1),
(127, 2),
(128, 1),
(128, 2),
(129, 1),
(129, 2),
(130, 1),
(130, 2),
(131, 1),
(131, 2),
(132, 1),
(132, 2),
(133, 1),
(133, 2),
(134, 1),
(134, 2),
(135, 1),
(135, 2),
(136, 1),
(136, 2),
(136, 3),
(137, 1),
(137, 2),
(137, 3),
(138, 1),
(139, 1),
(140, 1),
(141, 1);

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE `preference` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `preference`
--

INSERT INTO `preference` (`id`, `category`, `field`, `value`) VALUES
(1, 'preference', 'row_per_page', '25'),
(2, 'preference', 'date_format', '1'),
(3, 'preference', 'date_sepa', '-'),
(4, 'preference', 'soft_name', 'goBilling'),
(5, 'company', 'site_short_name', 'RA'),
(6, 'preference', 'percentage', '0'),
(7, 'preference', 'quantity', '0'),
(8, 'preference', 'date_format_type', 'dd-mm-yyyy'),
(9, 'company', 'company_name', 'RATOOL APPARELS LTD'),
(10, 'company', 'company_email', 'hossain@ratoolapparels.com'),
(11, 'company', 'company_phone', '8418508'),
(12, 'company', 'company_street', 'HOUSE 288 1ST FL, ROAD 04, BARIDHARA DOHS'),
(13, 'company', 'company_city', 'DHAKA'),
(14, 'company', 'company_state', 'BANGLADESH'),
(15, 'company', 'company_zipCode', '1206'),
(16, 'company', 'company_country_id', 'Bangladesh'),
(17, 'company', 'dflt_lang', 'en'),
(18, 'company', 'dflt_currency_id', '2'),
(19, 'company', 'sales_type_id', '1'),
(20, 'company', 'company_logo', '1_1506506670.png'),
(21, 'company', 'exchange_type', 'Current'),
(22, 'company', 'term_condition', 'This term and condition222'),
(24, 'company', 'signature', 'signature.jpg'),
(25, 'gl_account', 'sup_debit_gl_account', '68'),
(26, 'gl_account', 'sup_credit_gl_account', '33'),
(27, 'gl_account', 'cus_debit_gl_account', '21'),
(28, 'gl_account', 'cus_credit_gl_account', '22'),
(29, 'gl_account', 'user_trans_debit_gl_account', '3'),
(30, 'gl_account', 'user_trans_credit_gl_account', '4'),
(31, 'gl_account', 'bank_charge_gl_account', '72');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_prices`
--

CREATE TABLE `purchase_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_prices`
--

INSERT INTO `purchase_prices` (`id`, `stock_id`, `price`) VALUES
(1, 'BNS-01', 200),
(2, 'JK-01', 200),
(3, '001', 400);

-- --------------------------------------------------------

--
-- Table structure for table `purch_orders`
--

CREATE TABLE `purch_orders` (
  `order_no` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `ord_date` date NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `in_house_date` date DEFAULT NULL,
  `reference` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `into_stock_location` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `exchange_rate` double NOT NULL,
  `total` double NOT NULL DEFAULT '0',
  `paid_amount` double NOT NULL DEFAULT '0',
  `term_conditions` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purch_orders`
--

INSERT INTO `purch_orders` (`order_no`, `supplier_id`, `person_id`, `comments`, `ord_date`, `delivery_date`, `in_house_date`, `reference`, `into_stock_location`, `currency_code`, `exchange_rate`, `total`, `paid_amount`, `term_conditions`) VALUES
(1, 1, 1, 'This term and condition222', '2017-12-17', '2017-12-17', '2017-12-17', 'PO-0001', 'PL', 'BDT', 1, 2200, 200, NULL),
(2, 1, 1, 'This term and condition222', '2017-12-19', '2017-12-19', '2017-12-19', 'PO-0002', 'PL', 'BDT', 1, 440, 0, NULL),
(3, 1, 4, 'This term and condition222', '2017-12-19', '2017-12-19', '2017-12-19', 'PO-0003', 'PL', 'BDT', 1, 2200, 0, NULL),
(4, 1, 4, 'This term and condition222', '2017-12-19', '2017-12-19', '2017-12-19', 'PO-0004', 'PL', 'EUR', 90, 11000, 0, NULL),
(5, 9, 1, 'This term and condition222', '2017-12-19', '2017-12-19', '2017-12-19', 'PO-0005', 'PL', 'USD', 0, 220, 0, NULL),
(6, 1, 4, 'This term and condition222', '2017-12-19', '2017-12-19', '2017-12-19', 'PO-0006', 'PL', 'EUR', 90, 6600, 0, NULL),
(7, 1, 3, 'This term and condition222', '2017-12-19', '2017-12-19', '2017-12-19', 'PO-0007', 'PL', 'BDT', 1, 1320, 0, NULL),
(8, 9, 1, 'This term and condition222', '2017-12-19', '2017-12-20', '2017-12-20', 'PO-0008', 'PL', 'USD', 0, 220, 0, NULL),
(9, 9, 1, 'This term and condition222', '2017-12-19', '2017-12-19', '2017-12-19', 'PO-0009', 'PL', 'USD', 0, 220, 0, NULL),
(10, 9, 1, 'This term and condition222', '2017-12-19', '2017-12-30', '2017-12-30', 'PO-0010', 'PL', 'USD', 0, 220, 0, NULL),
(11, 9, 1, 'This term and condition222', '2017-12-22', '2017-12-19', '2017-12-19', 'PO-0011', 'PL', 'USD', 0, 440, 0, NULL),
(12, 9, 1, 'This term and condition222', '2017-12-21', '2017-12-19', '2017-12-19', 'PO-0012', 'PL', 'BDT', 1, 440, 0, NULL),
(13, 1, 1, 'This term and condition222', '2017-12-23', '2017-12-19', '2017-12-19', 'PO-0013', 'PL', 'BDT', 1, 220, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purch_order_details`
--

CREATE TABLE `purch_order_details` (
  `po_detail_item` int(10) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `item_code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qty_invoiced` double NOT NULL DEFAULT '0',
  `unit_price` double NOT NULL DEFAULT '0',
  `tax_type_id` int(11) NOT NULL,
  `unit` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_ordered` double NOT NULL DEFAULT '0',
  `quantity_received` double NOT NULL DEFAULT '0',
  `qty_received` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purch_order_details`
--

INSERT INTO `purch_order_details` (`po_detail_item`, `order_no`, `item_code`, `description`, `qty_invoiced`, `unit_price`, `tax_type_id`, `unit`, `quantity_ordered`, `quantity_received`, `qty_received`) VALUES
(1, 1, 'BNS-01', 'Boat neck sweater', 10, 200, 1, 'abbr1', 10, 10, 0),
(2, 2, 'JK-01', 'Cashmere blend jacket', 1, 100, 1, 'abbr1', 1, 1, 0),
(3, 2, 'BNS-01', 'Boat neck sweater', 1, 300, 1, 'abbr1', 1, 1, 0),
(4, 3, 'BNS-01', 'Boat neck sweater', 10, 200, 1, 'abbr1', 10, 10, 0),
(5, 4, 'JK-01', 'Cashmere blend jacket', 50, 200, 1, 'abbr1', 50, 50, 0),
(6, 5, 'JK-01', 'Cashmere blend jacket', 1, 200, 1, 'abbr1', 1, 1, 0),
(7, 6, '001', 'CASHMERE SHAWL', 10, 400, 1, 'abbr1', 10, 10, 0),
(8, 6, 'BNS-01', 'Boat neck sweater', 10, 200, 1, 'abbr1', 10, 10, 0),
(9, 7, '001', 'CASHMERE SHAWL', 2, 400, 1, 'abbr1', 2, 2, 0),
(10, 7, 'BNS-01', 'Boat neck sweater', 2, 200, 1, 'abbr1', 2, 2, 0),
(11, 8, 'JK-01', 'Cashmere blend jacket', 1, 200, 1, 'abbr1', 1, 1, 0),
(12, 9, 'JK-01', 'Cashmere blend jacket', 1, 200, 1, 'abbr1', 1, 1, 0),
(13, 10, 'JK-01', 'Cashmere blend jacket', 1, 200, 1, 'abbr1', 1, 1, 0),
(14, 11, '001', 'CASHMERE SHAWL', 1, 400, 1, 'abbr1', 1, 1, 0),
(15, 12, '001', 'CASHMERE SHAWL', 1, 400, 1, 'abbr1', 1, 1, 0),
(16, 13, 'BNS-01', 'Boat neck sweater', 1, 200, 1, 'abbr1', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `receive_orders`
--

CREATE TABLE `receive_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `reference` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `challan_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `exchange_rate` double NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receive_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receive_order_details`
--

CREATE TABLE `receive_order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `receive_id` int(11) NOT NULL,
  `item_code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `quantity` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` int(11) UNSIGNED NOT NULL,
  `reference` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`id`, `type`, `reference`) VALUES
(4, 7, '001/2017'),
(3, 6, '001/2017'),
(5, 6, '002/2017'),
(6, 4, '001/2017'),
(7, 2, '001/2017'),
(8, 1, '001/2017'),
(9, 5, '001/2017'),
(10, 5, '002/2017'),
(11, 3, '001/2017'),
(12, 6, '003/2017'),
(13, 6, '004/2017'),
(14, 6, '005/2017');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin User', NULL, NULL),
(2, 'Accountant 1', 'Accountant 1', 'Accountant 1', NULL, NULL),
(3, 'TestRole', 'Test Role', 'test role', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `order_no` int(10) UNSIGNED NOT NULL,
  `trans_type` mediumint(9) NOT NULL,
  `invoice_type` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `debtor_no` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `reference` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `customer_ref` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_reference_id` int(11) NOT NULL,
  `order_reference` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `ord_date` date NOT NULL,
  `order_type` int(11) NOT NULL,
  `from_stk_loc` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `currency_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `exchange_rate` double NOT NULL,
  `total` double NOT NULL DEFAULT '0',
  `paid_amount` double NOT NULL DEFAULT '0',
  `payment_term` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`order_no`, `trans_type`, `invoice_type`, `debtor_no`, `branch_id`, `person_id`, `reference`, `customer_ref`, `order_reference_id`, `order_reference`, `comments`, `ord_date`, `order_type`, `from_stk_loc`, `payment_id`, `currency_code`, `exchange_rate`, `total`, `paid_amount`, `payment_term`, `created_at`, `updated_at`) VALUES
(1, 201, 'directOrder', 1, 1, 1, 'SO-0001', NULL, 0, NULL, '', '2017-12-11', 0, 'JA', 2, 'BDT', 1, 550, 0, 2, '2017-12-11 07:02:29', '2017-12-11 07:02:49'),
(2, 201, 'indirectOrder', 3, 3, 1, 'SO-0002', NULL, 0, NULL, '', '2017-12-12', 0, 'JA', 2, 'USD', 80, 550, 0, 0, '2017-12-11 22:36:23', NULL),
(3, 202, 'directInvoice', 3, 3, 1, 'INV-0001', NULL, 2, 'SO-0002', '', '2017-12-12', 0, 'JA', 2, 'USD', 80, 550, 550, 1, '2017-12-11 22:36:23', NULL),
(4, 201, 'indirectOrder', 3, 3, 1, 'SO-0003', NULL, 0, NULL, '', '2017-12-12', 0, 'JA', 2, 'USD', 80, 561, 0, 0, '2017-12-11 22:39:49', NULL),
(5, 202, 'directInvoice', 3, 3, 1, 'INV-0002', NULL, 4, 'SO-0003', '', '2017-12-12', 0, 'JA', 2, 'USD', 80, 891, 891, 1, '2017-12-11 22:39:49', '2017-12-11 22:46:26'),
(6, 201, 'indirectOrder', 1, 1, 1, 'SO-0004', NULL, 0, NULL, '', '2017-12-19', 0, 'JA', 2, 'EUR', 90, 550, 0, 0, '2017-12-19 00:23:57', NULL),
(7, 202, 'directInvoice', 1, 1, 1, 'INV-0003', NULL, 6, 'SO-0004', '', '2017-12-19', 0, 'JA', 2, 'EUR', 90, 550, 550, 1, '2017-12-19 00:23:57', NULL),
(8, 201, 'indirectOrder', 2, 2, 1, 'SO-0005', NULL, 0, NULL, '', '2017-12-20', 0, 'JA', 2, 'USD', 80, 2750, 0, 0, '2017-12-19 00:40:59', NULL),
(9, 202, 'directInvoice', 2, 2, 1, 'INV-0004', NULL, 8, 'SO-0005', '', '2017-12-20', 0, 'JA', 2, 'USD', 80, 2750, 0, 1, '2017-12-19 00:40:59', NULL),
(10, 201, 'indirectOrder', 2, 2, 4, 'SO-0006', NULL, 0, NULL, '', '2017-12-19', 0, 'JA', 2, 'BDT', 1, 550, 0, 0, '2017-12-19 07:02:19', NULL),
(11, 202, 'directInvoice', 2, 2, 4, 'INV-0005', NULL, 10, 'SO-0006', '', '2017-12-19', 0, 'JA', 2, 'BDT', 1, 550, 0, 1, '2017-12-19 07:02:19', NULL),
(12, 201, 'directOrder', 3, 3, 1, 'SO-0007', NULL, 0, NULL, '', '2017-12-24', 0, 'PL', 2, 'USD', 0, 550, 0, 2, '2017-12-23 23:07:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_details`
--

CREATE TABLE `sales_order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `trans_type` int(11) NOT NULL,
  `stock_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `qty_sent` double NOT NULL DEFAULT '0',
  `quantity` double NOT NULL DEFAULT '0',
  `unit` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_inventory` double NOT NULL,
  `discount_percent` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_order_details`
--

INSERT INTO `sales_order_details` (`id`, `order_no`, `trans_type`, `stock_id`, `tax_type_id`, `description`, `unit_price`, `qty_sent`, `quantity`, `unit`, `is_inventory`, `discount_percent`, `created_at`, `updated_at`) VALUES
(1, 1, 201, 'BNS-01', 1, 'Boat neck sweater', 500, 0, 1, 'PC', 1, 0, '2017-12-11 13:02:29', NULL),
(2, 2, 201, 'BNS-01', 1, 'Boat neck sweater', 40000, 0, 1, 'M', 1, 0, '2017-12-12 04:36:23', NULL),
(3, 3, 202, 'BNS-01', 1, 'Boat neck sweater', 500, 0, 1, 'M', 1, 0, '2017-12-12 04:36:23', NULL),
(4, 2, 201, '', 1, 'abc', 0, 0, 1, 'M', 0, 0, '2017-12-12 04:36:23', NULL),
(5, 3, 202, '', 1, 'abc', 0, 0, 1, NULL, 0, 0, '2017-12-12 04:36:23', NULL),
(6, 4, 201, '001', 1, 'CASHMERE SHAWL', 40000, 0, 1, 'M', 1, 0, '2017-12-12 04:39:49', NULL),
(7, 5, 202, '001', 1, 'CASHMERE SHAWL', 500, 0, 1, 'M', 1, 0, '2017-12-12 04:39:49', NULL),
(8, 4, 201, '', 1, 'sdf', 10, 0, 1, 'CM', 0, 0, '2017-12-12 04:39:49', NULL),
(9, 5, 202, '', 1, 'sdf', 10, 0, 1, 'CM', 0, 0, '2017-12-12 04:39:49', NULL),
(10, 5, 202, 'JK-01', 1, 'Cashmere blend jacket', 300, 0, 1, 'DZ', 1, 0, '2017-12-12 04:46:26', NULL),
(11, 6, 201, 'BNS-01', 1, 'Boat neck sweater', 45000, 0, 1, 'abbr1', 1, 0, '2017-12-19 06:23:57', NULL),
(12, 7, 202, 'BNS-01', 1, 'Boat neck sweater', 500, 0, 1, 'abbr1', 1, 0, '2017-12-19 06:23:57', NULL),
(13, 8, 201, '001', 1, 'CASHMERE SHAWL', 40000, 0, 5, 'abbr1', 1, 0, '2017-12-19 06:40:59', NULL),
(14, 9, 202, '001', 1, 'CASHMERE SHAWL', 500, 0, 5, 'abbr1', 1, 0, '2017-12-19 06:40:59', NULL),
(15, 10, 201, 'BNS-01', 1, 'Boat neck sweater', 500, 0, 1, 'abbr1', 1, 0, '2017-12-19 13:02:19', NULL),
(16, 11, 202, 'BNS-01', 1, 'Boat neck sweater', 500, 0, 1, 'abbr1', 1, 0, '2017-12-19 13:02:19', NULL),
(17, 12, 201, 'BNS-01', 1, 'Boat neck sweater', 500, 0, 1, 'abbr1', 1, 0, '2017-12-24 05:07:00', NULL),
(18, 12, 201, '', 1, 'test', 0, 0, 1, 'abbr1', 0, 0, '2017-12-24 05:07:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_types`
--

CREATE TABLE `sales_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `sales_type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `tax_included` tinyint(4) NOT NULL,
  `factor` double NOT NULL,
  `defaults` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_types`
--

INSERT INTO `sales_types` (`id`, `sales_type`, `tax_included`, `factor`, `defaults`) VALUES
(1, 'Retail', 1, 0, 1),
(2, 'Wholesale', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sale_prices`
--

CREATE TABLE `sale_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sales_type_id` int(11) NOT NULL,
  `curr_abrev` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sale_prices`
--

INSERT INTO `sale_prices` (`id`, `stock_id`, `sales_type_id`, `curr_abrev`, `price`) VALUES
(1, 'BNS-01', 1, 'USD', 500),
(2, 'BNS-01', 2, 'USD', 0),
(3, 'JK-01', 1, 'USD', 300),
(4, 'JK-01', 2, 'USD', 0),
(5, '001', 1, 'USD', 500),
(6, '001', 2, 'USD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `security_role`
--

CREATE TABLE `security_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sections` text COLLATE utf8_unicode_ci,
  `areas` text COLLATE utf8_unicode_ci,
  `inactive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `security_role`
--

INSERT INTO `security_role` (`id`, `role`, `description`, `sections`, `areas`, `inactive`, `created_at`, `updated_at`) VALUES
(1, 'System Administrator', 'System Administrator', 'a:26:{s:8:"category";s:3:"100";s:4:"unit";s:3:"600";s:3:"loc";s:3:"200";s:4:"item";s:3:"300";s:4:"user";s:3:"400";s:4:"role";s:3:"500";s:8:"customer";s:3:"700";s:8:"purchase";s:3:"900";s:8:"supplier";s:4:"1000";s:7:"payment";s:4:"1400";s:6:"backup";s:4:"1500";s:5:"email";s:4:"1600";s:9:"emailtemp";s:4:"1700";s:10:"preference";s:4:"1800";s:3:"tax";s:4:"1900";s:10:"currencies";s:4:"2100";s:11:"paymentterm";s:4:"2200";s:13:"paymentmethod";s:4:"2300";s:14:"companysetting";s:4:"2400";s:10:"iecategory";s:4:"2600";s:7:"expense";s:4:"2700";s:7:"deposit";s:4:"3000";s:9:"quotation";s:4:"2800";s:7:"invoice";s:4:"2900";s:12:"bank_account";s:4:"3100";s:21:"bank_account_transfer";s:4:"3200";}', 'a:59:{s:7:"cat_add";s:3:"101";s:8:"cat_edit";s:3:"102";s:10:"cat_delete";s:3:"103";s:8:"unit_add";s:3:"601";s:9:"unit_edit";s:3:"602";s:11:"unit_delete";s:3:"603";s:7:"loc_add";s:3:"201";s:8:"loc_edit";s:3:"202";s:10:"loc_delete";s:3:"203";s:8:"item_add";s:3:"301";s:9:"item_edit";s:3:"302";s:11:"item_delete";s:3:"303";s:8:"user_add";s:3:"401";s:9:"user_edit";s:3:"402";s:11:"user_delete";s:3:"403";s:12:"customer_add";s:3:"701";s:13:"customer_edit";s:3:"702";s:15:"customer_delete";s:3:"703";s:12:"purchase_add";s:3:"901";s:13:"purchase_edit";s:3:"902";s:15:"purchase_delete";s:3:"903";s:12:"supplier_add";s:4:"1001";s:13:"supplier_edit";s:4:"1002";s:15:"supplier_delete";s:4:"1003";s:11:"payment_add";s:4:"1401";s:12:"payment_edit";s:4:"1402";s:14:"payment_delete";s:4:"1403";s:10:"backup_add";s:4:"1501";s:15:"backup_download";s:4:"1502";s:7:"tax_add";s:4:"1901";s:8:"tax_edit";s:4:"1902";s:10:"tax_delete";s:4:"1903";s:14:"currencies_add";s:4:"2101";s:15:"currencies_edit";s:4:"2102";s:17:"currencies_delete";s:4:"2103";s:15:"paymentterm_add";s:4:"2201";s:16:"paymentterm_edit";s:4:"2202";s:18:"paymentterm_delete";s:4:"2203";s:17:"paymentmethod_add";s:4:"2301";s:18:"paymentmethod_edit";s:4:"2302";s:20:"paymentmethod_delete";s:4:"2303";s:11:"expense_add";s:4:"2701";s:12:"expense_edit";s:4:"2702";s:14:"expense_delete";s:4:"2703";s:11:"deposit_add";s:4:"3001";s:12:"deposit_edit";s:4:"3002";s:14:"deposit_delete";s:4:"3003";s:13:"quotation_add";s:4:"2801";s:14:"quotation_edit";s:4:"2802";s:16:"quotation_delete";s:4:"2803";s:11:"invoice_add";s:4:"2901";s:12:"invoice_edit";s:4:"2902";s:14:"invoice_delete";s:4:"2903";s:16:"bank_account_add";s:4:"3101";s:17:"bank_account_edit";s:4:"3102";s:19:"bank_account_delete";s:4:"3103";s:25:"bank_account_transfer_add";s:4:"3201";s:26:"bank_account_transfer_edit";s:4:"3202";s:28:"bank_account_transfer_delete";s:4:"3203";}', 0, '2017-09-17 05:43:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `trans_type` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `packed_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_details`
--

CREATE TABLE `shipment_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `stock_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` double NOT NULL,
  `discount_percent` double NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment`
--

CREATE TABLE `stock_adjustment` (
  `id` int(10) UNSIGNED NOT NULL,
  `person_id` int(11) NOT NULL,
  `location` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `trans_type` int(11) NOT NULL,
  `total` double NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_category`
--

CREATE TABLE `stock_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dflt_units` int(11) NOT NULL,
  `inactive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_category`
--

INSERT INTO `stock_category` (`category_id`, `description`, `dflt_units`, `inactive`, `created_at`, `updated_at`) VALUES
(1, 'Sweater', 3, 0, '2017-12-05 10:36:56', NULL),
(2, 'T-Shirt', 3, 0, '2017-12-05 10:39:16', NULL),
(3, 'Shirt', 3, 0, '2017-12-05 10:39:32', NULL),
(4, 'Jackets', 3, 0, '2017-12-05 10:40:26', NULL),
(5, 'Pant', 3, 0, '2017-12-05 10:53:34', NULL),
(6, 'Jeans', 3, 0, '2017-12-05 01:48:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE `stock_master` (
  `stock_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `tax_type_id` tinyint(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8_unicode_ci NOT NULL,
  `units` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`stock_id`, `category_id`, `tax_type_id`, `description`, `long_description`, `units`, `inactive`, `deleted_status`) VALUES
('BNS-01', 1, 1, 'Boat neck sweater', '', 'Peice', 0, 0),
('JK-01', 4, 1, 'Cashmere blend jacket', '', 'Peice', 0, 0),
('001', 1, 1, 'CASHMERE SHAWL', '', 'Piece', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_moves`
--

CREATE TABLE `stock_moves` (
  `trans_id` int(10) UNSIGNED NOT NULL,
  `stock_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `transfer_id` int(11) DEFAULT NULL,
  `order_no` int(11) NOT NULL,
  `receive_id` int(11) DEFAULT NULL,
  `trans_type` int(11) NOT NULL DEFAULT '0',
  `loc_code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tran_date` date NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `order_reference` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_reference_id` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_moves`
--

INSERT INTO `stock_moves` (`trans_id`, `stock_id`, `transfer_id`, `order_no`, `receive_id`, `trans_type`, `loc_code`, `tran_date`, `person_id`, `order_reference`, `reference`, `transaction_reference_id`, `note`, `qty`, `price`) VALUES
(1, 'BNS-01', NULL, 2, NULL, 202, 'JA', '2017-12-12', 1, 'SO-0002', 'store_out_3', 3, '', -1, 0),
(2, '001', NULL, 4, NULL, 202, 'JA', '2017-12-12', 1, 'SO-0003', 'store_out_5', 5, '', -1, 0),
(3, 'JK-01', NULL, 4, NULL, 202, 'JA', '2017-12-12', 1, 'SO-0002', 'store_out_5', 5, '', -1, 0),
(4, 'BNS-01', NULL, 6, NULL, 202, 'JA', '2017-12-19', 1, 'SO-0004', 'store_out_7', 7, '', -1, 0),
(5, '001', NULL, 8, NULL, 202, 'JA', '2017-12-20', 1, 'SO-0005', 'store_out_9', 9, '', -5, 0),
(6, 'BNS-01', NULL, 10, NULL, 202, 'JA', '2017-12-19', 4, 'SO-0006', 'store_out_11', 11, '', -1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

CREATE TABLE `stock_transfer` (
  `id` int(10) UNSIGNED NOT NULL,
  `person_id` int(11) NOT NULL,
  `source` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `destination` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `qty` double NOT NULL,
  `transfer_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `supp_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inactive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supp_name`, `email`, `address`, `contact`, `city`, `state`, `zipcode`, `country`, `currency`, `inactive`, `created_at`, `updated_at`) VALUES
(1, 'GSR Chemical (BD) Ltd.', 'gsrchemical@yahoo.com', '1/F,6/6 (3rd Floor),', '01713 461582', 'Mirpur-1', 'Dhaka-1216', '', 'BD', 'BDT', 0, '2017-11-18 06:13:09', '2017-12-04 09:06:11'),
(2, ' Rafid Print & Accessories Ltd', 'rprinter2013@gmail.com', 'Plot no .25,Main Road:3,Block:A,Section :11', '01713093393, 88 02 9013919', 'Pallabi,Mirpur', 'Dhaka-1216', '', 'BD', 'BDT', 0, '2017-11-27 20:30:41', '2017-12-04 09:04:38'),
(3, ' M/S SAS Packaging Industrise', 'saspackainging@gmail.com', 'Zirabo Bazar,Ashulia', '01733143523,01932920329.', 'Savar-1234', 'Dhaka', '', 'BD', 'BDT', 0, '2017-11-27 20:32:43', '2017-12-04 09:08:24'),
(4, 'S. S Beautification Workshop. ', '', 'Add.ka/25,Shohid Abdul Aziz Sarak', '01715301703, 01913193830', 'Jogonnath pur,Bashundhara', 'Badda,Dhaka-1212', '', 'BD', 'BDT', 0, '2017-12-04 08:44:18', '2017-12-04 09:00:05'),
(5, 'Kanta Enterprise.', '', 'Gorgoria Master Bari,Sreepur Pourasova', '01711023076', 'Sreepur,Gazipur', '', '', 'BD', 'BDT', 0, '2017-12-04 08:58:37', '2017-12-04 08:59:36'),
(6, 'Sokal Enterprise', '', 'joy Bangla Road', '01823222324,01969578230.', 'Borbari,National University', 'Gazipur', '', 'BD', 'BDT', 0, '2017-12-04 09:07:46', NULL),
(7, 'M/S Bhai Bhai Enterprise', '', 'Vangnahati', ' 01711197202,01715659474', 'Sreepur', 'Gazipur.', '', 'BD', 'BDT', 0, '2017-12-04 09:09:57', NULL),
(8, 'Green Care Transport Service', '', '7/1,BFDC Road (old 0,1 No,Rail Gate', ' 02-9140143,8170229,0171337645', 'Tejgone-11208', 'Dhaka', '', 'BD', 'BDT', 0, '2017-12-04 09:11:54', NULL),
(9, 'MIM Accessories', 'mimaccessories2007@gmail.com', 'Kamargawn,Mirer bazar Pubail', '01670444229,01732770705', 'Gazipur Sadar', 'Gazipur', '', 'BD', 'USD', 0, '2017-12-04 09:13:30', '2017-12-11 03:48:18'),
(10, 'Accordia Global Compliance Group Asia Ltd.', 'accordia@dhaka.net', '315W,Town Place,Suite 1/St,Augustine,FL 32092 USA ', '8802-8819589', 'H:15/A,R:8,Gulshan-1', 'Dhaka', '', 'BD', 'BDT', 0, '2017-12-04 09:16:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_transactions`
--

CREATE TABLE `supplier_transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `person_id` int(11) NOT NULL,
  `reference_id` int(11) UNSIGNED NOT NULL,
  `reference_type` int(11) UNSIGNED NOT NULL,
  `reference` varchar(100) NOT NULL,
  `supplier_id` int(11) UNSIGNED NOT NULL,
  `invoice_id` int(11) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `currency` varchar(3) NOT NULL,
  `exachange_rate` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `access_level` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(3) NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `real_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `inactive` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `access_level`, `group_id`, `password`, `real_name`, `role_id`, `phone`, `email`, `picture`, `inactive`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 1, '$2y$10$cyZnZdHwprX914Gf37mmm.ahnTn1CV/NTfpyUrH7cKX6mf.G7Kq5O', 'Admin', 1, '123456', 'admin@techvill.net', 'profile-pictures.png', 0, 'ZLv2FGkvtRoWN63L1GpT2EzsQR7AVLz1e1jITJnztTueLZF29cXfAEZou3bD', NULL, '2017-12-20 05:06:47'),
(2, 2, '2', 2, '$2y$10$.8MFQf7PVj2DLa07f8ci..lJSgl6SWm/xAct1QYrbRcTspMwmWPlC', 'Shahin Alam', 2, '123456789', 'shahin@techvill.net', '', 0, '', '2017-12-18 05:45:50', '2017-12-19 03:29:43'),
(3, 0, '2', 2, '$2y$10$7fSlxFfa6JH/MEjSFym/4eJnjMwR2NsMxenZ1qIWal1r0SCx5vTA6', 'Aminul Islam', 2, '123456', 'aminul.techvill@gmail.com', '', 0, '1mWEXh1v7sy3oHgXInkOowuBb2yYZNxx39aWBoYUaS0NXOEBAwvCkxc7QnVJ', '2017-12-19 03:28:22', '2017-12-19 03:37:01'),
(4, 0, '2', 3, '$2y$10$c0Bty9DTzEFyKpQr3xDf8.eK4HRkjkFX0C7agLUhFSyPLRK.KhEfC', 'Tuhin Ahmed', 2, '123456', 'tuhin.techvill@gmail.com', '', 0, 'UskSRgen96RC0oqh2Tmd7iMC4SHNLcggosFY5KICAZqpf5vW9B4Xv1ctgKRb', '2017-12-19 03:29:17', '2017-12-20 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(3) NOT NULL,
  `group_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`) VALUES
(1, 'ADMIN'),
(2, 'MANAGER'),
(3, 'USER'),
(4, 'test group');

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `bank_transaction_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `reference_id` int(11) UNSIGNED NOT NULL,
  `reference_type` int(11) UNSIGNED NOT NULL,
  `reference` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `currency` varchar(3) NOT NULL,
  `exchange_rate` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `bank_transaction_id`, `person_id`, `reference_id`, `reference_type`, `reference`, `description`, `user_id`, `transaction_date`, `currency`, `exchange_rate`, `amount`, `created_at`) VALUES
(3, 34, 1, 3, 6, '001/2017', 'Loan from office', 1, '2017-12-18', 'BDT', 1, 2000, '2017-12-18 09:26:15'),
(4, 35, 1, 4, 7, '001/2017', 'Loan from office', 1, '2017-12-18', 'BDT', 1, -100, '2017-12-18 10:05:20'),
(5, 36, 1, 5, 6, '002/2017', 'Hello', 2, '2017-12-18', 'USD', 80, 10, '2017-12-18 11:46:18'),
(6, 44, 4, 12, 6, '003/2017', '', 1, '2017-12-23', 'EUR', 98, -500, '2017-12-20 05:15:07'),
(7, 45, 4, 13, 6, '004/2017', '', 4, '2017-12-20', 'USD', 80, -100, '2017-12-20 05:16:11'),
(8, 46, 4, 14, 6, '005/2017', '', 1, '2017-12-20', 'BDT', 1, -500, '2017-12-20 10:57:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjustment_details`
--
ALTER TABLE `adjustment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_account_type`
--
ALTER TABLE `bank_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_trans`
--
ALTER TABLE `bank_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_class`
--
ALTER TABLE `chart_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_master`
--
ALTER TABLE `chart_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_types`
--
ALTER TABLE `chart_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_trannsaction_details`
--
ALTER TABLE `customer_trannsaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_transactions`
--
ALTER TABLE `customer_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_item_orders`
--
ALTER TABLE `custom_item_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cust_branch`
--
ALTER TABLE `cust_branch`
  ADD PRIMARY KEY (`branch_code`);

--
-- Indexes for table `debtors_master`
--
ALTER TABLE `debtors_master`
  ADD PRIMARY KEY (`debtor_no`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_temp_details`
--
ALTER TABLE `email_temp_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchange_rates`
--
ALTER TABLE `exchange_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_ledger_transactions`
--
ALTER TABLE `general_ledger_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_expense_categories`
--
ALTER TABLE `income_expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_payment_terms`
--
ALTER TABLE `invoice_payment_terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_code`
--
ALTER TABLE `item_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tax_types`
--
ALTER TABLE `item_tax_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_unit`
--
ALTER TABLE `item_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_terms`
--
ALTER TABLE `payment_terms`
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
-- Indexes for table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_prices`
--
ALTER TABLE `purchase_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purch_orders`
--
ALTER TABLE `purch_orders`
  ADD PRIMARY KEY (`order_no`);

--
-- Indexes for table `purch_order_details`
--
ALTER TABLE `purch_order_details`
  ADD PRIMARY KEY (`po_detail_item`);

--
-- Indexes for table `receive_orders`
--
ALTER TABLE `receive_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_order_details`
--
ALTER TABLE `receive_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`order_no`);

--
-- Indexes for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_types`
--
ALTER TABLE `sales_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_prices`
--
ALTER TABLE `sale_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_role`
--
ALTER TABLE `security_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment_details`
--
ALTER TABLE `shipment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustment`
--
ALTER TABLE `stock_adjustment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_category`
--
ALTER TABLE `stock_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `stock_moves`
--
ALTER TABLE `stock_moves`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplier_transactions`
--
ALTER TABLE `supplier_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adjustment_details`
--
ALTER TABLE `adjustment_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bank_account_type`
--
ALTER TABLE `bank_account_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bank_trans`
--
ALTER TABLE `bank_trans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chart_class`
--
ALTER TABLE `chart_class`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `chart_master`
--
ALTER TABLE `chart_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `chart_types`
--
ALTER TABLE `chart_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer_trannsaction_details`
--
ALTER TABLE `customer_trannsaction_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_transactions`
--
ALTER TABLE `customer_transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_item_orders`
--
ALTER TABLE `custom_item_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cust_branch`
--
ALTER TABLE `cust_branch`
  MODIFY `branch_code` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `debtors_master`
--
ALTER TABLE `debtors_master`
  MODIFY `debtor_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `email_temp_details`
--
ALTER TABLE `email_temp_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `exchange_rates`
--
ALTER TABLE `exchange_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `general_ledger_transactions`
--
ALTER TABLE `general_ledger_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `income_expense_categories`
--
ALTER TABLE `income_expense_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `invoice_payment_terms`
--
ALTER TABLE `invoice_payment_terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `item_code`
--
ALTER TABLE `item_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item_tax_types`
--
ALTER TABLE `item_tax_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item_unit`
--
ALTER TABLE `item_unit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_terms`
--
ALTER TABLE `payment_terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `preference`
--
ALTER TABLE `preference`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `purchase_prices`
--
ALTER TABLE `purchase_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `purch_orders`
--
ALTER TABLE `purch_orders`
  MODIFY `order_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `purch_order_details`
--
ALTER TABLE `purch_order_details`
  MODIFY `po_detail_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `receive_orders`
--
ALTER TABLE `receive_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `receive_order_details`
--
ALTER TABLE `receive_order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `order_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `sales_types`
--
ALTER TABLE `sales_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sale_prices`
--
ALTER TABLE `sale_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `security_role`
--
ALTER TABLE `security_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipment_details`
--
ALTER TABLE `shipment_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_adjustment`
--
ALTER TABLE `stock_adjustment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_category`
--
ALTER TABLE `stock_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `stock_moves`
--
ALTER TABLE `stock_moves`
  MODIFY `trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `supplier_transactions`
--
ALTER TABLE `supplier_transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
