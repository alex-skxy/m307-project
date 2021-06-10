CREATE TABLE creditpackage
(
    id_creditpackage INT AUTO_INCREMENT PRIMARY KEY,
    name             VARCHAR(100) NOT NULL
);

CREATE TABLE loan
(
    id_loan             INT AUTO_INCREMENT PRIMARY KEY,
    name                VARCHAR(100) NOT NULL,
    lastname            VARCHAR(100) NOT NULL,
    email               VARCHAR(100) NOT NULL,
    phone_number        VARCHAR(100),
    installments        INT          NOT NULL,
    fk_creditpackage_id INT NOT NULL REFERENCES creditpackage (id_creditpackage),
    paid_back           BOOLEAN      NOT NULL DEFAULT false,
    start_date          DATETIME              DEFAULT NOW()
);

INSERT INTO creditpackage (id_creditpackage, name)
VALUES (1, 'Kredit Basic: 1k'),
       (2, 'Kredit Basic: 2k'),
       (3, 'Kredit Basic: 3k'),
       (4, 'Kredit Basic: 4k'),
       (5, 'Kredit Basic: 5k'),
       (6, 'Kredit Basic: 6k'),
       (7, 'Kredit Basic: 7k'),
       (8, 'Kredit Basic: 8k'),
       (9, 'Kredit Basic: 9k'),
       (10, 'Kredit Basic: 10k'),
       (11, 'Kredit Best: 1k'),
       (12, 'Kredit Best: 2k'),
       (13, 'Kredit Best: 3k'),
       (14, 'Kredit Best: 4k'),
       (15, 'Kredit Best: 5k'),
       (16, 'Kredit Best: 6k'),
       (17, 'Kredit Best: 7k'),
       (18, 'Kredit Best: 8k'),
       (19, 'Kredit Best: 9k'),
       (20, 'Kredit Best: 10k'),
       (21, 'Kredit Plus: 1k'),
       (22, 'Kredit Plus: 2k'),
       (23, 'Kredit Plus: 3k'),
       (24, 'Kredit Plus: 4k'),
       (25, 'Kredit Plus: 5k'),
       (26, 'Kredit Plus: 6k'),
       (27, 'Kredit Plus: 7k'),
       (28, 'Kredit Plus: 8k'),
       (29, 'Kredit Plus: 9k'),
       (30, 'Kredit Plus: 10k'),
       (31, 'Kredit Karma: 1k'),
       (32, 'Kredit Karma: 2k'),
       (33, 'Kredit Karma: 3k'),
       (34, 'Kredit Karma: 4k'),
       (35, 'Kredit Karma: 5k'),
       (36, 'Kredit Karma: 6k'),
       (37, 'Kredit Karma: 7k'),
       (38, 'Kredit Karma: 8k'),
       (39, 'Kredit Karma: 9k'),
       (40, 'Kredit Karma: 10k');
