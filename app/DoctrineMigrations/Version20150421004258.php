<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150421004258 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE DataProvider (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, url LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE DataSource (id INT AUTO_INCREMENT NOT NULL, data_provider_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, url LONGTEXT NOT NULL, INDEX IDX_D3FC5996F593F7E0 (data_provider_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE DataSource ADD CONSTRAINT FK_D3FC5996F593F7E0 FOREIGN KEY (data_provider_id) REFERENCES DataProvider (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DataSource DROP FOREIGN KEY FK_D3FC5996F593F7E0');
        $this->addSql('DROP TABLE DataProvider');
        $this->addSql('DROP TABLE DataSource');
    }
}
