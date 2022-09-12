<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220912081058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child ADD sports_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B3542954BBBFB7 FOREIGN KEY (sports_id) REFERENCES childsport (id)');
        $this->addSql('CREATE INDEX IDX_22B3542954BBBFB7 ON child (sports_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B3542954BBBFB7');
        $this->addSql('DROP INDEX IDX_22B3542954BBBFB7 ON child');
        $this->addSql('ALTER TABLE child DROP sports_id');
    }
}
