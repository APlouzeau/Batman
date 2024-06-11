# **Deploy on distant linux server**

## 1/ Connect to the server

Windows :

open command prompt (windows + R, type cmd) :

    
    ssh root@IPtarget
     
    
where root = user  
IPtarget = IP adress of the server 
When ask, enter password

## 2/ first installation
update paquets

    sudo apt update
install necessary package for web services : Apache2, Mariadb, PHP

    sudo apt install apache2 php libapache2-mod-php mariadb-server php-mysql
    sudo apt install php-curl php-gd php-intl php-json php-mbstring php-xml php-zip

### First connection to mariadb
        sudo mysql
        ALTER USER root@localhost IDENTIFIED BY 'enter_password';
        exit
        mysql_secure_installation

Follow steps

Try to connect :
    
    mysql -u root -p
    enter_password

If connect is successful

    SHOW DATABASES;

You'll have the list of the databases existing on the server

Verify if apache2 and maria db are start

    sudo service mariadb status
    sudo service apache2 status

If not :

    sudo service mariadb start
    sudo service apache2 start
  
## 3/ Prepare website
### 3.1/ command lines
Copy files from website on the server

Move to folder of configuration

    cd /etc/apache2/sites-available

Copy existing file

    sudo cp 000-default.conf batman.conf

Modify file

    sudo nano batman.conf

Go to annexe and make changes

### 3.2/ Graphic interface : 
Install WinSCP (windows)

Configure server access (like step 1)

Copy /etc/apache2/sites-available/000-default.conf in eyo.conf

Modify file like the screenshots in annexe

Add website to the server

    sudo a2ensite sopeyo.conf

## 4/ Database :

open command prompt in the folder where you want to save your database

    mysqldump -u batman -p –add-drop-database –databases batman > dump_batman.sql 

Copy this file on the server

Open command prompt on server in folder with the dump file

    mysql -u batman -p batman < dump_batman.sql