<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200521084310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE num_tel num_tel VARCHAR(255) DEFAULT NULL, CHANGE date_naiss date_naiss DATE DEFAULT NULL, CHANGE style_choix style_choix INT DEFAULT NULL, CHANGE langue_choix langue_choix VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet CHANGE conducteur_id_id conducteur_id_id INT DEFAULT NULL, CHANGE statut statut INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet CHANGE conducteur_id_id conducteur_id_id INT DEFAULT NULL, CHANGE statut statut INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE num_tel num_tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE date_naiss date_naiss DATE DEFAULT \'NULL\', CHANGE style_choix style_choix INT DEFAULT NULL, CHANGE langue_choix langue_choix VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
