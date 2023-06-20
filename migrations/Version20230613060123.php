<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613060123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agents DROP FOREIGN KEY FK_9596AB6E17C042CF');
        $this->addSql('DROP INDEX IDX_9596AB6E17C042CF ON agents');
        $this->addSql('ALTER TABLE agents DROP missions_id');
        $this->addSql('ALTER TABLE missions ADD agents_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E709770DC FOREIGN KEY (agents_id) REFERENCES agents (id)');
        $this->addSql('CREATE INDEX IDX_34F1D47E709770DC ON missions (agents_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agents ADD missions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agents ADD CONSTRAINT FK_9596AB6E17C042CF FOREIGN KEY (missions_id) REFERENCES missions (id)');
        $this->addSql('CREATE INDEX IDX_9596AB6E17C042CF ON agents (missions_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E709770DC');
        $this->addSql('DROP INDEX IDX_34F1D47E709770DC ON missions');
        $this->addSql('ALTER TABLE missions DROP agents_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE last_name last_name VARCHAR(255) DEFAULT \'NULL\', CHANGE first_name first_name VARCHAR(255) DEFAULT \'NULL\'');
    }
}
