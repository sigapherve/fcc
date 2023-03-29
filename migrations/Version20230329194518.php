<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329194518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE checkout (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, shipto_id INT DEFAULT NULL, checkoutdate DATE DEFAULT NULL, INDEX IDX_AF382D4E9395C3F3 (customer_id), INDEX IDX_AF382D4ECF32E93F (shipto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE checkout ADD CONSTRAINT FK_AF382D4E9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE checkout ADD CONSTRAINT FK_AF382D4ECF32E93F FOREIGN KEY (shipto_id) REFERENCES country (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkout DROP FOREIGN KEY FK_AF382D4E9395C3F3');
        $this->addSql('ALTER TABLE checkout DROP FOREIGN KEY FK_AF382D4ECF32E93F');
        $this->addSql('DROP TABLE checkout');
    }
}
