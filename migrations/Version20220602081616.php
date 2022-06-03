<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602081616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP INDEX UNIQ_BFDD3168A76ED395, ADD INDEX IDX_BFDD3168A76ED395 (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491EBAF6CC');
        $this->addSql('DROP INDEX UNIQ_8D93D6491EBAF6CC ON user');
        $this->addSql('ALTER TABLE user DROP articles_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP INDEX IDX_BFDD3168A76ED395, ADD UNIQUE INDEX UNIQ_BFDD3168A76ED395 (user_id)');
        $this->addSql('ALTER TABLE user ADD articles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6491EBAF6CC ON user (articles_id)');
    }
}
