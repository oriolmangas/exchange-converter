Simple Exchange converter
=========================


README AND INSTALLATION NOTES
-----------------------------


0- Example of this code
-----------------------

You can see this code in production at:

http://www.oriolmangas.com/exchange-converter/

The website is responsive with Bootstrap 3.2. Responsive in desktop or tablet or mobile phone.

For charts I used AMCHARTS, a javascript free code from http://www.amcharts.com.


1- Download the code
--------------------

Download it:
https://bitbucket.org/oriolmangas/exchange-converter/downloads

Or clone it:
git clone https://oriolmangas@bitbucket.org/oriolmangas/exchange-converter.git


2- Create the database
----------------------

* Create a new MySQL database called "exchange" or whatever you want.
* In the folder SQL there is the file exchange.slq file
* Import the file exchange.slq inside the exchange database created.
* Create a user with access to this database.

3- Configure the application
----------------------------

As simple as open the file config.php and introduce the name of the host, user, password and database name.

The default values are:

    /** MySQL database name */
     define('DB_NAME', 'exchange');  

    /** MySQL database username */
     define('DB_USER', 'root');  

    /** MySQL database password */
     define('DB_PASSWORD', '');  

    /** MySQL hostname */
     define('DB_HOST', 'localhost');


4- Files and folders
--------------------

* index.php, currencies-evolution.php and download-contact.php are the main pages of the website.

* lib\* - contain the object model of currency, used for manage the currencies in the website.

* includes\database\*.* - contains he files to manage the database

  includes\database\database_get_currencies.php - Get the currencies for the conversor in index.php
  includes\database\database_json.php - return via json mysql values for the charts
  includes\database\database_update.php - update the database
    
* includes\database\*.* - contains the header and footer

* web\* contains all the css, js, fonts and img.

  web\js\*.* in this folder there are some files to manage the charts.

  web\js\serial.js and amcharts,js are files from amcharts.com free plugin. (www.amcharts.com)
  web\js\currencyfunctions.js manages the chars in the website.
  web\js\load_charts*.js these files are used to load charts when the page is loaded.


5- Updating the database to get the lasts values
------------------------------------------------

The application auto update itself every day the first time when someone visit the index.php.

If you want to update the data base to be sure the database is updated then program a cron for the file 

* \includes\database\database_update.php 
( The European Central Banc update values daily (work days) between 2.15 p.m. and 3.00 p.m. CET ) 

The remote files used for update the database are:

For the daily update

* http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml


If the database is unupdated more than 1 day then the system goes to:

* http://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist-90d.xml

and update all the days until the last value.

If you don't want to program a cron or only few people visit the page, don't worry, the web site will be always updated, the only thing you have to do is visit the home page.
    
Easy update: Just visit the website for update the database.




This source code in production: 
---------------------------------------

http://www.oriolmangas.com/exchange-converter/


More about the author
---------------------

Oriol Mangas
oriolmangas@gmail.com
https://www.linkedin.com/in/oriolmangas
