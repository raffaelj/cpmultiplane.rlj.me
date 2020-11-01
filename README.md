# CpMultiplane docs

This is the official docs repository for [CpMultiplane][2]. It is based on the [cpmp-lib-skeleton][3].

Customizations to the core are made in `cpdata/addons/mpdocs`.

## run locally

I expect, that docker and docker-compose are installed.

* copy `.env.dist` to `.env`
* uncomment `MPDOCS_ENVIRONMENT=DEVELOPMENT` and `MPDOCS_SKIP_LOGIN=1`
* run `docker-compose up -d`
* open your browser on `http://localhost:8080`
* edit `.md` files in `docs` folder or edit via browser on `http://localhost:8080/cockpit`

stop: `docker-compose down`

## update on remote

```bash
ssh user@host
cd ~/html
git pull
```

## build

install dependencies:

`composer install` or `composer install --no-dev --ignore-platform-reqs`

update dependencies:

`composer update` or `composer update --no-dev --ignore-platform-reqs`

## to do

* [ ] update `composer.json` (`dev-next`) after next Cockpit release
* [ ] update `composer.json` (`dev-master`) after next CpMultiplane release
* [ ] update `composer.json` (`dev-master`) after next rljUtils release

## Credits/License

Some files and snippets are copied from the core Cockpit CMS, author: Artur Heinze, www.agentejo.com, MIT License

Everything else: Raffael Jesche, www.rlj.me, MIT License

[1]: https://github.com/agentejo/cockpit/
[2]: https://github.com/raffaelj/CpMultiplane
[3]: https://github.com/raffaelj/cpmp-lib-skeleton
