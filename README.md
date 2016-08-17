# Ailurophiliac
A copy of the source for ailurophiliac.com

## Using this Site

### Prerequisites
The site requires the following installed with composer:
* swiftmailer

And the following on the server:
* PHP
* MySQL or MariaDB

### Installation
The following SQL code will initialize the database the blog uses:
```sql
CREATE DATABASE IF NOT EXISTS cathony_blog DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE cathony_blog;

CREATE TABLE blog_members (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE blog_posts (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE blog_posts_tags (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE blog_tags (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tag_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE blog_members
  ADD PRIMARY KEY (`id`);

ALTER TABLE blog_posts
  ADD PRIMARY KEY (`id`);

ALTER TABLE blog_posts_tags
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_id` (`post_id`,`tag_id`);

ALTER TABLE blog_tags
  ADD PRIMARY KEY (`id`);

ALTER TABLE blog_members
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE blog_posts
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE blog_posts_tags
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE blog_tags
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
```

After the database is initialized, a user must be added to blog_members, with a
hashed password. Storing the password as plain text will cause it to not work.

In order for the site to be able to use the database, you must created a file
called dbinfo.json in the /include/php folder. This file must be structured as
follows, containing the login information for your MySQL installation.
```json
{
    "username" : "your username here",
    "password" : "your password here"
}
```

### Use
Once the site is on a server and properly set up, the blog can be used by
going to /admin and logging in with the user created during setup. Then new
posts can be added using the link on the top, and existing ones can be edited
or deleted from the admin home page.

As of right now, new tags have to be manually added to the table blog_tags, but
this will be changed in a future update.

## Acknowledgements
* daveismyname - The blog functionality is based on his code
* twbs - The layout makes use of Bootstrap 3
