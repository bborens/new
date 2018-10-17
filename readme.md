# Creating Laravel Webapp #
## Step by Step ##

#### some notes ####
the .gitignore file is preloaded with laravel.
I am converting a Django project to Laravel from the ground up. 
This includes creation and implementation of media, user, and user-data-submitted Database. 
Database will be MYSQL for vagrant development and Postgres when deployed on Laravel's forge. 

#### services used ####

S3 or other cloud storage containers | user media database. 
cloud.telestream.net | video encoding. 
ngrok.io | SSH with webhooks (or use rcode with vscode to ssh )
algolia w/ laravel/scout | index 
mailtrap.io | set up email tests

### Install Laravel Project with Composer ###

[sapp] is projectname variable. Wait until Downloaded, then vagrant into Virtual homestead box. 
    
        user@home/code/$:composer create-project laravel/laravel [sapp]
        user@Homestead$ vagrant up
        user@Homestead$ vagrant ssh
    
### Update NPM / latest nodejs off the bat to make sure everything is running smooth/compiling ###

Install this script to install nvm to update npm. 

        vagrant@homestead:~/code/cheftubeapp$ curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.11/install.sh | bash

Close and Reopen Terminal to use nvm.
    
        vagrant@homestead:~$ nvm install --latest-npm
        vagrant@homestead:~/code/cheftubeapp$ sudo npm install -g npm
        vagrant@homestead:~/code/cheftubeapp$ npm rebuild node-sass
        vagrant@homestead:~/code/cheftubeapp$ npm install
        vagrant@homestead:~/code/cheftubeapp$ npm run dev
    
Update git repositry here for updated fallback VM. 

### Create Authentication ###
####Php Artisan to generate migrations, scaffolding, and appropriate layouts####

    Make Authentication files.

        vagrant@homestead:~/code/sapp$ php artisan make:auth
            Authentication scaffolding generated successfully.

    Migrate to database created during homestead/vagrant provisioning 

        vagrant@homestead:~/code/sapp$ php artisan migrate

#### Feel free to setup mailtrap.io box to test ####
Input user and pass inside .env file from mailtrap.io inbox dashboard. 

### Create a 'Channel' ###
#### Generate a model && migration for channel database info ####

    Make model folder. -m flag creates migration as well. 

        vagrant@homestead:~/code/sapp$ php artisan make:model Models\\Channel -m
                            Model created successfully.
                            Created Migration: 2018_10_17_213015_create_channels_table

                            
#### Edit register.blade.php ####
    