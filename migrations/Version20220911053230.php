<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220911053230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE droit ADD user_id INT DEFAULT NULL, ADD reference VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE droit ADD CONSTRAINT FK_CB7AA751A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CB7AA751A76ED395 ON droit (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE droit DROP FOREIGN KEY FK_CB7AA751A76ED395');
        $this->addSql('DROP INDEX IDX_CB7AA751A76ED395 ON droit');
        $this->addSql('ALTER TABLE droit DROP user_id, DROP reference');
    }
}
