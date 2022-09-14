<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220914070902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presence (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, timecards_id INT DEFAULT NULL, is_present TINYINT(1) DEFAULT NULL, INDEX IDX_6977C7A567B3B43D (users_id), INDEX IDX_6977C7A5FC9A116C (timecards_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A567B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5FC9A116C FOREIGN KEY (timecards_id) REFERENCES timecard (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A567B3B43D');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5FC9A116C');
        $this->addSql('DROP TABLE presence');
    }
}
