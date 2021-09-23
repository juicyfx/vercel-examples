# Installation wizard for October

The wizard installation is a recommended way to install October. It is simpler than the command-line installation and doesn't require any special skills.

1. Prepare a directory on your server that is empty. It can be a sub-directory, domain root or a sub-domain.
1. [Download the installer archive file](https://github.com/octobercms/install/archive/master.zip).
1. Unpack the installer archive to the prepared directory.
1. Grant writing permissions on the installation directory and all its subdirectories and files.
1. Navigate to the install.php script in your web browser.
1. Follow the installation instructions.

## Minimum System Requirements

October CMS has a few system requirements:

* PHP version 7.2 or higher
* PDO PHP Extension (and relevant driver for the database you want to connect to)
* cURL PHP Extension
* OpenSSL PHP Extension
* Mbstring PHP Extension
* ZipArchive PHP Extension
* GD PHP Extension
* SimpleXML PHP Extension

Some OS distributions may require you to manually install some of the required PHP extensions.

When using Ubuntu, the following command can be run to install all required extensions:

```bash
sudo apt-get update &&
sudo apt-get install php php-ctype php-curl php-xml php-fileinfo php-gd php-json php-mbstring php-mysql php-sqlite3 php-zip
```
