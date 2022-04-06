<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406195123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE specialist (id UUID NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, subtitle VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_specialist_is_active ON specialist (is_active)');
        $this->addSql('COMMENT ON COLUMN specialist.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN specialist.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN specialist.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE speciality (id UUID NOT NULL, title VARCHAR(500) NOT NULL, slug VARCHAR(500) NOT NULL, description TEXT DEFAULT NULL, position INT DEFAULT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_speciality_position ON speciality (position)');
        $this->addSql('CREATE INDEX idx_speciality_slug ON speciality (slug)');
        $this->addSql('CREATE INDEX idx_speciality_is_active ON speciality (is_active)');
        $this->addSql('COMMENT ON COLUMN speciality.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN speciality.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN speciality.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE specialist');
        $this->addSql('DROP TABLE speciality');
    }
}
