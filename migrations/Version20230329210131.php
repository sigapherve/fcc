<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329210131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate ADD unit_fact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39412452E8 FOREIGN KEY (unit_fact_id) REFERENCES unit_fact (id)');
        $this->addSql('CREATE INDEX IDX_DFEC3F39412452E8 ON rate (unit_fact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39412452E8');
        $this->addSql('DROP INDEX IDX_DFEC3F39412452E8 ON rate');
        $this->addSql('ALTER TABLE rate DROP unit_fact_id');
    }
}
