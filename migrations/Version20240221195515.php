<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221195515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE material DROP CONSTRAINT fk_7cbe75953397707a');
        $this->addSql('DROP INDEX idx_7cbe75953397707a');
        $this->addSql('ALTER TABLE material ADD familia VARCHAR(155) NOT NULL');
        $this->addSql('ALTER TABLE material ADD subfamilia VARCHAR(155) NOT NULL');
        $this->addSql('ALTER TABLE material ADD descripcion TEXT NOT NULL');
        $this->addSql('ALTER TABLE material DROP categoria_id');
        $this->addSql('ALTER TABLE material DROP precio');
        $this->addSql('ALTER TABLE material ALTER unidad_medida TYPE VARCHAR(155)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE material ADD categoria_id INT NOT NULL');
        $this->addSql('ALTER TABLE material ADD precio DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE material DROP familia');
        $this->addSql('ALTER TABLE material DROP subfamilia');
        $this->addSql('ALTER TABLE material DROP descripcion');
        $this->addSql('ALTER TABLE material ALTER unidad_medida TYPE VARCHAR(15)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT fk_7cbe75953397707a FOREIGN KEY (categoria_id) REFERENCES categoria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_7cbe75953397707a ON material (categoria_id)');
    }
}
