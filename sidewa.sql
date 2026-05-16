/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.1.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: sidewa
-- ------------------------------------------------------
-- Server version	12.1.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `anggaran_desas`
--

DROP TABLE IF EXISTS `anggaran_desas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `anggaran_desas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tahun_anggaran` year(4) NOT NULL,
  `kategori` enum('pendapatan','belanja') NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggaran_desas`
--

LOCK TABLES `anggaran_desas` WRITE;
/*!40000 ALTER TABLE `anggaran_desas` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `anggaran_desas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `aparatur_desas`
--

DROP TABLE IF EXISTS `aparatur_desas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `aparatur_desas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 99,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aparatur_desas`
--

LOCK TABLES `aparatur_desas` WRITE;
/*!40000 ALTER TABLE `aparatur_desas` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `aparatur_desas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `cache` VALUES
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0','i:1;',1778727528),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer','i:1778727528;',1778727528);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `jenis_surat`
--

DROP TABLE IF EXISTS `jenis_surat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jenis_surat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_surat` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `file_template` varchar(255) DEFAULT NULL,
  `form_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`form_fields`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_surat`
--

LOCK TABLES `jenis_surat` WRITE;
/*!40000 ALTER TABLE `jenis_surat` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `jenis_surat` VALUES
(1,'Surat Keterangan Usaha','','templates/ZlfAJqhH3vJLOJ2TbRB2xfHqJRZyoAYONRmpilgw.docx','[]','2026-05-13 18:57:50','2026-05-13 18:57:50');
/*!40000 ALTER TABLE `jenis_surat` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `kegiatan`
--

DROP TABLE IF EXISTS `kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kegiatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `progres` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL,
  `foto_dokumentasi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`foto_dokumentasi`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kegiatan_user_id_foreign` (`user_id`),
  CONSTRAINT `kegiatan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kegiatan`
--

LOCK TABLES `kegiatan` WRITE;
/*!40000 ALTER TABLE `kegiatan` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `kegiatan` VALUES
(1,'Renovasi Balai Desa','Mollitia assumenda minima suscipit enim. Possimus sint sed exercitationem et fugit nobis fugiat aliquid. Doloremque ut inventore qui. Facilis voluptas eos molestiae laudantium sit.','2026-05-24','2026-07-10',100,2,NULL,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(2,'Renovasi Balai Desa','Nesciunt est hic vitae molestias doloribus itaque. Quis soluta expedita consequatur corporis quia rem reiciendis. Veritatis est eos eligendi saepe laboriosam. Dolores minus ipsam dignissimos culpa suscipit.','2026-05-23','2026-07-02',100,2,NULL,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(3,'Vaksinasi Massal','Provident et aut ab eligendi occaecati. Ullam labore et non atque quis praesentium aut.','2026-06-07','2026-07-13',100,2,NULL,'2026-05-13 18:57:29','2026-05-13 18:57:29');
/*!40000 ALTER TABLE `kegiatan` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `masyarakat`
--

DROP TABLE IF EXISTS `masyarakat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `masyarakat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `masyarakat_nik_unique` (`nik`),
  UNIQUE KEY `masyarakat_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `masyarakat`
--

LOCK TABLES `masyarakat` WRITE;
/*!40000 ALTER TABLE `masyarakat` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `masyarakat` VALUES
(1,'1234567890123456','Budi Santoso','L','2005-03-10','budi@gmail.com','Jl. Merdeka No. 10, Desa Sidoasih','081234567890','$2y$12$6VhYYMV7d1xSVjMyQXIsNOXpLgAGU4v7eeT.UNsRU0SeMPTlu3e/i',NULL,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(2,'7385685300573285','Intan Zizi Haryanti S.Pd','P','1998-03-27','judah28@example.org','Psr. Cikutra Timur No. 591, Bogor 12348, Papua','089457081390','$2y$12$/1h7DOZYmcZyxcMIRgPE3OyvsNW1E7yi4L2T48u01JbrggG7vD/Gq',NULL,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(3,'4993357678389253','Paiman Manullang','P','1966-07-19','sporer.annabell@example.com','Ds. Lembong No. 206, Bengkulu 77956, Bali','087008404180','$2y$12$/1h7DOZYmcZyxcMIRgPE3OyvsNW1E7yi4L2T48u01JbrggG7vD/Gq',NULL,'2026-05-13 18:57:29','2026-05-13 18:57:29');
/*!40000 ALTER TABLE `masyarakat` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_02_06_000001_create_masyarakats_table',1),
(5,'2026_02_06_000002_create_jenis_surats_table',1),
(6,'2026_02_06_000003_create_pengumumans_table',1),
(7,'2026_02_06_000004_create_kegiatans_table',1),
(8,'2026_02_06_000005_create_pengaduans_table',1),
(9,'2026_02_06_000006_create_pengajuan_surats_table',1),
(10,'2026_02_07_024945_add_email_to_masyarakats_table',1),
(11,'2026_03_07_124957_create_aparatur_desas_table',1),
(12,'2026_03_08_000001_create_anggaran_desas_table',1),
(13,'2026_03_08_000002_add_demografi_to_masyarakats_table',1),
(14,'2026_04_27_054012_update_admin_users_to_pelayanan',1),
(15,'2026_05_13_123331_add_file_template_to_jenis_surats_table',1),
(16,'2026_05_13_124129_add_form_fields_to_jenis_surats_table',1),
(17,'2026_05_13_124130_add_data_tambahan_to_pengajuan_surats_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `pengaduan`
--

DROP TABLE IF EXISTS `pengaduan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengaduan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `isi_pengaduan` text NOT NULL,
  `tanggal_pengaduan` date NOT NULL,
  `status` enum('pending','proses','selesai','ditolak') NOT NULL DEFAULT 'pending',
  `masyarakat_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengaduan_masyarakat_id_foreign` (`masyarakat_id`),
  KEY `pengaduan_user_id_foreign` (`user_id`),
  CONSTRAINT `pengaduan_masyarakat_id_foreign` FOREIGN KEY (`masyarakat_id`) REFERENCES `masyarakat` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengaduan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaduan`
--

LOCK TABLES `pengaduan` WRITE;
/*!40000 ALTER TABLE `pengaduan` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `pengaduan` VALUES
(1,'Jembatan penyeberangan rusak berbahaya. Rerum magni modi debitis quaerat quia qui modi. Pariatur eum eos sint blanditiis harum nostrum minima. Ducimus nemo deserunt omnis quod error aspernatur. Sit deleniti qui rerum inventore.','2026-04-28','selesai',2,2,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(2,'Sampah menumpuk di TPS tidak diangkut. Fugit quam qui omnis velit et et. Placeat debitis ad deserunt repellat iusto aut. Perspiciatis reiciendis sit sed vel aut animi ea.','2026-04-25','selesai',3,2,'2026-05-13 18:57:29','2026-05-13 18:57:29');
/*!40000 ALTER TABLE `pengaduan` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `pengajuan_surat`
--

DROP TABLE IF EXISTS `pengajuan_surat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengajuan_surat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_pengajuan` date NOT NULL,
  `status` enum('pending','diproses','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `keterangan` text DEFAULT NULL,
  `data_tambahan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_tambahan`)),
  `masyarakat_id` bigint(20) unsigned NOT NULL,
  `jenis_surat_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `verification_token` varchar(64) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengajuan_surat_verification_token_unique` (`verification_token`),
  KEY `pengajuan_surat_masyarakat_id_foreign` (`masyarakat_id`),
  KEY `pengajuan_surat_jenis_surat_id_foreign` (`jenis_surat_id`),
  KEY `pengajuan_surat_user_id_foreign` (`user_id`),
  CONSTRAINT `pengajuan_surat_jenis_surat_id_foreign` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surat` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `pengajuan_surat_masyarakat_id_foreign` FOREIGN KEY (`masyarakat_id`) REFERENCES `masyarakat` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengajuan_surat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengajuan_surat`
--

LOCK TABLES `pengajuan_surat` WRITE;
/*!40000 ALTER TABLE `pengajuan_surat` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `pengajuan_surat` VALUES
(1,'2026-05-14','disetujui','','[]',1,1,1,'h53W4o8SNiXiTxh6FUlhwGdR44Au88it','2026-05-13 18:58:02','2026-05-13 18:58:31');
/*!40000 ALTER TABLE `pengajuan_surat` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `pengumuman`
--

DROP TABLE IF EXISTS `pengumuman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengumuman` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengumuman_user_id_foreign` (`user_id`),
  CONSTRAINT `pengumuman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengumuman`
--

LOCK TABLES `pengumuman` WRITE;
/*!40000 ALTER TABLE `pengumuman` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `pengumuman` VALUES
(1,'Doloremque enim vero nobis voluptas.','Consectetur asperiores iure voluptates minus qui dolores vero. Veritatis quo reiciendis laborum dignissimos.\n\nCupiditate ut vero et voluptate. Nihil dolor possimus necessitatibus ducimus. Dolor reiciendis reprehenderit quia ducimus officia eum saepe deserunt.\n\nIllo et dolor est autem totam et. Aut non ex quam et itaque dolor aliquid. Harum praesentium dolore nemo delectus. Fuga amet laudantium quo sint.','2026-05-08',2,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(2,'Vitae laborum eveniet vitae.','Et quia necessitatibus et occaecati labore culpa. Voluptatem aut nemo eum quaerat. Sed sapiente quas autem deserunt harum aperiam mollitia. Quasi voluptatem sit cupiditate magnam sed tempora. Pariatur animi eaque expedita consequatur quaerat dicta.\n\nQuia ut tempora quisquam ipsa voluptate. Non quod neque et rerum magni nostrum in. Alias cupiditate exercitationem nesciunt molestiae rerum explicabo reiciendis.\n\nRepudiandae numquam corporis similique sit aut qui. Voluptas quo accusamus architecto nihil. Et odio tenetur expedita eligendi quibusdam recusandae dolore. Quo hic iste molestiae.','2026-05-01',2,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(3,'Nam odit consequatur vitae commodi.','Magni libero illo assumenda quidem. Aliquam aliquam vel quaerat minima enim. Illo rerum doloremque consectetur atque amet pariatur facere. Maxime dolore ut sapiente adipisci sequi. Reprehenderit ex tempora dolore quos dolor quas.\n\nConsequuntur tenetur veniam perspiciatis magni autem et. Architecto voluptatum omnis veritatis quia laboriosam perspiciatis itaque. Architecto culpa et qui rem qui aliquid.\n\nIllum veniam non autem ut maiores inventore omnis. Ullam facilis rerum incidunt maxime dicta qui. Sed odio dolorem officiis.','2026-05-08',2,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(4,'Et consectetur laudantium et id qui rerum.','Expedita voluptas aut ut consectetur harum officiis odit. Quis animi placeat ducimus quis aut voluptatibus. Magni voluptatibus aspernatur voluptatem et expedita eos. Eveniet sunt ut ex consequatur accusantium et impedit.\n\nAutem dolorem et ipsam recusandae dignissimos cumque. Quo labore reprehenderit totam tenetur molestiae harum. Voluptatum molestiae sequi et.\n\nDoloribus et libero debitis ut et qui optio. Doloribus iste dolores maxime aut minus inventore harum. Unde enim nam error ipsa eligendi.','2026-05-13',2,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(5,'Voluptatem eaque similique eum voluptatum.','Nulla iste quis ratione sit ullam doloribus. Eos est aspernatur accusantium enim sed. Eius nobis ea porro dolor necessitatibus explicabo. Iste adipisci animi temporibus.\n\nQui aliquam aut sed earum ex quidem ut. Est tempore quae aut mollitia assumenda expedita cupiditate. Ut voluptatem laudantium dignissimos est id odit. Enim vero consequatur minima. Accusantium vel aliquam sed ut officia.\n\nEa iure consequuntur soluta sed ut. Voluptate porro quia sed distinctio. Vitae beatae eum nulla beatae porro rerum. Totam tempora eos expedita. Eos laboriosam consequuntur eum totam exercitationem.','2026-04-23',2,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(6,'Qui nihil at qui.','Saepe repellat nobis quia hic rem. Possimus qui cupiditate omnis est molestias. Eveniet autem atque nobis.\n\nPerferendis aut dolorem placeat blanditiis nemo voluptatem. Tenetur perspiciatis id aperiam qui qui qui et. Aut illum ut et dolorem.\n\nDeleniti quia quisquam et non explicabo et. Est consequatur sit dolor vel possimus ut. Quo at saepe temporibus officiis.','2026-04-24',1,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(7,'Aut corrupti error beatae et.','Cupiditate ea eius dolor esse voluptatum corporis tenetur. Qui impedit similique enim et quasi. Sit error est officiis quam neque culpa omnis. Cumque reprehenderit omnis ratione error. Et incidunt dignissimos dolorem est.\n\nVoluptatibus omnis enim eligendi ex quia et omnis. Quam quo cum dignissimos voluptate ut ullam. Possimus eveniet saepe est voluptatum aut velit.\n\nVoluptas dolorem et ipsa praesentium. Tempora autem rem eveniet doloribus.','2026-04-25',1,'2026-05-13 18:57:29','2026-05-13 18:57:29'),
(8,'Labore suscipit molestiae eum.','Et excepturi qui libero autem. Labore fugiat natus rerum eum error aut.\n\nAutem est asperiores qui et qui. Blanditiis omnis rerum aut aut nam iste accusantium. Rem ut non maiores natus sit et. Ratione qui vel magnam provident quae.\n\nPerspiciatis molestiae iusto nam aut laboriosam ipsa. Provident aut tempora earum esse aliquam deserunt. Sint repellendus et ad porro praesentium dicta tempore. Doloremque quis autem voluptatem vitae.','2026-05-05',1,'2026-05-13 18:57:29','2026-05-13 18:57:29');
/*!40000 ALTER TABLE `pengumuman` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `sessions` VALUES
('G6zfO2VETmuQZS67kuhDLUHtYkCUifdzqiqDFnaJ',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSHhPNjhrbUV5d1liZjA0bGhuWVBtOHdSejF1T3Y5VHB5WDY5Q1p4ZSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ4OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbWFzeWFyYWthdC9wZW5nYWp1YW4tc3VyYXQiO3M6NToicm91dGUiO3M6MjY6Im1hc3lhcmFrYXQucGVuZ2FqdWFuLXN1cmF0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NzoibG9naW5fbWFzeWFyYWthdF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1778727482),
('rvOclq2AuYrixhvmpHrQdsPKFKrQJo6UlDfB06jS',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3UycU5RdzBmSWt1dVVoN25zbjNTMGR1WWpnOFRlcERtbmtiZVd6dyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wZWxheWFuYW4vcGVuZ2FqdWFuLXN1cmF0IjtzOjU6InJvdXRlIjtzOjI1OiJwZWxheWFuYW4ucGVuZ2FqdWFuLXN1cmF0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1778727491),
('sCyg64kLx630NHzTapVD4AQ3mxS5gRMi0tl81izW',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM0tZRHRCNWhOemk0eVg1a05QcWoyWkVrZkZrY0dzWGhaTkJkeGJFbSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvc3VyYXQvMS9jZXRhayI7czo1OiJyb3V0ZSI7czoxMToic3VyYXQuY2V0YWsiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1778727512),
('x6Ifl2P2Ex5atJ0utHUsXLnJkUjbbHgpISKwGjec',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1V4N1pWRU0wS3dnYTZmdlF6emNEZFQ3Uk5ROUJtYnVDMHFWdXNWUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==',1778841043);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('kepala_desa','pelayanan') NOT NULL DEFAULT 'pelayanan',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
(1,'Kepala Desa','kepaladesa@gmail.com','2026-05-13 18:57:28','$2y$12$p3xIo.xaz5auc4juPA6fZOCECbbJzhCJuRqBkNRnyYEkLqIgX6AHW','kepala_desa','UZiw3ocRUa','2026-05-13 18:57:28','2026-05-13 18:57:28'),
(2,'Pelayanan','pelayanan@gmail.com','2026-05-13 18:57:28','$2y$12$k.sYgWiG7K0kI5y6rz562uAozNJ7IfZwvgj687rYHyZ3kT/5bi4UG','pelayanan','KiaaaUua9K','2026-05-13 18:57:28','2026-05-13 18:57:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-05-15 18:38:07
