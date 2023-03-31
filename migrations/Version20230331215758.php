<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331215758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponse ADD paymentplace_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC760A74D8E FOREIGN KEY (paymentplace_id) REFERENCES payment_place (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC760A74D8E ON reponse (paymentplace_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC760A74D8E');
        $this->addSql('DROP INDEX IDX_5FB6DEC760A74D8E ON reponse');
        $this->addSql('ALTER TABLE reponse DROP paymentplace_id');
    }
}
