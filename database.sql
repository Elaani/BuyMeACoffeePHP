CREATE TABLE users (
    userId int(11) unsigned NOT NULL AUTO_INCREMENT,
    email varchar(100) NOT NULL,
    password varchar(120) NOT NULL,
    fullname varchar(150) DEFAULT NULL,
    ip varchar(45) NOT NULL DEFAULT '127.0.0.1',
    UNIQUE KEY (email),
    PRIMARY KEY (userId)
) ENGINE=InnoDb CHARSET=utf8mb4;

CREATE TABLE payments (
    paymentId int(11) unsigned NOT NULL AUTO_INCREMENT,
    userId int(11) unsigned NOT NULL,
    paypalEmail varchar(100) DEFAULT NULL,
    stripePublishableKey varchar(40) DEFAULT NULL,
    stripePrivateKey varchar(40) DEFAULT NULL,
    currency char(3) NOT NULL DEFAULT 'USD',
    PRIMARY KEY (paymentId),
    UNIQUE KEY (userId),
    FOREIGN KEY (userId) REFERENCES users(userId)
) ENGINE=InnoDb CHARSET=utf8mb4;