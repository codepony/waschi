# Waschi v0.5-0004
This is Waschi.
A "hide and seek of your laundry" game for the web.

## Requirements

For hosting:
- A webserver!
- PHP5
- Some water to drink.

For playing:
- A browser or washi.lisp ( see: https://gist.github.com/codepony/4994410 )

## Scripts - What's that file?

- index.php - Your visible webpage. You can customize it (except the copyright part).
- list.php - Here you can change the look of the list.
- echowash.php - For client reasons. ( see washi.lisp )
- found - Your list of found laundry. 

## Rights
It's important, that your *webserver has a read/write access* on your Waschi folder.
For me that works using an apache webserver:


- chown root:www-data /path/to/your/waschi/webfolder
- chmod 775 /path/to/your/waschi/webfolder
- chmod -R 664 /path/to/your/waschi/webfolder/*

This may differs from your necessary access configuration.

## 
See more at http://waschi.org/
