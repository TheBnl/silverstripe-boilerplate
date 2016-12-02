# SilverStripe Boilerplate

The SilverStripe Boilerplate aims to make it easier to kick of a new SilverStripe project, just download it and get started.

It is just a collection of config defaults, tools and modules (sass, _ss_environment.php, h5bp, ...) one always needs.    

As of SilverStripe 3.1 this boilerplate requieres [composer](http://getcomposer.org/).

## Maintainers
- Bram de Leeuw [@bramdeleeuw](http://twitter.com/bramdeleeuw)

### Original Fork
- [Zauberfisch/silverstripe-boilerplate](https://github.com/Zauberfisch/silverstripe-boilerplate) [@Zauberfisch](http://twitter.com/Zauberfisch)

## how to install

    # clone the project
    git clone https://github.com/TheBnl/silverstripe-boilerplate.git "myNewProject"
    
    # install composer modules
    cd myNewProject/
    composer update
    
    # install js modules
    cd myNewProject/mysite
    npm install
    

## configuration (with `_ss_environment.php`)

create a file named `_ss_environment.php`, you can place that inside the repo, parent folder or in the parent parent folder.  
the file should look like this (more infos at http://doc.silverstripe.org/sapphire/en/topics/environment-management)

**this method is recommended for database and environment configuration, because you can easily exclude it from version control**
    
    <?php
    
    <?php
    // What kind of environment is this: development, test, or live (ie, production)?
    define('SS_ENVIRONMENT_TYPE', 'dev');
    define('GA_CODE', 'GOOGLE_ANALYTICS_CODE');
    // (Set these in your local environment)
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);


    // Database connection
    define('SS_DATABASE_SERVER', 'localhost');
    define('SS_DATABASE_USERNAME', 'YOUR_DB_USER');
    define('SS_DATABASE_PASSWORD', 'YOUR_DB_USER_PASSWORD');
    define('SS_DATABASE_NAME', 'YOUR_DB_NAME');

    // Configure a default username and password to access the CMS on all sites in this environment.
    define('SS_DEFAULT_ADMIN_USERNAME', 'YOUR_ADMIN_NAME');
    define('SS_DEFAULT_ADMIN_PASSWORD', 'YOUR_ADMIN_PASSWORD');

    global $_FILE_TO_URL_MAPPING;
    $_FILE_TO_URL_MAPPING['/path/to/your/site/httpdocs'] = 'http://hostename.wherever/';


**now just run mysite.com/dev/build and you are done, no further setup required, you are ready to go**
    
## how to use

This boilerplate is based on the assumption that the project will be a customized website/webapp.
So you might notice there is no theme in the themes folder, the plan is to add all templates, javascript and css/scss into mysite.
Which has the benefit of having the whole project at one place, not separated into 2 folders.

### file structure

    mysite
    |-- code // your php code in here
    |-- css // the css in here is generated from the files in /scss
    |-- images // project images
    |-- javascript // all your self written javascript
    |-- scss // your scss, which gets processed and written into /css
    |-- templates // your templates, that others put into themes/mytheme/templates
    |-- thirdparty // all thirdparty code goes in here (jquery plugins)
    |-- .gitignore
    |-- _config.php
    |-- Gemfile // all gem requirements to work with compass and foundaton
    |-- config.rb // config file for sass

### SASS / SCSS / Javascript

Compiling SASS and JS is now done by gulp, you need to register the files in the bundle.js document located in the javascript folder. To compile simply run `gulp` or `gulp watch`.

### Lazy Loading Images

This boilerplate comes packed with a bower dependency on [Lazy Load XT](https://github.com/ressio/lazy-load-xt), to easily add lazy loaded images to your templates use the following method:
 
    $Image.Lazy('Fill', 600, 200)

This method produces the following code with fallbacks for non JS browsers:

     <img class="lazy" data-src="image.jpg" alt="image title" width="image_width" height="image_height">
     <noscript><img src="image.jpg" alt="image title" width="image_width" height="image_height"></noscript>
