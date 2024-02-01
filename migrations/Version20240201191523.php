<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201191523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE secretaria_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE secretaria (id INT NOT NULL, nombre VARCHAR(355) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE captura ADD secretaria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE captura ADD CONSTRAINT FK_8C9362FC584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretaria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8C9362FC584CC12E ON captura (secretaria_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE captura DROP CONSTRAINT FK_8C9362FC584CC12E');
        $this->addSql('DROP SEQUENCE secretaria_id_seq CASCADE');
        $this->addSql('DROP TABLE secretaria');
        $this->addSql('DROP INDEX IDX_8C9362FC584CC12E');
        $this->addSql('ALTER TABLE captura DROP secretaria_id');
    }
}
