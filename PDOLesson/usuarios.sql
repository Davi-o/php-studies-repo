CREATE TABLE `usuarios` (`id` int(11) NOT NULL AUTO_INCREMENT, `nome` varchar(60) NOT NULL, `login` varchar(30) NOT NULL, `idade` tinyint(4) NOT NULL, `sexo` char(3) NOT NULL, `email` varchar(60) NOT NULL, `senha` varchar(100) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
INSERT INTO `usuarios` (`nome`,`login`,`idade`,`sexo`,`email`,`senha`) VALUES ('Marianes','marimar',20,'fem','email@mariana.com','123456');

USE `database_php7`;
DROP procedure IF EXISTS `sp_usuarios_insert`;

DELIMITER $$
USE `database_php7`$$
CREATE PROCEDURE `sp_usuarios_insert` (
    pnome varchar(60),
    plogin varchar(30),
    pidade tinyint,
    psexo char(3),
    pemail varchar(60),
    psenha varchar(100)
)
BEGIN
    insert into usuarios(nome, login, idade, sexo, email, senha) values (pnome, plogin, pidade, psexo, pemail, psenha);
    select * from usuarios where id = last_insert_id();
END$$

DELIMITER ;
