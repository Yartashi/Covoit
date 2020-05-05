<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505130658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE stage_tuteur DROP FOREIGN KEY FK_CAC883732298D193');
        $this->addSql('ALTER TABLE Stage DROP FOREIGN KEY FK_3BDBC6DBCF5E72D');
        $this->addSql('ALTER TABLE stage_tuteur DROP FOREIGN KEY FK_CAC8837386EC68D8');
        $this->addSql('DROP TABLE Stage');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE date_inscr');
        $this->addSql('DROP TABLE stage_tuteur');
        $this->addSql('DROP TABLE tuteur');
        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE num_tel num_tel VARCHAR(255) DEFAULT NULL, CHANGE date_naiss date_naiss DATE DEFAULT NULL, CHANGE style_choix style_choix INT DEFAULT NULL, CHANGE langue_choix langue_choix VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet CHANGE conducteur_id_id conducteur_id_id INT DEFAULT NULL, CHANGE statut statut INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Stage (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, poste VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, actif TINYINT(1) NOT NULL, date_creation DATE NOT NULL, date_modification DATE DEFAULT \'NULL\', date_expiration DATE DEFAULT \'NULL\', email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, societe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3BDBC6DBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE date_inscr (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stage_tuteur (stage_id INT NOT NULL, tuteur_id INT NOT NULL, INDEX IDX_CAC8837386EC68D8 (tuteur_id), INDEX IDX_CAC883732298D193 (stage_id), PRIMARY KEY(stage_id, tuteur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tuteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE Stage ADD CONSTRAINT FK_3BDBC6DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE stage_tuteur ADD CONSTRAINT FK_CAC883732298D193 FOREIGN KEY (stage_id) REFERENCES Stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage_tuteur ADD CONSTRAINT FK_CAC8837386EC68D8 FOREIGN KEY (tuteur_id) REFERENCES tuteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet CHANGE conducteur_id_id conducteur_id_id INT DEFAULT NULL, CHANGE statut statut INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE num_tel num_tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE date_naiss date_naiss DATE DEFAULT \'NULL\', CHANGE style_choix style_choix INT DEFAULT NULL, CHANGE langue_choix langue_choix VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
