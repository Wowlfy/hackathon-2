<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210630072847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE help_request_user (help_request_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_55BD3366A8AB70A7 (help_request_id), INDEX IDX_55BD3366A76ED395 (user_id), PRIMARY KEY(help_request_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE help_request_user ADD CONSTRAINT FK_55BD3366A8AB70A7 FOREIGN KEY (help_request_id) REFERENCES help_request (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE help_request_user ADD CONSTRAINT FK_55BD3366A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE help_request_user');
    }
}