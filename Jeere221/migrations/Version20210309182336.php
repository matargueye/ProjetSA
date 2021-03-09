<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309182336 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E7467B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_C82E7467B3B43D ON clients (users_id)');
        $this->addSql('ALTER TABLE livreurs ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livreurs ADD CONSTRAINT FK_28E6A8A067B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_28E6A8A067B3B43D ON livreurs (users_id)');
        $this->addSql('ALTER TABLE vendeurs ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vendeurs ADD CONSTRAINT FK_2180DE367B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2180DE367B3B43D ON vendeurs (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E7467B3B43D');
        $this->addSql('DROP INDEX IDX_C82E7467B3B43D ON clients');
        $this->addSql('ALTER TABLE clients DROP users_id');
        $this->addSql('ALTER TABLE livreurs DROP FOREIGN KEY FK_28E6A8A067B3B43D');
        $this->addSql('DROP INDEX IDX_28E6A8A067B3B43D ON livreurs');
        $this->addSql('ALTER TABLE livreurs DROP users_id');
        $this->addSql('ALTER TABLE vendeurs DROP FOREIGN KEY FK_2180DE367B3B43D');
        $this->addSql('DROP INDEX IDX_2180DE367B3B43D ON vendeurs');
        $this->addSql('ALTER TABLE vendeurs DROP users_id');
    }
}
