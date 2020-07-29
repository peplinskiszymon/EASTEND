<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728080310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kategoria_produktu (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kategoria_produktu_produkt (kategoria_produktu_id INT NOT NULL, produkt_id INT NOT NULL, INDEX IDX_664503149F0719F1 (kategoria_produktu_id), INDEX IDX_6645031475F42D9B (produkt_id), PRIMARY KEY(kategoria_produktu_id, produkt_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produkt (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kategoria_produktu_produkt ADD CONSTRAINT FK_664503149F0719F1 FOREIGN KEY (kategoria_produktu_id) REFERENCES kategoria_produktu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kategoria_produktu_produkt ADD CONSTRAINT FK_6645031475F42D9B FOREIGN KEY (produkt_id) REFERENCES produkt (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kategoria_produktu_produkt DROP FOREIGN KEY FK_664503149F0719F1');
        $this->addSql('ALTER TABLE kategoria_produktu_produkt DROP FOREIGN KEY FK_6645031475F42D9B');
        $this->addSql('DROP TABLE kategoria_produktu');
        $this->addSql('DROP TABLE kategoria_produktu_produkt');
        $this->addSql('DROP TABLE produkt');
    }
}
