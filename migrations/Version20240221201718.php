<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221201718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE levantamiento_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE levantamiento_has_materiales_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE levantamiento (id INT NOT NULL, captura_id INT NOT NULL, imagen1 VARCHAR(155) NOT NULL, imagen2 VARCHAR(155) NOT NULL, imagen3 VARCHAR(155) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6AA36354E45284D3 ON levantamiento (captura_id)');
        $this->addSql('CREATE TABLE levantamiento_has_materiales (id INT NOT NULL, levantamiento_id INT NOT NULL, material_id INT NOT NULL, cantidad DOUBLE PRECISION DEFAULT NULL, actualmente_bodega BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1EDF2333CFB8900 ON levantamiento_has_materiales (levantamiento_id)');
        $this->addSql('CREATE INDEX IDX_1EDF2333E308AC6F ON levantamiento_has_materiales (material_id)');
        $this->addSql('ALTER TABLE levantamiento ADD CONSTRAINT FK_6AA36354E45284D3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE levantamiento_has_materiales ADD CONSTRAINT FK_1EDF2333CFB8900 FOREIGN KEY (levantamiento_id) REFERENCES levantamiento (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE levantamiento_has_materiales ADD CONSTRAINT FK_1EDF2333E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE levantamiento_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE levantamiento_has_materiales_id_seq CASCADE');
        $this->addSql('ALTER TABLE levantamiento DROP CONSTRAINT FK_6AA36354E45284D3');
        $this->addSql('ALTER TABLE levantamiento_has_materiales DROP CONSTRAINT FK_1EDF2333CFB8900');
        $this->addSql('ALTER TABLE levantamiento_has_materiales DROP CONSTRAINT FK_1EDF2333E308AC6F');
        $this->addSql('DROP TABLE levantamiento');
        $this->addSql('DROP TABLE levantamiento_has_materiales');
    }
}
