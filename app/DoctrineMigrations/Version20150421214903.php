<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150421214903 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE RssTemplate (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE DataProvider ADD rss_template_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE DataProvider ADD CONSTRAINT FK_63C07DBEC88B9527 FOREIGN KEY (rss_template_id) REFERENCES RssTemplate (id)');
        $this->addSql('CREATE INDEX IDX_63C07DBEC88B9527 ON DataProvider (rss_template_id)');
        $this->addSql('ALTER TABLE DataSource ADD rss_template_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE DataSource ADD CONSTRAINT FK_D3FC5996C88B9527 FOREIGN KEY (rss_template_id) REFERENCES RssTemplate (id)');
        $this->addSql('CREATE INDEX IDX_D3FC5996C88B9527 ON DataSource (rss_template_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DataProvider DROP FOREIGN KEY FK_63C07DBEC88B9527');
        $this->addSql('ALTER TABLE DataSource DROP FOREIGN KEY FK_D3FC5996C88B9527');
        $this->addSql('DROP TABLE RssTemplate');
        $this->addSql('DROP INDEX IDX_63C07DBEC88B9527 ON DataProvider');
        $this->addSql('ALTER TABLE DataProvider DROP rss_template_id');
        $this->addSql('DROP INDEX IDX_D3FC5996C88B9527 ON DataSource');
        $this->addSql('ALTER TABLE DataSource DROP rss_template_id');
    }
}
