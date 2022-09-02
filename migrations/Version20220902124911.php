<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220902124911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `condition` (id INT AUTO_INCREMENT NOT NULL, is_present TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child ADD present_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B354298D7B1EF8 FOREIGN KEY (present_id) REFERENCES `condition` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_22B354298D7B1EF8 ON child (present_id)');
        $this->addSql('ALTER TABLE user ADD present_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498D7B1EF8 FOREIGN KEY (present_id) REFERENCES `condition` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6498D7B1EF8 ON user (present_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B354298D7B1EF8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498D7B1EF8');
        $this->addSql('DROP TABLE `condition`');
        $this->addSql('DROP INDEX UNIQ_22B354298D7B1EF8 ON child');
        $this->addSql('ALTER TABLE child DROP present_id');
        $this->addSql('DROP INDEX UNIQ_8D93D6498D7B1EF8 ON user');
        $this->addSql('ALTER TABLE user DROP present_id');
    }
}
