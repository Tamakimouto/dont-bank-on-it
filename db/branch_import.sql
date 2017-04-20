DROP TABLE IF EXISTS branches;
CREATE TABLE branches (
    address varchar(255),

    f1 varchar(55),
    f2 varchar(55),
    f3 varchar(55),
    f4 varchar(55),
    f5 varchar(55),
    f6 varchar(55),
    f7 varchar(55),
    f8 varchar(55),
    f9 varchar(55),
    f10 varchar(55),

    fdicNum int,
    city varchar(255),
    county varchar(255),

    f11 varchar(55),
    f12 varchar(55),
    f13 varchar(55),
    f14 varchar(55),
    f15 varchar(55),
    f16 varchar(55),

    bank varchar(255),

    f17 varchar(55),
    f18 varchar(55),
    f19 varchar(55),
    f20 varchar(55),

    state varchar(50),

    f21 varchar(55),
    f22 varchar(55),

    branchId int,
    zip int,

    PRIMARY KEY (branchId)
);

LOAD DATA LOCAL INFILE "OFFICES2_ALL.CSV"
INTO TABLE branches
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;
