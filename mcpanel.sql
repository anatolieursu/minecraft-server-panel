-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: oct. 15, 2023 la 04:30 PM
-- Versiune server: 10.4.28-MariaDB
-- Versiune PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `mcpanel`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `applies`
--

CREATE TABLE `applies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'staff',
  `username` varchar(255) NOT NULL,
  `reason` longtext NOT NULL,
  `age` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'checking',
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `chats`
--

INSERT INTO `chats` (`id`, `message`, `author`, `seen`, `created_at`, `updated_at`) VALUES
(1, 'Hello', 'AnatolieUrsu', 0, '2023-10-15 11:28:15', '2023-10-15 11:28:15');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `version` double NOT NULL DEFAULT 0,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `failed_jobs`
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
-- Structură tabel pentru tabel `forums`
--

CREATE TABLE `forums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `urgency` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `reply_from_msg_id` varchar(255) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(138, '2014_10_12_000000_create_users_table', 1),
(139, '2014_10_12_100000_create_password_resets_table', 1),
(140, '2019_08_19_000000_create_failed_jobs_table', 1),
(141, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(142, '2023_08_27_072332_create_forums_table', 1),
(143, '2023_08_27_122526_create_messages_table', 1),
(144, '2023_08_28_123506_create_staff_table', 1),
(145, '2023_08_28_163802_create_wikis_table', 1),
(146, '2023_08_28_184332_create_applies_table', 1),
(147, '2023_08_29_141751_create_events_table', 1),
(148, '2023_10_05_133039_create_chats_table', 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `personal_access_tokens`
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
-- Structură tabel pentru tabel `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `discriminator` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `mfa_enabled` tinyint(1) NOT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `staff` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `about` longtext DEFAULT NULL,
  `public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `discriminator`, `email`, `avatar`, `verified`, `locale`, `mfa_enabled`, `refresh_token`, `staff`, `admin`, `about`, `public`, `created_at`, `updated_at`) VALUES
(1083421140833292388, 'anatolieursu', '0', 'anatolursu.3@gmail.com', '3d66a2b08de5a18fcdf6e7a9f8f3ad3d', 1, 'ro', 1, 'eyJpdiI6ImEyZXZlSENNRVVEdmRWSkRDTzN5U3c9PSIsInZhbHVlIjoiK01udlpJVENDNW04aGJhWXlYaE1iM1dCTHZpbk5tMVZ3K2FlNG9HZUdacz0iLCJtYWMiOiJmYmUzMjY0OTJkYzY2MzA2MzM3MWRlMjI4ZWNhMzZhMzk0YjQwYjI0YjQzYzU0NTYwZjI0Y2EwNDk4YWI5OTk4IiwidGFnIjoiIn0=', 0, 1, NULL, 1, '2023-10-15 04:27:14', '2023-10-15 04:27:49');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `wikis`
--

CREATE TABLE `wikis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `button_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `section` varchar(255) NOT NULL,
  `image_path` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `wikis`
--

INSERT INTO `wikis` (`id`, `button_name`, `title`, `content`, `section`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'Potato', 'Learn all about Potato in Skyblock!', 'The potato is a starchy food, a tuber of the plant Solanum tuberosum and is a root vegetable native to the Americas. The plant is a perennial in the nightshade family Solanaceae.[2]\n\n            Wild potato species can be found from the southern United States to southern Chile.[3] The potato was originally believed to have been domesticated (§ History) by Native Americans independently in multiple locations,[4] but later genetic studies traced a single origin, in the area of present-day southern Peru and extreme northwestern Bolivia. Potatoes were domesticated there approximately 7,000–10,000 years ago, from a species in the S. brevicaule complex.[5][6][7] In the Andes region of South America, where the species is indigenous, some close relatives of the potato are cultivated.\n            \n            Potatoes were introduced to Europe from the Americas by the Spanish in the second half of the 16th century. Today they are a staple food in many parts of the world and an integral part of much of the world\'s food supply. As of 2014, potatoes were the world\'s fourth-largest food crop after maize (corn), wheat, and rice.[8] Following millennia of selective breeding, there are now over 5,000 different types of potatoes.[6] Over 99% of potatoes presently cultivated worldwide descend from varieties that originated in the lowlands of south-central Chile.', 'Skyblock', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Patates.jpg/1280px-Patates.jpg', '2023-10-15 11:30:08', '2023-10-15 11:30:08'),
(2, 'Carrot', 'Learn all about Carrot in Skyblock!', 'The carrot (Daucus carota subsp. sativus) is a root vegetable, typically orange in color, though purple, black, red, white, and yellow cultivars exist,[2][3][4] all of which are domesticated forms of the wild carrot, Daucus carota, native to Europe and Southwestern Asia. The plant probably originated in Persia and was originally cultivated for its leaves and seeds. The most commonly eaten part of the plant is the taproot, although the stems and leaves are also eaten. The domestic carrot has been selectively bred for its enlarged, more palatable, less woody-textured taproot.\n\n            The carrot is a biennial plant in the umbellifer family, Apiaceae. At first, it grows a rosette of leaves while building up the enlarged taproot. Fast-growing cultivars mature within three months (90 days) of sowing the seed, while slower-maturing cultivars need a month longer (120 days). The roots contain high quantities of alpha- and beta-carotene, and are a good source of vitamin A, vitamin K, and vitamin B6.\n            \n            The United Nations Food and Agriculture Organization (FAO) reports that world production of carrots and turnips (these plants are combined by the FAO) for 2020 was 41 million tonnes, with over 44% of the world total grown in China. Carrots are commonly consumed raw or cooked in various cuisines.', 'Skyblock', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Vegetable-Carrot-Bundle-wStalks.jpg/1280px-Vegetable-Carrot-Bundle-wStalks.jpg', '2023-10-15 11:30:08', '2023-10-15 11:30:08'),
(3, 'Apple', 'Learn all about Apples in Skyblock!', 'An apple is a round, edible fruit produced by an apple tree (Malus domestica). Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus. The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found. Apples have been grown for thousands of years in Asia and Europe and were introduced to North America by European colonists. Apples have religious and mythological significance in many cultures, including Norse, Greek, and European Christian tradition.\n\n            Apples grown from seed tend to be very different from those of their parents, and the resultant fruit frequently lacks desired characteristics. Generally, apple cultivars are propagated by clonal grafting onto rootstocks. Apple trees grown without rootstocks tend to be larger and much slower to fruit after planting. Rootstocks are used to control the speed of growth and the size of the resulting tree, allowing for easier harvesting.\n            \n            There are more than 7,500 cultivars of apples. Different cultivars are bred for various tastes and uses, including cooking, eating raw, and cider production. Trees and fruit are prone to fungal, bacterial, and pest problems, which can be controlled by a number of organic and non-organic means. In 2010, the fruit\'s genome was sequenced as part of research on disease control and selective breeding in apple production.\n            \n            Worldwide production of apples in 2021 was 93 million tonnes, with China accounting for nearly half of the total.', 'Skyblock', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Pink_lady_and_cross_section.jpg/1920px-Pink_lady_and_cross_section.jpg', '2023-10-15 11:30:08', '2023-10-15 11:30:08'),
(4, 'Beetroot', 'Learn all about beetroot in Skyblock!', 'The beetroot is the taproot portion of a beet plant,[1] usually known in North America as beets while the vegetable is referred to as beetroot in British English, and also known as the table beet, garden beet, red beet, dinner beet or golden beet.\n\n            It is one of several cultivated varieties of Beta vulgaris grown for their edible taproots and leaves (called beet greens); they have been classified as B. vulgaris subsp. vulgaris Conditiva Group.[2]\n            \n            Other cultivars of the same species include the sugar beet, the leaf vegetable known as chard or spinach beet, and mangelwurzel, which is a fodder crop. Three subspecies are typically recognized.', 'Skyblock', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Detroitdarkredbeets.png/220px-Detroitdarkredbeets.png', '2023-10-15 11:30:08', '2023-10-15 11:30:08'),
(5, 'Pineapple', 'Learn all about Pineapple in Skyblock!', 'The pineapple is a herbaceous perennial, which grows to 1.0 to 1.5 m (3 ft 3 in to 4 ft 11 in) tall on average, although sometimes it can be taller. The plant has a short, stocky stem with tough, waxy leaves. When creating its fruit, it usually produces up to 200 flowers, although some large-fruited cultivars can exceed this. Once it flowers, the individual fruits of the flowers join together to create a multiple fruit. After the first fruit is produced, side shoots (called \'suckers\' by commercial growers) are produced in the leaf axils of the main stem. These suckers may be removed for propagation, or left to produce additional fruits on the original plant.[5] Commercially, suckers that appear around the base are cultivated. It has 30 or more narrow, fleshy, trough-shaped leaves that are 30 to 100 cm (1 to 3+1⁄2 ft) long, surrounding a thick stem; the leaves have sharp spines along the margins. In the first year of growth, the axis lengthens and thickens, bearing numerous leaves in close spirals. After 12 to 20 months, the stem grows into a spike-like inflorescence up to 15 cm (6 in) long with over 100 spirally arranged, trimerous flowers, each subtended by a bract.', 'Skyblock', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/%E0%B4%95%E0%B5%88%E0%B4%A4%E0%B4%9A%E0%B5%8D%E0%B4%9A%E0%B4%95%E0%B5%8D%E0%B4%95.jpg/220px-%E0%B4%95%E0%B5%88%E0%B4%A4%E0%B4%9A%E0%B5%8D%E0%B4%9A%E0%B4%95%E0%B5%8D%E0%B4%95.jpg', '2023-10-15 11:30:08', '2023-10-15 11:30:08'),
(6, 'Plums', 'Learn all about Plums in Skyblock!', 'A plum is a fruit of some species in Prunus subg. Prunus. Dried plums are most often called prunes, though in the United States they may be just labeled as \'dried plums\', especially during the 21st century.[1][2]\n            Plum flowers\n            Plum unripe fruits\n            Plums may have been one of the first fruits domesticated by humans, with origins in East European and Caucasian mountains and China. They were brought to Britain from Asia, and their cultivation has been documented in Andalusia, southern Spain. Plums are a diverse group of species, with trees reaching a height of 5-6 meters when pruned. The fruit is a drupe, with a firm and juicy flesh.\n            China is the largest producer of plums, followed by Romania and Serbia. Japanese or Chinese plums dominate the fresh fruit market, while European plums are also common in some regions. Plums can be eaten fresh, used in jams, or fermented into wine or brandy. Plum kernels contain cyanogenic glycosides, but the oil made from them is not commercially available.', 'Survival', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Plums_African_Rose_-_whole%2C_halved_and_slice.jpg/1024px-Plums_African_Rose_-_whole%2C_halved_and_slice.jpg', '2023-10-15 11:30:08', '2023-10-15 11:30:08'),
(7, 'Grapes', 'Learn all about Grapes in Skyblock!', 'The Middle East is generally described as the homeland of grapes and the cultivation of this plant began there 6,000–8,000 years ago.[1][2] Yeast, one of the earliest domesticated microorganisms, occurs naturally on the skins of grapes, leading to the discovery of alcoholic drinks such as wine. The earliest archeological evidence for a dominant position of wine-making in human culture dates from 8,000 years ago in Georgia.[3][4][5]\n\n            The oldest known winery was found in Armenia, dating to around 4000 BC.[6] By the 9th century AD, the city of Shiraz was known to produce some of the finest wines in the Middle East. Thus it has been proposed that Syrah red wine is named after Shiraz, a city in Persia where the grape was used to make Shirazi wine.[7]\n            \n            Ancient Egyptian hieroglyphics record the cultivation of purple grapes, and history attests to the ancient Greeks, Cypriots, Phoenicians, and Romans growing purple grapes both for eating and wine production.[8] The growing of grapes would later spread to other regions in Europe, as well as North Africa, and eventually in North America.\n            \n            In 2005 a team of archaeologists concluded that some Chalcolithic wine jars, which were discovered in Cyprus in the 1930s, were the oldest of their kind in the world, dating back to 3,500 BC.[9] Moreover, Commandaria, a sweet dessert wine from Cyprus, is the oldest manufactured wine in the world, its origins traced as far back as 2000 BC.[10]', 'Survival', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Abhar-iran.JPG/170px-Abhar-iran.JPG', '2023-10-15 11:30:08', '2023-10-15 11:30:08');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `applies`
--
ALTER TABLE `applies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applies_user_id_foreign` (`user_id`);

--
-- Indexuri pentru tabele `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Indexuri pentru tabele `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexuri pentru tabele `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forums_user_id_foreign` (`user_id`);

--
-- Indexuri pentru tabele `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Indexuri pentru tabele `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexuri pentru tabele `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexuri pentru tabele `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_name_unique` (`name`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexuri pentru tabele `wikis`
--
ALTER TABLE `wikis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `applies`
--
ALTER TABLE `applies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pentru tabele `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `forums`
--
ALTER TABLE `forums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT pentru tabele `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1083421140833292389;

--
-- AUTO_INCREMENT pentru tabele `wikis`
--
ALTER TABLE `wikis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `applies`
--
ALTER TABLE `applies`
  ADD CONSTRAINT `applies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constrângeri pentru tabele `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constrângeri pentru tabele `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `forums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constrângeri pentru tabele `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
