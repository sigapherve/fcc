<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329204821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, paymentplace_id INT DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_DFEC3F39F92F3E70 (country_id), INDEX IDX_DFEC3F3960A74D8E (paymentplace_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F3960A74D8E FOREIGN KEY (paymentplace_id) REFERENCES payment_place (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39F92F3E70');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F3960A74D8E');
        $this->addSql('DROP TABLE rate');
    }
}
