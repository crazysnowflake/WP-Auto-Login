# WP-Auto-Login

This plugin was created for quick login when working locally.
* For enable autologin just define **U_AUTO_LOGIN** as true in wp-config.php and if you visit site and not logged in, you will login as administrator.
* If you want login by special url define **U_AUTO_LOGIN_SECRETTOKEN**. By visiting http://mysite.com/?u_token=some_secret_token, you will be automatically logged into the account as administrator.
* To login as certain user define **U_AUTO_LOGIN_USERNAME**

```php
define('U_AUTO_LOGIN', true);
define('U_AUTO_LOGIN_SECRETTOKEN', 'some_secret_token');
define('U_AUTO_LOGIN_USERNAME', 'admin');
```
