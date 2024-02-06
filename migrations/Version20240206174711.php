<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206174711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrada ADD precio_adquirido DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE material ALTER categoria_id SET NOT NULL');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE material ALTER categoria_id DROP NOT NULL');
        $this->addSql('ALTER TABLE nota DROP CONSTRAINT FK_C8D03E0DE45284D3');
        $this->addSql('DROP INDEX IDX_C8D03E0DE45284D3');
        $this->addSql('ALTER TABLE nota DROP captura_id');
        $this->addSql('ALTER TABLE entrada DROP precio_adquirido');
    }
}
