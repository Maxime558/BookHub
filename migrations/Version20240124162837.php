<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124162837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livres ADD emprunte_par_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4B80C2C31 FOREIGN KEY (emprunte_par_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_927187A4B80C2C31 ON livres (emprunte_par_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4B80C2C31');
        $this->addSql('DROP INDEX IDX_927187A4B80C2C31 ON livres');
        $this->addSql('ALTER TABLE livres DROP emprunte_par_id');
    }
}
