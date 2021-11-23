<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211120074045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employe_occuped (id INT AUTO_INCREMENT NOT NULL, commandeid INT NOT NULL, date_occupe VARCHAR(100) DEFAULT NULL, temps_occupe VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe_occuped_employee (employe_occuped_id INT NOT NULL, employee_id INT NOT NULL, INDEX IDX_31FBF76AB3C18173 (employe_occuped_id), INDEX IDX_31FBF76A8C03F15C (employee_id), PRIMARY KEY(employe_occuped_id, employee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employe_occuped_employee ADD CONSTRAINT FK_31FBF76AB3C18173 FOREIGN KEY (employe_occuped_id) REFERENCES employe_occuped (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe_occuped_employee ADD CONSTRAINT FK_31FBF76A8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe_occuped_employee DROP FOREIGN KEY FK_31FBF76AB3C18173');
        $this->addSql('DROP TABLE employe_occuped');
        $this->addSql('DROP TABLE employe_occuped_employee');
    }
}
