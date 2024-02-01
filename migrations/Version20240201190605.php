<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201190605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE captura_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE captura (id INT NOT NULL, fecha DATE NOT NULL, area_solicitante VARCHAR(255) DEFAULT NULL, centro_trabajo VARCHAR(355) DEFAULT NULL, nombre_solicitante VARCHAR(255) DEFAULT NULL, puesto_solicitante VARCHAR(255) DEFAULT NULL, telefono_ext VARCHAR(255) DEFAULT NULL, tipo_trabajo VARCHAR(255) DEFAULT NULL, descripcion_trabajo TEXT DEFAULT NULL, gas BOOLEAN DEFAULT NULL, flama BOOLEAN DEFAULT NULL, altura BOOLEAN DEFAULT NULL, especialidad VARCHAR(1000) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE captura_id_seq CASCADE');
        $this->addSql('DROP TABLE captura');
    }
}
