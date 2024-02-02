<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202205502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE captura ADD nombre_proyecto VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE captura ADD folio_identificacion VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE captura ADD fecha_revision DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE entrada DROP proyecto');
        $this->addSql('ALTER TABLE salida DROP proyecto');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE salida ADD proyecto INT NOT NULL');
        $this->addSql('ALTER TABLE captura DROP nombre_proyecto');
        $this->addSql('ALTER TABLE captura DROP folio_identificacion');
        $this->addSql('ALTER TABLE captura DROP fecha_revision');
        $this->addSql('ALTER TABLE entrada ADD proyecto INT NOT NULL');
    }
}
