CREATE TABLE teamProfile(
    id INT(11) NOT NULL AUTO_INCREMENT,
    fullname varchar(255),
    email varchar(255),
    bio varchar(255),
    PRIMARY KEY (ID)
);

INSERT INTO  teamProfile (firstName, lastName, email, bio)
VALUES
('TJ', 'Sherwood', 'georgian@hotmail.com', 'Hi, I am TJ. I like working out and the Marvel Universe. However, Batman is my favourite');