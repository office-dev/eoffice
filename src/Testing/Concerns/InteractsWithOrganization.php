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

namespace EOffice\Testing\Concerns;

use EOffice\Contracts\Organization\Model\JabatanInterface;
use EOffice\Organization\Model\Jabatan;

trait InteractsWithOrganization
{
    public function iHaveJabatan(string $nama): JabatanInterface
    {
        $em      = $this->getEntityManager(JabatanInterface::class);
        $jabatan = $em->getRepository(JabatanInterface::class)->findOneBy([
            'nama' => $nama,
        ]);
        if (null === $jabatan) {
            $jabatan = new Jabatan($nama);
            $em->persist($jabatan);
            $em->flush();
        }

        return $jabatan;
    }
}
