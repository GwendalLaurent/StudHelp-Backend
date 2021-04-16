<p align="center"><a href="https://github.com/vaklein/StudHelp-Android" target="_blank"><img src="https://raw.githubusercontent.com/vaklein/StudHelp-Android/main/LogoStudHelp.png?token=AKTQAWOVG4G55RP3QYG5XOLAOV2RC" width="100"></a>
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>

[![Dev Deployment](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/DEV_Laravel.yml/badge.svg)](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/DEV_Laravel.yml)
[![Prod Deployment](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/PROD_Laravel.yml/badge.svg)](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/PROD_Laravel.yml)

</p>

## End routes

| Method | URI | Action |
| ------ | --- | ------ |

<p align="center"><a href="https://github.com/vaklein/StudHelp-Android" target="_blank"><img src="https://raw.githubusercontent.com/vaklein/StudHelp-Android/main/LogoStudHelp.png?token=AKTQAWOVG4G55RP3QYG5XOLAOV2RC" width="100"></a>
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>

[![Dev Deployment](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/DEV_Laravel.yml/badge.svg)](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/DEV_Laravel.yml)
[![Prod Deployment](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/PROD_Laravel.yml/badge.svg)](https://github.com/GwendalLaurent/StudHelp-Backend/actions/workflows/PROD_Laravel.yml)

</p>

## End routes

| Method | URI                               | Action                               |
| ------ | --------------------------------- | ------------------------------------ | -------------------------------------------------------------------- | ------------------------------------------------------------ |
| POST   | api/advertisement                 | advertisement.store                  | App\Http\Controllers\AdvertisementController@store                   |
| POST   | api/advertisement/pictures        | pictures.store                       | App\Http\Controllers\AdvertisementHasPicturesController@store        |
| GET    | HEAD                              | api/advertisement/pictures/{picture} | pictures.show                                                        | App\Http\Controllers\AdvertisementHasPicturesController@show |
| POST   | api/advertisement/tags            | tags.store                           | App\Http\Controllers\AdvertisementHasTagsController@store            |
| PUT    | PATCH                             | api/advertisement/tags/{tag}         | tags.update                                                          | App\Http\Controllers\AdvertisementHasTagsController@update   |
| DELETE | api/advertisement/tags/{tag}      | tags.destroy                         | App\Http\Controllers\AdvertisementHasTagsController@destroy          |
| GET    | HEAD                              | api/advertisement/tags/{tag}         | tags.show                                                            | App\Http\Controllers\AdvertisementHasTagsController@show     |
| DELETE | api/advertisement/{advertisement} | advertisement.destroy                | App\Http\Controllers\AdvertisementController@destroy                 |
| PUT    | PATCH                             | api/advertisement/{advertisement}    | advertisement.update                                                 | App\Http\Controllers\AdvertisementController@update          |
| GET    | HEAD                              | api/course                           | course.index                                                         | App\Http\Controllers\CourseController@index                  |
| POST   | api/course                        | course.store                         | App\Http\Controllers\CourseController@store                          |
| GET    | HEAD                              | api/course/{course}                  | course.show                                                          | App\Http\Controllers\CourseController@show                   |
| GET    | HEAD                              | api/course/{course}/advertisement    | course.advertisement.index                                           | App\Http\Controllers\CourseAdvertisementController@index     |
| DELETE | api/favorite                      | generated::7PogbwpIYrlyr154          | App\Http\Controllers\UserHasFavoriteController@deleteFavForUser      |
| POST   | api/favorite                      | favorite.store                       | App\Http\Controllers\UserHasFavoriteController@store                 |
| GET    | HEAD                              | api/favorite/{user_email}            | favorite.show                                                        | App\Http\Controllers\UserHasFavoriteController@show          |
| PUT    | api/firebase_token/{user_email}   | generated::1T0NHHU36LIXR4n5          | App\Http\Controllers\UserController@updateFirebaseToken              |
| GET    | HEAD                              | api/globalvariables/{globalvariable} | globalvariables.show                                                 | App\Http\Controllers\GlobalVariablesController@show          |
| POST   | api/login                         | generated::93VxNWfRwLhvbTOl          | App\Http\Controllers\AuthController@login                            |
| POST   | api/logout                        | generated::LV1wpjAdHlYDPdlQ          | App\Http\Controllers\AuthController@logout                           |
| POST   | api/register                      | generated::JcHc2UoIaPyCnaW8          | App\Http\Controllers\AuthController@register                         |
| POST   | api/social_links                  | social_links.store                   | App\Http\Controllers\SocialLinksController@store                     |
| PUT    | PATCH                             | api/social_links/{user_email}        | social_links.update                                                  | App\Http\Controllers\SocialLinksController@update            |
| GET    | HEAD                              | api/user                             | user.index                                                           | App\Http\Controllers\UserController@index                    |
| POST   | api/user                          | user.store                           | App\Http\Controllers\UserController@store                            |
| PUT    | api/user/password/{email}         | generated::yhIjhOoxa5qOyU4U          | App\Http\Controllers\UserController@updatePassword                   |
| POST   | api/user/picture                  | generated::4MiYoypJmuIwliYZ          | App\Http\Controllers\UserController@uploadProfilePicture             |
| PUT    | api/user/profile/{email}          | generated::oGtiFz6L3ek22gIJ          | App\Http\Controllers\UserController@updateLoginAndNameAndDescription |
| GET    | HEAD                              | api/user/{email}                     | user.show                                                            | App\Http\Controllers\UserController@show                     |
| GET    | HEAD                              | api/user/{user}/advertisement        | user.advertisement.index                                             | App\Http\Controllers\AdvertisementController@index           |
| GET    | HEAD                              | api/user/{user}/social_links         | user.social_links.index                                              | App\Http\Controllers\SocialLinksController@index             |
| GET    | HEAD                              | sanctum/csrf-cookie                  | generated::XlmVsVgFJdL87LOj                                          | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show   |

## License

The backend of StudHelp uses the Laravel framework. The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## License

The backend of StudHelp uses the Laravel framework. The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
