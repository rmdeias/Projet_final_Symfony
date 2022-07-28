<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728145341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_order ADD payment_method_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A35AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
        $this->addSql('CREATE INDEX IDX_3B1CE6A35AA1164F ON customer_order (payment_method_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_order DROP FOREIGN KEY FK_3B1CE6A35AA1164F');
        $this->addSql('DROP INDEX IDX_3B1CE6A35AA1164F ON customer_order');
        $this->addSql('ALTER TABLE customer_order DROP payment_method_id');
    }
}
