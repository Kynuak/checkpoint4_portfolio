<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131095403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_hark_skill (project_id INT NOT NULL, hark_skill_id INT NOT NULL, INDEX IDX_7007E59D166D1F9C (project_id), INDEX IDX_7007E59DFA76EBEF (hark_skill_id), PRIMARY KEY(project_id, hark_skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_hark_skill ADD CONSTRAINT FK_7007E59D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_hark_skill ADD CONSTRAINT FK_7007E59DFA76EBEF FOREIGN KEY (hark_skill_id) REFERENCES hark_skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hark_skill ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hark_skill ADD CONSTRAINT FK_68A19EAF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_68A19EAF12469DE2 ON hark_skill (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_hark_skill DROP FOREIGN KEY FK_7007E59D166D1F9C');
        $this->addSql('ALTER TABLE project_hark_skill DROP FOREIGN KEY FK_7007E59DFA76EBEF');
        $this->addSql('DROP TABLE project_hark_skill');
        $this->addSql('ALTER TABLE hark_skill DROP FOREIGN KEY FK_68A19EAF12469DE2');
        $this->addSql('DROP INDEX IDX_68A19EAF12469DE2 ON hark_skill');
        $this->addSql('ALTER TABLE hark_skill DROP category_id');
    }
}
