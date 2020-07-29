<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728083838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kategoria (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kategoria_produkt (kategoria_id INT NOT NULL, produkt_id INT NOT NULL, INDEX IDX_FFEC3E95359B0684 (kategoria_id), INDEX IDX_FFEC3E9575F42D9B (produkt_id), PRIMARY KEY(kategoria_id, produkt_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produkt (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kategoria_produkt ADD CONSTRAINT FK_FFEC3E95359B0684 FOREIGN KEY (kategoria_id) REFERENCES kategoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kategoria_produkt ADD CONSTRAINT FK_FFEC3E9575F42D9B FOREIGN KEY (produkt_id) REFERENCES produkt (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kategoria_produkt DROP FOREIGN KEY FK_FFEC3E95359B0684');
        $this->addSql('ALTER TABLE kategoria_produkt DROP FOREIGN KEY FK_FFEC3E9575F42D9B');
        $this->addSql('DROP TABLE kategoria');
        $this->addSql('DROP TABLE kategoria_produkt');
        $this->addSql('DROP TABLE produkt');
    }
}
