<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926094022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5FC9A116C');
        $this->addSql('DROP INDEX IDX_6977C7A5FC9A116C ON presence');
        $this->addSql('ALTER TABLE presence DROP timecards_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence ADD timecards_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5FC9A116C FOREIGN KEY (timecards_id) REFERENCES timecard (id)');
        $this->addSql('CREATE INDEX IDX_6977C7A5FC9A116C ON presence (timecards_id)');
    }
}
