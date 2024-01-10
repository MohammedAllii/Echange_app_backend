-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 nov. 2023 à 13:50
-- Version du serveur : 10.1.32-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorie_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `categorie_name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Clothes', 'L4c62n3nTWbr4Y00mZeK5J8hKwe22XC5OvBsgreA.png', '2023-11-07 15:37:13', '2023-11-07 15:37:13'),
(2, 'Smartphone', 'UjzTU49PeUF8rcavMRA9KUi7mdrem1sn2bAwjZfX.png', '2023-11-07 15:42:39', '2023-11-07 15:42:39'),
(3, 'Car', 'rkVX8fHHmobVhlyflKnxPeam9AW1o6cTHCLSlcQC.jpg', '2023-11-07 15:10:27', '2023-11-07 15:10:27');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image_produits`
--

CREATE TABLE `image_produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `image_produits`
--

INSERT INTO `image_produits` (`id`, `produit_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, '16993743580.jpg', '2023-11-07 15:25:58', '2023-11-07 15:25:58'),
(3, 1, '16993743582.jpg', '2023-11-07 15:25:58', '2023-11-07 15:25:58'),
(4, 4, '16993889540.jpg', '2023-11-07 19:29:14', '2023-11-07 19:29:14'),
(5, 4, '16993889541.jpg', '2023-11-07 19:29:14', '2023-11-07 19:29:14'),
(6, 5, '16993905910.jpg', '2023-11-07 19:56:31', '2023-11-07 19:56:31'),
(7, 5, '16993905911.jpg', '2023-11-07 19:56:31', '2023-11-07 19:56:31'),
(27, 33, '1699491397.png', '2023-11-08 23:56:37', '2023-11-08 23:56:37'),
(32, 37, '1699493211.png', '2023-11-09 00:26:51', '2023-11-09 00:26:51');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_06_095546_create_categories_table', 1),
(6, '2023_11_06_095616_create_produits_table', 1),
(7, '2023_11_06_095636_create_image_produits_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 5, 'api_token', 'ca34db772ab5e2ae728e40017a3a4f6540878184c7ccfddae0e85146933852d3', '[\"*\"]', NULL, NULL, '2023-11-07 16:04:05', '2023-11-07 16:04:05'),
(2, 'App\\Models\\User', 5, 'api_token', '6be358d720cb468e818b73af956aba3b8352f0559402b18104a612f2fdfa35f7', '[\"*\"]', NULL, NULL, '2023-11-07 16:04:16', '2023-11-07 16:04:16'),
(3, 'App\\Models\\User', 5, 'api_token', '3fd0d48c00382d9fe538657600de6b07f446cc780d365e091589e3447b3771a8', '[\"*\"]', NULL, NULL, '2023-11-08 12:31:48', '2023-11-08 12:31:48'),
(4, 'App\\Models\\User', 5, 'api_token', '6f8e52a7f47ed1a683b7a24f9cccb321999c90f3b85b7374fedaeb54dd5f09b2', '[\"*\"]', NULL, NULL, '2023-11-08 13:10:52', '2023-11-08 13:10:52'),
(5, 'App\\Models\\User', 5, 'api_token', 'dd2fdb56d40428d0bd8737f7e65c9b0ed46e0df5f54edd0d4deb93dc72910559', '[\"*\"]', NULL, NULL, '2023-11-08 13:11:06', '2023-11-08 13:11:06'),
(6, 'App\\Models\\User', 5, 'api_token', 'd0c19c7320f3d5fc414ed1c6b6a130765a2c35ecec71f7e78028ab03f7893de3', '[\"*\"]', NULL, NULL, '2023-11-08 13:16:54', '2023-11-08 13:16:54'),
(7, 'App\\Models\\User', 5, 'api_token', '35805f50c55a3a0e83f2887779ed921d19f074f206c1620466b6b8bcf05120df', '[\"*\"]', NULL, NULL, '2023-11-08 13:27:40', '2023-11-08 13:27:40'),
(8, 'App\\Models\\User', 5, 'api_token', 'e0a611f24845f2c74bf20738ac8472ce7bb12a1c7d0ec5b6aa6cfee15e472cfb', '[\"*\"]', NULL, NULL, '2023-11-08 13:31:50', '2023-11-08 13:31:50'),
(9, 'App\\Models\\User', 5, 'api_token', '84e26ff616b6c7237b680ef7a7fcee8aab7548f775e12dadf40747dbedcb38cf', '[\"*\"]', NULL, NULL, '2023-11-08 13:57:57', '2023-11-08 13:57:57'),
(10, 'App\\Models\\User', 5, 'api_token', 'b412d051ab567e613ff2a289f00a6efa303971b13570213855dbab4cab606db5', '[\"*\"]', NULL, NULL, '2023-11-08 14:12:53', '2023-11-08 14:12:53'),
(11, 'App\\Models\\User', 5, 'api_token', '769347201c8e515d3048fdf4b816f0839a3d1f191c734601bef483948f2c1cda', '[\"*\"]', NULL, NULL, '2023-11-08 14:16:02', '2023-11-08 14:16:02'),
(12, 'App\\Models\\User', 5, 'api_token', 'be7e947555d49c2ab29267e40f11fcac43f10ce4e4eb046c6e38e5348e800394', '[\"*\"]', NULL, NULL, '2023-11-08 14:26:55', '2023-11-08 14:26:55'),
(13, 'App\\Models\\User', 5, 'api_token', '9e3866e275646a19ebc5cf114f942c28c97f9666d48c640a43b50c9f4f99226c', '[\"*\"]', NULL, NULL, '2023-11-08 14:36:02', '2023-11-08 14:36:02'),
(14, 'App\\Models\\User', 5, 'api_token', 'f6d554f2325536e122288218768dd47958bec56c26b09a7ec9d4092507be844c', '[\"*\"]', NULL, NULL, '2023-11-08 14:41:27', '2023-11-08 14:41:27'),
(15, 'App\\Models\\User', 5, 'api_token', 'dea07bb246589351704d859f66de57b15c10d2e76cdc535cf4d4a8036b589f2a', '[\"*\"]', NULL, NULL, '2023-11-08 14:51:32', '2023-11-08 14:51:32'),
(16, 'App\\Models\\User', 5, 'api_token', '5c9a6fe7815778c360eab9c20f989c73cb170e9a4ec7e8dde97d63bf8ca255b9', '[\"*\"]', NULL, NULL, '2023-11-08 15:26:36', '2023-11-08 15:26:36'),
(17, 'App\\Models\\User', 5, 'api_token', 'b1104273ae7e3436a7aedfb96fbcf260fa9abb27d79c263d8d501ab7fae7cb5f', '[\"*\"]', NULL, NULL, '2023-11-08 15:36:35', '2023-11-08 15:36:35'),
(18, 'App\\Models\\User', 5, 'api_token', '5a67346f2701bfee7152892733a5fdf44e5e1289a96c32e289723dc712a70a1b', '[\"*\"]', NULL, NULL, '2023-11-08 15:50:39', '2023-11-08 15:50:39'),
(19, 'App\\Models\\User', 5, 'api_token', 'a0c838806708dbaee95102b53ab047d7253d827cd689a6d6946870a559858466', '[\"*\"]', NULL, NULL, '2023-11-08 17:29:49', '2023-11-08 17:29:49'),
(20, 'App\\Models\\User', 5, 'api_token', '515806f9bff4256bb9abf3883f110351fbe46a52bab1535cb3179a1a4e1b778e', '[\"*\"]', NULL, NULL, '2023-11-08 20:05:28', '2023-11-08 20:05:28'),
(21, 'App\\Models\\User', 5, 'api_token', '81189273dec0020a33e64ed2ec7a3b70b30bbba835b7535472f711cd2d0185ac', '[\"*\"]', NULL, NULL, '2023-11-08 20:21:33', '2023-11-08 20:21:33'),
(22, 'App\\Models\\User', 5, 'api_token', '072c14837fe294714a1e3ec5785d9c2c7110b09c5613ece34b7f37bd90740739', '[\"*\"]', NULL, NULL, '2023-11-08 23:09:38', '2023-11-08 23:09:38'),
(23, 'App\\Models\\User', 5, 'api_token', '240b9905ed6505ba46e1fab1a714d40aa9dc95fd681d367311938215f4270e8c', '[\"*\"]', NULL, NULL, '2023-11-08 23:10:39', '2023-11-08 23:10:39'),
(24, 'App\\Models\\User', 5, 'api_token', '1c50d7213cbbb03dd455dc13f583c50a8789330ba7ce944d7baf32a7536f3565', '[\"*\"]', NULL, NULL, '2023-11-08 23:16:23', '2023-11-08 23:16:23'),
(25, 'App\\Models\\User', 5, 'api_token', '23bf04b7223ef79c403f02e135a5fa630eeb7f1e331164a4032fccaa60010db5', '[\"*\"]', NULL, NULL, '2023-11-08 23:18:54', '2023-11-08 23:18:54'),
(26, 'App\\Models\\User', 5, 'api_token', '2da9f90ca41710fcc24a0f699f9fde7db8bbd6350fa91bb42504fa92be559299', '[\"*\"]', NULL, NULL, '2023-11-08 23:30:46', '2023-11-08 23:30:46'),
(27, 'App\\Models\\User', 5, 'api_token', '0e3ea12361ec209c22708a9fdc83e0f5678b79b282c9ff3c62c0985f1c3e5cd7', '[\"*\"]', NULL, NULL, '2023-11-08 23:35:56', '2023-11-08 23:35:56'),
(28, 'App\\Models\\User', 5, 'api_token', 'cb869e123b8e3bd8325c4e499dd38b00b01f27ce719c6e4ad4d9cbc869d7280b', '[\"*\"]', NULL, NULL, '2023-11-08 23:55:39', '2023-11-08 23:55:39'),
(29, 'App\\Models\\User', 5, 'api_token', 'a3d100436c1a022617381ad483f65e700f833d79faff43bbb6e19dea645e9ec1', '[\"*\"]', NULL, NULL, '2023-11-09 00:02:18', '2023-11-09 00:02:18'),
(30, 'App\\Models\\User', 5, 'api_token', '61295b2e2a2c1d7cb824d30c47a79969778c7170b08cfbdcd651e482896aa643', '[\"*\"]', NULL, NULL, '2023-11-09 00:04:21', '2023-11-09 00:04:21'),
(31, 'App\\Models\\User', 5, 'api_token', '254d6e11b9ec5c2ca0292aaa8459e02fe757b0e61a7a1763867d7f8b535588e7', '[\"*\"]', NULL, NULL, '2023-11-09 00:10:44', '2023-11-09 00:10:44'),
(32, 'App\\Models\\User', 5, 'api_token', '13b0b3e61bd585770ecd3ed163e7ef434c386fa781aa03196e17185c193c2ec6', '[\"*\"]', NULL, NULL, '2023-11-09 00:20:56', '2023-11-09 00:20:56'),
(33, 'App\\Models\\User', 5, 'api_token', 'b090341b2ca549ca06e99d56489a085c7b255f55eb90253c68a1cc9253618a0a', '[\"*\"]', NULL, NULL, '2023-11-09 00:22:52', '2023-11-09 00:22:52'),
(34, 'App\\Models\\User', 5, 'api_token', '01d8a68dbc8d1a8138fc1779afa2cc77f32dbd7a893eee6673bbfc1e7d21bed6', '[\"*\"]', NULL, NULL, '2023-11-09 00:36:25', '2023-11-09 00:36:25'),
(35, 'App\\Models\\User', 5, 'api_token', '4ed331ea42b6c6aaba422eb9b158411263810f90557317f6c58fe1a5f6744ba5', '[\"*\"]', NULL, NULL, '2023-11-09 00:40:26', '2023-11-09 00:40:26');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_produit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom_produit`, `description`, `status`, `user_id`, `categorie_id`, `created_at`, `updated_at`) VALUES
(1, 'Iphone 14', 'Caméra: 12 Mp ,2 capteurs\r\nTaille d\'écran:6,1 pouces\r\nDéfinition : 2532 x 1170 pixels\r\nProcesseur : Apple A15 Bionic', '1', 5, 2, '2023-11-07 15:25:58', '2023-11-07 15:25:58'),
(4, 'Audi R8', 'Wikipedia\r\nhttps://en.wikipedia.org › wiki › Audi...\r\n‪audi r8 من en.wikipedia.org‬‏\r\nThe Audi R8 is a mid-engine, 2-seater sports car, which uses Audi\'s trademark quattro permanent all-wheel drive system. It was introduced by the German car', '1', 5, 3, '2023-11-07 19:29:14', '2023-11-07 19:29:14'),
(5, 'Samsung galaxy s21', 'Mesurée en diagonale, la taille de l\'écran du Galaxy S21 5G est de 6,2 pouces dans le rectangle complet et de 6,1 pouces en tenant compte des coins arrondis.', '1', 6, 2, '2023-11-07 19:56:31', '2023-11-07 19:56:31'),
(33, 'phone', 'ppp', '1', 5, 2, '2023-11-08 23:56:12', '2023-11-08 23:56:12'),
(37, 'ttt', 'yyy', '1', 5, 1, '2023-11-09 00:26:40', '2023-11-09 00:26:40');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'ey', 'ey@gmail.com', NULL, NULL, '$2y$10$2IVqCvW7b0F6I7DD4uJwYernMvtWSFXRuBz7sN.cbz/xCwwI/ZDtu', NULL, '2023-11-07 15:21:11', '2023-11-07 15:21:11'),
(6, 'noo', 'no@gmail.com', NULL, NULL, '$2y$10$0w.a4kCEr/jxXUgQ5.W1cOcLKLSv4gjUdFthVqXTUA4n0eX4RpnS.', NULL, '2023-11-07 19:53:30', '2023-11-07 19:53:30');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `image_produits`
--
ALTER TABLE `image_produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_produits_produit_id_foreign` (`produit_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_user_id_foreign` (`user_id`),
  ADD KEY `produits_categorie_id_foreign` (`categorie_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `image_produits`
--
ALTER TABLE `image_produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `image_produits`
--
ALTER TABLE `image_produits`
  ADD CONSTRAINT `image_produits_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
