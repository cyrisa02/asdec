<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919092817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence_timecard DROP FOREIGN KEY FK_775A9699EA093255');
        $this->addSql('ALTER TABLE presence_timecard DROP FOREIGN KEY FK_775A9699F328FFC4');
        $this->addSql('DROP TABLE presence_timecard');
        $this->addSql('ALTER TABLE timecard DROP sports_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presence_timecard (presence_id INT NOT NULL, timecard_id INT NOT NULL, INDEX IDX_775A9699F328FFC4 (presence_id), INDEX IDX_775A9699EA093255 (timecard_id), PRIMARY KEY(presence_id, timecard_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE presence_timecard ADD CONSTRAINT FK_775A9699EA093255 FOREIGN KEY (timecard_id) REFERENCES timecard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presence_timecard ADD CONSTRAINT FK_775A9699F328FFC4 FOREIGN KEY (presence_id) REFERENCES presence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timecard ADD sports_id INT NOT NULL');
    }
}
