-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 09:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apart`
--

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `body`, `admin_id`, `created_at`) VALUES
(1, 'About', '\n\nDiscover Your Dream Apartment with Apart\n\nWelcome to Apart, your ultimate destination for finding the perfect apartment that suits your lifestyle and needs. Our extensive listings feature a wide variety of apartments, each offering unique amenities and comforts to ensure you find a home that matches your desires.\n\nWhy Choose Apart?\n\n- Prime Locations: Our apartments are situated in the most sought-after neighborhoods, providing easy access to work, entertainment, dining, and shopping.\n- Modern Amenities: From state-of-the-art fitness centers and swimming pools to high-speed internet and 24/7 security, our properties are equipped with all the modern conveniences you need.\n- Affordable Options: Whether you\'re looking for a luxury penthouse or a cozy studio, we offer a range of pricing options to fit your budget.\n- Expert Guidance: Our experienced team is dedicated to helping you through every step of the rental process, ensuring a seamless and stress-free experience.\n\nAt Apart, we believe that finding the right home should be an enjoyable journey. Let us help you discover the apartment of your dreams today. Visit our website or contact us to learn more.', 1, '2024-06-06 04:00:03'),
(2, 'Contact', 'Get in touch with us,trust me to your dream home ', 1, '2024-06-05 22:00:03'),
(3, 'About footer', 'Welcome to Apart, your ultimate destination for finding the perfect apartment that suits your lifestyle and needs. Our extensive listings feature a wide variety of apartments, each offering unique amenities and comforts to ensure you find a home that matches your desires.Booking now!', 4, '2024-06-13 07:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`) VALUES
(1, 'John Doe', 'john.doe@example.com', '1234567890', '123 Main St, Springfield'),
(2, 'Jane Smith', 'jane.smith@example.com', '0987654321', '456 Elm St, Springfield'),
(3, 'Michael Johnson', 'michael.johnson@example.com', '9876543210', '789 Oak St, Springfield'),
(4, 'Emily Davis', 'emily.davis@example.com', '0123456789', '456 Pine St, Springfield'),
(5, 'William Wilson', 'william.wilson@example.com', '5551234567', '789 Maple St, Springfield'),
(6, 'Emma Brown', 'emma.brown@example.com', '7778889999', '321 Cedar St, Springfield'),
(7, 'David Miller', 'david.miller@example.com', '1112223333', '654 Birch St, Springfield'),
(8, 'Olivia Taylor', 'olivia.taylor@example.com', '3334445555', '987 Walnut St, Springfield'),
(9, 'Sophia Martinez', 'sophia.martinez@example.com', '6667778888', '741 Elm St, Springfield'),
(10, 'Alexander Garcia', 'alexander.garcia@example.com', '4445556666', '369 Oak St, Springfield'),
(15, 'Nadia Alya Paramitha', 'nadia@gmail.com', '085742668675', 'Jl. Mujamil No. 24'),
(16, 'ooooo', 'alya80914@gmail.com', '085742668675', 'Jl. Mujamil No. 24'),
(17, 'Nadia Alya Paramitha', 'nalya2911@gmail.com', '085742668675', 'Jl. Mujamil No. 24');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `type` enum('news','event','announcement') NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `type`, `date`) VALUES
(1, 'Grand Opening Apartemen XYZ', 'Kami dengan bangga mengumumkan grand opening Apartemen XYZ yang akan dilaksanakan pada tanggal 15 Juli 2024. Segera kunjungi kami untuk penawaran spesial dan diskon eksklusif!', 'event', '2024-07-15'),
(2, 'Apartemen XYZ Mendapat Penghargaan Prestisius', 'Apartemen XYZ meraih penghargaan sebagai Apartemen Terbaik Tahun Ini dalam ajang Penghargaan Properti Nasional. Kami berterima kasih atas dukungan Anda semua!', 'news', '2024-06-20'),
(3, 'Webinar: Investasi Properti di Era Digital', 'Ikuti webinar kami tentang investasi properti di era digital pada tanggal 30 Juni 2024. Dapatkan wawasan dari para ahli dan peluang investasi terbaru!', 'event', '2024-06-30'),
(4, 'Pembukaan Fasilitas Baru di Apartemen XYZ', 'Kami dengan senang hati mengumumkan pembukaan fasilitas baru di Apartemen XYZ, termasuk kolam renang infinity dan pusat kebugaran 24 jam. Segera kunjungi kami untuk pengalaman apartemen yang lebih baik!', 'news', '2024-07-05'),
(5, 'New Amenity: Rooftop Garden', 'We are excited to announce the opening of our new rooftop garden! Enjoy breathtaking views of the city while relaxing in this serene environment. Open to all residents starting this weekend.', 'announcement', '2024-06-15'),
(6, 'Community BBQ Event', 'Join us for a community BBQ event this Saturday at the courtyard. Enjoy delicious food, music, and games with your neighbors. Don\'t miss out on the fun!', 'event', '2024-06-18'),
(7, 'Fitness Center Renovation', 'Our fitness center is undergoing renovations to provide you with state-of-the-art equipment and a refreshed atmosphere. Stay tuned for the grand reopening next month!', 'announcement', '2024-06-20'),
(8, 'Upcoming Maintenance Notice', 'Please be advised that there will be scheduled maintenance on the building\'s elevators next Tuesday. We apologize for any inconvenience this may cause and appreciate your cooperation.', 'announcement', '2024-06-22'),
(9, 'Summer Pool Party', 'Get ready to make a splash! Our annual summer pool party is happening next weekend. Join us for an afternoon of swimming, music, and refreshments. Don\'t forget your sunscreen!', 'event', '2024-06-25'),
(10, 'New On-Site Security Team', 'Ensuring your safety is our top priority. We are pleased to introduce our new on-site security team, dedicated to maintaining a secure environment for all residents. Welcome them warmly!', 'announcement', '2024-06-28'),
(11, 'Community Movie Night', 'Bring your blankets and popcorn! Our community movie night is back by popular demand. Join us this Friday for a screening of the latest blockbuster under the stars.', 'event', '2024-07-01'),
(12, 'Art Exhibition in the Lobby', 'We are thrilled to showcase local artists in our lobby! Admire stunning artworks from talented creators in our community. The exhibition will be open to all residents starting next Monday.', 'announcement', '2024-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rooms` int(11) NOT NULL,
  `total_area` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `launch_date` date NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `rooms`, `total_area`, `price`, `category`, `launch_date`, `description`, `image_url`) VALUES
(1, 'Marga Luxury Suite', 3, 150.50, 300.00, 'Modern House', '2022-05-15', 'Beautiful apartement with sunset view', 'img_1.jpg'),
(2, 'JCC Apartement', 2, 150.50, 200.00, 'Modern House', '2022-05-15', 'Beautiful apartment with morning view', 'hero_bg_2.jpg'),
(3, 'City Center Apartment', 2, 100.00, 150.00, 'Urban Apartment', '2023-01-10', 'Conveniently located in the city center', 'img_3.jpg'),
(4, 'Central Park Residence', 2, 100.00, 200.00, 'Urban Apartment', '2023-08-20', 'Luxury apartment complex in the heart of the city', 'img_4.jpg'),
(5, 'Sunrise Towers', 3, 120.50, 100.00, 'Luxury Apartment', '2023-09-10', 'Spectacular views from every angle', 'img_2.jpg'),
(6, 'Golden Gardens', 2, 95.00, 200.00, 'Modern Condo', '2023-10-05', 'Contemporary living at its finest', 'img_3.jpg'),
(7, 'Riverside Plaza', 1, 80.00, 170.00, 'Riverside Apartment', '2023-11-15', 'Tranquil living by the riverbank', 'img_1.jpg'),
(8, 'Pine Ridge Estates', 4, 200.00, 100.00, 'Luxury Villa', '2024-01-20', 'Exclusive gated community with lavish amenities', 'hero_bg_1.jpg'),
(9, 'Ocean View Apartments', 2, 110.00, 124.00, 'Beachfront Apartment', '2024-02-25', 'Breathtaking ocean views from every window', 'hero_bg_2.jpg'),
(10, 'Skyline Heights', 3, 130.00, 200.00, 'Penthouse Apartment', '2024-03-30', 'Living in the clouds with panoramic city views', 'img_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `upload_date` date NOT NULL,
  `type` enum('image','video') NOT NULL DEFAULT 'image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `property_id`, `image_url`, `video_url`, `description`, `upload_date`, `type`) VALUES
(1, 1, 'img_1.jpg', '', 'Main view of the luxury suite', '2022-05-16', 'image'),
(2, 2, 'hero_bg_2.jpg', '', 'Main view of the city center apartment', '2023-01-11', 'image'),
(3, 4, 'img_1.jpg', '', 'Swimming pool area', '2023-08-21', 'image'),
(4, 4, 'img_4.jpg', '', 'Lobby and reception', '2023-08-21', 'image'),
(5, 5, 'hero_bg_4.jpg', '', 'Living room with panoramic windows', '2023-09-11', 'image'),
(6, 5, 'hero_bg_1.jpg', '', 'Master bedroom with ensuite bathroom', '2023-09-11', 'image'),
(7, 6, 'img_1.jpg', '', 'Modern kitchen with high-end appliances', '2023-10-06', 'image'),
(8, 6, 'img_2.jpg', '', 'Spacious balcony overlooking the city skyline', '2023-10-06', 'image'),
(9, 7, 'img_4.jpg', '', 'Scenic view of the river from the apartment', '2023-11-16', 'image'),
(10, 7, 'hero_bg_4.jpg', '', 'Fitness center and gym facilities', '2023-11-16', 'image');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `check_in` date NOT NULL,
  `nights` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `property_id`, `customer_id`, `check_in`, `nights`, `total_price`) VALUES
(1, 1, 1, '2024-06-01', 5, 750.00),
(2, 2, 2, '2024-06-02', 3, 450.00),
(3, 1, 3, '2024-06-03', 4, 600.00),
(4, 2, 4, '2024-06-04', 2, 300.00),
(5, 3, 5, '2024-06-05', 3, 450.00),
(6, 4, 6, '2024-06-06', 5, 750.00),
(7, 5, 7, '2024-06-07', 7, 1050.00),
(8, 6, 8, '2024-06-08', 1, 150.00),
(9, 7, 1, '2024-06-09', 6, 900.00),
(10, 1, 2, '2024-06-10', 2, 300.00),
(11, 3, 15, '2024-06-15', 8, 1200.00),
(12, 6, 16, '2024-06-13', 2, 400.00),
(13, 6, 17, '2024-06-13', 3, 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `property_id`, `customer_id`, `rating`, `comment`, `review_date`) VALUES
(1, 1, 1, 5, 'Amazing experience, highly recommend!', '2024-06-05'),
(2, 2, 2, 4, 'Great location, very convenient.', '2024-06-06'),
(3, 1, 3, 4, 'Great apartment, clean and spacious.', '2024-06-03'),
(4, 2, 4, 5, 'Wonderful location, amazing view.', '2024-06-04'),
(5, 3, 5, 4, 'Comfortable stay, friendly staff.', '2024-06-05'),
(6, 4, 6, 3, 'Decent place, but could use some improvements.', '2024-06-06'),
(7, 5, 7, 5, 'Excellent facilities, highly recommended.', '2024-06-07'),
(8, 6, 8, 4, 'Good value for money, enjoyed my stay.', '2024-06-08'),
(9, 7, 1, 5, 'Perfect apartment, everything was just as described.', '2024-06-09'),
(10, 1, 2, 3, 'Average experience, nothing special.', '2024-06-10'),
(11, 2, 3, 4, 'Nice apartment, would visit again.', '2024-06-11'),
(12, 3, 4, 5, 'Outstanding service, loved every bit of it.', '2024-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `level`, `foto`) VALUES
(1, 'Septi Ariena', 'septi3@gmail.com', 'septi', 'd58d8a16aa666d48fbcc30bd3217fb17', 'Superadmin', 'person_2.jpg'),
(2, 'Nasya Avinda', 'syaavi@gmail.com', 'nana', '05570dabb0eb05cf1d4f2fc582ad0ca8', 'Superadmin', ''),
(3, 'Yuki Uenada', 'admin@example.com', 'yuki', '8b72529ec356bfa60828b4da6c2cc610', 'Admin', ''),
(4, 'nadia', 'nalya@gmail.com', 'nadia', 'a2e8cea3392da09d1d31be3fca68efed', 'Superadmin', '20240126_154301_0000.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
