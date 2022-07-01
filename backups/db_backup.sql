-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: btb
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_login` timestamp NOT NULL,
  `created` timestamp NOT NULL,
  `updated` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (80,'Damjan','damjan@gmail.com','$2y$10$ZYTtYz.XllE0i0CXTr5gWuEqYazVAgKZCTVnqA6SYJxiNjHo4wCjG','admin','2022-07-01 13:23:50','2022-06-28 08:06:32','2022-06-28 08:06:32'),(81,'Jovan','jovan@gmail.com','$2y$10$mHZ6BVmvLo5YEVw.08v6peRsCEhVOl.f6b2CYIA5FoomY1aAHI7ca','user','2022-07-01 13:19:22','2022-06-29 06:44:41','2022-06-29 06:44:41'),(82,'Lidija','lidija@gmail.com','$2y$10$2taGp771yMXV/E1k5.hol.STRKR92BX4OmWh8joshv72qk2tT05nW','user','0000-00-00 00:00:00','2022-06-29 16:38:22','2022-06-29 16:38:22'),(84,'Test','test@gmail.com','$2y$10$/KnED6s1m9WGuaCYM9hFu.piDJeJNZkrYEx0t4Tbg9lRLANXs4ami','user','0000-00-00 00:00:00','2022-06-30 08:35:28','2022-06-30 08:35:28'),(85,'Dev','dev@gmail.com','$2y$10$slcnWNVRvjr6Yy6oLBVF7u6LOsjMPAV5jSkS0pfX3Pxs13I7tYFV.','user','0000-00-00 00:00:00','2022-06-30 08:36:40','2022-06-30 08:36:40'),(92,'Jack','jack@gmail.com','$2y$10$B.C3Zyjbig5zthTKPn1Vke8LAr2eUdf9DCd/Y/kERVSXSef05Zif.','user','2022-07-01 13:31:06','2022-07-01 13:29:09','2022-07-01 13:29:09'),(93,'Jane','jane@gmail.com','$2y$10$OrijXVIWdguEfiaiuGhIT.Qee8j5VbamI0X7sdw4ld8hzMqmOuWFO','user','2022-07-01 13:32:19','2022-07-01 13:31:45','2022-07-01 13:31:45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-01 15:59:08
