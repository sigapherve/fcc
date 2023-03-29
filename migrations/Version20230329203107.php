<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329203107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoicing_method (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, product_id INT DEFAULT NULL, methodused_id INT DEFAULT NULL, INDEX IDX_B9541A11F92F3E70 (country_id), INDEX IDX_B9541A114584665A (product_id), INDEX IDX_B9541A11E29A66D3 (methodused_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoicing_method ADD CONSTRAINT FK_B9541A11F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE invoicing_method ADD CONSTRAINT FK_B9541A114584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE invoicing_method ADD CONSTRAINT FK_B9541A11E29A66D3 FOREIGN KEY (methodused_id) REFERENCES method (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoicing_method DROP FOREIGN KEY FK_B9541A11F92F3E70');
        $this->addSql('ALTER TABLE invoicing_method DROP FOREIGN KEY FK_B9541A114584665A');
        $this->addSql('ALTER TABLE invoicing_method DROP FOREIGN KEY FK_B9541A11E29A66D3');
        $this->addSql('DROP TABLE invoicing_method');
    }
}
