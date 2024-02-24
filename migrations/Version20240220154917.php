<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220154917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personal ADD ocupacion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personal ADD CONSTRAINT FK_F18A6D84D8999C67 FOREIGN KEY (ocupacion_id) REFERENCES ocupacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F18A6D84D8999C67 ON personal (ocupacion_id)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE personal DROP CONSTRAINT FK_F18A6D84D8999C67');
        $this->addSql('DROP INDEX IDX_F18A6D84D8999C67');
        $this->addSql('ALTER TABLE personal DROP ocupacion_id');
    }
}
