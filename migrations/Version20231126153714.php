<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231126153714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'removed price from orderDetails, it will be calculated dynamically';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE order_details DROP price');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE order_details ADD price INT NOT NULL');
    }
}
