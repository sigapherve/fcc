<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329145910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Commande (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, deliverycountry_id INT DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_979CC42B19EB6921 (client_id), INDEX IDX_979CC42BF0D6D3FF (deliverycountry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrainte (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) DEFAULT NULL, longdescription LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrainte_product (contrainte_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_E993E636CE5EAC1 (contrainte_id), INDEX IDX_E993E634584665A (product_id), PRIMARY KEY(contrainte_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrainte_country (contrainte_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_8EA0F3A86CE5EAC1 (contrainte_id), INDEX IDX_8EA0F3A8F92F3E70 (country_id), PRIMARY KEY(contrainte_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cotation (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, date DATE DEFAULT NULL, reponse VARCHAR(255) DEFAULT NULL, INDEX IDX_996DA94482EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, shortname VARCHAR(5) DEFAULT NULL, INDEX IDX_5373C9669395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoicemethod (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoiceplace (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoicingunit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, metalength DOUBLE PRECISION DEFAULT NULL, metawidth DOUBLE PRECISION DEFAULT NULL, metaheight DOUBLE PRECISION DEFAULT NULL, metaweight DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, amount DOUBLE PRECISION DEFAULT NULL, version DATE DEFAULT NULL, active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate_country (rate_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_89B18687BC999F9F (rate_id), INDEX IDX_89B18687F92F3E70 (country_id), PRIMARY KEY(rate_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate_invoiceplace (rate_id INT NOT NULL, invoiceplace_id INT NOT NULL, INDEX IDX_14C2880CBC999F9F (rate_id), INDEX IDX_14C2880C8B3775B7 (invoiceplace_id), PRIMARY KEY(rate_id, invoiceplace_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Commande ADD CONSTRAINT FK_979CC42B19EB6921 FOREIGN KEY (client_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE Commande ADD CONSTRAINT FK_979CC42BF0D6D3FF FOREIGN KEY (deliverycountry_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE contrainte_product ADD CONSTRAINT FK_E993E636CE5EAC1 FOREIGN KEY (contrainte_id) REFERENCES contrainte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrainte_product ADD CONSTRAINT FK_E993E634584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrainte_country ADD CONSTRAINT FK_8EA0F3A86CE5EAC1 FOREIGN KEY (contrainte_id) REFERENCES contrainte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrainte_country ADD CONSTRAINT FK_8EA0F3A8F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cotation ADD CONSTRAINT FK_996DA94482EA2E54 FOREIGN KEY (commande_id) REFERENCES Commande (id)');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C9669395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE rate_country ADD CONSTRAINT FK_89B18687BC999F9F FOREIGN KEY (rate_id) REFERENCES rate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rate_country ADD CONSTRAINT FK_89B18687F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rate_invoiceplace ADD CONSTRAINT FK_14C2880CBC999F9F FOREIGN KEY (rate_id) REFERENCES rate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rate_invoiceplace ADD CONSTRAINT FK_14C2880C8B3775B7 FOREIGN KEY (invoiceplace_id) REFERENCES invoiceplace (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Commande DROP FOREIGN KEY FK_979CC42B19EB6921');
        $this->addSql('ALTER TABLE Commande DROP FOREIGN KEY FK_979CC42BF0D6D3FF');
        $this->addSql('ALTER TABLE contrainte_product DROP FOREIGN KEY FK_E993E636CE5EAC1');
        $this->addSql('ALTER TABLE contrainte_product DROP FOREIGN KEY FK_E993E634584665A');
        $this->addSql('ALTER TABLE contrainte_country DROP FOREIGN KEY FK_8EA0F3A86CE5EAC1');
        $this->addSql('ALTER TABLE contrainte_country DROP FOREIGN KEY FK_8EA0F3A8F92F3E70');
        $this->addSql('ALTER TABLE cotation DROP FOREIGN KEY FK_996DA94482EA2E54');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C9669395C3F3');
        $this->addSql('ALTER TABLE rate_country DROP FOREIGN KEY FK_89B18687BC999F9F');
        $this->addSql('ALTER TABLE rate_country DROP FOREIGN KEY FK_89B18687F92F3E70');
        $this->addSql('ALTER TABLE rate_invoiceplace DROP FOREIGN KEY FK_14C2880CBC999F9F');
        $this->addSql('ALTER TABLE rate_invoiceplace DROP FOREIGN KEY FK_14C2880C8B3775B7');
        $this->addSql('DROP TABLE Commande');
        $this->addSql('DROP TABLE contrainte');
        $this->addSql('DROP TABLE contrainte_product');
        $this->addSql('DROP TABLE contrainte_country');
        $this->addSql('DROP TABLE cotation');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE invoicemethod');
        $this->addSql('DROP TABLE invoiceplace');
        $this->addSql('DROP TABLE invoicingunit');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE rate_country');
        $this->addSql('DROP TABLE rate_invoiceplace');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
