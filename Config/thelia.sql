
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- netreviews_order_queue
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `netreviews_order_queue`;

CREATE TABLE `netreviews_order_queue`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `order_id` INTEGER NOT NULL,
    `treated_at` DATETIME,
    `status` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- netreviews_product_review
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `netreviews_product_review`;

CREATE TABLE `netreviews_product_review`
(
    `product_review_id` VARCHAR(55) NOT NULL,
    `review_id` VARCHAR(55) NOT NULL,
    `email` VARCHAR(255),
    `lastname` VARCHAR(255),
    `firstname` VARCHAR(255),
    `review_date` DATETIME,
    `message` VARBINARY(10000),
    `rate` VARCHAR(255),
    `order_ref` VARCHAR(255),
    `product_ref` VARCHAR(255),
    `product_id` INTEGER,
    `exchange` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`product_review_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- netreviews_product_review_exchange
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `netreviews_product_review_exchange`;

CREATE TABLE `netreviews_product_review_exchange`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `product_review_id` VARCHAR(55) NOT NULL,
    `date` DATETIME,
    `who` VARCHAR(255),
    `message` VARBINARY(10000),
    PRIMARY KEY (`id`),
    INDEX `fi_netreviews_product_review_exchange_product_review_id` (`product_review_id`),
    CONSTRAINT `fk_netreviews_product_review_exchange_product_review_id`
        FOREIGN KEY (`product_review_id`)
        REFERENCES `netreviews_product_review` (`product_review_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- netreviews_site_review
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `netreviews_site_review`;

CREATE TABLE `netreviews_site_review`
(
    `site_review_id` INTEGER NOT NULL AUTO_INCREMENT,
    `review_id` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255),
    `firstname` VARCHAR(255),
    `review` VARBINARY(10000),
    `review_date` DATETIME,
    `rate` VARCHAR(255),
    `order_ref` VARCHAR(255),
    `order_date` DATETIME,
    PRIMARY KEY (`site_review_id`),
    UNIQUE INDEX `review_id_unique` (`review_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
