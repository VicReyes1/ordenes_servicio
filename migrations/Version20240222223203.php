<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222223203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE levantamiento ADD jefe_cuadrilla_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE levantamiento ADD supervisor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE levantamiento ADD nombre_solicitante VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE levantamiento ADD solicitante_firma VARCHAR(155) NOT NULL');
        $this->addSql('ALTER TABLE levantamiento ADD jefe_cuadrilla_firma VARCHAR(155) DEFAULT NULL');
        $this->addSql('ALTER TABLE levantamiento ADD supervisor_firma VARCHAR(155) DEFAULT NULL');
        $this->addSql('ALTER TABLE levantamiento ADD CONSTRAINT FK_6AA36354AB580237 FOREIGN KEY (jefe_cuadrilla_id) REFERENCES personal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE levantamiento ADD CONSTRAINT FK_6AA3635419E9AC5F FOREIGN KEY (supervisor_id) REFERENCES personal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6AA36354AB580237 ON levantamiento (jefe_cuadrilla_id)');
        $this->addSql('CREATE INDEX IDX_6AA3635419E9AC5F ON levantamiento (supervisor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE levantamiento DROP CONSTRAINT FK_6AA36354AB580237');
        $this->addSql('ALTER TABLE levantamiento DROP CONSTRAINT FK_6AA3635419E9AC5F');
        $this->addSql('DROP INDEX IDX_6AA36354AB580237');
        $this->addSql('DROP INDEX IDX_6AA3635419E9AC5F');
        $this->addSql('ALTER TABLE levantamiento DROP jefe_cuadrilla_id');
        $this->addSql('ALTER TABLE levantamiento DROP supervisor_id');
        $this->addSql('ALTER TABLE levantamiento DROP nombre_solicitante');
        $this->addSql('ALTER TABLE levantamiento DROP solicitante_firma');
        $this->addSql('ALTER TABLE levantamiento DROP jefe_cuadrilla_firma');
        $this->addSql('ALTER TABLE levantamiento DROP supervisor_firma');
    }
}
