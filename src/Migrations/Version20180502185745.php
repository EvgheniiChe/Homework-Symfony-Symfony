<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180502185745 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE affiliates_categories (category_id INT NOT NULL, affiliate_id INT NOT NULL, INDEX IDX_87BE218012469DE2 (category_id), INDEX IDX_87BE21809F12C49A (affiliate_id), PRIMARY KEY(category_id, affiliate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affiliates_categories ADD CONSTRAINT FK_87BE218012469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affiliates_categories ADD CONSTRAINT FK_87BE21809F12C49A FOREIGN KEY (affiliate_id) REFERENCES affiliates (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jobs ADD category_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT FK_A8936DC59777D11E FOREIGN KEY (category_id_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_A8936DC59777D11E ON jobs (category_id_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE affiliates_categories');
        $this->addSql('ALTER TABLE jobs DROP FOREIGN KEY FK_A8936DC59777D11E');
        $this->addSql('DROP INDEX IDX_A8936DC59777D11E ON jobs');
        $this->addSql('ALTER TABLE jobs DROP category_id_id');
    }
}
