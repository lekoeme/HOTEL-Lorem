#
# Structure for the `hoteis` table : 
#

CREATE TABLE `hoteis` (
  `Codigo_Hotel` smallint(6) NOT NULL AUTO_INCREMENT,
  `Nome_Gerente` varchar(50) CHARACTER SET latin1 NOT NULL,
  `CNPJ` varchar(18) CHARACTER SET latin1 NOT NULL,
  `Inscricao_Estadual` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `Endereco` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Numero` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `Bairro` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Cidade` varchar(40) CHARACTER SET latin1 NOT NULL,
  `UF` char(2) CHARACTER SET latin1 NOT NULL,
  `Telefone` varchar(18) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`Codigo_Hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Structure for the `apartamentos` table : 
#

CREATE TABLE `apartamentos` (
  `ID_Registro` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo_Hotel` smallint(6) NOT NULL,
  `Numero_Apartamento` smallint(6) NOT NULL,
  `Numero_Chave` smallint(6) NOT NULL,
  `Tipo_Apartamento` smallint(6) NOT NULL,
  `Tipo_Acomodacao` smallint(6) NOT NULL,
  `Quantidade_Cama` smallint(6) NOT NULL,
  `Tem_TV` char(1) CHARACTER SET latin1 DEFAULT 'S',
  `Tem_Frigobar` char(1) CHARACTER SET latin1 DEFAULT 'S',
  `Tem_Banheira` char(1) CHARACTER SET latin1 DEFAULT 'N',
  `Tem_Escrivaninha` char(1) CHARACTER SET latin1 DEFAULT 'N',
  `Ocupado` char(1) CHARACTER SET latin1 DEFAULT 'N',
  `Inicio_Hospedagem` date DEFAULT NULL,
  `Fim_Hospedagem` date DEFAULT NULL,
  `Valor_Diaria` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Codigo_Hospede` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Registro`),
  KEY `Codigo_Hotel` (`Codigo_Hotel`),
  CONSTRAINT `apartamentos_fk1` FOREIGN KEY (`Codigo_Hotel`) REFERENCES `hoteis` (`Codigo_Hotel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Structure for the `cargos` table : 
#

CREATE TABLE `cargos` (
  `Codigo_Cargo` smallint(6) NOT NULL AUTO_INCREMENT,
  `Descricao_Cargo` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`Codigo_Cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Structure for the `estados` table : 
#

CREATE TABLE `estados` (
  `UF` char(2) CHARACTER SET latin1 NOT NULL,
  `Estado` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `Regiao` char(2) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`UF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Structure for the `funcionarios` table : 
#

CREATE TABLE `funcionarios` (
  `Codigo_Funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Funcionario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Data_Nascimento` date NOT NULL,
  `CPF` varchar(14) CHARACTER SET latin1 NOT NULL,
  `RG` varchar(12) CHARACTER SET latin1 NOT NULL,
  `Endereco` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Numero` varchar(10) CHARACTER SET latin1 NOT NULL,
  `Complemento` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `Bairro` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Cidade` varchar(40) CHARACTER SET latin1 NOT NULL,
  `UF` char(2) CHARACTER SET latin1 NOT NULL,
  `Telefone` varchar(18) CHARACTER SET latin1 NOT NULL,
  `Celular` varchar(18) CHARACTER SET latin1 DEFAULT NULL,
  `Codigo_Cargo` smallint(6) NOT NULL,
  `Funcao` varchar(30) CHARACTER SET latin1 NOT NULL,
  `Codigo_Hotel` smallint(6) NOT NULL,
  PRIMARY KEY (`Codigo_Funcionario`),
  KEY `Nome_Funcionario` (`Nome_Funcionario`),
  KEY `CPF` (`CPF`),
  KEY `Codigo_Cargo` (`Codigo_Cargo`),
  KEY `Codigo_Hotel` (`Codigo_Hotel`),
  CONSTRAINT `funcionarios_fk1` FOREIGN KEY (`Codigo_Cargo`) REFERENCES `cargos` (`Codigo_Cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `funcionarios_fk2` FOREIGN KEY (`Codigo_Hotel`) REFERENCES `hoteis` (`Codigo_Hotel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Structure for the `hospedes` table : 
#

CREATE TABLE `hospedes` (
  `Codigo_Hospede` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Hospede` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Data_Nascimento` date NOT NULL,
  `CPF` varchar(14) CHARACTER SET latin1 NOT NULL,
  `RG` varchar(12) CHARACTER SET latin1 NOT NULL,
  `Endereco` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Numero` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `Complemento` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `Bairro` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Cidade` varchar(40) CHARACTER SET latin1 NOT NULL,
  `UF` char(2) CHARACTER SET latin1 NOT NULL,
  `Telefone` varchar(18) CHARACTER SET latin1 NOT NULL,
  `Celular` varchar(18) CHARACTER SET latin1 DEFAULT NULL,
  `Empresa` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `Nome_Usuario` varchar(20) CHARACTER SET latin1 NOT NULL,
  `Senha_Acesso` varchar(12) CHARACTER SET latin1 NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `Data_Inclusao` date DEFAULT NULL,
  `Email` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Hospede`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Structure for the `historico_hospedagem` table : 
#

CREATE TABLE `historico_hospedagem` (
  `ID_Registro` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo_Hospede` int(11) NOT NULL,
  `Codigo_Apartamento` int(11) NOT NULL,
  `Inicio_Hospedagem` date NOT NULL,
  `Fim_Hospedagem` date NOT NULL,
  `Valor_Diaria` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_Registro`),
  KEY `Codigo_Hospede` (`Codigo_Hospede`),
  KEY `Codigo_Apartamento` (`Codigo_Apartamento`),
  CONSTRAINT `historico_hospedagem_fk1` FOREIGN KEY (`Codigo_Hospede`) REFERENCES `hospedes` (`Codigo_Hospede`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `historico_hospedagem_fk2` FOREIGN KEY (`Codigo_Apartamento`) REFERENCES `apartamentos` (`ID_Registro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Structure for the `nivel_acesso` table : 
#

CREATE TABLE `nivel_acesso` (
  `Codigo_Nivel` smallint(6) NOT NULL AUTO_INCREMENT,
  `Descricao_Nivel` varchar(30) CHARACTER SET latin1 NOT NULL,
  `Cadastro_Funcionario` char(1) CHARACTER SET latin1 DEFAULT 'N',
  `Cadastro_Usuario` char(1) CHARACTER SET latin1 DEFAULT 'N',
  `Cadastro_Nivel_Acesso` char(1) CHARACTER SET latin1 DEFAULT 'N',
  `Pesquisa_Apartamento` char(1) CHARACTER SET latin1 DEFAULT 'N',
  `Cadastro_Hospede` char(1) CHARACTER SET latin1 DEFAULT 'N',
  `Registro_Hospedagem` char(1) CHARACTER SET latin1 DEFAULT 'N',
  `Fechamento_Conta` char(1) CHARACTER SET latin1 DEFAULT 'N',
  PRIMARY KEY (`Codigo_Nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Structure for the `usuarios` table : 
#

CREATE TABLE `usuarios` (
  `Codigo_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_Usuario` varchar(20) CHARACTER SET latin1 NOT NULL,
  `Senha_Acesso` varchar(10) CHARACTER SET latin1 NOT NULL,
  `Nivel_Acesso` smallint(6) NOT NULL,
  `Codigo_Hotel` smallint(6) NOT NULL,
  PRIMARY KEY (`Codigo_Usuario`),
  KEY `Nome_Usuario` (`Nome_Usuario`),
  KEY `Nivel_Acesso` (`Nivel_Acesso`),
  CONSTRAINT `usuarios_fk` FOREIGN KEY (`Nivel_Acesso`) REFERENCES `nivel_acesso` (`Codigo_Nivel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;