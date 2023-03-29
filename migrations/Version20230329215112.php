<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329215112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prepaid_collect (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(7) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE charge DROP FOREIGN KEY FK_556BA43460A74D8E');
        $this->addSql('DROP INDEX IDX_556BA43460A74D8E ON charge');
        $this->addSql('ALTER TABLE charge DROP name, CHANGE paymentplace_id payment_place_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE charge ADD CONSTRAINT FK_556BA4344D60E071 FOREIGN KEY (payment_place_id) REFERENCES payment_place (id)');
        $this->addSql('CREATE INDEX IDX_556BA4344D60E071 ON charge (payment_place_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prepaid_collect');
        $this->addSql('ALTER TABLE charge DROP FOREIGN KEY FK_556BA4344D60E071');
        $this->addSql('DROP INDEX IDX_556BA4344D60E071 ON charge');
        $this->addSql('ALTER TABLE charge ADD name VARCHAR(255) DEFAULT NULL, CHANGE payment_place_id paymentplace_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE charge ADD CONSTRAINT FK_556BA43460A74D8E FOREIGN KEY (paymentplace_id) REFERENCES payment_place (id)');
        $this->addSql('CREATE INDEX IDX_556BA43460A74D8E ON charge (paymentplace_id)');
    }
}
