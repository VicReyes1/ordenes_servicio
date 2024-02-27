<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227192501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE levantamiento ALTER imagen1 DROP NOT NULL');
        $this->addSql('ALTER TABLE levantamiento ALTER imagen2 DROP NOT NULL');
        $this->addSql('ALTER TABLE levantamiento ALTER imagen3 DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE levantamiento ALTER imagen1 SET NOT NULL');
        $this->addSql('ALTER TABLE levantamiento ALTER imagen2 SET NOT NULL');
        $this->addSql('ALTER TABLE levantamiento ALTER imagen3 SET NOT NULL');
    }
}
