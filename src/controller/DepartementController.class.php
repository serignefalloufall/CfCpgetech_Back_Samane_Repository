<?php
/*==================================================
MODELE MVC DEVELOPPE PAR Ngor SECK
ngorsecka@gmail.com
(+221) 77 - 433 - 97 - 16
PERFECTIONNEZ CE MODELE ET FAITES MOI UN RETOUR
POUR TOUTE MODIFICATION VISANT A L'AMELIORER.
VOUS ETES LIBRE DE TOUTE UTILISATION.
===================================================*/ 
use libs\system\Controller; 
use src\model\DepartementRepository;

class DepartementController extends Controller{
    public function __construct(){
        parent::__construct();
    }
    /** 
     * url pattern for this method
     * localhost/projectName/Departement/
     */

    public function index(){

        return $this->view->load("departement/index");
    }
    /** 
     * url pattern for this method
     * localhost/projectName/Departement/getId/value
     */

    public function getId($id){
        $data['id'] = $id;

        return $this->view->load("Departement/get_id", $data);
    }
    
    public function get($id){
        
        $data['Departement'] = $tdb->getDepartement($id);
        
        return $this->view->load("Departement/get", $data);
    }
    /** 
     * url pattern for this method
     * localhost/projectName/Departement/liste
     */
    public function liste(){

         // Set HTTP Response Content Type
         header('Content-Type: application/json');
         //pour indiquer qui p acceder a ces resources
         header('Access-Control-Allow-Origin: *');
        $tdb = new DepartementRepository();
        
        $departements = $tdb->listeDepartement();


        foreach($departements as $departement)
                                {
                                    $departement = [
                                        "id" => $departement->getId(),
                                        "nom" => $departement->getNom(),
                                    ];
                    
                                    $data['myDepartementliste'][] = $departement;
                    
                                }



        http_response_code(200);
        echo json_encode($data);
        //return $this->view->load("Departement/liste", $data);
    }
     /** 
     * url pattern for this method
     * localhost/projectName/Departement/add
     */
    public function add(){

          // Set HTTP Response Content Type
          header('Content-Type: application/json');
          //pour indiquer qui p acceder a ces resources
          header('Access-Control-Allow-Origin: *');
          header("Access-Control-Allow-Methods: POST");
          header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

          $data = json_decode(file_get_contents("php://input"));
          //extract($_POST);

        $tdb = new DepartementRepository();
        
                //var_dump($_POST);
               // die;
                $departementObject = new Departement();
                
                $departementObject->setNom($data->nom);

                $ok = $tdb->addDepartement($departementObject);
                if($ok != null)
                     {
                         echo json_encode("departement added successfully");

                     }else{

                        echo json_encode("Erreur");

                     }
    }

     /** 
     * url pattern for this method
     * localhost/projectName/Departement/update
     */
    public function update(){
        $tdb = new DepartementRepository();
        if(isset($_POST['modifier'])){
            extract($_POST);
            if(!empty($id) && !empty($valeur1) && !empty($valeur2)) {
                $departementObject = new Departement();
                $departementObject->setId($id);
                $departementObject->setValeur1($valeur1);
                $departementObject->setValeur2($valeur2);
                $ok = $tdb->updateDepartement($departementObject);
            }
        }
        
        return $this->liste();
    }
     /** 
     * url pattern for this method
     * localhost/projectName/Departement/delete/value
     */
    public function delete($id){
        
        $tdb = new DepartementRepository();
        $tdb->deleteDepartement($id);
        return $this->liste();
    }
    /** 
     * url pattern for this method
     * localhost/projectName/Departement/edit/value
     */
    public function edit($id){
        
        $tdb = new DepartementRepository();
        
        $data['Departement'] = $tdb->getDepartement($id);
        var_dump($tdb->getDepartement($id));
        return $this->view->load("Departement/edit", $data);
    }
}
?>