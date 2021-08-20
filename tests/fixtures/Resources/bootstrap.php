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

use Doctrine\Common\Annotations\AnnotationRegistry;

date_default_timezone_set('UTC');

$loader = require __DIR__.'/../../../vendor/autoload.php';
//require __DIR__.'/AppKernel.php';

require __DIR__.'/../../../src/Kernel.php';

AnnotationRegistry::registerLoader('class_exists');

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__.'/../../../.env.test');

return $loader;
