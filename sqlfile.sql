ALTER TABLE order_masters
ADD po_date Timestamp;

ALTER TABLE order_masters
ADD po_number Text;

ALTER TABLE order_masters
ADD shipto_id int;


ALTER TABLE customer_master
ADD alternate_email Text;

ALTER TABLE customer_master
ADD pan_no Text;


Alter table customer_contact_details
Add customer_id Text;

Alter table customer_contact_details
Add country text;


Alter table invoice_masters Add contact_name text;


ALTER TABLE `order_items` ADD `item_code` TEXT NULL AFTER `itemid`;

ALTER TABLE `dispatch_details` ADD `transportationCost` TEXT NULL AFTER `Distance`;

ALTER TABLE `invoice_masters` ADD `tcs_rate` DECIMAL(2)  NULL AFTER `total_amount`, ADD `tcs_amount` DECIMAL(2)  NULL AFTER `tcs_rate`;


ALTER TABLE `invoice_masters` ADD `CustContact_id` INT NULL AFTER `ShipToAddress`;

ALTER TABLE `invoice_masters` ADD `taxable_amt` TEXT  NULL AFTER `total_amount`;
ALTER TABLE `companyregisters` ADD `state` TEXT ;

ALTER TABLE `order_masters` ADD `supplementry_orderno` TEXT  NULL AFTER `order_type`;


ALTER TABLE `invoice_details` CHANGE `item_id` `item_id` INT NULL DEFAULT NULL, CHANGE `rate` `rate` FLOAT NULL DEFAULT NULL, CHANGE `discount` `discount` FLOAT NULL DEFAULT NULL;

ALTER TABLE `invoice_details` ADD `taxable_amt` DECIMAL NOT NULL AFTER `IGST_amount`;
ALTER TABLE `companyregisters` ADD `tan` TEXT NOT NULL AFTER `CIN`;
ALTER TABLE `product_master` ADD UNIQUE(`company_id`, `item_name`, `item_code`);
ALTER TABLE `companyregisters` ADD `CIN` TEXT NOT NULL AFTER `MobileNo`;



