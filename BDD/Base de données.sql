DROP DATABASE IF EXISTS DefiCyber;

CREATE DATABASE DefiCyber;


CREATE TABLE user (
    id int PRIMARY KEY,
    pseudo varchar(30) not null,
    mdp_hash text not null,
    mail varchar,
    idRole int,
    FOREIGN KEY (idRole) REFERENCES Roles(id),
    PRIMARY KEY (id)
);

CREATE TABLE Roles (
    id int PRIMARY KEY,
    tag varchar(30) not null,
    Personnalisation boolean default 0,
    Administration boolean default 0, 
    Statistisque boolean default 0,
    PRIMARY KEY (id)
);

insert into Roles (tag, Personnalisation, Administration, Statistisque) values
('User', 0, 0, 0),
():