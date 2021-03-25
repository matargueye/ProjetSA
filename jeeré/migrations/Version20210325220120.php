<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325220120 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vendeurs ADD image_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE vendeurs ADD CONSTRAINT FK_2180DE33DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
        $this->addSql('CREATE INDEX IDX_2180DE33DA5256D ON vendeurs (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vendeurs DROP FOREIGN KEY FK_2180DE33DA5256D');
        $this->addSql('DROP INDEX IDX_2180DE33DA5256D ON vendeurs');
        $this->addSql('ALTER TABLE vendeurs ADD image INT NOT NULL, DROP image_id');
    }
}
