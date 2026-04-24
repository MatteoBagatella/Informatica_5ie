CREATE DATABASE SitoWebF1;

use SitoWebF1;

CREATE Table utente(
    utenteId INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cognome VARCHAR(255) NOT NULL,
    utenteDataNascita DATE NOT NULL,
    idAbbonamento INT,
    nomeFanClub VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL

)


CREATE Table pista(
    nomePista VARCHAR(255) PRIMARY KEY,
    nazione VARCHAR(255) NOT NULL,
    lunghezza INT NOT NULL,
    nCurve INT(2) NOT NULL,
    giri INT(2) NOT NULL,
    recordPista VARCHAR(255)NOT NULL,
    annoPrimoGP INT(4) NOT NULL
)

CREATE Table abbonamento(
    idAbbonamento INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(255) NOT NULL,
    numPiste INT NOT NULL
)

CREATE table team(
    nomeTeam VARCHAR(255) PRIMARY KEY,
    teamPrincipal VARCHAR(255) NOT NULL,
    gareDisputateTeam INT NOT NULL,
    vittorieTeam INT NOT NULL,
    podiTeam INT NOT NULL,
    poleTeam INT NOT NULL,
    nCampioniCostruttori INT NOT NULL,
    sede VARCHAR(255) NOT NULL,
    annoPrimoGPTeam INT(4) NOT NULL
)

create Table pilota(
    numPilota INT PRIMARY KEY,
    nomeTeam VARCHAR(255) NOT NULL,
    nomePilota VARCHAR(255) NOT NULL,
    cognomePilota VARCHAR(255) NOT NULL,
    dataNascitaPilota DATE NOT NULL,
    nazionalita VARCHAR(255) NOT NULL,
    gareDisputatePilota INT NOT NULL,
    vittoriePilota INT NOT NULL,
    podiPilota INT NOT NULL,
    polePilota INT NOT NULL,
    nCampioniPilota INT NOT NULL,
    dnf INT NOT NULL,
    FOREIGN KEY (nomeTeam) REFERENCES team(nomeTeam)
)

CREATE Table fanClub(
    nomeFanClub VARCHAR(255) PRIMARY KEY,
    nomeTeam VARCHAR(255) NOT NULL,
    membri INT NOT NULL,
    FOREIGN KEY (nomeTeam) REFERENCES team(nomeTeam)
)

CREATE Table ticket(
    idTicket INT PRIMARY KEY AUTO_INCREMENT,
    nomePista VARCHAR(255) NOT NULL,
    prezzo DECIMAL(8,2) NOT NULL,
    utenteId INT ,
    FOREIGN KEY (nomePista) REFERENCES pista(nomePista),
    FOREIGN KEY (utenteId) REFERENCES utente(utenteId)
)

CREATE Table notizia(
    notiziaId INT PRIMARY KEY AUTO_INCREMENT,
    descrizione VARCHAR(255) NOT NULL,
    percorsoImmagine VARCHAR(255) NOT NULL,
    id_div VARCHAR(255) NOT NULL
)

ALTER TABLE pilota ADD fotoPilota VARCHAR(10000) NOT NULL;
ALTER TABLE team ADD fotoMacchina VARCHAR(10000) NOT NULL;
ALTER TABLE pilota ADD logoTeam VARCHAR(1000) NOT NULL;
ALTER TABLE team ADD logoTeam VARCHAR(1000) NOT NULL;

