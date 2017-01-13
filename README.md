# sistema

## Instalacion

Copiar el archivo de configuración local.php.dis a local.dist

```bash
$ cp -p config/autoload/local.php.dist config/autoload/local.php
```

Instalar las librerias dependientes

```bash
$ composer update
```

Para validar los pre commits

```bash
$ cp vendor/bruli/php-git-hooks/src/PhpGitHooks/Infrastructure/Hook/pre-commit .git/hooks
```

```bash
$ cp vendor/bruli/php-git-hooks/src/PhpGitHooks/Infrastructure/Hook/commit-msg .git/hooks
```

## Development mode

```bash
$ composer development-enable  # enable development mode
$ composer development-disable # enable development mode
$ composer development-status  # whether or not development mode is enabled
```

## Running Unit Tests

  ```bash
  $ composer test
  ```

## Permisos de escritura a las carpetas :

```bash
$ chmod 777 data/cache/
```

## Deploy a Producción
 
```bash
$ rm -rf data/cache/*
$ composer update --no-dev
$ composer dump-autoload --optimize
```

