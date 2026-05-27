<?php

declare(strict_types=1);

namespace VigihdevWP\Assets;

use VigihdevWP\Assets\Contracts\Able\PublishAbleInterface;
use VigihdevWP\Assets\Contracts\ScriptLocalizeInterface;
use VigihdevWP\Assets\DTOs\ScriptLocalizeDto;

final class JsLocalizer implements PublishAbleInterface
{

    /**
     *
     * @param ScriptLocalizeDto $localize
     * @return void
     */
    public function __construct(
        private readonly ScriptLocalizeInterface $localize,
    ) {}

    public function publish(): void
    {
        $localize = $this->localize;
        add_action('wp_enqueue_scripts', function () use ($localize) {
            wp_register_script($localize->getHandle(), '', $localize->getDepends(), false, true);

            wp_localize_script($localize->getHandle(), $localize->getVariableName(), [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce($localize->getNonce()),
                'actions' => $localize->getActions(),
            ]);

            wp_enqueue_script($localize->getHandle());
        });
    }
}
