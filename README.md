# [Helpdesk-Plugin](https://github.com/SaifurRahmanMohsin/Helpdesk-Plugin) #
Helpdesk plugin for October CMS

## Installation ##
Until this plugin is added to the market place, you will have to perform the following steps on your terminal to install it:
```
[ -f artisan ] && cd plugins
mkdir -p mohsin && cd $_
wget https://github.com/SaifurRahmanMohsin/Helpdesk-Plugin/archive/master.zip
[ -f master ] && unzip master || unzip master.zip && rm $_
mv Helpdesk-Plugin-master helpdesk && cd $_

```
Now goto your backend and either re-login or force update OctoberCMS. This will generate the tables necessary for the plugin to work. You have now installed helpdesk!

## Quick Start ##
Add the `Tickets` component to the page where you would like the user's ticket management page to appear.
