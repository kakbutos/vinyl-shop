CREATE TABLE tag
(
	ID int not null auto_increment,
	NAME varchar(150) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE artist
(
	ID int not null auto_increment,
	NAME varchar(200) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE image
(
	ID int not null auto_increment,
	PATH varchar(200) not null,
	IS_MAIN BOOLEAN,
	PRIMARY KEY (ID)
);

CREATE TABLE user
(
	ID int not null auto_increment,
	EMAIL varchar(100) not null,
	PASSWORD varchar(100) not null,
	LOGIN varchar(100) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE product
(
	ID int not null auto_increment,
	NAME varchar(200) not null,
	SHORT_DESCRIPTION varchar(500) not null,
	FULL_DESCRIPTION text not null,
	PRICE DOUBLE not null,
	SORT_ORDER INT,
	RELEASE_DATE YEAR not null,
	IS_ACTIVE BOOLEAN not null,
	ARTIST_ID int,

	PRIMARY KEY (ID),
	FOREIGN KEY FK_PRODUCT_ARTIST (ARTIST_ID)
		REFERENCES artist(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

CREATE TABLE `order`
(
	ID int not null auto_increment,
	DATE DATETIME not null,
	CUSTOMER_NAME varchar(200) not null,
	CUSTOMER_EMAIL varchar(200) not null,
	CUSTOMER_PHONE varchar(20) not null,
	COMMENT text,
	STATUS VARCHAR(100) not null
);