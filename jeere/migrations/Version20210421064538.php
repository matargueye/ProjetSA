<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421064538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_produi (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, adresse_client VARCHAR(255) NOT NULL, tel_client VARCHAR(255) NOT NULL, INDEX IDX_C82E7467B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, livreurs_id INT NOT NULL, facture_id INT NOT NULL, client_id INT NOT NULL, date_commande DATE NOT NULL, etat TINYINT(1) NOT NULL, nom_client VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, INDEX IDX_35D4282C908EE9D4 (livreurs_id), UNIQUE INDEX UNIQ_35D4282C7F2DEE08 (facture_id), INDEX IDX_35D4282C19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, date_facture DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreurs (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, users_id INT NOT NULL, ville_id INT NOT NULL, adresse_livreur VARCHAR(255) NOT NULL, tel_livreur VARCHAR(255) NOT NULL, INDEX IDX_28E6A8A03DA5256D (image_id), INDEX IDX_28E6A8A067B3B43D (users_id), INDEX IDX_28E6A8A0A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_object (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, vendeur_id INT NOT NULL, categorie_id INT NOT NULL, image_id INT DEFAULT NULL, type_produit_id INT NOT NULL, nom_produit VARCHAR(255) NOT NULL, prix_unitaire VARCHAR(255) NOT NULL, quantite_stock VARCHAR(255) NOT NULL, caracteristique VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_ajout DATE NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_BE2DDF8C858C065E (vendeur_id), INDEX IDX_BE2DDF8CBCF5E72D (categorie_id), INDEX IDX_BE2DDF8C3DA5256D (image_id), INDEX IDX_BE2DDF8C1237A8DE (type_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_1483A5E9D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeurs (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, image_id INT DEFAULT NULL, adresse_vendeur VARCHAR(255) NOT NULL, tel_vendeur VARCHAR(255) NOT NULL, INDEX IDX_2180DE367B3B43D (users_id), INDEX IDX_2180DE33DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE villes (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E7467B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C908EE9D4 FOREIGN KEY (livreurs_id) REFERENCES livreurs (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES factures (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE livreurs ADD CONSTRAINT FK_28E6A8A03DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
        $this->addSql('ALTER TABLE livreurs ADD CONSTRAINT FK_28E6A8A067B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE livreurs ADD CONSTRAINT FK_28E6A8A0A73F0036 FOREIGN KEY (ville_id) REFERENCES villes (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeurs (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_produi (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C3DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C1237A8DE FOREIGN KEY (type_produit_id) REFERENCES type_produit (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE vendeurs ADD CONSTRAINT FK_2180DE367B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE vendeurs ADD CONSTRAINT FK_2180DE33DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CBCF5E72D');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C19EB6921');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C7F2DEE08');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C908EE9D4');
        $this->addSql('ALTER TABLE livreurs DROP FOREIGN KEY FK_28E6A8A03DA5256D');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C3DA5256D');
        $this->addSql('ALTER TABLE vendeurs DROP FOREIGN KEY FK_2180DE33DA5256D');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9D60322AC');
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E7467B3B43D');
        $this->addSql('ALTER TABLE livreurs DROP FOREIGN KEY FK_28E6A8A067B3B43D');
        $this->addSql('ALTER TABLE vendeurs DROP FOREIGN KEY FK_2180DE367B3B43D');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C858C065E');
        $this->addSql('ALTER TABLE livreurs DROP FOREIGN KEY FK_28E6A8A0A73F0036');
        $this->addSql('DROP TABLE categorie_produi');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE factures');
        $this->addSql('DROP TABLE livreurs');
        $this->addSql('DROP TABLE media_object');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE vendeurs');
        $this->addSql('DROP TABLE villes');
    }
}
