This code is published as part of the [corresponding blog article](https://www.toptal.com/laravel/passport-tutorial-auth-user-access) at the Toptal Engineering Blog.

Visit https://www.toptal.com/blog and subscribe to our newsletter to read great articles!

* * *

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Laravel Api Framework
This is a framework of basic things you would need to set up a Laravel REST API.
If you get an error when trying to `composer install` that reads:
```bash
PackageManifest.php line 131:
 Undefined index: name
```
You can try running the following commands to fix:
```bash 
rm -rf composer.lock // removes composer.lock
rm -rf vendor // removes vendor folder
composer install // re-runs composer install
```


