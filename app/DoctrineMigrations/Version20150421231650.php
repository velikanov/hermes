<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150421231650 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE RssTemplateField (id INT AUTO_INCREMENT NOT NULL, rss_template_id INT DEFAULT NULL, rss_article_field_id INT DEFAULT NULL, value VARCHAR(50) NOT NULL, INDEX IDX_8CB8BD44C88B9527 (rss_template_id), INDEX IDX_8CB8BD44835EAF5E (rss_article_field_id), UNIQUE INDEX UNIQ_8CB8BD44C88B9527835EAF5E (rss_template_id, rss_article_field_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE RssTemplateField ADD CONSTRAINT FK_8CB8BD44C88B9527 FOREIGN KEY (rss_template_id) REFERENCES RssTemplate (id)');
        $this->addSql('ALTER TABLE RssTemplateField ADD CONSTRAINT FK_8CB8BD44835EAF5E FOREIGN KEY (rss_article_field_id) REFERENCES RssArticleField (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE RssTemplateField');
    }
}
