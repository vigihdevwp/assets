<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Service;

use Vigihdev\Support\Text;
use VigihdevWP\Assets\Contracts\Manager\JsManagerInterface;
use VigihdevWP\Assets\Contracts\ScriptEnqueueInterface;
use VigihdevWP\Assets\DTOs\ScriptEnqueueDto;
use VigihdevWP\Assets\Support\AssetHelper;

final class JsManager implements JsManagerInterface
{

    /**
     * @var ScriptEnqueueDto[] $jsAssets 
     */
    private array $jsAssets = [];

    public function __construct(
        iterable $assets,
    ) {

        foreach ($assets as $asset) {
            if ($asset instanceof ScriptEnqueueInterface) {
                $this->jsAssets[] = $asset;
            }
        }
    }

    public function publish(): void
    {

        if (empty($this->jsAssets)) {
            return;
        }

        add_action('wp_enqueue_scripts', function () {
            foreach ($this->jsAssets as $asset) {

                if (!AssetHelper::isUrl($asset->getSrcUri())) {
                    continue;
                }

                $hashJs = AssetHelper::cid($asset->getSrcUri());
                $hadleJs = $asset->getHandle() . '-' . $hashJs;
                wp_enqueue_script(
                    handle: Text::toKebabCase($hadleJs),
                    src: $asset->getSrcUri(),
                    deps: $asset->getDepends(),
                    ver: $asset->getVersion(),
                    args: $asset->getJsOption()->toArray(),
                );
            }
        });
    }
}
