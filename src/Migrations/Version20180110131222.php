<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180110131222 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` CHANGE order_ticketCategory order_ticketCategory VARCHAR(10) NOT NULL, CHANGE order_userMail order_userMail VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE ticket CHANGE ticket_guestFirstName ticket_guestFirstName VARCHAR(30) NOT NULL, CHANGE ticket_guestLastName ticket_guestLastName VARCHAR(30) NOT NULL, CHANGE ticket_guestCountry ticket_guestCountry VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` CHANGE order_ticketCategory order_ticketCategory VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE order_userMail order_userMail VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE ticket CHANGE ticket_guestFirstName ticket_guestFirstName VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE ticket_guestLastName ticket_guestLastName VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE ticket_guestCountry ticket_guestCountry VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
