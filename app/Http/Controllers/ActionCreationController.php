<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Action;
use App\Models\Association;
use App\Models\Commentaire;
use App\Models\Utilisateur;
use App\Models\ThematiqueAction;
use App\Models\ParticipationBenevolat;
use App\Models\ParticipationDon;
use App\Models\DemandeBenevolat;
use App\Models\DemandeDon;
use App\Models\Notification;
use App\Models\HistoriqueVisu;
use App\Models\Information;
use App\Models\Media;
use App\Models\ActionMedia;
use App\Models\Thematique;
use App\Models\Adresse;
use App\Models\User;
use App\Models\ActionLike;
use App\Models\SignalementCommentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class ActionCreationController extends Controller
{

    public function envoyerNotification(Action $action){
        $utilisateurs = User::all();
        foreach ($utilisateurs as $user) {
            Notification::create([
                'idutilisateur' => $user->idutilisateur,
                'idaction' => $action->idaction,
                'texte' => "Action créée.",

            ]);
        }
    }

    public function creerbenevolat(Request $request): RedirectResponse
    {
        
        $request->validate([
            'titreaction' => ['required', 'string', 'max:255'],
            'descriptionaction' => ['required', 'string', 'max:7000'],
            'media' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'competencesrequisesdb' => ['required', 'string', 'max:255'],
            'rue' => ['required', 'string', 'max:100'],
            'codepostaladresse' => ['required', 'int',"digits:5"],
            'nombreparticipantdb' => ['required', 'integer'],
        ]);
        
        // Vérifier si l'adresse existe pour le code postal donné
        $adresse = Adresse::where('codepostaladresse', $request->codepostaladresse)->first();

        if (!$adresse) {
            // Si l'adresse n'existe pas, créez-la
            $adresse = Adresse::create([
                'codepostaladresse' => $request->codepostaladresse,
                'villeadresse' => $request->rue, // Assurez-vous d'avoir la valeur de la ville dans la requête
                'numdepartement' => substr($request->codepostaladresse, 0, 2), // Adapter selon le format de vos codes postaux
                'coordonneex' => $request->coordonnex,
                'coordonneey' => $request->coordonney,
            ]);
        }

        if ($request->hasFile('media')) {
            if ($request->hasFile('media')) {
                $media = new Media(); // Assurez-vous d'ajuster selon votre modèle
        
                // Ajoutez le fichier à la collection 'images'
                $media->addMedia($request->file('media'))->toMediaCollection('images');
        
                // Vous pouvez également enregistrer d'autres informations dans votre modèle ici
                // $media->title = $request->input('title');
                // $media->description = $request->input('description');
                // $media->save();
        
                return response()->json(['message' => 'Media uploaded successfully']);
            }
        
            return response()->json(['error' => 'No file provided'], 400);
        }       

        $action = Action::create([
            'titreaction' => $request->titreaction,
            'descriptionaction' => $request->descriptionaction,
            'idassociation' => auth()->user()->association->idassociation,
            'valideparservice' => false,
        ]);
        if($request->motcles){
            $action->motcles = $request->motcles;
        }
        $image = $request->media;
        if($image){

            $imgPath = $image->store('actions/' . $action->idaction, 'public');
            
            
            $img = Media::create([
                'image' => $imgPath,
            ]);
            
            
            $actionMedia = ActionMedia::create([
                'idmedia' => $img->idmedia,
                'idaction' => $action->idaction,
            ]);
            
        }


        $demandebenevolat = DemandeBenevolat::create([
            'idaction' => $action->idaction,
            'codepostaladresse' => $request->codepostaladresse,
            'competencesrequisesdb' => $request->competencesrequisesdb,
            'nombreparticipantdb' => $request->nombreparticipantdb,
            'estpresentieldb' => $request->estpresentieldb,
        ]);

        $thematiques = Thematique::all();
        // Vérification si des thématiques ont été sélectionnées
        foreach ($thematiques as $thematique) {
            $checkboxName = 'thematique_' . $thematique->idthematique;
            if ($request->has($checkboxName)) {
                $them = ThematiqueAction::create([
                    'idaction' => $action->idaction,
                    'idthematique' => $thematique->idthematique,
                    
                ]);
            }
        }
        $demandebenevolat->adresse()->associate($adresse);
        $demandebenevolat->save();
        $this->envoyerNotification($action);

        return redirect()->route('profile.mesactions');
    }

    public function modifbenevolat(Request $request)
    {

        
        $request->validate([
            'titreaction' => ['required', 'string', 'max:255'],
            'descriptionaction' => ['required', 'string', 'max:7000'],
            'media' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'competencesrequisesdb' => ['required', 'string', 'max:255'],
            'rue' => ['required', 'string', 'max:100'],
            'codepostaladresse' => ['required', 'int',"digits:5"],
            'nombreparticipantdb' => ['required', 'integer'],
        ]);
        
        // Vérifier si l'adresse existe pour le code postal donné
        $adresse = Adresse::where('codepostaladresse', $request->codepostaladresse)->first();

        if (!$adresse) {
            // Si l'adresse n'existe pas, créez-la
            $adresse = Adresse::create([
                'codepostaladresse' => $request->codepostaladresse,
                'villeadresse' => $request->rue, // Assurez-vous d'avoir la valeur de la ville dans la requête
                'numdepartement' => substr($request->codepostaladresse, 0, 2), // Adapter selon le format de vos codes postaux
                'coordonneex' => $request->coordonnex,
                'coordonneey' => $request->coordonney,
            ]);
        }

        if ($request->hasFile('media')) {
            if ($request->hasFile('media')) {
                $media = new Media(); // Assurez-vous d'ajuster selon votre modèle
        
                // Ajoutez le fichier à la collection 'images'
                $media->addMedia($request->file('media'))->toMediaCollection('images');
        
                // Vous pouvez également enregistrer d'autres informations dans votre modèle ici
                // $media->title = $request->input('title');
                // $media->description = $request->input('description');
                // $media->save();
        
                return response()->json(['message' => 'Media uploaded successfully']);
            }
        
            return response()->json(['error' => 'No file provided'], 400);
        }       

        $action = Action::find($request->idaction);
        $action->titreaction = $request->titreaction;
        $action->descriptionaction = $request->descriptionaction;
        $action->motcles = $request->motcles;
        $action->valideparservice = false;

        $demandebenevolat = DemandeBenevolat::find($request->idaction);
        $demandebenevolat->codepostaladresse = $request->codepostaladresse;
        $demandebenevolat->competencesrequisesdb = $request->competencesrequisesdb;
        $demandebenevolat->nombreparticipantdb = $request->nombreparticipantdb;
        $demandebenevolat->estpresentieldb = $request->estpresentieldb;


        // Récupérer les ID des thématiques de la requête
        $requestedThematiques = [];
        $thematiques = Thematique::all();
        foreach ($thematiques as $thematique) {
            $checkboxName = 'thematique_' . $thematique->idthematique;
            if ($request->has($checkboxName)) {
                $requestedThematiques[] = $thematique->idthematique;
            }
        }

        // Récupérer les relations existantes pour cette action
        $existingThematiqueActions = ThematiqueAction::where('idaction', $action->idaction)->get();

        $thematiquesToDelete = $existingThematiqueActions
        ->whereNotIn('idthematique', $requestedThematiques)
        ->pluck('idthematique'); // Supposons que 'id' soit la clé primaire de ThematiqueAction
    
        // Supprimer les ThematiqueAction correspondantes
        ThematiqueAction::whereIn('idthematique', $thematiquesToDelete)->delete();
        

        // Ajouter de nouvelles relations pour les thématiques manquantes
        foreach ($requestedThematiques as $requestedThematique) {
            $existingRelation = ThematiqueAction::where('idaction', $action->idaction)
                                                ->where('idthematique', $requestedThematique)
                                                ->first();
            // Si la relation n'existe pas, crée-la
            if (!$existingRelation) {
                ThematiqueAction::create([
                    'idaction' => $action->idaction,
                    'idthematique' => $requestedThematique,
                ]);
            }
        }

        $demandebenevolat->adresse()->associate($adresse);
        $demandebenevolat->save();
        $action->save();


        return redirect()->route('profile.mesactions')->with('message', "Vous avez modifié cette action.");

    }

    public function creerdon(Request $request): RedirectResponse
    {

        
        $request->validate([
            'titreaction' => ['required', 'string', 'max:255'],
            'descriptionaction' => ['required', 'string', 'max:7000'],

            'ribdon' => ['required', 'string', 'max:255'],
            'objectifdon' => ['required', 'integer'],
        ]);

        $action = Action::create([
            'titreaction' => $request->titreaction,
            'descriptionaction' => $request->descriptionaction,
            'idassociation' => auth()->user()->association->idassociation,
            'valideparservice' => false,
        ]);
        if($request->motcles){
            $action->motcles = $request->motcles;
        }
        $image = $request->media;
        if($image){

            $imgPath = $image->store('actions/' . $action->idaction, 'public');
            
            
            $img = Media::create([
                'image' => $imgPath,
            ]);
            
            
            $actionMedia = ActionMedia::create([
                'idmedia' => $img->idmedia,
                'idaction' => $action->idaction,
            ]);
            
        }

        $demandedon = DemandeDon::create([
            'idaction' => $action->idaction,
            'ribdon' => $request->ribdon,
            'objectifdon' => $request->objectifdon,
            'avantagefiscal' => $request->avantagefiscal,
        ]);

        $thematiques = Thematique::all();
        // Vérification si des thématiques ont été sélectionnées
        foreach ($thematiques as $thematique) {
            $checkboxName = 'thematique_' . $thematique->idthematique;
            if ($request->has($checkboxName)) {
                $them = ThematiqueAction::create([
                    'idaction' => $action->idaction,
                    'idthematique' => $thematique->idthematique,
                    
                ]);
            }
        }
        $this->envoyerNotification($action);
        return redirect()->route('profile.mesactions');
    }

    public function modifdon(Request $request)
    {

        
        $request->validate([
            'titreaction' => ['required', 'string', 'max:255'],
            'descriptionaction' => ['required', 'string', 'max:7000'],

            'ribdon' => ['required', 'string', 'max:255'],
            'objectifdon' => ['required', 'integer'],
        ]);
        
        $action = Action::find($request->idaction);
        
        $action->titreaction = $request->titreaction;
        $action->motcles = $request->motcles;
        $action->descriptionaction = $request->descriptionaction;
        $action->valideparservice = false;

        $demandedon = DemandeDon::find($request->idaction);
        $demandedon->ribdon = $request->ribdon;
        $demandedon->objectifdon = $request->objectifdon;
        $demandedon->avantagefiscal = $request->avantagefiscal;


        // Récupérer les ID des thématiques de la requête
        $requestedThematiques = [];
        $thematiques = Thematique::all();
        foreach ($thematiques as $thematique) {
            $checkboxName = 'thematique_' . $thematique->idthematique;
            if ($request->has($checkboxName)) {
                $requestedThematiques[] = $thematique->idthematique;
            }
        }

        // Récupérer les relations existantes pour cette action
        $existingThematiqueActions = ThematiqueAction::where('idaction', $action->idaction)->get();

        $thematiquesToDelete = $existingThematiqueActions
        ->whereNotIn('idthematique', $requestedThematiques)
        ->pluck('idthematique'); // Supposons que 'id' soit la clé primaire de ThematiqueAction
    
        // Supprimer les ThematiqueAction correspondantes
        ThematiqueAction::whereIn('idthematique', $thematiquesToDelete)->delete();
        

        // Ajouter de nouvelles relations pour les thématiques manquantes
        foreach ($requestedThematiques as $requestedThematique) {
            $existingRelation = ThematiqueAction::where('idaction', $action->idaction)
                                                ->where('idthematique', $requestedThematique)
                                                ->first();
            // Si la relation n'existe pas, crée-la
            if (!$existingRelation) {
                ThematiqueAction::create([
                    'idaction' => $action->idaction,
                    'idthematique' => $requestedThematique,
                ]);
            }
        }

        $demandedon->save();
        $action->save();


        return redirect()->route('profile.mesactions')->with('message', "Vous avez modifié cette action.");

    }

    public function creerinformation(Request $request): RedirectResponse
    {

        
        $request->validate([
            'titreaction' => ['required', 'string', 'max:255'],
            'media' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'descriptionaction' => ['required', 'string', 'max:7000'],
        ]);
        
        

        $action = Action::create([
            'titreaction' => $request->titreaction,
            'descriptionaction' => $request->descriptionaction,
            'idassociation' => auth()->user()->association->idassociation,
            'valideparservice' => false,
        ]);
        if($request->motcles){
            $action->motcles = $request->motcles;
        }

        $image = $request->media;
        if($image){

            $imgPath = $image->store('actions/' . $action->idaction, 'public');
            
            
            $img = Media::create([
                'image' => $imgPath,
            ]);
            
            
            $actionMedia = ActionMedia::create([
                'idmedia' => $img->idmedia,
                'idaction' => $action->idaction,
            ]); 
        }
            
        $demandeinformation = Information::create([
            'idaction' => $action->idaction,
        ]);
            

        $thematiques = Thematique::all();
        // Vérification si des thématiques ont été sélectionnées
        foreach ($thematiques as $thematique) {
            $checkboxName = 'thematique_' . $thematique->idthematique;
            if ($request->has($checkboxName)) {
                $them = ThematiqueAction::create([
                    'idaction' => $action->idaction,
                    'idthematique' => $thematique->idthematique,
                    
                ]);
            }
        }
        $this->envoyerNotification($action);
        return redirect()->route('profile.mesactions');
    }

    public function modifinformation(Request $request): RedirectResponse
    {

        
        $request->validate([
            'titreaction' => ['required', 'string', 'max:255'],
            'descriptionaction' => ['required', 'string', 'max:7000'],
        ]);
        

        $action = Action::find($request->idaction);
        $action->titreaction = $request->titreaction;
        $action->motcles = $request->motcles;
        $action->descriptionaction = $request->descriptionaction;
        $action->valideparservice = false;



        // Récupérer les ID des thématiques de la requête
        $requestedThematiques = [];
        $thematiques = Thematique::all();
        foreach ($thematiques as $thematique) {
            $checkboxName = 'thematique_' . $thematique->idthematique;
            if ($request->has($checkboxName)) {
                $requestedThematiques[] = $thematique->idthematique;
            }
        }

        // Récupérer les relations existantes pour cette action
        $existingThematiqueActions = ThematiqueAction::where('idaction', $action->idaction)->get();

        $thematiquesToDelete = $existingThematiqueActions
        ->whereNotIn('idthematique', $requestedThematiques)
        ->pluck('idthematique'); // Supposons que 'id' soit la clé primaire de ThematiqueAction
    
        // Supprimer les ThematiqueAction correspondantes
        ThematiqueAction::whereIn('idthematique', $thematiquesToDelete)->delete();
        

        // Ajouter de nouvelles relations pour les thématiques manquantes
        foreach ($requestedThematiques as $requestedThematique) {
            $existingRelation = ThematiqueAction::where('idaction', $action->idaction)
                                                ->where('idthematique', $requestedThematique)
                                                ->first();
            // Si la relation n'existe pas, crée-la
            if (!$existingRelation) {
                ThematiqueAction::create([
                    'idaction' => $action->idaction,
                    'idthematique' => $requestedThematique,
                ]);
            }
        }

        $action->save();


        return redirect()->route('profile.mesactions')->with('message', "Vous avez modifié cette action.");
    }

    function accepteraction(Request $request, $id)
    {
        $action = Action::find($id);
    
        if ($action) {
            $action->valideparservice = true;
            $action->save();
            return redirect()->back()->with('message', "Vous avez accepté cette action.");
        } else {
            return redirect()->back()->with('message', 'error');
        }
    }

    function refuseraction(Request $request, $id)
    {
        $action = Action::find($id);
        
    
        if ($action) {

            $path = 'public/actions/' . $id;
            Storage::deleteDirectory($path);

            
            ThematiqueAction::where('idaction', $id)->delete();
            HistoriqueVisu::where('idaction', $id)->delete();
            DemandeBenevolat::where('idaction', $id)->delete();
            DemandeDon::where('idaction', $id)->delete();
            Information::where('idaction', $id)->delete();
            Action::where('idaction', $id)->delete();
            return redirect()->back()->with('message', "Vous avez refusé cette action.");
        } else {
            return redirect()->back()->with('message', 'error');
        }
    }

    public function ajouterimage(Request $request): RedirectResponse
    {

        try {
            $action = Action::find($request->idaction);
            $image = $request->media;
            if($image){
    
                $imgPath = $image->store('actions/' . $action->idaction, 'public');
                
                
                $img = Media::create([
                    'image' => $imgPath,
                ]);
                
                
                $actionMedia = ActionMedia::create([
                    'idmedia' => $img->idmedia,
                    'idaction' => $action->idaction,
                ]); 
            }
        
            return redirect()->route('profile.mesactions')->with('message', "Vous avez ajouté une image.");
        } catch (\Illuminate\Http\Exceptions\PostTooLargeException $e) {
            return redirect()->route('profile.mesactions')->with('message', "L'image est trop grande.");
        }
    }

    public function supprimeraction(Request $request): View{
        $id = $request->idaction;
        if (is_numeric($id)) {
            $action = Action::find($id);
    
            if ($action) {

                $path = 'public/actions/' . $id;
                Storage::deleteDirectory($path);
                

                HistoriqueVisu::where('idaction', $id)->delete();
                ThematiqueAction::where('idaction', $id)->delete();
                DemandeBenevolat::where('idaction', $id)->delete();
                DemandeDon::where('idaction', $id)->delete();
                Information::where('idaction', $id)->delete();
                ActionLike::where('idaction', $id)->delete();
                $commentaires = Commentaire::where('idaction', $id)->get();
                foreach ($commentaires as $commentaire) {
                    $idCommentaire = $commentaire->idcommentaire;
                    SignalementCommentaire::where('idcommentaire', $idCommentaire)->delete();
                }
                Commentaire::where('idaction', $id)->delete();
                Action::where('idaction', $id)->delete();
            } 
        }
        return view('profile.mesactions', [
            'id'=>$id,
            'actionlike'=>ActionLike::all(),
            'associations'=>Association::all() ,
            'participationbenevolat'=>ParticipationBenevolat::all(),
            'participationdon'=>ParticipationDon::all(),
            'demandebenevolat'=>DemandeBenevolat::all(),
            'demandedon'=>DemandeDon::all(),
            'actionlike'=>ActionLike::all(),
        ]);
    }
}