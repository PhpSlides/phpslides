# PhpSlides

[![Tests Workflow](https://github.com/phpslides/framework/workflows/Tests/badge.svg)](https://github.com/PhpSlides/framework/actions)
[![Release Workflow](https://github.com/phpslides/framework/workflows/Release/badge.svg)](https://github.com/PhpSlides/framework/actions)

[![Total Downloads](https://img.shields.io/packagist/dt/phpslides/framework)](https://packagist.org/packages/phpslides/framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/phpslides/framework)](https://packagist.org/packages/phpslides/framework)
[![License](https://img.shields.io/packagist/l/phpslides/framework)](https://packagist.org/packages/phpslides/framework)

Welcome to PhpSlides!

This framework is a PHP revolution,
designed to provide a simple and scalable structure for developing full-stack web applications
using the Model-View-Controller (MVC) architectural pattern.

With PhpSlides, you can write HTML, CSS, and JavaScript in a PHP-like way,
streamlining the development process and enhancing productivity.

## Table of Contents

- [PhpSlides](#phpslides)
  - [Table of Contents](#table-of-contents)
  - [Introduction](#introduction)
  - [Features](#features)
  - [Requirements](#requirements)
  - [Installation](#installation)
    - [Install with Composer](#install-with-composer)
    - [Or Clone the Repository](#or-clone-the-repository)
  - [Configuration](#configuration)
    - [.env](#env)
    - [config.json](#configjson)
  - [Syntax](#syntax)
    - [Creating Web Layouts](#creating-web-layouts)
    - [Styling Web Layouts](#styling-web-layouts)
    - [Creating Web Routes](#creating-web-routes)
    - [Creating API Routes](#creating-api-routes)
  - [Directory Structure](#directory-structure)
  - [Documentation](#documentation)
  - [Contributing](#contributing)
  - [License](#license)
  - [Financial Support](#financial-support)

## Introduction

PhpSlides is a lightweight, easy-to-use full-stack framework that helps you build web applications quickly and efficiently.
It follows the MVC architectural pattern, separating the application logic into models, views, and controllers to promote code organization and reusability.

Additionally, it provides the capability to write HTML, CSS, and JavaScript in a PHP-like way, making it easier to manage and maintain your front-end and back-end code together.

## Features

- **Full-Stack Development**: Seamlessly integrate front-end and back-end development by writing HTML, CSS, and JavaScript in a PHP-like syntax.
- **Simple Routing**: Easily define routes and map them to controllers and actions.
- **Modular Structure**: Organized directory structure for models, views, controllers, and other components.
- **Database Forgery**: A unique feature that allows you to manage your databases and tables using a structured directory format, automatically generating and managing schema migrations based on directory and file structures.
- **AuthGuard Support**: Add authorization guard to handle authentication, logging, and other tasks.

## Requirements

- PHP 8.2 or higher
- Composer
- A web server (e.g., Apache, Nginx)

## Installation

### Install with Composer

```bash
composer create-project phpslides/phpslides ProjectName
cd ProjectName
```

### Or Clone the Repository

1. **Clone the repository:**

   ```bash
   git clone https://github.com/phpslides/phpslides.git
   cd phpslides
   ```

2. **Install dependencies:**

   ```bash
   composer install
   ```

3. **Set up the web server:**

   Point your web server to the document root.

4. **Configure the environment:**

   If the .env file does not exist, copy the env example configuration file and update it with your settings:

   ```bash
   cp .env.example .env
   ```

## Configuration

### .env

Edit the .env file to configure database settings, application settings, and other configurations.

```bash
APP_NAME=PhpSlides
APP_VERSION=1.4.x
APP_DEBUG=true
APP_ENV=local
```

### config.json

Which handles the behavior of a viewing files on the web

```json
{
 "deny": ["/assets/*.png"],
 "message": {
  "contents": "403 | Forbidden",
  "components": "Errors::403",
  "content-type": "text/html",
  "http_code": 403
 },
 "charset": "UTF-8"
}
```

## Syntax

### Creating Web Layouts

```php
<?php

DOM::create('app')->root([
   ['id' => 'root'],
   Tag::Container([],
     Tag::Input(['type' => 'text'], '$$name')
     Tag::Text([], 'Hello $$name')
   )
]);

DOM::render('app');

?>
```

### Styling Web Layouts

```php
<?php

$style = StyleSheet::create([
   'RootStyle' => [
      Style::Size => Screen::100,
      Style::BackgroundImage => asset('bg.png'),
   ],
   'TextStyle' => [
      Style::Color => Color::White,
      Style::FontSize => Font::Base,
      Style::FontWeight => Font::Bold
   ]
]);

export($style, 'AppStyle');

?>
```

### Creating Web Routes

```php
<?php

Route::map(POST, '/index')
  ->action('Controller::method')
  ->name('index');

?>
```

### Creating API Routes

```php
<?php

Api::v1()->define('/user', 'UserController')
  ->map([
      '/info' => [GET, '@index'],
      '/{id}' => [GET, '@show'],
  ])
  ->withGuard('auth')
  ->name('user');

$user_id_route = route('user::1');

?>
```

## Directory Structure

Here's an overview of the project directory structure:

project_root/<br>
├── app/<br>
│ ├── Forgery/<br>
│ ├── Guards/<br>
│ ├── Http/<br>
│ │ └── Api/<br>
│ │ └── Controller/<br>
├── public/<br>
├── src/<br>
│ ├── routes/<br>
│ ├── configs/<br>
│ ├── resources/<br>
│ │ └── views/<br>
├── vendor/<br>
├── .env<br>
├── .env.example<br>
├── .htaccess<br>
├── composer.json<br>
├── config.json<br>
└── README.md

## Documentation

For detailed documentation, including advanced usage,
API references, and more, please visit our [documentation website](s).

## Contributing

We welcome contributions from the community!
If you'd like to contribute,
please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b name/your-feature`).
3. Commit your changes (`git commit -am 'Add a new feature'`).
4. Push to the branch (`git push origin name/your-feature`).
5. Create a new Pull Request.

## License

This project is licensed under the MIT License. See the [LICENSE](https://github.com/PhpSlides/phpslides/blob/master/LICENSE) file for more details.

## Financial Support

Your contributions help us maintain and improve PhpSlides.
If you find PhpSlides useful, please consider supporting us financially.
Every bit of support goes a long way in ensuring we can continue to develop and enhance the framework.

[Support Now!](https://buymeacoffee.com/dconco)
