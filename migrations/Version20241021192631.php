<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241021192631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE food (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quantity DOUBLE PRECISION DEFAULT NULL, label VARCHAR(255) NOT NULL, weight VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE food_category (food_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(food_id, category_id), CONSTRAINT FK_2E013E83BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2E013E8312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2E013E83BA8E87C4 ON food_category (food_id)');
        $this->addSql('CREATE INDEX IDX_2E013E8312469DE2 ON food_category (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE food_category');
    }
}
