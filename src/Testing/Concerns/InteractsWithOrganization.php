<?php

namespace EOffice\Testing\Concerns;

use EOffice\Contracts\Organization\Model\JabatanInterface;
use EOffice\Organization\Model\Jabatan;

trait InteractsWithOrganization
{
    public function iHaveJabatan(string $nama): JabatanInterface
    {
        $em = $this->getEntityManager(JabatanInterface::class);
        $jabatan = $em->getRepository(JabatanInterface::class)->findOneBy([
            'nama' => $nama,
        ]);
        if(null === $jabatan){
            $jabatan = new Jabatan($nama);
            $em->persist($jabatan);
            $em->flush();
        }

        return $jabatan;
    }
}
