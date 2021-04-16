<p align="center"><a href="https://github.com/vaklein/StudHelp-Android" target="_blank"><img src="https://raw.githubusercontent.com/vaklein/StudHelp-Android/main/LogoStudHelp.png?token=AKTQAWOVG4G55RP3QYG5XOLAOV2RC" width="100"></a>
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>

[![Dev Deployment](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/DEV_Laravel.yml/badge.svg)](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/DEV_Laravel.yml)
[![Prod Deployment](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/PROD_Laravel.yml/badge.svg)](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/PROD_Laravel.yml)

</p>

## End routes

| Method    | URI                                  | Action                      |
| --------- | ------------------------------------ | --------------------------- |
| POST      | api/advertisement                    | advertisement.store         |
| POST      | api/advertisement/pictures           | pictures.store              |
| GET/HEAD  | api/advertisement/pictures/{picture} | pictures.show               |
| POST      | api/advertisement/tags               | tags.store                  |
| PUT/PATCH | api/advertisement/tags/{tag}         | tags.update                 |
| DELETE    | api/advertisement/tags/{tag}         | tags.destroy                |
| GET/HEAD  | api/advertisement/tags/{tag}         | tags.show                   |
| DELETE    | api/advertisement/{advertisement}    | advertisement.destroy       |
| PUT/PATCH | api/advertisement/{advertisement}    | advertisement.update        |
| GET/HEAD  | api/course                           | course.index                |
| POST      | api/course                           | course.store                |
| GET/HEAD  | api/course/{course}                  | course.show                 |
| GET/HEAD  | api/course/{course}/advertisement    | course.advertisement.index  |
| DELETE    | api/favorite                         | generated::7PogbwpIYrlyr154 |
| POST      | api/favorite                         | favorite.store              |
| GET/HEAD  | api/favorite/{user_email}            | favorite.show               |
| PUT       | api/firebase_token/{user_email}      | generated::1T0NHHU36LIXR4n5 |
| GET/HEAD  | api/globalvariables/{globalvariable} | globalvariables.show        |
| POST      | api/login                            | generated::93VxNWfRwLhvbTOl |
| POST      | api/logout                           | generated::LV1wpjAdHlYDPdlQ |
| POST      | api/register                         | generated::JcHc2UoIaPyCnaW8 |
| POST      | api/social_links                     | social_links.store          |
| PUT/PATCH | api/social_links/{user_email}        | social_links.update         |
| GET/HEAD  | api/user                             | user.index                  |
| POST      | api/user                             | user.store                  |
| PUT       | api/user/password/{email}            | generated::yhIjhOoxa5qOyU4U |
| POST      | api/user/picture                     | generated::4MiYoypJmuIwliYZ |
| PUT       | api/user/profile/{email}             | generated::oGtiFz6L3ek22gIJ |
| GET/HEAD  | api/user/{email}                     | user.show                   |
| GET/HEAD  | api/user/{user}/advertisement        | user.advertisement.index    |
| GET/HEAD  | api/user/{user}/social_links         | user.social_links.index     |
| GET/HEAD  | sanctum/csrf-cookie                  | generated::XlmVsVgFJdL87LOj |

## License

The backend of StudHelp uses the Laravel framework. The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## License

The backend of StudHelp uses the Laravel framework. The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
