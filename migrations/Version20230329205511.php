<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329205511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE constraints (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT DEFAULT NULL, enforced_at DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE constraints_product (constraints_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_D0B8D1A153990B6D (constraints_id), INDEX IDX_D0B8D1A14584665A (product_id), PRIMARY KEY(constraints_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE constraints_country (constraints_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_50811C6A53990B6D (constraints_id), INDEX IDX_50811C6AF92F3E70 (country_id), PRIMARY KEY(constraints_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE constraints_product ADD CONSTRAINT FK_D0B8D1A153990B6D FOREIGN KEY (constraints_id) REFERENCES constraints (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE constraints_product ADD CONSTRAINT FK_D0B8D1A14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE constraints_country ADD CONSTRAINT FK_50811C6A53990B6D FOREIGN KEY (constraints_id) REFERENCES constraints (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE constraints_country ADD CONSTRAINT FK_50811C6AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE constraints_product DROP FOREIGN KEY FK_D0B8D1A153990B6D');
        $this->addSql('ALTER TABLE constraints_product DROP FOREIGN KEY FK_D0B8D1A14584665A');
        $this->addSql('ALTER TABLE constraints_country DROP FOREIGN KEY FK_50811C6A53990B6D');
        $this->addSql('ALTER TABLE constraints_country DROP FOREIGN KEY FK_50811C6AF92F3E70');
        $this->addSql('DROP TABLE constraints');
        $this->addSql('DROP TABLE constraints_product');
        $this->addSql('DROP TABLE constraints_country');
    }
}
