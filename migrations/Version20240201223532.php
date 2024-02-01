<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201223532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE categoria_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE entrada_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE material_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE salida_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categoria (id INT NOT NULL, nombre VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE entrada (id INT NOT NULL, material_id INT NOT NULL, precio_compra DOUBLE PRECISION NOT NULL, fecha DATE NOT NULL, proyecto INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C949A274E308AC6F ON entrada (material_id)');
        $this->addSql('CREATE TABLE material (id INT NOT NULL, categoria_id INT NOT NULL, nombre TEXT NOT NULL, unidad_medida VARCHAR(15) NOT NULL, precio DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CBE75953397707A ON material (categoria_id)');
        $this->addSql('CREATE TABLE salida (id INT NOT NULL, material_id INT NOT NULL, precio_salida DOUBLE PRECISION DEFAULT NULL, fecha DATE NOT NULL, proyecto INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_95F4C748E308AC6F ON salida (material_id)');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT FK_C949A274E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75953397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE salida ADD CONSTRAINT FK_95F4C748E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE categoria_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE entrada_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE material_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE salida_id_seq CASCADE');
        $this->addSql('ALTER TABLE entrada DROP CONSTRAINT FK_C949A274E308AC6F');
        $this->addSql('ALTER TABLE material DROP CONSTRAINT FK_7CBE75953397707A');
        $this->addSql('ALTER TABLE salida DROP CONSTRAINT FK_95F4C748E308AC6F');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE entrada');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE salida');
    }
}
