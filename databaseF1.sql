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
    password VARCHAR(255) NOT NULL,
    Foreign Key (idAbbonamento) REFERENCES abbonamento(idAbbonamento)
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
    idTeam INT AUTO_INCREMENT PRIMARY KEY,
    nomeTeam VARCHAR(255),
    nomeTeamPrincipal VARCHAR(255) NOT NULL,
    cognomeTeamPrincipal VARCHAR(255) NOT NULL,
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
    idTeam INT NOT NULL,
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
    FOREIGN KEY (idTeam) REFERENCES team(idTeam)
)

CREATE Table fanClub(
    nomeFanClub VARCHAR(255) PRIMARY KEY,
    idTeam INT NOT NULL,
    membri INT NOT NULL,
    descrizione VARCHAR(1000) NOT NULL,
    imgTeam VARCHAR(10000) NOT NULL,
    FOREIGN KEY (idTeam) REFERENCES team(idTeam)
)

CREATE Table ticket(
    idTicket INT PRIMARY KEY AUTO_INCREMENT,
    nomePista VARCHAR(255) NOT NULL,
    prezzo DECIMAL(8,2) NOT NULL,
    utenteId INT NOT NULL,
    FOREIGN KEY (nomePista) REFERENCES pista(nomePista),
    FOREIGN KEY (utenteId) REFERENCES utente(utenteId) ON DELETE SET NULL
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

ALTER TABLE utente ADD FOREIGN KEY (nomeFanClub) REFERENCES fanClub(nomeFanClub) ON DELETE SET NULL;

alter table pista add prezzoBiglietto DECIMAL(8,2) NOT NULL;
ALTER TABLE pista ADD imgPista VARCHAR(10000) NOT NULL DEFAULT '';





/*DEVO PRENDERE I LINK DELLE FOTO DELLE MACCHINE*/
--------------------------------------------------
INSERT INTO pilota (numPilota, idTeam, nomePilota, cognomePilota, dataNascitaPilota, nazionalita, gareDisputatePilota, vittoriePilota, podiPilota, polePilota, nCampioniPilota, dnf, fotoPilota, logoTeam) VALUES

( 3, 4, "Max", "Verstappen", '1997-09-30', 'Paesi Bassi', 200, 50, 120, 40, 3, 10,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/v1740000001/common/f1/2026/redbullracing/maxver01/2026redbullracingmaxver01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/redbullracing/2026redbullracinglogowhite.webp'),

( 6, 4, "Isack", "Hadjar", '1995-05-15', 'Francese', 4, 0, 0, 0, 0, 1,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/redbull/serper01/2026redbullserper01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/redbullracing/2026redbullracinglogowhite.webp'),

( 44, 2, "Lewis", "Hamilton", '1985-01-07', 'Regno Unito',410, 105, 210, 106, 7, 34,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/ferrari/lewham01/2026ferrarilewham01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/ferrari/2026ferrarilogowhite.webp'),

( 16, 2, "Charles", "Leclerc", '1997-10-14', 'Monaco',200, 8, 60, 28, 0, 23,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/ferrari/chalec01/2026ferrarichalec01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/ferrari/2026ferrarilogowhite.webp'),

( 1, 1, "Lando", "Norris", '1999-11-13', 'Regno Unito',154, 9, 38, 12, 1, 16,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/mclaren/lannor01/2026mclarenlanror01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/mclaren/2026mclarenlogowhite.webp'),

( 81, 1, "Oscar", "Piastri", '2001-04-23', 'Australia',54, 6, 20, 4, 0, 5,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/mclaren/ospia01/2026mclarenospia01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/mclaren/2026mclarenlogowhite.webp'),

( 14, 5, "Fernando", "Alonso", '1981-07-29', 'Spagna',410, 32, 108, 22, 2, 24,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/astonmartin/feralo01/2026astonmartinferalo01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/astonmartin/2026astonmartinlogowhite.webp'),

( 18, 5, "Lance", "Stroll", '1998-03-18', 'Canada',172, 3, 10, 1, 0, 18,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/astonmartin/lanstr01/2026astonmartinlanstr01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/astonmartin/2026astonmartinlogowhite.webp'),

( 63, 3, "George", "Russell", '1998-02-05', 'Regno Unito',134, 5, 19, 7, 0, 15,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/mercedes/geruss01/2026mercedesgeruss01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/mercedes/2026mercedeslogowhite.webp'),

( 12, 3, "Kimi", "Antonelli", '2000-12-13', 'Italia', 4, 3, 4, 3, 0, 0,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/mercedes/kima01/2026mercedeskima01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/mercedes/2026mercedeslogowhite.webp'),

( 55, 8, "Carlos", "Sainz", '1998-09-01', 'Spagna',215, 4, 27, 6, 0, 21,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/williams/carsai01/2026williamscarsai01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/williams/2026williamslogowhite.webp'),

( 23, 8, "Alexander", "Albon", '1998-03-23', 'Thailandia',110, 0, 2, 0, 0, 14,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/williams/alealb01/2026williamsalealb01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/williams/2026williamslogowhite.webp'),

( 10, 6, "Pierre", "Gasly", '1996-03-07', 'Francia',164, 1, 5, 0, 0, 20,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/alpine/piegas01/2026alpinepiegas01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/alpine/2026alpinelogowhite.webp'),

( 43, 6, "Franco", "Colapinto", '2003-05-15', 'Argentina',13, 0, 0, 0, 0, 2,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/alpine/fraoco01/2026alpinefraoco01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/alpine/2026alpinelogowhite.webp'),

( 31, 7, "Esteban", "Ocon", '1996-05-15', 'Francia',1, 4, 0, 0, 17, 0,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/haas/estoco01/2026haasestoco01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/haas/2026haaslogowhite.webp'),

( 87, 7, "Oliver", "Bearman", '2000-07-15', 'Regno Unito', 11, 0, 1, 0, 0, 1,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/haas/olibea01/2026haasolibea01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/haas/2026haaslogowhite.webp'),

( 27, 9, "Nico", "Hulkenberg", '1987-05-10', 'Germania',234, 0, 0, 1, 0, 27,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/sauber/nichul01/2026saubernichul01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/audi/2026audilogowhite.webp'),

( 5, 9, "Gabriel", "Bortoleto", '2003-09-29', 'Brasile', 4, 0, 0, 0, 0, 0,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/sauber/gabbo01/2026saubergabbo01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/audi/2026audilogowhite.webp'),

( 11, 11, "Sergio", "Perez", '1990-01-01', 'Messico', 286, 6, 39, 3, 0, 29,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/cadillac/serper01/2026cadillacserper01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/cadillac/2026cadillaclogowhite.webp'),

( 77, 11, "Valtteri", "Bottas", '1989-08-29', 'Finlandia',252, 10, 67, 20, 0, 22,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/cadillac/valbot01/2026cadillacvalbot01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/cadillac/2026cadillaclogowhite.webp'),

( 30, 10, "Liam", "Lawson", '2002-02-11', 'Nuova Zelanda', 16, 0, 0, 0, 0, 2,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/common/f1/2026/racingbulls/lialaw01/2026racingbullslialaw01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/racingbulls/2026racingbullslogowhite.webp'),

( 22, 10, "Arvid", "Lindblad", '2007-08-08', 'Britannica', 4, 0, 0, 0, 0, 0,
 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/d_common:f1:2026:fallback:driver:2026fallbackdriverright.webp/v1740000001/common/f1/2026/racingbulls/arvlin01/2026racingbullsarvlin01right.webp',
 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/racingbulls/2026racingbullslogowhite.webp');

 INSERT INTO team (nomeTeam, nomeTeamPrincipal, cognomeTeamPrincipal, gareDisputateTeam, vittorieTeam, podiTeam, poleTeam, nCampioniCostruttori, sede, annoPrimoGPTeam, fotoMacchina, logoTeam) VALUES
 ("McLaren", "Andrea", "Stella", 980, 196, 542, 171, 9, "Woking UK", 1966,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/mclaren/2026mclarencarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/mclaren/2026mclarenlogowhite.webp"),
  
  
  ("Ferrari", "Frederic", "Vasseur", 1112, 249, 830, 253, 16, "Maranello Italy", 1950,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/ferrari/2026ferraricarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/ferrari/2026ferrarilogowhite.webp"),
  
  ("Mercedes", "Toto", "Wolff", 330, 129, 298, 140, 8, "Brackley UK", 1954,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/mercedes/2026mercedescarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/mercedes/2026mercedeslogowhite.webp"),
  
  ("Red Bull Racing", "Christian", "Horner", 410, 124, 287, 108, 6, "Milton Keynes UK", 2005,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/redbullracing/2026redbullracingcarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/redbullracing/2026redbullracinglogowhite.webp"),
  
  ("Aston Martin", "Mike", "Krack", 120, 1, 10, 1, 0, "Silverstone UK", 1959,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/astonmartin/2026astonmartincarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/astonmartin/2026astonmartinlogowhite.webp"),
  
  ("Alpine", "Bruno", "Famin", 95, 1, 5, 0, 2, "Enstone UK", 1986,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/alpine/2026alpinecarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/alpine/2026alpinelogowhite.webp"),
  
  ("Haas F1 Team", "Ayao", "Komatsu", 215, 0, 0, 1, 0, "Kannapolis USA", 2016,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/haasf1team/2026haasf1teamcarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/haas/2026haaslogowhite.webp"),
  
  ("Williams", "James", "Vowles", 860, 114, 313, 128, 9, "Grove UK", 1978,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/williams/2026williamscarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/williams/2026williamslogowhite.webp"),
  
  ("Audi", "Jonathan", "Wheatley", 4, 0, 0, 0, 0, "Hinwil Switzerland", 2026,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/audi/2026audicarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/audi/2026audilogowhite.webp"),
  
  ("Racing Bulls", "Peter", "Bayer", 380, 2, 3, 1, 0, "Faenza Italy", 2006,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/racingbulls/2026racingbullscarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/racingbulls/2026racingbullslogowhite.webp"),
  
  ("Cadillac", "Graeme", "Lowdon", 4, 0, 0, 0, 0, "Fishers USA", 2026,
  "https://media.formula1.com/image/upload/c_lfill,h_224/q_auto/d_common:f1:2026:fallback:car:2026fallbackcarright.webp/v1740000001/common/f1/2026/cadillac/2026cadillaccarright.webp",
  "https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/cadillac/2026cadillaclogowhite.webp");

  UPDATE pilota SET fotoPilota = 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/d_common:f1:2026:fallback:driver:2026fallbackdriverright.webp/v1740000001/common/f1/2026/mclaren/lannor01/2026mclarenlannor01right.webp' WHERE numPilota = 1;
  UPDATE pilota SET fotoPilota = 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/d_common:f1:2026:fallback:driver:2026fallbackdriverright.webp/v1740000001/common/f1/2026/mclaren/oscpia01/2026mclarenoscpia01right.webp' WHERE numPilota = 81;
  UPDATE pilota SET fotoPilota = 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/d_common:f1:2026:fallback:driver:2026fallbackdriverright.webp/v1740000001/common/f1/2026/redbullracing/isahad01/2026redbullracingisahad01right.webp' WHERE numPilota = 6;

  UPDATE pilota SET fotoPilota = 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/d_common:f1:2026:fallback:driver:2026fallbackdriverright.webp/v1740000001/common/f1/2026/alpine/fracol01/2026alpinefracol01right.webp' WHERE numPilota = 43;
  UPDATE pilota SET fotoPilota = 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/d_common:f1:2026:fallback:driver:2026fallbackdriverright.webp/v1740000001/common/f1/2026/audi/nichul01/2026audinichul01right.webp' WHERE numPilota = 27;
  
  UPDATE pilota SET fotoPilota = 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/d_common:f1:2026:fallback:driver:2026fallbackdriverright.webp/v1740000001/common/f1/2026/mercedes/andant01/2026mercedesandant01right.webp' WHERE numPilota = 12;
  UPDATE pilota SET fotoPilota = 'https://media.formula1.com/image/upload/c_lfill,w_440/q_auto/d_common:f1:2026:fallback:driver:2026fallbackdriverright.webp/v1740000001/common/f1/2026/mercedes/georus01/2026mercedesgeorus01right.webp' WHERE numPilota = 63;
  


  INSERT INTO fanClub (nomeFanClub, idTeam, membri, descrizione, imgTeam) VALUES
('McLaren Fan Club', 1, 15420, 'Il fan club ufficiale della McLaren, il team più vincente degli anni 80 e 90. Unisciti alla famiglia papaya!', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/mclaren/2026mclarenlogowhite.webp'),
('Ferrari Fan Club', 2, 48300, 'La Scuderia Ferrari è il team più titolato della storia della Formula 1. Forza Ferrari!', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/ferrari/2026ferrarilogowhite.webp'),
('Mercedes Fan Club', 3, 22100, 'Il fan club della stella d\'argento, dominatore dell\'era ibrida con 8 titoli costruttori consecutivi.', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/mercedes/2026mercedeslogowhite.webp'),
('Red Bull Fan Club', 4, 31500, 'Il fan club del team energizzante. Quattro titoli costruttori e il dominatore della scena moderna.', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/redbullracing/2026redbullracinglogowhite.webp'),
('Aston Martin Fan Club', 5, 8700, 'Il fan club del team britannico di lusso, con Fernando Alonso come punto di riferimento.', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/astonmartin/2026astonmartinlogowhite.webp'),
('Alpine Fan Club', 6, 9200, 'Il fan club del team francese, erede della gloriosa tradizione Renault in Formula 1.', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/alpine/2026alpinelogowhite.webp'),
('Haas Fan Club', 7, 5100, 'Il fan club del team americano, l\'ultimo debuttante storico della griglia prima di Audi e Cadillac.', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/haas/2026haaslogowhite.webp'),
('Williams Fan Club', 8, 12800, 'Il fan club del team più vincente degli anni 90 insieme alla McLaren. Una storia leggendaria.', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/williams/2026williamslogowhite.webp'),
('Audi Fan Club', 9, 6300, 'Il fan club del nuovo team Audi, debuttante nella stagione 2026. Una nuova era inizia!', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/audi/2026audilogowhite.webp'),
('Racing Bulls Fan Club', 10, 7400, 'Il fan club del team satellite Red Bull, fucina di talenti per la Formula 1 del futuro.', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/racingbulls/2026racingbullslogowhite.webp'),
('Cadillac Fan Club', 11, 4800, 'Il fan club del team americano Cadillac, il secondo debuttante della stagione 2026.', 'https://media.formula1.com/image/upload/c_lfill,w_48/q_auto/v1740000001/common/f1/2026/cadillac/2026cadillaclogowhite.webp');

INSERT INTO abbonamento (tipo, numPiste) VALUES
('Base', 3),
('Mid', 6),
('Plus', 9),
('Premium', 11);

INSERT INTO pista (nomePista, nazione, lunghezza, nCurve, giri, recordPista, annoPrimoGP, prezzoBiglietto) VALUES
('Bahrain International Circuit', 'Bahrain', 5412, 15, 57, '1:31.447', 2004, 150.00),
('Jeddah Corniche Circuit', 'Arabia Saudita', 6174, 27, 50, '1:30.734', 2021, 180.00),
('Albert Park Circuit', 'Australia', 5278, 16, 58, '1:20.235', 1996, 160.00),
('Suzuka Circuit', 'Giappone', 5807, 18, 53, '1:30.983', 1987, 170.00),
('Shanghai International Circuit', 'Cina', 5451, 16, 56, '1:32.238', 2004, 155.00),
('Miami International Autodrome', 'USA', 5412, 19, 57, '1:29.708', 2022, 200.00),
('Autodromo Enzo e Dino Ferrari', 'Italia', 4909, 19, 63, '1:15.484', 1980, 140.00),
('Circuit de Monaco', 'Monaco', 3337, 19, 78, '1:12.909', 1950, 250.00),
('Circuit Gilles Villeneuve', 'Canada', 4361, 14, 70, '1:13.078', 1978, 165.00),
('Circuit de Barcelona-Catalunya', 'Spagna', 4657, 16, 66, '1:16.330', 1991, 145.00),
('Red Bull Ring', 'Austria', 4318, 10, 71, '1:05.619', 1970, 140.00),
('Silverstone Circuit', 'Regno Unito', 5891, 18, 52, '1:27.097', 1950, 175.00),
('Hungaroring', 'Ungheria', 4381, 14, 70, '1:16.627', 1986, 135.00),
('Circuit de Spa-Francorchamps', 'Belgio', 7004, 19, 44, '1:46.286', 1950, 190.00),
('Circuit Zandvoort', 'Paesi Bassi', 4259, 14, 72, '1:11.097', 1952, 160.00),
('Autodromo Nazionale Monza', 'Italia', 5793, 11, 53, '1:21.046', 1950, 155.00),
('Baku City Circuit', 'Azerbaigian', 6003, 20, 51, '1:43.009', 2016, 170.00),
('Marina Bay Street Circuit', 'Singapore', 4940, 23, 62, '1:35.867', 2008, 185.00),
('Circuit of the Americas', 'USA', 5513, 20, 56, '1:36.169', 2012, 195.00),
('Autodromo Hermanos Rodriguez', 'Messico', 4304, 17, 71, '1:17.774', 1963, 150.00),
('Autodromo Jose Carlos Pace', 'Brasile', 4309, 15, 71, '1:10.540', 1973, 145.00),
('Las Vegas Strip Circuit', 'USA', 6201, 17, 50, '1:35.490', 2023, 220.00),
('Losail International Circuit', 'Qatar', 5380, 16, 57, '1:24.319', 2021, 160.00),
('Yas Marina Circuit', 'UAE', 5281, 16, 58, '1:26.103', 2009, 175.00);


UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Bahrain%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Bahrain International Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Saudi%20Arabia%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Jeddah Corniche Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Australia%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Albert Park Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Japan%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Suzuka Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/China%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Shanghai International Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Miami%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Miami International Autodrome';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Emilia%20Romagna%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Autodromo Enzo e Dino Ferrari';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Monaco%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Circuit de Monaco';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Canada%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Circuit Gilles Villeneuve';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Spain%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Circuit de Barcelona-Catalunya';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Austria%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Red Bull Ring';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Great%20Britain%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Silverstone Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Hungary%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Hungaroring';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Belgium%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Circuit de Spa-Francorchamps';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Netherlands%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Circuit Zandvoort';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Italy%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Autodromo Nazionale Monza';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Azerbaijan%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Baku City Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Singapore%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Marina Bay Street Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/USA%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Circuit of the Americas';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Mexico%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Autodromo Hermanos Rodriguez';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Brazil%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Autodromo Jose Carlos Pace';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Las%20Vegas%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Las Vegas Strip Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Qatar%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Losail International Circuit';
UPDATE pista SET imgPista = 'https://media.formula1.com/image/upload/f_auto/q_auto/v1677244985/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Abu%20Dhabi%20carbon.png.transform/2col/image.png' WHERE nomePista = 'Yas Marina Circuit';