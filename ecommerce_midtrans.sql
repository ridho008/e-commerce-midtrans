-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table e-commerce-midtrans.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e-commerce-midtrans.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table e-commerce-midtrans.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e-commerce-midtrans.migrations: ~7 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(27, '2024_03_07_050513_create_products_table', 1),
	(40, '2014_10_12_000000_create_users_table', 2),
	(41, '2014_10_12_100000_create_password_reset_tokens_table', 2),
	(42, '2019_08_19_000000_create_failed_jobs_table', 2),
	(43, '2019_12_14_000001_create_personal_access_tokens_table', 2),
	(44, '2024_03_07_050603_create_products_table', 2),
	(45, '2024_03_07_074939_create_orders_table', 2);

-- Dumping structure for table e-commerce-midtrans.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=waiting for payment, 2=already paid, 3=expired, 4=cancelled',
  `snap_token` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e-commerce-midtrans.orders: ~2 rows (approximately)
INSERT INTO `orders` (`id`, `fullname`, `total_price`, `payment_status`, `snap_token`, `created_at`, `updated_at`) VALUES
	(1, 'Haji Mane', 500000.00, '1', NULL, '2024-03-11 07:43:47', '2024-03-11 07:43:47'),
	(2, 'iuejhjh', 500000.00, '1', NULL, '2024-03-11 07:47:42', '2024-03-11 07:47:42'),
	(3, 'iuejhjh', 500000.00, '1', NULL, '2024-03-11 07:55:38', '2024-03-11 07:55:38'),
	(4, 'iuejhjh', 500000.00, '1', NULL, '2024-03-11 08:01:14', '2024-03-11 08:01:14'),
	(5, 'iuejhjh', 500000.00, '1', NULL, '2024-03-11 08:01:59', '2024-03-11 08:01:59'),
	(6, 'iuejhjh', 500000.00, '1', NULL, '2024-03-11 08:03:03', '2024-03-11 08:03:03'),
	(7, 'Wahyudi', 700000.00, '1', NULL, '2024-03-11 09:46:03', '2024-03-11 09:46:03');

-- Dumping structure for table e-commerce-midtrans.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e-commerce-midtrans.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table e-commerce-midtrans.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e-commerce-midtrans.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table e-commerce-midtrans.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e-commerce-midtrans.products: ~3 rows (approximately)
INSERT INTO `products` (`id`, `name`, `description`, `qty`, `price`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Jas Hitam', 'Kiersten White', 100, 300000.00, 'https://source.unsplash.com/random/featured/?sewing', '2024-03-11 07:30:47', '2024-03-11 07:30:47'),
	(2, 'Slayer Wesing', 'Kiersten White', 100, 100000.00, 'https://source.unsplash.com/random/featured/?sewing', '2024-03-11 07:30:47', '2024-03-11 07:30:47'),
	(3, 'Kemeja Hitam', 'Kiersten White', 100, 200000.00, 'https://source.unsplash.com/random/featured/?sewing', '2024-03-11 07:30:47', '2024-03-11 07:30:47');

-- Dumping structure for table e-commerce-midtrans.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table e-commerce-midtrans.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
