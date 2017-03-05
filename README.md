VirtStock
==========

A stock exchange simulator, simulating the real stock exchange, developed as a web application game.

Clone
=====

Create a project folder and clone the repository to that folder.

```
$ mkdir myStock
$ cd myStock
$ git clone https://github.com/sriram-koushik/VirtStock
$ cd VirtStock/server
```
Setup server
=========
Pull the xampp docker

```
$ docker pull tomsik68/xampp
```

Run the docker-xampp using the command to start apache server and mysql server. (Please change the settings such as port number if needed)

```
$ docker run --name myXampp -p 41061:22 -p 41062:80 -d -v ~/<path_to_project_folder>/VirtStock/server:/www tomsik68/xampp
```
Manage server
=============
<li>Open up the XAMPP interface using http://localhost:41062/phpmyadmin/.
<li>Create database called psgstock and paste the contents in  psgstock.sql file.
<li>This will setup all the tables in the database and you are all set.

Start the game
===========
To connect to the login page, visit this URL: http://localhost:41062/www/login.php


Thanks
=======
Visit [docker-xampp](https://hub.docker.com/r/tomsik68/xampp/) for any further clarifications regarding xampp settings.
