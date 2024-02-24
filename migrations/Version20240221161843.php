<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221161843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE captura_has_personal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE captura_has_personal (id INT NOT NULL, captura_id INT NOT NULL, tipo_id INT NOT NULL, trabajador_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4236993CE45284D3 ON captura_has_personal (captura_id)');
        $this->addSql('CREATE INDEX IDX_4236993CA9276E6C ON captura_has_personal (tipo_id)');
        $this->addSql('CREATE INDEX IDX_4236993CEC3656E ON captura_has_personal (trabajador_id)');
        $this->addSql('ALTER TABLE captura_has_personal ADD CONSTRAINT FK_4236993CE45284D3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE captura_has_personal ADD CONSTRAINT FK_4236993CA9276E6C FOREIGN KEY (tipo_id) REFERENCES categoria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE captura_has_personal ADD CONSTRAINT FK_4236993CEC3656E FOREIGN KEY (trabajador_id) REFERENCES personal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE captura_has_personal_id_seq CASCADE');
        $this->addSql('ALTER TABLE captura_has_personal DROP CONSTRAINT FK_4236993CE45284D3');
        $this->addSql('ALTER TABLE captura_has_personal DROP CONSTRAINT FK_4236993CA9276E6C');
        $this->addSql('ALTER TABLE captura_has_personal DROP CONSTRAINT FK_4236993CEC3656E');
        $this->addSql('DROP TABLE captura_has_personal');
    }
}
