CREATE TABLE User
(
    UserId INT NOT NULL AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    EmailAddress VARCHAR(100) NOT NULL,
    PhoneNumber VARCHAR(10) NULL,
    Password VARCHAR(100) NOT NULL,
    Salt VARCHAR(10) NOT NULL,
    PRIMARY KEY(UserId)
);

CREATE TABLE Adventure
(
    AdventureId INT NOT NULL AUTO_INCREMENT,
    Title VARCHAR(50) NOT NULL,
    StartTime TIME NOT NULL,
    Description VARCHAR(1500) NOT NULL,
    PRIMARY KEY(AdventureId)
);

CREATE TABLE ResponseType
(
    ResponseTypeId INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(10),
    PRIMARY KEY(ResponseTypeId)
);
INSERT INTO ResponseType (Name) VALUES ('Attending');
INSERT INTO ResponseType (Name) VALUES ('Not Attending');
INSERT INTO ResponseType (Name) VALUES ('Maybe');

CREATE TABLE Response
(
    ResponseId INT NOT NULL AUTO_INCREMENT,
    UserId INT NOT NULL,
    AdventureId INT NOT NULL,
    ResponseTypeId INT NOT NULL,
    NotifyBySMS BIT NOT NULL,
    NotifyByEmail BIT NOT NULL,
    PRIMARY KEY(ResponseId),
    FOREIGN KEY(UserId) REFERENCES User(UserId),
    FOREIGN KEY(AdventureId) REFERENCES Adventure(AdventureId),
    FOREIGN KEY(ResponseTypeId) REFERENCES ResponseType(ResponseTypeId)
);