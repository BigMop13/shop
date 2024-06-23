<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240623164643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'allow client to exist without user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT NOT NULL');
    }
}
