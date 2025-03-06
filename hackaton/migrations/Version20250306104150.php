<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250306104150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

// src/Migrations/VersionXXXXXX.php

    public function up(Schema $schema): void
    {
        // Ajoutez ici votre code SQL
        $this->addSql("INSERT INTO `skill` (`id`, `name`) VALUES
            (1, 'Plombier'),
            (2, 'Inspecteur de travaux');");

        $this->addSql("INSERT INTO `user` (`id`, `skillid_id`, `email`, `roles`, `password`, `first_name`, `last_name`, `phone`) VALUES
            (1, 1, 'm.harre@ecole-ipssi.net', '[\"ROLE_ADMIN\"]', '$2y$13$jWZvXcjfyORzeSKy0fGkq.xTRiU20GWBzghttCutv8DGcx7kHn2nC', 'Morgane', 'HARRE', 651934544),
            (2, 2, 'r8f8el.77400@gmail.com', '[\"ROLE_USER\"]', 'azerty', 'Rafael', 'Salgado', 786214430);");
    }

    public function down(Schema $schema): void
    {
        // Pour annuler la migration (si nécessaire), vous pouvez supprimer les données insérées
        $this->addSql("DELETE FROM `user` WHERE `id` IN (1, 2);");
        $this->addSql("DELETE FROM `skill` WHERE `id` IN (1, 2);");
    }

}
