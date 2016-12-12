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
###Path
`cd angular-yii2/full-rest-yii2-server`
##Composer install: https://getcomposer.org/
### Install composer dependency
```
composer install
composer global require "fxp/composer-asset-plugin:1.2.0"
```
#Instal dependency client
###Path
`cd ../angular-yii2/angular-client`
## Bower install: https://bower.io/
### Install bower dependency
`bower install`
#Create db mysql
```SQL
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `yii2advanced` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `yii2advanced`;

CREATE TABLE IF NOT EXISTS `film` (
 `id` int(11) NOT NULL,
 `title` varchar(255) NOT NULL,
 `storyline` text,
 `director` varchar(100) NOT NULL,
 `year` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO `film` (`id`, `title`, `storyline`, `director`, `year`) VALUES
(1, 'Побег из Шоушенка', 'Успешный банкир Энди Дюфрейн обвинен в убийстве собственной жены и ее любовника. Оказавшись в тюрьме под названием Шоушенк, он сталкивается с жестокостью и беззаконием, царящими по обе стороны решетки. Каждый, кто попадает в эти стены, становится их рабом до конца жизни. Но Энди, вооруженный живым умом и доброй душой, отказывается мириться с приговором судьбы и начинает разрабатывать невероятно дерзкий план своего освобождения.', 'Фрэнк Дарабонт', 1994),
(2, 'Зеленая миля', 'Обвиненный в страшном преступлении, Джон Коффи оказывается в блоке смертников тюрьмы «Холодная гора». Вновь прибывший обладал поразительным ростом и был пугающе спокоен, что, впрочем, никак не влияло на отношение к нему начальника блока Пола Эджкомба, привыкшего исполнять приговор.\r\n\r\nГигант удивил всех позже, когда выяснилось, что он обладает невероятной магической силой…', 'Фрэнк Дарабонт', 1999),
(3, 'Форрест Гамп', 'От лица главного героя Форреста Гампа, слабоумного безобидного человека с благородным и открытым сердцем, рассказывается история его необыкновенной жизни.\r\n\r\nФантастическим образом превращается он в известного футболиста, героя войны, преуспевающего бизнесмена. Он становится миллиардером, но остается таким же бесхитростным, глупым и добрым. Форреста ждет постоянный успех во всем, а он любит девочку, с которой дружил в детстве, но взаимность приходит слишком поздно.', 'Роберт Земекис', 1994),
(4, 'Список Шиндлера', 'Фильм рассказывает реальную историю загадочного Оскара Шиндлера, члена нацистской партии, преуспевающего фабриканта, спасшего во время Второй мировой войны почти 1200 евреев.', 'Стивен Спилберг', 1993),
(5, '1+1', 'Пострадав в результате несчастного случая, богатый аристократ Филипп нанимает в помощники человека, который менее всего подходит для этой работы, — молодого жителя предместья Дрисса, только что освободившегося из тюрьмы. Несмотря на то, что Филипп прикован к инвалидному креслу, Дриссу удается привнести в размеренную жизнь аристократа дух приключений.', 'Оливье Накаш', 2011),
(6, 'Король Лев', 'У величественного Короля-Льва Муфасы рождается наследник по имени Симба. Уже в детстве любознательный малыш становится жертвой интриг своего завистливого дяди Шрама, мечтающего о власти.\r\n\r\nСимба познаёт горе утраты, предательство и изгнание, но в конце концов обретает верных друзей и находит любимую. Закалённый испытаниями, он в нелёгкой борьбе отвоёвывает своё законное место в «Круге жизни», осознав, что значит быть настоящим Королём.', 'Роджер Аллерс', 1994),
(7, 'Леон', 'Профессиональный убийца Леон, не знающий пощады и жалости, знакомится со своей очаровательной соседкой Матильдой, семью которой расстреливают полицейские, замешанные в торговле наркотиками. Благодаря этому знакомству он впервые испытывает чувство любви, но…', 'Люк Бессон', 1994),
(8, 'Начало', 'Кобб — талантливый вор, лучший из лучших в опасном искусстве извлечения: он крадет ценные секреты из глубин подсознания во время сна, когда человеческий разум наиболее уязвим. Редкие способности Кобба сделали его ценным игроком в привычном к предательству мире промышленного шпионажа, но они же превратили его в извечного беглеца и лишили всего, что он когда-либо любил. \r\n\r\nИ вот у Кобба появляется шанс исправить ошибки. Его последнее дело может вернуть все назад, но для этого ему нужно совершить невозможное — инициацию. Вместо идеальной кражи Кобб и его команда спецов должны будут провернуть обратное. Теперь их задача — не украсть идею, а внедрить ее. Если у них получится, это и станет идеальным преступлением. \r\n\r\nНо никакое планирование или мастерство не могут подготовить команду к встрече с опасным противником, который, кажется, предугадывает каждый их ход. Врагом, увидеть которого мог бы лишь Кобб.', 'Кристофер Нолан', 2010),
(9, 'Бойцовский клуб', 'Терзаемый хронической бессонницей и отчаянно пытающийся вырваться из мучительно скучной жизни, клерк встречает некоего Тайлера Дардена, харизматического торговца мылом с извращенной философией. Тайлер уверен, что самосовершенствование — удел слабых, а саморазрушение — единственное, ради чего стоит жить.\r\n\r\nПройдет немного времени, и вот уже главные герои лупят друг друга почем зря на стоянке перед баром, и очищающий мордобой доставляет им высшее блаженство. Приобщая других мужчин к простым радостям физической жестокости, они основывают тайный Бойцовский Клуб, который имеет огромный успех. Но в концовке фильма всех ждет шокирующее открытие, которое может привести к непредсказуемым событиям…', 'Дэвид Финчер', 1999),
(10, 'Интерстеллар', 'Когда засуха приводит человечество к продовольственному кризису, коллектив исследователей и учёных отправляется сквозь червоточину (которая предположительно соединяет области пространства-времени через большое расстояние) в путешествие, чтобы превзойти прежние ограничения для космических путешествий человека и переселить человечество на другую планету.', 'Кристофер Нолан', 2014);

ALTER TABLE `film`
ADD PRIMARY KEY (`id`);

ALTER TABLE `film`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```
