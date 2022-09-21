<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220921134029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sport_user (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, sports_id INT NOT NULL, INDEX IDX_FA4CF8B567B3B43D (users_id), INDEX IDX_FA4CF8B554BBBFB7 (sports_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sport_user ADD CONSTRAINT FK_FA4CF8B567B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sport_user ADD CONSTRAINT FK_FA4CF8B554BBBFB7 FOREIGN KEY (sports_id) REFERENCES sport (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport_user DROP FOREIGN KEY FK_FA4CF8B567B3B43D');
        $this->addSql('ALTER TABLE sport_user DROP FOREIGN KEY FK_FA4CF8B554BBBFB7');
        $this->addSql('DROP TABLE sport_user');
    }
}
