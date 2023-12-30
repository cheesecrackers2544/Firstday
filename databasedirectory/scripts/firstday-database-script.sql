-- Create 'Parent_Profiles' table
CREATE TABLE Parent_Profiles (
ParentID INT AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
Email VARCHAR(255) NOT NULL UNIQUE,
ContactNumber VARCHAR(20),
Preferences TEXT
);
-- Create 'Provider_Profiles' table
CREATE TABLE Provider_Profiles (
ProviderID INT AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
Email VARCHAR(255) NOT NULL UNIQUE,
ContactNumber VARCHAR(20),
Qualifications TEXT,
ServicesOffered TEXT
);
-- Create 'Listings' table
CREATE TABLE Listings (
    ListingID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255) NOT NULL, -- Service Name
    Telephone VARCHAR(20),
    Email VARCHAR(255),
    StreetAddress VARCHAR(255),
    Suburb VARCHAR(100),
    TownCity VARCHAR(100),
    ServiceType VARCHAR(100),
    HoursECE VARCHAR(3),
    AreaUnit VARCHAR(100),
    Latitude DECIMAL(9,6),
    Longitude DECIMAL(9,6),
    MaxLicensedPositions INT,
    CapacityUnder2s INT,
    CapacityAge0 INT,
    CapacityAge1 INT,
    CapacityAge2 INT,
    CapacityAge3 INT,
    CapacityAge4 INT,
    CapacityAge5 INT,
    TotalCapacity INT
);
-- Create 'Reviews' table
CREATE TABLE Reviews (
ReviewID INT AUTO_INCREMENT PRIMARY KEY,
ParentID INT,
ListingID INT,
Content TEXT,
Rating INT,
FOREIGN KEY (ParentID) REFERENCES Parent_Profiles(ParentID),
FOREIGN KEY (ListingID) REFERENCES Listings(ListingID)
);
-- Create 'User_Interactions' table
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
