# Running the example

1. add GOOGLE_RECAPTCHA_SITE_KEY and GOOGLE_RECAPTCHA_SECRET in .env.local file
2. ddev start
3. ddev composer install
4. ddev exec bin/console cache:clear
5. ddev exec bin/console importmap:install
6. ddev exec bin/console asset-map:compile
7. open https://live-components-recaptcha.ddev.site:8443/register on your browser
8. enjoy :-)