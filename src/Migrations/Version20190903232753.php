<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190903232753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D15AF81F68');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D14795A786');
        $this->addSql('DROP TABLE beneficiaire');
        $this->addSql('DROP TABLE envoyeur');
        $this->addSql('DROP INDEX IDX_723705D15AF81F68 ON transaction');
        $this->addSql('DROP INDEX IDX_723705D14795A786 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP envoyeur_id, DROP beneficiaire_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE beneficiaire (id INT AUTO_INCREMENT NOT NULL, telephoneb INT NOT NULL, nomb VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, prenomb VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, adresseb VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, numpieceb BIGINT DEFAULT NULL, typepieceb VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE envoyeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, prenom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, numeropiece BIGINT NOT NULL, typepiece VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE transaction ADD envoyeur_id INT DEFAULT NULL, ADD beneficiaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D14795A786 FOREIGN KEY (envoyeur_id) REFERENCES envoyeur (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D15AF81F68 FOREIGN KEY (beneficiaire_id) REFERENCES beneficiaire (id)');
        $this->addSql('CREATE INDEX IDX_723705D15AF81F68 ON transaction (beneficiaire_id)');
        $this->addSql('CREATE INDEX IDX_723705D14795A786 ON transaction (envoyeur_id)');
    }
}
