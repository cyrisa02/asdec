<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919093306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE timecard_sport (timecard_id INT NOT NULL, sport_id INT NOT NULL, INDEX IDX_FD5BB4D1EA093255 (timecard_id), INDEX IDX_FD5BB4D1AC78BCF8 (sport_id), PRIMARY KEY(timecard_id, sport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE timecard_sport ADD CONSTRAINT FK_FD5BB4D1EA093255 FOREIGN KEY (timecard_id) REFERENCES timecard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timecard_sport ADD CONSTRAINT FK_FD5BB4D1AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presence_timecard DROP FOREIGN KEY FK_775A9699EA093255');
        $this->addSql('ALTER TABLE presence_timecard DROP FOREIGN KEY FK_775A9699F328FFC4');
        $this->addSql('DROP TABLE presence_timecard');
        $this->addSql('DROP INDEX UNIQ_22B35429506DDF78 ON child');
        $this->addSql('ALTER TABLE child DROP cardnr');
        $this->addSql('ALTER TABLE presence ADD timecards_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5FC9A116C FOREIGN KEY (timecards_id) REFERENCES timecard (id)');
        $this->addSql('CREATE INDEX IDX_6977C7A5FC9A116C ON presence (timecards_id)');
        $this->addSql('ALTER TABLE timecard DROP sports_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649506DDF78 ON user');
        $this->addSql('ALTER TABLE user DROP cardnr');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presence_timecard (presence_id INT NOT NULL, timecard_id INT NOT NULL, INDEX IDX_775A9699F328FFC4 (presence_id), INDEX IDX_775A9699EA093255 (timecard_id), PRIMARY KEY(presence_id, timecard_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE presence_timecard ADD CONSTRAINT FK_775A9699EA093255 FOREIGN KEY (timecard_id) REFERENCES timecard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presence_timecard ADD CONSTRAINT FK_775A9699F328FFC4 FOREIGN KEY (presence_id) REFERENCES presence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timecard_sport DROP FOREIGN KEY FK_FD5BB4D1EA093255');
        $this->addSql('ALTER TABLE timecard_sport DROP FOREIGN KEY FK_FD5BB4D1AC78BCF8');
        $this->addSql('DROP TABLE timecard_sport');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5FC9A116C');
        $this->addSql('DROP INDEX IDX_6977C7A5FC9A116C ON presence');
        $this->addSql('ALTER TABLE presence DROP timecards_id');
        $this->addSql('ALTER TABLE child ADD cardnr INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_22B35429506DDF78 ON child (cardnr)');
        $this->addSql('ALTER TABLE timecard ADD sports_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD cardnr INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649506DDF78 ON user (cardnr)');
    }
}
