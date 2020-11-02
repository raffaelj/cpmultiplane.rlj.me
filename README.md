# CpMultiplane docs

This is the official docs repository for [CpMultiplane][2], the small and lightweight php frontend on top of [Cockpit CMS][1].

The structure of this repo/project is based on the [cpmp-lib-skeleton][3].

Project specific customizations are in `cpdata/addons/mpdocs` and `defines.php`. All other used addons are installed via composer.

## How to edit docs

Fork this repo, change the content of the md files inside the `docs` folder and send a pull request.

Or run this repo on your local dev machine (php7 and apache) and edit all contents with cockpit in your browser. Than send a pull request.

I'll than check your changes manually and apply the updates on the remote host.

If you run this application in a subfolder of the docs root (`localhost:8080/mpdocs`), images won't display properly because of absolute image paths.

## Run locally

I expect, that docker and docker-compose are installed.

* copy `.env.dist` to `.env`
* uncomment `MPDOCS_ENVIRONMENT=DEVELOPMENT` and `MPDOCS_SKIP_LOGIN=1`
* run `docker-compose up -d`
* open your browser on `http://localhost:8080`
* edit `.md` files in `docs` folder or edit via browser on `http://localhost:8080/cockpit`

stop: `docker-compose down`

## Update on remote

```bash
ssh user@host
cd ~/html
git pull
```

## Build

install dependencies:

`composer install` or `composer install --no-dev --ignore-platform-reqs`

update dependencies:

`composer update` or `composer update --no-dev --ignore-platform-reqs`

## To do

* [ ] update `composer.json` (`dev-next`) after next Cockpit release
* [ ] update `composer.json` (`dev-master`) after next CpMultiplane release
* [ ] update `composer.json` (`dev-master`) after next rljUtils release
* [ ] disable UniqueSlugs addon - not needed anymore with permalinks
* [ ] disable FormValidation addon (not used, yet)

## Credits/License

Some files and snippets are copied from the core Cockpit CMS, author: Artur Heinze, www.agentejo.com, MIT License

Third party resources in addons are credited in their README files.

Everything else: Raffael Jesche, www.rlj.me, MIT License

[1]: https://github.com/agentejo/cockpit/
[2]: https://github.com/raffaelj/CpMultiplane
[3]: https://github.com/raffaelj/cpmp-lib-skeleton
