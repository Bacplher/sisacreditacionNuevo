<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/facultad.php';

class facultadController extends Controller {    
    public function index() 
    {
        if (!isset($_GET['p'])){$_GET['p']=1;}
        if(!isset($_GET['q'])){$_GET['q']="";}        
        if(!isset($_GET['criterio'])){$_GET['criterio']="DescripcionFacultad";}
        
        $obj = new facultad();
        $data = array();             
        $data['data'] = $obj->index($_GET['q'],$_GET['p'],$_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows'=>$data['data']['rowspag'],'url'=>'index.php?controller=facultad&action=index','query'=>$_GET['q']));                
        
        $cols = array("CODIGO_FACULTAD","DESCRIPCION","DECANO","SecretarioAcademico","DirectorOCRA","Abreviatura");               
        
        $opt = array("codigofacultad"=>"Codigo Facultad","descripcionfacultad"=>"DescripcionFacultad");
        $data['grilla'] = $this->grilla("facultad",$cols, $data['data']['rows'],$opt,$data['pag'],true,true);
        $view = new View();
        $view->setData($data);
        $view->setTemplate( '../view/facultad/_Index.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
    }
    
    public function edit() {
        $obj = new facultad();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        $data['facultadesPadres'] = $this->Select(array('id'=>'idpadre','name'=>'idpadre','table'=>'facultades','code'=>$obj->idpadre));
        $view->setData($data);
        $view->setTemplate( '../view/facultad/_Form.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
    }
    public function save(){
        $obj = new facultad();
        if ($_POST['CodigoFacultad']=='') {
            $p = $obj->insert($_POST);
            if ($p[0]){
                header('Location: index.php?controller=facultad');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=facultad';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        } else {
            $p = $obj->update($_POST);
            if ($p[0]){
                header('Location: index.php?controller=facultad');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=facultad';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        }
    }
    public function delete(){
        $obj = new facultad();
        $p = $obj->delete($_GET['id']);
        if ($p[0]){
            header('Location: index.php?controller=facultad');
        } else {
        $data = array();
        $view = new View();
        $data['msg'] = $p[1];
        $data['url'] = 'index.php?controller=facultad';
        $view->setData($data);
        $view->setTemplate( '../view/_Error_App.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
        }
    }
    public function create() {
        $data = array();
        $view = new View();
        $data['facultadesPadres'] = $this->Select(array('id'=>'idpadre','name'=>'idpadre','table'=>'vista_facultad'));
        $view->setData($data);
        $view->setTemplate( '../view/facultad/_Form.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
    }
   
}
?>
