<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105195704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salida DROP CONSTRAINT fk_95f4c748a98f9f02');
        $this->addSql('DROP INDEX idx_95f4c748a98f9f02');
        $this->addSql('ALTER TABLE salida DROP nota_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE salida ADD nota_id INT NOT NULL');
        $this->addSql('ALTER TABLE salida ADD CONSTRAINT fk_95f4c748a98f9f02 FOREIGN KEY (nota_id) REFERENCES nota (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_95f4c748a98f9f02 ON salida (nota_id)');
    }
}
