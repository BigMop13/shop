<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240321223651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'added photo url to database';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product ADD photo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP photo');
    }
}
