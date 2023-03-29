<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329201929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cotation (id INT AUTO_INCREMENT NOT NULL, checkout_id INT DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_996DA944146D8724 (checkout_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, cotation_id INT DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, amount_currency VARCHAR(255) DEFAULT NULL, INDEX IDX_5FB6DEC75D14FAF0 (cotation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cotation ADD CONSTRAINT FK_996DA944146D8724 FOREIGN KEY (checkout_id) REFERENCES checkout (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC75D14FAF0 FOREIGN KEY (cotation_id) REFERENCES cotation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cotation DROP FOREIGN KEY FK_996DA944146D8724');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC75D14FAF0');
        $this->addSql('DROP TABLE cotation');
        $this->addSql('DROP TABLE reponse');
    }
}
