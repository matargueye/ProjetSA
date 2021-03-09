<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308120446 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes ADD livreurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C908EE9D4 FOREIGN KEY (livreurs_id) REFERENCES livreurs (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C908EE9D4 ON commandes (livreurs_id)');
        $this->addSql('ALTER TABLE livreurs ADD ville_id INT NOT NULL');
        $this->addSql('ALTER TABLE livreurs ADD CONSTRAINT FK_28E6A8A0A73F0036 FOREIGN KEY (ville_id) REFERENCES villes (id)');
        $this->addSql('CREATE INDEX IDX_28E6A8A0A73F0036 ON livreurs (ville_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C908EE9D4');
        $this->addSql('DROP INDEX IDX_35D4282C908EE9D4 ON commandes');
        $this->addSql('ALTER TABLE commandes DROP livreurs_id');
        $this->addSql('ALTER TABLE livreurs DROP FOREIGN KEY FK_28E6A8A0A73F0036');
        $this->addSql('DROP INDEX IDX_28E6A8A0A73F0036 ON livreurs');
        $this->addSql('ALTER TABLE livreurs DROP ville_id');
    }
}
