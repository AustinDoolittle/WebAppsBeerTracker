USE doolitau
CREATE TABLE Breweries (
  ID BIGINT NOT NULL AUTO_INCREMENT,
  Name CHAR(30),
  Longitude FLOAT(10,3),
  Latitude FLOAT(10,3),
  Address CHAR(140),
  ImagePath TEXT(256),
  Description TEXT(1024),
  WebsiteUrl TEXT(140),
  PRIMARY KEY (ID)
);

USE doolitau
CREATE TABLE Types (
  ID BIGINT NOT NULL AUTO_INCREMENT,
  Description TEXT(1024),
  Name CHAR(140),
  PRIMARY KEY (ID)
);

USE doolitau
CREATE TABLE Beers (
  ID BIGINT NOT NULL AUTO_INCREMENT,
  Name CHAR(30),
  Brewery BIGINT,
  Proof FLOAT(10,2),
  Season CHAR(30),
  Format CHAR(15),
  Description TEXT(1024),
  Type BIGINT,
  ImagePath TEXT(256),
  FOREIGN KEY (Brewery)
    REFERENCES Breweries(ID)
    ON DELETE CASCADE,
  FOREIGN KEY (Type)
    REFERENCES Types(ID)
    ON DELETE SET NULL,
  PRIMARY KEY (ID)
);

USE doolitau
CREATE TABLE Users (
  ID BIGINT NOT NULL AUTO_INCREMENT,
  Name CHAR(50),
  Email CHAR(100),
  Age INT,
  Password CHAR(100),
  PRIMARY KEY (ID)
);

USE doolitau
CREATE TABLE Rating (
  ID BIGINT NOT NULL AUTO_INCREMENT,
  User BIGINT,
  Beer BIGINT,
  Review TEXT(1024),
  Rating INT,
  ImagePath TEXT(512),
  PRIMARY KEY (ID),
  FOREIGN KEY (User)
    REFERENCES Users(ID)
    ON DELETE SET NULL,
  FOREIGN KEY (Beer)
    REFERENCES Beers(ID)
    ON DELETE CASCADE
);
