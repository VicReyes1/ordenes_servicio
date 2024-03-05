<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229163203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $table = $schema->getTable('nota');
        $foreignKeys = $table->getForeignKeys();

        $relationExists = false;
        foreach ($foreignKeys as $foreignKey) {
            if ($foreignKey->getLocalColumns() === ['captura_id'] && $foreignKey->getForeignTableName() === 'captura') {
                $relationExists = true;
                break;
            }
        }

        if (!$relationExists) {
            $this->addSql('ALTER TABLE nota ADD captura_id INT NOT NULL');
            $this->addSql('ALTER TABLE nota ADD CONSTRAINT FK_C8D03E0DE45284D3 FOREIGN KEY (captura_id) REFERENCES captura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
            $this->addSql('CREATE INDEX IDX_C8D03E0DE45284D3 ON nota (captura_id)');
        }
    }

    

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE nota DROP CONSTRAINT FK_C8D03E0DE45284D3');
        $this->addSql('DROP INDEX IDX_C8D03E0DE45284D3');
        $this->addSql('ALTER TABLE nota DROP captura_id');
    }
}
