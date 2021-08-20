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

class UserContext implements Context
{
    /**
     * @Given there is a user :email identified by :password
     * @Given there was account of :email with password :password
     * @Given there is a user :email
     *
     * @param mixed $email
     * @param mixed $password
     */
    public function thereIsUserIdentifiedBy($email, $password = 'eoffice'): void
    {
    }
}
