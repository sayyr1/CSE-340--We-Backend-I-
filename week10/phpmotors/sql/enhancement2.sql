-- Query 1
INSERT INTO `clients`( `clientFirstname`, `clientLastName`, `clientEmail`, `clientPassword`, `comment`) VALUES ('[Tony]','[Stark]','[tony@starkent.com]','[Iam1ronM@n]','[I am the real Iroman]');

-- Query 2
UPDATE `clients` SET `clientLevel`='3' WHERE clientid = 2;

-- Query 3
UPDATE inventory SET `invDescription`= REPLACE (invDescription, 'small interiors', 'spacious interior') WHERE invId = 12;

-- Query 4
SELECT inventory.invModel, carclassification.classificationName FROM inventory INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId WHERE carclassification.classificationName = 'SUV';

-- Query 5
DELETE FROM `inventory` WHERE invId = 1;

-- Query 6
UPDATE inventory SET invImage = concat('/phpmotors', invImage), invThumbnail = concat('/phpmotors', invThumbnail);
