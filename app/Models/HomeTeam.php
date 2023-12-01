<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTeam extends Model
{
    use HasFactory;

    public $homeTeam;
    public $awayTeam;
    public $date;
    public $homeRanking;
    public $awayRanking;

    public function __construct($homeTeam = null, $awayTeam = null, $date = null, $homeRanking = null, $awayRanking = null)
    {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->date = $date;

        $arrHomeRanking = [];
        $arrAwayRanking = [];

        $homeRanking = (int) $homeRanking;
        $awayRanking = (int) $awayRanking;

        for ($i=0; $i < 4; $i++) { 
            $arrHomeRanking[] = $homeRanking + $i;
            $arrHomeRanking[] = $homeRanking - $i;
            $arrHomeRanking[] = $awayRanking + $i;
            $arrHomeRanking[] = $awayRanking - $i;
        }

        $this->homeRanking = $arrHomeRanking;
        $this->awayRanking = $arrAwayRanking;
    }

}