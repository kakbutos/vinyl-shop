CREATE TABLE product_image
(
	PRODUCT_ID int not null,
	IMAGE_ID int not null,
	PRIMARY KEY (PRODUCT_ID, IMAGE_ID),
	FOREIGN KEY FK_PI_PRODUCT (PRODUCT_ID)
		REFERENCES product(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_PI_IMAGE (IMAGE_ID)
		REFERENCES image(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

INSERT INTO product_image (PRODUCT_ID, IMAGE_ID)
VALUES (1, 1), (1, 2), (1, 3),
       (2, 4), (2, 5),
       (3, 6), (3, 7), (3, 8),
       (4, 9), (4, 10), (4, 11),
       (5, 12), (5, 13),
       (6, 14), (6, 15),
       (7, 16), (7, 17), (7, 18),
       (8, 19), (8, 20), (8, 21);