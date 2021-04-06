<p align="center"><a href="https://github.com/vaklein/StudHelp-Android" target="_blank"><img src="https://raw.githubusercontent.com/vaklein/StudHelp-Android/main/LogoStudHelp.png?token=AKTQAWOVG4G55RP3QYG5XOLAOV2RC" width="100"></a>
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>
</p>


## End routes

| Method    | URI                               | Action                                                     |
|-----------|-----------------------------------|------------------------------------------------------------|
| POST      | api/advertisement                 | Add a new advertisement                                    |
| DELETE    | api/advertisement/{advertisement} | Delete the advertisement with a given id                   |
| PUT|PATCH | api/advertisement/{advertisement} | Update the content of an advertisement                     |
| GET|HEAD  | api/course                        | Get all the courses                                        |
| POST      | api/course                        | Add a new course                                           |
| GET|HEAD  | api/course/{course}               | Get a specific course with a given id                      |
| GET|HEAD  | api/course/{course}/advertisement | Get all the advertisement of a specific course             |
| DELETE    | api/favorite                      | Delete a favorite course                                   |
| POST      | api/favorite                      | Add a new favorite course                                  |
| GET|HEAD  | api/favorite/{user_email}         | Get all the favorite courses of a specific user            |
| POST      | api/social_links                  | Add a new social link line                                 |
| PUT|PATCH | api/social_links/{user_email}     | Update the social links of a specific user                 |
| POST      | api/user                          | Add a new user                                             |
| GET|HEAD  | api/user                          | Get all the users                                          |
| PUT       | api/user/password/{email}         | Update the password of a specific user                     |
| PUT       | api/user/{email}                  | Update the name or/and the email of a specific user        |
| GET|HEAD  | api/user/{email}                  | Get a specific user                                        |
| GET|HEAD  | api/user/{user}/advertisement     | Get all the advertisement of a specific user               |
| GET|HEAD  | api/user/{user}/social_links      | Get the social links of a specific user                    |
## License
The backend of StudHelp uses the Laravel framework. The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
