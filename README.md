# Waschi v1.1
### (or Waschi Waschmaschinenverbund)

##Current functions: 
- Wash laundry
- Wash randomly created laundry
- Put laundry into Washi with a user and password 
- Take away laundry from a Waschi-server when you know the user & password
- See the score of a user when you know the password
- See an actual highscore, which is manages centralized 

##TO-DO:
- Improve the highscore system

##Future-Plans:
- None at the moment, feel free to add requests

## Requirements
For hosting:
- A webserver
- PHP5
- Some water to drink

For playing:
- A browser

Or a client like:
- washi.lisp (https://github.com/codepony/washi.lisp) written in CommonLisp
- waschi-cs-client (https://github.com/pixeldesu/waschi-cs-client) written in C#
- waschi-cli (https://github.com/fliiiix/waschi-cli/) written in ruby
- washi-cli (https://github.com/vanita5/washi-cli) written in python
- waschiclient-hs (https://github.com/FSBaerchen/waschiclient-hs) written in Haskell

## Installation

- Extract the files from server/ to your path chosen for Waschi
- Register your Waschi at http://waschi.org
- Get the keys via mail

Additional it is possible to set up your own network, for this please look into the source.

Make a file named key.php with following content:
```php
	<?php
		$key1="KEY1_IN_EMAIL";
		$key2="KEY2_IN_EMAIL";
	?>
```
...and save it in your Waschi folder.

### Rights
It's important, that *your webserver* has read/write access in your Waschi folder

Example settings for a common apache webserver:
```bash
	chown root:www-data /path/to/your/waschi/webfolder
	chmod 775 /path/to/your/waschi/webfolder
	chmod -R 664 /path/to/your/waschi/webfolder/*
```
*This may differ from your necessary access configuration*


### Clean the list
It's recommended to clean up the found, users and pwds lists from time to time

Example cronjobs:
```bash
	echo "00 12 * * 0 www-data /bin/rm /YOUR/WASCHI/DIR/found 2> /dev/null" >> /etc/cron.d/waschi
	echo "00 12 * * 0 www-data /bin/rm /YOUR/WASCHI/DIR/users.php 2> /dev/null" >> /etc/cron.d/waschi
	echo "00 12 * * 0 www-data /bin/rm /YOUR/WASCHI/DIR/pwds.php 2> /dev/null" >> /etc/cron.d/waschi
	chmod +x /etc/cron.d/waschi
```

### Register your Waschi
Go to http://waschi.org/register/ to register your Waschi. After registering you'll get two keys via mail which you have to put into a "key.php", or you will receive the whole key-file.


## License
Waschi (Waschi Waschmaschinenverbund) is licensed under GNU-AGPL v3+.


See more at http://waschi.org/


##FAQ thing

### Scripts - What's that file?
- index.php - Your visible webpage. You can customize it (except the copyright part).
- list.php - Here you can change the look of the list.
- echowash.php - For client reasons. ( see washi.lisp for example )
- found - Your list of found laundry. 

### How to make a client?
Have a look at doc/ and you will find anything you need. Also you can check the currently available clients to get an overview.
