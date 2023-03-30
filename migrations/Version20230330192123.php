<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330192123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cotation DROP FOREIGN KEY FK_996DA9449395C3F3');
        $this->addSql('DROP INDEX IDX_996DA9449395C3F3 ON cotation');
        $this->addSql('ALTER TABLE cotation DROP customer_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cotation ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cotation ADD CONSTRAINT FK_996DA9449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_996DA9449395C3F3 ON cotation (customer_id)');
    }
}
