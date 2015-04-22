<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150422224938 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ArticleTranslationVersion (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_BC2EB58C7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ArticleTranslationVersion ADD CONSTRAINT FK_BC2EB58C7294869C FOREIGN KEY (article_id) REFERENCES Article (id)');
        $this->addSql('ALTER TABLE Article ADD content LONGTEXT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ArticleTranslationVersion');
        $this->addSql('ALTER TABLE Article DROP content');
    }
}
