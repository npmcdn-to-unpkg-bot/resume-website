# DinoMastrianni.com - Database Schema & Rows
# This is the SQL I used to create the mysql database for my resume website. I could do a lot of this in phpMyAdmin to save time, but I wanted to include raw SQL.

# CREATE DB
CREATE DATABASE IF NOT EXISTS `admin_resume`;

# CREATE TABLE
CREATE TABLE IF NOT EXISTS `skills_table` (
  `id` smallint(5) unsigned NOT NULL,
  `skill_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill_svg_url` varchar(2083) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill_level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'novice'
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

# SET PRIMARY & UNIQUE KEYS
ALTER TABLE `skills_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

# For the column `skill_level`, there are 3 levels: novice, intermediate, and advanced.
# These will be used on the front end for filtering, and will be ordered/displayed randomly when they are queried.

INSERT INTO `skills_table` (`id`, `skill_title`, `skill_svg_url`, `skill_level`) VALUES 
(1, 'Ajax', 'ajax.svg', 'intermediate'),
(2, 'Angular', 'angular.svg', 'novice'),
(3, 'Apache', 'apache.svg', 'intermediate'),
(4, 'Bootstrap', 'bootstrap.svg', 'advanced'),
(5, 'Bower', 'bower.svg', 'novice'),
(6, 'Cpanel', 'cpanel.svg', 'advanced'),
(7, 'CSS3', 'css3.svg', 'advanced'),
(8, 'Drupal', 'drupal.svg', 'novice'),
(9, 'Foundation', 'foundation.svg', 'advanced'),
(10, 'Git', 'git.svg', 'novice'),
(11, 'GitHub', 'github.svg', 'novice'),
(12, 'Grunt', 'grunt.svg', 'novice'),
(13, 'Handlebars', 'handlebars.svg', 'novice'),
(14, 'HTML5', 'html5.svg', 'advanced'),
(15, 'Javascript', 'javascript.svg', 'intermediate'),
(16, 'Joomla', 'joomla.svg', 'novice'),
(17, 'jQuery', 'jquery.svg', 'intermediate'),
(18, 'JSON', 'json.svg', 'novice'),
(19, 'Linux', 'linux.svg', 'intermediate'),
(20, 'MySQL', 'mysql.svg', 'intermediate'),
(21, 'NGINX', 'nginx.svg', 'intermediate'),
(22, 'Node.js', 'node.svg', 'novice'),
(23, 'NPM', 'npm.svg', 'novice'),
(24, 'PHP', 'php.svg', 'advanced'),
(25, 'SASS', 'sass.svg', 'intermediate'),
(26, 'WordPress', 'wordpress.svg', 'advanced'),
(27, 'XML', 'xml.svg', 'intermediate'),
(28, 'Photoshop', 'photoshop.svg', 'advanced'),
(29, 'Illustrator', 'illustrator.svg', 'advanced'),
(30, 'InDesign', 'indesign.svg', 'advanced'),
(31, 'Flash', 'flash.svg', 'intermediate'),
(32, 'After Effects', 'after_effects.svg', 'intermediate'),
(33, 'Premiere Pro', 'premiere.svg', 'intermediate'),
(34, 'Lightroom', 'lightroom.svg', 'novice'),
(35, 'Audition', 'audition.svg', 'intermediate'),
(36, 'MS Word', 'word.svg', 'advanced'),
(37, 'MS Excel', 'excel.svg', 'advanced'),
(38, 'MS Powerpoint', 'powerpoint.svg', 'advanced'),
(39, 'MS Outlook', 'outlook.svg', 'advanced'),
(40, 'Advanced Custom Fields', 'advanced_custom_fields.svg', 'advanced'),
(41, 'PhpMyAdmin', 'phpmyadmin.svg', 'advanced'),
(42, 'Photography', 'photography.svg', 'intermediate'),
(43, 'Yoast SEO', 'yoast_seo.svg', 'intermediate');