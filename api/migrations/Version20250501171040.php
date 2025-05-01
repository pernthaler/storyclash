<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250501171040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reply ADD note_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E026ED0855 FOREIGN KEY (note_id) REFERENCES note (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FDA8C6E026ED0855 ON reply (note_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reply DROP CONSTRAINT FK_FDA8C6E026ED0855
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_FDA8C6E026ED0855
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reply DROP note_id
        SQL);
    }
}
