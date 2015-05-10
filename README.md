<h1 style="text-align: center;">Projet Base de données</h1>
__Auteurs :__ Stéphanie LEVON & Vincent ROCHER

#Introduction
##Sujet 
Le but de ce projet est de gérer des examens demandés par des prescripteurs. Un examen consistera en l'étude, pour un patient donné, d'un panel de gènes et produira un rapport/compte-rendu clinique.
##Schéma de la base
![schéma_base](https://rawgit.com/rochevin/projet_BDD/master/schema_base.svg)
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
    personnel_type_personnel_id INT UNSIGNED NOT NULL,
    UNIQUE KEY personnel_uni_identifiant (personnel_identifiant),
    CONSTRAINT fk_type_personnel_id
        FOREIGN KEY (personnel_type_personnel_id) 
        REFERENCES type_personnel(type_personnel_id)
        ON DELETE SET NULL
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;        
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
    patient_pere_id INT UNSIGNED DEFAULT NULL,
    patient_mere_id INT UNSIGNED DEFAULT NULL,
    patient_prescripteur_id INT UNSIGNED DEFAULT NULL,
    patient_clinicien_id INT UNSIGNED DEFAULT NULL,
    UNIQUE KEY patient_uni_mail (patient_mail),
    CONSTRAINT fk_pere_id
        FOREIGN KEY (patient_pere_id) 
        REFERENCES patient(patient_id)
        ON DELETE SET NULL,
    CONSTRAINT fk_mere_id 
        FOREIGN KEY (patient_mere_id) 
        REFERENCES patient(patient_id)
        ON DELETE SET NULL,
    CONSTRAINT fk_prescripteur_id
        FOREIGN KEY (patient_prescripteur_id) 
        REFERENCES personnel(personnel_id)
        ON DELETE SET NULL,
    CONSTRAINT fk_clinicien_id
        FOREIGN KEY (patient_clinicien_id) 
        REFERENCES personnel(personnel_id)
        ON DELETE SET NULL   
)
ENGINE=InnoDB;         
```

##Table `panel_gene`
###Description
panel_gene_id | panel_gene_nom
:-----: | :------ 
INT | VARCHAR



###Création de la table
``` sql
CREATE TABLE panel_gene (
    panel_gene_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    panel_gene_nom VARCHAR(60) NOT NULL
)
ENGINE=InnoDB;          
```

##Table `gene`
###Description
gene_id | gene_nom | gene_chromosome
:-----: | :-----: | :------ 
INT | VARCHAR | CHAR



###Création de la table
``` sql
CREATE TABLE gene (
    gene_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    gene_nom VARCHAR(60) NOT NULL,
    gene_chromosome CHAR(2) DEFAULT NULL
)
ENGINE=InnoDB;          
```

##Table `assoc_panel_gene`
###Description
assoc_gene_id | assoc_panel_id
:-----: | :------ 
INT | INT



###Création de la table
``` sql
CREATE TABLE assoc_panel_gene(
    assoc_gene_id INT NOT NULL,
    assoc_panel_id INT NOT NULL,
    CONSTRAINT pk_assoc PRIMARY KEY (assoc_gene_id,assoc_panel_id),
    CONSTRAINT fk_assoc_gene_id FOREIGN KEY (assoc_gene_id)
        REFERENCES gene(gene_id)
        ON DELETE CASCADE,
    CONSTRAINT fk_assoc_panel_id FOREIGN KEY (assoc_panel_id)
        REFERENCES panel_gene(panel_gene_id)
        ON DELETE CASCADE
)
ENGINE=InnoDB;    
```

##Table `examen`
###Description
examen_id | examen_nom | examen_date | examen_patient_id | examen_panel_gene_id
:-----: | :-----: | :-----: | :-----: | :------ 
INT | VARCHAR | DATE | INT | INT



###Création de la table
``` sql
CREATE TABLE examen (
    examen_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    examen_nom VARCHAR(60) NOT NULL,
    examen_date DATE DEFAULT NULL,
    examen_patient_id INT UNSIGNED NOT NULL,
    examen_panel_gene_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_patient_id
        FOREIGN KEY (examen_patient_id) 
        REFERENCES patient(patient_id)
        ON DELETE CASCADE,
    CONSTRAINT fk_panel_gene_id
        FOREIGN KEY (examen_panel_gene_id) 
        REFERENCES panel_gene(panel_gene_id)
        ON DELETE SET NULL
)
ENGINE=InnoDB;          
```

##Table `rapport`
###Description
rapport_id | rapport_nom | rapport_date | rapport_pathologie | rapport_examen_id | rapport_prescripteur_id
:-----: | :-----: | :-----: | :-----: | :-----: | :------ 
INT | VARCHAR | DATE | VARCHAR | INT | INT



###Création de la table
``` sql
CREATE TABLE rapport (
    rapport_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    rapport_nom VARCHAR(60) NOT NULL,
    rapport_date DATE DEFAULT NULL,
    rapport_pathologie VARCHAR(60) NOT NULL,
    rapport_examen_id INT UNSIGNED NOT NULL,
    rapport_prescripteur_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_examen_id
        FOREIGN KEY (rapport_examen_id) 
        REFERENCES examen(examen_id)
        ON DELETE CASCADE,
    CONSTRAINT fk_prescripteur_id
        FOREIGN KEY (rapport_prescripteur_id) 
        REFERENCES personnel(personnel_id)
        ON DELETE SET NULL
)
ENGINE=InnoDB;          
```
