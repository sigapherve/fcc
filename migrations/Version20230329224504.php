<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329224504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate ADD payment_place_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F394D60E071 FOREIGN KEY (payment_place_id) REFERENCES payment_place (id)');
        $this->addSql('CREATE INDEX IDX_DFEC3F394D60E071 ON rate (payment_place_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F394D60E071');
        $this->addSql('DROP INDEX IDX_DFEC3F394D60E071 ON rate');
        $this->addSql('ALTER TABLE rate DROP payment_place_id');
    }
}
