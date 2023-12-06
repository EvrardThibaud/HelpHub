<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Association;
use App\Models\Commentaire;
use App\Models\Utilisateur;
use App\Models\ThematiqueAction;
use App\Models\ParticipationBenevolat;
use App\Models\ParticipationDon;
use App\Models\DemandeBenevolat;
use App\Models\DemandeDon;
use App\Models\Information;
use App\Models\Thematique;
use Illuminate\Http\Request;
use App\Models\ActionLike;

class ActionController extends Controller
{
    public function index(){
    	return view ("welcome", ['actions'=>Action::all() ]);
    }

    public function one(Request $request){
        $id = $request->query('id');
        $query = Commentaire::join('users', 'commentaire.idutilisateur', '=', 'users.idutilisateur')
        ->leftJoin('media', 'users.idmedia', '=', 'media.idmedia')
        ->where('commentaire.idaction', $id);
        $commentaires = $query->orderBy('datecommentaire', 'DESC')->get();
        $action = Action::join('association', 'action.idassociation', '=', 'association.idassociation')
        ->select('action.*', 'association.*', 'media.image')
        ->leftJoin('media', 'action.idmedia', '=', 'media.idmedia')
        ->where('action.idaction', $id)
        ->first();
        $demandebenevolat = DemandeBenevolat::join('action', 'demandebenevolat.idaction', '=', 'action.idaction')
        ->where('action.idaction', $id)
        ->get();
        $demandedon = DemandeDon::join('action', 'demande_don.idaction', '=', 'action.idaction')
        ->where('action.idaction', $id)
        ->get();
        $information = Information::join('action', 'information.idaction', '=', 'action.idaction')
        ->where('action.idaction', $id)
        ->get();
    	return view (
            "action", [
            'action'=>$action,
            'commentaires'=>$commentaires,
            'participationbenevolat'=>ParticipationBenevolat::all(),
            'participationdon'=>ParticipationDon::all(),
            'demandebenevolat'=>$demandebenevolat,
            'demandedon'=>$demandedon,
            'information'=>$information,
            'actionlike'=>ActionLike::all(),
        ]);
    }

    public function recherche(Request $request){
        $idthematique = $request->query('thematique');
        $idassociation = $request->query('association');
        $idtriagedate = $request->query('triagedate');
        $codepostal = $request->query('codepostal');
        $motscles = $request->query('motcles');
        
        //Toutes les thématiques
        $thematique_choisie = (object)[
            'idthematique' => '-',
            'libellethematique' => "Tous types de thématique",
        ];
        //Toutes les associations
        $association_choisie = (object)[
            'idassociation' => '-',
            'nomassociation' => "Toutes les associations",
        ];
        //Filtrage localisation choisie
        $loc = "Pas de filtrage";
        $motc = "Pas de mots clés";
        $filtrage = (object)[
            'date' => 'Pas de filtrage',
            'localisation' => $loc,
            'motscles' => $motc,
        ];




        //Récupération des données
        $query = Action::query()
        ->select('action.*', 'association.*', 'departement.*', 'media.image', 'demandebenevolat.codepostaladresse')
        ->join('association', 'action.idassociation', '=', 'association.idassociation')
        ->leftJoin('media', 'action.idmedia', '=', 'media.idmedia')
        ->leftJoin('demandebenevolat', 'action.idaction', '=', 'demandebenevolat.idaction')
        ->leftJoin('adresse', 'demandebenevolat.codepostaladresse', '=', 'adresse.codepostaladresse')
        ->leftJoin('departement', 'adresse.numdepartement', '=', 'departement.numdepartement');



        //Thématiques définies
        if ($idthematique != "-"){
            // Selection des actions en rapport avec la thématique choisie
            $query->join('thematique_action', 'action.idaction', '=', 'thematique_action.idaction')->where('thematique_action.idthematique', $idthematique)->get();
            $thematique_choisie = Thematique::find($idthematique);
        }

        //Associations définies
        if ($idassociation != "-"){
            // Selection des actions qui ont une thematique, en rapport avec l'association choisie
            $query->where('action.idassociation', $idassociation);
            $association_choisie = Association::find($idassociation);
        }

        //Filtrage sur la localisation
        if ($codepostal !=''){
            $query->where('demandebenevolat.codepostaladresse', $codepostal);
            $loc = $codepostal;
        }
        

        //Triage date défini
        if($idtriagedate > 0){
            //les plus récentes
            if ($idtriagedate == 1) {
                $actions = $query->orderBy('datepublicationaction', 'DESC')->get();
                $filtrage->date = "Plus récente d'abord";
            } else {
                // Les plus anciennes
                $actions = $query->orderBy('datepublicationaction', 'ASC')->get();
                $filtrage->date = "Plus ancienne d'abord";
            }
        }

        
        //mots clés
        if ($motscles != '') {
            $motc = $motscles;
                $motsClesArray = explode(' ', strtolower(trim($motc))); // Convertir la chaîne de mots-clés en minuscules et en tableau
            
                $query->where(function($query) use ($motsClesArray) {
                    foreach ($motsClesArray as $mot) {
                        $query->whereRaw('LOWER(action.titreaction) LIKE ?', ['%' . $mot . '%']);
                    }
                });
        }
            
        
        
        


        $actions = $query->get();
        

        return view ("recherche", [
            'thematiques'=>Thematique::all(),
            'actions' => $actions,
            'participationbenevolat'=>ParticipationBenevolat::all(),
            'participationdon'=>ParticipationDon::all(),
            'demandebenevolat'=>DemandeBenevolat::all(),
            'demandedon'=>DemandeDon::all(),
            'associations'=>Association::all(), 
            'thematique_choisie'=> $thematique_choisie,
            'association_choisie'=> $association_choisie,
            'triage_choisie'=>$idtriagedate,
            'filtrage'=>$filtrage,
            'codepostal'=>$codepostal,
            'motcles'=>$motscles,
            'actionlike'=>ActionLike::all(),
        ]);
    }

    public function welcome(){

        $actions = $query = Action::orderByDesc('datepublicationaction')->take(3)
        ->join('association', 'action.idassociation', '=', 'association.idassociation')
        ->leftJoin('media', 'action.idmedia', '=', 'media.idmedia')->get();
    	return view ("welcome", [
            'actions'=>$actions,
            'thematiques'=>Thematique::all() ,
            'associations'=>Association::all() ,
            'participationbenevolat'=>ParticipationBenevolat::all(),
            'participationdon'=>ParticipationDon::all(),
            'demandebenevolat'=>DemandeBenevolat::all(),
            'demandedon'=>DemandeDon::all(),
            'actionlike'=>ActionLike::all(),
        ]);
    }

    public function incrementerLikes(Request $request)
    {
        $commentaireId = $request->input('idcommentaire');
        $commentaire = Commentaire::find($commentaireId);

        if ($commentaire) {
            $commentaire->nblikecommentaire++;
            $commentaire->save();

            return view ("welcome", ['actions'=>Action::all() ]);
        }

        return view ("welcome", ['actions'=>Action::all() ]);
    }
}
