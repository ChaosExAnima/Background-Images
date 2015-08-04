# Background Images
Extension for Mediawiki to allow inline background images.

## Installation
Put into `/extensions/BackgroundImages` folder. Load with `require_once "$IP/extensions/BackgroundImages/BackgroundImages.php";` in LocalSettings.php.

## Usage
This:
```html
<div style="{{#backgroundImage: ImageName.jpg}}"></div>
```
Turns into:
```html
<div style="background-image: url( '/images/8/80/ImageName.jpg' );"></div>
```

Does not work for external images or URLs.
