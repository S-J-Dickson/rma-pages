# create-rma-pages

Welcome to the GivEnergy create-rma-pages technical task.

This task uses Laravel 9 and Vue 3.

Instructions for this technical task are found within the application itself.
Simply build the application and visit its URL in a web browser.

The setup instructions are intentionally vague. 
Please refer to the Laravel 9 documentation if you are unsure how to proceed.

This task should take no more than a few hours. If you have any questions, 
please email whoever provided this task to you.

# Getting Started

The repo is using Laravel Sail and has been developed on Unbuntu but as Laravel Sail uses docker technology the repo should work on all operating systems. 


1. Install Docker
2. Clone Repo
3. Cd in repo
4. Execute script

``docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs``
    
    
### Operations

1. ```./vendor/bin/sail up```
2. ``` ./vendor/bin/sail composer install```
3. ``` ./vendor/bin/sail artisan migrate```
4. ``` ./vendor/bin/sail npm install ```
5. ``` ./vendor/bin/sail npm run build ```
6. ``` ./vendor/bin/sail npm run dev ```

    
### Troubleshooting
 
 Stop all containers, other containers may be sharing same port not allowing the application to run
 
 1. ``docker stop $(docker ps -aq)``
 
**Error : service "laravel.test" is not running container #1**

1. Run ```docker ps -a```
2. Get container id of ``sail-8.2/app``
3. run ```docker start <CONTAINER_ID HERE>```

### Overview


### Tests


### Designs
See brief.


### Improvements



