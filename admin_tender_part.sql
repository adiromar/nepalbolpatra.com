-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 07:53 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_tender`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_addindustry`
--

CREATE TABLE `wp_addindustry` (
  `industry_id` int(11) NOT NULL,
  `industry_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_addindustry`
--

INSERT INTO `wp_addindustry` (`industry_id`, `industry_name`) VALUES
(5, 'Toursim/Travel/Hotel/Airline'),
(6, 'Government/Ministries/Departments'),
(7, 'Education- Universities/Colleges/Schools'),
(8, 'Building/Construction'),
(9, 'Bank/Finance'),
(10, 'IT/Telecommunications'),
(11, 'Transportation'),
(12, 'Yubapost'),
(13, 'Non Governmental Organization'),
(14, 'Government/Ministries/Departments'),
(15, 'Nepal Airlines'),
(16, 'Nepal Airlines'),
(17, 'Nepal Oil Corporation Limited'),
(18, 'Provincial Government ');

-- --------------------------------------------------------

--
-- Table structure for table `wp_addnewspaper`
--

CREATE TABLE `wp_addnewspaper` (
  `newspaper_id` int(11) NOT NULL,
  `newspaper_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_addnewspaper`
--

INSERT INTO `wp_addnewspaper` (`newspaper_id`, `newspaper_name`) VALUES
(1, 'Karobar rastriya daily'),
(2, 'Kathmandu Post'),
(3, 'Himalayan Times'),
(4, 'Gorkhapatra Rastriya Dainik'),
(5, 'Majdur Rastriya Dainik'),
(6, 'Nepali Patra'),
(7, 'Aarthik Abhiyan National Daily Newspaper'),
(8, 'Annapurna Post'),
(9, 'Glocal Khabar'),
(10, 'Janakpur Today'),
(11, 'Yubapost'),
(12, 'Gorkhapatra'),
(13, 'Majdur'),
(14, 'Kantipur Daily'),
(15, 'Annapurna Post'),
(16, 'Nagarik News');

-- --------------------------------------------------------

--
-- Table structure for table `wp_addnotice`
--

CREATE TABLE `wp_addnotice` (
  `notice_id` int(11) NOT NULL,
  `notice_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_addnotice`
--

INSERT INTO `wp_addnotice` (`notice_id`, `notice_name`) VALUES
(2, 'Tender'),
(3, 'Auction'),
(4, 'Quotation'),
(5, 'Proposal'),
(6, 'Prohibition'),
(18, 'Tender');

-- --------------------------------------------------------

--
-- Table structure for table `wp_addproduct`
--

CREATE TABLE `wp_addproduct` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_addproduct`
--

INSERT INTO `wp_addproduct` (`product_id`, `product_name`) VALUES
(4, 'Business'),
(18, 'Construction/Building'),
(20, 'Architecture'),
(33, 'Media/News'),
(23, 'Educational'),
(25, 'Technological/Softwares'),
(31, 'Electronics'),
(32, 'Medical'),
(30, 'Government'),
(34, 'Nepal Electricity Authority');

-- --------------------------------------------------------

--
-- Table structure for table `wp_org`
--

CREATE TABLE `wp_org` (
  `orgid` int(20) NOT NULL,
  `orgname` varchar(200) NOT NULL,
  `symbol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_org`
--

INSERT INTO `wp_org` (`orgid`, `orgname`, `symbol`) VALUES
(1, 'Nepal Bank Limited', 'NBL'),
(2, 'Mega Bank', 'MEGA'),
(9, 'Himalayan Bank', 'HBL'),
(14, 'Citizens Bank', 'CZBIL'),
(16, 'Nepal Agro Microfinance Bittiya Sanstha Limited', 'AGRO'),
(17, 'Kailash Bikas Bank Limited', 'KBBL'),
(18, 'Siddhartha Capital Limited', 'Siddhartha');

-- --------------------------------------------------------

--
-- Table structure for table `wp_pricing`
--

CREATE TABLE `wp_pricing` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sub` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `monthly` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_pricing`
--

INSERT INTO `wp_pricing` (`id`, `title`, `sub`, `price`, `monthly`) VALUES
(1, '24 Months Package', 'Standard Membership', 'Rs. 6000 /-', 'Rs. 300 /-'),
(2, 'LifeTime Package', 'To get our best features!', 'Rs. 24,000 /-', 'Rs. 200 /-'),
(3, '12 Months Package', 'Basic Membership', 'Rs. 3600 /-', 'Rs. 300 /-');

-- --------------------------------------------------------

--
-- Table structure for table `wp_sharebazaar`
--

CREATE TABLE `wp_sharebazaar` (
  `sid` int(20) NOT NULL,
  `organization` varchar(200) NOT NULL,
  `notice` varchar(100) NOT NULL,
  `first` varchar(100) NOT NULL,
  `second` varchar(100) NOT NULL,
  `third` varchar(100) NOT NULL,
  `fourth` varchar(100) NOT NULL,
  `published_date` date NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_sharebazaar`
--

INSERT INTO `wp_sharebazaar` (`sid`, `organization`, `notice`, `first`, `second`, `third`, `fourth`, `published_date`, `file`) VALUES
(1, 'Nepal Bank Limited', 'Karobar', '200', '211', '213', '199', '2017-12-20', '');

-- --------------------------------------------------------

--
-- Table structure for table `wp_sharereport`
--

CREATE TABLE `wp_sharereport` (
  `id` int(20) NOT NULL,
  `organization` varchar(200) NOT NULL,
  `org_id` int(20) NOT NULL,
  `notice` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `published_date` date NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_subscription`
--

CREATE TABLE `wp_subscription` (
  `id` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subscriptions` text NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_subscription`
--

INSERT INTO `wp_subscription` (`id`, `email`, `subscriptions`, `user_id`) VALUES
(6, 'nickarsenal007@gmail.com', 'Nepal Bank Limited,Mega Bank,Citizens Bank', 47),
(7, 'spidynick07@gmail.com', 'Nepal Bank Limited,Mega Bank', 79),
(16, 'Karunaakarki@gmail.com', 'Kailash Bikas Bank Limited', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_tender`
--

CREATE TABLE `wp_tender` (
  `id` int(11) NOT NULL,
  `publisher` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `published_date` date DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `submission_date_eng` date DEFAULT NULL,
  `notice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `industry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `newspaper` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wp_tender`
--

INSERT INTO `wp_tender` (`id`, `publisher`, `description`, `published_date`, `submission_date`, `submission_date_eng`, `notice`, `industry`, `product`, `newspaper`, `image`, `featured`, `created_at`, `updated_at`) VALUES
(412, 'बर्हदशी गाउँ पालिका', 'बोलपत्र स्वीकृत गर्ने आसयको सूचना', '2018-01-30', '2018-02-06', NULL, 'Tender', 'Government/Ministries/Departments', 'Government', 'Annapurna Post', 'tender/1_2018-01-30.png', 'yes', '2018-01-30 08:13:11', '2019-03-28 05:26:48'),
(413, 'सहिदभुमी गाउपालिका धनकुटा', 'सहिदभूमि गाउपालिका सडक निर्माण', '2075-12-25', '2076-01-24', NULL, 'Tender', 'Building/Construction', 'Government', 'Annapurna Post', 'tender/1_2075-12-25.jpeg', 'no', '2019-04-08 09:57:30', '2019-04-08 10:43:23'),
(414, 'APIMIHAL RULAR MINICIPALITY OFFICE', 'Construction of stairway for tourism development Apimahal RM', '2075-12-26', '2076-01-10', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Karobar rastriya daily', 'tender/1_2075-12-26.png', 'no', '2019-04-09 05:45:53', '2019-04-09 10:31:20'),
(415, 'Kalimati rular municipality', 'Simal Chowk Pokhara Road Construction ', '2075-12-26', '2076-02-27', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Karobar rastriya daily', 'tender/1_2075-12-26.jpeg', 'no', '2019-04-09 06:02:50', '2019-04-09 10:34:48'),
(416, 'Rapti Rular Municipality', 'Supply and delivery of cemented Bio sand Water Filter', '2075-12-26', '2076-03-22', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Karobar rastriya daily', 'tender/1_2075-12-26.jpeg', 'no', '2019-04-09 06:18:14', '2019-04-09 10:34:21'),
(417, 'Baganaskali Rular Municipality', 'Siddhartha Highway-Corbari-\r\nShikhar-Bhaluwachaur-madi Phat Road upgrading', '2075-12-26', '2076-01-25', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Karobar rastriya daily', 'tender/1_2075-12-26.jpeg', 'no', '2019-04-09 06:55:18', '2019-04-09 10:32:03'),
(418, 'नेपाल विद्युत् पर्ाधिकरण', 'बाेलपत्र / दरभाउपत्र स्विकृत गर्ने अाशयकाे सूचना', '2075-12-25', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Media/News', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-25.jpeg', 'no', '2019-04-09 10:24:48', '2019-04-09 10:30:40'),
(419, 'नेपाल विद्युत् पर्ाधिकरण', 'दरभाउपत्र स्विकृत गर्ने अाशयकाे सूचना', '2075-12-26', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Media/News', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-26.png', 'no', '2019-04-09 10:28:46', '2019-04-09 10:33:41'),
(420, 'Government of Nepal', 'Invitation for Bids', '2075-12-26', '2076-01-26', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-26.jpeg', 'no', '2019-04-09 10:39:08', '2019-04-09 10:49:42'),
(421, 'Nepal Electricity Authority (NEA)', 'Invitation for Bids', '2075-12-25', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-25.png', 'no', '2019-04-09 10:48:23', '2019-04-09 10:50:40'),
(422, 'Nepal Airlines Corporations', 'Invitation for Sealed Quotation of Custom Clearance Agent', '2075-12-25', '0000-00-00', NULL, 'Tender', 'Toursim/Travel/Hotel/Airline', 'Business', 'Karobar rastriya daily', 'tender/1_2075-12-25.png', 'no', '2019-04-09 10:57:16', '2019-04-09 10:58:34'),
(423, 'सार्वजनिक खरिद अनुगमन कार्यालय,ताहचल,काठमाडाैँ ', 'कालाेसूचिमा राखिएकाे सूचना', '2075-12-25', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-25.jpeg', 'no', '2019-04-09 11:06:52', '2019-04-09 11:07:37'),
(424, 'National Academy of Medical Science', 'Invitation for Bids ', '2075-12-25', '0000-00-00', NULL, 'Tender', 'Education- Universities/Colleges/Schools', 'Government', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-25.jpeg', 'no', '2019-04-09 11:11:30', '2019-04-09 11:12:41'),
(425, 'नेपाल टेलिभिजन ', 'पुराना सामानहरु लिलाम बिकि् गर्ने सम्बन्धि सिलबन्धि बाेलपत्र अाह्ववानकाे सूचना ', '2075-12-25', '2076-01-16', NULL, 'Tender', 'Government/Ministries/Departments', 'Media/News', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-25.jpeg', 'no', '2019-04-09 11:25:22', '2019-04-09 11:29:10'),
(426, 'अख्तियार दुरुपयाेग अनुसन्धान अायाेगकाे कार्यालय, इटहरि', 'अार्थिक पा्स्ताव खाेल्नेबारेकाे सूचना', '2075-12-27', '2076-01-04', NULL, 'Tender', 'Government/Ministries/Departments', 'Government', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-27.png', 'no', '2019-04-10 05:10:08', '2019-04-10 05:11:59'),
(427, 'कर्मचारी सञ्चय काेष,पुल्चाेक', 'बाेलपत्रकाे अार्थिक प्रास्ताब खाेलिने बारेकाे सूचना', '2075-12-27', '2076-01-04', NULL, 'Tender', 'Building/Construction', 'Government', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-27.png', 'no', '2019-04-10 05:26:03', '2019-04-10 05:27:06'),
(428, 'सैनिक सामग्रि प्राप्ती निर्देशनालय', 'बाेलपत्र अाव्हानकाे सूचना', '2075-12-27', '2076-01-27', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-27.jpeg', 'no', '2019-04-10 05:39:06', '2019-04-10 05:39:59'),
(429, 'काठमाडाैँ महानगरपालिका', 'बाेलपत्र स्विकृत गर्ने अाशयकाे सूचना', '2075-12-27', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-27.jpeg', 'no', '2019-04-10 05:48:21', '2019-04-10 05:49:42'),
(430, 'उदयपुर सिमेन्ट उद्याेग प्रा.काे', 'बाेलपत्र स्विकृत गर्ने अाशयकाे सूचना', '2075-12-27', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Media/News', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-27.png', 'no', '2019-04-10 06:07:56', '2019-04-10 06:08:47'),
(431, 'राष्टिय पुनर्निर्माण प्राधिकरण', 'बाेलपत्र स्विकृत गर्ने अाशयकाे सूचना', '2075-12-27', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-27.png', 'no', '2019-04-10 06:15:55', '2019-04-10 06:18:00'),
(432, 'नेपाल अायल निगम लि.', 'बाेलपत्र स्विकृत गर्ने अाशयकाे सूचना', '2075-12-27', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-27.png', 'no', '2019-04-10 06:20:38', '2019-04-10 06:21:15'),
(433, 'नेपाल विद्युत् प्राधिकरण', 'दरभाउपत्र स्विकृत गर्ने अाशयकाे सूचना', '2075-12-27', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1_2075-12-27.jpeg', 'no', '2019-04-10 06:26:30', '2019-04-10 06:36:02'),
(434, 'Nepal Telecom', 'Extension Notice for Tender Invitation', '2019-04-10', '2019-09-26', NULL, 'Tender', 'IT/Telecommunications', 'Media/News', 'Gorkhapatra Rastriya Dainik', 'tender/1_2019-04-10.png', 'no', '2019-04-10 06:33:36', '2019-04-10 06:35:11'),
(435, 'Nepal Telecom Corporation (NTV)', 'Invitation for Bids (IFB)', '2019-04-10', '0000-00-00', NULL, 'Tender', 'IT/Telecommunications', 'Media/News', 'Gorkhapatra Rastriya Dainik', 'tender/1554889348_2019-04-10.jpeg', 'no', '2019-04-10 06:41:41', '2019-04-10 09:42:28'),
(436, 'डिभिजन वन कार्यलय, सप्तरी', 'हाइड्रोलिक ट्रली सहितको ट्रयाक्टर खरिदसम्बन्धि सिलबन्दी प्रस्ताव अाव्हानकाे सूचना', '2075-12-27', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554889260_2075-12-27.png', 'no', '2019-04-10 07:04:33', '2019-04-10 09:41:00'),
(437, 'Nepal Electricity Authority (NEA)', 'Invitation for Bids', '2075-12-27', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554889172_2075-12-27.png', 'no', '2019-04-10 07:13:35', '2019-04-10 09:39:32'),
(439, 'Nepal Electricity Authority (NEA)', 'Invitation for Bids', '2075-12-27', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Gorkhapatra Rastriya Dainik', 'tender/1554889054_2075-12-27.png', 'no', '2019-04-10 07:20:17', '2019-04-10 09:37:34'),
(441, 'Nepal Electricity Authority (NEA)', 'National Competitive Bidding', '2075-12-27', '2076-01-10', '2019-04-23', 'Tender', 'Toursim/Travel/Hotel/Airline', 'Business', 'Karobar rastriya daily', 'tender/1554888909_2075-12-27.png', 'no', '2019-04-10 07:22:26', '2019-04-10 10:28:27'),
(444, 'प्रधानमन्त्री कृषि अाधुनिकिकरण परियाेजना', 'सघन फलफूल विकास कार्याक्रम', '2075-12-27', '2076-01-27', '2019-05-10', 'Tender', 'Toursim/Travel/Hotel/Airline', 'Business', 'Karobar rastriya daily', 'tender/1554882444_2075-12-27.jpeg', 'no', '2019-04-10 07:47:24', '2019-04-10 10:26:51'),
(445, 'नेपाल विद्युत् प्राधिकरण', ' सिलबन्दी दरभाउपत्र अाव्हानकाे सूचना', '2019-04-10', '0000-00-00', NULL, 'Tender', 'Government/Ministries/Departments', 'Electronics', 'Gorkhapatra Rastriya Dainik', 'tender/1554888832_2019-04-10.jpeg', 'no', '2019-04-10 09:32:53', '2019-04-10 09:33:52'),
(447, 'छथर जाेरपाटि गाउँपालिका', 'बाेलपत्र स्विकृत गर्ने अाशय', '2075-12-27', '2076-01-01', '2019-04-14', 'Tender', 'Government/Ministries/Departments', 'Government', 'Nagarik News', 'tender/1554891027_2075-12-27.png', 'no', '2019-04-10 10:10:27', '2019-04-10 10:10:27'),
(449, 'खजुरा गाउँपालिका', 'अाशय पत्र सम्बन्धमा ', '2075-12-27', '2076-02-01', '2019-05-15', 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Nagarik News', 'tender/1554894153_2075-12-27.jpeg', 'no', '2019-04-10 11:02:33', '2019-04-10 11:05:00'),
(450, 'Sabhapokhari Rural Minicipality', 'Invitation for Bids', '2075-12-27', '0000-00-00', '0000-00-00', 'Tender', 'Government/Ministries/Departments', 'Business', 'Nagarik News', 'tender/1554894604_2075-12-27.jpeg', 'no', '2019-04-10 11:10:05', '2019-04-10 11:10:05'),
(451, 'भूमि व्यवस्था, कृषि तथा सहकारी मन्त्रालय ', '  अार्थिक प्रस्ताव खाेल्ने सम्बन्धि सूचना', '2075-12-28', '2076-01-05', '2019-04-18', 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Gorkhapatra Rastriya Dainik', 'tender/1554957490_2075-12-28.jpeg', 'no', '2019-04-11 04:38:10', '2019-04-11 04:38:10'),
(452, 'भूमि व्यवस्था, सहकारी तथा गरिबी मन्त्रालय', 'सिलबन्दी दरभाउपत्र स्वीकृत गरिएकाे', '2075-12-28', '2076-06-01', '2019-09-18', 'Tender', 'Government/Ministries/Departments', 'Architecture', 'Gorkhapatra Rastriya Dainik', 'tender/1554957879_2075-12-28.png', 'no', '2019-04-11 04:44:39', '2019-04-11 04:44:39'),
(453, 'National Reconstructon Authority', 'Notice Inviting Quotation for Shopping Goods', '2075-12-28', '0000-00-00', '0000-00-00', 'Tender', 'Education- Universities/Colleges/Schools', 'Educational', 'Gorkhapatra Rastriya Dainik', 'tender/1554958154_2075-12-28.jpeg', 'no', '2019-04-11 04:49:14', '2019-04-11 04:49:14'),
(454, 'Nepal Airlines Corporations', 'Re-Notice for RFP Due Diligence Audit (DDA) in NAC', '2075-12-28', '2076-01-13', '2019-04-26', 'Tender', 'Toursim/Travel/Hotel/Airline', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554958950_2075-12-28.png', 'no', '2019-04-11 05:02:30', '2019-04-11 05:02:30'),
(455, 'नेपाल बैँक लिमिटेड', ' सिलबन्दी बाेलपत्र स्वीकृत गर्ने अाशयकाे', '2075-12-28', '2076-01-05', '2019-04-18', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554959303_2075-12-28.png', 'no', '2019-04-11 05:08:23', '2019-04-11 05:09:10'),
(456, 'नेपाल विद्युत् प्राधिकरण', 'सिलबन्दी दरभाउपत्र स्वीकृत गर्ने अाशय', '2075-12-28', '2076-02-01', '2019-05-15', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554959658_2075-12-28.png', 'no', '2019-04-11 05:14:18', '2019-04-11 05:14:18'),
(457, 'नेपाल विद्युत् प्राधिकरण', 'सिलबन्दी दरभाउपत्र अाव्हानकाे सूचना', '2075-12-28', '2076-01-13', '2019-04-26', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554959782_2075-12-28.png', 'no', '2019-04-11 05:16:22', '2019-04-11 05:16:22'),
(458, 'नेपाल विद्युत् प्राधिकरण', 'सिलबन्दी बाेलपत्र/दरभाउपत्र अाव्हानकाे सूचना', '2075-12-28', '2076-01-12', '2019-04-25', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554959926_2075-12-28.png', 'no', '2019-04-11 05:18:46', '2019-04-11 05:18:46'),
(459, 'नेपाल विद्युत् प्राधिकरण', 'सिलबन्दी दरभाउपत्र स्वीकृत गर्ने अाशय', '2075-12-28', '2076-02-01', '2019-05-15', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554960256_2075-12-28.png', 'no', '2019-04-11 05:24:16', '2019-04-11 05:24:16'),
(460, 'नेपाल विद्युत् प्राधिकरण', 'सिलबन्दी दरभाउपत्र अाव्हानकाे सूचना', '2075-12-28', '2076-01-13', '2019-04-26', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554960434_2075-12-28.png', 'no', '2019-04-11 05:27:14', '2019-04-11 05:28:08'),
(461, 'नेपाल विद्युत् प्राधिकरण', 'सिलबन्दी दरभाउपत्र अाव्हानकाे सूचना', '2075-12-28', '2076-01-13', '2019-04-26', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554960539_2075-12-28.jpeg', 'no', '2019-04-11 05:28:59', '2019-04-11 05:28:59'),
(462, 'Nepal Oil Corporation Limited', 'Invitation for Sealed Quotation', '2075-12-28', '2076-01-12', '2019-04-25', 'Tender', 'Nepal Oil Corporation Limited', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554960911_2075-12-28.jpeg', 'no', '2019-04-11 05:35:11', '2019-04-11 05:35:11'),
(463, '  नेपाल टेलिकम', 'सिलबन्दी दरभाउपत्र अाव्हानकाे सूचना', '2075-12-28', '2076-01-13', '2019-04-26', 'Tender', 'IT/Telecommunications', 'Media/News', 'Gorkhapatra Rastriya Dainik', 'tender/1554961337_2075-12-28.jpeg', 'no', '2019-04-11 05:39:22', '2019-04-11 05:42:17'),
(464, 'Nepal Telecom', 'Notice for Tender Invitation', '2075-12-28', '2076-01-14', '2019-04-27', 'Tender', 'IT/Telecommunications', 'Media/News', 'Gorkhapatra Rastriya Dainik', 'tender/1554961550_2075-12-28.png', 'no', '2019-04-11 05:45:50', '2019-04-11 05:45:50'),
(465, '  राष्ट्रिय वाणिज्य बैँक लि.', 'बाेलपत्र स्वीकृतका लागि छनाेट गर्ने अाशयकाे सूचना', '2075-12-28', '2076-01-05', '2019-04-18', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554961995_2075-12-28.png', 'no', '2019-04-11 05:53:15', '2019-04-11 05:53:15'),
(466, 'Rastriya Banijya Bank Limited.', 'Invitation for Sealed Proposal for Procurement of point of sales(POS) Services on Revenue Sharing Basis', '2075-12-28', '2076-01-28', '2019-05-11', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1554962368_2075-12-28.jpeg', 'no', '2019-04-11 05:59:29', '2019-04-11 05:59:29'),
(467, 'बैँक अफ काठमाण्डू लिमिटेड', '   सिलबन्दी बाेलपत्र अाव्हानकाे सूचना', '2075-12-28', '2076-01-13', '2019-04-26', 'Tender', 'Bank/Finance', 'Business', 'Annapurna Post', 'tender/1554962819_2075-12-28.jpeg', 'no', '2019-04-11 06:06:59', '2019-04-11 06:20:29'),
(468, 'बारबर्दिया नगरपालिका ', 'सिलबन्दी दरभाउपत्र स्वीकृत गर्ने अाशय', '2075-12-27', '2076-01-27', '2019-05-10', 'Tender', 'Government/Ministries/Departments', 'Government', 'Annapurna Post', 'tender/1554963103_2075-12-27.png', 'no', '2019-04-11 06:11:43', '2019-04-11 06:19:52'),
(469, 'भाैतिक पूर्वाधार विकास मन्त्रालय', 'बाेलपत्र स्वीकृत गर्ने अाशय', '2075-12-26', '2076-02-01', '2019-05-15', 'Tender', 'Government/Ministries/Departments', 'Architecture', 'Annapurna Post', 'tender/1554963508_2075-12-26.png', 'no', '2019-04-11 06:18:28', '2019-04-11 06:19:16'),
(470, ' मिक्लाजुंङ गाउपालिका माेरङ', 'बाेलपत्र स्वीकृत गर्ने अाशय', '2075-12-26', '2076-02-01', '2019-05-15', 'Tender', 'Government/Ministries/Departments', 'Business', 'Annapurna Post', 'tender/1554963898_2075-12-26.jpeg', 'no', '2019-04-11 06:24:58', '2019-04-11 06:24:58'),
(471, 'Punchkhal Municipality', 'Invitation for Bids', '2075-12-27', '2076-01-15', '2019-04-28', 'Tender', 'Government/Ministries/Departments', 'Government', 'Annapurna Post', 'tender/1554964102_2075-12-27.jpeg', 'no', '2019-04-11 06:28:22', '2019-04-11 06:28:22'),
(472, 'Provience Government', 'Invitation for Electronic Bids', '2075-12-27', '2076-01-27', '2019-05-10', 'Tender', 'Toursim/Travel/Hotel/Airline', 'Government', 'Annapurna Post', 'tender/1554964251_2075-12-27.jpeg', 'no', '2019-04-11 06:30:51', '2019-04-11 06:30:51'),
(473, 'Rajdevi Municipality', 'Invitation for Bids', '2075-12-27', '2076-03-26', '2019-07-11', 'Tender', 'Government/Ministries/Departments', 'Business', 'Annapurna Post', 'tender/1554964423_2075-12-27.jpeg', 'no', '2019-04-11 06:33:43', '2019-04-11 06:33:43'),
(474, 'शहरी विकास मन्त्रालय', 'बाेलपत्र स्वीकृत गर्ने अाशय', '2075-12-28', '2076-01-05', '2019-04-18', 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Annapurna Post', 'tender/1554964656_2075-12-28.png', 'no', '2019-04-11 06:37:36', '2019-04-11 06:38:09'),
(475, 'भाैतिक पूर्वाधार विकास मन्त्रालय  ', 'बाेलपत्र स्वीकृत गर्ने अाशयकाे सूचना', '2075-12-28', '2076-02-02', '2019-05-16', 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Nagarik News', 'tender/1554964928_2075-12-28.jpeg', 'no', '2019-04-11 06:42:08', '2019-04-11 06:42:08'),
(476, 'इलाम नगरपालिका', '  सिलबन्दी बाेलपत्र अाव्हानकाे सूचना ', '2075-12-28', '2076-01-29', '2019-05-12', 'Tender', 'Government/Ministries/Departments', 'Architecture', 'Nagarik News', 'tender/1554965119_2075-12-28.jpeg', 'no', '2019-04-11 06:45:19', '2019-04-11 06:45:19'),
(477, 'Madan Bhandari Highway Project Directorate', 'Expression of Interest for Consulting Services', '2075-12-28', '2076-01-13', '2019-04-26', 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Nagarik News', 'tender/1554965447_2075-12-28.jpeg', 'no', '2019-04-11 06:50:47', '2019-04-11 06:50:47'),
(478, ' अार्थिक मामिला तथा याेजना मन्त्रालय', ' बाेलपत्र स्वीकृत गर्ने अाशयकाे सूचना', '2075-12-28', '2076-02-01', '2019-05-15', 'Tender', 'Government/Ministries/Departments', 'Business', 'Nagarik News', 'tender/1554965664_2075-12-28.jpeg', 'no', '2019-04-11 06:54:24', '2019-04-11 06:54:24'),
(479, 'Water Supply and Sanatation Division Office,Gorkha', 'Invitation for Online Bids', '2075-12-28', '2076-01-28', '2019-05-11', 'Tender', 'Government/Ministries/Departments', 'Government', 'Nagarik News', 'tender/1554966306_2075-12-28.jpeg', 'no', '2019-04-11 07:05:06', '2019-04-11 07:05:06'),
(480, 'भाैतिक पूर्वाधार विकास मन्त्रालय ', ' सिलबन्दी प्रस्ताव अाव्हान सम्बन्धि सूचना', '2075-12-29', '2076-01-14', '2019-04-27', 'Tender', 'Government/Ministries/Departments', 'Government', 'Gorkhapatra Rastriya Dainik', 'tender/1555048411_2075-12-29.jpeg', 'no', '2019-04-12 05:53:31', '2019-04-12 05:53:31'),
(481, 'Kathmandu Metropolitan City', 'Invitation for BID', '2075-12-29', '2076-01-30', '2019-05-13', 'Tender', 'Government/Ministries/Departments', 'Government', 'Gorkhapatra Rastriya Dainik', 'tender/1555048674_2075-12-29.jpeg', 'no', '2019-04-12 05:57:54', '2019-04-12 05:57:54'),
(482, 'Kathmandu- Tarai/Madhesh Fast Track(Expressway) Rod Project', 'Invitation for Quotations', '2075-12-29', '2076-01-15', '2019-04-28', 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Gorkhapatra Rastriya Dainik', 'tender/1555048915_2075-12-29.jpeg', 'no', '2019-04-12 06:01:55', '2019-04-12 06:01:55'),
(483, 'NEA, Planning and Technical Service Department', 'Invitation for Bids', '2075-12-29', '2076-01-29', '2019-05-12', 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Gorkhapatra Rastriya Dainik', 'tender/1555049134_2075-12-29.png', 'no', '2019-04-12 06:05:34', '2019-04-12 06:05:34'),
(484, '    नेपाल बैँक लिमिटेड', '  सिलबन्दी बाेलपत्र स्वीकृत गर्ने अाशयकाे सूचना  ', '2075-12-29', '2076-01-06', '2019-04-19', 'Tender', 'Bank/Finance', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1555049338_2075-12-29.jpeg', 'no', '2019-04-12 06:08:58', '2019-04-12 06:08:58'),
(485, 'नेपाल विद्युत् प्राधिकरण', 'सिलबन्दी दरभाउपत्र अाव्हानकाे सूचना', '2075-12-29', '2076-01-14', '2019-04-27', 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1555049595_2075-12-29.jpeg', 'no', '2019-04-12 06:13:15', '2019-04-12 06:13:15'),
(486, 'नेपाल विद्युत् प्राधिकरण', 'सिलबन्दी बाेलपत्र/दरभाउपत्र अाव्हानकाे सूचना ', '2075-12-29', '2076-01-29', '2019-05-12', 'Tender', 'Government/Ministries/Departments', 'Electronics', 'Gorkhapatra Rastriya Dainik', 'tender/1555049873_2075-12-29.png', 'no', '2019-04-12 06:17:53', '2019-04-12 06:17:53'),
(487, 'Nepal Electricity Authority ', 'Invitation for Bids', '2075-12-29', '2076-04-17', '2019-08-02', 'Tender', 'Government/Ministries/Departments', 'Nepal Electricity Authority', 'Gorkhapatra Rastriya Dainik', 'tender/1555050233_2075-12-29.png', 'no', '2019-04-12 06:23:53', '2019-04-12 06:23:53'),
(488, 'Nepal Electricity Authority', 'Invitation for Bids', '2075-12-29', '2076-04-25', '2019-08-10', 'Tender', 'Government/Ministries/Departments', 'Nepal Electricity Authority', 'Gorkhapatra Rastriya Dainik', 'tender/1555050416_2075-12-29.png', 'no', '2019-04-12 06:26:56', '2019-04-12 06:26:56'),
(489, 'Nepal Electricity Authority', 'Invitation for Bids (IFB)', '2075-12-29', '2076-01-15', '2019-04-28', 'Tender', 'Government/Ministries/Departments', 'Nepal Electricity Authority', 'Gorkhapatra Rastriya Dainik', 'tender/1555050594_2075-12-29.png', 'no', '2019-04-12 06:29:54', '2019-04-12 06:29:54'),
(490, 'Nepal Rastra Bank, Generak Service Department,Baluwater', 'Invitation for Bids ', '2075-12-29', '2076-01-29', '2019-05-12', 'Tender', 'Bank/Finance', 'Construction/Building', 'Gorkhapatra Rastriya Dainik', 'tender/1555050827_2075-12-29.png', 'no', '2019-04-12 06:33:47', '2019-04-12 06:33:47'),
(491, 'Radio Broadcasting Casting (Radion Nepal)', 'Invitation for Bids', '2075-12-29', '2076-01-29', '2019-05-12', 'Tender', 'IT/Telecommunications', 'Media/News', 'Gorkhapatra Rastriya Dainik', 'tender/1555051027_2075-12-29.png', 'no', '2019-04-12 06:37:07', '2019-04-12 06:37:07'),
(492, 'राष्ट्रिय पुनर्निर्माण प्राधिकरण', ' आर्थिक प्रस्ताब खोल्ने बारे ', '2075-12-29', '2076-01-05', '2019-04-18', 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Gorkhapatra Rastriya Dainik', 'tender/1555051317_2075-12-29.png', 'no', '2019-04-12 06:41:57', '2019-04-12 06:41:57'),
(493, 'State Assembly Secretariat', 'Invitation for Electronic Bids', '2075-12-29', '2076-01-29', '2019-05-12', 'Tender', 'Government/Ministries/Departments', 'Business', 'Gorkhapatra Rastriya Dainik', 'tender/1555051598_2075-12-29.png', 'no', '2019-04-12 06:46:38', '2019-04-12 06:46:38'),
(494, 'श्री स्वदेश उपशाखा, सैनिक सामग्री प्राप्ति निर्देशनालय ', ' बाेलपत्र अाव्हानकाे सूचना', '2075-12-29', '2076-04-29', '2019-08-14', 'Tender', 'Government/Ministries/Departments', 'Government', 'Gorkhapatra Rastriya Dainik', 'tender/1555051949_2075-12-29.jpeg', 'no', '2019-04-12 06:52:29', '2019-04-12 06:52:29'),
(495, '  त्रिभुवन विश्वविद्यालय', 'त्रि.वि.काे वेबसाइट एण्ड डेभलपमेण्ट सम्बन्धि सूचना', '2075-12-29', '2076-01-06', '2019-04-19', 'Tender', 'Education- Universities/Colleges/Schools', 'Technological/Softwares', 'Gorkhapatra Rastriya Dainik', 'tender/1555052601_2075-12-29.png', 'no', '2019-04-12 07:03:21', '2019-04-12 07:03:21'),
(496, 'Bhojpur Municipality', 'Invitation for Seal Quotation', '2075-12-29', '2076-03-10', '2019-06-25', 'Tender', 'Government/Ministries/Departments', 'Government', 'Annapurna Post', 'tender/1555052854_2075-12-29.jpeg', 'no', '2019-04-12 07:07:34', '2019-04-12 07:07:34'),
(497, 'Infrastructure Development Offoce', 'Invitation for Bids', '2075-12-29', '2076-03-10', '2019-06-25', 'Tender', 'Provincial Government ', 'Construction/Building', 'Annapurna Post', 'tender/1555053034_2075-12-29.jpeg', 'no', '2019-04-12 07:10:34', '2019-04-12 07:10:34'),
(498, 'Kalika Municipality', 'Invitation for Bids', '2075-12-29', '2076-01-14', '2019-04-27', 'Tender', 'Government/Ministries/Departments', 'Construction/Building', 'Annapurna Post', 'tender/1555053199_2075-12-29.jpeg', 'no', '2019-04-12 07:12:39', '2019-04-12 07:13:19'),
(499, 'पञ्चपुरी नगरपालिका', 'बाेलपत्र अाव्हानकाे सूचना ', '2075-12-29', '2076-03-11', '2019-06-26', 'Tender', 'Government/Ministries/Departments', 'Government', 'Annapurna Post', 'tender/1555053412_2075-12-29.jpeg', 'no', '2019-04-12 07:15:59', '2019-04-12 07:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `wp_voucher`
--

CREATE TABLE `wp_voucher` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `voucher` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_addindustry`
--
ALTER TABLE `wp_addindustry`
  ADD PRIMARY KEY (`industry_id`);

--
-- Indexes for table `wp_addnewspaper`
--
ALTER TABLE `wp_addnewspaper`
  ADD PRIMARY KEY (`newspaper_id`);

--
-- Indexes for table `wp_addnotice`
--
ALTER TABLE `wp_addnotice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `wp_addproduct`
--
ALTER TABLE `wp_addproduct`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `wp_org`
--
ALTER TABLE `wp_org`
  ADD PRIMARY KEY (`orgid`);

--
-- Indexes for table `wp_pricing`
--
ALTER TABLE `wp_pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_sharebazaar`
--
ALTER TABLE `wp_sharebazaar`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `wp_sharereport`
--
ALTER TABLE `wp_sharereport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_subscription`
--
ALTER TABLE `wp_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_tender`
--
ALTER TABLE `wp_tender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_voucher`
--
ALTER TABLE `wp_voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_addindustry`
--
ALTER TABLE `wp_addindustry`
  MODIFY `industry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wp_addnewspaper`
--
ALTER TABLE `wp_addnewspaper`
  MODIFY `newspaper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wp_addnotice`
--
ALTER TABLE `wp_addnotice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wp_addproduct`
--
ALTER TABLE `wp_addproduct`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `wp_org`
--
ALTER TABLE `wp_org`
  MODIFY `orgid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wp_pricing`
--
ALTER TABLE `wp_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wp_sharebazaar`
--
ALTER TABLE `wp_sharebazaar`
  MODIFY `sid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_sharereport`
--
ALTER TABLE `wp_sharereport`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_subscription`
--
ALTER TABLE `wp_subscription`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wp_tender`
--
ALTER TABLE `wp_tender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500;

--
-- AUTO_INCREMENT for table `wp_voucher`
--
ALTER TABLE `wp_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
