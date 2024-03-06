-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 07:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farm_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(5) NOT NULL,
  `a_name` varchar(255) NOT NULL,
  `a_pass` varchar(255) NOT NULL,
  `a_mail` varchar(255) NOT NULL,
  `a_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_pass`, `a_mail`, `a_image`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'luffy.jpg'),
(2, 'Zoro', 'c4ca4238a0b923820dcc509a6f75849b', 'zoro@gmail.com', 'zoro.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `b_id` int(5) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `b_mail` varchar(255) NOT NULL,
  `b_address` varchar(255) NOT NULL,
  `b_phone` varchar(10) NOT NULL,
  `b_pass` varchar(255) NOT NULL,
  `b_pin` int(6) NOT NULL,
  `b_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`b_id`, `b_name`, `b_mail`, `b_address`, `b_phone`, `b_pass`, `b_pin`, `b_status`) VALUES
(1, 'buyer', 'buyer@gmail.com', 'E-15 Goa', '9545615461', '794aad24cbd58461011ed9094b7fa212', 684585, 1),
(3, 'thorfin', 'thorfin@gmail.com', 'iceland', '6955285662', '8607e2c482bb05fe95fa9fb6a69f5c41', 641515, 0),
(4, 'miyamura', 'miya@gmail.com', 'Katagiri', '9654116257', '473d405186d17e24e92e9da06b840e4c', 644146, 0),
(6, 's', 'shibu@gmail.com', 's', '9551545454', '3691308f2a4c2f6983f2880d32e29c84', 666666, 2),
(9, 'buyer2', 'bubu@gmail.com', 'A', '9447927108', 'c4ca4238a0b923820dcc509a6f75849b', 222222, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `b_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(5) NOT NULL,
  `c_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(1, 'Fruits'),
(2, 'Vegetables'),
(3, 'Dairy'),
(4, 'Meat'),
(5, 'Poultry'),
(6, 'Grains'),
(7, 'Herbs and Spices'),
(8, 'Organic Products'),
(9, 'Nuts'),
(10, 'Beverages'),
(11, 'Flowers'),
(12, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `f_id` int(5) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_mail` varchar(255) NOT NULL,
  `f_address` varchar(255) NOT NULL,
  `f_pass` varchar(255) NOT NULL,
  `f_phone` varchar(10) NOT NULL,
  `f_pin` int(255) NOT NULL,
  `f_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`f_id`, `f_name`, `f_mail`, `f_address`, `f_pass`, `f_phone`, `f_pin`, `f_status`) VALUES
(1, 'farmer', 'farmer@gmail.com', 'All blue Grand line', '97f974881b3726d9a77014b5f3b4d795', '9448762565', 683906, 1),
(3, 'naruto', 'naruto@gmail.com', 'Hidden Leaf Village', 'cf9ee5bcb36b4936dd7064ee9b2f139e', '8921551656', 685156, 0),
(4, 'sauske', 'sauske@gmail.com', 'Hidden Leaf Village', 'c2c7ea8ffc3a90452c480ac5def54518', '6866546661', 682994, 2),
(5, 'shanks', 'shanks@gmail.com', 'Grand Line', '7341b5e7c789c1cb68870d50075f3294', '9282682488', 918448, 1),
(6, 'Eren', 'eren@gmail.com', 'Shiganshina', 'a209541310cac0ba0f9d419d51061198', '9895991162', 658451, 0),
(11, 'linsha1', 'shibu@gmail.com', 'q', 'c4ca4238a0b923820dcc509a6f75849b', '6666666666', 683902, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `b_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `f_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `c_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `b_id`, `p_id`, `quantity`, `f_id`, `status`, `c_date`) VALUES
(21, 1, 25, 1, 1, 1, '2023-11-16'),
(22, 1, 25, 1, 1, 1, '2023-11-16'),
(23, 1, 30, 1, 1, 1, '2023-11-16'),
(24, 1, 25, 1, 1, 1, '2023-11-16'),
(25, 1, 25, 1, 1, 1, '2023-11-16'),
(26, 1, 26, 1, 1, 1, '2023-11-16'),
(27, 1, 26, 1, 1, 1, '2023-11-16'),
(29, 1, 30, 2, 1, 1, '2023-11-16'),
(30, 1, 25, 3, 1, 1, '2023-11-16'),
(31, 1, 25, 2, 1, 1, '2023-11-16'),
(32, 1, 38, 1, 1, 0, '2023-11-21'),
(33, 1, 26, 1, 1, 0, '2023-11-21'),
(34, 1, 25, 1, 1, 0, '2023-11-21'),
(35, 1, 27, 2, 1, 0, '2023-11-21'),
(36, 1, 60, 3, 5, 1, '2023-11-20'),
(37, 1, 58, 1, 5, 1, '2023-11-20'),
(38, 1, 51, 2, 5, 0, '2023-11-20'),
(39, 1, 54, 1, 5, 0, '2023-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(5) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_price` int(255) NOT NULL,
  `p_quantity` int(30) NOT NULL,
  `p_image` varchar(255) NOT NULL,
  `p_descript` varchar(255) NOT NULL,
  `c_id` int(5) NOT NULL,
  `f_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_price`, `p_quantity`, `p_image`, `p_descript`, `c_id`, `f_id`) VALUES
(1, 'Sweet Potatoes', 69, 30, 'sweet_potatoes.jpg', 'Fresh and sweet potatoes', 2, 5),
(2, 'Cauliflower', 79, 25, 'cauliflower.jpg', 'Fresh cauliflower heads', 2, 5),
(3, 'Honey', 89, 15, 'honey.jpg', 'Locally produced natural honey', 10, 5),
(4, 'Mixed Berries Jam', 99, 20, 'mixed_berries_jam.jpg', 'Homemade jam with mixed berries', 10, 5),
(5, 'Organic Garlic', 49, 40, 'organic_garlic.jpg', 'Fresh and organic garlic bulbs', 7, 5),
(6, 'Pumpkin', 59, 30, 'pumpkin.jpg', 'Fresh and ripe pumpkins', 2, 5),
(7, 'Walnuts', 129, 18, 'walnuts.jpg', 'Healthy and nutritious walnuts', 9, 5),
(8, 'Pomegranate', 129, 25, 'pomegranate.jpg', 'Juicy and flavorful pomegranates', 1, 5),
(9, 'Lemon', 29, 50, 'lemon.jpg', 'Fresh and tangy lemons', 1, 5),
(10, 'Cilantro', 39, 35, 'cilantro.jpg', 'Fresh cilantro for your dishes', 7, 5),
(11, 'Mushrooms', 79, 20, 'mushrooms.jpg', 'Fresh and earthy mushrooms', 2, 5),
(12, 'Cherries', 169, 15, 'cherries.jpg', 'Sweet and succulent cherries', 1, 5),
(13, 'Green Beans', 49, 40, 'green_beans.jpg', 'Crisp and fresh green beans', 2, 5),
(14, 'Apricots', 99, 30, 'apricots.jpg', 'Sweet and juicy apricots', 1, 5),
(15, 'Cantaloupe', 79, 25, 'cantaloupe.jpg', 'Ripe and refreshing cantaloupe', 1, 5),
(16, 'Peas', 29, 60, 'peas.jpg', 'Sweet and tender peas', 2, 5),
(17, 'Hazelnuts', 149, 18, 'hazelnuts.jpg', 'Crunchy and delicious hazelnuts', 9, 5),
(18, 'Raspberries', 119, 25, 'raspberries.jpg', 'Sweet and vibrant raspberries', 1, 5),
(19, 'Artichokes', 79, 20, 'artichokes.jpg', 'Fresh and flavorful artichokes', 2, 5),
(20, 'Blackberries', 129, 22, 'blackberries.jpg', 'Plump and juicy blackberries', 1, 5),
(21, 'Red Onions', 49, 35, 'red_onions.jpg', 'Fresh and vibrant red onions', 2, 5),
(22, 'Cranberries', 89, 18, 'cranberries.jpg', 'Tart and nutritious cranberries', 1, 5),
(23, 'Asparagus', 69, 30, 'asparagus.jpg', 'Tender and green asparagus spears', 2, 5),
(24, 'Chestnuts', 79, 25, 'chestnuts.jpg', 'Roastable chestnuts for the season', 9, 5),
(25, 'Apple', 199, 80, 'apple.jpg', 'Fresh apples from our farm', 1, 1),
(26, 'Carrot', 99, 153, '65490c2362097_carrot.jpg', 'Organic carrots with a great taste', 2, 1),
(27, 'Milk', 39, 56, 'milk.jpg', 'Fresh and creamy milk', 3, 1),
(28, 'Chicken', 299, 29, 'chicken.jpg', 'Farm-raised chicken for your dinner', 5, 1),
(29, 'Wheat', 59, 200, 'wheat.jpg', 'High-quality wheat grains', 6, 1),
(30, 'Basil', 199, 27, 'basil.jpg', 'Fresh basil leaves for cooking', 7, 1),
(31, 'Organic Tomato', 59, 80, 'tomato.jpg', 'Organic and juicy tomatoes', 8, 1),
(32, 'Almonds', 399, 30, 'almonds.jpg', 'Delicious and healthy almonds', 9, 1),
(33, 'Apple Juice', 99, 100, 'applejuice.jpg', 'Freshly squeezed apple juice', 10, 1),
(34, 'Rose', 99, 24, 'rose.jpg', 'Beautiful and fragrant roses', 11, 1),
(38, 'Cabbage', 49, 19, '654901c161c22_cabbage.jpg', 'Fresh and crisp cabbage for your recipes', 2, 1),
(40, 'Potato', 49, 35, 'potato.jpg', 'Fresh and nutritious potatoes for various culinary uses.', 2, 1),
(41, 'Spinach', 199, 60, 'spinach.jpg', 'Organic spinach leaves', 2, 5),
(42, 'Tomato', 179, 90, 'tomato.jpg', 'Ripe tomatoes for your kitchen', 2, 5),
(43, 'Cucumber', 129, 70, 'cucumber.jpg', 'Crisp and fresh cucumbers', 2, 5),
(44, 'Broccoli', 199, 50, 'broccoli.jpg', 'Fresh broccoli from our farm', 2, 5),
(45, 'Zucchini', 169, 55, 'zucchini.jpg', 'Versatile zucchinis for your recipes', 2, 5),
(46, 'Radish', 139, 80, 'radish.jpg', 'Colorful and crunchy radishes', 2, 5),
(47, 'Bell Pepper', 249, 45, 'bellpepper.jpg', 'Colorful bell peppers', 2, 5),
(48, 'Eggplant', 179, 60, 'eggplant.jpg', 'Fresh and purple eggplants', 2, 5),
(49, 'Lettuce', 189, 55, 'lettuce.jpg', 'Crisp and green lettuce leaves', 2, 5),
(51, 'Banana', 79, 98, 'banana.jpg', 'Sweet and ripe bananas', 1, 5),
(52, 'Orange', 99, 80, 'orange.jpg', 'Juicy and flavorful oranges', 1, 5),
(53, 'Grapes', 149, 60, 'grapes.jpg', 'Fresh and seedless grapes', 1, 5),
(54, 'Watermelon', 199, 19, 'watermelon.jpg', 'Refreshing and hydrating watermelon', 1, 5),
(55, 'Mango', 129, 40, 'mango.jpg', 'Tropical and succulent mangoes', 1, 5),
(56, 'Pineapple', 179, 30, 'pineapple.jpg', 'Sweet and tangy pineapple', 1, 5),
(57, 'Strawberry', 199, 45, 'strawberry.jpg', 'Juicy and red strawberries', 1, 5),
(58, 'Kiwi', 149, 49, 'kiwi.jpg', 'Nutrient-rich and exotic kiwi', 1, 5),
(59, 'Peach', 169, 35, 'peach.jpg', 'Soft and velvety peaches', 1, 5),
(60, 'Blueberry', 129, 52, 'blueberry.jpg', 'Antioxidant-rich blueberries', 1, 5),
(61, 'Avocado', 149, 40, '655b81eacd765_avocado.jpg', 'Creamy and nutritious avocados, perfect for salads and spreads', 1, 5),
(62, 'Kale', 159, 50, 'kale.jpg', 'Nutrient-rich kale leaves for a healthy diet', 2, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `f_id` (`f_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `b_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `f_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `buyer` (`b_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `buyer` (`b_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `c_id` FOREIGN KEY (`c_id`) REFERENCES `category` (`c_id`),
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `farmer` (`f_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
