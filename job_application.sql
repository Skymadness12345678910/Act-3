CREATE DATABASE IF NOT EXISTS job_application_db;
USE job_application_db;

CREATE TABLE IF NOT EXISTS job_applications (
    applicationId INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    positionApplied VARCHAR(100) NOT NULL,
    yearsOfExperience INT NOT NULL,
    preferredLanguage VARCHAR(50) NOT NULL,
    expectedSalary DECIMAL(10,2) NOT NULL,
    dateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
