# Markcoon

![A banner image of Rocky the Raccoon](https://github.com/neoground/markcoon/blob/main/data/blog/thumbnails/default_hero.jpg?raw=true)

A flat file markdown blog system based on the Charm framework.

Blog posts are stored at `data/blog/posts`.

Their thumbnails are stored at `data/blog/thumbnails` and all other assets at `data/blog/assets/$slug`,
where `$slug` should be the slug of your blog post. But you can also store them directly in the `assets` dir.

## Getting Started with this Charm-based Project

Welcome to the markcoon1 built upon the powerful Charm framework! 
Setting up the project is a breeze, and you'll be up and running in no time.
Just follow these simple steps, and you'll be coding with the Force on your side. 🚀

1. Clone the repository: Clone the markcoon1's repo to a new folder on your local machine.
   ```bash
   git clone https://github.com/youruser/markcoon1.git /path/to/markcoon1
   cd /path/to/markcoon1
   ```
2. Install dependencies: Run `composer install` to fetch all required dependencies.
   ```bash
   composer install
   ```
3. Create necessary directories: Ensure the var/cache, var/logs, and data directories are in place.
   ```bash
   mkdir var/cache var/logs data
   ```
4. Set permissions: If your web server runs as a different user, grant read, write, and execute permissions to the directories.
   ```bash
   chmod -R 0777 var/cache var/logs data
   ```
5. Create local environment: Execute bob c:env Local, and the trusty assistant will create a local environment for you.
   ```bash
   bob c:env Local
   ```
6. Depending on your project's setup you should now run any initial commands, like for migrating the database:
   ```bash
   bob db:sync
   ```
7. Install additionally needed packages depending on your project, like `npm install` for your node assets
8. Configure web server: Update your Apache or Nginx configuration to handle rewrites to the `index.php` file.
   For apache2 you can find a `.htaccess` and for nginx a `nginx.conf` file in this repository.
9. Open the new project in your browser or run a development server with `bob serve`.

For more information on setting up a charm project, see the [Charm Installation Guide](https://neoground.com/docs/charm/start.installation).

You can learn more about the Bob CLI tool in the [Bob Documentation](https://github.com/neoground/charm-toolkit).

## License

This project is licensed under the Mozilla Public License 2.0 (MPL 2.0) -
see the [LICENSE.md](LICENSE.md) file for details.
If a copy of the MPL was not distributed with this file, You can obtain one at
[https://mozilla.org/MPL/2.0](https://mozilla.org/MPL/2.0).

Copyright (c) 2024 Neoground GmbH
