CREATE TABLE UserStatus
(
    UserStatusId INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(15) NOT NULL,
    PRIMARY KEY(UserStatusId)
);
INSERT INTO UserStatus (Name) VALUES ('Registered');
INSERT INTO UserStatus (Name) VALUES ('Active');
INSERT INTO UserStatus (Name) VALUES ('Resetting');

CREATE TABLE User
(
    UserId INT NOT NULL AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    EmailAddress VARCHAR(100) NOT NULL,
    PhoneNumber VARCHAR(10) NULL,
    Password VARCHAR(130) NOT NULL,
    Salt VARCHAR(10) NOT NULL,
    UserStatusId INT NOT NULL,
    UserKey VARCHAR(25) NULL,
    PRIMARY KEY(UserId),
    FOREIGN KEY(UserStatusId) REFERENCES UserStatus(UserStatusId)
);

CREATE TABLE Adventure
(
    AdventureId INT NOT NULL AUTO_INCREMENT,
    Title VARCHAR(50) NOT NULL,
    StartDateTime DATETIME NOT NULL,
    EndDateTime DATETIME NULL,
    Description VARCHAR(1500) NOT NULL,
    PRIMARY KEY(AdventureId)
);

CREATE TABLE RsvpType
(
    RsvpTypeId INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(10),
    PRIMARY KEY(RsvpTypeId)
);
INSERT INTO RsvpType (Name) VALUES ('Attending');
INSERT INTO RsvpType (Name) VALUES ('Not Attending');
INSERT INTO RsvpType (Name) VALUES ('Maybe');

CREATE TABLE Rsvp
(
    RsvpId INT NOT NULL AUTO_INCREMENT,
    UserId INT NOT NULL,
    AdventureId INT NOT NULL,
    RsvpTypeId INT NOT NULL,
    NotifyBySMS BIT NOT NULL,
    NotifyByEmail BIT NOT NULL,
    Notes VARCHAR(255) NULL,
    Attendees INT NOT NULL,
    PRIMARY KEY(RsvpId),
    FOREIGN KEY(UserId) REFERENCES User(UserId),
    FOREIGN KEY(AdventureId) REFERENCES Adventure(AdventureId),
    FOREIGN KEY(RsvpTypeId) REFERENCES RsvpType(RsvpTypeId)
);

CREATE TABLE Feedback
(
    FeedbackId INT NOT NULL AUTO_INCREMENT,
    UserId INT NOT NULL,
    Message VARCHAR(500),
    PRIMARY KEY(FeedbackId),
    FOREIGN KEY(UserId) REFERENCES User(UserId)
);