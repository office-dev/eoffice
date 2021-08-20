<?php

/*
 * This file is part of the EOffice project.
 *
 * (c) Anthonius Munthi <https://itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Integration\EOffice\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\MinkContext;
use FriendsOfBehat\SymfonyExtension\Context\Environment\InitializedSymfonyExtensionEnvironment;

class LoginContext implements Context
{
    /**
     * @var MinkContext
     */
    private $minkContext;

    /**
     * @param BeforeScenarioScope $scope
     * @BeforeScenario
     */
    public function gatherContexts(BeforeScenarioScope $scope): void
    {
        /** @var InitializedSymfonyExtensionEnvironment $env */
        $env = $scope->getEnvironment();
        /** @var MinkContext $minkContext */
        $minkContext       = $env->getContext(MinkContext::class);
        $this->minkContext = $minkContext;
    }

    /**
     * @When I want to login
     */
    public function iWantToLogin(): void
    {
        $session = $this->minkContext->getSession();
        $session->visit('https://localhost/login');
    }
}
