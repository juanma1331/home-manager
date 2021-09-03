<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210903073158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_64C19C15E237E06');
        $this->addSql('CREATE TEMPORARY TABLE __temp__category AS SELECT id, name FROM category');
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TABLE category (id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO category (id, name) SELECT id, name FROM __temp__category');
        $this->addSql('DROP TABLE __temp__category');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C15E237E06 ON category (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C1989D9B62 ON category (slug)');
        $this->addSql('DROP INDEX UNIQ_D34A04AD5E237E06');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2');
        $this->addSql('DROP INDEX IDX_D34A04AD5DC6FE57');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, category_id, subcategory_id, name FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , category_id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , subcategory_id CHAR(36) DEFAULT NULL COLLATE BINARY --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D34A04AD5DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product (id, category_id, subcategory_id, name) SELECT id, category_id, subcategory_id, name FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD5E237E06 ON product (name)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD5DC6FE57 ON product (subcategory_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD989D9B62 ON product (slug)');
        $this->addSql('DROP INDEX UNIQ_DDCA4485E237E06');
        $this->addSql('CREATE TEMPORARY TABLE __temp__subcategory AS SELECT id, name FROM subcategory');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('CREATE TABLE subcategory (id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO subcategory (id, name) SELECT id, name FROM __temp__subcategory');
        $this->addSql('DROP TABLE __temp__subcategory');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDCA4485E237E06 ON subcategory (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDCA448989D9B62 ON subcategory (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_64C19C15E237E06');
        $this->addSql('DROP INDEX UNIQ_64C19C1989D9B62');
        $this->addSql('CREATE TEMPORARY TABLE __temp__category AS SELECT id, name FROM category');
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TABLE category (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO category (id, name) SELECT id, name FROM __temp__category');
        $this->addSql('DROP TABLE __temp__category');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C15E237E06 ON category (name)');
        $this->addSql('DROP INDEX UNIQ_D34A04AD5E237E06');
        $this->addSql('DROP INDEX UNIQ_D34A04AD989D9B62');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2');
        $this->addSql('DROP INDEX IDX_D34A04AD5DC6FE57');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, category_id, subcategory_id, name FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , category_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , subcategory_id CHAR(36) DEFAULT NULL --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO product (id, category_id, subcategory_id, name) SELECT id, category_id, subcategory_id, name FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD5E237E06 ON product (name)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD5DC6FE57 ON product (subcategory_id)');
        $this->addSql('DROP INDEX UNIQ_DDCA4485E237E06');
        $this->addSql('DROP INDEX UNIQ_DDCA448989D9B62');
        $this->addSql('CREATE TEMPORARY TABLE __temp__subcategory AS SELECT id, name FROM subcategory');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('CREATE TABLE subcategory (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO subcategory (id, name) SELECT id, name FROM __temp__subcategory');
        $this->addSql('DROP TABLE __temp__subcategory');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDCA4485E237E06 ON subcategory (name)');
    }
}
