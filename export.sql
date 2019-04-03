CREATE DATABASE IF NOT EXISTS softuni_library;

USE softuni_library;

CREATE TABLE IF NOT EXISTS users(
  user_id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL UNIQUE ,
  password VARCHAR(255) NOT NULL ,
  full_name VARCHAR(255) NOT NULL ,
  born_on DATETIME NOT NULL ,
  PRIMARY KEY (user_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS genres(
  genre_id INT NOT NULL AUTO_INCREMENT,
  name  varchar(50),
  PRIMARY KEY (genre_id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS books(
  book_id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(50) NOT NULL ,
  author VARCHAR (50) NOT NULL,
  description TEXT NOT NULL ,
  image VARCHAR(255) NULL ,
  genre_id INT NOT NULL ,
  user_id INT NOT NULL ,
  added_on TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (book_id),
  INDEX FK_books_users (user_id),
  INDEX FK_books_genres (genre_id),
  CONSTRAINT FK_books_users FOREIGN KEY (user_id) REFERENCES users (user_id) ,
  CONSTRAINT FK_books_genres FOREIGN KEY (genre_id) REFERENCES genres (genre_id)



)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB;

INSERT INTO genres (name)
VALUE
      ('Drama'),
      ('Education'),
      ('Adventure');