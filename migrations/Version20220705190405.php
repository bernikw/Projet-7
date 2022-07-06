<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705190405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone ADD reference INT NOT NULL, ADD brand VARCHAR(255) NOT NULL, ADD color VARCHAR(255) NOT NULL, ADD screen_size INT NOT NULL, ADD weight INT NOT NULL, ADD operating_system VARCHAR(255) NOT NULL, ADD status VARCHAR(255) NOT NULL, DROP description');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone ADD description LONGTEXT NOT NULL, DROP reference, DROP brand, DROP color, DROP screen_size, DROP weight, DROP operating_system, DROP status');
    }
}
