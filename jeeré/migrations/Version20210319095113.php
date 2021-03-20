<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319095113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livreurs DROP FOREIGN KEY FK_28E6A8A0A73F0036');
        $this->addSql('DROP TABLE villes');
        $this->addSql('DROP INDEX IDX_28E6A8A0A73F0036 ON livreurs');
        $this->addSql('ALTER TABLE livreurs DROP ville_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE villes (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livreurs ADD ville_id INT NOT NULL');
        $this->addSql('ALTER TABLE livreurs ADD CONSTRAINT FK_28E6A8A0A73F0036 FOREIGN KEY (ville_id) REFERENCES villes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_28E6A8A0A73F0036 ON livreurs (ville_id)');
    }
}
