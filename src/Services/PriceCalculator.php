<?php

namespace App\Services;


/*
 * Getprice()
 */
class PriceCalculator
{
    /**
     * @param $birthDate
     * @param $discount
     * @return string
     */
    public function getProfileByAge($birthDate, $discount):string
    {
        // Convert birthDate into age
        $today = new \DateTime();
        if ($birthDate <= $today){
            $age = (int)$today->diff($birthDate)->format('%y');
        }

        // Looking for profile
        $profile = '';

        if ($discount){
            $profile = 'discount';
        } elseif ($age >= 0 && $age < 3){
            $profile = 'baby';
        } elseif ($age >= 4 && $age <= 12) {
            $profile = 'child';
        } elseif ($age > 12 && $age < 60) {
            $profile = 'normal';
        } elseif ($age >= 60) {
            $profile = 'elder';
        }

        return $profile;
    }

    /**
     * @param $birthDate
     * @param $discount
     * @return int ticket price
     */
    public function calculating($birthDate, $discount):int
    {
        $guestProfile = $this->getProfileByAge($birthDate, $discount);

        $prices = array(
            'baby'     =>  0,
            'child'    =>  8,
            'normal'   => 16,
            'elder'    => 12,
            'discount' => 10

        );




        return $prices[$guestProfile];

    }



}

