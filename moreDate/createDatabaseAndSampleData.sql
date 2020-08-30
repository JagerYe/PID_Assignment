DROP DATABASE IF EXISTS `PID_Assignment`;
CREATE DATABASE IF NOT EXISTS `PID_Assignment` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `PID_Assignment`;

DROP TABLE IF EXISTS `Members`;
CREATE TABLE `Members`(
    `_userID` VARCHAR(20) NOT NULL,
    `_userPassword` VARCHAR(20) NOT NULL,
    `_userName` VARCHAR(20) NOT NULL,
    `_userEmail` VARCHAR(50) NOT NULL,
    `_userPhone` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`_userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `Employees`;
CREATE TABLE `Employees`(
    `empID` VARCHAR(20) NOT NULL,
    `empPassword` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`empID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `Commoditys`;
CREATE TABLE `Commoditys`(
    `commodityID` int NOT NULL AUTO_INCREMENT,
    `commodityName` VARCHAR(20) NOT NULL,
    `commodityPrice` int NOT NULL,
    `commodityQuantity` int NOT NULL,
    `commodityStatus` VARCHAR(20) NOT NULL,
    `commodityText` TEXT,
    `commodityImage` BLOB,
    PRIMARY KEY (`commodityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `Orders`;
CREATE TABLE `Orders` (
  `orderID` int NOT NULL AUTO_INCREMENT,
  `_userID` varchar(20) NOT NULL,
  `orderDate` datetime NOT NULL,
  PRIMARY KEY (`orderID`),
  FOREIGN KEY (`_userID`) REFERENCES `Members`(`_userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `OrderDetails`;
CREATE TABLE `OrderDetails` (
  `orderID` int NOT NULL,
  `commodityID` int NOT NULL,
  `orderCommodityPrice` int NOT NULL,
  `orderCommodityQuantity` int NOT NULL,
  PRIMARY KEY (`orderID`,`commodityID`),
  FOREIGN KEY (`orderID`) REFERENCES `Orders`(`orderID`),
  FOREIGN KEY (`commodityID`) REFERENCES `Commoditys`(`commodityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Members`(`_userID`, `_userPassword`, `_userName`, `_userEmail`, `_userPhone`) VALUES ('a01','123456','a01','a01@gmail.com','0911111111'),
('a02','123456','a02','a02@gmail.com','0922222222'),
('a03','123456','a03','a03@gmail.com','0933333333'),
('a04','123456','a04','a04@gmail.com','0944444444'),
('a05','123456','a05','a05@gmail.com','0955555555'),
('a06','123456','a06','a06@gmail.com','0966666666');

INSERT INTO `Employees`(`empID`, `empPassword`) VALUES ('emp1','123456');

INSERT INTO `Commoditys`(`commodityName`, `commodityPrice`, `commodityQuantity`, `commodityStatus`, `commodityText`) VALUES ('c001',30,2000,'open','c00001')
,('c002',50,50000,'open','c00005'),
('c003',1110,0,'open','c00003'),
('c004',1000,1,'close','c00004'),
('c005',40,70,'open','c00005'),
('c006',100,500,'open','c00006'),
('c007',50,200,'open','c00007'),
('c008',60,700,'close','c00008'),
('c009',50,0,'close','c00009'),
('c010',40,10000,'open','c00010');

INSERT INTO `Orders`(`_userID`, `orderDate`) VALUES ('a01','2020-08-08 17:00:00'),
('a03','2020-08-10 06:00:00'),
('a02','2020-08-11 15:00:00'),
('a01','2020-08-15 11:00:00'),
('a04','2020-08-20 03:00:00');

INSERT INTO `OrderDetails`(`orderID`, `commodityID`, `orderCommodityPrice`, `orderCommodityQuantity`) VALUES (1,4,900,2),
(2,1,35,10),
(2,2,50,20),
(2,3,1000,210),
(3,5,45,40),
(4,6,100,70),
(5,1,25,2),
(5,2,45,3),
(5,7,50,7),
(5,8,55,10),
(5,9,50,11),
(5,10,45,13);