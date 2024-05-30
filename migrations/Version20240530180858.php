<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240530180858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'removed email from client';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client DROP email');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client ADD email VARCHAR(255) NOT NULL');
    }
}
