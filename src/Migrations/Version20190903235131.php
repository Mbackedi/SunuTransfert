<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190903235131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD nom_exp VARCHAR(255) NOT NULL, ADD prenom_exp VARCHAR(255) NOT NULL, ADD telephon_exp INT NOT NULL, ADD adresse_exp VARCHAR(255) NOT NULL, ADD numeropiece_exp BIGINT NOT NULL, ADD typepiece_exp VARCHAR(255) NOT NULL, ADD nom_ben VARCHAR(255) NOT NULL, ADD prenom_ben VARCHAR(255) NOT NULL, ADD telephon_ben INT NOT NULL, ADD adresse_ben VARCHAR(255) NOT NULL, ADD numeropiece_ben BIGINT NOT NULL, ADD typepiece_ben VARCHAR(255) DEFAULT NULL, ADD caissier_ben INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP nom_exp, DROP prenom_exp, DROP telephon_exp, DROP adresse_exp, DROP numeropiece_exp, DROP typepiece_exp, DROP nom_ben, DROP prenom_ben, DROP telephon_ben, DROP adresse_ben, DROP numeropiece_ben, DROP typepiece_ben, DROP caissier_ben');
    }
}
