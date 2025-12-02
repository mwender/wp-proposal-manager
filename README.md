# WordPress Proposal Manager #
**Contributors:** [thewebist](https://profiles.wordpress.org/thewebist/)  
**Tags:** cpt  
**Requires at least:** 6.5  
**Tested up to:** 6.9  
**Stable tag:** 1.4.1  
**License:** GPLv2 or later  
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html  

Provides a "Proposals" CPT that features a custom permalink.

## Description ##

Developed for a construction company, this plugin implements a Proposal CPT that features a custom landing page with selectable video elements along with a section for providing client-viewable proposals.

## Changelog ##

### 1.4.1 ###
* Including required `/lib/typerocket/vendor/composer/autoload_static.php`.

### 1.4.0 ###
* Including Typerocket required Composer Libraries.

### 1.3.5 ###
* Adding `robots_txt` filter for blocking proposal views.

### 1.3.4 ###
* Updating map link to main site "Our Properties".

### 1.3.3 ###
* Removing links to `home_url()`.
* Adjusting footer links.

### 1.3.2 ###
* Adding trailing slash to URLs listed in Proposal CPT Permalink column in admin.

### 1.3.1 ###
* Allowing trailing slash on `/view-proposal/{uid}` URLs for matching with WP Force Login allowed URLs.

### 1.3.0 ###
* Adding `force_login_allowed_patterns` for compatibility with WP Force Login plugin.

### 1.2.4 ###
* Updating Proposal CPT admin "Permalink" column to use `home_url()` for building URLs.

### 1.2.3 ###
* Updating `hide_adminbar_on_proposals()` to not show admin bar on other pages.

### 1.2.2 ###
* Removing "Protected: " from post titles when displaying the title of a protected post.

### 1.2.1 ###
* Checking for valid referers before showing "wrong password" message.

### 1.2.0 ###
* Adding password protection for Proposal CPTs.

### 1.1.0 ###
*  Removing Estatik 4 Pro login popup HTML from Proposal template.

### 1.0.0 ###
* Initial release.

