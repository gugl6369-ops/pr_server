
CREATE TABLE building (
                          id INT PRIMARY KEY AUTO_INCREMENT,
                          name VARCHAR(255) NOT NULL,
                          address VARCHAR(255) NOT NULL
);

CREATE TABLE view_room (
                           id INT PRIMARY KEY AUTO_INCREMENT,
                           name VARCHAR(255) NOT NULL
);

CREATE TABLE room (
                      id INT PRIMARY KEY AUTO_INCREMENT,
                      number VARCHAR(50) NOT NULL,
                      square DECIMAL(10, 2) NOT NULL,
                      seating INT NOT NULL,
                      building_id INT NOT NULL,
                      view_id INT NOT NULL,
                      FOREIGN KEY (building_id) REFERENCES building(id),
                      FOREIGN KEY (view_id) REFERENCES view_room(id)
);

CREATE TABLE role (
                      id INT PRIMARY KEY AUTO_INCREMENT,
                      name VARCHAR(100) NOT NULL
);

CREATE TABLE users (
                       id INT PRIMARY KEY AUTO_INCREMENT,
                       login VARCHAR(11) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL,
                       name VARCHAR(100) NOT NULL,
                       role_id INT NOT NULL,
                       surname VARCHAR(100) NOT NULL,
                       patronymic VARCHAR(100),
                       FOREIGN KEY (role_id) REFERENCES role(id)
);

CREATE TABLE room_user (
                           room_id INT NOT NULL,
                           id_login INT NOT NULL,
                           PRIMARY KEY (room_id, id_login),
                           FOREIGN KEY (room_id) REFERENCES room(id),
                           FOREIGN KEY (id_login) REFERENCES users(id)
);