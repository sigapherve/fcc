<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329231208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate ADD shipby_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F3955E0835E FOREIGN KEY (shipby_id) REFERENCES ship_by (id)');
        $this->addSql('CREATE INDEX IDX_DFEC3F3955E0835E ON rate (shipby_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F3955E0835E');
        $this->addSql('DROP INDEX IDX_DFEC3F3955E0835E ON rate');
        $this->addSql('ALTER TABLE rate DROP shipby_id');
    }
}
