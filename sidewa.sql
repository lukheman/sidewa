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
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0','i:1;',1778910995),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer','i:1778910995;',1778910995);
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
(1,'fda','fda','templates/YxdJLIIx3hL5u2ntnYcOWLRJEg4ctHmqbtRMWtYP.docx','[]','2026-05-15 21:55:37','2026-05-15 21:55:37');
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
(1,'Renovasi Balai Desa','Autem fuga iure quod et recusandae dicta. Sapiente impedit non quis provident voluptatem vitae beatae. Earum fugiat exercitationem est. Ea voluptatibus doloremque sit omnis. Quam dolor nobis quo minus voluptatem fugiat velit.','2026-05-12','2026-06-14',100,2,NULL,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(2,'Renovasi Balai Desa','Sunt repellendus officiis eligendi quia in odio ea maxime. Et est est autem. Ratione commodi numquam distinctio hic corporis eius minus facilis. Quas et qui ut velit excepturi.','2026-05-06','2026-06-11',100,2,NULL,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(3,'Pelatihan UMKM','Et iusto labore deserunt fuga corporis. Rem et harum officia cum ab. Beatae corporis laborum exercitationem ratione consequatur qui quis. Autem accusantium quia commodi delectus consequatur autem. Ipsa nihil eos aut iure repellendus aspernatur quidem.','2026-06-04','2026-07-01',100,2,NULL,'2026-05-15 21:55:17','2026-05-15 21:55:17');
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
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
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
(1,'1234567890123456',NULL,'Budi Santoso','P','1983-11-13',NULL,NULL,'budi@gmail.com','Jl. Merdeka No. 10, Desa Sidoasih','081234567890','$2y$12$93KnT1rd0OgxWvpwMrcv0usmnEYXqU1CmwQMLa8yWYAu.qFZvPJSS',NULL,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(2,'9571921516794278',NULL,'Jindra Jarwi Winarno S.Gz','L','1971-02-14',NULL,NULL,'zbraun@example.org','Kpg. Cihampelas No. 890, Padang 30387, Gorontalo','086246175735','$2y$12$E4vzI7N0.aZ1QFZ0bkblWewq5mWqle6DQ0z8tmJq4C4dDmacZF35W',NULL,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(3,'9925108293970548',NULL,'Garda Jayadi Tamba M.Kom.','P','1976-11-16',NULL,NULL,'bstreich@example.com','Gg. Suryo No. 438, Tidore Kepulauan 48046, Sulut','082126685253','$2y$12$E4vzI7N0.aZ1QFZ0bkblWewq5mWqle6DQ0z8tmJq4C4dDmacZF35W',NULL,'2026-05-15 21:55:17','2026-05-15 21:55:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(17,'2026_05_13_124130_add_data_tambahan_to_pengajuan_surats_table',1),
(18,'2026_05_15_144025_add_additional_demografi_to_masyarakat_table',1);
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
(1,'Jembatan penyeberangan rusak berbahaya. Doloribus similique ut qui voluptas. Placeat eius occaecati omnis beatae. Quo nesciunt fugiat tempora quis. Adipisci aliquam quod et ut earum vel dolorem.','2026-05-11','proses',2,2,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(2,'Jalan rusak di depan rumah sudah lama tidak diperbaiki. Amet animi perferendis quaerat magni qui architecto. Voluptatum consequatur aliquam et ut id placeat.','2026-04-28','pending',3,2,'2026-05-15 21:55:17','2026-05-15 21:55:17');
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
(1,'2026-05-16','disetujui','fda','[]',1,1,1,'2eJe2AL4X2krSSrikqihYPZ6y64D0LaC','2026-05-15 21:55:57','2026-05-15 22:00:04');
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
(1,'Minima id optio est quos.','Aut dolor ad dolorem impedit quos. Et fugiat sunt voluptas cumque architecto harum. Ab eligendi asperiores debitis enim aut aut.\n\nEligendi excepturi ut quis repudiandae et blanditiis corporis quaerat. Hic explicabo perferendis sunt nulla et et omnis.\n\nDoloribus ratione ipsam fugit veniam aut. Accusantium error laudantium quaerat tenetur quibusdam. Corporis ut aut possimus dolore veniam mollitia. Et cupiditate nihil et dolore dolore atque.','2026-04-19',2,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(2,'Quod sed odio ea deleniti omnis quis.','Aut quas ipsum facilis illum dolorum. Delectus praesentium consequatur magnam aspernatur. Consequatur temporibus nobis debitis magni necessitatibus quia debitis.\n\nMollitia autem fugiat assumenda ut autem et. Porro id ut dolores cum id. Et architecto aliquam consequatur est consequatur.\n\nUnde mollitia laboriosam perferendis voluptate. Maiores dolores cupiditate accusamus eaque similique.','2026-04-22',2,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(3,'Provident at sint aut quia odio.','Velit ut asperiores rem dolor eos qui molestias laborum. Ipsa autem ea voluptates ex labore voluptate aliquam. Incidunt velit ab omnis enim voluptatem in.\n\nOfficia vel ut rerum et ut ut aspernatur. Perferendis maxime nam assumenda architecto provident tempore. Molestiae occaecati sint necessitatibus corporis alias et velit.\n\nEnim quo reprehenderit odit quisquam omnis. Officiis debitis eos est. Sunt exercitationem consectetur asperiores consequatur vel.','2026-04-23',2,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(4,'Et esse et qui.','Commodi sit incidunt eum nemo ea aliquam qui. Eligendi aut consectetur vero voluptas id earum cum. Numquam vero autem iste.\n\nEst quis ea veritatis deserunt autem voluptatem. Beatae quaerat a quia. Ipsa laudantium eum est.\n\nQui rerum consectetur sed magni ut. Voluptas fuga et ipsa. Vero cum aut alias vel ea commodi.','2026-05-02',2,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(5,'Quia et quia ea cupiditate ipsa non.','Est expedita deserunt soluta cupiditate sed libero. Quia quae est molestiae fugiat quasi. Quia et rem libero autem.\n\nIure rerum id labore voluptatem velit consequuntur voluptas eos. Non iure quod ut voluptas sunt. Ipsa iure consectetur sint. Temporibus necessitatibus itaque voluptatem quas.\n\nNon aut autem quis et. Dolorum aut quis nostrum magnam nihil ut officia natus. Dolorem numquam doloribus quas voluptatem qui.','2026-05-01',2,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(6,'Maiores recusandae deleniti accusamus.','Laudantium voluptas amet et nemo ipsam et. Ducimus inventore saepe unde repellendus qui nulla. Autem rerum assumenda nobis nesciunt porro voluptatem sequi. Quia dolores autem eligendi aut.\n\nEt enim aut iusto molestias quaerat asperiores molestias. Quasi unde ducimus voluptates reiciendis aspernatur unde omnis. Ut voluptatibus vitae in.\n\nIncidunt optio dignissimos saepe qui quia fuga. Ad accusamus adipisci molestias ex non ipsam cupiditate. Excepturi suscipit iure accusamus rerum.','2026-04-20',1,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(7,'Atque vero sunt error.','Occaecati est et officiis libero distinctio voluptates. Dignissimos saepe eum sunt inventore id sequi. Animi iure accusantium explicabo quae sint. Dolor laboriosam officiis excepturi consequatur aliquam aut.\n\nVero eos rem ullam dolorem voluptates. Vero qui odio consequatur rem quo enim. Ut quia similique sunt ut pariatur animi impedit. Aut non minus odit vel aperiam magnam.\n\nAnimi assumenda similique ad. Incidunt dolorum esse similique. Voluptatum laborum reiciendis similique ducimus aspernatur et.','2026-05-07',1,'2026-05-15 21:55:17','2026-05-15 21:55:17'),
(8,'Consequatur ut dolore illo sed sint.','Velit doloremque ea dignissimos. Maxime labore cupiditate et culpa.\n\nAut dolor dolores ut blanditiis repudiandae. Earum sequi sit earum eum aliquam. Consequuntur quasi sunt ullam blanditiis porro nulla. Omnis quia nesciunt quo labore enim maxime.\n\nVoluptatem tempore voluptatum animi. Quasi sed consequatur vitae voluptatum asperiores. Sit neque eos pariatur maiores sint fugit ratione. Cumque sed sit ut sit tempore voluptatem omnis dignissimos. Sit ad officiis animi.','2026-04-21',1,'2026-05-15 21:55:17','2026-05-15 21:55:17');
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
('6aEUwGeLNwJ176vrfUCo84mVlIeaZ8gv61rdNknr',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQmJLanN0MUJ4eDhtTndCaFVkdzc2cXc1M3hJQjBuZlBFdjZJaDJpNyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvc3VyYXQvMS9jZXRhayI7czo1OiJyb3V0ZSI7czoxMToic3VyYXQuY2V0YWsiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1778911240),
('COuyzNOGXt8pJLqrfGi5t4Te0oh5HIVfuNaOAy67',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZlpwWkFQWGRNY0NQd1Q2SzEzYlpuUUo4UmVCeGRMcmdoR2NNVGVGbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wZWxheWFuYW4vcGVuZ2FqdWFuLXN1cmF0IjtzOjU6InJvdXRlIjtzOjI1OiJwZWxheWFuYW4ucGVuZ2FqdWFuLXN1cmF0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1778911113),
('Ua0CwxsBiO2aKR0jqYOM0E0VMMMGtt7jOmrCWJmU',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoibk1XRFZpNHdSRG1VOFI0WHc1YzhJUUI4dnJ3Tno4WkJ6emtodUZITCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ4OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbWFzeWFyYWthdC9wZW5nYWp1YW4tc3VyYXQiO3M6NToicm91dGUiO3M6MjY6Im1hc3lhcmFrYXQucGVuZ2FqdWFuLXN1cmF0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NzoibG9naW5fbWFzeWFyYWthdF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1778910957);
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
(1,'Kepala Desa','kepaladesa@gmail.com','2026-05-15 21:55:17','$2y$12$T.OcakYhDjwzTpvSXfVoieRjC4WmYLAEGJ1Sg5pCdsFzubVuUE5Vm','kepala_desa','7FYMaHlqJp','2026-05-15 21:55:17','2026-05-15 21:55:17'),
(2,'Pelayanan','pelayanan@gmail.com','2026-05-15 21:55:17','$2y$12$5./6BiYsCsXFZo65FxCLAeH.c19ABB5uaifMUs7bOCQtZrgcswUDu','pelayanan','HaSrfmNJcd','2026-05-15 21:55:17','2026-05-15 21:55:17');
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

-- Dump completed on 2026-05-16 14:07:33
