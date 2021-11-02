<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020054003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autre_experience (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, image_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, date_naissance DATE DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, niveau_academique VARCHAR(100) DEFAULT NULL, autre_experience VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by INT NOT NULL, modify_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', modify_by INT DEFAULT NULL, telephone VARCHAR(100) DEFAULT NULL, img_path VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, quartier VARCHAR(255) DEFAULT NULL, commune VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_autre_experience (employee_id INT NOT NULL, autre_experience_id INT NOT NULL, INDEX IDX_B64633F8C03F15C (employee_id), INDEX IDX_B64633F4D3595C4 (autre_experience_id), PRIMARY KEY(employee_id, autre_experience_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee_autre_experience ADD CONSTRAINT FK_B64633F8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_autre_experience ADD CONSTRAINT FK_B64633F4D3595C4 FOREIGN KEY (autre_experience_id) REFERENCES autre_experience (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_autre_experience DROP FOREIGN KEY FK_B64633F4D3595C4');
        $this->addSql('ALTER TABLE employee_autre_experience DROP FOREIGN KEY FK_B64633F8C03F15C');
        $this->addSql('DROP TABLE autre_experience');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_autre_experience');
    }
}
