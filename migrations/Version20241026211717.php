<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241026211717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__food AS SELECT id, category_id, label, number, quantity FROM food');
        $this->addSql('DROP TABLE food');
        $this->addSql('CREATE TABLE food (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, quantity INTEGER DEFAULT NULL, CONSTRAINT FK_D43829F712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO food (id, category_id, label, number, quantity) SELECT id, category_id, label, number, quantity FROM __temp__food');
        $this->addSql('DROP TABLE __temp__food');
        $this->addSql('CREATE INDEX IDX_D43829F712469DE2 ON food (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__food AS SELECT id, category_id, label, number, quantity FROM food');
        $this->addSql('DROP TABLE food');
        $this->addSql('CREATE TABLE food (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL, number INTEGER NOT NULL, quantity INTEGER DEFAULT NULL, CONSTRAINT FK_D43829F712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO food (id, category_id, label, number, quantity) SELECT id, category_id, label, number, quantity FROM __temp__food');
        $this->addSql('DROP TABLE __temp__food');
        $this->addSql('CREATE INDEX IDX_D43829F712469DE2 ON food (category_id)');
    }
}
