<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208230628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nota ADD imagen1 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nota ADD imagen2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nota ADD imagen3 VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE nota DROP imagen1');
        $this->addSql('ALTER TABLE nota DROP imagen2');
        $this->addSql('ALTER TABLE nota DROP imagen3');
    }
}
