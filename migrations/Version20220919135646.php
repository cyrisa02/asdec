<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919135646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timecard1 DROP FOREIGN KEY FK_6C88017754BBBFB7');
        $this->addSql('DROP TABLE timecard1');
        $this->addSql('ALTER TABLE presence DROP timecards1_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE timecard1 (id INT AUTO_INCREMENT NOT NULL, sports_id INT NOT NULL, responsable VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6C88017754BBBFB7 (sports_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE timecard1 ADD CONSTRAINT FK_6C88017754BBBFB7 FOREIGN KEY (sports_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE presence ADD timecards1_id INT NOT NULL');
    }
}
