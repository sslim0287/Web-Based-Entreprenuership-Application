-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2021 at 05:01 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `network`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_pass`) VALUES
(1, 'admin', 'admin@gmail.com', '781e5e245d69b566979b86e28d23f2c7');

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `board_id` int(11) NOT NULL,
  `board_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`board_id`, `board_name`) VALUES
(1, 'Business'),
(2, 'Startups'),
(3, 'Entrepreneur'),
(4, 'Invest'),
(5, 'Other Advice'),
(6, 'Relevant Information'),
(7, 'Latest News');

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_profit` int(11) NOT NULL,
  `max_profit` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`id`, `name`, `min_profit`, `max_profit`, `admin_id`) VALUES
(1, 'Affiliate Marketing', 500, 2500, 1),
(2, 'Special home dining service', 500, 5000, 1),
(3, 'Digital marketing services', 500, 2000, 1),
(4, 'Virtual experiences', 1000, 10000, 1),
(5, 'Selling online (e-commerce)', 3000, 10000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `comment`, `comment_author`, `date`) VALUES
(6, 2, 'Hi brian here!', 'brian_ contreras_186141', '2021-10-11 15:14:41'),
(8, 11, 'I am interested in buying this cake. I will drop u a message soon.', 'john_smith_465720', '2021-10-13 17:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_salary` int(11) NOT NULL,
  `max_salary` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `min_salary`, `max_salary`, `admin_id`) VALUES
(1, 'e-Commerce Customer Service ', 50000, 60000, 1),
(2, 'Mobile Application Developer', 90000, 100000, 1),
(3, 'Data Scientist', 75000, 85000, 1),
(4, 'Translator', 50000, 55000, 1),
(5, 'Software Engineer', 45000, 50000, 1),
(6, 'IT Manager', 5000, 7000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `FromUser` varchar(100) NOT NULL,
  `ToUser` varchar(100) NOT NULL,
  `Message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `FromUser`, `ToUser`, `Message`) VALUES
(16, '2', '1', 'Hi, does the Hazelnut Crunch Cake still available?\n'),
(17, '1', '2', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(3000) NOT NULL,
  `upload_image` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `upload_image`, `post_date`) VALUES
(2, 1, 'Hi, I am Waynes Deles. I am a successful Home Bakery Business Owners. I live in Kedah and if anyone is interested in buying home bakery, you can pm me. Thank you.', '', '2021-08-18 15:40:06'),
(4, 2, 'Hi, I am John Smiths. I am an entrepreneur that works on 3D printing. I live in Johor and if anyone is interested in 3D printing or want to chat with me, you can pm me. Thank you.', '', '2021-08-22 13:10:49'),
(11, 1, '#Advertise\r\nI am currently selling Hazelnut Crunch Cake. If anyone is interested, you can drop me a message at chat. Thanks. ', 'Hazelnut Crunch Cake.jpg.46', '2021-09-08 17:39:16'),
(13, 1, '#Job\r\nCurrently looking for Production Assistant (Home Bakery Helper)\r\n\r\nJob Responsibilities\r\n   - Assist in production line in preparation and handle baking, stuffing, shaping and finishing high quality breads\r\n   - Ensure cleanliness and sanitation of workstation and equipment\r\n   - Ensure that food handling and hygiene regulations are followed in accordance with Standards\r\n\r\nJob Requirements\r\n   - 5 working days/week (including weekend and public holiday)\r\n   - Ability to work overtime base on business.\r\n   - Ability to stand for long periods of time\r\n   - Able to work independently\r\n\r\nMinimum Years of Experience: 1 Year\r\n\r\nSalary: MYR 2,000 - MYR 2,500\r\n\r\nIf anyone interested, please pm me. Thanks.', '', '2021-09-19 15:18:12'),
(19, 2, '#Job\r\nCurrently looking for 3D Printing Operator\r\n\r\nJob Description\r\n\r\n- Able to do 3D slicing.\r\n- Operate 3D Scanner.\r\n- Able to operate a 3D printer efficiently.\r\n- Able to maintain 3D printer.\r\n- Able to handle minor repairs on 3D printers.\r\n\r\nMinimum Years of Experience: 2 Years\r\nSalary: MYR 3,000 - MYR 4,500\r\nIf anyone interested, please pm me. Thanks.', '', '2021-10-13 17:20:36'),
(22, 3, '#Advertise\r\n\r\nTropicana Grandhill\r\nLocation:    Jalan Permai, Genting Permai Avenue, Genting Highlands, Pahang\r\nType:          Service Residence For Sale\r\nTenure:       Freehold\r\nFloor size:  379 sqft\r\nDeveloper: Tropicana Sierra Sdn Bhd\r\nPSF:          RM 952.24 psf\r\nBuilt Year:  2026\r\n\r\nIf anyone is interested, please pm me or drop me a message. Thanks.', 'tropicana.jpg.94', '2021-10-14 04:01:31'),
(23, 4, '#Job\r\nCurrently looking for HUMAN RESOURCE EXECUTIVE\r\n\r\nJob Description\r\n- Develop, implement & maintain HR guidelines/ policies.\r\n- HR also will sending offers, offer negotiation and reference check up after interview.\r\n- Conduct Induction program to all new employees.\r\n\r\nJob Requirements\r\n- Knowledge of HR issues such as benefits, payroll, time & attendance, leave management, worker’s compensation, etc.\r\n- Strong knowledge in Employment Act, Industrial relations and Statutory\r\n\r\nYears of Experience: 3 years\r\nJob Type: Full-Time\r\nSalary: MYR3,000 - MYR 4,000\r\n\r\nIf anyone interested, please pm me. Thanks.', '', '2021-10-14 12:55:06'),
(24, 4, 'These are some clothes that I had designed. Feel free to give me some comment. Thanks ', 'clothes.jpg.57', '2021-10-14 13:08:48'),
(25, 5, 'These are some of my collection of drones. ', 'drones.jpg.18', '2021-10-14 13:16:31'),
(26, 5, 'Drones have been a helpful technology and I am excited to get involved in any projects that related to drone. Feel free to message me or join the meeting with me for discussing about the useful or some ideas about drone.', '', '2021-10-14 13:21:16'),
(27, 6, '#Advertise\r\n\r\n2015 TOYOTA CAMRY 2.5 HYBRID FACELIFT(A)F/SERVICES\r\n\r\n~~~~SALAM SEJAHTERA ~~~~\r\n\r\n**OUR CAR CONFIRM NO NEED TO REPAIR\r\n**BUY & DRIVE ONLY\r\n**BANK LOAN CAN GET FULL AND 9 YEARS\r\n\r\nCondition: Used Car\r\nYear / Reg: 2015 / 2015\r\nLocation: Selangor\r\nCity: Cheras\r\nMileage: 105,000 - 109,999km\r\nColor: Silver\r\nAT / MT: Automatic\r\nEngine: 2500cc\r\nBody Style: Sedan\r\n', 'Screenshot 2021-10-14 at 21-49-11 toyota camry 2015 - Google Search.png.5', '2021-10-14 13:48:01'),
(28, 7, 'Hi, I am Nur Aisyah. I am an entrepreneur that works as freelance writer. I live in Selangor and if anyone is interested in writing or sharing ideas together, we can chat or join a meeting together. Feel free to drop me a message. 😊', '', '2021-10-14 14:30:42'),
(29, 8, 'Hi, I am Sharon Tan. I am working as education tutor. I live in Perak and if anyone is looking for education tutor, you can always drop me a message.\r\n\r\nSubjects Covered\r\nMalay, English, Mandarin, Maths, Science, History, Geography, Physic, Chemistry, Biology, Add maths, Accounts and almost all academic subjects\r\n\r\nLevels Covered\r\nkindergarten, primary, secondary, foundation, diploma and degree\r\n\r\nSyllabus Covered\r\nUPSR, PT3, SPM, IGCSE, UEC, IB and other international syllabus / a-level, sam and others / diploma & degree syllabus\r\n\r\n', '', '2021-10-14 14:42:13'),
(30, 9, 'Hi, I am Johnny Yeoh. I am an entrepreneur that works for repairing computers, mobile phones or any electronic gadgets. I live in Penang and if anyone is interested in requesting for my service, feel free to drop me a message. ', '', '2021-10-14 14:59:39'),
(31, 10, 'Hi, I am Jennifer. I work as pharmacy entrepreneur. Feel free to drop me a message if anyone is interested in sharing ideas or having a discussion about topic related to pharmacy. We can chat or join a meeting together.', '', '2021-10-15 15:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `social_follow`
--

CREATE TABLE `social_follow` (
  `follow_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followed_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_follow`
--

INSERT INTO `social_follow` (`follow_id`, `follower_id`, `followed_user_id`) VALUES
(31, 1, 2),
(32, 3, 2),
(33, 2, 1),
(34, 2, 3),
(35, 3, 1),
(37, 4, 2),
(38, 4, 3),
(39, 4, 1),
(40, 5, 2),
(42, 6, 1),
(43, 6, 4),
(44, 7, 4),
(45, 7, 3),
(46, 8, 1),
(47, 8, 2),
(48, 8, 4),
(55, 10, 1),
(56, 10, 8),
(57, 10, 7),
(58, 9, 1),
(59, 9, 5),
(60, 9, 10),
(61, 5, 6),
(62, 5, 7),
(63, 1, 7),
(64, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `thread_title` varchar(1000) NOT NULL,
  `thread_content` varchar(1000) NOT NULL,
  `thread_author` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `board_id`, `thread_title`, `thread_content`, `thread_author`, `date`) VALUES
(1, 1, 'Current Business Situation', 'What are your thought on current business or entrepreneur situation?\r\nShare some ideas or opinions here.', 'wayne_dele_3453121', '2021-09-22 13:23:27'),
(5, 3, 'For entrepreneur', 'What are the requirement to become a good and successful entrepreneur?', 'wayne_dele_3453121', '2021-10-10 10:20:14'),
(6, 2, 'How to startup a new Company', 'I am new to Entrepreneurship and looking for some new ideas about it\r\n', 'wayne_dele_3453121', '2021-10-10 12:43:44'),
(7, 1, 'Any interesting business solution?', 'Hi everyone, I am looking for some interesting business solution, if you have any great ideas, feel free to comment or chat with me, Thanks for your attention.', 'john_smith_465720', '2021-10-15 15:25:07'),
(8, 7, 'Latest News in Malaysia', 'Hi everyone, is there any interesting news recently that might affect the growth of business in Malaysia?', 'john_smith_465720', '2021-10-15 15:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `thread_comments`
--

CREATE TABLE `thread_comments` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `comment_user` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thread_comments`
--

INSERT INTO `thread_comments` (`id`, `thread_id`, `comment`, `comment_user`, `date`) VALUES
(5, 2, 'testing\r\n', 'john_smith_465720', '2021-09-22 14:26:32'),
(7, 1, 'Looking forward to getting some interesting respond from everyone 😊', 'wayne_dele_3453121', '2021-10-11 07:17:36'),
(12, 6, 'In order to startup a new company, you are required to:\r\n- Conduct Market Research\r\n- Having your own business plan\r\n- Find way to fund your own business\r\n- Pick your business location\r\n- Choose a business structure\r\n- Choose your business name and register your business\r\nThere are other ways to startup a new company too, hope this comment able to give u some ideas about it.', 'john_smith_465720', '2021-10-15 15:16:39'),
(13, 5, 'A great entrepreneur must be able to effectively communicate, sell, focus, learn, and strategize. If you have some thought about entrepreneur, we can have a meeting session and discuss about it.', 'john_smith_465720', '2021-10-15 15:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `user_name` text NOT NULL,
  `describe_user` varchar(255) NOT NULL,
  `job_field` text NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_country` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_birthday` text NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_cover` varchar(255) NOT NULL,
  `user_reg_date` date NOT NULL DEFAULT current_timestamp(),
  `status` text NOT NULL,
  `posts` text NOT NULL,
  `recovery_account` varchar(255) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `user_name`, `describe_user`, `job_field`, `user_pass`, `user_email`, `user_country`, `user_gender`, `user_birthday`, `user_image`, `user_cover`, `user_reg_date`, `status`, `posts`, `recovery_account`, `usertype`, `admin_id`) VALUES
(1, 'Waynes', 'Deles', 'wayne_dele_3453121', 'My job is working as a home bakery.', 'Sales', '781e5e245d69b566979b86e28d23f2c7', 'wDele@gmail.com', 'Kedah', 'Male', '1999-03-02', 'wayne.png.98', 'bakery.jpg.77', '2021-08-14', 'verified', 'yes', 'asd', 'user', 1),
(2, 'John', 'Smiths', 'john_smith_465720', 'Hi guys. I am an entrepreneur that works on 3D printing.', 'Architecture and engineering', '781e5e245d69b566979b86e28d23f2c7', 'jsmith@gmail.com', 'Johor', 'Male', '1997-10-14', 'engin.jpg.3', '3dd.jpg.95', '2021-08-19', 'verified', 'yes', 'Default', 'user', 1),
(3, 'Brian', 'Contreras', 'brian_ contreras_186141', 'Hello Guys. I am a real estate broker entrepreneur. If anyone is interested in buying house, you can drop me a message.', 'Sales', '781e5e245d69b566979b86e28d23f2c7', 'brian@gmail.com', 'Pahang', 'Male', '1993-01-12', 'rea.jpg.22', 'reaal.webp.61', '2021-09-12', 'verified', 'yes', 'Default', 'user', 1),
(4, 'Tiffany', 'Rouge', 'tiffany_rouge_295767', 'Hello. I am an entrepreneur that works as Fashion Designer.', 'Arts, culture and entertainment', '781e5e245d69b566979b86e28d23f2c7', 'tr@gmail.com', 'Kelantan', 'Female', '1990-01-19', 'fashion.jpg.51', 'cloth.jpg.43', '2021-09-19', 'verified', 'yes', 'Default', 'user', 1),
(5, 'Carlos', 'Lard', 'carlos_lard_28255', 'Hello. I am an entrepreneur that involved in projects related to drone. I have sell some drones too.', 'Science and technology', '781e5e245d69b566979b86e28d23f2c7', 'clard@gmail.com', 'Malacca', 'Male', '1984-10-16', 'clard.png.47', 'drone.jpg.43', '2021-09-19', 'verified', 'yes', 'Default', 'user', 1),
(6, 'Ahmad Akbar', 'Bin Mohamad', 'carl_smithen_915165', 'Hi Guys, I am an entrepreneur that works as car reseller.', 'Sales', '781e5e245d69b566979b86e28d23f2c7', 'ahmad@gmail.com', 'Pahang', 'Male', '1994-10-11', 'Screenshot 2021-10-14 at 21-44-10 malaysian man iamge - Google Search.png.54', 'rrr.jpg.51', '2021-09-22', 'verified', 'yes', 'Default', 'user', 1),
(7, 'Nur', 'Aisyah', 'nur_aisyah_96625', 'Hi everyone. I am a freelance writer entrepreneur.', 'Education', '781e5e245d69b566979b86e28d23f2c7', 'nur@gmail.com', 'Selangor', 'Female', '1996-03-15', 'book.png.41', 'book.jpg.91', '2021-10-14', 'verified', 'yes', 'Default', 'user', 1),
(8, 'Sharon', 'Tan', 'sharon_tan_46708', 'Hello. I work as education tutor. ', 'Education', '781e5e245d69b566979b86e28d23f2c7', 'tan@gmail.com', 'Perak', 'Female', '1999-06-13', 'tut.png.50', 'tutorr.webp.61', '2021-10-14', 'verified', 'yes', 'Default', 'user', 1),
(9, 'Johnny', 'Yeoh', 'johnny_yeoh_800360', 'Hello. I work as repairman that repair computers or mobile phones.', 'Installation, repair and maintenance', '781e5e245d69b566979b86e28d23f2c7', 'yeoh@gmail.com', 'Penang', 'Male', '1985-07-30', 'asd.png.18', 'com.jpg.68', '2021-10-14', 'verified', 'yes', 'Default', 'user', 1),
(10, 'Jennifer', 'Lim', 'jennifer_lim_09190', 'Hello. I am a Pharmacist Entreprenuer.', 'Health and medicine', '781e5e245d69b566979b86e28d23f2c7', 'jl@gmail.com', 'Penang', 'Female', '1985-11-20', 'pha.jpg.35', 'phaa.jpg.40', '2021-10-15', 'verified', 'yes', 'Default', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`board_id`);

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `social_follow`
--
ALTER TABLE `social_follow`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `thread_comments`
--
ALTER TABLE `thread_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `board_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `social_follow`
--
ALTER TABLE `social_follow`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `thread_comments`
--
ALTER TABLE `thread_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
