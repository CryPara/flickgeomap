<?php


/*

    This file is writen By Filippo Randazzo and Cristina Parasiliti and is part of FlickrGeomap.

    FlickrGeomap is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    FlickrGeomap is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with FlickrGeomap.  If not, see <http://www.gnu.org/licenses/>.
    
    
    


*/

require_once(UTILS_PATH."settings.php");
require_once(MODELS_PATH."paths_model.php");



class PathsController{

    protected $model;


    public function __construct() {

        $this->model = new PathsModel();


    }


    

    
    /*
        Params : Data From and Data To
        Return : All row (all attributes) that have timestamp between dataFrom and dataTo
    
    */
    public function onePath($data){

        /*check if datas from client are setted */
        if(isset($data)){



            if(isset($data['from']) && isset($data['to'])){

                $toReturn = (object)array('result' =>$this->model->onePath($data['from'],$data['to']));



            }else {

                $toReturn = (object)array('result' => $data);


            }



        }else{
            $toReturn = (object)array('result' => 'missing data');



        }


        
        return json_encode($toReturn);   


    }




}



?>