<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206175646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrada DROP CONSTRAINT fk_c949a274e45284d3');
        $this->addSql('DROP INDEX idx_c949a274e45284d3');
        $this->addSql('ALTER TABLE entrada ADD cantidad INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entrada DROP captura_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE entrada ADD captura_id INT NOT NULL');
        $this->addSql('ALTER TABLE entrada DROP cantidad');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT fk_c949a274e45284d3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c949a274e45284d3 ON entrada (captura_id)');
    }
}
