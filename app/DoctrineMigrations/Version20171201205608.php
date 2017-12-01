<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171201205608 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users CHANGE postal_code postal_code INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders CHANGE status status ENUM(\'1\', \'2\', \'3\'), CHANGE back_panel_price back_panel_price NUMERIC(8, 2) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders CHANGE status status VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE back_panel_price back_panel_price NUMERIC(8, 0) NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
