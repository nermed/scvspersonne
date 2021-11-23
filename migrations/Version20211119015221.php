<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211119015221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autre_experience (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, image_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, name_client VARCHAR(100) NOT NULL, prenom_client VARCHAR(100) NOT NULL, email VARCHAR(100) DEFAULT NULL, quartier VARCHAR(100) NOT NULL, commune VARCHAR(100) NOT NULL, province VARCHAR(100) NOT NULL, telephone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_detail (id INT AUTO_INCREMENT NOT NULL, commandes_id INT NOT NULL, services_id INT NOT NULL, hours INT NOT NULL, price INT NOT NULL, com_created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2C5284468BF5C2E6 (commandes_id), INDEX IDX_2C528446AEF5A6C1 (services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, code_commande VARCHAR(255) DEFAULT NULL, com_created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_35D4282CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, date_naissance DATE DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, niveau_academique VARCHAR(100) DEFAULT NULL, autre_experience VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by INT NOT NULL, modify_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', modify_by INT DEFAULT NULL, telephone VARCHAR(100) DEFAULT NULL, img_path VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, quartier VARCHAR(255) DEFAULT NULL, commune VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, disponible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_autre_experience (employee_id INT NOT NULL, autre_experience_id INT NOT NULL, INDEX IDX_B64633F8C03F15C (employee_id), INDEX IDX_B64633F4D3595C4 (autre_experience_id), PRIMARY KEY(employee_id, autre_experience_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiment (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(100) NOT NULL, code VARCHAR(255) NOT NULL, montant_paie INT DEFAULT NULL, total_paie INT DEFAULT NULL, branch VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiment_commandes (paiment_id INT NOT NULL, commandes_id INT NOT NULL, INDEX IDX_329F984B78789290 (paiment_id), INDEX IDX_329F984B8BF5C2E6 (commandes_id), PRIMARY KEY(paiment_id, commandes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price_initial DOUBLE PRECISION NOT NULL, price_special DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modify_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by INT NOT NULL, modified_by INT DEFAULT NULL, deleted_by INT DEFAULT NULL, deleted_status INT DEFAULT NULL, quantity_max INT NOT NULL, code_service VARCHAR(255) NOT NULL, duree INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6ACCF62EF85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_client (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, telephone INT NOT NULL, email VARCHAR(100) DEFAULT NULL, quartier VARCHAR(255) NOT NULL, commune VARCHAR(100) NOT NULL, province VARCHAR(100) NOT NULL, sexe VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_A2161F68F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_detail ADD CONSTRAINT FK_2C5284468BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE commande_detail ADD CONSTRAINT FK_2C528446AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CF675F31B FOREIGN KEY (author_id) REFERENCES user_client (id)');
        $this->addSql('ALTER TABLE employee_autre_experience ADD CONSTRAINT FK_B64633F8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_autre_experience ADD CONSTRAINT FK_B64633F4D3595C4 FOREIGN KEY (autre_experience_id) REFERENCES autre_experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paiment_commandes ADD CONSTRAINT FK_329F984B78789290 FOREIGN KEY (paiment_id) REFERENCES paiment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paiment_commandes ADD CONSTRAINT FK_329F984B8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_autre_experience DROP FOREIGN KEY FK_B64633F4D3595C4');
        $this->addSql('ALTER TABLE commande_detail DROP FOREIGN KEY FK_2C5284468BF5C2E6');
        $this->addSql('ALTER TABLE paiment_commandes DROP FOREIGN KEY FK_329F984B8BF5C2E6');
        $this->addSql('ALTER TABLE employee_autre_experience DROP FOREIGN KEY FK_B64633F8C03F15C');
        $this->addSql('ALTER TABLE paiment_commandes DROP FOREIGN KEY FK_329F984B78789290');
        $this->addSql('ALTER TABLE commande_detail DROP FOREIGN KEY FK_2C528446AEF5A6C1');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CF675F31B');
        $this->addSql('DROP TABLE autre_experience');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE commande_detail');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_autre_experience');
        $this->addSql('DROP TABLE paiment');
        $this->addSql('DROP TABLE paiment_commandes');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE user_admin');
        $this->addSql('DROP TABLE user_client');
    }
}
