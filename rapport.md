
[TOC]

#Projet Base de données
__Auteurs :__ Stéphanie LEVON & Vincent ROCHER
#Introduction
##Sujet 
Le but de ce projet est de gérer des examens demandés par des prescripteurs. Un examen consistera en l'étude, pour un patient donné, d'un panel de gènes et produira un rapport/compte-rendu clinique.
##Schéma de la base
![schéma_base](schema_base.jpg)
#Création des tables
##Table `type_personnel`
###Description
type_personnel_id | type_personnel_nom 
:-----: | :------
INT | VARCHAR
1 | Administrateur
2 | Préscripteur
3 | Clinicien


###Création de la table
``` sql
CREATE TABLE type_personnel (
    type_personnel_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    type_personnel_nom VARCHAR(60) NOT NULL
)
ENGINE=InnoDB;          
```

##Table `personnel`
###Description
personnel_id | personnel_nom | personnel_prenom | personnel_mail | personnel_password | personnel_type_personnel_id
:-----: | :------: | :------: | :------: | :------: | :------ 
INT | VARCHAR | VARCHAR | VARCHAR | CHAR(SHA1) | INT

``` sql
CREATE TABLE personnel (
    personnel_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    personnel_prenom VARCHAR(60) NOT NULL,
    personnel_nom VARCHAR(60) NOT NULL,
    personnel_mail VARCHAR(100) DEFAULT NULL,
    personnel_identifiant VARCHAR(60) NOT NULL,
    personnel_password CHAR(40) CHARACTER SET ASCII NOT NULL,
    personnel_type_personnel_id INT UNSIGNED,
    UNIQUE KEY personnel_uni_mail (personnel_mail),
    UNIQUE KEY personnel_uni_identifiant (personnel_identifiant),
    CONSTRAINT fk_type_personnel_id
        FOREIGN KEY (personnel_type_personnel_id) 
        REFERENCES type_personnel(type_personnel_id)
)
ENGINE=InnoDB;          
```
## Table `patient`
###Description
patient_id | patient_num_secu | patient_prenom | patient_nom | patient_mail | patient_sexe | patient_ethnie | patient_date_naissance | patient_num_tel | patient_pere_id | patient_mere_id | patient_prescripteur_id | patient_clinicien_id
:-----: | :------: | :-----: | :-----: | :-----: | :-----: | :-----: | :-----: | :-----: | :-----: | :-----: | :-----: | :-----
INT | INT | VARCHAR | VARCHAR | VARCHAR | VARCHAR | VARCHAR | DATE | VARCHAR | INT | INT | INT | INT


###Création de la table
``` sql
CREATE TABLE patient (
    patient_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    patient_num_secu INT UNSIGNED NOT NULL,
    patient_prenom VARCHAR(60) NOT NULL,
    patient_nom VARCHAR(60) NOT NULL,
    patient_mail VARCHAR(100) DEFAULT NULL,
    patient_sexe VARCHAR(10) DEFAULT NULL,
    patient_ethnie VARCHAR(60) DEFAULT NULL,
    patient_date_naissance DATE DEFAULT NULL,
    patient_num_tel VARCHAR(10) DEFAULT NULL,
    patient_pere_id INT UNSIGNED,
    patient_mere_id INT UNSIGNED,
    patient_prescripteur_id INT UNSIGNED,
    patient_clinicien_id INT UNSIGNED,
    UNIQUE KEY patient_uni_mail (patient_mail),
    CONSTRAINT fk_pere_id
        FOREIGN KEY (patient_pere_id) 
        REFERENCES patient(patient_id),
    CONSTRAINT fk_mere_id 
        FOREIGN KEY (patient_mere_id) 
        REFERENCES patient(patient_id),
    CONSTRAINT fk_prescripteur_id
        FOREIGN KEY (patient_prescripteur_id) 
        REFERENCES personnel(personnel_id),
    CONSTRAINT fk_clinicien_id
        FOREIGN KEY (patient_clinicien_id) 
        REFERENCES personnel(personnel_id)   
)
ENGINE=InnoDB;          
```
