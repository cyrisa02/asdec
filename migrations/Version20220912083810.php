<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220912083810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE childsport DROP FOREIGN KEY FK_F2913C3B6DC9160B');
        $this->addSql('DROP INDEX IDX_F2913C3B6DC9160B ON childsport');
        $this->addSql('ALTER TABLE childsport DROP childs_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE childsport ADD childs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE childsport ADD CONSTRAINT FK_F2913C3B6DC9160B FOREIGN KEY (childs_id) REFERENCES child (id)');
        $this->addSql('CREATE INDEX IDX_F2913C3B6DC9160B ON childsport (childs_id)');
    }
}
