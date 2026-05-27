<?php

declare(strict_types=1);

namespace VigihdevWP\Assets;

use VigihdevWP\Assets\Contracts\Able\PublishAbleInterface;
use VigihdevWP\Assets\Contracts\CssAssetInterface;
use VigihdevWP\Assets\DTOs\CssAssetDto;
use VigihdevWP\Assets\Support\AssetHelper;

final class CssAsset implements PublishAbleInterface
{

    /**
     *
     * @param CssAssetDto $cssAsset
     * @return void
     */
    public function __construct(
        private readonly CssAssetInterface $cssAsset
    ) {}

    /**
     *
     * @return void
     */
    public function publish(): void
    {
        $cssAsset = $this->cssAsset;

        if (empty($cssAsset->getCss())) {
            return;
        }

        add_action('wp_enqueue_scripts', function () use ($cssAsset) {
            foreach ($cssAsset->getCss() as $css) {
                $hashCss = AssetHelper::cid($css);
                $hadleCss = AssetHelper::resolveHandle($css) . '-' . $hashCss;
                $hadleCss = preg_replace('/[^a-zA-Z0-9-]+/', '-', $hadleCss);
                $handle = $hadleCss;

                if (AssetHelper::isUrl($css)) {
                    $this->enqueue($handle, $css);
                    continue;
                }
                $baseUrl = rtrim($cssAsset->getBaseUrl(), '/');
                $this->enqueue($handle, "{$baseUrl}/{$css}");
            }
        });
    }

    private function enqueue(string $handle, string $src): void
    {
        wp_enqueue_style(
            handle: $handle,
            src: $src,
            deps: $this->cssAsset->getDepends(),
            ver: $this->cssAsset->getVersion(),
            media: 'all',
        );
    }
}
