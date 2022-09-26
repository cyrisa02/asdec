<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926093827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timecard_sport DROP FOREIGN KEY FK_FD5BB4D1EA093255');
        $this->addSql('ALTER TABLE timecard_sport DROP FOREIGN KEY FK_FD5BB4D1AC78BCF8');
        $this->addSql('DROP TABLE timecard_sport');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE timecard_sport (timecard_id INT NOT NULL, sport_id INT NOT NULL, INDEX IDX_FD5BB4D1EA093255 (timecard_id), INDEX IDX_FD5BB4D1AC78BCF8 (sport_id), PRIMARY KEY(timecard_id, sport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE timecard_sport ADD CONSTRAINT FK_FD5BB4D1EA093255 FOREIGN KEY (timecard_id) REFERENCES timecard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timecard_sport ADD CONSTRAINT FK_FD5BB4D1AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
    }
}
