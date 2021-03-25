<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325222709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CF77D927C');
        $this->addSql('ALTER TABLE paniers_produits DROP FOREIGN KEY FK_7B1D2CABBE35FDA0');
        $this->addSql('DROP TABLE paniers');
        $this->addSql('DROP TABLE paniers_produits');
        $this->addSql('DROP INDEX UNIQ_35D4282CF77D927C ON commandes');
        $this->addSql('ALTER TABLE commandes DROP panier_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paniers (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE paniers_produits (paniers_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_7B1D2CABBE35FDA0 (paniers_id), INDEX IDX_7B1D2CABCD11A2CF (produits_id), PRIMARY KEY(paniers_id, produits_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE paniers_produits ADD CONSTRAINT FK_7B1D2CABBE35FDA0 FOREIGN KEY (paniers_id) REFERENCES paniers (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paniers_produits ADD CONSTRAINT FK_7B1D2CABCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes ADD panier_id INT NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CF77D927C FOREIGN KEY (panier_id) REFERENCES paniers (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_35D4282CF77D927C ON commandes (panier_id)');
    }
}
