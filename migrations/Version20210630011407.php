<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210630011407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE help_request (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, content LONGTEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_658D7043F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE help_request_user (help_request_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_55BD3366A8AB70A7 (help_request_id), INDEX IDX_55BD3366A76ED395 (user_id), PRIMARY KEY(help_request_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, email VARCHAR(255) NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE help_request ADD CONSTRAINT FK_658D7043F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE help_request_user ADD CONSTRAINT FK_55BD3366A8AB70A7 FOREIGN KEY (help_request_id) REFERENCES help_request (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE help_request_user ADD CONSTRAINT FK_55BD3366A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE help_request_user DROP FOREIGN KEY FK_55BD3366A8AB70A7');
        $this->addSql('ALTER TABLE help_request DROP FOREIGN KEY FK_658D7043F675F31B');
        $this->addSql('ALTER TABLE help_request_user DROP FOREIGN KEY FK_55BD3366A76ED395');
        $this->addSql('DROP TABLE help_request');
        $this->addSql('DROP TABLE help_request_user');
        $this->addSql('DROP TABLE user');
    }
}
