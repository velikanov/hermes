<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150421212649 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Article (id INT AUTO_INCREMENT NOT NULL, data_source_id INT DEFAULT NULL, title LONGTEXT NOT NULL, description LONGTEXT NOT NULL, url LONGTEXT NOT NULL, url_hash VARCHAR(32) NOT NULL, date_time DATETIME NOT NULL, INDEX IDX_CD8737FA1A935C57 (data_source_id), INDEX IDX_CD8737FA4F4A11B1 (date_time), UNIQUE INDEX UNIQ_CD8737FACFECAB00 (url_hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FA1A935C57 FOREIGN KEY (data_source_id) REFERENCES DataSource (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Article');
    }
}
