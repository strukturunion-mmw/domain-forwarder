# strukturunion gmbh - Domain Forwarder

A lightweight forwarding/routing service for web requests to  
surplus domains on to mapped web services. 

We use this little Laravel based tool easily map surplus domains  
we have registered and redirect web traffic to our operational  
sites. The tool is deployed on GoogleCloudRun with routing  
information stored on a seprate SQL Server.

👨🏻‍💻 strukturunion gmbh | www.strukturunion.de

## Installation
- Add sail Bash Alias by runnning `echo "alias sail='[ -f sail ] && bash sail || cd ${PWD}/src && bash ./vendor/bin/sail'" >> ~/.bashrc`
- Restart Shell
- run `set-me-up` to setup default .env files and prepare Laravel Sail
- bring up Service to build Laravel Sail containers with `sail up -d`
- run `sail composer install`
- run `sail artisan migrate:fresh --seed` to seed local database

## Usage
- run `sail up -d` or `up` to spin up local environment
- Take down with `sail down` or `down`
- To deploy use GoogleCloud Plugin and make sure to run **PREFLIGHT** script  

## Notes
- *internal*: After delpoyment check traffic assigment at https://console.cloud.google.com

<br><hr>
// ITEOTWAWKI  
// It's the end of the World as we know it 🤔  
// But I feel fine!