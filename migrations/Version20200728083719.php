<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728083719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kategoria_produktu_produkt DROP FOREIGN KEY FK_664503149F0719F1');
        $this->addSql('CREATE TABLE kategoria (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kategoria_produkt (kategoria_id INT NOT NULL, produkt_id INT NOT NULL, INDEX IDX_FFEC3E95359B0684 (kategoria_id), INDEX IDX_FFEC3E9575F42D9B (produkt_id), PRIMARY KEY(kategoria_id, produkt_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kategoria_produkt ADD CONSTRAINT FK_FFEC3E95359B0684 FOREIGN KEY (kategoria_id) REFERENCES kategoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kategoria_produkt ADD CONSTRAINT FK_FFEC3E9575F42D9B FOREIGN KEY (produkt_id) REFERENCES produkt (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE kategoria_produktu');
        $this->addSql('DROP TABLE kategoria_produktu_produkt');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kategoria_produkt DROP FOREIGN KEY FK_FFEC3E95359B0684');
        $this->addSql('CREATE TABLE kategoria_produktu (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE kategoria_produktu_produkt (kategoria_produktu_id INT NOT NULL, produkt_id INT NOT NULL, INDEX IDX_664503149F0719F1 (kategoria_produktu_id), INDEX IDX_6645031475F42D9B (produkt_id), PRIMARY KEY(kategoria_produktu_id, produkt_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE kategoria_produktu_produkt ADD CONSTRAINT FK_6645031475F42D9B FOREIGN KEY (produkt_id) REFERENCES produkt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kategoria_produktu_produkt ADD CONSTRAINT FK_664503149F0719F1 FOREIGN KEY (kategoria_produktu_id) REFERENCES kategoria_produktu (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE kategoria');
        $this->addSql('DROP TABLE kategoria_produkt');
    }
}
