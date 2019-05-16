<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DevelopmentMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        \DB::statement('
          CREATE TABLE IF NOT EXISTS `consignments` (
          `BOL` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'CONSIGNMENT ID / BOL#\',
          `value` decimal(10,2) NOT NULL,
          `exchange_rate` float NOT NULL,
          `tax` decimal(10,2) NOT NULL DEFAULT \'0.00\',
          `land_date` date NOT NULL,
          `lc` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
          `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `updated_at` timestamp NULL DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');



        \DB::statement('
          INSERT INTO `consignments` (`BOL`, `value`, `exchange_rate`, `tax`, `land_date`, `lc`, `created_at`, `updated_at`) VALUES
          (\'COAU7040755540\', \'13535.60\', 79, \'26583.00\', \'2016-12-30\', \'350316010267\', \'2017-07-12 08:55:37\', \'2017-07-12 08:55:37\');
        ');


        \DB::statement('
          CREATE TABLE IF NOT EXISTS `consignment_containers` (
  `Container_num` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `BOL` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        
        
        ');



        \DB::statement('
          
          INSERT INTO `consignment_containers` (`Container_num`, `BOL`, `created_at`, `updated_at`) VALUES
(\'FCIU5053430/K37917\', \'COAU7040755540\', \'2017-07-12 09:03:09\', \'2017-07-12 09:03:09\');

        
        ');

        \DB::statement('
          CREATE TABLE IF NOT EXISTS `consignment_expenses` (
  `BOL` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `expense_id` int(11) NOT NULL,
  `expense_foreign` decimal(10,2) NOT NULL DEFAULT \'0.00\',
  `expense_local` decimal(10,2) NOT NULL DEFAULT \'0.00\',
  `expense_notes` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
          
        ');
        \DB::statement('
        
INSERT INTO `consignment_expenses` (`BOL`, `expense_id`, `expense_foreign`, `expense_local`, `expense_notes`, `created_at`, `updated_at`) VALUES
(\'COAU7040755540\', 5, \'200.00\', \'500.00\', \'A dummy expense\', \'2017-07-12 09:44:26\', \'2017-07-12 09:44:26\');
        
        ');
        \DB::statement('
          CREATE TABLE IF NOT EXISTS `container_contents` (
  `Container_num` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `BOL` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tyre_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT \'1\',
  `unit_price` decimal(7,3) NOT NULL,
  `total_tax` decimal(7,3) NOT NULL DEFAULT \'0.000\',
  `total_weight` decimal(7,3) NOT NULL DEFAULT \'0.000\',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');
        \DB::statement('
          INSERT INTO `container_contents` (`Container_num`, `BOL`, `tyre_id`, `qty`, `unit_price`, `total_tax`, `total_weight`, `created_at`, `updated_at`) VALUES
(\'FCIU5053430/K37917\', \'COAU7040755540\', 1, 20, \'12.500\', \'9999.999\', \'7500.000\', \'2017-07-12 09:03:09\', \'2017-07-12 09:03:09\'),
(\'FCIU5053430/K37917\', \'COAU7040755540\', 2, 20, \'13.000\', \'9999.999\', \'7000.000\', \'2017-07-12 09:03:09\', \'2017-07-12 09:03:09\');
        ');
        \DB::statement('
          CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        
        ');
        \DB::statement('
          INSERT INTO `customers` (`id`, `name`, `address`, `phone`, `notes`, `created_at`, `updated_at`) VALUES
(5, \'First Customer\', \'1 Address road\', \'5677876\', \'Some note.\', \'2017-07-12 10:01:09\', \'2017-07-12 10:01:09\');
        ');
        \DB::statement('
        CREATE TABLE IF NOT EXISTS `hscodes` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');
        \DB::statement('
        INSERT INTO `hscodes` (`id`, `created_at`, `updated_at`) VALUES
(\'HSCODE1\', \'2017-05-10 11:10:26\', \'2017-05-10 11:10:26\'),
(\'HSCODE2\', \'2017-05-10 11:16:33\', \'2017-05-10 11:16:33\');
        ');
        \DB::statement('
        CREATE TABLE IF NOT EXISTS `lcs` (
  `lc_num` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `date_issued` date NOT NULL,
  `date_expiry` date NOT NULL,
  `applicant` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `beneficiary` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'USD\',
  `foreign_amount` decimal(10,2) NOT NULL,
  `foreign_expense` decimal(10,2) NOT NULL DEFAULT \'0.00\',
  `domestic_expense` decimal(10,2) NOT NULL DEFAULT \'0.00\',
  `exchange_rate` decimal(5,2) NOT NULL DEFAULT \'1.00\',
  `port_depart` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'ENTER PORT\',
  `port_arrive` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'ENTER PORT\',
  `invoice_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');
        \DB::statement('
        INSERT INTO `lcs` (`lc_num`, `date_issued`, `date_expiry`, `applicant`, `beneficiary`, `currency_code`, `foreign_amount`, `foreign_expense`, `domestic_expense`, `exchange_rate`, `port_depart`, `port_arrive`, `invoice_no`, `notes`, `created_at`, `updated_at`) VALUES
(\'350316010267\', \'2016-12-22\', \'2017-03-16\', \'M/S. Intertrac Nano\r\n7/5 RIng Road Shyamoly,\r\nDhaka-1207, Bangladesh.\', \'Qingdao Keter International Co. Ltd. \r\nADD: 2-1401, Shenghe Mansion,\r\nNo. 58 Shandongtou Road, Qingd\', \'USD\', \'29736.20\', \'0.00\', \'0.00\', \'60.00\', \'Any seaport of China\', \'ICD Kamlapur Dhaka Via Chittag\', \'KT162N04FY177LI72/946\', \'Qingdao Phone# +86-532-55579147\', \'2017-07-11 07:26:39\', \'2017-07-11 07:26:39\');
        ');
//        \DB::statement('
//        CREATE TABLE IF NOT EXISTS `migrations` (
//  `id` int(10) unsigned NOT NULL,
//  `migration` varchar(255) NOT NULL,
//  `batch` int(11) NOT NULL
//) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
//        ');
//        \DB::statement('
//        INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
//(1, \'2014_10_12_000000_create_users_table\', 1),
//(2, \'2014_10_12_100000_create_password_resets_table\', 1);
//        ');
        \DB::statement('
        CREATE TABLE IF NOT EXISTS `orders` (
  `Order_num` bigint(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `discount_percent` decimal(5,2) NOT NULL DEFAULT \'0.00\',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT \'0.00\',
  `tax_percentage` decimal(5,2) NOT NULL DEFAULT \'0.00\',
  `tax_amount` decimal(10,2) NOT NULL DEFAULT \'0.00\',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');
        \DB::statement('
        INSERT INTO `orders` (`Order_num`, `customer_id`, `discount_percent`, `discount_amount`, `tax_percentage`, `tax_amount`, `created_at`, `updated_at`) VALUES
(33, 5, \'10.00\', \'50.00\', \'15.00\', \'0.00\', \'2017-07-12 10:02:58\', \'2017-07-12 10:02:58\'),
(34, 5, \'0.00\', \'0.00\', \'15.00\', \'0.00\', \'2017-07-12 10:08:01\', \'2017-07-12 10:08:01\'),
(35, 5, \'0.00\', \'0.00\', \'0.00\', \'100.00\', \'2017-07-19 04:45:29\', \'2017-07-19 04:45:29\');
        ');
        \DB::statement('
        CREATE TABLE IF NOT EXISTS `order_contents` (
  `Order_num` bigint(20) NOT NULL,
  `tyre_id` int(11) NOT NULL,
  `container_num` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bol` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL DEFAULT \'1\',
  `unit_price` decimal(7,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');
        \DB::statement('INSERT INTO `order_contents` (`Order_num`, `tyre_id`, `container_num`, `bol`, `qty`, `unit_price`, `created_at`, `updated_at`) VALUES
(33, 1, \'FCIU5053430/K37917\', \'COAU7040755540\', 5, \'500.00\', \'2017-07-12 10:02:59\', \'2017-07-12 10:02:59\'),
(33, 2, \'FCIU5053430/K37917\', \'COAU7040755540\', 5, \'1000.00\', \'2017-07-12 10:02:59\', \'2017-07-12 10:02:59\'),
(34, 1, \'FCIU5053430/K37917\', \'COAU7040755540\', 5, \'750.00\', \'2017-07-12 10:08:01\', \'2017-07-12 10:08:01\'),
(35, 2, \'FCIU5053430/K37917\', \'COAU7040755540\', 5, \'450.00\', \'2017-07-19 04:45:29\', \'2017-07-19 04:45:29\');');

        \DB::statement('
        CREATE TABLE IF NOT EXISTS `password_resets` (
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ');
        \DB::statement('
        INSERT INTO `password_resets` (`username`, `token`, `created_at`, `email`) VALUES
(\'\', \'$2y$10$mNaRi05MLw5RHUV3Di/4A.DNQ0c4kStG2J03/yreR9D5ipO1qNmua\', \'2017-07-03 07:40:41\', \'tshahriyer@gmail.com\');
        ');
        \DB::statement('
          CREATE TABLE IF NOT EXISTS `payments` (
  `Invoice_num` bigint(20) unsigned zerofill NOT NULL,
  `Order_num` bigint(20) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL DEFAULT \'0.00\',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');
        \DB::statement('
          INSERT INTO `payments` (`Invoice_num`, `Order_num`, `payment_amount`, `created_at`, `updated_at`) VALUES
(00000000000000000005, 33, \'1000.00\', \'2017-07-12 10:09:53\', \'2017-07-12 10:09:53\'),
(00000000000000000006, 33, \'6825.00\', \'2017-07-17 22:58:05\', \'2017-07-17 22:58:05\'),
(00000000000000000007, 35, \'2000.00\', \'2017-07-19 04:47:22\', \'2017-07-19 04:47:22\');
        ');
        \DB::statement('
        CREATE TABLE IF NOT EXISTS `performa_invoices` (
  `lc_num` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tyre_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT \'1\',
  `unit_price` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');
        \DB::statement('
        INSERT INTO `performa_invoices` (`lc_num`, `tyre_id`, `qty`, `unit_price`, `created_at`, `updated_at`) VALUES
(\'350316010267\', 1, 30, \'12.10\', \'2017-07-11 10:27:20\', \'2017-07-11 10:27:20\'),
(\'350316010267\', 2, 60, \'14.60\', \'2017-07-11 10:27:20\', \'2017-07-11 10:27:20\'),
(\'350316010267\', 3, 50, \'15.70\', \'2017-07-11 10:27:20\', \'2017-07-11 10:27:20\'),
(\'350316010267\', 4, 60, \'15.20\', \'2017-07-11 10:27:20\', \'2017-07-11 10:27:20\'),
(\'350316010267\', 5, 60, \'15.00\', \'2017-07-11 10:27:21\', \'2017-07-11 10:27:21\'),
(\'350316010267\', 6, 30, \'16.00\', \'2017-07-11 10:39:16\', \'2017-07-11 10:39:16\'),
(\'350316010267\', 7, 320, \'18.10\', \'2017-07-12 06:58:08\', \'2017-07-12 06:58:08\'),
(\'350316010267\', 8, 20, \'19.40\', \'2017-07-12 06:58:08\', \'2017-07-12 06:58:08\'),
(\'350316010267\', 9, 16, \'18.20\', \'2017-07-12 06:58:08\', \'2017-07-12 06:58:08\'),
(\'350316010267\', 10, 20, \'22.50\', \'2017-07-12 06:58:08\', \'2017-07-12 06:58:08\'),
(\'350316010267\', 11, 150, \'18.50\', \'2017-07-12 06:58:08\', \'2017-07-12 06:58:08\'),
(\'350316010267\', 12, 150, \'19.50\', \'2017-07-12 06:58:09\', \'2017-07-12 06:58:09\'),
(\'350316010267\', 13, 16, \'21.30\', \'2017-07-12 06:58:09\', \'2017-07-12 06:58:09\'),
(\'350316010267\', 14, 16, \'26.20\', \'2017-07-12 06:58:09\', \'2017-07-12 06:58:09\'),
(\'350316010267\', 15, 16, \'24.20\', \'2017-07-12 06:58:09\', \'2017-07-12 06:58:09\'),
(\'350316010267\', 16, 12, \'25.20\', \'2017-07-12 06:58:09\', \'2017-07-12 06:58:09\'),
(\'350316010267\', 17, 16, \'31.20\', \'2017-07-12 06:58:09\', \'2017-07-12 06:58:09\'),
(\'350316010267\', 18, 16, \'40.20\', \'2017-07-12 06:58:10\', \'2017-07-12 06:58:10\'),
(\'350316010267\', 19, 300, \'27.60\', \'2017-07-12 06:58:10\', \'2017-07-12 06:58:10\');

        ');
        \DB::statement('
        CREATE TABLE IF NOT EXISTS `tyres` (
  `tyre_id` int(11) NOT NULL,
  `brand` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'INTERTRAC\',
  `size` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `lisi` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pattern` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ');
        \DB::statement('
        INSERT INTO `tyres` (`tyre_id`, `brand`, `size`, `lisi`, `pattern`, `created_at`, `updated_at`) VALUES
(1, \'BRIGHTWAY\', \'145R12LT/C\', \'8PR\', \'LRP178\', \'2017-07-11 08:30:04\', \'2017-07-11 08:30:04\'),
(2, \'BRIGHTWAY\', \'155R13LT\', \'8PR\', \'LRP118\', \'2017-07-11 08:31:07\', \'2017-07-11 08:31:07\'),
(3, \'BRIGHTWAY\', \'165R13LT\', \'8PR\', \'LRP118\', \'2017-07-11 03:35:59\', \'2017-07-11 03:35:59\'),
(4, \'SPORTRAK\', \'165/80R13\', \'83H\', \'FRD16\', \'2017-07-11 03:35:59\', \'2017-07-11 03:35:59\'),
(5, \'INTERTRAC\', \'175/70R13\', \'82T\', \'TC515\', \'2017-07-11 03:37:37\', \'2017-07-11 03:37:37\'),
(6, \'INTERTRAC\', \'175/70R14\', \'84H\', \'TC515\', \'2017-07-11 03:37:37\', \'2017-07-11 03:37:37\'),
(7, \'INTERTRAC\', \'185/70R14\', \'88H\', \'TC515\', \'2017-07-11 03:41:31\', \'2017-07-11 03:41:31\'),
(8, \'INTERTRAC\', \'195/70R14\', \'91H\', \'TC515\', \'2017-07-11 03:41:31\', \'2017-07-11 03:41:31\'),
(9, \'INTERTRAC\', \'195/55R15\', \'85V\', \'TC515\', \'2017-07-11 03:42:56\', \'2017-07-11 03:42:56\'),
(10, \'INTERTRAC\', \'205/60R\', \'91H\', \'TC515\', \'2017-07-11 03:42:56\', \'2017-07-11 03:42:56\'),
(11, \'INTERTRAC\', \'185/65R16\', \'88H\', \'TC515\', \'2017-07-11 03:48:57\', \'2017-07-11 03:48:57\'),
(12, \'INTERTRAC\', \'195/65R16\', \'91V\', \'TC515\', \'2017-07-11 03:48:57\', \'2017-07-11 03:48:57\'),
(13, \'INTERTRAC\', \'205/50ZR16\', \'87W\', \'TC515\', \'2017-07-11 03:50:52\', NULL),
(14, \'INTERTRAC\', \'215/65R16\', \'98H\', \'TC515\', \'2017-07-11 03:50:52\', \'2017-07-11 03:50:52\'),
(15, \'INTERTRAC\', \'225/40ZR18\', \'92WXL\', \'TC525\', \'2017-07-11 03:53:28\', \'2017-07-11 03:53:28\'),
(16, \'INTERTRAC\', \'225/45ZR18\', \'95WXL\', \'TC525\', \'2017-07-11 03:53:28\', \'2017-07-11 03:53:28\'),
(17, \'INTERTRAC\', \'225/65R17\', \'106H\', \'TC565\', \'2017-07-11 03:56:07\', \'2017-07-11 03:56:07\'),
(18, \'INTERTRAC\', \'265/65R17\', \'116H\', \'TC565\', \'2017-07-11 03:56:07\', \'2017-07-11 03:56:07\'),
(19, \'INTERTRAC\', \'195R16C-8PR\', \'106/104S\', \'TC595\', \'2017-07-11 03:57:11\', \'2017-07-11 03:57:11\');

        ');
        \DB::statement('
        CREATE TABLE IF NOT EXISTS `tyre_hscodes` (
  `tyre_id` int(11) NOT NULL,
  `hscode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

        ');
        \DB::statement('
        CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT \'0\',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
        ');
        \DB::statement('
        INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, \'Ishtehar Hussain\', \'ishteharhussain@gmail.com\', \'$2y$10$ZsrubQE/5LYr5VHPGlexcOKOOnAdzkGrx8.AgIGrlTghK5H7kzwwa\', 1, \'Y5EUmH3dVSbzv6yjomeYP5cqXqKs9rbg839jUePJk0nqNgufPJW60gg6ueMA\', NULL, \'2017-07-11 08:17:07\'),
(2, \'Ovi\', \'x.e.q.tionrz@gmail.com\', \'asdfsfdsd\', 0, \'ddasasadsda\', NULL, NULL);
        ');
        \DB::statement('ALTER TABLE `consignments`
  ADD PRIMARY KEY (`BOL`), ADD KEY `fk_LCconsignments_idx` (`lc`);
');
        \DB::statement('ALTER TABLE `consignment_containers`
  ADD PRIMARY KEY (`Container_num`,`BOL`), ADD KEY `fk_CONSIGNMENTcontainer_idx` (`BOL`);
');
        \DB::statement('ALTER TABLE `consignment_expenses`
  ADD PRIMARY KEY (`expense_id`), ADD KEY `fk_CONSIGNMENTexpenses_idx` (`BOL`);');
        \DB::statement('ALTER TABLE `container_contents`
  ADD PRIMARY KEY (`Container_num`,`BOL`,`tyre_id`), ADD KEY `fk_TYREcontents_idx` (`tyre_id`);');
        \DB::statement('ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);');
        \DB::statement('ALTER TABLE `hscodes`
  ADD PRIMARY KEY (`id`);');
        \DB::statement('ALTER TABLE `lcs`
  ADD PRIMARY KEY (`lc_num`), ADD UNIQUE KEY `LC_invoice#_UNIQUE` (`invoice_no`);');
//        \DB::statement('ALTER TABLE `migrations`
//  ADD PRIMARY KEY (`id`);');
        \DB::statement('ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_num`), ADD KEY `fk_CUSTOMERorder_idx` (`customer_id`);');
        \DB::statement('ALTER TABLE `order_contents`
  ADD PRIMARY KEY (`Order_num`,`tyre_id`,`container_num`,`bol`), ADD KEY `fk_ORDERcontainer_idx` (`tyre_id`,`container_num`,`bol`);
');
        \DB::statement('ALTER TABLE `password_resets`
  ADD KEY `password_resets_username_index` (`username`);
');
        \DB::statement('ALTER TABLE `payments`
  ADD PRIMARY KEY (`Invoice_num`), ADD KEY `fk_ORDERSpayment_idx` (`Order_num`);
');
        \DB::statement('ALTER TABLE `performa_invoices`
  ADD PRIMARY KEY (`lc_num`,`tyre_id`), ADD KEY `fk_TYRE_idx` (`tyre_id`);
');
        \DB::statement('ALTER TABLE `tyres`
  ADD PRIMARY KEY (`tyre_id`), ADD UNIQUE KEY `unique_tyre` (`brand`,`size`,`lisi`,`pattern`);
');
        \DB::statement('ALTER TABLE `tyre_hscodes`
  ADD KEY `fk_TYRE_idx` (`tyre_id`), ADD KEY `fk_HSCODE_idx` (`hscode`);
');
        \DB::statement('ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
');
        \DB::statement('ALTER TABLE `consignment_expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
');
        \DB::statement('ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;');

//        \DB::statement('ALTER TABLE `migrations`
//  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;');

        \DB::statement('ALTER TABLE `orders`
  MODIFY `Order_num` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;');

        \DB::statement('ALTER TABLE `payments`
  MODIFY `Invoice_num` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
');

        \DB::statement('ALTER TABLE `tyres`
  MODIFY `tyre_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;');

        \DB::statement('ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;');

        \DB::statement('ALTER TABLE `consignments`
ADD CONSTRAINT `fk_LCconsignments` FOREIGN KEY (`lc`) REFERENCES `lcs` (`lc_num`) ON UPDATE CASCADE;');

        \DB::statement('ALTER TABLE `consignment_containers`
ADD CONSTRAINT `fk_CONSIGNMENTcontainer` FOREIGN KEY (`BOL`) REFERENCES `consignments` (`BOL`) ON DELETE CASCADE ON UPDATE CASCADE;');

        \DB::statement('ALTER TABLE `consignment_expenses`
ADD CONSTRAINT `fk_CONSIGNMENTexpenses` FOREIGN KEY (`BOL`) REFERENCES `consignments` (`BOL`) ON UPDATE CASCADE;
');

        \DB::statement('ALTER TABLE `container_contents`
ADD CONSTRAINT `fk_CONTAINERcontents` FOREIGN KEY (`Container_num`, `BOL`) REFERENCES `consignment_containers` (`Container_num`, `BOL`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_TYREcontents` FOREIGN KEY (`tyre_id`) REFERENCES `tyres` (`tyre_id`) ON UPDATE CASCADE;
');

        \DB::statement('ALTER TABLE `orders`
ADD CONSTRAINT `fk_CUSTOMERorder` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;');

        \DB::statement('ALTER TABLE `order_contents`
ADD CONSTRAINT `fk_ORDERcontainer` FOREIGN KEY (`tyre_id`, `container_num`, `bol`) REFERENCES `container_contents` (`tyre_id`, `Container_num`, `BOL`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_ORDERcontents` FOREIGN KEY (`Order_num`) REFERENCES `orders` (`Order_num`) ON DELETE CASCADE ON UPDATE CASCADE;');

        \DB::statement('ALTER TABLE `payments`
ADD CONSTRAINT `fk_ORDERSpayment` FOREIGN KEY (`Order_num`) REFERENCES `orders` (`Order_num`) ON UPDATE CASCADE;');

        \DB::statement('ALTER TABLE `performa_invoices`
ADD CONSTRAINT `fk_LCperforma` FOREIGN KEY (`lc_num`) REFERENCES `lcs` (`lc_num`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_TYREperforma` FOREIGN KEY (`tyre_id`) REFERENCES `tyres` (`tyre_id`) ON UPDATE CASCADE;');

        \DB::statement('ALTER TABLE `tyre_hscodes`
ADD CONSTRAINT `fk_HSCODEhscode` FOREIGN KEY (`hscode`) REFERENCES `hscodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_TYREtyre` FOREIGN KEY (`tyre_id`) REFERENCES `tyres` (`tyre_id`) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
