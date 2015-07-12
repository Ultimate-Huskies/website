The repository for the ultimate-huskies website.

# Development
This wordpress site uses a modern stack to make development easy and maintainable. So make sure you have the required tools installed. The used file structure is based [Bedrock][bedrock_link] to enable [Composer][composer_link] for wordpress. Its also using [Timber][timber_link] to make use of [TWIG][twig_link] as templating engine.

## Requirements
- [Composer][composer_link]
- [NodeJS][node_link] with [NPM][npm_link]

## Install
- clone this repo `https://github.com/Ultimate-Huskies/website.git`
- install php dependencies `composer install`
    - it installs the last wordpress version 
    - it also installs all required wordpress plugins
- create environment file to fill in the required parameters to connect to your database `cp .env.example .env`
- point your server to `[path_to_this_repo]/web`
- install theme dependencies `npm install`
    - it installs libs to convert less and coffeescript 

## Available build scripts
Run to (auto)compile changed coffeescript and less files.

### Watch changes for theme files
```
npm run watch
```

### One time compile all theme files
```
nom run build
```

### One time compile all coffeescript files
```
nom run build:scripts
```

### One time compile all less files
```
nom run build:styles
```

## Installing new dependencies
### For PHP
```
composer require <pkg>
composer update
```

### For NodeJS
```
npm install <pkg> [--save|--save-dev]
```

### For Frontend stuff using bower
```
./node_modules/.bin/bower install <pkg> [--save|--save-dev]
```

[composer_link]: https://getcomposer.org/doc/00-intro.md#globally
[node_link]: https://nodejs.org/
[npm_link]: https://www.npmjs.com/
[bedrock_link]: https://github.com/roots/bedrock
[timber_link]: https://github.com/jarednova/timber
[twig_link]: http://twig.sensiolabs.org/