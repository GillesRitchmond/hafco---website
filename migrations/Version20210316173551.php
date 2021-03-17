<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316173551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD updated_at DATETIME CONVERT(updated_at,getdate(),101) NOT NULL');
        // $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA21214B7 FOREIGN KEY (categories_id) REFERENCES category (id)');
        // $this->addSql('CREATE INDEX IDX_D34A04ADA21214B7 ON product (categories_id)');
        // $this->addSql('ALTER TABLE sub_category CHANGE category_id category_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        // $this->addSql('CREATE INDEX IDX_BCE3F79812469DE2 ON sub_category (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA21214B7');
        // $this->addSql('DROP INDEX IDX_D34A04ADA21214B7 ON product');
        // $this->addSql('ALTER TABLE product DROP updated_at');
        // $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F79812469DE2');
        // $this->addSql('DROP INDEX IDX_BCE3F79812469DE2 ON sub_category');
        // $this->addSql('ALTER TABLE sub_category CHANGE category_id category_id INT NOT NULL');
    }
}
