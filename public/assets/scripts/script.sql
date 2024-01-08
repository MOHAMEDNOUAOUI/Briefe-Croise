create database wiki
use wiki


create table utilisateur (
    userId INT primary key AUTO_INCREMENT,
    userName varchar(100),
    userEmail varchar(100) unique,
    userPassword varchar(250),
    userRole ENUM('admin','auteur') default 'auteur';
)


create table category (
    categoryId INT primary key AUTO_INCREMENT,
    categoryName varchar(250)
)

create table tag (
    tagId INT primary key AUTO_INCREMENT,
    tagName varchar(50)
)

create table wiki (
    wikiId INT primary key AUTO_INCREMENT,
    wikiTitle varchar(250),
    wikitext text,
    categoryId INT,
    userId INT,
    foreign key (categoryId) REFERENCES category (categoryId),
    foreign key (userId) REFERENCES utilisateur (userId)
)

create table wikitag (
    wikiId INT,
    tagId INT,
    primary key(wikiId,tagId),
    foreign key (wikiId) REFERENCES wiki (wikiId),
    foreign key (tagId) REFERENCES tag (tagId)
)