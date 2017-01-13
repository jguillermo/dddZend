<?php
/**
 * ProviderTrait Trait
 *
 * @package MisaCore\Application\Factory\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2017, Getmin
 */
namespace MisaCore\Application\Factory\Provider;

trait ProviderTrait
{
    private $providerProvider;

    /**
     * @return ProviderFac
     */
    public function providerProvider()
    {
        if (! $this->providerProvider) {
            $this->providerProvider = new ProviderFac();
        }
        return $this->providerProvider;
    }
}
