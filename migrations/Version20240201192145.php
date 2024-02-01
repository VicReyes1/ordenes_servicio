<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201192145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $organizaciones = [
            "Administradora del Teatro de la Ciudad San Francisco y Parque David Ben Gurión",
            "Agencia de Desarrollo Valle de Plata",
            "Agencia Estatal de Energía de Hidalgo",
            "Bachillerato del Estado de Hidalgo",
            "Centro de Conciliación Laboral del Trabajo del Estado de Hidalgo",
            "Centro de Justicia para Mujeres del Estado de Hidalgo",
            "Centro Estatal de Maquinaria para el Desarrollo",
            "Ciudad de las Mujeres",
            "Colegio de Bachilleres del Estado de Hidalgo",
            "Colegio de Educación Profesional Técnica del Estado de Hidalgo",
            "Colegio de Estudios Científicos y Tecnológicos del Estado de Hidalgo",
            "Comisión de Agua y Alcantarillado de Sistemas Intermunicipales",
            "Comisión de Agua y Alcantarillado del Sistema del Valle del Mezquital",
            "Comisión de Arbitraje Médico del Estado de Hidalgo",
            "Comisión Estatal de Vivienda",
            "Comisión Estatal del Agua y Alcantarillado",
            "Consejo Estatal para la Cultura y las Artes de Hidalgo",
            "Consejo Hidalguense del Café",
            "Corporación de Fomento de Infraestructura Industrial",
            "Corporación Internacional Hidalgo",
            "Dirección General de Atención al Migrante",
            "El Colegio del Estado de Hidalgo",
            "Escuela de Música del Estado de Hidalgo",
            "Instituto Catastral del Estado de Hidalgo",
            "Instituto de Capacitación para el Trabajo del Estado de Hidalgo",
            "Instituto de Vivienda, Desarrollo Urbano y Asentamientos Humanos",
            "Instituto Hidalguense de Competitividad Empresarial",
            "Instituto Hidalguense de Educación",
            "Instituto Hidalguense de Educación para Adultos",
            "Instituto Hidalguense de Financiamiento a la Educación Superior",
            "Instituto Hidalguense de la Infraestructura Física Educativa",
            "Instituto Hidalguense de la Juventud",
            "Instituto Hidalguense de las Mujeres",
            "Instituto Hidalguense del Deporte",
            "Instituto Hidalguense para el Desarrollo Municipal",
            "Instituto para el Financiamiento del Estado de Hidalgo",
            "Instituto para la Atención de las y los Adultos Mayores del Estado de Hidalgo",
            "Instituto Tecnológico Superior de Huichapan",
            "Instituto Tecnológico Superior del Occidente del Estado de Hidalgo",
            "Instituto Tecnológico Superior del Oriente del Estado de Hidalgo",
            "Operadora de Eventos del Estado de Hidalgo",
            "Policía Industrial Bancaria del Estado de Hidalgo",
            "Radio y Televisión de Hidalgo",
            "Régimen Estatal de Protección Social en Salud del Estado de Hidalgo",
            "Servicios de Salud de Hidalgo",
            "Sistema de Autopistas, Servicios Conexos y Auxiliares del Estado de Hidalgo",
            "Sistema de Transporte Convencional de Hidalgo",
            "Sistema Integrado de Transporte Masivo de Hidalgo",
            "Subsecretaría de Educación Media Superior y Superior",
            "Universidad Intercultural del Estado de Hidalgo",
            "Universidad Politécnica de Francisco I. Madero",
            "Universidad Politécnica de Huejutla",
            "Universidad Politécnica de la Energía",
            "Universidad Politécnica de Pachuca",
            "Universidad Politécnica de Tulancingo",
            "Universidad Politécnica Metropolitana de Hidalgo",
            "Universidad Tecnológica de la Huasteca Hidalguense",
            "Universidad Tecnológica de la Sierra Hidalguense",
            "Universidad Tecnológica de la Zona Metropolitana del Valle de México",
            "Universidad Tecnológica de Mineral de la Reforma",
            "Universidad Tecnológica de Tula-Tepeji",
            "Universidad Tecnológica de Tulancingo",
            "Universidad Tecnológica del Valle del Mezquital",
            "Universidad Tecnológica Minera de Zimapán",
            "Secretaría Técnica del Sistema Estatal Anticorrupción de Hidalgo",
            "Sistema para el Desarrollo Integral de la Familia del Estado de Hidalgo",
            "Comisión para el Desarrollo Sostenible de los Pueblos Indígenas",
            "Consejo de Ciencia, Tecnología e Innovación de Hidalgo",
            "Museo Interactivo para la Niñez y la Juventud Hidalguense “El Rehilete”",
            "Consejo Rector de Pachuca Ciudad del Conocimiento y la Cultura",
            "Consejo Ejecutivo del Complejo Científico y Tecnológico Sincrotrón en el Estado de Hidalgo",
            "Secretaría Técnica del Sistema Estatal Anticorrupción de Hidalgo",
            "Sistema para el Desarrollo Integral de la Familia del Estado de Hidalgo",
            "Comisión para el Desarrollo Sostenible de los Pueblos Indígenas",
            "Consejo de Ciencia, Tecnología e Innovación de Hidalgo",
            "Museo Interactivo para la Niñez y la Juventud Hidalguense “El Rehilete”",
            "Consejo Rector de Pachuca \"Ciudad del Conocimiento y la Cultura\"",
            "Consejo Ejecutivo del Complejo Científico y Tecnológico Sincrotrón en el Estado de Hidalgo"
        ];

        

        for ($i=0; $i < sizeof($organizaciones); $i++) { 
            $organizacion = $organizaciones[$i];
            $this->addSql("INSERT INTO secretaria (id,nombre) VALUES ($i + 1,'$organizacion')");
        }

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}
