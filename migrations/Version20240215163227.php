<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215163227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrada ADD nota_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT FK_C949A274A98F9F02 FOREIGN KEY (nota_id) REFERENCES nota (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C949A274A98F9F02 ON entrada (nota_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE entrada DROP CONSTRAINT FK_C949A274A98F9F02');
        $this->addSql('DROP INDEX IDX_C949A274A98F9F02');
        $this->addSql('ALTER TABLE entrada DROP nota_id');
    }
}
