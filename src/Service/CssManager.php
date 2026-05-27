<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Service;

use Vigihdev\Support\Text;
use VigihdevWP\Assets\Contracts\Manager\CssManagerInterface;
use VigihdevWP\Assets\Contracts\StyleEnqueueInterface;
use VigihdevWP\Assets\DTOs\StyleEnqueueDto;
use VigihdevWP\Assets\Support\AssetHelper;

final class CssManager implements CssManagerInterface
{

    /**
     * @var StyleEnqueueDto[] $cssAssets
     */
    private array $cssAssets = [];

    public function __construct(
        iterable $assets,
    ) {

        foreach ($assets as $asset) {
            if ($asset instanceof StyleEnqueueInterface) {
                $this->cssAssets[] = $asset;
            }
        }
    }

    public function publish(): void
    {

        if (empty($this->cssAssets)) {
            return;
        }

        add_action('wp_enqueue_scripts', function () {
            foreach ($this->cssAssets as $asset) {

                if (!AssetHelper::isUrl($asset->getSrcUri())) {
                    continue;
                }

                $hashCss = AssetHelper::cid($asset->getSrcUri());
                $hadleCss = $asset->getHandle() . '-' . $hashCss;
                wp_enqueue_style(
                    handle: Text::toKebabCase($hadleCss),
                    src: $asset->getSrcUri(),
                    deps: [],
                    ver: $asset->getVersion(),
                    media: 'all',
                );
            }
        });
    }
}
