<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217110708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE dept_emp');
        $this->addSql('DROP TABLE dept_manager');
        $this->addSql('DROP TABLE dept_title');
        $this->addSql('DROP TABLE emp_title');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE salaries');
        $this->addSql('DROP TABLE titles');
        $this->addSql('ALTER TABLE departments CHANGE dept_no dept_no VARCHAR(4) NOT NULL, CHANGE address adress VARCHAR(255) NOT NULL, ADD PRIMARY KEY (dept_no)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dept_emp (emp_no INT NOT NULL, dept_no CHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, from_date DATE NOT NULL, to_date DATE NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE dept_manager (emp_no INT NOT NULL, dept_no CHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, from_date DATE NOT NULL, to_date DATE NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE dept_title (dept_no CHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, title_no INT NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE emp_title (emp_no INT NOT NULL, title_no INT NOT NULL, from_date DATE NOT NULL, to_date DATE DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE employees (emp_no INT NOT NULL, birth_date DATE NOT NULL, first_name VARCHAR(14) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, last_name VARCHAR(16) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, gender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, photo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, hire_date DATE NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE salaries (emp_no INT NOT NULL, salary INT NOT NULL, from_date DATE NOT NULL, to_date DATE NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE titles (title_no INT NOT NULL, title VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP INDEX `primary` ON departments');
        $this->addSql('ALTER TABLE departments CHANGE dept_no dept_no CHAR(4) NOT NULL, CHANGE adress address VARCHAR(255) NOT NULL');
    }
}
