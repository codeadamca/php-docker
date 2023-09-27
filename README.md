# Using Docker to Setup a Basic Lamp Environment

A basic example of setting up a LAMP stack from scratch using Docker. 

Create a file in your project directory called `docker-compose.yml` and add the following Docker settings:

```yml
version: '4'
services:
  db:
    image: mysql:latest
    environment:
      MYSQL_DATABASE: lamp_demo
      MYSQL_USER: lamp_demo
      MYSQL_PASSWORD: password
      MYSQL_ROOT_PASSWORD: password
    volumes:
      - "./db:/docker-entrypoint-initdb.d"
    networks:
      - lamp-docker
  www:
    depends_on:
      - db
    image: sohmc/php-mysqli:8.1-apache
    volumes:
      - "./:/var/www/html"
    ports:
      - 80:80
      - 443:443
    networks:
      - lamp-docker
  phpmyadmin:
    depends_on:
      - db
    image: phpmyadmin/phpmyadmin
    environment:
      PMA_HOST: db
      MYSQL_ROOT_PASSWORD: password
    ports:
     - 8080:80
    networks:
      - lamp-docker
networks:
  lamp-docker:
    driver: bridge
```

Using a terminal, navigate to the same folder as your `docker-compose.yml` file and run the following command:

```sh
docker-compose up
```

To shut the container down push `CTRL C` and then run the folloeing command:

```sh
docker-composer down
```

### Good Job!

Open your browser and navigate to http://localhost 

Apache and PHP 8.1 should be woking and the output of index.php should be shown (a couple of generic bolg posts)
You can also try http://localhost/phpinfo.php to see the output of that script (PHP_INFO).

phpmyadmin should also be available browsing to http://localhost:8080

Login as root:password for full access or as lamp_demo:password for limited access to the lamp_demo database only.

Make changes as needed for your particular project.

Enjoy!

***

## Mac OSX Monterrey Users

By default Apache comes bundled with Mac OS X but it’s deactivated. So my assumption is you simply started Apache on the system and even set it to come up automatically when the system starts up or reboots. Check if Apache is running under the user \_www with:

```sh
sudo lsof -i:80 
```

To stop the built-in Apache server in Mac OS X use this command:

```sh
sudo apachectl -k stop
```

Then just enter your administrator password. And to prevent Apache from coming up again on if your system reboots/restarts just run this launchctl unload command (you’ll need your administrator password again):

```sh
sudo launchctl unload -w /System/Library/LaunchDaemons/org.apache.httpd.plist
```

When that’s all done, you can check the output of sudo lsof -i:80 to confirm if the built-in Apache web server in Mac OS X should is stopped and disabled.
