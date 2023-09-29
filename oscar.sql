-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-09-30 02:46:11
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `oscar`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 2,
  `day` date NOT NULL,
  `hope` date NOT NULL,
  `approver_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `approval_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `day`, `hope`, `approver_id`, `note`, `status`, `approval_id`) VALUES
(1, 2, '2023-10-01', '2023-10-01', 1, NULL, '確認中', 1),
(2, 2, '2023-11-01', '2023-11-01', 1, NULL, '承諾', 1),
(3, 2, '0000-00-00', '2023-10-01', 1, NULL, NULL, NULL),
(4, 2, '2023-09-27', '2023-10-01', 1, NULL, NULL, NULL),
(5, 2, '2023-09-27', '2023-10-01', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `approvals`
--

CREATE TABLE `approvals` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `approvals`
--

INSERT INTO `approvals` (`id`, `name`) VALUES
(1, '金田'),
(2, '田中'),
(3, '佐藤');

-- --------------------------------------------------------

--
-- テーブルの構造 `approvers`
--

CREATE TABLE `approvers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `approvers`
--

INSERT INTO `approvers` (`id`, `name`) VALUES
(1, '金田'),
(2, '田中'),
(3, '佐藤');

-- --------------------------------------------------------

--
-- テーブルの構造 `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 2,
  `clockin` datetime DEFAULT NULL,
  `clockout` datetime DEFAULT NULL,
  `break_time` time DEFAULT NULL,
  `work_time` time DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `clockin`, `clockout`, `break_time`, `work_time`, `location_id`, `note`) VALUES
(49, 2, '2023-09-28 23:00:44', '2023-09-28 23:10:50', '00:00:00', '00:10:00', 1, NULL),
(51, 2, '2023-09-29 00:38:33', '2023-09-29 00:39:03', '00:00:00', '00:00:00', 1, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, '赤坂事務所'),
(2, '在宅'),
(3, '出張（備考へ場所を定義）');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `authority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `code`, `password`, `name`, `authority`) VALUES
(1, 'os001', 'oscar001', '金田悠乃', 0),
(2, 'os002', 'oscar002', '田中太郎', 1),
(3, 'os003', '$2y$10$aB7rEHljJ4JuQ12Gyj1MHexbg2D.rsQr/Iy92inoXV.Ytxw3IqdtC', '佐藤花子', 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `approvers`
--
ALTER TABLE `approvers`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `approvers`
--
ALTER TABLE `approvers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- テーブルの AUTO_INCREMENT `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
