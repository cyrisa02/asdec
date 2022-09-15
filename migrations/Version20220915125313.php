<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220915125313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child ADD cardnr INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_22B35429506DDF78 ON child (cardnr)');
        $this->addSql('ALTER TABLE user ADD cardnr INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649506DDF78 ON user (cardnr)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_22B35429506DDF78 ON child');
        $this->addSql('ALTER TABLE child DROP cardnr');
        $this->addSql('DROP INDEX UNIQ_8D93D649506DDF78 ON user');
        $this->addSql('ALTER TABLE user DROP cardnr');
    }
}
