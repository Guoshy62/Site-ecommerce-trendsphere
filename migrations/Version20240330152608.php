<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240330152608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE associer (id INT AUTO_INCREMENT NOT NULL, prix_id INT NOT NULL, stock_id INT NOT NULL, INDEX IDX_FA230DB9944722F2 (prix_id), INDEX IDX_FA230DB9DCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE associer ADD CONSTRAINT FK_FA230DB9944722F2 FOREIGN KEY (prix_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE associer ADD CONSTRAINT FK_FA230DB9DCD6110 FOREIGN KEY (stock_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE associer DROP FOREIGN KEY FK_FA230DB9944722F2');
        $this->addSql('ALTER TABLE associer DROP FOREIGN KEY FK_FA230DB9DCD6110');
        $this->addSql('DROP TABLE associer');
    }
}
