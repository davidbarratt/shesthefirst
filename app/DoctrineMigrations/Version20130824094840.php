<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130824094840 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE contact (contact_id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(contact_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        
        $this->addSql('INSERT INTO contact (first_name, last_name, email, created, updated) SELECT first_name, last_name, email, created, updated FROM facebook');

        $this->addSql("ALTER TABLE facebook ADD contact_id INT DEFAULT NULL AFTER facebook_id");
        
        $this->addSql("ALTER TABLE facebook ADD CONSTRAINT FK_6B74C8E0E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (contact_id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_6B74C8E0E7A1254A ON facebook (contact_id)");
        
        $this->addSql('UPDATE facebook f, contact c SET f.contact_id = c.contact_id WHERE f.email = c.email');
        
        // Special Case for User Missing Email
        $this->addSql('UPDATE facebook f SET f.contact_id = 7 WHERE f.facebook_id = 1102740164');
                        
        $this->addSql("ALTER TABLE facebook DROP first_name, DROP last_name, DROP email");
    
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE facebook ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) DEFAULT NULL");
        
        $this->addSql('UPDATE facebook f, contact c SET f.first_name = c.first_name, f.last_name = c.last_name, f.email = c.email WHERE f.contact_id = c.contact_id');
                
        $this->addSql("ALTER TABLE facebook DROP FOREIGN KEY FK_6B74C8E0E7A1254A");
        $this->addSql("DROP TABLE contact");
        $this->addSql("DROP INDEX UNIQ_6B74C8E0E7A1254A ON facebook");
        $this->addSql("ALTER TABLE facebook DROP contact_id");
    }
}
