<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919135316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence ADD timecards1_id INT NOT NULL');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A592949AF1 FOREIGN KEY (timecards1_id) REFERENCES timecard1 (id)');
        $this->addSql('CREATE INDEX IDX_6977C7A592949AF1 ON presence (timecards1_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A592949AF1');
        $this->addSql('DROP INDEX IDX_6977C7A592949AF1 ON presence');
        $this->addSql('ALTER TABLE presence DROP timecards1_id');
    }
}
