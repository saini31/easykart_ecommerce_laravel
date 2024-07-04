-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 02:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(96, 1, 43, '1', 33, '2024-05-11 02:58:18', '2024-05-11 02:58:18'),
(102, 1, 54, '1', 111, '2024-05-14 04:09:42', '2024-05-14 04:09:42'),
(111, 20, 53, '1', 111, '2024-05-15 02:38:52', '2024-05-15 02:38:52'),
(114, 20, 58, '1', 123, '2024-05-15 23:31:48', '2024-05-15 23:31:48'),
(115, 20, 56, '4', 9284, '2024-05-15 23:32:26', '2024-05-15 23:32:26'),
(120, 21, 57, '5', 6155, '2024-05-18 02:13:23', '2024-05-18 02:25:22'),
(121, 21, 58, '1', 123, '2024-05-18 02:15:50', '2024-05-18 02:15:50'),
(123, 21, 42, '1', 33, '2024-05-18 04:35:12', '2024-05-18 04:35:12'),
(127, 17, 58, '1', 123, '2024-05-21 23:19:28', '2024-05-21 23:19:28'),
(128, 17, 43, '1', 33, '2024-05-22 02:19:38', '2024-05-22 02:19:38'),
(129, 17, 56, '1', 2321, '2024-05-22 02:19:46', '2024-05-22 02:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Electronics', '1', '2024-04-25 00:14:10', '2024-04-25 00:14:10'),
(18, NULL, 'Apparel &Accessories', '1', '2024-05-11 01:08:48', '2024-05-11 01:08:48'),
(20, NULL, 'Home&Kitchen', '1', '2024-05-11 01:09:43', '2024-05-11 01:09:43'),
(21, NULL, 'Health & Beauty', '1', '2024-05-11 01:10:01', '2024-05-11 01:10:01'),
(22, NULL, 'Sports & Outdoors', '1', '2024-05-11 01:10:13', '2024-05-11 01:10:13'),
(23, NULL, 'Toys & Games', '1', '2024-05-11 01:10:24', '2024-05-11 01:10:24'),
(24, 1, 'Smartphones & Accessories', '1', '2024-05-11 01:13:05', '2024-05-11 01:13:05'),
(25, 1, 'TVs & Home Theater', '1', '2024-05-11 01:13:23', '2024-05-11 01:13:23'),
(26, 1, 'Audio & Headphones', '1', '2024-05-11 01:14:19', '2024-05-11 01:14:19'),
(27, 18, 'Men\'s Clothing', '1', '2024-05-11 01:14:56', '2024-05-11 01:14:56'),
(28, 18, 'Women\'s Clothing', '1', '2024-05-11 01:15:20', '2024-05-11 01:15:20'),
(31, 21, 'Skincare', '1', '2024-05-11 01:16:13', '2024-05-11 01:16:13'),
(32, 21, 'Makeup', '1', '2024-05-11 01:16:36', '2024-05-11 01:16:36'),
(33, 22, 'Exercise & Fitness', '1', '2024-05-11 01:16:56', '2024-05-11 01:16:56'),
(34, 22, 'Outdoor Recreation', '1', '2024-05-11 01:17:12', '2024-05-11 01:17:12'),
(35, 23, 'Action Figures & Collectibles', '1', '2024-05-11 01:17:32', '2024-05-11 01:17:32'),
(36, 23, 'Board Games & Puzzles', '1', '2024-05-11 01:17:47', '2024-05-11 01:17:47'),
(37, 23, 'Outdoor Play', '1', '2024-05-11 01:18:02', '2024-05-11 01:18:02'),
(38, 20, 'Kitchen Appliances', '1', '2024-05-15 23:03:30', '2024-05-15 23:03:30'),
(39, 20, 'Kitchen Tools and Gadgets', '1', '2024-05-15 23:03:52', '2024-05-15 23:03:52'),
(40, 20, 'Home Décor and Accessories', '1', '2024-05-15 23:04:16', '2024-05-15 23:04:16'),
(41, 20, 'Cookware and Bakeware', '1', '2024-05-15 23:04:37', '2024-05-15 23:04:37'),
(42, NULL, 'Pet Supplies', '1', '2024-05-15 23:26:10', '2024-05-15 23:26:10'),
(43, 42, 'Fish Tanks', '1', '2024-05-15 23:27:20', '2024-05-15 23:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_04_24_113039_create_categories_table', 2),
(7, '2024_04_24_1130039_create_categories_table', 3),
(8, '2024_04_27_071324_create_products_table', 4),
(9, '2024_04_30_062204_create_product_details_table', 5),
(10, '2024_05_01_130457_create_carts_table', 6),
(11, '2024_05_02_072211_create_product_bookings_table', 7),
(12, '2024_05_03_094550_create_product_feedback_table', 8),
(13, '2024_05_07_063030_create_payments_table', 9),
(14, '2024_05_09_075622_create_orders_table', 10),
(15, '2024_05_10_063555_create_payments_table', 11),
(16, '2024_05_16_054958_create_shipping_information_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `razorpay_payment_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `shipping_id` varchar(544) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `product_id`, `payment_id`, `price`, `order_id`, `shipping_id`, `created_at`, `updated_at`) VALUES
(1, 17, 87, 'pay_O8hQQE3VE9jLeH', 0, 'pay_O8hQQE3VE9jLeH', '', '2024-05-10 01:25:41', '2024-05-10 01:25:41'),
(13, 17, 84, 'pay_O94a05BvLgBRg7', 4, 'ORDER_0VUCQ0QY', '', '2024-05-11 00:04:43', '2024-05-11 00:04:43'),
(16, 20, 92, 'pay_O95GNPonPUZIcr', 44, 'ORDER_01OLOJB7', '', '2024-05-11 00:44:49', '2024-05-11 00:44:49'),
(17, 20, 90, 'pay_O95H5HhCr9anY2', 4, 'ORDER_XHWHBBZR', '', '2024-05-11 00:45:29', '2024-05-11 00:45:29'),
(20, 17, 100, 'pay_O9xIgk8Ah9eC7q', 66, 'ORDER_EFGXKXZZ', '', '2024-05-13 05:36:30', '2024-05-13 05:36:30'),
(21, 1, 96, 'pay_OAKKs1hZCp8cby', 33, 'ORDER_RG0CQL4N', '', '2024-05-14 04:08:40', '2024-05-14 04:08:40'),
(26, 17, 0, 'pay_OBT42khxHUeNbU', 333, 'ORDER_T2FSRMGI', NULL, '2024-05-17 01:19:47', '2024-05-17 01:19:47'),
(33, 17, 42, 'pay_OBsCYc0byrxb0n', 66, 'ORDER_DZ2LT3VD', NULL, '2024-05-18 01:55:11', '2024-05-18 01:55:11'),
(34, 21, 57, 'pay_OBsk6hWPASKHzo', 6155, 'ORDER_NJTPYFGY', NULL, '2024-05-18 02:26:55', '2024-05-18 02:26:55'),
(35, 17, 42, 'pay_OD4z7fsBwyB1br', 66, 'ORDER_B5WZXHWI', NULL, '2024-05-21 03:04:28', '2024-05-21 03:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(41, 36, 'Kids\' Books', '33', '110520241715415619.jpg', '1', '2024-05-11 01:19:24', '2024-05-11 02:50:19'),
(42, 37, 'Trampolines', '33', '110520241715415643.jpg', '1', '2024-05-11 01:20:25', '2024-05-11 02:50:43'),
(43, 36, 'Card Games', '33', '110520241715415668.jpg', '1', '2024-05-11 01:21:17', '2024-05-11 02:51:08'),
(44, 33, 'Yoga & Pilates', '111', '110520241715415693.jpg', '1', '2024-05-11 02:08:05', '2024-05-11 02:51:33'),
(45, 32, 'Foundation & Concealers', '111', '110520241715415720.jpg', '1', '2024-05-11 02:09:11', '2024-05-11 02:52:00'),
(46, 32, 'Eyeshadow Palettes', '111', '110520241715415742.jpg', '1', '2024-05-11 02:09:46', '2024-05-11 02:52:22'),
(47, 31, 'Facial Cleansers', '111', '110520241715415807.jpg', '1', '2024-05-11 02:10:28', '2024-05-11 02:53:27'),
(52, 27, 'T-Shirts & Polos', '111', '110520241715415897.jpg', '1', '2024-05-11 02:15:00', '2024-05-11 02:54:57'),
(53, 25, 'LED & LCD TVs', '111', '110520241715415958.png', '1', '2024-05-11 02:15:40', '2024-05-11 02:55:58'),
(54, 28, 'Dresses & Skirts', '111', '110520241715415980.jpg', '1', '2024-05-11 02:16:20', '2024-05-11 02:56:20'),
(55, 24, 'Xiaomi Pad 5', '1111', '150520241715761988.tmp', '1', '2024-05-15 02:58:35', '2024-05-15 03:03:08'),
(56, 38, 'Digital Air Fryer', '2321', '160520241715834307.webp', '1', '2024-05-15 23:08:27', '2024-05-15 23:08:27'),
(57, 38, 'Oven Toaster', '1231', '160520241715834444.webp', '1', '2024-05-15 23:10:44', '2024-05-15 23:10:44'),
(58, 43, 'LED Aquarium', '123', '160520241715835624.webp', '1', '2024-05-15 23:30:24', '2024-05-15 23:30:24'),
(59, 27, 'jeans', '100', '180520241716020220.webp', '1', '2024-05-18 02:47:00', '2024-05-18 02:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_bookings`
--

CREATE TABLE `product_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `total_items` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `title`, `total_items`, `description`, `created_at`, `updated_at`) VALUES
(10, 41, 'this is laptop', '11', 'aaaaaaaaaasdfghj', '2024-05-11 02:20:47', '2024-05-11 02:20:47'),
(11, 42, 'qwewe', '12', 'asdfghujikl', '2024-05-11 02:21:04', '2024-05-11 02:21:04'),
(12, 43, 'qwert', '1111', 'qwertyuiertyuiop', '2024-05-11 02:21:22', '2024-05-11 02:21:22'),
(13, 44, 'qwerty', '111', 'qwertyuiop[[]\\', '2024-05-11 02:21:46', '2024-05-11 02:21:46'),
(14, 45, 'qwerty', '111', 'sdfghyujio;;', '2024-05-11 02:22:03', '2024-05-11 02:22:03'),
(15, 46, 'qwerty', '111', 'asdfghjkl', '2024-05-11 02:22:19', '2024-05-11 02:22:19'),
(16, 47, 'qwerty', '111', 'asdfghjkl;', '2024-05-11 02:22:33', '2024-05-11 02:22:33'),
(19, 54, 'qwerty', '111', 'qwertyuiop', '2024-05-11 02:23:51', '2024-05-11 02:23:51'),
(20, 53, 'this is laptop', '11', 'ehg8dy3iohfbkjh4giojoi4jopfij45tgdifrtohyg45ojyeuio;t3got3r6h8n2dtio;h2 uo gtlfgbgofn 2tk 2g3i4fth9pu ui gby5 5fuykdyg2kuy5t2o34h5li5i2g 5ui1f', '2024-05-11 02:24:14', '2024-05-11 02:24:14'),
(21, 52, 'qwerty', '11', '3r5h9jr0f52ob9rn86 \'no3fgjo9;p6 2y6p;n6fy2oy6fo2yi5u34tb r3wo y5bku3tb5u 4li', '2024-05-11 02:24:38', '2024-05-11 02:24:38'),
(23, 55, 'Case for Xiaomi Pad 5 Pad 5 Pro 11inch BT Wireless Keyboard Cover With Russian Spanish English Korean Arabic Keyboard', '222', 'Dual SIM Card, Qwerty Keyboard, Waterproof, Quick Charge, Shockproof, Gaming, Beauty Camera, NFC, fingerprint, Gesture control, WIRELESS CHARGE, SDK available\r\nOther attributes\r\nOperation System	Android 11\r\nQuick charge	NA\r\nBattery Capacity	6000-6999mAh\r\nMobile phone type	Gaming phone\r\nPrivate Mold	Yes\r\nProcessor Brand	MTK 65XX series\r\nFront Camera	16.0MP\r\nRear Camera	32MP\r\nDisplay Type	AMOLED\r\nModel Number	S22 ULTRA\r\nDisplay refresh rate	120Hz\r\nProduct Name	S22 ULTRA PHONE\r\nScreen Size	6.7 Inch\r\nOS System	Andriod 11.0\r\nRAM/ROM	16GB+512GB\r\nBattery Capacity	6800 MAh Lithium Battery\r\nColors	Blue/Black/Gold\r\nLanguage	Multi-language Support\r\nResolution	1440x3040 Pixels\r\nSIM Card	Dual SIM Card Dual Standby\r\nPackaging and delivery\r\nSelling Units:	Single item\r\nSingle package size:	17X8X1 cm\r\nSingle gross weight:	0.800 kg\r\nShow more', '2024-05-15 03:00:05', '2024-05-15 03:00:05'),
(24, 56, 'Pigeon Healthifry Digital Air Fryer, 360° High Speed Air Circulation Technology 1200 W with Non-Stick 4.2 L Basket - Green', '121', 'Bring your family together with the Pigeon HealthiFRY Digital Airfryer, the ultimate solution for healthier, faster, and more convenient cooking, creating delicious memories and fostering a love for wholesome cooking among all family members – enjoy guilt free healthy snacks!\r\n8 PRESET MENUS: Take the guesswork out of cooking with 8 pre-set menus - French Fries, Paneer Tikka, Samosa, Vegetable Roast, Pizza, Cutlets/Nuggets, Cakes, and Chips.\r\n360° HIGH-SPEED AIR CIRCULATION: Enjoy perfectly crispy and evenly cooked delicious snacks, thanks to the advanced 360° high-speed air circulation technology. USES 95% LESS OIL: Enjoy guilt-free indulgence with up to 95% less oil than traditional cooking methods\r\nDIGITAL DISPLAY: Easily select modes / menus and monitor cooking times and temperatures.\r\nDELAY START FUNCTION: Plan your meals ahead of time - Simply set the timer and let the HealthiFRY work its magic while you attend to other tasks.\r\nDEFROST FUNCTION: Quickly and safely thaws frozen foods, so you can cook without delay.\r\nPOWERFUL 1200W MOTOR: Rapid heating and consistent air throw performance, so you can whip up delicious meals in no time.', '2024-05-15 23:09:27', '2024-05-15 23:09:27'),
(25, 57, 'AGARO Marvel 9 Liters Oven Toaster Griller,Cake Baking Otg (Black),800 Watts', '121', 'Bake, Grill, Toast and more\r\n1 Year Manufacturer\'s Warranty\r\nAutomatic Thermostat I Auto Shut Off I Ready Bell. Cavity Material: Stainless Steel\r\nHeat resistant tempered glass window with Cool Touch Handle\r\nAdjustable temperature from 100°C to 250°C', '2024-05-15 23:11:39', '2024-05-15 23:11:39'),
(26, 58, 'VAYINATO Petzlifeworld (M-180 | Blue & White) Super Slim LED Aquarium Light (Suits Upto 2 Feet Tank) Plants Grow Lighting Creative Clip-on Lamp (Black)', '121', 'Brand	VAYINATO\r\nColour	BLUE, WHITE\r\nProduct Dimensions	8D x 12W x 10H Centimeters\r\nLight Source Type	LED\r\nFinish Type	Polished\r\nMaterial	Plastic\r\nLamp Type	Mood Light\r\nShade Material	Acrylonitrile Butadiene Styrene\r\nBase Material	Acrylonitrile Butadiene Styrene\r\nPower Source	Corded Electric\r\n\r\n💎DURABLE & ENERGY SAVING : Aquarium clip light made of ABS, It\'s durable and saves powers. Super bright, 40% energy-saving than ordinary LED lights, the energy efficient and long lasting LED produce amazing shimmer to your aquarium.\r\n✨SPECIAL DESIGN : This light is specially designed for fish tank, which can light up your fish tank and bring brightness for fish. Help plants to thrive and light up for fishes anytime you want.\r\n💎EASY TO INSTALLED : Clip on the fish tank wall and will be stable on it. Very easy and convenient. Help plants to thrive and light up for fishes anytime you want.\r\n✨COLOURFUL LED LIGHTS : The LED light can transform your aquarium into a colourful landscape and is often used in aquariums, cisterns, rockeries, animal cages and more. With the bright LED light bar, your aquarium looks like part of the ocean and your fish and reptiles can see where they swim or move.', '2024-05-15 23:31:23', '2024-05-15 23:37:54'),
(27, 59, 'Ben Martin', '112', 'STRETCH COMFORT : These Ben Martin cotton denim casual jeans pant for men are constructed from a perfect blend of stretch-cotton fabric, which maximizes freedom of movement and ensures comfortable wear all day long.\r\nFASHION TREND DESIGN : This Ben Martin mens stylish stretchable jeans pant for men is versatile and can be paired with various tops. Like Shirt, Tshirt, Tees, Polo, Sweatshirts, Jackets, Waistcoat even Blazzers.\r\nDENIM MATERIAL: This Ben Martin casual denim jeans pant for men Durable and classic denim fabric for a timeless look.\r\nAVAILABLE SIZE & COLOUR: This Ben Martin Mens Cotton Denim Jeans comes Range of sizes & Colors to suit different body types. 28 to 40. Dark Blue, Light Blue, Brown, Green, Grey, Black & White\r\nFEATURE: This Ben Martin Denim Jeans pant for Men is light weight breathable soft denim fabric. 1) Comfortable for all-day wear. 2) Casual and laid-back style. 3) 5 Basic Coin pockets for added functionality. 4) vailable in different washes and finishes.\r\nAdditional Information\r\nManufacturerMaruti Enterprises, SRS-167, National Market, Peeragarhi,New Delhi 9810-118100, For Any Query Please Contact us :- mybenmartincare@gmail.com\r\nPackerMaruti Enterprises SRS-167, National Market, Peeragarhi,New Delhi 9810-118100, For Any Query Please Contact us :- mybenmartincare@gmail.com\r\nItem Weight270 g\r\nItem Dimensions LxWxH18 x 25 x 3 Centimeters\r\nNet Quantity1.00 count\r\nGeneric Name', '2024-05-18 02:47:55', '2024-05-18 02:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_feedback`
--

CREATE TABLE `product_feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `likes` tinyint(1) NOT NULL DEFAULT 0,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_information`
--

CREATE TABLE `shipping_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(256) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, 'admin', '$2y$10$XKp.lwIlMCdDk3zxM/HsI.FbdlHhSmpqHCVDIbBK1AtzRQKIu/72y', NULL, NULL, NULL),
(4, 'qqqq wwww', 'q@gmail.com', NULL, 'user', '$2y$10$AmHAHgObM.UEPIKUvvhbD.n8B7L6Ulyi/MJoV4wZpAdW1NfbsPq6e', NULL, '2024-05-01 00:03:11', '2024-05-01 00:03:11'),
(5, 'Mahesh Saini', 'm@gmail.com', NULL, 'user', '$2y$10$qTCe8UTAHPoR8A3mbmXy9.WsOl7/QBRpZAbT5GX.kBICIP0n12JOe', NULL, '2024-05-01 00:29:35', '2024-05-01 00:29:35'),
(7, 'ss wwww', 's@gmail.com', NULL, 'user', '$2y$10$K85PZNNlr8PuymeKGaYz8.yCBXtDKoSZITVHpawCyZ76.qOwYkJwO', NULL, '2024-05-01 00:33:35', '2024-05-01 00:33:35'),
(10, 'prakhar suman', 'l@gmail.com', NULL, 'user', '$2y$10$7.UPA2YvgjJTCgvRDG8cAeYSCckXMkv/uMJZSWPtxPAF/RIBD1bfa', NULL, '2024-05-01 00:58:37', '2024-05-01 00:58:37'),
(11, 'cc cc', 'c@gmail.com', NULL, 'user', '$2y$10$c/tVesLCxoNeIfTCrUmmXOgYGs4hKHoSjuzvGiZETOsKX/g1qKwcC', NULL, '2024-05-01 01:11:10', '2024-05-01 01:11:10'),
(12, 'Mahesh Saini', 'mahesh@gmail.com', NULL, 'user', '$2y$10$5soi7d30MjKZrwzl4uEguOLXUDUr5DwKyPbYoCGRHYGAafg7m9zqe', NULL, '2024-05-01 01:22:51', '2024-05-01 01:22:51'),
(13, 'nnn aa', 'n@gmail.com', NULL, 'user', '$2y$10$8u91n3f1ktByjCO4HbhJmOuGaanKrGA964iYjkTjnGTRI0MB1jk2e', NULL, '2024-05-01 02:04:05', '2024-05-01 02:04:05'),
(17, 'kk kk', 'kk@gmail.com', NULL, 'user', '$2y$10$.WNUOsWS.wIX9TOkwXoySeWC3rtFXXnjmRMo/ubaR97enuUv2GlTa', NULL, '2024-05-01 23:50:06', '2024-05-01 23:50:06'),
(18, 'mhh mhh', 'mh@gmail.com', NULL, 'user', '$2y$10$faxLNOQ8kkPlMHRLN5Kgve2Vq/nrbvW4Sq/ffVMTVVu8t9v2JWQOe', NULL, '2024-05-03 22:56:41', '2024-05-03 22:56:41'),
(20, 'mahesh saini', 'ajay@gmail.com', NULL, 'user', '$2y$10$gOYaT0iHZMozOjpfO7wyJueZldb6V7kaAQQ36DDN8d1L2WGZqWCLm', NULL, '2024-05-10 04:47:23', '2024-05-10 04:47:23'),
(21, 'harsh saini', 'harsh@gmail.com', NULL, 'user', '$2y$10$K3UC3Qp.FJhKw2Y1HuCt.ewFfbcziJbT0AuSXlcIP2Z4bIH/UXKO2', NULL, '2024-05-18 02:13:00', '2024-05-18 02:13:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_id_unique` (`order_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_bookings`
--
ALTER TABLE `product_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_bookings_user_id_foreign` (`user_id`),
  ADD KEY `product_bookings_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_feedback`
--
ALTER TABLE `product_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_feedback_user_id_foreign` (`user_id`),
  ADD KEY `product_feedback_product_id_foreign` (`product_id`);

--
-- Indexes for table `shipping_information`
--
ALTER TABLE `shipping_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_information_order_id_foreign` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `product_bookings`
--
ALTER TABLE `product_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_feedback`
--
ALTER TABLE `product_feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_information`
--
ALTER TABLE `shipping_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_bookings`
--
ALTER TABLE `product_bookings`
  ADD CONSTRAINT `product_bookings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_feedback`
--
ALTER TABLE `product_feedback`
  ADD CONSTRAINT `product_feedback_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipping_information`
--
ALTER TABLE `shipping_information`
  ADD CONSTRAINT `shipping_information_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
