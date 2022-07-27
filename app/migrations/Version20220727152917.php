<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727152917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, price INT NOT NULL, description LONGTEXT DEFAULT NULL, img VARCHAR(255) DEFAULT NULL, img_alt VARCHAR(255) DEFAULT NULL, promo INT DEFAULT NULL, when_deleted DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_category (article_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_53A4EDAA7294869C (article_id), INDEX IDX_53A4EDAA12469DE2 (category_id), PRIMARY KEY(article_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_variation (id INT AUTO_INCREMENT NOT NULL, supplier_id INT DEFAULT NULL, article_id INT DEFAULT NULL, size VARCHAR(5) DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_B8AE63CE2ADD6D8C (supplier_id), INDEX IDX_B8AE63CE7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_order (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, statut VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_3B1CE6A3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_order_article (customer_order_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_9025D72EA15A2E17 (customer_order_id), INDEX IDX_9025D72E7294869C (article_id), PRIMARY KEY(customer_order_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_method (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, when_deleted DATE DEFAULT NULL, phone VARCHAR(30) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, restriction TINYINT(1) NOT NULL, zip_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, street_number INT NOT NULL, additional_address VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_payment_method (user_id INT NOT NULL, payment_method_id INT NOT NULL, INDEX IDX_10E47EAFA76ED395 (user_id), INDEX IDX_10E47EAF5AA1164F (payment_method_id), PRIMARY KEY(user_id, payment_method_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_variation ADD CONSTRAINT FK_B8AE63CE2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE article_variation ADD CONSTRAINT FK_B8AE63CE7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer_order_article ADD CONSTRAINT FK_9025D72EA15A2E17 FOREIGN KEY (customer_order_id) REFERENCES customer_order (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_order_article ADD CONSTRAINT FK_9025D72E7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_payment_method ADD CONSTRAINT FK_10E47EAFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_payment_method ADD CONSTRAINT FK_10E47EAF5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_53A4EDAA7294869C');
        $this->addSql('ALTER TABLE article_variation DROP FOREIGN KEY FK_B8AE63CE7294869C');
        $this->addSql('ALTER TABLE customer_order_article DROP FOREIGN KEY FK_9025D72E7294869C');
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_53A4EDAA12469DE2');
        $this->addSql('ALTER TABLE customer_order_article DROP FOREIGN KEY FK_9025D72EA15A2E17');
        $this->addSql('ALTER TABLE user_payment_method DROP FOREIGN KEY FK_10E47EAF5AA1164F');
        $this->addSql('ALTER TABLE article_variation DROP FOREIGN KEY FK_B8AE63CE2ADD6D8C');
        $this->addSql('ALTER TABLE customer_order DROP FOREIGN KEY FK_3B1CE6A3A76ED395');
        $this->addSql('ALTER TABLE user_payment_method DROP FOREIGN KEY FK_10E47EAFA76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_category');
        $this->addSql('DROP TABLE article_variation');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE customer_order');
        $this->addSql('DROP TABLE customer_order_article');
        $this->addSql('DROP TABLE payment_method');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_payment_method');
    }
}
