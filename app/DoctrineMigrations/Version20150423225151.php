<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150423225151 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET foreign_key_checks = 0');
        $this->addSql('ALTER TABLE Rule CHANGE data_provider_id data_provider_id INT NOT NULL');
        $this->addSql('SET foreign_key_checks = 1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET foreign_key_checks = 0');
        $this->addSql('ALTER TABLE Rule CHANGE data_provider_id data_provider_id INT DEFAULT NULL');
        $this->addSql('SET foreign_key_checks = 1');
    }
}
