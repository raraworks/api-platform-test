<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220415195915 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_object_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE person_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, person_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, address VARCHAR(500) DEFAULT NULL, reg_no VARCHAR(11) DEFAULT NULL, billing_address VARCHAR(500) DEFAULT NULL, notes TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C744045541986983 ON client (reg_no)');
        $this->addSql('CREATE INDEX IDX_C7440455217BBB47 ON client (person_id)');
        $this->addSql('CREATE INDEX idx_client_title ON client (title)');
        $this->addSql('CREATE TABLE client_object (id INT NOT NULL, person_id INT DEFAULT NULL, client_id INT NOT NULL, title VARCHAR(255) NOT NULL, notes TEXT DEFAULT NULL, region VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, contract_no VARCHAR(255) DEFAULT NULL, hourly_rate NUMERIC(11, 2) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD0BE05F217BBB47 ON client_object (person_id)');
        $this->addSql('CREATE INDEX IDX_FD0BE05F19EB6921 ON client_object (client_id)');
        $this->addSql('CREATE INDEX idx_client_object_contract_no ON client_object (contract_no)');
        $this->addSql('CREATE TABLE person (id INT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_no VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_person_email ON person (email)');
        $this->addSql('CREATE INDEX idx_person_phone_no ON person (phone_no)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_object ADD CONSTRAINT FK_FD0BE05F217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_object ADD CONSTRAINT FK_FD0BE05F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client_object DROP CONSTRAINT FK_FD0BE05F19EB6921');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455217BBB47');
        $this->addSql('ALTER TABLE client_object DROP CONSTRAINT FK_FD0BE05F217BBB47');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_object_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE person_id_seq CASCADE');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_object');
        $this->addSql('DROP TABLE person');
    }
}
