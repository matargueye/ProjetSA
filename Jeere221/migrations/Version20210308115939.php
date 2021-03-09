<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308115939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits ADD vendeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeurs (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C858C065E ON produits (vendeur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C858C065E');
        $this->addSql('DROP INDEX IDX_BE2DDF8C858C065E ON produits');
        $this->addSql('ALTER TABLE produits DROP vendeur_id');
    }
}
