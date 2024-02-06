<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206064627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE captura_has_notas_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE nota_has_materiales_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE nota_has_materiales (id INT NOT NULL, nota_id INT NOT NULL, material_id INT NOT NULL, estatus VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E5365165A98F9F02 ON nota_has_materiales (nota_id)');
        $this->addSql('CREATE INDEX IDX_E5365165E308AC6F ON nota_has_materiales (material_id)');
        $this->addSql('ALTER TABLE nota_has_materiales ADD CONSTRAINT FK_E5365165A98F9F02 FOREIGN KEY (nota_id) REFERENCES nota (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nota_has_materiales ADD CONSTRAINT FK_E5365165E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE captura_has_notas DROP CONSTRAINT fk_453e248ae45284d3');
        $this->addSql('ALTER TABLE captura_has_notas DROP CONSTRAINT fk_453e248aa98f9f02');
        $this->addSql('DROP TABLE captura_has_notas');
        $this->addSql('ALTER TABLE nota DROP CONSTRAINT fk_c8d03e0de45284d3');
        $this->addSql('DROP INDEX idx_c8d03e0de45284d3');
        $this->addSql('ALTER TABLE nota DROP captura_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE nota_has_materiales_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE captura_has_notas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE captura_has_notas (id INT NOT NULL, captura_id INT NOT NULL, nota_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_453e248aa98f9f02 ON captura_has_notas (nota_id)');
        $this->addSql('CREATE INDEX idx_453e248ae45284d3 ON captura_has_notas (captura_id)');
        $this->addSql('ALTER TABLE captura_has_notas ADD CONSTRAINT fk_453e248ae45284d3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE captura_has_notas ADD CONSTRAINT fk_453e248aa98f9f02 FOREIGN KEY (nota_id) REFERENCES nota (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nota_has_materiales DROP CONSTRAINT FK_E5365165A98F9F02');
        $this->addSql('ALTER TABLE nota_has_materiales DROP CONSTRAINT FK_E5365165E308AC6F');
        $this->addSql('DROP TABLE nota_has_materiales');
        $this->addSql('ALTER TABLE nota ADD captura_id INT NOT NULL');
        $this->addSql('ALTER TABLE nota ADD CONSTRAINT fk_c8d03e0de45284d3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c8d03e0de45284d3 ON nota (captura_id)');
    }
}
