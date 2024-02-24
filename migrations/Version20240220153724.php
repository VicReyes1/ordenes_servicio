<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220153724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ocupacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ocupacion (id INT NOT NULL, ocupacion VARCHAR(155) NOT NULL, PRIMARY KEY(id))');

        $niveles_puestos = [
            "DIRECTOR GENERAL",
            "DIRECTOR DE ÁREA",
            "SUBDIRECTOR DE ÁREA",
            "JEFE DE DEPARTAMENTO",
            "JEFE DE OFICINA C",
            "JEFE DE OFICINA B",
            "JEFE DE OFICINA A",
            "TÉCNICO ESPECIALIZADO",
            "TÉCNICO ADMINISTRATIVO",
            "ANALISTA ESPECIALIZADO",
            "TÉCNICO GENERAL",
            "AUXILIAR TÉCNICO",
            "AUXILIAR ADMINISTRATIVO",
            "POLICIA TERCERO",
            "SUB OFICIAL",
            "OPERADOR DE MANTENIMIENTO GENERAL",
            "POLICIA SEGUNDO",
            "INTENDENTE",
            "AYUDANTE DE MANTENIMIENTO",
            "TECNICO"
        ];

        for ($i=0; $i < sizeof($niveles_puestos); $i++) { 
            $nivel = $niveles_puestos[$i];
            $this->addSql("INSERT INTO ocupacion (id, ocupacion) VALUES ($i+1 ,'$nivel')");
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ocupacion_id_seq CASCADE');
        $this->addSql('DROP TABLE ocupacion');
    }
}
