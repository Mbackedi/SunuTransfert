<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190904000622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD caissier_ben_id INT DEFAULT NULL, DROP caissier_ben');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D17EC9DBFE FOREIGN KEY (caissier_ben_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_723705D17EC9DBFE ON transaction (caissier_ben_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D17EC9DBFE');
        $this->addSql('DROP INDEX IDX_723705D17EC9DBFE ON transaction');
        $this->addSql('ALTER TABLE transaction ADD caissier_ben INT NOT NULL, DROP caissier_ben_id');
    }
}
