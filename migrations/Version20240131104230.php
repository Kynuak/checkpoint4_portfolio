<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131104230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hard_skill (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, image VARCHAR(150) NOT NULL, INDEX IDX_9EE9EE4612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_hard_skill (project_id INT NOT NULL, hard_skill_id INT NOT NULL, INDEX IDX_864F9574166D1F9C (project_id), INDEX IDX_864F9574B7DB062 (hard_skill_id), PRIMARY KEY(project_id, hard_skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hard_skill ADD CONSTRAINT FK_9EE9EE4612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE project_hard_skill ADD CONSTRAINT FK_864F9574166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_hard_skill ADD CONSTRAINT FK_864F9574B7DB062 FOREIGN KEY (hard_skill_id) REFERENCES hard_skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_hark_skill DROP FOREIGN KEY FK_7007E59D166D1F9C');
        $this->addSql('ALTER TABLE project_hark_skill DROP FOREIGN KEY FK_7007E59DFA76EBEF');
        $this->addSql('ALTER TABLE hark_skill DROP FOREIGN KEY FK_68A19EAF12469DE2');
        $this->addSql('DROP TABLE project_hark_skill');
        $this->addSql('DROP TABLE hark_skill');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_hark_skill (project_id INT NOT NULL, hark_skill_id INT NOT NULL, INDEX IDX_7007E59D166D1F9C (project_id), INDEX IDX_7007E59DFA76EBEF (hark_skill_id), PRIMARY KEY(project_id, hark_skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE hark_skill (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_68A19EAF12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE project_hark_skill ADD CONSTRAINT FK_7007E59D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_hark_skill ADD CONSTRAINT FK_7007E59DFA76EBEF FOREIGN KEY (hark_skill_id) REFERENCES hark_skill (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hark_skill ADD CONSTRAINT FK_68A19EAF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE hard_skill DROP FOREIGN KEY FK_9EE9EE4612469DE2');
        $this->addSql('ALTER TABLE project_hard_skill DROP FOREIGN KEY FK_864F9574166D1F9C');
        $this->addSql('ALTER TABLE project_hard_skill DROP FOREIGN KEY FK_864F9574B7DB062');
        $this->addSql('DROP TABLE hard_skill');
        $this->addSql('DROP TABLE project_hard_skill');
    }
}
