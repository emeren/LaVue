<?php

namespace App\Http\Controllers;

use App\Http\Resources\JednostkaAdmResourceCollection;
use Illuminate\Http\Request;

class ApisController extends Controller
{
    //
    /**
     * Zwraca wszystkie województwa z podległymi powiatami i gminami
     *
     * @return void
     */
    public function getAllWoj()
    {
        try {
            $allWoj = $this->createCollectionWoj();

            return new JednostkaAdmResourceCollection($allWoj);
        } catch (\Exception $e) {
            return response()->json(["ERROR" => "Błąd generowania resource"], 503);
        }
    }
    /**
     * Zrwaca listę powiatów danego województwa
     *
     * @param String $name
     * @return void
     */
    public function getWojewodztwo(String $name)
    {
        $allWoj = $this->createCollectionWoj();
        $reqWoj = $allWoj->where('name', '=', $name);

        try {
            if ($reqWoj) {
                // $reqWoj = collect($reqWoj->powiaty);
                return new JednostkaAdmResourceCollection($reqWoj);
            } else {
                return response()->json(["ERROR" => "Nie znaleziono województwa"], 404);
            }
        } catch (\Exception $e) {
            return response()->json(["ERROR" => "Błąd generowania resource"], 503);
        }
    }

    /**
     * Creates Collection from JSON file
     *
     * @return void
     */
    private function createCollectionWoj()
    {
        $allWoj = collect(json_decode(file_get_contents(storage_path('/wojewodztwa.json'))));
        return $allWoj;
    }
}
