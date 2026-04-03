
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

-- ТЕСТОВЫЕ ДАННЫЕ

INSERT INTO building(id, name, address) VALUES
                        (
                            1, 'школа', 'г Тамсямск'
                        ),
                        (
                            2, 'продуктовый', 'г Калаед'
                        );

INSERT INTO view_room(id, name) VALUES
                        (
                            1, 'Аудитория'
                        ),
                        (
                            2, 'Зал'
                        ),
                        (
                            3, 'Офис'
                        );

INSERT INTO room(id, number, square, seating, building_id, view_id) VALUES
                        (
                            1, '№ 67', 20, 1, 2, 3
                        ),
                        (
                            2, '№52', 15, 100, 1, 2
                        ),
                        (
                            3, '№11111', 5, 100, 1, 1
                        );

INSERT INTO role(id, name) VALUES
                        (
                            1, 'Admin'
                        ),
                        (
                            2, 'Sotrudnic'
                        );

INSERT INTO users(id, login, password, name, role_id, surname, patronymic) VALUES
                        (
                            1, 'admin', (SELECT MD5('admin')), 'Админ', 1, 'Админов', 'Админович'
                        ),
                        (
                            2, 'employee', (SELECT MD5('employee')), 'Рабочий', 1, 'Негр', 'Безпапович'
                        );

INSERT INTO room_user(room_id, id_login) VALUES
                        (
                            1, 2
                        );