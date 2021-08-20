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

use Symfony\Component\Dotenv\Dotenv;

require __DIR__.'/../../../vendor/autoload.php';

$dotEnv = new Dotenv();
$dotEnv->bootEnv(__DIR__.'/../../../.env', 'dev', ['test', 'behat']);
