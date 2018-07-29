<?php 

    class indexController{

        public $isMobile;

        function __construct(){
            $isMobile = M('client')->isMobile();
        }

        function index(){

            $data = M('source')->queryhotsearch();
            VIEW::assign(array('data'=>$data));

            //if ($this->isMobile()){
            if($this->isMobile){
                VIEW::display('tpl/front/mobile/index.html');
            }
            else{   
                VIEW::display('tpl/front/pc/index.html');
            }

        }

    }

 ?>