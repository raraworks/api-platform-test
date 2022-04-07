<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407212140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE INDEX idx_consultation_start_at ON consultation (start_at)');
        $this->addSql('CREATE INDEX idx_consultation_end_at ON consultation (end_at)');
    }

    public function down(Schema $schema): void
    {

        $this->addSql('DROP INDEX idx_consultation_start_at');
        $this->addSql('DROP INDEX idx_consultation_end_at');
    }
}
