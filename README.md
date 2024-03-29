# Laminas Fundamentals
Zend by Perforce Training

## Lab Setup Instructions

### Download or Clone the Source Code
* Create a new directory for this course
  * In this instruction guide we'll call it `/path/to/course`
* Clone or copy this repository to your local computer
  * If you have `git` installed, proceed as follows
    * Open a terminal window / command prompt
    * Change directory to `/path/to/course`
    * Clone the repository:
```
git clone https://github.com/zendtech/Laminas-Level-1-Attendee.git
```
  * If you do not have `git` installed, proceed as follows:
    * Create a directory `/path/to/course/Laminas-Level-1-Attendee`
    * Download the ZIP file from this URL:
      * [https://github.com/zendtech/Laminas-Level-1-Attendee/archive/refs/heads/master.zip](https://github.com/zendtech/Laminas-Level-1-Attendee/archive/refs/heads/master.zip)
    * Unzip the ZIP file into `/path/to/course/Laminas-Level-1-Attendee`

### Install Docker and Docker Compose
#### Install Docker
* If you are running Windows, start here:
  * [https://docs.docker.com/docker-for-windows/install/](https://docs.docker.com/docker-for-windows/install/).
* If you are on a Mac, start here:
  * [https://docs.docker.com/docker-for-mac/install/](https://docs.docker.com/docker-for-mac/install/).
* If you are running Linux, start here:
  * Install [Docker](https://docs.docker.com/engine/install/)

#### Install Docker Compose
* If you installed either _Docker Desktop for Windows_ or _Docker Desktop for Mac_ Docker Compose is already included
* If you are running Linux, follow these instructions:
  * [https://docs.docker.com/compose/install/](https://docs.docker.com/compose/install/#install-compose-on-linux-systems)

### Run the Course Container
* Open a terminal window / command prompt
* Change directory to `/path/to/course/Laminas-Level-1-Attendee`
* Execute this command:
```
docker-compose up -d
```
* You will see a series of downloads as the container is built
* You will also see a series of shell script commands as supporting course software is installed
* The download and build process only runs the first time
* To make sure the container is running, type this command:
```
docker container ls
```

### Initialize Course Container Software
* Open a terminal window / command prompt
* Change directory to `/path/to/course/Laminas-Level-1-Attendee`
* Execute this command:
```
docker exec laminas_1 /bin/bash -c "/tmp/init_apps.sh"
```

### Access the Container's Web Server
* Open a browser from your local computer
* Open this URL: `http://localhost:8888/`
* Or: `http://10.10.10.10/`

### Stop the Course Container
* Open a terminal window / command prompt
* Change directory to `/path/to/course/Laminas-Level-1-Attendee`
* Execute this command:
```
docker-compose down
```

### Troubleshooting
* To stop a container, first get the container ID by running `docker container ls`
  * Then issue this command:
```
docker container stop CONTAINER_ID
```
* To remove a container, first get the container ID by running `docker container ls`
  * Then issue this command:
```
docker container rm CONTAINER_ID
```
* To see images created use this command:
```
docker image ls
```
* To remove an image, first the the image ID by running `docker image ls`
  * Then issue this command:
```
docker image rm IMAGE_ID
```
* Free up disk space, issue this command:
```
docker system prune
```
* If you get a message saying that `port 8888` is already in use, stop any running containers, and restart this one
  * If you still get the message, modify the `docker-compose.yml` file and change the port from `8888` to something else (e.g. try `9999`)

## Database Access
Username: `laminas`
Password: `password`
To access phpMyAdmin (from your host computer browser):
* `http://localhost:8888/phpmyadmin`, or
* `http://10.10.10.10/phpmyadmin`


## Admin Tools
Two admin command line tools have been provided to help with the above commands:
* Linux or Mac: `./admin.sh`
* Windows: `admin.bat`


## Version History

### 0.0.1 : Initial Check in
* doug@unlikelysource.com: initial check-in
  * Updated all ZF apps to Laminas
  * Added Docker infrastructure
### 0.0.2 : Done (for now)
