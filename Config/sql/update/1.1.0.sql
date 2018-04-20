# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

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
    `review` LONGTEXT,
    `review_date` DATETIME,
    `rate` VARCHAR(255),
    `order_ref` VARCHAR(255),
    `order_date` DATETIME,
    PRIMARY KEY (`site_review_id`),
    UNIQUE INDEX `review_id_unique` (`review_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;