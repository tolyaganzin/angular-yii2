#Pull or clone solution
###Pull from repositoriy:
`git pull https://github.com/tolyaganzin/angular-yii2`

###Clone from repositoriy:
`git clone https://github.com/tolyaganzin/angular-yii2`


##Nginx config server(full-rest-API)
```Nginx
server {
	#listen 80 default_server;
	#listen [::]:80 default_server;

	server_name angular-yii2server.loc www.angular-yii2server.loc;
	root /var/www/angular-yii2/full-rest-yii2-server/web;
	index index.php;

	access_log  /var/log/nginx/angular-yii2server.loc_access.log;
	error_log   /var/log/nginx/angular-yii2server.loc_error.log;

	location / {
	# Redirect everything that isn't a real file to index.php
		try_files $uri $uri/ /index.php$is_args$args;
	}

	location ~ ^/assets/.*\.php$ {
		deny all;
	}

	location ~ \.php$ {
		include snippets/fastcgi-php.conf;		
		fastcgi_pass unix:/run/php/php7.0-fpm.sock;		
	}

	location ~* /\. {
		deny all;
	}
}
```
##Nginx config client(frontend)
```Nginx
server {
	#listen 80 default_server;
	#listen [::]:80 default_server;

	root /var/www/angular-yii2/angular-client;
	index index.html;

	server_name angular-yii2client.loc www.angular-yii2client.loc;

	access_log  /var/log/nginx/angular-yii2client_access.log;
	error_log   /var/log/nginx/angular-yii2client_error.log;
	location / {
		# First attempt to serve request as file, then
		# as directory, then fall back to displaying a 404.
        	try_files $uri $uri/ /index.html =404;
	}

	# pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
	location ~ \.php$ {
		include snippets/fastcgi-php.conf;
		fastcgi_pass unix:/run/php/php7.0-fpm.sock;
	}

	# deny access to .htaccess files, if Apache's document root
	# concurs with nginx's one
	#
	#location ~ /\.ht {
	#	deny all;
	#}
}
```
##Edit file hosts
```
127.0.0.1	angular-yii2server.loc #server url
127.0.0.1	angular-yii2client.loc #client url
```
#Instal dependency server
##Path
`cd angular-yii2/full-rest-yii2-server`
##Composer install: https://getcomposer.org/
### Install composer dependency
```
composer install
composer global require "fxp/composer-asset-plugin:1.2.0"
```
#Instal dependency client
##Path
`cd ../angular-yii2/angular-client`
## Bower install: https://bower.io/
### Install bower dependency
`bower install`
