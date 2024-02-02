<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202201153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrada ADD captura_id INT NOT NULL');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT FK_C949A274E45284D3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C949A274E45284D3 ON entrada (captura_id)');
        $this->addSql('ALTER TABLE salida ADD captura_id INT NOT NULL');
        $this->addSql('ALTER TABLE salida ADD CONSTRAINT FK_95F4C748E45284D3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_95F4C748E45284D3 ON salida (captura_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE salida DROP CONSTRAINT FK_95F4C748E45284D3');
        $this->addSql('DROP INDEX IDX_95F4C748E45284D3');
        $this->addSql('ALTER TABLE salida DROP captura_id');
        $this->addSql('ALTER TABLE entrada DROP CONSTRAINT FK_C949A274E45284D3');
        $this->addSql('DROP INDEX IDX_C949A274E45284D3');
        $this->addSql('ALTER TABLE entrada DROP captura_id');
    }
}
