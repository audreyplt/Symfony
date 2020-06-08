<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116082436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE emprunt (id INT AUTO_INCREMENT NOT NULL, lecteur_id_id INT NOT NULL, livre_id_id INT NOT NULL, date_emprunt DATETIME NOT NULL, date_retour DATETIME DEFAULT NULL, INDEX IDX_364071D7D055A291 (lecteur_id_id), INDEX IDX_364071D7EC470631 (livre_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecteur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password JSON NOT NULL, age INT NOT NULL, UNIQUE INDEX UNIQ_11D3C938E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7D055A291 FOREIGN KEY (lecteur_id_id) REFERENCES lecteur (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7EC470631 FOREIGN KEY (livre_id_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE commande CHANGE usager_id usager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande CHANGE id_commande_id id_commande_id INT DEFAULT NULL, CHANGE produit_id produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usager CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7D055A291');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7EC470631');
        $this->addSql('DROP TABLE emprunt');
        $this->addSql('DROP TABLE lecteur');
        $this->addSql('DROP TABLE livre');
        $this->addSql('ALTER TABLE commande CHANGE usager_id usager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande CHANGE id_commande_id id_commande_id INT DEFAULT NULL, CHANGE produit_id produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usager CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
