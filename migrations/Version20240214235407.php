<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214235407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nota ADD gas BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE nota ADD flama BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE nota ADD altura BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE nota ADD alta_tension BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE nota ADD descripcion_trabajo_sol TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE nota ADD descripcion_trabajo_ej TEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE nota DROP gas');
        $this->addSql('ALTER TABLE nota DROP flama');
        $this->addSql('ALTER TABLE nota DROP altura');
        $this->addSql('ALTER TABLE nota DROP alta_tension');
        $this->addSql('ALTER TABLE nota DROP descripcion_trabajo_sol');
        $this->addSql('ALTER TABLE nota DROP descripcion_trabajo_ej');
    }
}
