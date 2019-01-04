SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE netreviews_product_review MODIFY message VARBINARY(10000);

ALTER TABLE netreviews_product_review_exchange MODIFY message VARBINARY(10000);

SET FOREIGN_KEY_CHECKS = 1;