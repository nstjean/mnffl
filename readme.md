## General Information

This personal project is an app built for a fantasy football league. Users are able to log in, make/edit/delete posts, and view the archive. Admins can also add/edit/delete archive files, add/edit/delete users, and edit/delete user posts.


## Technologies

To build this site I used the Laravel 5.8 framework on PHP 7.2 and MySQL. The front end is designed with designed with CSS3, SASS and Bootstrap.


## Live Site

http://mnffl.net

The live site is deployed on Vultr with a MySQL database.


## Demo Site

http://thawing-mountain-84691.herokuapp.com

The demo site is deployed on Heroku free tier with a ClearDB database. You can log in with the following credentials:

- admin@gmail.com / password
- user@gmail.com / password

Heroku hosting does not include file storage. Because of this you cannot upload/view photos or documents in the demo site.


## Development - Installation

- `composer install`
- `yarn install`
- copy `.env.example` to `.env` and set the variables
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`


## Development - Build

- `npm run development`
- `php artisan serve`


## Deployment

- This site is set up to deploy using [laravel-deployer](https://github.com/lorisleiva/laravel-deployer)
- Make sure ssh keys are set up correctly on server and local
- Merge changes to `master`, push to GitLab
- Run `php artisan deploy` to start deployment
- `service php7.2-fpm reload` - may be needed to clear cache and show updated views

To do: Set up GitLab pipeline to auto deploy