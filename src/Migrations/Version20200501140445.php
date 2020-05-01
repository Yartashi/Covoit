<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501140445 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE date_inscr (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE trajet_id trajet_id INT DEFAULT NULL, CHANGE nb_passag nb_passage INT NOT NULL');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C40868EB5');
        $this->addSql('DROP INDEX IDX_2B5BA98C40868EB5 ON trajet');
        $this->addSql('ALTER TABLE trajet ADD conducteur_id_id INT DEFAULT NULL, DROP cr_id, CHANGE statut statut INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98C24F8F475 FOREIGN KEY (conducteur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98C24F8F475 ON trajet (conducteur_id_id)');
        $this->addSql('ALTER TABLE utilisateur ADD mdp VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, CHANGE num_tel num_tel VARCHAR(255) DEFAULT NULL, CHANGE date_naiss date_naiss DATE DEFAULT NULL, CHANGE style_choix style_choix INT DEFAULT NULL, CHANGE langue_choix langue_choix VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE date_inscr');
        $this->addSql('ALTER TABLE commentaire CHANGE utilisateur_id utilisateur_id INT NOT NULL, CHANGE trajet_id trajet_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT NOT NULL, CHANGE trajet_id trajet_id INT NOT NULL, CHANGE nb_passage nb_passag INT NOT NULL');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C24F8F475');
        $this->addSql('DROP INDEX IDX_2B5BA98C24F8F475 ON trajet');
        $this->addSql('ALTER TABLE trajet ADD cr_id INT NOT NULL, DROP conducteur_id_id, CHANGE statut statut INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98C40868EB5 FOREIGN KEY (cr_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98C40868EB5 ON trajet (cr_id)');
        $this->addSql('ALTER TABLE utilisateur DROP mdp, DROP adresse, CHANGE num_tel num_tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE date_naiss date_naiss DATE DEFAULT \'NULL\', CHANGE style_choix style_choix INT DEFAULT NULL, CHANGE langue_choix langue_choix VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
