# [Project Name]

## Requirements

As per [Craft CMS Server Requirements](https://github.com/craftcms/docs/blob/v3/en/requirements.md). PHP 7 will need to available via the CLI in order to use the included `craft` script.

## Prerequisites

- [Node](https://nodejs.org/en/)
- [Gulp CLI](https://github.com/gulpjs/gulp-cli)
- [Composer](https://getcomposer.org/)

## Getting Started

1. Clone repository.
2. Create new host.
2. Create new database and import database from live site.
3. Install composer dependencies via `$ composer install`.
4. Create a new `.env` file from `.env.example`.
5. Install npm dependencies via `$ npm install`.

## Build

| Task     | Description                                          |
|-------|---------------------------------------------------------|
| build | Cleans the output directory and builds all src files    |
| serve | Creates a Browsersync instance and watches for changes  |
| watch | Watch src directory for changes and rebuild            |
| lint  | Lints SCSS, fixing errors where possible                |

## Linting

CSS/SASS linting is provided by [Stylelint](https://stylelint.io/). It is recommended to install an editor plugin to provide inline linting.

A pre commit hook is in place to lint and automatically fix issues within staged files. 