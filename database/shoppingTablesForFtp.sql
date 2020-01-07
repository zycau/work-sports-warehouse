-- 需要在数据库里执行这些语句，而不是直接导入！！！

CREATE TABLE magenta17.`shoppingorder`(
	ShoppingOrderId   int(11)   NOT NULL AUTO_INCREMENT,
	OrderDate         datetime  NOT NULL,
	FirstName         varchar(50)  NOT NULL,
	LastName          varchar(50)  NOT NULL,
	Postcode		  varchar(5)     NOT NULL,
	`Address`          varchar(200) NOT NULL,
	ContactNumber     varchar(20)  NOT NULL,
	Email             varchar(255) ,
	CreditCardNumber  varchar(20)  NOT NULL,
	ExpiryDate        varchar(5)   NOT NULL,
	NameOnCard        varchar(50)  NOT NULL,
	Csv               varchar(3)   NOT NULL,
	PRIMARY KEY (ShoppingOrderId)
);

CREATE TABLE magenta17.`orderitem`(
	ItemId           int(11)   NOT NULL,
	ShoppingOrderId  int(11)   NOT NULL,
	Quantity         int(11)   NOT NULL,
	Price            decimal(10,2) NOT NULL,
	PRIMARY KEY (ItemId, ShoppingOrderId)
);

ALTER TABLE `orderitem` ADD CONSTRAINT orderitem_shoppingorder_fk FOREIGN KEY (ShoppingOrderId) REFERENCES `shoppingorder` (ShoppingOrderId);
ALTER TABLE `orderitem` ADD CONSTRAINT orderitem_products_fk FOREIGN KEY (ItemId) REFERENCES `products` (ProductID);