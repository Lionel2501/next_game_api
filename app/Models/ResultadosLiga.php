<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HomeTeam;

class ResultadosLiga extends Model
{
    use HasFactory;
    
    public function GetNextGame($matchsArray)
    {
        $result = [];
        $obj = new \stdClass();
        foreach ($matchsArray as $value) {
            /* $homeTeam = new HomeTeam($value->local, $value->visitante, $value->fecha, $value->local_posicion, $value->visitante_posicion); */
            $contextData = $this->getContextGame($value);

            $result[] = $contextData;
        }

        return $result;
    }

    public function getContextGame($value)
    {
        $obj = new \stdClass();

        $arrHomeRanking = [];
        $arrAwayRanking = [];
        $arrDateRanking = [];

        $homeRanking = (int) $value->local_posicion;
        $awayRanking = (int) $value->visitante_posicion;
        $date = (int) $value->fecha;

        for ($i=0; $i < 4; $i++) { 
            $arrHomeRanking[] = $homeRanking + $i;
            $arrHomeRanking[] = $homeRanking - $i;
            $arrAwayRanking[] = $awayRanking + $i;
            $arrAwayRanking[] = $awayRanking - $i;
            $arrDateRanking[] = $date + $i;
            $arrDateRanking[] = $date - $i;
        }

        $obj->home_team = $value->local;
        $obj->away_team = $value->visitante;
        $obj->home_ranking = $arrHomeRanking;
        $obj->away_ranking = $arrAwayRanking;
        $obj->date = $arrDateRanking;

        return [
            "home_context"  => $this->getContextAwayDate($obj),
            "away_context"  => $this->getContextHomeDate($obj),
            "duels_context" => $this->getContextDuels($obj)
        ];       
    }

    public function getContextHomeDate($data)
    {
        return $this->where('local', $data->home_team)
            ->whereIn('fecha', $data->date)
            ->whereIn('local_posicion', $data->home_ranking)
            ->whereIn('visitante_posicion', $data->away_ranking)
            ->get();
    }

    public function getContextAwayDate($data)
    {
        return $this->where('visitante', $data->away_team)
            ->whereIn('fecha', $data->date)
            ->whereIn('local_posicion', $data->home_ranking)
            ->whereIn('visitante_posicion', $data->away_ranking)
            ->get();
    }

    public function getContextDuels($data)
    {
        return $this::where('local', $data->home_team)
                            ->where('visitante', $data->away_team)
                            ->get();
    }
}