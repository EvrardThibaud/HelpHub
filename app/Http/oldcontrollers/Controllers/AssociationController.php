<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Thematique;
use App\Models\Action;
use App\Models\ActionLike;
use App\Models\ParticipationBenevolat;
use App\Models\ParticipationDon;
use App\Models\DemandeBenevolat;
use App\Models\DemandeDon;
use Illuminate\Http\Request;


class AssociationController extends Controller
{

    public function one(Request $request){
        $id = $request->query('id');
        $asso = Association::with('media')->find($id);
        $query = Action::join('association', 'association.idassociation', '=', 'action.idassociation')
        ->where('association.idassociation', '=', $id);
        $query->orderBy('datepublicationaction', 'DESC')->get();
    
    	return view (
            "association", [
                'association'=>$asso,
                'actions'=>$query->get(),
                'participationbenevolat'=>ParticipationBenevolat::all(),
                'participationdon'=>ParticipationDon::all(),
                'demandebenevolat'=>DemandeBenevolat::all(),
                'demandedon'=>DemandeDon::all(),
                'actionlike'=>ActionLike::all(),
            ]);
    }



}
