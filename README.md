# SilverStripe Boilerplate

The SilverStripe Boilerplate aims to make it easier to kick of a new SilverStripe project, just download it and get started.

## Maintainers
- Bram de Leeuw [@bramdeleeuw](http://twitter.com/bramdeleeuw)

## how to install

    # create the project
    # make sure to point to the new remote afterwards
    composer create-project bramdeleeuw/recipe-boilerplate ./myproject dev-master
    

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

    app
    |-- src // your php code in here
    |-- client // your frond end code goes in here
    |   |-- src
    |   |   |-- js // your js files and modules
    |   |   |-- styles // your sass files and modules
    |   |-- dist // compiled code
    |-- images // project images
    |-- templates // your templates, that others put into themes/mytheme/templates
    |-- .gitignore
    |-- .htaccess
    |-- _config.php
    |-- package.json
    |-- webpack.mix.js
    |-- yarn.lock
