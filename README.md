Pull or clone solution
Pull from repositoriy:
git pull https://github.com/tolyaganzin/angular-yii2

Clone from repositoriy:
git clone https://github.com/tolyaganzin/angular-yii2


Nginx config
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
