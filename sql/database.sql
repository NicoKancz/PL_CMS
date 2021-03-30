CREATE DATABASE IF NOT EXISTS PL_CMS;

USE PL_CMS;

CREATE TABLE IF NOT EXISTS users(
	userId int NOT NULL AUTO_INCREMENT,
    userName varchar(255) NOT NULL,
    userEmail varchar(255) NOT NULL,
    userPassword char(60) NOT NULL,
    userRole int NOT NULL,
    userRegDate date,
    PRIMARY KEY (userId),
    CONSTRAINT FK_RoleUser FOREIGN KEY (userRole)
    REFERENCES roles(roleId)
);

CREATE TABLE IF NOT EXISTS roles(
	roleId int NOT NULL AUTO_INCREMENT,
    roleName varchar(255) NOT NULL, 
    PRIMARY KEY (roleId)
);
    
CREATE TABLE IF NOT EXISTS comments(
	commentId int NOT NULL AUTO_INCREMENT,
    commentText mediumtext,
    commentDate timestamp NOT NULL,
    commentUpdate timestamp NOT NULL,
    userId int NOT NULL,
    PRIMARY KEY (commentId),
    CONSTRAINT FK_UserComment FOREIGN KEY (userId) 
    REFERENCES users(userId)
);

CREATE TABLE IF NOT EXISTS languages(
	languageId int NOT NULL AUTO_INCREMENT,
    languageName varchar(255) NOT NULL,
    languageAppearance YEAR NOT NULL,
    PRIMARY KEY (languageId)
);

CREATE TABLE IF NOT EXISTS containers(
	containerId int NOT NULL AUTO_INCREMENT,
    containerName varchar(255) NOT NULL,
    containerDescription text,
    containerDate date,
    containerLink tinyint NOT NULL DEFAULT 1,
    languageId int NOT NULL,
    PRIMARY KEY (containerId),
    CONSTRAINT FK_LanguageContainer FOREIGN KEY (languageId)
    REFERENCES languages(languageId)
);

CREATE TABLE IF NOT EXISTS articles(
	articleId int NOT NULL AUTO_INCREMENT,
    articleName varchar(255) NOT NULL,
    articleDescription mediumtext,
    articleType varchar(125) NOT NULL,
    articleImage varchar(255),
    articleDate date,
    userId int NOT NULL,
    containerId int NOT NULL,
    PRIMARY KEY (articleId),
    CONSTRAINT FK_UserArticle FOREIGN KEY (userId)
    REFERENCES users(userId),
    CONSTRAINT FK_ContainerArticle FOREIGN KEY (containerId)
    REFERENCES containers(containerId)
);

INSERT INTO languages(languageName, languageAppearance)
VALUES('PHP', 1995);

INSERT INTO languages(languageName, languageAppearance)
VALUES('JavaScript', 1995); 

INSERT INTO roles(roleName)
VALUES('Administrator'); 

INSERT INTO roles(roleName)
VALUES('Gebruiker'); 

INSERT INTO roles(roleName)
VALUES('Moderator'); 

ALTER TABLE users DROP FOREIGN KEY FK_RoleUser;
ALTER TABLE users ADD CONSTRAINT FK_RoleUser FOREIGN KEY (userRole) REFERENCES roles(roleId);

UPDATE users SET userRole=1 WHERE userId=5;



