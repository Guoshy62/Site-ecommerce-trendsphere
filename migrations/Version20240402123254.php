<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240402123254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE associer DROP FOREIGN KEY FK_FA230DB9944722F2');
        $this->addSql('ALTER TABLE associer DROP FOREIGN KEY FK_FA230DB9DCD6110');
        $this->addSql('ALTER TABLE taille DROP FOREIGN KEY FK_76508B3825DD318D');
        $this->addSql('DROP TABLE associer');
        $this->addSql('DROP TABLE taille');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C54C8C93');
        $this->addSql('DROP INDEX IDX_29A5EC27C54C8C93 ON produit');
        $this->addSql('ALTER TABLE produit DROP type_id');
        $this->addSql('ALTER TABLE typeproduit DROP FOREIGN KEY FK_F341609C25DD318D');
        $this->addSql('DROP INDEX IDX_F341609C25DD318D ON typeproduit');
        $this->addSql('ALTER TABLE typeproduit ADD libelle VARCHAR(50) NOT NULL, DROP libelle_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE associer (id INT AUTO_INCREMENT NOT NULL, prix_id INT NOT NULL, stock_id INT NOT NULL, INDEX IDX_FA230DB9DCD6110 (stock_id), INDEX IDX_FA230DB9944722F2 (prix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, libelle_id INT NOT NULL, INDEX IDX_76508B3825DD318D (libelle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE associer ADD CONSTRAINT FK_FA230DB9944722F2 FOREIGN KEY (prix_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE associer ADD CONSTRAINT FK_FA230DB9DCD6110 FOREIGN KEY (stock_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE taille ADD CONSTRAINT FK_76508B3825DD318D FOREIGN KEY (libelle_id) REFERENCES associer (id)');
        $this->addSql('ALTER TABLE typeproduit ADD libelle_id INT NOT NULL, DROP libelle');
        $this->addSql('ALTER TABLE typeproduit ADD CONSTRAINT FK_F341609C25DD318D FOREIGN KEY (libelle_id) REFERENCES assigner (id)');
        $this->addSql('CREATE INDEX IDX_F341609C25DD318D ON typeproduit (libelle_id)');
        $this->addSql('ALTER TABLE produit ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C54C8C93 FOREIGN KEY (type_id) REFERENCES assigner (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27C54C8C93 ON produit (type_id)');
    }
}
