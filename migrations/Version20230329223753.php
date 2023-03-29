<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329223753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pay_policy DROP FOREIGN KEY FK_79E6CF592D29E3C6');
        $this->addSql('ALTER TABLE pay_policy DROP FOREIGN KEY FK_79E6CF594D60E071');
        $this->addSql('ALTER TABLE pay_policy_charge DROP FOREIGN KEY FK_4B089EDB55284914');
        $this->addSql('ALTER TABLE pay_policy_charge DROP FOREIGN KEY FK_4B089EDB275CBA');
        $this->addSql('DROP TABLE pay_policy');
        $this->addSql('DROP TABLE pay_policy_charge');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pay_policy (id INT AUTO_INCREMENT NOT NULL, payment_place_id INT DEFAULT NULL, policy_id INT DEFAULT NULL, INDEX IDX_79E6CF592D29E3C6 (policy_id), INDEX IDX_79E6CF594D60E071 (payment_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pay_policy_charge (pay_policy_id INT NOT NULL, charge_id INT NOT NULL, INDEX IDX_4B089EDB275CBA (pay_policy_id), INDEX IDX_4B089EDB55284914 (charge_id), PRIMARY KEY(pay_policy_id, charge_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pay_policy ADD CONSTRAINT FK_79E6CF592D29E3C6 FOREIGN KEY (policy_id) REFERENCES prepaid_collect (id)');
        $this->addSql('ALTER TABLE pay_policy ADD CONSTRAINT FK_79E6CF594D60E071 FOREIGN KEY (payment_place_id) REFERENCES payment_place (id)');
        $this->addSql('ALTER TABLE pay_policy_charge ADD CONSTRAINT FK_4B089EDB55284914 FOREIGN KEY (charge_id) REFERENCES charge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pay_policy_charge ADD CONSTRAINT FK_4B089EDB275CBA FOREIGN KEY (pay_policy_id) REFERENCES pay_policy (id) ON DELETE CASCADE');
    }
}
