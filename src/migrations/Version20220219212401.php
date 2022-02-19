<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220219212401 extends AbstractMigration
{
    /**
     * @inheritDoc
     */
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE product (id UUID NOT NULL, sku VARCHAR(255) NOT NULL, title VARCHAR(500) NOT NULL, slug VARCHAR(500) NOT NULL, description TEXT DEFAULT NULL, image_file VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_product_sku ON product (sku)');
        $this->addSql('CREATE INDEX idx_product_slug ON product (slug)');
    }

    /**
     * @inheritDoc
     */
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE product');
    }
}
