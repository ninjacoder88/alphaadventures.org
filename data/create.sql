CREATE TABLE dbo.User
(
    UserId INT NOT NULL AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    EmailAddress VARCHAR(100) NOT NULL,
    PhoneNumber VARCHAR(10) NULL,
    Password VARCHAR(100) NOT NULL,
    Salt VARCHAR(10) NOT NULL,
    PRIMARY KEY(UserId)
);

CREATE TABLE dbo.Adventure
(
    AdventureId INT NOT NULL AUTO_INCREMENT,
    Title VARCHAR(50) NOT NULL,
    StartTime TIME NOT NULL
    Description VARCHAR(1500) NOT NULL
    PRIMARY KEY(AdventureId)
);

CREATE TABLE dbo.Response
(
    ResponseId INT NOT NULL AUTO_INCREMENT,
    UserId INT NOT NULL,
    AdventureId INT NOT NULL,
    NotifyBySMS BIT NOT NULL,
    NotifyByEmail BIT NOT NULL,
    PRIMARY KEY(ResponseId),
    FOREIGN KEY(UserId) REFERENCES User(UserId),
    FOREIGN KEY(AdventureId) REFERENCES Adventure(AdventureId)
);