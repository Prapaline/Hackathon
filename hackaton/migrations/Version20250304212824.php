<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304212824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chantier_user_chantier (chantier_id INT NOT NULL, user_chantier_id INT NOT NULL, INDEX IDX_E091DA24D0C0049D (chantier_id), INDEX IDX_E091DA2479DBCD08 (user_chantier_id), PRIMARY KEY(chantier_id, user_chantier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chantier_user_chantier ADD CONSTRAINT FK_E091DA24D0C0049D FOREIGN KEY (chantier_id) REFERENCES chantier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chantier_user_chantier ADD CONSTRAINT FK_E091DA2479DBCD08 FOREIGN KEY (user_chantier_id) REFERENCES user_chantier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chantier DROP location, DROP description, DROP status, DROP start_date, DROP end_date');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chantier_user_chantier DROP FOREIGN KEY FK_E091DA24D0C0049D');
        $this->addSql('ALTER TABLE chantier_user_chantier DROP FOREIGN KEY FK_E091DA2479DBCD08');
        $this->addSql('DROP TABLE chantier_user_chantier');
        $this->addSql('ALTER TABLE chantier ADD location VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD status VARCHAR(255) NOT NULL, ADD start_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD end_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
