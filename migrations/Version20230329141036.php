<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329141036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, shortname VARCHAR(5) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoicemethod (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoiceplace (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoicingunit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, amount DOUBLE PRECISION DEFAULT NULL, version DATE DEFAULT NULL, active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate_country (rate_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_89B18687BC999F9F (rate_id), INDEX IDX_89B18687F92F3E70 (country_id), PRIMARY KEY(rate_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate_invoiceplace (rate_id INT NOT NULL, invoiceplace_id INT NOT NULL, INDEX IDX_14C2880CBC999F9F (rate_id), INDEX IDX_14C2880C8B3775B7 (invoiceplace_id), PRIMARY KEY(rate_id, invoiceplace_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rate_country ADD CONSTRAINT FK_89B18687BC999F9F FOREIGN KEY (rate_id) REFERENCES rate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rate_country ADD CONSTRAINT FK_89B18687F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rate_invoiceplace ADD CONSTRAINT FK_14C2880CBC999F9F FOREIGN KEY (rate_id) REFERENCES rate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rate_invoiceplace ADD CONSTRAINT FK_14C2880C8B3775B7 FOREIGN KEY (invoiceplace_id) REFERENCES invoiceplace (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate_country DROP FOREIGN KEY FK_89B18687BC999F9F');
        $this->addSql('ALTER TABLE rate_country DROP FOREIGN KEY FK_89B18687F92F3E70');
        $this->addSql('ALTER TABLE rate_invoiceplace DROP FOREIGN KEY FK_14C2880CBC999F9F');
        $this->addSql('ALTER TABLE rate_invoiceplace DROP FOREIGN KEY FK_14C2880C8B3775B7');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE invoicemethod');
        $this->addSql('DROP TABLE invoiceplace');
        $this->addSql('DROP TABLE invoicingunit');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE rate_country');
        $this->addSql('DROP TABLE rate_invoiceplace');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
