<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211119021152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commandes_paie (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, montant_paie INT NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE paiment_commandes');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paiment_commandes (paiment_id INT NOT NULL, commandes_id INT NOT NULL, INDEX IDX_329F984B78789290 (paiment_id), INDEX IDX_329F984B8BF5C2E6 (commandes_id), PRIMARY KEY(paiment_id, commandes_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE paiment_commandes ADD CONSTRAINT FK_329F984B78789290 FOREIGN KEY (paiment_id) REFERENCES paiment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paiment_commandes ADD CONSTRAINT FK_329F984B8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE commandes_paie');
    }
}
