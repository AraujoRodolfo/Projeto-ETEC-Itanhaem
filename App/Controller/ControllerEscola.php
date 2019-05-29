<?php
    namespace App\Controller;

    use App\Controller\Controller;
    
    class ControllerEscola extends Controller{
        
        use \Src\Traits\TraitUrlParser;
        
        public function Sobre($n1 = null, $n2 = null , $n3 = null){
            echo "Sobre: ".$n1.$n2.$n3;
        }
        
        public function Localizacao(){
            echo "Localizacao";
        }
        
        public function Infraestrutura(){
            echo "Infraestrutura";
        }
        
        public function Calendario(){
            echo "Calendario";
        }
        
        public function HorarioEscolar(){
            echo "Horario escolar";
        }
        
        public function Observatorio(){
            echo "Observatorio";
        }
        
        public function RegimentoComum(){
            echo "Regimento comum";
        }
        
        public function APM(){
            echo "APM";
        }
        
        public function ConselhoDeEscola(){
            echo "Conselho de escola";
        }
        
        public function GremioEstudantil(){
            echo "Gremio estudantil";
        }
    }