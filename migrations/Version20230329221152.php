<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329221152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F3960A74D8E');
        $this->addSql('DROP INDEX IDX_DFEC3F3960A74D8E ON rate');
        $this->addSql('ALTER TABLE rate CHANGE paymentplace_id charge_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F3955284914 FOREIGN KEY (charge_id) REFERENCES charge (id)');
        $this->addSql('CREATE INDEX IDX_DFEC3F3955284914 ON rate (charge_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F3955284914');
        $this->addSql('DROP INDEX IDX_DFEC3F3955284914 ON rate');
        $this->addSql('ALTER TABLE rate CHANGE charge_id paymentplace_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F3960A74D8E FOREIGN KEY (paymentplace_id) REFERENCES payment_place (id)');
        $this->addSql('CREATE INDEX IDX_DFEC3F3960A74D8E ON rate (paymentplace_id)');
    }
}
