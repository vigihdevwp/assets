# 🛠️ WpAssets

![Push](https://github.com/vigihdev/wp-assets/actions/workflows/push.yml/badge.svg)
![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

WpAssets is a package to manage assets in WordPress. Simplicity is the key. Support Dto and Interface.

---

### Example Directory Structure

```
src/
|-- AppAsset.php
|-- Contracts
|   |-- Able
|   |   |-- ArrayAbleInterface.php
|   |   `-- PublishAbleInterface.php
|   |-- AppAssetInterface.php
|   |-- ArrayAbleInterface.php
|   |-- CssAssetInterface.php
|   |-- JqueryInterface.php
|   |-- JsAssetInterface.php
|   |-- JsModuleInterface.php
|   |-- JsOptionsInterface.php
|   |-- ScriptEnqueueInterface.php
|   |-- ScriptLocalizeInterface.php
|   `-- StyleEnqueueInterface.php
|-- CssAsset.php
|-- DTOs
|   |-- AppAssetDto.php
|   |-- CssAssetDto.php
|   |-- JqueryDto.php
|   |-- JsAssetDto.php
|   |-- JsModuleDto.php
|   |-- JsOptionsDto.php
|   |-- ScriptEnqueueDto.php
|   |-- ScriptLocalizeDto.php
|   `-- StyleEnqueueDto.php
|-- Exceptions
|   `-- WpAssetsException.php
|-- Jquery.php
|-- JsAsset.php
|-- JsLocalizer.php
|-- JsModule.php
`-- Support
    `-- AssetHelper.php
```

```php
use VigihdevWP\Assets\CssAsset;
use VigihdevWP\Assets\DTOs\CssAssetDto;
use VigihdevWP\Assets\DTOs\JsAssetDto;
use VigihdevWP\Assets\JsAsset;

$cssAsset = new CssAsset(
    cssAsset: new CssAssetDto(
        basepath: __DIR__,
        baseUrl: 'http://localhost:8000/',
        version: '1.0.0',
        css: [
            'css/def.min.css',
            'css/def2.min.css',
            'http://localhost:8000/css/def3.min.css',
            'https://bootstrapcdn.com/css/bootstrap.min.css'
        ]
    )
);
$cssAsset->publish();

$jsAsset = new JsAsset(
    jsAsset: new JsAssetDto(
        basepath: __DIR__,
        baseUrl: 'http://localhost:8000/',
        version: '1.0.0',
        depends: [
            'jquery',
        ],
        js: [
            'js/def.min.js',
            'js/def2.min.js',
            'http://localhost:8000/js/def3.min.js',
            'https://bootstrapcdn.com/js/bootstrap.min.js'
        ]
    )
);
$jsAsset->publish();
```

```php
use VigihDev\SymfonyBridge\Config\Service\ServiceLocator;
use Vigihdev\WpKernel\WpKernel;
use VigihdevWP\Assets\Contracts\Manager\{
    CssManagerInterface,
    JsManagerInterface,
    AppAssetManagerInterface,
    JsLocalizerManagerInterface,
    JqueryManagerInterface,
    JsModuleManagerInterface,
};
use VigihdevWP\Assets\Support\AssetHelper;

WpKernel::boot(
    basePath: __DIR__,
    configDir: 'config',
    enableAutoInjection: true,
);


/** @var JsManagerInterface $js  */
$js = ServiceLocator::get(JsManagerInterface::class);
$js->publish();

/** @var CssManagerInterface $css  */
$css = ServiceLocator::get(CssManagerInterface::class);
$css->publish();

/** @var AppAssetManagerInterface $appAsset  */
$appAsset = ServiceLocator::get(AppAssetManagerInterface::class);
$appAsset->publish();

/** @var JsLocalizerManagerInterface $jsLocalizer  */
$jsLocalizer = ServiceLocator::get(JsLocalizerManagerInterface::class);
$jsLocalizer->publish();

/** @var JqueryManagerInterface $jquery  */
$jquery = ServiceLocator::get(JqueryManagerInterface::class);
$jquery->publish();

/** @var JsModuleManagerInterface $jsModule  */
$jsModule = ServiceLocator::get(JsModuleManagerInterface::class);
$jsModule->publish();

```
