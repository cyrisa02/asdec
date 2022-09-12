<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220912083925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child_childsport (child_id INT NOT NULL, childsport_id INT NOT NULL, INDEX IDX_164EC250DD62C21B (child_id), INDEX IDX_164EC250BA84159E (childsport_id), PRIMARY KEY(child_id, childsport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child_childsport ADD CONSTRAINT FK_164EC250DD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child_childsport ADD CONSTRAINT FK_164EC250BA84159E FOREIGN KEY (childsport_id) REFERENCES childsport (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child_childsport DROP FOREIGN KEY FK_164EC250DD62C21B');
        $this->addSql('ALTER TABLE child_childsport DROP FOREIGN KEY FK_164EC250BA84159E');
        $this->addSql('DROP TABLE child_childsport');
    }
}
