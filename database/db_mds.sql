-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 05:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mds`
--
CREATE DATABASE IF NOT EXISTS `db_mds` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_mds`;

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `image`, `description`) VALUES
(1, '90153595.jpg', 'Welcome to Malware Detection System, your trusted ally in safeguarding digital environments against malicious threats. At Malware Detection System, we prioritize empowering our users with cutting-edge technology to fortify their digital defenses. Our mission is to provide an intuitive and efficient platform where users can confidently sign up and upload their files for thorough examination, ensuring the safety and integrity of their digital assets.\r\n\r\nOur Commitment to Excellence\r\n\r\nAt Malware Detection System, excellence is not just a goal; it&#039;s our standard. We are dedicated to staying at the forefront of technological advancements in malware detection and prevention. Our team of experts works tirelessly to develop and refine innovative solutions that anticipate and neutralize emerging threats. By upholding rigorous standards of accuracy and reliability, we strive to earn and maintain the trust of our valued users.\r\n\r\nEmpowering Users with Knowledge\r\n\r\nKnowledge is power, especially in the realm of cybersecurity. That&#039;s why Malware Detection System is committed to empowering our users with comprehensive insights into the security status of their digital files. Through our user-friendly interface, users can easily interpret scan results and gain valuable understanding of potential threats. Armed with this knowledge, our users can make informed decisions to mitigate risks and protect their digital assets effectively.\r\n\r\nCustomer-Centric Approach\r\n\r\nAt Malware Detection System, the user experience is paramount. We understand that cybersecurity can be complex, which is why we prioritize simplicity, transparency, and accessibility in everything we do. From seamless account registration to hassle-free file uploads, we strive to streamline every aspect of our platform to ensure a smooth and intuitive experience for our users. Furthermore, our dedicated customer support team is always ready to assist users with any inquiries or concerns they may have, providing personalized assistance every step of the way.\r\n\r\nBuilding a Secure Future Together\r\n\r\nIn an increasingly interconnected world, the importance of cybersecurity cannot be overstated. At Malware Detection System, we recognize that protecting against malicious threats is not just a responsibility; it&#039;s a collaborative effort. By fostering partnerships with our users, industry leaders, and cybersecurity experts, we aim to build a safer digital ecosystem for everyone. Together, we can proactively confront the ever-evolving landscape of cyber threats and pave the way for a more secure future. Join us in our mission to safeguard digital environments and empower users with the tools they need to thrive in the digital age.');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(55) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `gender_id` char(11) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `name`, `email`, `phone`, `gender_id`, `photo`) VALUES
('admin', 'Zul Hilmi', 'jumiey1902@gmail.com', '0177077707', 'M', 'face12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `awareness`
--

CREATE TABLE `awareness` (
  `awareness_id` int(11) NOT NULL,
  `posted_date` date NOT NULL,
  `title` varchar(100) NOT NULL,
  `awareness` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `awareness`
--

INSERT INTO `awareness` (`awareness_id`, `posted_date`, `title`, `awareness`, `image`) VALUES
(1, '2024-04-03', 'What is Malware ?', 'Malware refers to any software designed to have a malicious purpose once deployed to a computer or network. Malware infection typically occurs without a user&#039;s knowledge, often because it camouflages itself as a different file type such as an image or PDF file.\r\n\r\nThis type of software can affect both desktop and mobile devices. It can serve various purposes, from stealing information to spying on keystrokes and even using a computer&#039;s hardware to mine cryptocurrency.', 'what-is-malware.png'),
(2, '2024-04-03', 'Is Malware a Virus?', 'All viruses are malware, but not all malware is a virus. Computer viruses gained that moniker because one can replicate itself and infect other machines, just like how a medical virus can affect human beings it comes in contact with. Certain types of malware are very targeted and don&#039;t fall into the virus category. They aim to control the specific machine or network they are installed on to achieve some other objective. In some cases, malicious software can be exponentially more difficult to detect and eliminate as it may only operate in the background.', 'Is Malware a Virus.jpg'),
(3, '2024-04-03', 'How Serious is Malware?', 'While there are several different forms of malware, all of them should be considered serious threats. Malware that shows you annoying pop-up ads or slows down your machine (often, this results from attackers mining hardware for cryptocurrency may be the least damaging. However, other examples of malware can still have dire long-term effects on your sensitive information and devices. The most severe malware threats are posed by software that silently monitors activity and logs keystrokes, potentially leading to stolen credit card info or, even worse, industrial espionage.', 'How Serious is Malware.png'),
(5, '2024-04-03', 'How to prevent malware?', 'Avoid suspicious emails, links, and  sites. Staying Cyber Safe means staying suspicious â€” suspicious of attachments from unknown sources, encouragements to click links, and even advertisements that seem too good to be true. All of these can be phishing attempts that result in malware. Play it safe, and donâ€™t engage if your gut tells you not to.', 'warning sign.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`) VALUES
(2, 'How does the Malware Detection System work?', 'MDS works by scanning the uploaded files by user using malware pattern that are available in our database. If the pattern match the uploaded files, our system will quarintine the files and mark it as a detected files.'),
(3, 'What types of files can I upload for scanning?', 'You can upload various file formats such as document (e.g. PDF, TXT), images (e.g., JPEG, PNG), executables (e.g., EXE, APK), archives (e.g., ZIP, RAR), and more.'),
(4, 'Is my data secure when uploaded to the Malware Detection System?', 'Yes, we employ stringent security measures to safeguard your data. All files are encrypted during transmission and stored securely on our servers. We adhere to industry best practices to ensure the confidentiality and integrity of your data.'),
(5, 'What happens if malware is detected in my file?', 'If malware is detected, you will be promptly notified, and appropriate actions will be taken. This may include quarantine, deletion, or further analysis of the infected file to mitigate any potential risks.'),
(6, 'Is the Malware Detection System capable of detecting all types of malware?', 'While our system is highly effective in detecting a wide range of malware, it&#039;s important to note that no solution can guarantee 100% detection. We continuously update our detection methods to stay ahead of evolving threats.');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` varchar(55) NOT NULL,
  `upload_date` date NOT NULL,
  `title` varchar(55) NOT NULL,
  `file` text NOT NULL,
  `extension` char(4) NOT NULL,
  `uploader` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `upload_date`, `title`, `file`, `extension`, `uploader`, `status`) VALUES
('FILES00001', '2024-04-03', 'Patch Readme', 'encrypted_Readme.txt', 'txt', 'fattah', 'Safe'),
('FILES00003', '2024-04-03', 'soccer image', 'encrypted_273611751_138280535400845_4762809892354812732_n.jpg', 'jpg', 'fattah', 'Safe'),
('FILES00004', '2024-04-03', 'test', 'encrypted_ThankYou.jpg', 'jpg', 'fattah', 'Safe'),
('FILES00007', '2024-04-03', 'Picture From Whatsapp', 'encrypted_WhatsApp-Image-2020-07-24-at-10.28.54-e1595561989915.jpeg', 'jpeg', 'normala', 'Safe'),
('FILES00008', '2024-04-03', 'My App shared by unknown party', 'encrypted_Website 2 APK Builder Pro v5.0.exe', 'exe', 'normala', 'Malware'),
('FILES00011', '2024-04-03', 'testtt', 'encrypted_WhatsApp-Image-2020-07-24-at-10.28.54-e1595561989915.jpeg', 'jpeg', 'julia', 'Safe'),
('FILES00012', '2024-04-03', 'test', 'encrypted_julia.jpeg', 'jpeg', 'julia', ''),
('FILES00013', '2024-04-03', 'test3', 'encrypted_WhatsApp-Image-2020-07-24-at-10.28.54-e1595561989915.jpeg', 'jpeg', 'fattah', 'Safe'),
('FILES00014', '2024-04-03', 'test4', 'encrypted_5.1 Assembly Basic Syntax.docx', 'docx', 'julia', ''),
('FILES00015', '2024-04-03', 'testing', 'encrypted_note for present.txt', 'txt', 'fattah', ''),
('FILES00016', '2024-04-03', 'IDM Crack', 'encrypted_setup.zip', 'zip', 'fattah', 'Safe'),
('FILES00017', '2024-04-03', 'testingg', 'encrypted_Muse - Black Holes and Revelations.mp3', 'mp3', 'fattah', ''),
('FILES00018', '2024-04-03', 'ttt', 'encrypted_01 - Selfie Le Le Re - DownloadMing.SE.mp3', 'mp3', 'fattah', 'Safe'),
('FILES00019', '2024-04-03', 'Muse Mp3 Song', 'encrypted_Muse - Black Holes and Revelations.mp3', 'mp3', 'fattah', 'Safe'),
('FILES00020', '2024-04-03', 'Apk Crack', 'encrypted_Website 2 APK Builder Pro v5.0.exe', 'exe', 'fattah', 'Malware');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` char(11) NOT NULL,
  `gender` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender`) VALUES
('F', 'Female'),
('M', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT 4,
  `status` varchar(55) NOT NULL DEFAULT 'Active',
  `reset_token` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `password`, `level`, `status`, `reset_token`) VALUES
('admin', '$2y$10$uS8HezKHR3ys4FDpumwnk.w/QHNyf9teo/dwgwWofKig6ctMvPmie', 1, 'Active', NULL),
('ahmad', '$2y$10$EOpRR8MEM2fMI0cNSrCbluQogVa/4WG4AmdDkHcE1wZDPQi9KJ.ZK', 2, 'Inactive', NULL),
('fattah', '$2y$10$EOpRR8MEM2fMI0cNSrCbluQogVa/4WG4AmdDkHcE1wZDPQi9KJ.ZK', 2, 'Active', NULL),
('janna', '$2y$10$EOpRR8MEM2fMI0cNSrCbluQogVa/4WG4AmdDkHcE1wZDPQi9KJ.ZK', 2, 'Active', NULL),
('julia', '$2y$10$EOpRR8MEM2fMI0cNSrCbluQogVa/4WG4AmdDkHcE1wZDPQi9KJ.ZK', 2, 'Active', NULL),
('neelofa', '$2y$10$EOpRR8MEM2fMI0cNSrCbluQogVa/4WG4AmdDkHcE1wZDPQi9KJ.ZK', 2, 'Active', NULL),
('normala', '$2y$10$EOpRR8MEM2fMI0cNSrCbluQogVa/4WG4AmdDkHcE1wZDPQi9KJ.ZK', 2, 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(55) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender_id` char(11) NOT NULL,
  `phone_num` varchar(22) NOT NULL,
  `email` varchar(55) NOT NULL,
  `address` text NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `first_name`, `last_name`, `gender_id`, `phone_num`, `email`, `address`, `photo`) VALUES
('ahmad', 'Ahmad', 'Hafiz', 'M', '0177077707', 'ahmad@gmail.com', 'i live in somewhere only we know.', 'face12.jpg'),
('fattah', 'Fattah', 'Amin', 'M', '0133033303', 'fattah@gmail.com', 'fattah live in KL', '03ntfattah_1496456624.jpg'),
('janna', 'Janna', 'Nick', 'F', '0122022202', 'janna@gmail.com', 'No 17 Jalan Stadium Alor Setar Kedah Darul Aman', 'jannanick.jpg'),
('julia', 'Julia', 'Rossa', 'F', '0123456777', 'julia@gmail.com', 'julia live in paris', 'julia.jpeg'),
('neelofa', 'Nurul', 'Neelofa', 'F', '0188088808', 'neelofa@gmail.com', 'neelofa live in korea', 'neelofa-1.png'),
('normala', 'Siti', 'Normala', 'F', '0123456788', 'Normala@gmail.com', 'Normala live in korea', 'WhatsApp-Image-2020-07-24-at-10.28.54-e1595561989915.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `awareness`
--
ALTER TABLE `awareness`
  ADD PRIMARY KEY (`awareness_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `awareness`
--
ALTER TABLE `awareness`
  MODIFY `awareness_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
