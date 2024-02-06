<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206063412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE captura_has_notas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nota_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE captura_has_notas (id INT NOT NULL, captura_id INT NOT NULL, nota_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_453E248AE45284D3 ON captura_has_notas (captura_id)');
        $this->addSql('CREATE INDEX IDX_453E248AA98F9F02 ON captura_has_notas (nota_id)');
        $this->addSql('CREATE TABLE nota (id INT NOT NULL, captura_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_peticion DATE NOT NULL, observaciones TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C8D03E0DE45284D3 ON nota (captura_id)');
        $this->addSql('ALTER TABLE captura_has_notas ADD CONSTRAINT FK_453E248AE45284D3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE captura_has_notas ADD CONSTRAINT FK_453E248AA98F9F02 FOREIGN KEY (nota_id) REFERENCES nota (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nota ADD CONSTRAINT FK_C8D03E0DE45284D3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE captura_has_notas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nota_id_seq CASCADE');
        $this->addSql('ALTER TABLE captura_has_notas DROP CONSTRAINT FK_453E248AE45284D3');
        $this->addSql('ALTER TABLE captura_has_notas DROP CONSTRAINT FK_453E248AA98F9F02');
        $this->addSql('ALTER TABLE nota DROP CONSTRAINT FK_C8D03E0DE45284D3');
        $this->addSql('DROP TABLE captura_has_notas');
        $this->addSql('DROP TABLE nota');
    }
}
