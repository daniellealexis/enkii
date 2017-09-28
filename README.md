# enkii


## Deploy Script
The python script fabfile.py is used to deploy the compiled development or
production build to the public server and perform various other tasks.

### Dependencies
The script requires [Python 2.7](https://www.python.org/downloads/) 
along with the [Fabric](http://www.fabfile.org/) python package. 
To install the Fabric package run the following command from a 
terminal:

```
pip install fabric
```

### Script Commands
Use the `fab` command from a terminal to execute various deploy
script commands. Run `fab -l` to list all available commands and
`fab -d <command name>` to get help on a specific command.

## Initialization Steps
1. php artisan db:drop
1. php artisan migrate
1. php artisan passport:install
1. php artisan db:seed

**db:seed** will produce an OAuth token for use with [postman](https://www.getpostman.com/) 
or any other REST API testing tools in the **postman_token.txt** file.
The token must be all on one line to work. The token should be placed 
in the **Authorization** header:

```
Authorization: Bearer <token>
```

Alternatively you can use the **fab** command **init** to initialize your local 
database and passport environment.