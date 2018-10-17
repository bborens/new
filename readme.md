# Creating Laravel Webapp #
## Step by Step ##

#### some notes ####
the .gitignore file is preloaded with laravel.

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
    
Update git repositry with 




