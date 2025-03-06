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
            (1, 1, 'm.harre@ecole-ipssi.net', '[\"ROLE_ADMIN\"]', 'azerty', 'Morgane', 'HARRE', 651934544),
            (2, 2, 'r8f8el.77400@gmail.com', '[\"ROLE_USER\"]', 'azerty', 'Rafael', 'Salgado', 786214430);");
    }

}
