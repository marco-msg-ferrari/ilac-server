<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150605123551 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
          INSERT INTO events (created_at, discr, type, user_id, value)
          SELECT created_at, "test" as discr, type, user_id, value
          FROM glucotest;
        ');

        $this->addSql('
          INSERT INTO events (created_at, discr, type, user_id, value)
          SELECT created_at, "insulin" as discr, type, user_id, value
          FROM insulinbolus;
        ');

        //$this->addSql('DROP TABLE glucotest');
        //$this->addSql('DROP TABLE insulinbolus');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /*$this->addSql('CREATE TABLE glucotest (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, value INT NOT NULL, created_at DATETIME NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_8B268EC3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE insulinbolus (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL, value INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_9A6C1B28A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE glucotest ADD CONSTRAINT FK_8B268EC3A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE insulinbolus ADD CONSTRAINT FK_9A6C1B28A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        */
    }
}
