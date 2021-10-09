@echo off
SET USAGE="Usage: init.sh up|down|build|ls|shell"
SET CONTAINER="laminas_1"

IF "%~1"=="" GOTO :usage

IF "%1"=="up" GOTO :up
IF "%1"=="start" GOTO :up
GOTO :opt2
:up
docker-compose up -d %2
GOTO:EOF

:opt2
IF "%1" =="down" GOTO :down
IF "%1"=="stop" GOTO :down
GOTO :opt3
:down
docker-compose down
takeown /R /F *
del 1
GOTO:EOF

:opt3
IF "%1"=="build" GOTO :build
GOTO :opt4
:build
docker-compose build %2
GOTO:EOF

:opt4
IF "%1"=="ls" GOTO :ls
GOTO :opt5
:ls
docker container ls
GOTO:EOF

:opt5
IF "%1"=="shell" GOTO :shell
GOTO :done
:shell
docker exec -it %CONTAINER% /bin/bash
GOTO:EOF

:done
echo "Done"

:usage
echo %USAGE%
echo "You entered %1 and %1"
GOTO:EOF
