- - Create 'Parent_Profiles' table
CREATE TABLE Parent_Profiles (
ParentID INT AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
Email VARCHAR(255) NOT NULL UNIQUE,
ContactNumber VARCHAR(20),
Preferences TEXT
);
- - Create 'Provider_Profiles' table
CREATE TABLE Provider_Profiles (
ProviderID INT AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
Email VARCHAR(255) NOT NULL UNIQUE,
ContactNumber VARCHAR(20),
Qualifications TEXT,
ServicesOffered TEXT
);
- - Create 'Listings' table
CREATE TABLE Listings (
ListingID INT AUTO_INCREMENT PRIMARY KEY,
ProviderID INT,
Title VARCHAR(255) NOT NULL,
Description TEXT,
Price DECIMAL(10, 2),
AgeGroup VARCHAR(50),
FOREIGN KEY (ProviderID) REFERENCES Provider_Profiles(ProviderID)
);
- - Create 'Reviews' table
CREATE TABLE Reviews (
ReviewID INT AUTO_INCREMENT PRIMARY KEY,
ParentID INT,
ListingID INT,
Content TEXT,
Rating INT,
FOREIGN KEY (ParentID) REFERENCES Parent_Profiles(ParentID),
FOREIGN KEY (ListingID) REFERENCES Listings(ListingID)
);
- - Create 'User_Interactions' table
CREATE TABLE User_Interactions (
InteractionID INT AUTO_INCREMENT PRIMARY KEY,
UserID INT,
ListingID INT,
MessageType VARCHAR(255),
MessageContent TEXT,
-- Assuming UserID could be either a ParentID or ProviderID
FOREIGN KEY (UserID) REFERENCES Parent_Profiles(ParentID),
FOREIGN KEY (ListingID) REFERENCES Listings(ListingID)
);