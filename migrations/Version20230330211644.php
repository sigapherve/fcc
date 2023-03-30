<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330211644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkout ADD shipby_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE checkout ADD CONSTRAINT FK_AF382D4E55E0835E FOREIGN KEY (shipby_id) REFERENCES ship_by (id)');
        $this->addSql('CREATE INDEX IDX_AF382D4E55E0835E ON checkout (shipby_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkout DROP FOREIGN KEY FK_AF382D4E55E0835E');
        $this->addSql('DROP INDEX IDX_AF382D4E55E0835E ON checkout');
        $this->addSql('ALTER TABLE checkout DROP shipby_id');
    }
}
