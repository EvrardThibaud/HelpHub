<?php

namespace App\Http\Controllers;

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
use App\Models\HistoriqueVisu;
use App\Models\Action;
use App\Models\ActionLike;
use App\Models\Adresse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function index(){
    	return view ("welcome", ['actions'=>Action::all() ]);
    }

    private function gererVisualisations($userId, $id) {
        $existingVisus = HistoriqueVisu::where('idutilisateur', $userId)->orderBy('numerovisu')->get();
    
        $existingIdActions = $existingVisus->pluck('idaction')->toArray();
    
        if (!in_array($id, $existingIdActions)) {
            $existingVisusCount = $existingVisus->count();
    
            if ($existingVisusCount === 0) {
                HistoriqueVisu::create([
                    'idaction' => $id,
                    'idutilisateur' => $userId,
                    'numerovisu' => 1,
                ]);
            } else if ($existingVisusCount === 1) {
                HistoriqueVisu::where('idutilisateur', $userId)->where('numerovisu', 1)->update(['numerovisu' => 2]);
                HistoriqueVisu::create([
                    'idaction' => $id,
                    'idutilisateur' => $userId,
                    'numerovisu' => 1,
                ]);
            } else {
                HistoriqueVisu::where('idutilisateur', $userId)->where('numerovisu', 3)->delete();
                HistoriqueVisu::where('idutilisateur', $userId)->where('numerovisu', 2)->update(['numerovisu' => 3]);
                HistoriqueVisu::where('idutilisateur', $userId)->where('numerovisu', 1)->update(['numerovisu' => 2]);
    
                HistoriqueVisu::create([
                    'idaction' => $id,
                    'idutilisateur' => $userId,
                    'numerovisu' => 1,
                ]);
            }
        }
    }
    

    //affichage d'un seule action sur la page action
    public function one(Request $request){
        $id = $request->query('id');
        if (!is_numeric($id)) {
            $id = -1;
        }
        $query = Commentaire::join('utilisateur', 'commentaire.idutilisateur', '=', 'utilisateur.idutilisateur')
        ->leftJoin('media', 'utilisateur.idmedia', '=', 'media.idmedia')
        ->where('commentaire.idaction', $id);
        $commentaires = $query->orderBy('datecommentaire', 'DESC')->get();
        $action = Action::join('association', 'action.idassociation', '=', 'association.idassociation')
        ->select('action.*', 'association.*', 'media.image')
        ->leftJoin('media', 'action.idmedia', '=', 'media.idmedia')
        ->where('action.idaction', $id)
        ->first();
        
        // Ajout de l'enregistrement HistoriqueVisu
        if (Auth::check()) {
            $userId = auth()->user()->idutilisateur;

            $this->gererVisualisations($userId, $id);
        }



    	return view (
            "action", [
            'action'=>$action,
            'commentaires'=>$commentaires,
            'participationbenevolat'=>ParticipationBenevolat::all(),
            'participationdon'=>ParticipationDon::all(),
            'actionlike'=>ActionLike::all()
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
        ->leftJoin('departement', 'adresse.numdepartement', '=', 'departement.numdepartement')
        ->where('action.valideparservice', true)
        ->where('action.visible', true);



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
        ->leftJoin('media', 'action.idmedia', '=', 'media.idmedia')
        ->where('action.valideparservice', true)
        ->where('action.visible', true)
        ->get();
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

    
    public function incrementerLikesAction(Request $request)
    {
        $actionId = $request->input('idaction');
        
        if (auth()->check()) {
            $user = auth()->user();
            $userLiked = ActionLike::where('idaction', $actionId)
            ->where('idutilisateur', $user->idutilisateur)
            ->first();            

            if ($userLiked) {
                // User has already liked the action, so unlike it
                ActionLike::where('idaction', $actionId)
                ->where('idutilisateur', $user->idutilisateur)
                ->delete();                return redirect()->back()->with('success', 'Like retiré avec succès!');
            } else {
                // User has not liked the action, so add like
                // Assuming 'likes' is the relationship method on the Action model
                $userLiked = ActionLike::create([
                    'idaction' =>  $actionId,
                    'idutilisateur' => $user->idutilisateur ,
                ]);
                return redirect()->back()->with('success', 'Like ajouté avec succès!');
            }
        } else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour effectuer cette action.');
        }

        // return redirect()->back()->with('message', 'Action non trouvée.');
    }



    public function participer(Request $request)
    {
    
        if (auth()->check()) {
            return view('form_participe');
        } else {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour participer à une action de bénévolat.');
        }
    }
    
    public function rendreInvisible(Request $request)
    {
        $actionId = $request->input('action_id');
        $visible = false;
        
        $UpdateDetails = Action::where('idaction', '=',  $actionId)->first();
        $UpdateDetails->visible = $visible;
        $UpdateDetails->save();

        return redirect()->back()->with('success', 'Cette action est maintenant invisible.');
    }

    public function rendreVisible(Request $request)
    {
        $actionId = $request->input('action_id');
        $visible = true;
        
        $UpdateDetails = Action::where('idaction', '=',  $actionId)->first();
        $UpdateDetails->visible = $visible;
        $UpdateDetails->save();

        return redirect()->back()->with('success', 'Cette action est maintenant visible.');
    }

}
