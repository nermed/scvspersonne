<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020081334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, code_commande VARCHAR(255) DEFAULT NULL, com_created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', duree INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes_services (commandes_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_189F1D158BF5C2E6 (commandes_id), INDEX IDX_189F1D15AEF5A6C1 (services_id), PRIMARY KEY(commandes_id, services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes_services ADD CONSTRAINT FK_189F1D158BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes_services ADD CONSTRAINT FK_189F1D15AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes_services DROP FOREIGN KEY FK_189F1D158BF5C2E6');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE commandes_services');
    }
}
