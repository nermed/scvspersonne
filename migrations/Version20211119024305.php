<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211119024305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes_paie DROP FOREIGN KEY FK_9EAAF13B8BF5C2E6');
        $this->addSql('DROP INDEX IDX_9EAAF13B8BF5C2E6 ON commandes_paie');
        $this->addSql('ALTER TABLE commandes_paie ADD commandesid INT NOT NULL, DROP commandes_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes_paie ADD commandes_id INT DEFAULT NULL, DROP commandesid');
        $this->addSql('ALTER TABLE commandes_paie ADD CONSTRAINT FK_9EAAF13B8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_9EAAF13B8BF5C2E6 ON commandes_paie (commandes_id)');
    }
}
