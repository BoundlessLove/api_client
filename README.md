## Purpose of api_client code
Using the authorisation provided by the BoundlessLove/oauth_server project's code, it connects and communicates with the BoundlessLove/api_server2 project's code. 

*Note: For its use, a file called config.php needs to be added, which contains the ApiKey needed to authenticate to the API Server. This is needed in addition to the oauth_server code's authorisation, in order to communicate with the BoundlessLove/api_server2.*

## Pre-Requisite: Setup a server running on http://localhost:8080
Apache was used. The process used was as following:
### a. Verify Apache has php module Enabled
#### i. Run 'apache2ctl -M | grep php'. Outcome should show something like 'php_module (shared)'. If not continue with below steps.
#### ii. Run following commands:
sudo apt install
sudo apt install libapache2-mod-php
sudo a2enmod php
sudo systemctl restart apache2


### b. Setup Virtual host
#### i. Run 'sudo nano /etc/apache2/sites-available/api_client.conf'
#### ii. Add something like:
<VirtualHost *:8080

    ServerName api_client.com
    
    ServerAdmin webmaster@localhost
    
    DocumentRoot /home/administrator@internal.systematicdefence.tech/projects/api_client
    
    <Directory /home/administrator@internal.systematicdefence.tech/projects/api_client>
    
        Options Indexes FollowSymLinks
        
        AllowOverride All
        
        Require all granted
        
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    
    CustomLog ${APACHE_LOG_DIR}/access.log combined
    
</VirtualHost>

#### iii. In order for Apache to know how to handle '.php' files, add this also to the api_client.conf file:

*<FilesMatch \.php$> SetHandler application/x-httpd-php < / FilesMatch>*

#### iv. In order for Apache to know default starting page, also add to api_client.conf file:
DirectoryIndex index.php index.html

#### v. Activate config with 'sudo a2ensite my-site.conf'
#### vi. Verify sytax of api_client.conf with 'sudo apache2ctl configtest'
#### vii. Provide correct permissions - In Linux, for Apache to serve files from a directory like /home/administrator@internal.systematicdefence.tech/projects/api_server2, it needs **execute (`x`) permission** on **every parent directory** in that path and to the folder itself. Hence, run following commands:
##### --Give others access to traverse the directories that lead to the webroot. Note it does not expose file contents.
sudo chmod o+x /home
sudo chmod o+x /home/administrator@internal.systematicdefence.tech
sudo chmod o+x /home/administrator@internal.systematicdefence.tech/projects
##### --Give Apache the ability to execute files in the web root api_client:
sudo chmod -R 755 /home/administrator@internal.systematicdefence.tech/projects/api_server2

#### viii. Verify that Apache has the required access to api_client webroot via cmd 'ls -ld':
Outcome: drwxr-xr-x 4 administrator@internal.systematicdefence.tech www-data

#### ix Reload Apache with 'sudo systemctl reload apache2'
#### x. Try accessing site via `http://localhost:8080` 

## License
This project is under a custom license. Use of the code requires **explicit written permission from the author**. See the [LICENSE](./LICENSE) file for details.

## Versions
### v0.1 
27 Aug 2025 98:48 PM- API Client created. secret key moved to file in public root, which cannot be accessed directly. Git setup. App working with API server running on Apache.

