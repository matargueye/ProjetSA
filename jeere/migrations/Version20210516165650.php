<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210516165650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients ADD cni VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produits ADD image LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE vendeurs ADD cni VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients DROP cni');
        $this->addSql('ALTER TABLE produits DROP image');
        $this->addSql('ALTER TABLE vendeurs DROP cni');
    }
}
