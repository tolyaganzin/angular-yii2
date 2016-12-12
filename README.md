#Pull or clone solution
###Pull from repositoriy:
git pull https://github.com/tolyaganzin/angular-yii2

###Clone from repositoriy:
git clone https://github.com/tolyaganzin/angular-yii2


##Nginx config server(full-rest-API)
```Nginx
server {
	#listen 80 default_server;
	#listen [::]:80 default_server;

	server_name angular-yii2server.loc www.angular-yii2server.loc;
	root /home/anatoliy_g/projects/angular-yii2/full-rest-yii2-server/web;
	index index.php index.html index.htm index.nginx-debian.html requirements.php;



	#access_log /home/anatoliy_g/projects/angular-yii2/full-rest-yii2-server/access.log;
	#error_log /home/anatoliy_g/projects/angular-yii2/full-rest-yii2-server/error.log;

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

	root /home/anatoliy_g/projects/angular-yii2/angular-client;
	index index.php index.html index.htm index.nginx-debian.html requirements.php;

	server_name angular-yii2client.loc www.angular-yii2client.loc;

	access_log  /var/log/nginx/angular-yii2client_access.log;
	error_log   /var/log/nginx/angular-yii2client_error.log;
	location / {
		# First attempt to serve request as file, then
		# as directory, then fall back to displaying a 404.
        	try_files $uri $uri/ /index.html =404;
	}

	# pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
	#
	location ~ \.php$ {
		include snippets/fastcgi-php.conf;

		# With php7.0-cgi alone:
		#fastcgi_pass 127.0.0.1:9000;
		# With php7.0-fpm:
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
