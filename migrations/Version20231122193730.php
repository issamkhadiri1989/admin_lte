<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122193730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_book (category_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_407ED97612469DE2 (category_id), INDEX IDX_407ED97616A2B381 (book_id), PRIMARY KEY(category_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(10) NOT NULL, last_name VARCHAR(10) NOT NULL, address LONGTEXT DEFAULT NULL, phone VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_book ADD CONSTRAINT FK_407ED97612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_book ADD CONSTRAINT FK_407ED97616A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_category DROP FOREIGN KEY FK_1FB30F9812469DE2');
        $this->addSql('ALTER TABLE book_category DROP FOREIGN KEY FK_1FB30F9816A2B381');
        $this->addSql('DROP TABLE book_category');
        $this->addSql('ALTER TABLE author CHANGE name name VARCHAR(60) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_CBE5A331CC1CF4E6 ON book');
        $this->addSql('ALTER TABLE book ADD ean13 VARCHAR(13) NOT NULL, ADD edition VARCHAR(255) NOT NULL, DROP price, DROP isbn, CHANGE title title VARCHAR(100) NOT NULL, CHANGE publish_date publish_date DATE NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBE5A3312FAE1FC8 ON book (ean13)');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_category (book_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_1FB30F9812469DE2 (category_id), INDEX IDX_1FB30F9816A2B381 (book_id), PRIMARY KEY(book_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F9812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F9816A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_book DROP FOREIGN KEY FK_407ED97612469DE2');
        $this->addSql('ALTER TABLE category_book DROP FOREIGN KEY FK_407ED97616A2B381');
        $this->addSql('DROP TABLE category_book');
        $this->addSql('DROP TABLE profile');
        $this->addSql('ALTER TABLE author CHANGE name name VARCHAR(20) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_CBE5A3312FAE1FC8 ON book');
        $this->addSql('ALTER TABLE book ADD price DOUBLE PRECISION NOT NULL, ADD isbn VARCHAR(25) NOT NULL, DROP ean13, DROP edition, CHANGE title title VARCHAR(30) NOT NULL, CHANGE publish_date publish_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBE5A331CC1CF4E6 ON book (isbn)');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(35) NOT NULL');
    }
}
