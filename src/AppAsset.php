<?php

declare(strict_types=1);

namespace VigihdevWP\Assets;

use Vigihdev\Support\Text;
use VigihdevWP\Assets\Contracts\Able\PublishAbleInterface;
use VigihdevWP\Assets\Contracts\AppAssetInterface;
use VigihdevWP\Assets\DTOs\AppAssetDto;
use VigihdevWP\Assets\Exceptions\WpAssetsException;
use VigihdevWP\Assets\Support\AssetHelper;

/**
 * Manajer asset aplikasi
 * 
 * Memuat asset CSS dan JS ke dalam queue enqueue.
 * 
 */
final class AppAsset implements PublishAbleInterface
{

    /**
     * Konstruktor manajer asset aplikasi
     * 
     * @param AppAssetDto $asset Asset aplikasi
     */
    public function __construct(
        private readonly AppAssetInterface $asset
    ) {
        if (!is_dir($this->asset->getBasepath())) {
            throw WpAssetsException::directoryNotFound($this->asset->getBasepath());
        }
    }

    /**
     * Memuat asset CSS dan JS ke dalam queue enqueue.
     * 
     * @return void
     */
    public function publish(): void
    {

        if (!empty($this->asset->getCss())) {
            add_action('wp_enqueue_scripts', function () {
                foreach ($this->asset->getCss() as $css) {
                    $hashCss = AssetHelper::cid($css);
                    $hadleCss = AssetHelper::resolveHandle($css) . '-' . $hashCss;
                    wp_enqueue_style(
                        handle: Text::toKebabCase($hadleCss),
                        src: "{$this->asset->getBaseUrl()}/{$css}",
                        deps: [],
                        ver: $this->asset->getVersion(),
                        media: 'all',
                    );
                }
            });
        }

        if (!empty($this->asset->getJs())) {

            add_action('wp_enqueue_scripts', function () {
                foreach ($this->asset->getJs() as $js) {
                    $hashJs = AssetHelper::cid($js);
                    $hadleJs = AssetHelper::resolveHandle($js) . '-' . $hashJs;
                    wp_enqueue_script(
                        handle: Text::toKebabCase($hadleJs),
                        src: "{$this->asset->getBaseUrl()}/{$js}",
                        deps: $this->asset->getDepends(),
                        ver: $this->asset->getVersion(),
                        args: $this->asset->getJsOptions()->toArray(),
                    );
                }
            });
        }
    }
}
