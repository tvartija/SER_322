CREATE DATABASE IF NOT EXISTS book_inventory;

CREATE USER 'book_inv_owner'@'localhost' IDENTIFIED BY 'admin123';
GRANT ALL PRIVILEGES ON book_inventory.* TO book_inv_owner@localhost;

CREATE USER 'book_inv_user'@'localhost' IDENTIFIED BY 'user123';
GRANT INSERT, SELECT ON book_inventory.* TO book_inv_user@localhost;


CREATE TABLE IF NOT EXISTS book_inventory.genre
(
Name VARCHAR(10), 
GenreID INT,
PRIMARY KEY (GenreID)
);

CREATE TABLE IF NOT EXISTS book_inventory.title 
(
ISBN BIGINT(13), 
TitleID BIGINT(10),
Name VARCHAR(30), 
Author VARCHAR(30), 
Publisher VARCHAR(30), 
PubYear Date,
GenreID INT,
PRIMARY KEY (ISBN),
FOREIGN KEY (GenreID) REFERENCES book_inventory.genre(GenreID),
UNIQUE (TitleID)
);

CREATE TABLE IF NOT EXISTS book_inventory.book
(
ProductID BIGINT(10), 
Stock INT, 
Edition VARCHAR(5),
TitleID BIGINT(10),
Price Float; 
PRIMARY KEY (ProductID),
FOREIGN KEY (TitleID) REFERENCES book_inventory.title(TitleID)
);



CREATE TABLE IF NOT EXISTS book_inventory.consumer
(
DriversLicense BIGINT, 
CustID BIGINT AUTO_INCREMENT,
Name VARCHAR(30),
ShippingAddress VARCHAR(40),
BillingAddress VARCHAR(40),
Email VARCHAR(20),
PRIMARY KEY(CustID) 
);

CREATE TABLE IF NOT EXISTS book_inventory.transactions
(
TransactionID INT,
PurchaseDate DATE,
Qty INT,
PurchasePrice DECIMAL(10,2),
ProductID BIGINT(10),
PRIMARY KEY (TransactionID),
FOREIGN KEY (ProductID) REFERENCES book_inventory.book(ProductID)
)

INSERT INTO genre VALUE('Horror', 1);
INSERT INTO genre VALUE('Romance', 2);
INSERT INTO genre VALUE('Sci-fi / Fantasy', 3);
INSERT INTO genre VALUE('Western', 4);
INSERT INTO genre VALUE('Non-fiction', 5);
INSERT INTO genre VALUE('Religion', 6);
INSERT INTO genre VALUE('Adult Fiction', 7);
INSERT INTO genre VALUE('Teen Fiction', 8);
INSERT INTO genre VALUE('Children', 9);

INSERT INTO title VALUE(9780590453653, 
0000000001,'Welcome to Dead House', 'R.L. Stine', 'Scholastic', "1992-07-01", 1);

INSERT INTO title VALUE(9780590453661, 
0000000002,'Stay Out of The Basement', 'R.L. Stine', 'Scholastic', "1992-07-01", 1);

INSERT INTO title VALUE(9780590477412, 
0000000003,'Deep Trouble', 'R.L. Stine', 'Scholastic', "1994-05-01", 1);

INSERT INTO title VALUE(9780425240335, 
0000000004,'The Hunt for Red October', 'Tom Clancy', 'Berkley Books', "1984-10-01", 7);

INSERT INTO title VALUE(9780425170349, 
0000000004,'Rainbow Six', 'Tom Clancy', 'Berkley Books', "1998-08-01", 7);