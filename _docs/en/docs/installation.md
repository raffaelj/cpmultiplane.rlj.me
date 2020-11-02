# Installation

## Requirements

* PHP >= 7.1
* PDO + SQLite (or MongoDB)
* GD extension
* pecl intl extension (optional)
* mod_rewrite, mod_versions enabled (on apache)

Make also sure that `$_SERVER['DOCUMENT_ROOT']` exists and is set correctly.

## Installation

### manually

1. Download/copy all files of the [CpMultiplane repository][1] into your web root.
2. Copy `.htaccess.dist` to `.htaccess`.
3. Download/copy [Cockpit][2] in a subfolder of your web root and name it `cockpit`.
1. Make sure that the __/cockpit/storage__ folder and all its subfolders are writable
5. Open `https://your-domain.com/cockpit/install` in your browser or create the first admin user via cli.
4. Download/copy additional addons

Now login with admin/admin, change your password and start your work.

### via git

```bash
cd ~/html
git clone https://github.com/raffaelj/CpMultiplane.git .
cp .htaccess.dist .htaccess
git clone https://github.com/agentejo/cockpit.git cockpit
git clone https://github.com/raffaelj/cockpit_CpMultiplaneGUI.git cockpit/addons/CpMultiplaneGUI
git clone https://github.com/raffaelj/cockpit_FormValidation.git cockpit/addons/FormValidation
git clone https://github.com/raffaelj/cockpit_UniqueSlugs.git cockpit/addons/UniqueSlugs
```

Now open `https://your-domain.com/cockpit/install` in your browser or create the first admin user via cli:

```bash
cd ~/html
./mp account/create --user admin --password admin --email admin@example.com
```

### via composer

```bash
cd ~/html
composer create-project --ignore-platform-reqs raffaelj/cpmultiplane .
```

Now open `https://your-domain.com/cockpit/install` in your browser or create the first admin user via cli:

```bash
cd ~/html
./mp account/create --user admin --password admin --email admin@example.com
```

If you use composer, Cockpit and the addons CpMultiplaneGUI, FormValidation and UniqueSlugs are installed automatically.

### via docker

The [docker image][3] comes preinstalled with the quickstart routine of the "basic" template, with a default admin user (password: admin) and with dummy data from installed addons.

This is not meant for production use, but for local development.

```bash
docker pull raffaelj/cpmultiplane
docker run --rm -d --name cpmultiplane -p 8080:80 raffaelj/cpmultiplane
```

Now open your browser on `localhost:8080` and see it in action.

### with cpmp-lib-skeleton

If you want to have a clean document root, the [cpmp-lib-skeleton][4] comes in handy. Have a look at the [README][5] for more details.

```bash
mkdir my-project
cd my-project
# composer create-project --ignore-platform-reqs raffaelj/cpmp-lib-skeleton .
composer create-project raffaelj/cpmp-lib-skeleton .

# create default admin user
./mp account/create --user admin --password admin --email admin@example.com
```

## local development with Docker

For local development, I normally mount CpMultiplane and Cockpit into my docker image [raffaelj/php7-apache-base][6].

Folder structure:

```text
.
├── data
│   ├── cp
│   │   ├── addons
│   │   |   ├── CpMultiplaneGUI
│   │   |   ├── FormValidation
│   │   |   ├── UniqueSlugs
│   │   |   └── ...
│   │   ├── config
│   │   |   bootstrap.php
│   │   |   config.php
│   │   └── storage
│   │       ├── cache
│   │       ├── data
│   │       ├── thumbs
│   │       ├── tmp
│   │       ├── uploads
│   │       └── ...
│   └── mp
│       ├── config
│       |   bootstrap.php
│       └── themes
│           └── my-child-theme
│   .env
│   .htaccess
│   defines_cp.php
│   defines_mp.php
│   docker-compose.yml
│   ...
```

.env:

```
CPMULTIPLANE_REPO=/path/to/local/CpMultiplane-repository
COCKPIT_REPO=/path/to/local/cockpit-repository
COCKPIT_ADDONS_REPOS=/path/to/local/parent-dir-of-cockpit-addons-repositories
PORT=8080
DOCKER_USER=1000
DOCKER_GROUP=1000
```

docker-compose.yml:

```yaml
# This docker-compose file is meant for local development. Don't use it in production!

version: "3.7"

services:
  cpmultiplane:

    # https://hub.docker.com/r/raffaelj/php7-apache-base
    # https://github.com/raffaelj/dockerfiles/tree/master/php7-apache-base
    image: raffaelj/php7-apache-base

    container_name: cpmultiplane

    # let apache create files and folders with your user_id:user_group_id
    # In my case, I'm the default user with id 1000 and I'm a member of the group with gid 1000
    user: ${DOCKER_USER:-1000}:${DOCKER_GROUP:-1000}

    volumes:
      # mount dev CpMultiplane and Cockpit repos
      - ${CPMULTIPLANE_REPO}:/var/www/html
      - ${COCKPIT_REPO}:/var/www/html/cockpit

      # mount data
      - ./data:/var/www/html/data
      - ./defines_mp.php:/var/www/html/defines.php
      - ./defines_cp.php:/var/www/html/cockpit/defines.php
      - ./.env:/var/www/html/.env
      #- ./.htaccess:/var/www/html/.htaccess

      # mount dev repos of addons
      - ${COCKPIT_ADDONS_REPOS}/cockpit_CpMultiplaneGUI/:/var/www/html/data/cp/addons/CpMultiplaneGUI
      - ${COCKPIT_ADDONS_REPOS}/cockpit_FormValidation/:/var/www/html/data/cp/addons/FormValidation
      - ${COCKPIT_ADDONS_REPOS}/cockpit_UniqueSlugs/:/var/www/html/data/cp/addons/UniqueSlugs

    ports:
      - ${PORT:-8080}:80

    # apache can't start without that fix if the user was changed
    # see https://hub.docker.com/_/php/ (scroll down to "Running as an arbitrary user")
    sysctls:
      - net.ipv4.ip_unprivileged_port_start=0
```

defines_cp.php:

```php
<?php
define('COCKPIT_ENV_ROOT', str_replace(DIRECTORY_SEPARATOR, '/', realpath(__DIR__.'/../data/cp')));
```

defines_mp.php:

```php
<?php
define('MP_ENV_ROOT', str_replace(DIRECTORY_SEPARATOR, '/', realpath(__DIR__.'/data/mp')));
```


[1]: https://github.com/raffaelj/CpMultiplane
[2]: https://github.com/agentejo/cockpit
[3]: https://hub.docker.com/r/raffaelj/cpmultiplane
[4]: https://github.com/raffaelj/cpmp-lib-skeleton
[5]: https://github.com/raffaelj/cpmp-lib-skeleton#readme
[6]: https://hub.docker.com/r/raffaelj/php7-apache-base
