<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodControllers extends Controller
{
    public function ListesDesPlats(){

        // Récupération des menus de la semaine
        $menus = DB::table('menus_journaliers')
            ->join('plats','plats.id_plats','=','menus_journaliers.id_plat')
            ->orderBy('menus_journaliers.id_menus_journaliers','asc')
            ->get();

        // Regrouper les menus par jour et préparer la sortie
        $MenuJournaliers = [];

        foreach ($menus as $menu) {
            $dateMenu = $menu->date_menu;
            $idPlat = $menu->id_plats;

            $accompagnements = DB::table('accompagnements')
                ->whereIn('id_accompagnements',json_decode($menu->id_accompagnement))
                ->get()->toArray();
            ;

            if (!isset($MenuJournaliers[$dateMenu])) {
                $MenuJournaliers[$dateMenu] = [
                ];
            }

            $MenuJournaliers[$dateMenu][] = [
                'id_plat' => $idPlat,
                'nom_plat'=> $menu->nom_plat,
                'image'=> $menu->image,
                'accompagnements' => $accompagnements,
            ];
        }



        //Renvoie la liste des plats en JSON.
        return response()->json($MenuJournaliers, 201);
    }


    //connexion a la son espace
    public function login(Request $request){

        //Recuperation des variables de connexion
        $email = $request->input('email');
        $password = $request->input('password');

        //verification s'il existe dans la table users
        $userData = DB::table('users')
            ->where('email','=',$email)
            ->where('password','=',md5($password))->first();


        if ($userData) {
            return response()->json($userData, 201);
        }else{
            return response()->json(406);
        }
    }


    //creation d'un salarié
    public function store(Request $request){

        //Recuperation des variables de connexion
        $email = $request->input('email');
        $nom = $request->input('nom');
        $password = $request->input('password');

        //creation de l'utilisateur
        $userDataInsert = DB::table('users')
            ->insert(array(
                'name' => $nom,
                'email' => $email,
                'type'=>1,
                'password' => md5($password)
            ));


        //recuperation des informations de l'utilisateur
        $userData = DB::table('users')
            ->where('email','=',$email)
            ->where('password','=',md5($password))->first();



        if ($userData) {
            return response()->json($userData, 201);
        }else{
            return response()->json(406);
        }
    }


    //Recuperation des informations du panier
    public function panier(Request $request){


        // Décoder le contenu JSON de la requête
        $produits = json_decode($request->getContent(), true);


        // Grouper les produits par plat en utilisant la fonction groupByPlat
        $allPlats = $this->groupByPlat($produits);


        $Plats = [];

        // Parcourir chaque groupe de plats
        foreach ($allPlats as $allPlat){

            // Récupérer les informations sur le plat principal à partir de la base de données
            $platsInfo = DB::table('plats')->where('id_plats','=',$allPlat['plat'])->first();

            // Récupérer les informations sur les accompagnements du plat de la base de données
            $accompagnementsInfo = DB::table('accompagnements')->whereIn('id_accompagnements',$allPlat['accompagnement'])->get()->toArray();

            // Créer un tableau associatif contenant les informations sur le plat et les accompagnements
            // Ajouter le tableau d'informations sur le plat au tableau $Plats
            $Plats [] = [
                'plats'=>$platsInfo,
                'accompagnement'=>$accompagnementsInfo
            ];
        }

        // Renvoyer une réponse JSON contenant le tableau $Plats
        return response()->json($Plats, 201);






    }

    function groupByPlat($data) {
        $groupedData = [];
        foreach ($data as $item) {
            $plat = $item['plat'];
            if (!isset($groupedData[$plat])) {
                $groupedData[$plat] = ['accompagnement' => []];
            }
            $groupedData[$plat]['plat'] = $plat;
            $groupedData[$plat]['accompagnement'][] = $item['accompagnement'];
        }
        return $groupedData;
    }


    public function storeCommande(Request $request)
    {

        // Récupérer les données des commandes depuis la requête
        $commandes = json_decode($request->getContent(), true);



        // Parcourir chaque commande et l'insérer dans la base de données
        foreach ($commandes as $commandeData) {
            DB::table('commandes')->insert([
                'id_users'=>$commandeData['users'],
                'id_plat' => $commandeData['id_plat'],
                'nom_plat' => $commandeData['nom_plat'],
                'prix_plat' => $commandeData['prix_plat'],
                'accompagnement' => json_encode($commandeData['accompagnement']),
                'total_commande' => $commandeData['total_commande'],
            ]);
        }

        // Renvoyer une réponse appropriée
        return response()->json(['message' => 'Commandes enregistrées avec succès !'],201);
    }

    // Cette fonction récupère une liste de commandes en fonction de filtres optionnels.
    public function ListesCommandes($users,$dateDebut,$dateFin){


        // On initialise la requête en ciblant la table 'commandes'.
        $allsCommande = DB::table('commandes')
            ->join('users','users.id_users','=','commandes.id_users')
        ;

        // Filtre par ID utilisateur si fourni
        if ($users != 'null'){
            $allsCommande->where('id_users','=',$users);
        }

        // Filtre par date de commande si une date de début est fournie
        if ($dateDebut != 'null'){

            $allsCommande->whereDate('dateCommande','>',$dateDebut);
        }

        // Filtre par date de commande si une date de fin est fournie
        if ($dateFin != 'null'){

            $allsCommande->whereDate('dateCommande','<',$dateFin);
        }

        // Récupérez toutes les commandes correspondantes et convertissez-les en tableau
        $commandes = $allsCommande->get()->toArray();

        // Renvoie une réponse JSON avec un code de statut 201 (Créé)
        return response()->json($commandes,201);
    }
}
