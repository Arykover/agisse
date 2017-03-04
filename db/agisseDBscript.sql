CREATE TABLE etablissements (
id_etablissement int(11) primary key AUTO_INCREMENT,
denomination varchar(50),
caisse_prim varchar(6),
n_agrement varchar(6),
code_grand_regime varchar(5)
);

CREATE TABLE annee_scolaire (
annee varchar(9) primary key,
date_effet_affiliation date
);

CREATE TABLE caisses_etudiante (
code_caisse varchar(5) primary key,
libelle_caisse varchar(30)
);

CREATE TABLE nationalites (
code_nationalite varchar(5),
libelle_nationalite varchar(20)
);

CREATE TABLE statuts (
code_statut varchar(5) primary key,
libelle_statut varchar(30)
);

CREATE TABLE disciplines (
id_discipline int(11) primary key AUTO_INCREMENT,
libelle_discipline varchar(50),
annee_par_cycle int,
cycle_etude_actuel int
);

CREATE TABLE etats (
id_etat int(11) primary key AUTO_INCREMENT,
libelle_etat varchar(20)
);

CREATE TABLE comptes (
id_compte int(11) primary key AUTO_INCREMENT,
login varchar(20),
pass varchar(60),
nom varchar(20),
prenom varchar(20),
mail varchar(20)
);

CREATE TABLE fiches (
 id_fiche int(11) primary key,
  nom_marital varchar(100) DEFAULT NULL,
  adresse varchar(150) DEFAULT NULL,
  comp_adresse varchar(150) DEFAULT NULL,
  ville varchar(100) DEFAULT NULL,
  cp varchar(5) DEFAULT NULL,
  date_naiss date DEFAULT NULL,
  dept_naiss varchar(2) DEFAULT NULL,
  commune varchar(100) DEFAULT NULL,
  num_secu varchar(15) DEFAULT NULL,
  telephone varchar(10) DEFAULT NULL,
  paiement int DEFAULT NULL,
  observations_eleve varchar(250) DEFAULT NULL,
  observations_gest varchar(250) DEFAULT NULL,
  discipline int(11) DEFAULT NULL,
  statut varchar(5) DEFAULT NULL,
  pays_naiss varchar(5) DEFAULT NULL,
  nationalite varchar(5) DEFAULT NULL,
  civilite int(11) DEFAULT NULL,
  etablissement int(11) DEFAULT NULL,
  etat int(11) DEFAULT NULL,
  caisse varchar(5) DEFAULT NULL,
  annee_scolaire varchar(9) DEFAULT NULL, 
  date_inscription date DEFAULT NULL,
  FOREIGN KEY (id_fiche) REFERENCES comptes (id_compte),
  FOREIGN KEY (discipline) REFERENCES disciplines (id_discipline),
  FOREIGN KEY (statut) REFERENCES statuts (id_statut),
  FOREIGN KEY (etat) REFERENCES statuts (id_etat),
  FOREIGN KEY (pays_naiss) REFERENCES nationalites (code_nationalite),
  FOREIGN KEY (nationalite) REFERENCES nationalites (code_nationalite),
  FOREIGN KEY (caisse) REFERENCES caisses_etudiante (code_caisse),
  FOREIGN KEY (annee_scolaire) REFERENCES annee_scolaire(annee),
  FOREIGN KEY (etablissement) REFERENCES etablissements(id_etablissement)
);

