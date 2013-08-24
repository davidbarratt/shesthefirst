<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130824103225 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        // $this->addSql("DROP INDEX UNIQ_6B74C8E0E7A1254A ON facebook");
        $this->addSql("ALTER TABLE facebook DROP PRIMARY KEY");
        $this->addSql("ALTER TABLE facebook CHANGE contact_id contact_id INT NOT NULL");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_6B74C8E09BE8FD98 ON facebook (facebook_id)");
        $this->addSql("ALTER TABLE facebook ADD PRIMARY KEY (contact_id)");
        $this->addSql("ALTER TABLE facebook CHANGE facebook_id facebook_id bigint(20) NOT NULL AFTER contact_id");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP INDEX UNIQ_6B74C8E09BE8FD98 ON facebook");
        $this->addSql("ALTER TABLE facebook DROP PRIMARY KEY");
        $this->addSql("ALTER TABLE facebook CHANGE contact_id contact_id INT DEFAULT NULL");
        // $this->addSql("CREATE UNIQUE INDEX UNIQ_6B74C8E0E7A1254A ON facebook (contact_id)");
        $this->addSql("ALTER TABLE facebook ADD PRIMARY KEY (facebook_id)");
    }
}
