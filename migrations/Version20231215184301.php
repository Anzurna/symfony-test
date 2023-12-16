<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215184301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE credit_applications_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE credit_applications (id INT NOT NULL, car_id INT DEFAULT NULL, credit_id INT DEFAULT NULL, initial_pay INT DEFAULT NULL, monthly_pay INT DEFAULT NULL, duration INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN credit_applications.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN credit_applications.updated_at IS \'(DC2Type:datetime_immutable)\'');

        $this->addSql('ALTER TABLE credit_applications ADD CONSTRAINT FK_95C71D1444F5D453 FOREIGN KEY (car_id) REFERENCES cars (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE credit_applications ADD CONSTRAINT FK_95C71D1444F5D254 FOREIGN KEY (credit_id) REFERENCES credits (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE credit_applications_id_seq CASCADE');
        $this->addSql('DROP TABLE credit_applications');
    }
}
