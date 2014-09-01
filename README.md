Gearman Monitor
===============

Gearman Monitor provides a dashboard to show gearman servers, queues and workers.

This project was inspired by [yugene/Gearman-Monitor](https://github.com/yugene/Gearman-Monitor).

## Installation
The following instructions outline installation using Composer. If you don't
have Composer, you can download it from [http://getcomposer.org/](http://getcomposer.org/)

```Bash
composer install
#Copy default configuration file as config.yml
cp ./src/GearmanMonitor/Resources/config/config.yml.dist ./src/GearmanMonitor/Resources/config/config.yml
```

## Configuration
Open config.yml file and change the listed details to fit your needs for example:

```YML
config.GearmanMonitor:
    servers:
        0:
            name: "Production Gearman"
            address: "172.16.0.1:4730"
        1:
            name: "Development Gearman"
            address: "127.0.0.1:4730"
```