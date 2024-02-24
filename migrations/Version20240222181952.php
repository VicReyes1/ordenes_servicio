<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222181952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE levantamiento ADD categoria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE levantamiento ADD fecha_levantamiento DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE levantamiento ADD CONSTRAINT FK_6AA363543397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6AA363543397707A ON levantamiento (categoria_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE levantamiento DROP CONSTRAINT FK_6AA363543397707A');
        $this->addSql('DROP INDEX IDX_6AA363543397707A');
        $this->addSql('ALTER TABLE levantamiento DROP categoria_id');
        $this->addSql('ALTER TABLE levantamiento DROP fecha_levantamiento');
    }
}
