-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 20, 2014 at 08:20 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `easyProcess`
--
CREATE DATABASE IF NOT EXISTS `easyProcess` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `easyProcess`;

-- --------------------------------------------------------

--
-- Table structure for table `ep_accounts`
--

DROP TABLE IF EXISTS `ep_accounts`;
CREATE TABLE `ep_accounts` (
`id` int(15) NOT NULL,
  `acct_code` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `acct_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acct_desc_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_id` int(15) NOT NULL,
  `org_id` int(11) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `type` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ep_accounts`
--

INSERT INTO `ep_accounts` (`id`, `acct_code`, `acct_desc`, `acct_desc_2`, `entity_id`, `org_id`, `activated`, `created_by`, `modified_by`, `type`) VALUES
(1, '50500', 'Contracted Services', NULL, 1, 0, 1, NULL, NULL, 1),
(2, '61700', 'Computer and Internet Expenses', NULL, 1, 0, 1, NULL, NULL, 2),
(3, '62000', 'Continuing Education', NULL, 1, 0, 1, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ep_approval_matrix`
--

DROP TABLE IF EXISTS `ep_approval_matrix`;
CREATE TABLE `ep_approval_matrix` (
`id` int(15) NOT NULL,
  `control_type` int(11) NOT NULL,
  `control_id` int(11) NOT NULL,
  `authority_user` int(11) NOT NULL,
  `approval_limit` double NOT NULL,
  `approval_level` int(11) NOT NULL,
  `mandatory` tinyint(1) NOT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ep_articles`
--

DROP TABLE IF EXISTS `ep_articles`;
CREATE TABLE `ep_articles` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ep_articles`
--

INSERT INTO `ep_articles` (`id`, `title`, `slug`, `body`, `image`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Dolores sed et modi alias non.', NULL, 'Similique ullam hic inventore ea debitis veritatis. Deleniti provident consectetur hic enim et qui consequatur accusantium. Nihil ex dolorum repellat modi. Molestiae et voluptates ut omnis eaque nobis odit laboriosam. Deleniti ut nobis molestias ut quisquam. Autem aut dicta repellendus beatae quia numquam nulla. Minima nisi voluptas sunt dolores quia pariatur ut adipisci.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(2, 'Asperiores amet consequatur quas aut sunt suscipit debitis.', NULL, 'Vitae vel repellendus quis magni quae. Consequatur porro non quia magni. Doloremque hic soluta voluptatem quo. Qui est veritatis quo itaque. Nesciunt iste ut vitae accusantium sunt iure. Eius minus incidunt animi voluptatibus incidunt.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(3, 'Ipsa fugiat nihil placeat et dolor sed quidem maxime.', NULL, 'Sint consequatur soluta similique perspiciatis animi asperiores. Vel qui perferendis ipsum at voluptatem qui quae. Qui qui eum ut id. Et blanditiis nostrum delectus aperiam numquam minima qui.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(4, 'Tempore placeat eos itaque ea sunt.', NULL, 'Eos accusamus accusantium quam voluptatem. Cupiditate repudiandae illum rerum amet fuga sed quam. Quis et omnis veritatis ad enim autem. Dolorum possimus eum eum quis. Modi et temporibus autem illo ipsam.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(5, 'Dolorem odio delectus eius sunt nemo.', NULL, 'Placeat explicabo consectetur eligendi nesciunt possimus. Voluptatem dolorem quis hic ea tempore excepturi officiis. Dolorem quas vero aperiam. Consequatur neque quis earum totam unde. Magni ipsam praesentium occaecati quidem suscipit. Consequatur reprehenderit minima debitis aut quo veritatis. Cupiditate facilis quisquam dolores quas sequi.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(6, 'Adipisci modi eaque atque ut molestiae repellat.', NULL, 'Eius numquam accusamus et quam in vel qui. Veritatis architecto vero explicabo voluptatem a ratione. Commodi vel alias a quo. Suscipit vero qui harum et vel voluptatibus voluptatem. Voluptatem quo aspernatur praesentium libero aliquid distinctio culpa. In rem nulla minus incidunt blanditiis soluta.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(7, 'Atque expedita quo impedit quas.', NULL, 'Minima sequi sint ipsum quod ut. Eum id commodi dolorem corporis dolorem non velit. Nemo voluptas autem velit quia commodi ipsam aut. Nobis dolor commodi mollitia.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(8, 'Nisi nemo maiores voluptatem voluptatem possimus aliquam veritatis.', NULL, 'Porro dignissimos quo est reiciendis illum voluptatem et rerum. Harum error aut sit voluptas qui. Placeat repudiandae eum esse minus et. Vel omnis et explicabo est. Est est voluptatem in aliquid.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(9, 'Non facilis nesciunt accusamus earum voluptatem officia.', NULL, 'Qui labore assumenda magni velit nesciunt nesciunt ipsum pariatur. Consequuntur est eum cumque non. Provident quia ut repellat nobis eligendi corrupti quod. Incidunt deleniti accusamus vel laudantium et consequatur dignissimos. Quis tempore rerum non.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(10, 'Amet est pariatur dolorem cumque aspernatur.', NULL, 'Aut facere explicabo voluptas ratione animi totam a. Illo mollitia sed sint voluptatem quidem. Suscipit perspiciatis quasi ea nesciunt rerum blanditiis non. Molestias voluptas fuga iste non in temporibus. Temporibus quasi ad odit illo temporibus blanditiis tempore. Impedit similique voluptatem autem vitae est. Magnam autem quae vel sed rerum nihil.', NULL, 1, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(11, 'A tempora nihil autem rem necessitatibus inventore praesentium.', NULL, 'Fugit laboriosam maiores ut dolores. Dolorem ducimus non culpa aut asperiores non dicta. Voluptas commodi nobis vitae quis qui et. Et sint voluptatum ut sed necessitatibus doloribus doloremque.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(12, 'Non sequi odit enim et vel voluptas quia.', NULL, 'Autem facilis aspernatur sunt aut sunt. Et aut possimus consequatur amet quo. Voluptatum saepe magni possimus. Quidem totam in quia suscipit sit odit voluptas perferendis. Unde exercitationem corrupti deleniti et qui architecto. Nisi est totam et et alias adipisci quibusdam voluptatibus.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(13, 'Exercitationem enim vel sunt autem et eaque.', NULL, 'Cupiditate nemo sint minus perferendis. Ex est necessitatibus modi nam. Vel minima assumenda qui sequi. Velit culpa qui id magnam quas dignissimos. Maiores deleniti sit est deleniti aut laborum quod. Eveniet velit et sint nihil dignissimos. Soluta ex rerum consectetur et asperiores.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(14, 'Ex qui molestiae illum non facere.', NULL, 'Non harum quae placeat ipsam et officia distinctio ad. Impedit modi alias et odio amet ut est. Temporibus voluptatem placeat laborum facere doloribus maiores nihil. Distinctio ut nihil eligendi incidunt qui numquam consequatur. Quod quidem deleniti exercitationem recusandae rerum distinctio qui. Esse explicabo odit soluta laboriosam.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(15, 'Alias voluptatibus nam velit quis consequuntur voluptates.', NULL, 'Sapiente quia odit ut aut neque atque et. In rerum dicta et est veritatis quisquam. Quae enim provident eos est. Voluptates nihil nihil repudiandae eaque placeat asperiores deserunt. Dolor omnis veniam cum dolores tenetur modi numquam. Quos architecto consequatur eaque sit quod accusamus.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(16, 'Distinctio consequuntur maiores voluptatem ut.', NULL, 'Et ea quis incidunt non assumenda. Deleniti sapiente dolores in exercitationem et asperiores doloremque alias. Vitae dolore voluptatem id. Unde molestias sit repudiandae consequatur sit. Aut minus et et libero sed esse velit et.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(17, 'Ut ex soluta voluptatem.', NULL, 'Itaque consequuntur amet quaerat aperiam non ex impedit. Tenetur quibusdam eos iusto eos ut quia magni. Impedit cupiditate placeat commodi nemo voluptatem reprehenderit enim. Nulla harum quaerat minus fugiat eum nostrum. Optio exercitationem enim error nostrum libero dolorum.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(18, 'Ullam fuga repellendus aut esse quia explicabo est.', NULL, 'Impedit laborum consequatur libero est deserunt omnis consequatur atque. Ipsum a aperiam aut harum. Voluptas voluptatem dolore ratione ducimus corrupti quibusdam amet. Consectetur optio porro ea quia quia. Illum odit autem fugiat voluptatum nihil officiis. Praesentium eveniet autem perferendis numquam.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(19, 'Accusantium quia ut dignissimos unde doloribus pariatur.', NULL, 'Error beatae nihil incidunt modi ut tempora repellendus. Cum ducimus temporibus consectetur animi at. Dolorum omnis assumenda saepe temporibus possimus commodi. Totam dolorem libero quibusdam reprehenderit.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(20, 'Omnis id ipsa voluptatem beatae est libero quia harum.', NULL, 'Et at omnis omnis illum molestiae cum soluta consequatur. Ab molestiae ut possimus nihil. Quod incidunt libero voluptatem accusantium. Quis exercitationem dolor facilis praesentium. Eligendi et vero molestiae maiores.', NULL, 1, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(21, 'Rerum omnis autem molestiae.', NULL, 'Cupiditate cum laborum consequatur velit. Voluptatum doloribus ad vitae magni aut corrupti inventore dolore. Nihil nobis totam est animi eos. Consequatur quis natus doloremque ea doloribus temporibus. Eum mollitia perspiciatis natus atque. Qui ad voluptatibus consequatur assumenda. Ut qui non maxime culpa consequatur. Ducimus mollitia reprehenderit qui soluta laudantium beatae repellat.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(22, 'Aut ut culpa quaerat quaerat et.', NULL, 'Quibusdam quod facere nam occaecati. Quos et ad delectus corrupti. Veritatis officia dolor autem impedit. Itaque totam quos tempore illo. Impedit temporibus quia vitae. Quisquam quia enim amet non perferendis et. Quia quis nostrum ea ut.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(23, 'Cumque quia fugit facere.', NULL, 'Molestiae placeat autem fugiat omnis qui nihil doloribus. Quo ullam et ratione sit eos. Inventore est velit tempora autem excepturi. Et aut vitae eligendi eligendi laboriosam qui repellendus et. Ut rem blanditiis ullam et. Quibusdam sit ducimus est. Et suscipit ea quia nobis.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(24, 'Quia ut voluptatem qui laboriosam eligendi minima sint.', NULL, 'Assumenda quibusdam ipsa ducimus deleniti dolores molestiae. Odit quam repellendus tempore natus et ullam. Qui quae ipsam voluptas. Accusantium est temporibus et assumenda occaecati. Qui cum perferendis sequi est vel dolores et sapiente.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(25, 'Est occaecati dicta aliquid et.', NULL, 'Ipsum voluptatum reiciendis qui sunt aut cupiditate aspernatur. Exercitationem alias sequi beatae et ab. Pariatur placeat sapiente eos quae et. Natus qui numquam dolore suscipit.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(26, 'Et esse error eos earum sit laborum optio.', NULL, 'Iusto nisi beatae minima perferendis doloribus voluptates. Quibusdam dolores maxime magnam officiis. Vero iste omnis sed cum eos in porro quia. Quae illum impedit veritatis veritatis. Sapiente beatae in fugit provident perferendis. Assumenda blanditiis error repellendus rerum cupiditate. Et optio cumque dolorem natus quibusdam quidem error.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(27, 'Ratione officia laborum quis.', NULL, 'Nihil sit qui pariatur vel nihil accusamus ex. Quisquam temporibus nostrum ut nam saepe voluptas quo. At aut ullam ea alias temporibus soluta cum. Tenetur placeat voluptates et dolores voluptatem magnam.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(28, 'Quas temporibus asperiores nobis ea fuga illo quas.', NULL, 'Autem dolore tempora quia corporis id laboriosam. Veritatis repudiandae molestias aut aut adipisci maxime voluptatem. Deleniti laboriosam minima nulla assumenda. Nostrum nesciunt quidem esse ut eius ex est. Ullam maxime debitis tenetur ea. Consectetur fugiat ea velit at excepturi.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(29, 'Omnis ducimus aut minima eaque.', NULL, 'Et est non dolorem ab vero dolores iusto. Voluptate ea suscipit omnis sed. Quam ipsum voluptatum laborum occaecati. Velit error eos accusantium soluta nisi. Doloremque voluptas tenetur sed. Qui molestiae assumenda in velit voluptas ut porro.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(30, 'Earum totam et veniam autem consequatur dolorum iste reiciendis.', NULL, 'Minus officiis sunt harum dolores ut inventore. Aperiam dolor ea dolor. Id culpa aperiam accusantium modi unde labore magnam. Et dolorem neque deleniti veritatis. Veniam excepturi possimus laborum rerum. Ea et accusantium ad ut.', NULL, 1, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(31, 'Quod vero quo ipsa est ea fuga omnis voluptate.', NULL, 'Deleniti sit pariatur dolorem dolores molestiae a. Rerum sed numquam voluptatem qui. Eaque inventore nihil corrupti earum. Deserunt at veritatis aperiam qui debitis dolores aspernatur ut. Aut excepturi iste optio.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(32, 'Sit esse tempore voluptas neque.', NULL, 'Molestias voluptatum similique nam quas quis. Qui quis quia voluptatem quidem. Quia asperiores hic corrupti nobis in. Dignissimos sunt nobis consequatur reiciendis incidunt corporis laudantium. Similique dolor et repellat nisi corporis vitae.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(33, 'Dolorem necessitatibus tempore ex ipsa similique quia.', NULL, 'Ut quia aut consequatur corrupti. Quod voluptate dolorem et minus doloribus impedit dolore. Ea quibusdam sapiente recusandae enim voluptates et occaecati. Necessitatibus ut explicabo ipsam optio aut sed. Et alias eveniet nemo sint omnis accusantium.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(34, 'Et dolorem ut vitae eligendi sit fuga.', NULL, 'Eveniet nam qui ullam possimus est ipsam enim. Eos nemo quis porro aut rerum in qui doloribus. Quis veritatis aliquam et aperiam ipsa. Dolorem autem deserunt rerum. Velit eum rerum molestiae dolor ad nihil.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(35, 'Sunt odio ducimus quia rem voluptatem vero.', NULL, 'Porro quidem et molestiae ex error saepe. Ut unde blanditiis molestias ut eveniet illum qui debitis. Et mollitia ipsum architecto deserunt non autem repellat veniam. Sint esse occaecati laudantium ab et eos. Sed sequi iure laboriosam tempore et voluptatem et. Repudiandae itaque voluptatem est delectus nam et hic. Dolorum omnis voluptatibus corrupti qui quidem voluptate iure.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(36, 'Laborum illum at provident assumenda.', NULL, 'Cum est tenetur commodi et. Et eum maiores dignissimos provident. Molestiae non ratione eos sapiente qui reprehenderit. Est accusantium et assumenda voluptates odit aut ea pariatur.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(37, 'Consectetur corrupti et eveniet dolorem explicabo libero et rerum.', NULL, 'Qui id voluptatem accusamus fuga. Voluptatem voluptas sit labore odit. Adipisci quia sapiente assumenda dolores. Nam officia quo est sint qui iste. Beatae in inventore debitis culpa. Quod distinctio sint nesciunt et asperiores odio vero. Aut vel nihil ea quis vel inventore et.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(38, 'Ut consequatur numquam est itaque rerum.', NULL, 'Animi ullam omnis dolore iusto. Odit qui iste autem sint magnam nihil magni. Deserunt ipsa fuga molestias sit eos et. Labore et id molestias quis ullam officiis.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(39, 'Eum voluptate aliquam corrupti dignissimos voluptatem et.', NULL, 'Totam nihil enim non. Repudiandae delectus labore sit maxime cum est aliquid. Sint sit aperiam magnam nemo odio. Nulla eum et totam culpa rerum. Explicabo et sed voluptatem fugiat dolorem. Totam corrupti minus consequatur accusamus.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(40, 'Sit et temporibus cum eos.', NULL, 'Explicabo occaecati at quae ut. Officiis necessitatibus quo quia ratione. Et aut tenetur et impedit. Ea provident numquam voluptas minima. Maiores dignissimos nihil autem. Omnis vel iste voluptatem commodi. Placeat qui earum ut ipsa natus vero quia.', NULL, 1, '2014-11-28 22:44:21', '2014-11-28 22:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `ep_cctrs`
--

DROP TABLE IF EXISTS `ep_cctrs`;
CREATE TABLE `ep_cctrs` (
`id` int(10) NOT NULL,
  `cctr_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cctr_desc_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cctr_code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_id` int(10) NOT NULL,
  `org_id` int(10) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ep_cctrs`
--

INSERT INTO `ep_cctrs` (`id`, `cctr_desc`, `cctr_desc_2`, `cctr_code`, `entity_id`, `org_id`, `activated`) VALUES
(1, 'FAI Management', NULL, '420000', 1, 0, 1),
(2, 'Finance Management', NULL, '420010', 1, 0, 1),
(3, 'Admin Management', NULL, '420020', 1, 0, 1),
(4, 'HR Management', NULL, '420040', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ep_entities`
--

DROP TABLE IF EXISTS `ep_entities`;
CREATE TABLE `ep_entities` (
`id` int(8) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_in_short` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ep_groups`
--

DROP TABLE IF EXISTS `ep_groups`;
CREATE TABLE `ep_groups` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ep_groups`
--

INSERT INTO `ep_groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(2, 'Admin', '{"admin":1}', '2014-11-28 22:44:21', '2014-11-28 22:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `ep_migrations`
--

DROP TABLE IF EXISTS `ep_migrations`;
CREATE TABLE `ep_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ep_migrations`
--

INSERT INTO `ep_migrations` (`migration`, `batch`) VALUES
('2012_12_06_225921_migration_cartalyst_sentry_install_users', 1),
('2012_12_06_225929_migration_cartalyst_sentry_install_groups', 1),
('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', 1),
('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', 1),
('2014_11_28_082912_create_articles_table', 2),
('2014_11_28_083024_create_pages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ep_pages`
--

DROP TABLE IF EXISTS `ep_pages`;
CREATE TABLE `ep_pages` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ep_pages`
--

INSERT INTO `ep_pages` (`id`, `title`, `slug`, `body`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Sed dolor ut maxime.', NULL, 'A repellendus est vitae odit consectetur dolores. Alias quos aliquid corporis et aliquam temporibus facilis vitae. Eius id voluptas porro omnis quis. Earum totam quis nostrum iste iure. Voluptate laudantium unde illo omnis eum.', 3, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(3, 'Aliquam tempore fugit aperiam corporis minima omnis.', NULL, 'Sed quidem sit suscipit quia voluptatem. Corporis porro totam excepturi saepe eius provident. Non debitis unde cum enim eaque consequatur. Quasi nihil provident aut libero.', 3, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(5, 'Officia sed cupiditate et magni consequatur ut iure.', NULL, 'Et ut consequatur tenetur debitis similique. Facilis qui fugit ut sint velit repudiandae. Rerum veniam et quae deserunt est. Rerum quas consequatur aut ratione deserunt.', 3, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(6, 'Eaque quo architecto et voluptatem nesciunt repellat.', NULL, 'Velit voluptatum sed quia beatae dolore aut. Vitae quaerat dignissimos omnis corporis. Impedit ut eligendi sit et est reprehenderit est. Ullam incidunt qui totam ipsam non labore harum. Asperiores quos temporibus nostrum cum laudantium explicabo.', 3, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(7, 'Eveniet id ut laudantium natus repudiandae incidunt.', NULL, 'Cumque qui velit ea velit voluptate quasi explicabo non. Assumenda saepe laudantium repellendus recusandae consequatur eum temporibus. Molestiae vitae consequatur accusamus ad dolores qui. Reiciendis deleniti incidunt aut est ut nulla. Cum ut sunt qui occaecati voluptas doloremque. Esse ducimus voluptas rerum.', 3, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(8, 'Rem ducimus fugiat quos ut.', NULL, 'Sint sequi voluptas voluptatem excepturi. Praesentium non doloremque et qui. Qui et optio consectetur. Earum laboriosam eius autem est. Nulla fuga quis possimus voluptas.', 3, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(9, 'Tempore numquam asperiores velit aspernatur eius necessitatibus.', NULL, 'Atque omnis porro vel dolores. Dolores qui sit perferendis asperiores quidem in. Similique fugiat minus perspiciatis doloremque. Beatae labore ut adipisci eligendi quia.', 3, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(10, 'Illo modi et dolorum in.', NULL, 'Ducimus qui non illum est. Impedit ipsam id praesentium molestias assumenda enim. Et fugit reiciendis aliquam et inventore. Ducimus non nostrum fugiat perferendis et in amet. Quasi quo exercitationem maxime quo.', 3, '2014-11-28 02:24:53', '2014-11-28 02:24:53'),
(11, 'Ut est rem sint.', NULL, 'Itaque amet dolores nemo magni et reiciendis. Illum minus ea ea enim aut aliquid voluptas. Unde aut tempore doloremque vero voluptatibus earum. Enim maiores sit et dolor. Quae quis laboriosam placeat. Sed et consequatur in aut aut.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(12, 'Id vel est excepturi exercitationem excepturi ea.', NULL, 'Omnis culpa minima voluptatem expedita ex laborum quasi. Consequuntur velit ratione dolores consequuntur voluptatum hic ut. Incidunt optio voluptatem enim architecto pariatur minus. Impedit recusandae saepe magnam enim. Magni maiores ea cumque deserunt. Minima quo quaerat ut nemo quo perspiciatis. Est illo eum blanditiis quis labore libero.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(13, 'Exercitationem ipsa adipisci sit ullam pariatur molestiae.', NULL, 'Suscipit eveniet quo et quis. Qui facere perferendis placeat est dolorem doloremque est. Ducimus temporibus doloribus numquam quaerat veniam qui. Temporibus sit molestias rerum ea qui.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(14, 'Aut maiores ratione similique suscipit commodi.', NULL, 'Eum eum blanditiis fugit ad impedit est. Dolorem officiis praesentium autem. Temporibus sunt modi natus sunt. Nam sint libero eligendi autem velit eligendi fugit in. Veniam nam consequuntur et.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(15, 'Ut iusto et vel ipsam.', NULL, 'Quam et veniam quam culpa. Ut maiores quia dolorem velit modi blanditiis fugiat et. Suscipit sed numquam aliquam quia. Eum nihil hic minima quia laboriosam. At quos iure debitis sunt dicta incidunt.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(16, 'Sed consequatur modi fugiat illum.', NULL, 'Laborum dolorum architecto aut neque omnis aut aut. Qui earum amet est labore fuga aut quod. Totam quae atque voluptas et vitae est. Beatae omnis voluptates minima possimus non cupiditate illum. Eaque dolore dolore quos ut id omnis alias.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(17, 'Est eius rerum et harum deleniti.', NULL, 'Dolores animi quod aut harum. Et error molestias quod numquam doloremque vel quam. Et non ea atque nihil recusandae debitis neque quod. Totam explicabo aliquid illo cum architecto dolorem ducimus aliquam. Error tenetur exercitationem ex ducimus veritatis qui et. Sunt nemo eius maiores et.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(18, 'Dolorem ea neque neque.', NULL, 'Repudiandae unde aut cupiditate culpa impedit. Optio officia aperiam et aut et qui omnis. Excepturi perferendis illo cumque voluptatem. Sit possimus porro in sit est est. Sunt cum nam debitis. Accusamus vel tenetur dolore veniam doloremque.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(19, 'Incidunt sunt commodi laborum molestiae maxime sit.', NULL, 'Quia ducimus eveniet adipisci nesciunt ea. Sed recusandae autem aut id. Nemo quasi laudantium corrupti voluptas et. Nisi tenetur distinctio molestiae harum at. Quibusdam ea numquam quia aut.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(20, 'Unde odio voluptatum officia sequi deserunt totam.', NULL, 'Cumque vel iusto ullam velit. Facilis omnis neque aspernatur aut eius. Earum harum suscipit nulla. Optio veniam magni in. Tenetur velit dignissimos vel expedita ut.', 3, '2014-11-28 22:43:00', '2014-11-28 22:43:00'),
(21, 'Consequatur dignissimos cumque et doloremque enim.', NULL, 'Aut possimus soluta et omnis iste. In eligendi labore velit neque et sunt. Voluptates repudiandae doloremque vero aut et. Necessitatibus delectus molestiae est. Dolor consequatur atque aspernatur molestias aut fugiat. Molestiae rerum ab voluptas deleniti ratione rem.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(22, 'Rerum necessitatibus praesentium voluptatem molestiae quae.', NULL, 'Sit libero enim voluptatem aliquid nesciunt. Velit velit facere quo mollitia delectus aliquam dignissimos aut. Velit eaque soluta natus autem. Facilis adipisci tenetur voluptatem omnis est. Ut nam at vel. Est itaque quasi quasi sint ut.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(23, 'Voluptas corrupti fugit facilis nesciunt tenetur in.', NULL, 'Nisi dolor et eos quaerat pariatur repellendus omnis. Sapiente tenetur itaque voluptas enim voluptatum quisquam. Molestias voluptatem sed aperiam deserunt modi eos. Sint repudiandae quibusdam illum fugit fuga. Consequatur officiis ratione a dolor ullam unde possimus quasi.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(24, 'Sit doloribus doloremque corporis laborum est consequuntur rerum.', NULL, 'Fugit placeat voluptas sed laboriosam illo blanditiis. Corporis mollitia sequi debitis veniam sed exercitationem temporibus. Illo qui harum neque. Et laboriosam nisi in in id. Ut iste numquam enim omnis voluptatem qui exercitationem. Ut non sint itaque totam explicabo accusantium illum.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(25, 'Sed dolorem ea molestiae nostrum sit deserunt.', NULL, 'Sit ab voluptatem sunt libero aut. Suscipit nostrum dolor libero quos ea. Aut omnis error ex est aut ut. Repudiandae minus esse ullam deleniti voluptate enim quia. Ut ipsam enim ut qui et. Fugiat et corporis placeat non quo et.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(26, 'Eligendi autem sunt consequuntur quae voluptate voluptate.', NULL, 'Id laborum dolorum corporis. In consectetur vitae a debitis non ea. Qui molestiae eos rerum dolor ipsam libero sapiente. Aut quia consequuntur doloremque ad quis. Nobis aut neque dolores pariatur. Doloremque dolore ratione expedita itaque similique itaque distinctio. Explicabo et blanditiis facere maxime aperiam nobis.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(27, 'Praesentium sapiente numquam voluptas ullam.', NULL, 'Laudantium voluptatem quia et sapiente. Veniam veritatis vero molestias molestiae dolorem. Sunt rem atque dignissimos non totam. Ipsam commodi natus cumque enim harum. Cumque molestiae minus debitis aut sapiente quae. Iusto fugiat dolor quia ut tenetur.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(28, 'Fuga ut culpa velit tenetur.', NULL, 'Expedita iusto harum numquam et est. Accusantium culpa ipsam eum sint autem cum rerum. Qui inventore possimus accusantium impedit est quae. Corrupti rem aut delectus debitis qui aspernatur qui. Sit aut aliquid voluptas aut. Suscipit sit sit quaerat hic et quis non. Incidunt enim ipsam id voluptatibus aliquam voluptas qui.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(29, 'Delectus dolores quis qui exercitationem.', NULL, 'Quisquam quae incidunt harum et odio aliquam ducimus iste. Veniam ut omnis voluptatem excepturi nihil recusandae. Dolorum occaecati non vel et et. Distinctio nihil minus autem est reprehenderit omnis. Voluptas possimus eum est libero qui.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(30, 'Non provident laboriosam voluptas provident ratione.', NULL, 'Nihil nobis suscipit similique in fugiat sunt laborum. Accusantium delectus ipsam quam doloribus ea dolor. Quasi dolor molestiae adipisci vel. Officiis consequuntur voluptatem omnis non ex consectetur optio corporis. Blanditiis aut accusantium impedit qui. Ut eum cum est illo culpa similique.', 3, '2014-11-28 22:43:27', '2014-11-28 22:43:27'),
(31, 'Fugiat omnis consectetur sint commodi velit sunt.', NULL, 'Et sunt eveniet quidem dolores. Delectus hic odio consequuntur est illum. Perferendis eveniet veritatis aperiam in. Vitae veniam illo ipsa at quod aspernatur aut. Dolorem at nam dolorem sint libero vero sit.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(32, 'Ut laudantium quis recusandae vitae doloremque possimus.', NULL, 'Nemo quibusdam placeat aut qui provident beatae nulla. Excepturi molestiae excepturi placeat non omnis quo praesentium. Unde nesciunt optio pariatur non voluptate. Vitae debitis autem laborum eligendi at cumque. Accusantium nobis est aut at voluptas repellendus. Aut reiciendis neque qui praesentium vero nesciunt ex sint.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(33, 'Cum ducimus suscipit commodi et possimus quis ut.', NULL, 'Cumque consequatur voluptas est et. Inventore quam corporis officia sit culpa at omnis. Dolorem sint consequuntur rerum quas qui saepe natus. Qui officiis facilis sint accusantium. Cumque dolor molestiae aut sed.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(34, 'Quia odio omnis saepe voluptas voluptas maxime non omnis.', NULL, 'Iusto optio sequi et repudiandae ipsa odit occaecati. Repellat blanditiis eligendi asperiores ipsam asperiores sint ut. Quas et fuga sequi. Omnis quis harum vel aut.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(35, 'Magnam rerum nihil distinctio dolor porro magnam ex deleniti.', NULL, 'Non doloribus quae ratione tempore unde. Reiciendis enim est et molestiae non tenetur. Illo soluta perspiciatis est inventore sed ut occaecati. Ut eum vitae eum ut.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(36, 'Odio odio labore sit cumque.', NULL, 'Eius non vitae cum corporis. Provident aut voluptas explicabo alias voluptatem. Id quo qui corporis blanditiis voluptatem sed voluptate. Facilis magnam molestias doloremque est. Labore eum doloremque facere facilis vero dolores quo. Rem porro sapiente odit dolore culpa occaecati eveniet.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(37, 'Ut voluptatem aut et velit nisi voluptas.', NULL, 'Dolore nobis sit debitis itaque officia. Repudiandae tenetur atque ea quidem quia ipsa. Enim nihil labore qui aspernatur. Ducimus quaerat ipsum recusandae quidem cupiditate accusamus sapiente vitae.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(38, 'Amet molestiae omnis expedita atque esse nisi omnis aperiam.', NULL, 'Quam alias ducimus nostrum ut eum et a enim. Dicta non hic excepturi et. Facilis quia et amet et rerum omnis non. Optio exercitationem laboriosam commodi ut in.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(39, 'Est molestias illum delectus.', NULL, 'Deleniti aspernatur praesentium repudiandae aliquid maiores. Praesentium rerum itaque doloribus dolores. Fuga officia voluptas numquam dolorem aut. Aut sint eos id dolor et quia nihil. Dolores iste unde ut sint animi repellat. Aut consequatur consequatur omnis blanditiis officia voluptates. Sed sequi iure magnam nostrum.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(40, 'Dolores voluptas molestiae eius alias mollitia voluptatibus.', NULL, 'Est voluptas dignissimos ut ut fuga sed rerum est. Minima omnis esse voluptatem placeat nam aut recusandae. Quo nihil reprehenderit laborum officiis deleniti a debitis. Natus qui quas porro qui est ipsam. Dolorem quis fugit doloremque cum et animi.', 3, '2014-11-28 22:44:21', '2014-11-28 22:44:21'),
(41, 'testg', NULL, 'dfzrghdfzhbdfzg', 3, '2014-12-11 23:51:43', '2014-12-11 23:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `ep_payments`
--

DROP TABLE IF EXISTS `ep_payments`;
CREATE TABLE `ep_payments` (
`id` bigint(20) unsigned NOT NULL,
  `created_by_user` int(10) DEFAULT NULL,
  `payee_id` int(11) DEFAULT NULL,
  `payer_id` int(11) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `currency` int(3) NOT NULL DEFAULT '1',
  `amount_in_local_currency` double NOT NULL DEFAULT '0',
  `vat_amount` float DEFAULT NULL,
  `related_pmt_id` bigint(20) DEFAULT NULL,
  `type` int(3) NOT NULL DEFAULT '1',
  `invoice_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `order_number` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urgency` int(2) NOT NULL DEFAULT '0',
  `pmt_date_plan` date DEFAULT NULL,
  `pmt_date_actual` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `attachement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ep_pmt_matrix`
--

DROP TABLE IF EXISTS `ep_pmt_matrix`;
CREATE TABLE `ep_pmt_matrix` (
`id` bigint(20) unsigned NOT NULL,
  `pmt_id` bigint(20) NOT NULL,
  `cctr_id` int(10) DEFAULT NULL,
  `acct_id` int(10) DEFAULT NULL,
  `amount_original` double NOT NULL DEFAULT '0',
  `amount_final` double NOT NULL DEFAULT '0',
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ep_throttle`
--

DROP TABLE IF EXISTS `ep_throttle`;
CREATE TABLE `ep_throttle` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ep_throttle`
--

INSERT INTO `ep_throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, '::1', 1, 0, 0, '2014-11-28 22:21:45', NULL, NULL),
(2, 3, '::1', 0, 0, 0, NULL, NULL, NULL),
(3, 3, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ep_users`
--

DROP TABLE IF EXISTS `ep_users`;
CREATE TABLE `ep_users` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ep_users`
--

INSERT INTO `ep_users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(3, 'wayhi@163.com ', '$2y$10$J9u.q3l0iryaE80h58cnye18mt34GkXtxBn3t8JmBhX/F6otBCoey', NULL, 1, NULL, NULL, '2014-12-20 02:21:45', '$2y$10$wzV4/MyxhB2YRa0zahtEHOSNtnaBRK02jU4QTtH69LeN0pMxdIoj.', NULL, 'James', 'Wang', '2014-11-28 22:44:21', '2014-12-20 02:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `ep_users_groups`
--

DROP TABLE IF EXISTS `ep_users_groups`;
CREATE TABLE `ep_users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ep_users_groups`
--

INSERT INTO `ep_users_groups` (`user_id`, `group_id`) VALUES
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ep_vendor`
--

DROP TABLE IF EXISTS `ep_vendor`;
CREATE TABLE `ep_vendor` (
`id` int(16) NOT NULL,
  `vendor_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_name_short` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `group_id` int(8) DEFAULT NULL,
  `created_by_user` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by_user` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `ep_v_account_options`
--
DROP VIEW IF EXISTS `ep_v_account_options`;
CREATE TABLE `ep_v_account_options` (
`id` int(15)
,`acct_options` varchar(274)
,`type` int(3)
,`entity_id` int(15)
,`org_id` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ep_v_cctr_options`
--
DROP VIEW IF EXISTS `ep_v_cctr_options`;
CREATE TABLE `ep_v_cctr_options` (
`id` int(10)
,`cctr_options` varchar(271)
,`cctr_options_2` varchar(271)
,`entity_id` int(10)
,`org_id` int(10)
);
-- --------------------------------------------------------

--
-- Structure for view `ep_v_account_options`
--
DROP TABLE IF EXISTS `ep_v_account_options`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `easyprocess`.`ep_v_account_options` AS select `easyprocess`.`ep_accounts`.`id` AS `id`,concat(`easyprocess`.`ep_accounts`.`acct_code`,'-',`easyprocess`.`ep_accounts`.`acct_desc`) AS `acct_options`,`easyprocess`.`ep_accounts`.`type` AS `type`,`easyprocess`.`ep_accounts`.`entity_id` AS `entity_id`,`easyprocess`.`ep_accounts`.`org_id` AS `org_id` from `easyprocess`.`ep_accounts` where (`easyprocess`.`ep_accounts`.`activated` = 1);

-- --------------------------------------------------------

--
-- Structure for view `ep_v_cctr_options`
--
DROP TABLE IF EXISTS `ep_v_cctr_options`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `easyprocess`.`ep_v_cctr_options` AS select `easyprocess`.`ep_cctrs`.`id` AS `id`,concat(`easyprocess`.`ep_cctrs`.`cctr_code`,'-',`easyprocess`.`ep_cctrs`.`cctr_desc`) AS `cctr_options`,concat(`easyprocess`.`ep_cctrs`.`cctr_code`,'-',`easyprocess`.`ep_cctrs`.`cctr_desc_2`) AS `cctr_options_2`,`easyprocess`.`ep_cctrs`.`entity_id` AS `entity_id`,`easyprocess`.`ep_cctrs`.`org_id` AS `org_id` from `easyprocess`.`ep_cctrs` where (`easyprocess`.`ep_cctrs`.`activated` = 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ep_accounts`
--
ALTER TABLE `ep_accounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ep_approval_matrix`
--
ALTER TABLE `ep_approval_matrix`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `ep_articles`
--
ALTER TABLE `ep_articles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ep_cctrs`
--
ALTER TABLE `ep_cctrs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ep_entities`
--
ALTER TABLE `ep_entities`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ep_groups`
--
ALTER TABLE `ep_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indexes for table `ep_pages`
--
ALTER TABLE `ep_pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ep_payments`
--
ALTER TABLE `ep_payments`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ep_pmt_matrix`
--
ALTER TABLE `ep_pmt_matrix`
 ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ep_throttle`
--
ALTER TABLE `ep_throttle`
 ADD PRIMARY KEY (`id`), ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `ep_users`
--
ALTER TABLE `ep_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD KEY `users_activation_code_index` (`activation_code`), ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- Indexes for table `ep_users_groups`
--
ALTER TABLE `ep_users_groups`
 ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `ep_vendor`
--
ALTER TABLE `ep_vendor`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ep_accounts`
--
ALTER TABLE `ep_accounts`
MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ep_approval_matrix`
--
ALTER TABLE `ep_approval_matrix`
MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ep_articles`
--
ALTER TABLE `ep_articles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `ep_cctrs`
--
ALTER TABLE `ep_cctrs`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ep_entities`
--
ALTER TABLE `ep_entities`
MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ep_groups`
--
ALTER TABLE `ep_groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ep_pages`
--
ALTER TABLE `ep_pages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `ep_payments`
--
ALTER TABLE `ep_payments`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ep_pmt_matrix`
--
ALTER TABLE `ep_pmt_matrix`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ep_throttle`
--
ALTER TABLE `ep_throttle`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ep_users`
--
ALTER TABLE `ep_users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ep_vendor`
--
ALTER TABLE `ep_vendor`
MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
