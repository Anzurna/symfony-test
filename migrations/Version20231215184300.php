<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215184300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE credits_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE credits (id INT NOT NULL, name VARCHAR(255) NOT NULL, interest_rate DOUBLE PRECISION NOT NULL, car_price_lower_bound INT DEFAULT NULL, car_price_upper_bound INT DEFAULT NULL, monthly_pay_lower_bound INT DEFAULT NULL, monthly_pay_upper_bound INT DEFAULT NULL, duration_lower_bound INT DEFAULT NULL, duration_upper_bound INT DEFAULT NULL, initial_pay_lower_bound INT DEFAULT NULL, initial_pay_upper_bound INT DEFAULT NULL, priority INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN credits.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN credits.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE credits_id_seq CASCADE');
        $this->addSql('DROP TABLE credits');
    }
}
