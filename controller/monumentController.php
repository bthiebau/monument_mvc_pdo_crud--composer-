<?php
use App\Model\Monument;
use App\Model\MonumentManager;
// --------------------------------
// Contrôleur des monuments
// --------------------------------



if( !empty($_GET['action'])) {

    if( $_GET['action'] == 'create') {

        if(!empty($_POST)){
            if(!empty($_POST['nom']) && !empty($_POST['pays']) && !empty($_POST['ville']) && !empty($_POST['nbVisitesAn'])){
                try{
                    $monument = new Monument;
                    $monument->hydrate($_POST['nom'], $_POST['pays'], $_POST['ville'], $_POST['nbVisitesAn']);
                    MonumentManager::create($monument);
                    $success = 'Monument ajouté avec succès';
                }catch(Exception $error) {}
            }else{
                $error = new Exception ('Tous les champs sont obligatoires');
            }  
        } 
        require_once 'view/createMonumentForm.php';

    } else if( $_GET['action'] == 'update'){

            if(!empty($_GET['monument_id'])){
                try {
                    $monument = MonumentManager::getOne($_GET['monument_id']);
                    if(!empty($_POST)){
                        if(!empty($_POST['nom']) && !empty($_POST['pays']) && !empty($_POST['ville']) && !empty($_POST['nbVisitesAn'])){
                            try{
                                $monument->hydrate($_POST['nom'], $_POST['pays'], $_POST['ville'], $_POST['nbVisitesAn']);
                                MonumentManager::update($monument);
                                $success = 'Monument mis à jour avec succès';
                            }catch(Exception $error) {}
                        }else{
                            $error = new Exception ('Tous les champs sont obligatoires');
                        }  
                    } 
                    require_once 'view/updateMonumentForm.php';
                }catch(Exception $e){
                    require_once 'view/404View.php';
                }
            }else{
                require_once 'view/404View.php';
            }

    }elseif( $_GET['action'] == 'delete'){

        if(!empty($_GET['monument_id'])){
            try {
                $monument = MonumentManager::getOne($_GET['monument_id']);
                if(!empty($_POST['confirm'])){
                    if($_POST['confirm'] == 'OUI'){
                        try{
                            MonumentManager::delete($monument);
                            $success = 'Monument supprimé avec succès';
                        }catch(Exception $error) {}
                    }else{
                        header('Location:?page=monument&monument_id='.$monument->getId());
                    }  
                } 
                require_once 'view/deleteMonumentForm.php';
            }catch(Exception $e){
                require_once 'view/404View.php';
            }
        }else{
            require_once 'view/404View.php';
        }

    }else{
        require_once 'view/404View.php';
    }    
    
}elseif( !empty($_GET['monument_id']) ){

    try {
        $monument = MonumentManager::getOne( $_GET['monument_id'] );
        require_once 'view/monumentView.php';
    }catch(Exception $error) {
        require_once 'view/404View.php';
    }
    
}else{ 
    $monuments = MonumentManager::getAll();
    require_once 'view/monumentsView.php';
}
