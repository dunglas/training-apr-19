<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210422092542 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, author_id, title, summary FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, summary CLOB DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO book (id, author_id, title, summary) SELECT id, author_id, title, summary FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, poster, country, released, price FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, poster VARCHAR(255) DEFAULT NULL COLLATE BINARY, country VARCHAR(2) DEFAULT NULL COLLATE BINARY, released DATE DEFAULT NULL, price NUMERIC(10, 0) DEFAULT NULL, CONSTRAINT FK_1D5EF26FF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO movie (id, title, poster, country, released, price) SELECT id, title, poster, country, released, price FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE INDEX IDX_1D5EF26FF675F31B ON movie (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, author_id, title, summary FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, summary CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO book (id, author_id, title, summary) SELECT id, author_id, title, summary FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
        $this->addSql('DROP INDEX IDX_1D5EF26FF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, poster, country, released, price FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, poster VARCHAR(255) DEFAULT NULL, country VARCHAR(2) DEFAULT NULL, released DATE DEFAULT NULL, price NUMERIC(10, 0) DEFAULT NULL)');
        $this->addSql('INSERT INTO movie (id, title, poster, country, released, price) SELECT id, title, poster, country, released, price FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
    }
}
