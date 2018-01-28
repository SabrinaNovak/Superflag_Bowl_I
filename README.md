# Superflag Bowl I

> After the successful release of **Flag Shop**, a new era has begun! Times have changed - and new times bring new challenges which ```require``` new issues and applications! 

So, here we are. 
**Let the games begin!**

## What the heck is this all about?

### Background Story
Like the last time, this story is not very entertaining, because it _is_ the same story again: 
Inventor of this supercool **Superflag Bowl I** was [my teacher](https://github.com/Weissheiten/PHPGrundlagenMitschrift) @HTL3R; again, it was a little project in the course of the subject "web technologies".

### Baby Steps
**Or how I got from Nothing to This**

First of all, open your bash.
Navigate to the `[directory]` where your **Superflag Bowl I** project is stored / in development.
```
$ cd [directory]
```
Initialize **composer** on your new project:
```
$ composer init
```
A new file, _`composer.json`_, should now appear in your repository. It will probably look like this: 
```
{
  "name": "[vendor-name]/[project-name]",
  "description": "[description]",
  "type": "project",
  "authors": [
    {
      "name": "[name]",
      "email": "[e-mail]"
    }
  ]
}
```

Now it is important that you add the following to your _`composer.json`_ file. (You need that _because_ this exclusive tool is not on [packagist](https://packagist.org/) available yet.)
```
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/SabrinaNovak/Flags"
    }
  ]
```

Let's switch back to your bash. 
```
$ composer require "novak/flagpackage": "[a stable version]"
$ composer install
```


#### Flags.php
```
require './vendor/autoload.php';
 
use HTL3R\Flags\Flags\TriangleFlag as TriangleFlag; 
use HTL3R\Flags\Flags\RectangleFlag as RectangleFlag;
```

Some Example Flags
```
$myFlags[] = new RectangleFlag("Great Britain", 24.5, 2.0, 0.5, "#F00", "GB");
$myFlags[] = new TriangleFlag("Cocos Islands", 32.5, 4.0, 0.2, "#00F", "CC");
$myFlags[] = new RectangleFlag("Spain", 20.5, 2.0, 0.5, "#F0F", "ES");
```

#### JSON and File Header

Add the following to your `flags.php` file.
```
foreach ($myFlags as $flag) {     
    $flagSortiment[] = [         
        "name" => $flag->getName(),         
        "price" => $flag->getPrice(),         
        "width" => $flag->getWidth(),         
        "height" => $flag->getHeight(),         
        "color" => $flag->getColor(), 
        "langcode" => strtolower($flag->getLangcode())     
        ];
     }
  die(json_encode($flagSortiment));
```

#### AJAX and fetch

Create `index.html` with the following content:
```
<script type="text/javascript">     
    function status(response) {         
        if (response.status >= 200 && response.status < 300) {             
            return Promise.resolve(response)         
        } else {             
            return Promise.reject(new Error(response.statusText))         
        }     
    }      
    
    function json(response) {         
        return response.json()     
    }      
    
    fetch('flags.php')         
        .then(status)         
        .then(json)         
        .then(function (data) {             
            console.log('Request succeeded with JSON response', data);         
        })
        .catch(function (error) {         
            console.log('Request failed', error);     
        }
    );
 </script>
```

#### Output with TYPO3 Fluid
```
$ composer require typo3fluid/fluid
$ composer install
```

Create a directory `templates`. Add the file `flag-template.html` with the following content:
```
<main>     
    <f:for each="{Flags}" as="Flag">         
    <h2>{Flag.name}</h2>
    <ul>             
        <li><strong>Price:</strong> {Flag.price}</li> 
        <li><strong>Width:</strong> {Flag.width}</li> 
        <li><strong>Height:</strong> {Flag.height}</li> 
        <li><strong>Color:</strong> {Flag.color}</li>
    </ul>         
    <hr>     
    </f:for> 
</main> 
```

Add the following code to `flags.php`.
```
if(isset($_GET["mode"]) && !empty($_GET["mode"]) && $_GET["mode"] == "json"){     
    header('Content-Type: application/json');     
    die(json_encode($flagSortiment));
 }   
    
$view = new \TYPO3Fluid\Fluid\View\TemplateView();
 $paths = $view->getTemplatePaths();
 $paths->setTemplatePathAndFilename(__DIR__ . '/templates/flag-template.html');  
$view->assignMultiple(     
    array(         
        "Flags" => $flagSortiment     
    ) 
);
 
  $output = $view->render();
 echo $output;
```

…and the following to your `index.html`:
```
fetch('flags.php?mode=json')         
    .then(status)         
    .then(json)         
    .then(function (data) {             
        console.log('Request succeeded with JSON response', data);         
    })
    .catch(function (error) {         
        console.log('Request failed', error);     
    }
);
```

#### Enable Output of Flags as flag-icon SVGs
```
$ composer require components/flag-icon-css
```

Add the following `<li>`- element to your flag list @`flag-template.html`:
```
    <li> 
        <span class="flag-icon flag-icon-{Flag.langcode}"></span> 
    </li>

```

Also, don't forget to include the link to the flag-icon-css stylesheet!
```
<link type="text/css" rel="stylesheet" href="vendor/components/flag-icon-css/css/flag-icon.min.css">
```


## Support Me!
I am happy about new issues and feedback concerning this Superflag Bowl! I'll try to do my best and fix any problems you can find ;)