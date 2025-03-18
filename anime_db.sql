-- Membuat database anime_db
CREATE DATABASE IF NOT EXISTS anime_db;
USE anime_db;

-- Membuat tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Menambahkan data contoh ke tabel users
INSERT INTO users (username, password) VALUES 
('adriana', '$2y$10$TlYK5v5xFl1UhM9grqLLY.z.eJqCz1GmX.7htWBnbLuYXdtGfC1gy'); -- password hash dari 'password123'

-- Membuat tabel anime
CREATE TABLE IF NOT EXISTS anime (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul_anime VARCHAR(100) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    rating INT(2) NOT NULL CHECK (rating >= 1 AND rating <= 10),
    tahun_rilis YEAR NOT NULL
);

-- Menambahkan data contoh ke tabel anime
INSERT INTO anime (judul_anime, genre, rating, tahun_rilis) VALUES 
('Naruto', 'Action', 9, 2002),
('One Piece', 'Adventure', 10, 1999),
('Attack on Titan', 'Action', 10, 2013),
('Demon Slayer', 'Fantasy', 9, 2019);
