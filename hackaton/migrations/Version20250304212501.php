<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304212501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chantier DROP FOREIGN KEY FK_636F27F679DBCD08');
        $this->addSql('DROP INDEX IDX_636F27F679DBCD08 ON chantier');
        $this->addSql('ALTER TABLE chantier DROP user_chantier_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64979DBCD08');
        $this->addSql('DROP INDEX IDX_8D93D64979DBCD08 ON user');
        $this->addSql('ALTER TABLE user DROP user_chantier_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chantier ADD user_chantier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chantier ADD CONSTRAINT FK_636F27F679DBCD08 FOREIGN KEY (user_chantier_id) REFERENCES user_chantier (id)');
        $this->addSql('CREATE INDEX IDX_636F27F679DBCD08 ON chantier (user_chantier_id)');
        $this->addSql('ALTER TABLE user ADD user_chantier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64979DBCD08 FOREIGN KEY (user_chantier_id) REFERENCES user_chantier (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64979DBCD08 ON user (user_chantier_id)');
    }
}
