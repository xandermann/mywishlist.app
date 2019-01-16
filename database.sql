CREATE TABLE categorie(
  codeCateg INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nomCateg VARCHAR(80) NOT NULL,
  description VARCHAR(200)
);

CREATE TABLE image(
  idImage INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  path VARCHAR(100) NOT NULL
);

CREATE TABLE user(
  idUser INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  userName VARCHAR(80),
  crypted_pass VARCHAR(80)
);

CREATE TABLE message(
  idMessage INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  contenu VARCHAR(200) NOT NULL
);

CREATE TABLE liste(
  titreListe VARCHAR(80) PRIMARY KEY NOT NULL,
  description VARCHAR(200),
  dateLimite DATE
);

CREATE TABLE items(
  nomItem VARCHAR(80) PRIMARY KEY NOT NULL,
  descriptif VARCHAR(200),
  tarif DOUBLE NOT NULL ,
  url VARCHAR(60) NOT NULL,
  codeCateg INTEGER
);

ALTER TABLE items
    ADD FOREIGN KEY (codeCateg) REFERENCES categorie(codeCateg);

CREATE TABLE decris(
  idImage INTEGER NOT NULL,
  id INTEGER NOT NULL
);

ALTER TABLE decris
    ADD PRIMARY KEY (idImage,id),
    ADD FOREIGN KEY (idImage) REFERENCES image(idImage),
    ADD FOREIGN KEY (id) REFERENCES items(id);

CREATE TABLE estDans(
  titreListe VARCHAR(80) NOT NULL,
  nomItem VARCHAR(80) NOT NULL
);

ALTER TABLE estDans
    ADD PRIMARY KEY (titreListe,nomItem),
    ADD FOREIGN KEY (titreListe) REFERENCES liste(titreListe),
    ADD FOREIGN KEY (nomItem) REFERENCES items(nomItem);

CREATE TABLE typeContributeur(
  idType INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  libelle VARCHAR(60) NOT NULL
);

CREATE TABLE contribue(
  idUser INTEGER NOT NULL,
  titreListe VARCHAR(80) NOT NULL,
  idType INTEGER NOT NULL
);

ALTER TABLE contribue
    ADD PRIMARY KEY (idUser,titreListe,idType),
    ADD FOREIGN KEY (idUser) REFERENCES user(idUser),
    ADD FOREIGN KEY (titreListe) REFERENCES liste(titreListe),
    ADD FOREIGN KEY (idType) REFERENCES typeContributeur(idType);

CREATE TABLE poste(
  idPoste INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  idMessage INTEGER NOT NULL,
  titreListe VARCHAR(80) NOT NULL,
  idUser INTEGER NOT NULL
);

ALTER TABLE poste
    ADD FOREIGN KEY (idMessage) REFERENCES message(idMessage),
    ADD FOREIGN KEY (titreListe) REFERENCES liste(titreListe),
    ADD FOREIGN KEY (idUser) REFERENCES user(idUser);

CREATE TABLE concerne(
  idPoste INTEGER NOT NULL,
  nomItem VARCHAR(80) NOT NULL
);

ALTER TABLE concerne
    ADD PRIMARY KEY (idPoste,nomItem),
    ADD FOREIGN KEY (idPoste) REFERENCES poste(idPoste),
    ADD FOREIGN KEY (nomItem) REFERENCES items(nomItem);