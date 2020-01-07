-- ============================================
-- Create Sports Warehouse Products DATABASE
-- ============================================

DROP DATABASE IF EXISTS SportsWarehouse_zyc;

CREATE DATABASE SportsWarehouse_zyc;

USE SportsWarehouse_zyc;

CREATE TABLE SportsWarehouse_zyc.`products`(
  ProductID     INT(11) NOT NULL AUTO_INCREMENT,
  ProductName   VARCHAR(255) NOT NULL,
  Photo         VARCHAR(255),
  Price         DECIMAL(10,2),
  SalePrice     DECIMAL(10,2),
  `Description` TEXT,
  Brand         SMALLINT,
  Featured      BOOLEAN NOT NULL,
  Category      SMALLINT,
  PRIMARY KEY (ProductID)
);

CREATE TABLE SportsWarehouse_zyc.`categories`(
    CategoryID   SMALLINT NOT NULL AUTO_INCREMENT,
    CategoryName VARCHAR(255),
    PRIMARY KEY (CategoryID)
);

CREATE TABLE SportsWarehouse_zyc.`brands`(
    BrandID     SMALLINT NOT NULL AUTO_INCREMENT,
    BrandName   VARCHAR(255),
    PRIMARY KEY (BrandID)
);

-- ============================================
-- Create Constraints
-- ============================================
ALTER TABLE `products` ADD CONSTRAINT products_categories_fk FOREIGN KEY (Category) REFERENCES `categories` (CategoryID);
ALTER TABLE `products` ADD CONSTRAINT products_brands_fk FOREIGN KEY (Brand) REFERENCES `brands` (BrandID);


-- ============================================
-- INSERT Data Into Tables
-- ============================================

-- categories Table
INSERT INTO `categories` (CategoryName) VALUES ('Shoes');
INSERT INTO `categories` (CategoryName) VALUES ('Helmets');
INSERT INTO `categories` (CategoryName) VALUES ('Pants');
INSERT INTO `categories` (CategoryName) VALUES ('Tops');
INSERT INTO `categories` (CategoryName) VALUES ('Balls');
INSERT INTO `categories` (CategoryName) VALUES ('Equipment');
INSERT INTO `categories` (CategoryName) VALUES ('Training Gear');

-- brands Table
INSERT INTO `brands` (BrandName) VALUES ('Nike');
INSERT INTO `brands` (BrandName) VALUES ('Adidas');
INSERT INTO `brands` (BrandName) VALUES ('Skins');
INSERT INTO `brands` (BrandName) VALUES ('Asics');
INSERT INTO `brands` (BrandName) VALUES ('New Balance');
INSERT INTO `brands` (BrandName) VALUES ('Wilson');
INSERT INTO `brands` (BrandName) VALUES ('GoldCross');
INSERT INTO `brands` (BrandName) VALUES ('Lazer');
INSERT INTO `brands` (BrandName) VALUES ('Celsius');
INSERT INTO `brands` (BrandName) VALUES ('Umbro');
INSERT INTO `brands` (BrandName) VALUES ('Pro-Tec');
INSERT INTO `brands` (BrandName) VALUES ('Sting');

-- products Table
INSERT INTO `products` VALUES ('1','adidas Euro16 Top Soccer Ball','01.jpg',46,34.95,"Part of the Euro 2016 Collection, this ball is a 1:1 takedown of the official match ball used by professional soccer players in the European Championship games.
Machine stitched construction and internal nylon wound carcass for maximum durability and long-lasting performance.
Special TPU exterior material is designed to resist abrasion and last longer.
Butyl bladder for best air retention to keep the ball's shape and stay inflated longer.",2,1,5);
INSERT INTO `products` VALUES ('2','Pro-Tec Classic Skate Helmet','02.jpg',70,70,"HDPE Flex HDPE is made up of a foam-fitting, high-density polyethylene shell, with flexibility to fit a broader range of head shapes. HDPE shells accompany Pro Tec's 2-stage soft foam liners, not certified to ASTM, CPSC, or CE Safety Standards.",11,1,2);
INSERT INTO `products` VALUES ('3','Nike Sport 600ml Water Bottle','03.jpg',17.5,15,"Leakproof valve for water when you need it, no mess or waste
Asymmetrical one-hand design is easier to grab and hold on the sideline or in the gym.",1,1,7);
INSERT INTO `products` VALUES ('4','Sting ArmaPlus Boxing Gloves','04.jpg',79.5,79.5,"Captures the entirety of boxing training by acting as both a bag and sparring boxing glove.
Synthetic outer layer protects and lengthens training in boxing, MMA, and Muay Thai fighting styles.
Moisture absorbant lining reduces fatigue keeping you in the ring longer.",12,1,7);
INSERT INTO `products` VALUES ('5',"Asics Gel Lethal Tigreor 8 IT Men's FG Boots",'05.jpg',160,160,"Take flight across the field in the Asics Lethal Tigreor IT FF Men's Football Boots. The Lethal Tigreor IT 8 is the first pair of boots to use Asics ground-breaking FlyteFoam technology in the midsole to create a lightweight, highly cushioned boot. The boot features several other premium touches that elevate its performance. Kangaroo leather across key areas of the upper creates an outstanding fit and feedback. The toe spring is set slightly higher than other boots leading to excellent responsiveness at the time of propulsion. HG10mm technology and a removable sockliner round out the notable list of innovations, offering improved comfort so you can perform at peak level longer.",4,1,1);
INSERT INTO `products` VALUES ('6','Nike Epic React Phantom Flyknit Womens Running Shoes','06.jpg',229.99,199.99,"As stealthy as runners go, the soft laceless Nike Epic React Phantom Flyknit Women's Running Shoes deliver slip-in comfort that delivers a natural, not there fit. The Flyknit upper is engineered to secure the foot in a sock-like fit with closed knit at the forefoot and toe securing the foot.
Nike React foam returns in the midsole to deliver smooth, reactive cushioning that will have you bouncing back from each and every footfall. The TPU heel piece works to stabilize the foot for smooth transitions. With traction rubber sections at the heel and toe to enhance grip, they remain low-profile and light as ever.",1,1,1);
INSERT INTO `products` VALUES ('7','adidas Copa 19.1 Football Boots','07.jpg',259.99,199.99,"Precision engineered, for precise players who command respect with their foot, not their mouth. The adidas Copa 19.1 Football Boots will help you unleash your skills on the pitch. The seamless K-Leather upper is exceptionally soft, with the integrated X-Ray vamp cage providing greater control and reduced slippage. Navigate your way through the chaos of the game in the locked-down comfort provided by the stretchy collar and traditional laced design, while TPU inlay pods on the soleplate help cushion your step. Play elevated football and make your mark on the result in the adidas Copa 19.1.",2,0,1);
INSERT INTO `products` VALUES ('8','New Balance 680v6 Mens Running Shoes','08.jpg',139.99,139.99,"Turn running from a hobby to a passion in the comfort of the New Balance 680v6 Men's Running Shoes. The popular 680 running shoes have been updated with a new engineered mesh upper that conforms to your feet for a soft and secured fit. They utilise ABZORB cushioning in the midfoot to absorb shock underfoot and have injection-moulded EVA foam in the midsole to provide flexible and responsive cushioning that energises your step. With a NB Response 2.0 performance insert sitting underfoot they'll be exceptionally comfortable throughout your runs.",5,0,1);
INSERT INTO `products` VALUES ('9','Asics Gel Kayano 25 Mens Running Shoes','09.jpg',200,180,"Asics bring an update to their most popular runner with the Asics GEL Kayano 25 Mens Running Shoes. Constructed to provide stable support for low arches and prevent inward foot rolling. Designed with a FluidFit upper with stretch mesh, you will receive a personalised and highly comfortable, glove-like fit.
Asics GEL Cushioning in the rearfoot and forefoot helps to absorb shock from impact to lessen the impact on your joints. With an AHAR Plus outsole for enhanced durability and traction, the Asics GEL Kayano 25 is built to last.",4,0,1);
INSERT INTO `products` VALUES ('10','Goldcross Kids Mayhem Bike Helmet','10.jpg',29.99,29.99,"Protect your child as they explore and adventure with the Goldcross Kids Mayhem Bike Helmet. This lightweight helmet is adjustable to give your youngster a secure and custom fit with no-pinch fidlock busckle. The bright design will get them excited to put it on, while the internal padding and breathable vents provide comfort even on the hottest of summer days.",7,1,2);
INSERT INTO `products` VALUES ('11','Goldcross Defender Bike Helmet','11.jpg',24.99,24.99,"When you're out and about, cycle with the peace of mind that the Goldcross Defender Bike Helmet has been designed and built with an in-mould shell and rigid exterior to protect you during any accidental tumbles. And to keep you feeling fresh and relaxed, the lightweight construction and breathable vents create a barely-there feel, keeping your head cool all-day long.",7,0,2);
INSERT INTO `products` VALUES ('12','Lazer Beam Cycling Helmet White Large','12.jpg',59.99,39.99,"The Lazer Beam Cycling Helmet features Lazer’s exclusive springloaded AutoFit technology, which guarantees the easiest and most secure fit, every time; with no fiddling about or adjustment necessary.",8,0,2);
INSERT INTO `products` VALUES ('13','Nike Womens Sportswear High Rise Pants','13.jpg',79.99,69.99,"Go from your outdoor training session to brunch in the Nike Women's Sportswear High-Rise Pants. Made using double-knit fabric, you will receive a soft feel against your skin to offer maximum comfort throughout your day. An adjustable, high-rise waistband provides a personalised and secure fit to boost your confidence levels while on the move.",1,1,3);
INSERT INTO `products` VALUES ('14','adidas Womens Essentials 3 Stripes Jogger Pants','14.jpg',69.99,49.99,"Keep warm during the cooler weather in the adidas Women's Essentials 3 Stripes Jogger Pants. Made with soft, fleece fabric, you will be able to relax after a workout in cosy comfort. An external drawcord and elastic waistband work together to offer you a secure fit to keep you moving in confidence.",2,0,3);
INSERT INTO `products` VALUES ('15','adidas Womens Essentials Season Branded Pants','15.jpg',69.99,69.99,"Casual athletic styling that you can rock from the court to the street throughout the seasons, the adidas Men's Essentials Branded Season Pants will have you looking stylish in cool conditions. The design features a tapered cut with bold adidas wordmark down the length of the left leg. Finished with elasticated cuffs and waistband helps to lock heat in and provide an adjustable fit every time.",2,0,3);
INSERT INTO `products` VALUES ('16','SKINS Mens DNAmic Ultimate Compression Longsleeve Tee','16.jpg',169.99,169.99,"Warm up fast and reduce your recovery time with Skins Men's DNAmic Ultimate Longsleeve Tee. Designed biomechanically positions panels to stabilise and support muscles while increasing the flow of oxygen to your muscles to help you perform your best. The Ultimate Tee features HeiQ technology for advanced temperature and moisture management. Move faster and longer in the SKINS Men's DNAmic Ultimate Compression Longsleeve Tee, designed for high-performance wear.",3,1,4);
INSERT INTO `products` VALUES ('17','Nike Womens Sportswear Just Do It Tee','17.jpg',34.99,29.99,"Whether you're looking for a comfy casual outfit or wanting to add a touch of Nike classic style into your workout wear, the Nike Women's Sportswear Just Do It Tee is a great choice. Made using 100% cotton fabric to provide a natural feel against your skin, you will experience a high level of comfort. The slim fitting design moves with your body for a non-restrictive fit.",1,0,4);
INSERT INTO `products` VALUES ('18','adidas Mens Supernova 1/4 Zip Running Top','18.jpg',99.99,99.99,"Log some serious distance in the adidas Men's Supernova 1/4 Zip Running Top. Built for superior comfort while you head out on your daily run, it features sweat-wicking Climalite fabric so you stay dry and comfortable. The fit has been refined to provide you with free and unrestricted movement, the regular fit top features pre-shaped elbows and thumbholes.",2,0,4);
INSERT INTO `products` VALUES ('19','Wilson NFL Mini Denver Broncos Supporter Ball','19.jpg',19.99,19.99,"You can be Tom Brady, Aaron Rodgers or Russell Wilson with the Wilson NFL Mini Supporter Ball Range. Small enough to be fun for the whole family, with an easy to grip and catch rubberized cover. Go long in the backyard thanks to Wilson and the NFL.",6,0,5);
INSERT INTO `products` VALUES ('20','Nike Pitch Team Soccer Ball','20.jpg',24.99,20.99,"Train for your shot at the title or just get your mates together for a casual kick of the ball. Whatever the occasion the Nike Pitch Team Soccer Ball is sure to get the job done in style. The high contrast graphics provide great visibility for practice and play. The Nike Pitch is built to be used frequently and is constructed in a durable 12-panel design with machine stitched TPU so you can get the most out of it.",1,1,5);
INSERT INTO `products` VALUES ('21','adidas Finale 19 Official Match Soccer Ball','21.jpg',199.99,199.99,"Europe's best compete with the best match balls and you can too with the adidas Finale 19 Official Match Soccer Ball. Supersize stars slot into the panel shape, their white offsetting the explosion of colour across the rest of the ball. The casing is seamless and thermally bonded to increase accuracy, minimise water intake and offer true touch when struck. The butyl bladder ensures that air is retained between sessions.",2,0,5);
INSERT INTO `products` VALUES ('22','Celsius GS1 Home Gym','22.jpg',699,499,"Get started on your fitness journey in the comfort of your own home with the Celsius GS1 Home Gym. Built with multi-exercise functionality to activate and train different muscles, you can train the whole body and reap the rewards of your hard work. The upholstery is double stitched to provide greater durability, helping you know that your home gym will work as hard as you do. With a bullhorn to accommodate extra weight, start exercising today with the Celsius GS1 Home Gym.",9,1,6);
INSERT INTO `products` VALUES ('23','Celsius VR1 Vertical Knee Raise System','23.jpg',349.99,349.99,"Add some variety to your training sessions with the Celsius VR1 Vertical Knee Raise System. Designed to push your fitness journey further, this system allows you to incorporate a range of exercises into your workout including knee raises, dips, pull ups, chin ups and push ups. The padded armrests and backrest are constructed with a layer of padding to help provide greater comfort.",9,0,6);
INSERT INTO `products` VALUES ('24','adidas Professional Hand Grips','24.jpg',15,15,"Build up your grip on the go with the adidas Professional Hand Grips. Small muscles in your forearms, hands and wrists play an essential part in any exercise that involves lifting weights, so it's important they aren't neglected. Grip exercises can lead to increased forearm muscularity, hand strength, endurance and dexterity, leading to an enhanced weight training performance. Featuring angled springs, these grip trainers allow for graded resistance to be used to train for hand strength and grip endurance, so you can maximise your weight training. Improve grip strength with the adidas Professional Hand Grips.",2,0,6);
INSERT INTO `products` VALUES ('25','Adidas Predator Training Goalkeeper Gloves','25.jpg',34.99,34.99,"Get ready for the soccer season, from training to pre-season games, protect your hands with the Adidas Predator Training Goalkeeper Gloves. Don't take your chance on mediocre gloves, let your skills shine and let your training show your skills with their soft grip latex palm for perfect catching. The Predator Training gloves will also feel great on hand thanks to the positive cut for enhanced comfort without restriction. The gloves feature an elastic bandage and a hook and loop closure which provides great support to the wrists keeping your hands strong as you block every shot.",2,1,7);
INSERT INTO `products` VALUES ('26','Umbro Training Bib','26.jpg',9.99,9.99,"Split the side up for drills or get your mates together and set up a fun social game with the Umbro Training Bib. The lightweight mesh bibs are printed in bright colours for great visibility on the field.",10,0,7);

-- INSERT INTO `products` VALUES ('','','.jpg','','',"",'','','');

