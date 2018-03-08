<?php

namespace App\Services;


use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;


/**
 * Class CodeNumberGenerator
 * @package App\Services
 * Generate a Command Number
 */
class CodeNumberGenerator
{
    private $emanager;



    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->emanager = $entityManager;
    }

    /**
     * @param $code
     * @return bool
     */
    protected function isCodeExist(int $code):bool
    {
        $query = $this->emanager->getRepository(Booking::class)->findOneBy(array('commandNumber' => $code));

        if (!$query){
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    protected function codeGenerator():int
    {
        $code = rand(10000, 100000);
        return $code;
    }

    /**
     * @return int
     */
    public function sendCodeCommand():int
    {
        do {
            $code = $this->codeGenerator();

        }while (!$this->isCodeExist($code));

        return $code;

    }


}
