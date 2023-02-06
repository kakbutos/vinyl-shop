INSERT INTO tag (ID, NAME)
VALUES (1, 'Классика'),
       (2, 'Рок-н-Ролл'),
       (3, 'Рок'),
       (4, 'Джаз'),
       (5, 'Блюз'),
       (6, 'Металл'),
       (7, 'Отечественная музыка'),
       (8, 'Хип-хоп'),
       (9, 'Электроника'),
       (10, 'Диско'),
       (11, 'Хеви-метал');

INSERT INTO artist (NAME)
VALUES ('AC/DC'),
       ('Мумий Тролль'),
       ('Manowar'),
       ('Louis Armstrong'),
       ('Joe Cocker'),
       ('Mozart'),
       ('Snoop Dogg'),
       ('Boney M.');

INSERT INTO status (ID, NAME)
VALUES ('M', 'Mint'),
       ('NM', 'Near Mint'),
       ('VG+', 'Very Good Plus'),
       ('VG', 'Very Good'),
       ('G+', 'Good Plus'),
       ('P', 'Poor');

INSERT INTO product (NAME, TRACKS, VINYL_STATUS_ID, COVER_STATUS, PRICE, RELEASE_DATE, IS_ACTIVE, ARTIST_ID)
VALUES ('Highway To Hell', 'A1 Highway To Hell;A2 Girls Got Rhythm;A3 Walk All Over You;A4 Touch Too Much;A5 Beating Around The Bush;B1 Shot Down In Flames;B2 Get It Hot;B3 If You Want Blood;B4 Love Hungry Man;B5 Night Prowler', 'G+', 'Потёртый', 5580, 1979, TRUE, 1),
       ('Призраки Завтра', 'A1 Всходы;A2 Не Целуясь;A3 Романс Знатоков;A4 Космические Силы;A5 Призраки Завтра;B1 Космические Силы - Acoustic; B2 Призраки Завтра - Acoustic;Не Целуясь - Мумий Тролль & T-Fest;B3 Кутить - Мумий Тролль & Скриптонит;B4 Призраки Завтра (DZA Reflip);B5 Ghosts of Tomorrow - Saint Mesa & Mummiy Troll', 'M', 'Запечатанная пластинка', 4480, 2022, TRUE, 2),
       ('Kings Of Metal', 'A1 Wheels Of Fire;A2	Kings Of Metal;A3 Heart Of Steel;A4 Sting Of The Bumblebee;A5 The Crown And The Ring (Lament Of The Kings);B1 Kingdom Come;B2 Hail And Kill;B3 The Warriors Prayer;B4 Blood Of The Kings', 'VG+', 'Заметны изломы', 9150, 1988, TRUE, 3),
       ('Under The Stars', 'A1 Top Hat, White Tie And Tails;A2 Have You Met Miss Jones?;A3 I Only Have Eyes For You;A4 Stormy Weather;B1 Home;B2 East Of The Sun (And West Of The Moon);B3 You''re Blasé;B4 Body And Soul', 'VG', 'Потёртое', 2190, 1981, TRUE, 4),
       ('The Life Of A Man - The Ultimate Hits 1968-2013', 'A1 With a Little Help from My Friends;A2 Up Where We Belong Ft. Jennifer Warnes;A3 Many Rivers to Cross;A4 You Are So Beautiful;B1 You Can Leave Your Hat on;B2 Delta Lady;B3 The Letter (Live);B4 Cry Me A River (Live)', 'NM', 'Без недостатков', 5580, 2016, TRUE, 5),
       ('The Best Of Mozart', 'A1 Overture The Marriage Of Figaro;A2 Hallelujah From Exultate Jubilate;A3 Flute Concerto In D Major - Finale;A4 Eine Kleine Nachtmusik 1st Movement;A5 Violin Concerto In D Major - Last Movement;A6 Symphony No. 35 In D Major Haffner - Last Movement;B1 Overture The Magic Flute;B2 Laudate Dominum;B3 Rondo Alla Turka;B4 Symphony No. 29 In A Major 4th Movement;B5 Horn Concerto No. 3 In E Flat Major 1st Movement;B6 Symphony No. 41 In C Jupiter 1st Movement', 'M', 'Запечатанная пластинка', 3380, 2021, TRUE, 6),
       ('Paid Tha Cost To Be Da Bo$$', 'A1 Don Doggy;A2 Da Bo$$ Would Like To See You;A3 Stoplight;A4 From Tha Church To Da Palace;B1 I Believe In You;B2 Lolipop;B3 Ballin', 'NM', 'Заметны изломы', 7990, 2002, TRUE, 7),
       ('Oceans Of Fantasy', 'A1 Let It All Be Music;A2 Gotta Go Home;A3 Bye Bye Bluebird;A4 Bahama Mama;A5 Hold On I''m Coming;A6 Two Of Us;A7 Ribbons Of Blue;B1 Oceans Of Fantasy;B2 El Lute;B3 No More Chain Gang;B4 I’m Born Again;B5 No Time To Lose;B6 Calendar Song (January, February, March...)', 'NM', 'Без недостатков', 2990, 1979, TRUE, 8);

INSERT INTO product_tag (PRODUCT_ID, TAG_ID)
VALUES (1, 6), (1, 11),
       (2, 7), (2, 3),
       (3, 6), (3, 11),
       (4, 4),
       (5, 5),
       (6, 1),
       (7, 8),
       (8, 10);

INSERT INTO `order` (DATE, CUSTOMER_NAME, CUSTOMER_EMAIL, CUSTOMER_PHONE, COMMENT, STATUS)
	VALUES ('2023-01-30 10:10:00', 'Катя', 'jklasd@gmail.com', '88005553535', 'Всё круто, спасибо', 'COMPLETE'),
	('2023-01-31 10:10:00', 'Артём', 'adgdfg@gmail.com', '88001253816', 'Какой красивый сайт', 'WAITING'),
	('2023-02-01 10:10:00', 'Андрей', 'oiuyt123@gmail.com', '89385193566', 'Не хватает функции заказа кофе', 'WAITING');

INSERT INTO product_order (ORDER_ID, PRODUCT_ID , COUNT, PRICE)
VALUES (1, 1, 2, 5580),
       (1, 2, 1, 4480),
       (2, 8, 3, 2990),
       (3, 4, 1, 2190),
       (3, 7, 2, 5990);

INSERT INTO image (ID, PATH, IS_MAIN)
VALUES (1, '892496fd1e98ba4d89b8642ceba3d014.jpg', TRUE),
       (2, 'a0b09b0b2ce45e3e147665093b4a9d93.jpg', FALSE),
       (3, '7a8cb1930337913d755b723b22e99beb.jpg', FALSE),
       (4, 'df5a4014bf2e6ff6ded2601262874626.jpg', TRUE),
       (5, '06cc34baf4791a83a2bb5c74416f03cf.jpg', FALSE),
       (6, '88f4194dec86ea4648bc2c39b745dd33.jpg', TRUE),
       (7, '2759849a72ce2294c5d5d10e285aaeb5.jpg', FALSE),
       (8, '53c373bcbacb71eaf9a088a6cb81aa56.jpg', FALSE),
       (9, '277a535c6d9bdcf55e315302be6c2098.jpg', TRUE),
       (10, '53c6f9d96bf578d7595fed0da7889a71.jpg', FALSE),
       (11, 'e35ac648b51f27a0b56bd4c14dc8cc84.jpg', FALSE),
       (12, '75112d842ba838425c31ed689fe54895.jpg', TRUE),
       (13, '1f71dc833531f29807ea72c5ddb37b3d.jpg', FALSE),
       (14, '0440371b0e93cf37fae92dfca797ce11.jpg', TRUE),
       (15, '833e556635a09a63f9906488d253d1cc.jpg', FALSE),
       (16, '68d6495b4ee9efdb32bf73da5059a9ac.jpg', TRUE),
       (17, 'dc569cd509b6193a3a6f959cd44322df.jpg', FALSE),
       (18, '33d703570a94142a3915ae471e1a1617.jpg', FALSE),
       (19, 'f116577dbe90442dd858477cfbf35f6c.jpg', TRUE),
       (20, '838ff2bad8f7558408b12a514ece0dd7.jpg', FALSE),
       (21, '5b60a89919ea47c3807d3361e15fd841.jpg', FALSE);
