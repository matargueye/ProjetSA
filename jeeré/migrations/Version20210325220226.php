<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325220226 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livreurs ADD image_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE livreurs ADD CONSTRAINT FK_28E6A8A03DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
        $this->addSql('CREATE INDEX IDX_28E6A8A03DA5256D ON livreurs (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livreurs DROP FOREIGN KEY FK_28E6A8A03DA5256D');
        $this->addSql('DROP INDEX IDX_28E6A8A03DA5256D ON livreurs');
        $this->addSql('ALTER TABLE livreurs ADD image INT NOT NULL, DROP image_id');
    }
}
