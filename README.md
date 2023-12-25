# Sam CMS

[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)

Sam CMS is a website content management suite built with Laravel 7.x. Its built by:

  - Laravel Framework v7.x
  - Theme Limitless v2.x Copyright
  - Package Passport
  - Package Socialite
  - Package Permission
  - Package Datatable Oracle
  - Package Laravel Debugbar
  - Package Laravel Translatable
  - Package Laravel Soft Cascade
  - Package Laravel Log Viewer
  - Package Laravel Google Translate

# New Features!
  - Calendar Event
  - Backup DB & Source Code in Admin
  - Mangage Page And Content All Website
  - Mangage User
  - Manauge Permission
  - Manage News 
  - Mangage Product
  - Mangage Cart
  - Scan QRCode - Barcode
  - Search Engine Optimization
  - Email Marketing with MailChip API
  - Check Content SEO
  - Export To Excel,CSV
  - Multi Languages

### Tech

Dillinger uses a number of open source projects to work properly:

* [Laravel] - PHP Framework!
* [CKEditor] - awesome web-based text editor
* [CKFinder] - awesome web-based file manage
* [Twitter Bootstrap] - great UI boilerplate for modern web apps
* [node.js] - evented I/O for the backend
* [Gulp] - the streaming build system
* [jQuery] - duh

And of course Sam CMS itself is open source with a private repository on GitLab.

### Installation
Laravel 7.x requires [PHP](https://www.php.net/) v7.3+ to run.You will need to make sure your server meets the following requirements:
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

Request to install [Composer](https://getcomposer.org/) to handle with commands

If you need new version laravel.You can update laravel with command
```sh
composer update laravel/framework
```

Create Login Socialite With Google
```sh
$ https://medium.com/employbl/add-login-with-google-to-your-laravel-app-d2205f01b895
```

Install Local
```sh
$ composer install
$ php artisan ckfinder:download
$ php artisan vietnamzone:download
$ cp .env.testing .env
$ php artisan key:generate
```

Declare database and email configuration information
```sh
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=

MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
```

Run and Create Migration And Seeding Data
```sh
php artisan migrate:refresh
php artisan db:seed
```

Install Passport Package
```sh
php artisan passport:install
```

Verify the deployment by navigating to your server address in your preferred browser.

```sh
http://localhost:8000
```

Automatically create a complete module structure

```sh
php artisan crud:generate PageContent
```

Clear cache
```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

Optimization before deploy code
```sh
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the Sam CMS

## Security Vulnerabilities

If you discover a security vulnerability within Sam CMS, please send an e-mail to Quốc Tuấn via [contact.quoctuan@gmail.com](mailto:contact.quoctuan@gmail.com). All security vulnerabilities will be promptly addressed.

## Authors

- Name: Vũ Quốc Tuấn 
- Email: contact.quoctuan@gmail.com
- Phone: 0933 649 647
- Website: quoctuan.info
- Skype: quoctuan.it64

## License

The Sam CMS is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)
[Laravel]: <https://laravel.com/>
[CKEditor]: <https://ckeditor.com/>
[CKFinder]: <https://ckeditor.com/ckfinder/>
[node.js]: <http://nodejs.org>
[Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
[jQuery]: <http://jquery.com>
[Gulp]: <http://gulpjs.com>
