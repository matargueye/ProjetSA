<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308121241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paniers_produits (paniers_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_7B1D2CABBE35FDA0 (paniers_id), INDEX IDX_7B1D2CABCD11A2CF (produits_id), PRIMARY KEY(paniers_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE paniers_produits ADD CONSTRAINT FK_7B1D2CABBE35FDA0 FOREIGN KEY (paniers_id) REFERENCES paniers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paniers_produits ADD CONSTRAINT FK_7B1D2CABCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE paniers_produits');
    }
}
