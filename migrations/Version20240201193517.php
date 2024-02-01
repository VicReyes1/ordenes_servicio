<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201193517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $secretarias = [
            'Secretaría de Gabinete',
            'Secretaría del Despacho de la Persona Titular del Poder Ejecutivo del Estado',
            'Oficialía Mayor',
            'Unidad de Planeación y Prospectiva',
            'Secretaría de Agricultura y Desarrollo Rural',
            'Secretaría de Bienestar e Inclusión Social',
            'Secretaría de Contraloría',
            'Secretaría de Cultura',
            'Secretaría de Desarrollo Económico',
            'Secretaría de Educación Pública',
            'Secretaría de Gobierno',
            'Secretaría de Hacienda',
            'Secretaría de Infraestructura Pública y Desarrollo Urbano Sostenible',
            'Secretaría de Medio Ambiente y Recursos Naturales',
            'Secretaría de Movilidad y Transporte',
            'Secretaría de Turismo',
            'Secretaría de Salud',
            'Secretaría de Seguridad Pública',
            'Secretaría del Trabajo y Previsión Social',
        ];

        for ($i=0; $i < sizeof($secretarias); $i++) { 
            $secretaria = $secretarias[$i];
            $this->addSql("INSERT INTO secretaria (id,nombre) VALUES ($i+79 ,'$secretaria')");
        }


    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}
