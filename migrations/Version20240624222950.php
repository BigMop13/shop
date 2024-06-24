<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240624222950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'changed photo to LONGTEXT in product entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product CHANGE photo photo LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product CHANGE photo photo TEXT NOT NULL');
    }
}
