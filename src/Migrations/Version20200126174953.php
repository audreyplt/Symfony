<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200126174953 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande CHANGE usager_id usager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B9AF8E3A3');
        $this->addSql('DROP INDEX IDX_3170B74B9AF8E3A3 ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande ADD commandes_id INT DEFAULT NULL, DROP id_commande, CHANGE produit_id produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B8BF5C2E6 ON ligne_commande (commandes_id)');
        $this->addSql('ALTER TABLE usager CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande CHANGE usager_id usager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B8BF5C2E6');
        $this->addSql('DROP INDEX IDX_3170B74B8BF5C2E6 ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande ADD id_commande INT DEFAULT NULL, DROP commandes_id, CHANGE produit_id produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B9AF8E3A3 FOREIGN KEY (id_commande) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B9AF8E3A3 ON ligne_commande (id_commande)');
        $this->addSql('ALTER TABLE usager CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
