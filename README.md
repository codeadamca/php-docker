# Using Docker to Setup a Basic Lamp Environment

A basic example of setting up a LAMP stack from scratch using Docker. 

Create a file in your project directory called ```docker-compose.yml``` and add the following Docker settings:

```yml
version: '3'
services:
  db:
    image: mysql:latest
    environment:
      MYSQL_DATABASE: lamp_demo
      MYSQL_USER: lamp_demo
      MYSQL_PASSWORD: password
      MYSQL_ALLOW_EMPTY_PASSWORD: 1
    volumes:
      - "./db:/docker-entrypoint-initdb.d"
    networks:
      - lamp-docker
  www:
    depends_on:
      - db
    image: php:8.1.1-apache
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
    ports:
      - 8001:80
    environment:
      - PMA_HOST=db
      - PMA_PORT=3306
    networks:
      - lamp-docker
networks:
  lamp-docker:
    driver: bridge
```

Using a terminal, navigate to the same folder as your ```docker-compose.yml``` file and run the following command:

```
docker-compose up
```

To shut the container down push ```CTRL C``` and then run the folloeing command:

```
docker-composer down
```

## Tutorial Requirements:

* [Visual Studio Code](https://code.visualstudio.com/)
* [Docker](https://www.docker.com/)

<a href="https://codeadam.ca">
<img src="https://codeadam.ca/images/code-block.png" width="100">
</a>
