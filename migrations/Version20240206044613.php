<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206044613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Insertar tres elementos en la tabla "categoria"
        
        $this->addSql('INSERT INTO categoria (id, nombre) VALUES (1, \'Electrico\')');
        $this->addSql('INSERT INTO categoria (id, nombre) VALUES (2, \'Carpinteria\')');
        $this->addSql('INSERT INTO categoria (id, nombre) VALUES (3, \'Construccion\')');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categoria');
    }
}
