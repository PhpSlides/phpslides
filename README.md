# PhpSlides

Welcome to PhpSlides!<br>
This framework is a PHP revolution,
designed to provide a simple and scalable structure for developing full-stack web applications
using the Model-View-Controller (MVC) architectural pattern.

With PhpSlides, you can write HTML, CSS, and JavaScript in a PHP-like way,
streamlining the development process and enhancing productivity.

## Table of Contents

-  [Introduction](#introduction)
-  [Features](#features)
-  [Requirements](#requirements)
-  [Installation](#installation)
-  [Configuration](#configuration)
   -  [ENV config](#env)
   -  [phpslides config](#phpslidesconfigjson)
-  [Syntax](#syntax)
   -  [Creating Web Layouts](#creating-web-layouts)
   -  [Styling Web Layouts](#styling-web-layouts)
   -  [Creating Web Routes](#creating-web-routes)
   -  [Creating API Routes](#creating-api-routes)
-  [Directory Structure](#directory-structure)
-  [Documentation](#documentation)
-  [Contributing](#contributing)
-  [License](#license)

## Introduction

PhpSlides is a lightweight, easy-to-use full-stack framework that helps you build web applications quickly and efficiently.
It follows the MVC architectural pattern, separating the application logic into models, views, and controllers to promote code organization and reusability.

Additionally, it provides the capability to write HTML, CSS, and JavaScript in a PHP-like way, making it easier to manage and maintain your front-end and back-end code together.

## Features

-  **Full-Stack Development**: Seamlessly integrate front-end and back-end development by writing HTML, CSS, and JavaScript in a PHP-like syntax.
-  **Simple Routing**: Easily define routes and map them to controllers and actions.
-  **Modular Structure**: Organized directory structure for models, views, controllers, and other components.
-  **Database Abstraction**: Simple and flexible database handling with a query builder.
-  **Middleware Support**: Add middleware to handle authentication, logging, and other tasks.
-  **Event Handling**: Built-in event handling system for managing application events.
-  **Service Providers**: Easily manage and configure services like email, payment, caching, etc.

## Requirements

-  PHP 8.2 or higher
-  Composer
-  A web server (e.g., Apache, Nginx)

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
APP_SERVER=localhost
APP_URL=http://localhost
APP_DEBUG=true
```

### phpslides.config.json

```json
{
   "public": {
      "/": ["*"],
      "assets": ["*"],
      "images": ["image"],
      "videos": ["video"],
      "audios": ["audio"],
      "styles": [
         "css",
         "scss",
         "sass"
      ],
      "css": [
         "css",
         "scss",
         "sass"
      ],
      "src": [
         "js",
         "ts",
         "css",
         "scss",
         "sass"],
      "png": ["png"],
      "jpg": ["jpg"],
      "svg": ["svg"]
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
      '/' => [GET, '@index'],
      '/{id}' => [GET, '@show'],
  ])
  ->name('user');

$user_id_route = route('user::1');

?>
```

## Directory Structure

Here's an overview of the project directory structure:

project_root/<br>
├── app/<br>
│ ├── controllers/<br>
│ ├── middlewares/<br>
│ ├── models/<br>
├── configs/<br>
├── core/<br>
├── database/<br>
├── public/<br>
├── resources/<br>
│ ├── src/<br>
│ │ ├── components/<br>
│ │ ├── scripts/<br>
│ │ └── styles/<br>
│ ├── views/<br>
│ │ └── errors/<br>
├── routes/<br>
├── vendor/<br>
├── .env<br>
├── .env.example<br>
├── .htaccess<br>
├── composer.json<br>
├── create<br>
├── phpslides.config.json<br>
└── README.md

## Documentation

For detailed documentation, including advanced usage,
API references, and more, please visit our [documentation website](#).

## Contributing

We welcome contributions from the community!
If you'd like to contribute,
please follow these steps:

<ol>
   <li>Fork the repository.</li>
   <li>Create a new branch (git checkout -b name/your-feature).</li>
   <li>Commit your changes (git commit -am 'Add a new feature').</li>
   <li>Push to the branch (git push origin name/your-feature).</li>
   <li>Create a new Pull Request.</li>
</ol>

## License

This project is licensed under the MIT License. See the [LICENSE](https://github.com/PhpSlides/phpslides/blob/master/LICENSE) file for more details.
