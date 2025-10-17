-- ================================
--   MPD - Gestion de books
-- ================================

-- Suppression préalable des tables si elles existent déjà
DROP TABLE IF EXISTS Stocks, Edited, Writen, Own, Books, Writers, Editors, Depots, Regions, Themes;

-- ================================
-- TABLES DE BASE
-- ================================

CREATE TABLE Themes (
    id_theme INT AUTO_INCREMENT PRIMARY KEY,
    theme_name VARCHAR(50) NOT NULL
);

CREATE TABLE Writers (
    id_writer INT AUTO_INCREMENT PRIMARY KEY,
    writer_name VARCHAR(50) NOT NULL
);

CREATE TABLE Regions (
    id_region INT AUTO_INCREMENT PRIMARY KEY,
    region_name VARCHAR(50) NOT NULL,
    region_population INT
);

CREATE TABLE Editors (
    id_editor INT AUTO_INCREMENT PRIMARY KEY,
    editor_name VARCHAR(50) NOT NULL,
    Raison_sociale VARCHAR(50),
    editor_adress VARCHAR(100)
);

CREATE TABLE Depots (
    id_depot INT AUTO_INCREMENT PRIMARY KEY,
    name_depot VARCHAR(50) NOT NULL,
    id_number_depot INT,
    id_region INT,
    FOREIGN KEY (id_region) REFERENCES Regions(id_region)
);

CREATE TABLE Books (
    id_book INT AUTO_INCREMENT PRIMARY KEY,
    Titre_du_book VARCHAR(50) NOT NULL,
    Numero_ISBN_book INT
);

-- ================================
-- TABLES D’ASSOCIATION
-- ================================

CREATE TABLE Own (
    id_book INT,
    id_theme INT,
    PRIMARY KEY (id_book, id_theme),
    FOREIGN KEY (id_book) REFERENCES Books(id_book),
    FOREIGN KEY (id_theme) REFERENCES Themes(id_theme)
);

CREATE TABLE Writen (
    id_book INT,
    id_writer INT,
    PRIMARY KEY (id_book, id_writer),
    FOREIGN KEY (id_book) REFERENCES Books(id_book),
    FOREIGN KEY (id_writer) REFERENCES Writers(id_writer)
);

CREATE TABLE Edited (
    id_book INT,
    id_editor INT,
    year_of_edition DATE,
    PRIMARY KEY (id_book, id_editor),
    FOREIGN KEY (id_book) REFERENCES Books(id_book),
    FOREIGN KEY (id_editor) REFERENCES Editors(id_editor)
);

CREATE TABLE Stocks (
    id_book INT,
    id_editor INT,
    id_depot INT,
    Quantite INT,
    PRIMARY KEY (id_book, id_editor, id_depot),
    FOREIGN KEY (id_book) REFERENCES Books(id_book),
    FOREIGN KEY (id_editor) REFERENCES Editors(id_editor),
    FOREIGN KEY (id_depot) REFERENCES Depots(id_depot)
);
