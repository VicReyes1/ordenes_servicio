<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226173223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE levantamiento_has_materiales ADD cantidad_al_solicitar DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE levantamiento_has_materiales DROP actualmente_bodega');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE levantamiento_has_materiales ADD actualmente_bodega BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE levantamiento_has_materiales DROP cantidad_al_solicitar');
    }
}
