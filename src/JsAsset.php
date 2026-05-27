<?php

declare(strict_types=1);

namespace VigihdevWP\Assets;

use VigihdevWP\Assets\Contracts\Able\PublishAbleInterface;
use VigihdevWP\Assets\Contracts\JsAssetInterface;
use VigihdevWP\Assets\DTOs\JsAssetDto;
use VigihdevWP\Assets\Support\AssetHelper;

final class JsAsset implements PublishAbleInterface
{

    /**
     *
     * @param JsAssetDto $jsAsset
     * @return void
     */
    public function __construct(
        private readonly JsAssetInterface $jsAsset
    ) {}

    public function publish(): void
    {

        $jsAsset = $this->jsAsset;
        if (empty($jsAsset->getJs())) {
            return;
        }

        add_action('wp_enqueue_scripts', function () use ($jsAsset) {

            $hash = AssetHelper::cid($this->jsAsset->getBasepath());
            foreach ($jsAsset->getJs() as $index => $js) {
                $handle = "{$hash}-" . (string) ($index + 1);

                if (AssetHelper::isUrl($js)) {
                    $this->enqueue($handle, $js);
                    continue;
                }

                $this->enqueue($handle, $jsAsset->getBaseUrl() . "/{$js}");
            }
        });
    }

    private function enqueue(string $handle, string $js): void
    {
        wp_enqueue_script(
            handle: $handle,
            src: $js,
            deps: $this->jsAsset->getDepends(),
            ver: $this->jsAsset->getVersion(),
            args: $this->jsAsset->getJsOptions()->toArray(),
        );
    }
}
