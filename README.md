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

