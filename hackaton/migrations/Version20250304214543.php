<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304214543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_chantier ADD userid_id INT DEFAULT NULL, ADD chantierid_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_chantier ADD CONSTRAINT FK_83E2C3F658E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_chantier ADD CONSTRAINT FK_83E2C3F6888E1854 FOREIGN KEY (chantierid_id) REFERENCES chantier (id)');
        $this->addSql('CREATE INDEX IDX_83E2C3F658E0A285 ON user_chantier (userid_id)');
        $this->addSql('CREATE INDEX IDX_83E2C3F6888E1854 ON user_chantier (chantierid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_chantier DROP FOREIGN KEY FK_83E2C3F658E0A285');
        $this->addSql('ALTER TABLE user_chantier DROP FOREIGN KEY FK_83E2C3F6888E1854');
        $this->addSql('DROP INDEX IDX_83E2C3F658E0A285 ON user_chantier');
        $this->addSql('DROP INDEX IDX_83E2C3F6888E1854 ON user_chantier');
        $this->addSql('ALTER TABLE user_chantier DROP userid_id, DROP chantierid_id');
    }
}
