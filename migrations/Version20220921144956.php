<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220921144956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_sport (user_id INT NOT NULL, sport_id INT NOT NULL, INDEX IDX_F847148AA76ED395 (user_id), INDEX IDX_F847148AAC78BCF8 (sport_id), PRIMARY KEY(user_id, sport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_sport ADD CONSTRAINT FK_F847148AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_sport ADD CONSTRAINT FK_F847148AAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sport_user DROP FOREIGN KEY FK_FA4CF8B567B3B43D');
        $this->addSql('ALTER TABLE sport_user DROP FOREIGN KEY FK_FA4CF8B554BBBFB7');
        $this->addSql('DROP TABLE sport_user');
        $this->addSql('DROP INDEX UNIQ_22B35429506DDF78 ON child');
        $this->addSql('DROP INDEX UNIQ_8D93D649506DDF78 ON user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sport_user (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, sports_id INT NOT NULL, INDEX IDX_FA4CF8B567B3B43D (users_id), INDEX IDX_FA4CF8B554BBBFB7 (sports_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sport_user ADD CONSTRAINT FK_FA4CF8B567B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sport_user ADD CONSTRAINT FK_FA4CF8B554BBBFB7 FOREIGN KEY (sports_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE user_sport DROP FOREIGN KEY FK_F847148AA76ED395');
        $this->addSql('ALTER TABLE user_sport DROP FOREIGN KEY FK_F847148AAC78BCF8');
        $this->addSql('DROP TABLE user_sport');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_22B35429506DDF78 ON child (cardnr)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649506DDF78 ON user (cardnr)');
    }
}
