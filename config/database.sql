-- Active: 1760599431522@@127.0.0.1@5432@postgres
-- Suppression des tables si elles existent déjà
DROP TABLE IF EXISTS Study, Has, Discucss, Agents, Users, Levels, Subjects, Roles;

-- ===================================
-- TABLES DE BASE
-- ===================================

CREATE TABLE Roles (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(50) NOT NULL
);

CREATE TABLE Subjects (
    id_subject INT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(50) NOT NULL,
    UNIQUE(theme)
);

CREATE TABLE Levels (
    id_level INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(250),
    level VARCHAR(50) NOT NULL,
    UNIQUE(level)
);

-- ===================================
-- TABLES PRINCIPALES
-- ===================================

-- Users (note : 'USER' est un mot-clé réservé en SQL, d'où le suffixe '_')
CREATE TABLE Users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    consentement BOOLEAN NOT NULL,
    creation_date DATETIME,
    id_role INT NOT NULL,
    FOREIGN KEY(id_role) REFERENCES Roles(id_role)
);

CREATE TABLE Agents (
    id_agent INT AUTO_INCREMENT PRIMARY KEY,
    prompt TEXT,
    historic TEXT,
    id_subject INT NOT NULL,
    id_level INT NOT NULL,
    FOREIGN KEY(id_subject) REFERENCES Subjects(id_subject),
    FOREIGN KEY(id_level) REFERENCES Levels(id_level)
);

-- ===================================
-- TABLES D’ASSOCIATION
-- ===================================

CREATE TABLE Discucss (
    id_discuss INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_agent INT,
    PRIMARY KEY(id_user, id_agent),
    FOREIGN KEY(id_user) REFERENCES Users(id_user),
    FOREIGN KEY(id_agent) REFERENCES Agents(id_agent)
);

CREATE TABLE Has (
    id_has INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_level INT,
    PRIMARY KEY(id_user, id_level),
    FOREIGN KEY(id_user) REFERENCES Users(id_user),
    FOREIGN KEY(id_level) REFERENCES Levels(id_level)
);

CREATE TABLE Study (
    id_study INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_subject INT,
    PRIMARY KEY(id_user, id_subject),
    FOREIGN KEY(id_user) REFERENCES Users(id_user),
    FOREIGN KEY(id_subject) REFERENCES Subjects(id_subject)
);