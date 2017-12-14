<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171214194502 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD password VARCHAR(255) DEFAULT NULL AFTER email, CHANGE facebook_id facebook_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE orders CHANGE back_panel_price back_panel_price NUMERIC(8, 0) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders CHANGE back_panel_price back_panel_price NUMERIC(8, 2) NOT NULL');
        $this->addSql('ALTER TABLE users DROP password, CHANGE facebook_id facebook_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
