### Composer Update Notifier for Laravel

Configurable Laravel package that checks Composer updates and notify via e-mail if any update exist.

![231128161658](https://github.com/murat-cileli/update-notifier/assets/6532000/c3596ca6-5169-41e7-afaf-73f61cb3ffc5)

#### Installation
`composer require murat-cileli/update-notifier`

#### Configuration with .env file

`UPDATE_NOTIFIER_COMPOSER_PATH`: Composer binary path. Default: `composer`  

`UPDATE_NOTIFIER_CHECK_VERSION`: Allowed values are `all`, `major`, `minor` and `patch`. Default: `all`.  

`UPDATE_NOTIFIER_DIRECT_PACKAGES`: Checks direct dependencies only if set `true`. Defult: `true`  

`UPDATE_NOTIFIER_DIRECT_PACKAGES`: Checks locked packages only if set `true`. Default: `true`.  

`UPDATE_NOTIFIER_DEVELOPMENT_PACKAGES`: Checks development packages if set `true`. Defalut: `false`.  

`UPDATE_NOTIFIER_MAIL_TO`: Mail recipient(s) for e-mail notification. Multiple mails can be seperated with comma. Eg. `mail@example.com, mail2@example.com` 

#### Configuration with config file

Config file to be published first using;

`php artisan vendor:publish --tag update-notifier`

then parameters can be edited in `config/update_notifier.php`.

#### Usage

From you project root:

`php artisan update-notifier:notify`

Notifications can be scheduled with cron. For example, this checks updates every morning at 09:00  
`0 9 * * * cd /your/project && php artisan update-notifier:notify`

