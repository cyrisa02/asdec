<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919140500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presence1 (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, timecards1_id INT NOT NULL, is_present TINYINT(1) DEFAULT NULL, INDEX IDX_2509CF1767B3B43D (users_id), INDEX IDX_2509CF1792949AF1 (timecards1_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE presence1 ADD CONSTRAINT FK_2509CF1767B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE presence1 ADD CONSTRAINT FK_2509CF1792949AF1 FOREIGN KEY (timecards1_id) REFERENCES timecard1 (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence1 DROP FOREIGN KEY FK_2509CF1767B3B43D');
        $this->addSql('ALTER TABLE presence1 DROP FOREIGN KEY FK_2509CF1792949AF1');
        $this->addSql('DROP TABLE presence1');
    }
}
