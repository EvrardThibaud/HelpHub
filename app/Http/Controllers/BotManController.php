<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
   
class BotManController extends Controller
{
    
    public function handle()
    {
        $botman = app('botman');
   
        $botman->hears('{message}', function($botman, $message) {
   
            if ($message == 'Bonjour' || $message == 'bonjour') {
                $this-> askQuestion($botman);
            }
            
            else{
                $botman->reply("Commencez la conversasion par un Bonjour");
            }
   
        });

        $botman->hears('.*(problème|problèmes).*chargement.*(page|pages).*', function (BotMan $bot) {
            $response = "Je suis désolé d'entendre que vous rencontrez des problèmes de chargement de pages. Voici quelques suggestions :
                1. Assurez-vous d'avoir une connexion Internet stable.
                2. Essayez de rafraîchir la page.
                3. Vérifiez si d'autres navigateurs ou appareils fonctionnent correctement.";
        
            $bot->reply($response);
        });
        
        $botman->hears('.*(actions de bénévolat|dons|informations).*ne se charge pas*', function (BotMan $bot) {
            $response = "Il semble y avoir des problèmes avec le chargement de la page des actions de bénévolat, des dons ou des informations postées par des associations. 
                Voici quelques suggestions :
                1. Assurez-vous d'avoir une connexion Internet stable.
                2. Essayez de rafraîchir la page.
                3. Vérifiez si d'autres navigateurs ou appareils fonctionnent correctement.";
        
            $bot->reply($response);
        });

        $botman->hears('.*trouver.*(association|recherche).*', function (BotMan $bot) {
            $response = "Si vous ne trouvez pas l'association que vous recherchez, assurez-vous qu'elle est bien inscrite sur le site. Vérifiez la liste des associations à gauche de l'écran sous 'Choisissez une association :'.";
        
            $bot->reply($response);
        });
        
        $botman->hears('.*(filtre|recherche|date).*', function (BotMan $bot) {
            $response = "Pour la recherche par date, actuellement, il n'existe pas de filtre spécifique, mais vous pouvez trier les résultats par date. Sur la gauche de l'écran, vous pouvez cocher l'option :
                - Aucun triage
                - Plus récents d'abord
                - Plus anciens d'abord";
        
            $bot->reply($response);
        });


        $botman->hears('.*(proposer candidature|action bénévolat|participer).*', function (BotMan $bot) {
            $response = "Pour proposer votre candidature à une action bénévole, suivez ces étapes :
                1. Trouvez l'action bénévole qui vous intéresse.
                2. Cliquez sur 'Voir plus' en bas de la carte de l'action.
                3. Sur la page de l'action, cliquez à droite sur 'Participer à l'action' si l'objectif de participation n'est pas déjà atteint.
                4. Remplissez le formulaire requis.
                5. Soumettez votre candidature en cliquant sur 'S'inscrire'.
                
        Si tout est correct, vous verrez le message : 'Candidature ajoutée avec succès!'. Sinon, il peut y avoir un problème momentané, et dans ce cas, réessayez plus tard.";
        
            $bot->reply($response);
        });

        $botman->hears('.*(trouver|mes candidatures).*', function (BotMan $bot) {
            $response = "Pour trouver vos candidatures, suivez ces étapes :
                1. Assurez-vous d'être connecté en tant qu'utilisateur. Si vous n'avez pas encore de compte, cliquez sur 'Inscription' en haut à droite, choisissez 'Utilisateur' et remplissez le formulaire.
                2. Une fois connecté, cliquez sur 'Mon compte' en haut à droite.
                3. Dans la barre de menu bleu, sélectionnez 'Mes candidatures'.
                
        Si vous ne voyez aucune action, cela signifie que vous n'avez pas encore soumis de candidature. Sinon, vous verrez vos candidatures avec leur état précisé.";
        
            $bot->reply($response);
        });

        $botman->hears('.*(modifier|infos bancaires).*', function (BotMan $bot) {
            $response = "Pour modifier vos informations bancaires, suivez ces étapes :
                1. Assurez-vous d'être connecté en tant qu'utilisateur. Si vous n'avez pas encore de compte, cliquez sur 'Inscription' en haut à droite, choisissez 'Utilisateur' et remplissez le formulaire.
                2. Une fois connecté, cliquez sur 'Mon compte' en haut à droite.
                3. Sélectionnez 'Mes informations bancaires'.
                4. Vous verrez vos informations bancaires sur votre identité bancaire et votre carte bancaire.
                5. Si les informations sont déjà enregistrées, vous pouvez les supprimer en cliquant sur le bouton rouge. Pour les modifier, éditez le texte et cliquez sur 'Enregistrer ma carte' ou 'Enregistrer mes infos bancaires'.
                6. Si les informations ne sont pas encore enregistrées, remplissez les champs nécessaires, puis cliquez sur le même bouton.";
        
            $bot->reply($response);
        });

        $botman->hears('.*(mettre commentaire|commenter|action).*', function (BotMan $bot) {
            $response = "Pour mettre un commentaire sur une action, suivez ces étapes :
                1. Assurez-vous d'être connecté en tant qu'utilisateur. Si vous n'avez pas encore de compte, cliquez sur 'Inscription' en haut à droite, choisissez 'Utilisateur' et remplissez le formulaire.
                2. Une fois connecté, cliquez sur le logo HelpHub en haut à droite si vous êtes sur votre page personnelle.
                3. Cherchez l'action que vous souhaitez commenter.
                4. Faites défiler la page jusqu'à voir la section nommée 'Les commentaires'.
                5. Cliquez sur 'Votre commentaire' puis commencez à écrire votre commentaire. Assurez-vous que le commentaire soit respectueux, sinon il pourrait être signalé et supprimé.
                6. Cliquez ensuite sur 'Ajouter le commentaire'.
                7. Vous verrez le message 'Commentaire ajouté avec succès!' en bas à droite pendant quelques secondes si cela a fonctionné. Vous pourrez ensuite voir votre commentaire avec les autres commentaires déjà présents, avec le nombre de likes indiqué.";
        
            $bot->reply($response);
        });

        $botman->hears('.*(voir|mes commentaires).*', function (BotMan $bot) {
            $response = "Pour voir vos commentaires, suivez ces étapes :
                1. Assurez-vous d'être connecté en tant qu'utilisateur. Si vous n'avez pas encore de compte, cliquez sur 'Inscription' en haut à droite, choisissez 'Utilisateur' et remplissez le formulaire.
                2. Une fois connecté, cliquez sur 'Mon compte' en haut à droite.
                3. Sélectionnez 'Mes commentaires'.
                4. Vous verrez alors vos commentaires avec le nombre de likes, le nom de l'action et un bouton pour aller sur la page de l'action.
                5. Si vous n'avez encore fait de commentaire, cela sera indiqué par un message.";
        
            $bot->reply($response);
        });

        $botman->hears('.*(voir|page association).*', function (BotMan $bot) {
            $response = "Pour voir la page d'une association, suivez ces étapes :
                1. Trouvez une action postée par l'association que vous recherchez.
                2. Dans la barre de recherche à droite de l'écran, en dessous de 'Choisissez une association :', sélectionnez l'association dans la liste déroulante.
                3. Cliquez ensuite sur le bouton 'Rechercher'.
                4. Sur l'une des actions résultantes, cliquez sur le nom de l'association juste en dessous de l'image.
                
        Vous serez alors redirigé vers la page de l'association où vous pourrez en apprendre davantage sur elle.";
        
            $bot->reply($response);
        });

        $botman->hears('.*(voir|situe|lieu|localisation).*action bénévolat.*', function (BotMan $bot) {
            $response = "Pour voir où se situe une action de bénévolat, suivez ces étapes :
                1. Recherchez l'action que vous souhaitez.
                2. Vous pouvez voir directement le code postal et le département où se situe l'action.
                3. Pour voir exactement où se situe l'action, cliquez sur 'Voir plus'.
                4. À droite de l'écran, vous verrez l'adresse exacte indiquée, ainsi qu'une carte interactive avec un point montrant l'emplacement.
                5. Si c'est écrit 'Pas de lieu spécifique', cela signifie que l'association n'a pas précisé l'endroit, ou que c'est une action en présentiel (ce sera alors précisé à droite de l'écran sur la page de l'action), ou encore que c'est une action de dons ou une information.";
        
            $bot->reply($response);
        });
        

        

        
        

        $botman->listen();

   
    }
   
    /**
     * Place your BotMan logic here.
     */
    public function askQuestion($botman)
    {
        $botman->ask('Bonjour, comment puis-je vous aider aujourd’hui ?', function(Answer $answer) {
   
            $question = $answer->getText();
   
            $this->say('Votre question est bien la suivante : '.$question);
        });
    }
}


