<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206193430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE nota ADD captura_id INT NOT NULL');
        $this->addSql('ALTER TABLE nota ADD estatus BOOLEAN NOT NULL');
        //$this->addSql('ALTER TABLE nota ADD CONSTRAINT FK_C8D03E0DE45284D3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        //$this->addSql('CREATE INDEX IDX_C8D03E0DE45284D3 ON nota (captura_id)');
        $this->addSql('ALTER TABLE nota_has_materiales ADD cantidad DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE nota_has_materiales DROP estatus');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE nota_has_materiales ADD estatus VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE nota_has_materiales DROP cantidad');
        $this->addSql('ALTER TABLE nota DROP CONSTRAINT FK_C8D03E0DE45284D3');
        $this->addSql('DROP INDEX IDX_C8D03E0DE45284D3');
        $this->addSql('ALTER TABLE nota DROP captura_id');
        $this->addSql('ALTER TABLE nota DROP estatus');
    }
}
