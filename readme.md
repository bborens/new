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
#### Php Artisan to generate migrations, scaffolding, and appropriate layouts ####

Make Authentication files.

        vagrant@homestead:~/code/sapp$ php artisan make:auth
            Authentication scaffolding generated successfully.

Migrate to database created during homestead/vagrant provisioning 

        vagrant@homestead:~/code/sapp$ php artisan migrate
            Migrating: 2014_10_12_000000_create_users_table
            Migrated:  2014_10_12_000000_create_users_table
            Migrating: 2014_10_12_100000_create_password_resets_table
            Migrated:  2014_10_12_100000_create_password_resets_table

#### Feel free to setup mailtrap.io box to test ####
Input user and pass inside .env file from mailtrap.io inbox dashboard. 

### Create a 'Channel' ###
#### Generate a model && migration for channel database info ####

Make model folder. -m flag creates migration as well. 

        vagrant@homestead:~/code/sapp$ php artisan make:model Models\\Channel -m
                            Model created successfully.
                            Created Migration: 2018_10_17_213015_create_channels_table

Migrate 
        vagrant@homestead:~/code/sapp$ php artisan migrate
                            Migrating: 2018_10_17_213015_create_channels_table
                            Migrated:  2018_10_17_213015_create_channels_table

#### edit user.php Model ####

Insert Channels function inside of user.php 

        public function channel()
        {
            return $this->hasMany(Channel::class);
        }

Move user.php inside new Models folder /app/http/models
Don't forget to change namespace in user.php App/Models

        namespace App\Models;

Also update user.php location in config/auth.php

        'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User\::class,
        ],

Also update registercontroller.php

        use App\Models\User;

#### edit Models/Channel.php ####

Create Function

            class Channel extends Model
                    {
                        protected $fillable = [
                            'name',
                            'slug',
                            'description',
                            'image_filename',
                        ];

                        public function user()
                        {
                            return $this->belongsTo(User::class);
                        }
                    }

            
#### Edit RegisterController.php ####

        protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->channel()->create([
            'name' => $datal['channel_name'],
            'slug' => uniqid(true),
        ]);

        return $user;
    }

and

         return Validator::make($data, [
            'name' => 'required|string|max:255',
            'channel_name' => 'required|max:255|unique:channels,name',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

#### Edit register.blade.php ####

Div Snip for register.blade.php

         <div class="form-group row">
                            <label for="channel_name" class="col-md-4 col-form-label text-md-right">{{ __('Channel name') }}</label>

                            <div class="col-md-6">
                                <input id="channel_name" type="text" class="form-control{{ $errors->has('channel_name') ? ' is-invalid' : '' }}" name="channel_name" value="{{ old('channel_name') }}" required autofocus>

                                @if ($errors->has('channel_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('channel_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

### Setup Queueing for uploading profile pictures in background ###


#### basic queueing ####

Create Jobs table and Failed Jobs Table

            vagrant@homestead:~/code/sapp$ php artisan queue:table
                Migration created successfully!
            vagrant@homestead:~/code/sapp$ php artisan queue:failed-table
                Migration created successfully!

Migrate to create tables on SQL

            vagrant@homestead:~/code/sapp$ php artisan migrate
                Migrating: 2018_10_17_221525_create_jobs_table
                Migrated:  2018_10_17_221525_create_jobs_table
                Migrating: 2018_10_17_221550_create_failed_jobs_table
                Migrated:  2018_10_17_221550_create_failed_jobs_table
    
Larger jobs done here. You can now create, dispatch, and uploads jobs. 

##### can also queue index searching #####


#### Create Navigation Partial ####

Create layouts/partials
Create _navigation.blade.php 
Paste nav snip inside.


#### Create Header Partial ####


Create _head.blade.php 
Paste header snip inside.

Include partials back into app.blade.php code

#### Create ViewComposers ####

Create ViewComposers folder inside Http folder

inside folder, create NavigationComposer.php

        <?php

            namespace App\Http\ViewComposers;

            use Auth;
            use Illuminate\View\View;

            class NavigationComposer
            {
                public function compose(View $view)
                {
                    if (!Auth::check()) {
                        return;
                    }

                    $view->with('channel', Auth::user()->channel->first());
                }
            }

Create provider to work with composer. 

        vagrant@homestead:~/code/sapp$ php artisan make:provider ComposerServiceProvider
                                    Provider created successfully.

Edit Provider

          public function boot()
                        {
                            view()->composer(
                                'layouts.partials._navigation',
                                \App\Http\ViewComposers\NavigationComposer::class
                            );
                        }

Register Provider in Config/app.php

Add to nav drop down html to generate unique URL for channel. 

        <a class="dropdown-item" href="{{ url('/channel/' . $channel->slug) }}">Your Channel</a>
        <a class="dropdown-item" href="{{ url('/channel/' . $channel->slug . '/edit') }}">Channel settings</a>

### Create Channel Settings ### 

#### Basic information for channel settings ####
route/web.php 
note need to make controller.

        Route::group(['middleware' => ['auth']], function () {
                Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit');
                Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update');
        });

Create controller

        vagrant@homestead:~/code/sapp$ php artisan make:controller ChannelSettingsController
                        Controller created successfully.

Create folders views/channel/settings
Markup edit.blade.php for channel settings 

Create Requests 

        vagrant@homestead:~/code/sapp$ php artisan make:request ChannelUpdateRequest
        Request created successfully.

Update ChannelUpdateRequests.php

          public function rules()
                {
                    $channelId = Auth::user()->channel->first()->id;

                    return [
                        'name' => 'required|max:255|unique:channels,name' . $channelId,
                        'slug' => 'required|max:255|alpha_num|unique:channels,slug',
                        'description' => 'max:1000',
                    ];
                }

Create Channel Policy

            vagrant@homestead:~/code/sapp$ php artisan make:policy ChannelPolicy
                Policy created successfully.
