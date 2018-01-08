# SilverStripe Boilerplate

The SilverStripe Boilerplate aims to make it easier to kick of a new SilverStripe project, just download it and get started.

## Maintainers
- Bram de Leeuw [@bramdeleeuw](http://twitter.com/bramdeleeuw)

### Original Fork
- [Zauberfisch/silverstripe-boilerplate](https://github.com/Zauberfisch/silverstripe-boilerplate) [@Zauberfisch](http://twitter.com/Zauberfisch)

## how to install

    # create the project
    # make sure to point to the new remote afterwards
    composer create-project bramdeleeuw/recipe-boilerplate ./myproject dev-master
    
    # install js modules
    cd myNewProject/mysite
    yarn install
    

## configuration (with `.env`)

You can move the `.env.example` to a file named `.env`, 
the file should look like this (more infos at https://docs.silverstripe.org/en/4/getting_started/environment_management/)

**this method is recommended for database and environment configuration, because you can easily exclude it from version control**
    
    # What kind of environment is this: development, test, or live (ie, production)?
    SS_ENVIRONMENT_TYPE="dev"
    
    # Database settings
    SS_DATABASE_SERVER="localhost"
    SS_DATABASE_USERNAME="USER"
    SS_DATABASE_PASSWORD="PASSWORD"
    SS_DATABASE_NAME="DB_NAME"

    # Configure a default username and password to access the CMS on all sites in this environment.
    SS_DEFAULT_ADMIN_USERNAME="admin"
    SS_DEFAULT_ADMIN_PASSWORD="password"

    # Make sure the command line knows what the site url is
    SS_BASE_URL="http://example.com"


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
