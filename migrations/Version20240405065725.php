<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240405065725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assigner (id INT AUTO_INCREMENT NOT NULL, typeproduit_id INT DEFAULT NULL, INDEX IDX_FF4E79CBF66E9EF6 (typeproduit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typeproduit (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assigner ADD CONSTRAINT FK_FF4E79CBF66E9EF6 FOREIGN KEY (typeproduit_id) REFERENCES typeproduit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assigner DROP FOREIGN KEY FK_FF4E79CBF66E9EF6');
        $this->addSql('DROP TABLE assigner');
        $this->addSql('DROP TABLE typeproduit');
    }
}
