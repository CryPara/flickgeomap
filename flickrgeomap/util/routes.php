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

/* Used by routes manager*/

require_once("settings.php");


class Router{

    protected $listControllers;
    public function __construct() {

        /*contain all pubblic controllers. Other are rejected*/
        $this->listControllers = Array();


        $this->listControllers['paths_controller'] = "PathsController";


    }



    /* exec request function and return a result*/
    public function execController($controller,$function,$data){




        try{

            //check if exist controller and if it's pubblic (in listControllers)
            if(file_exists(CONTROLLERS_PATH.$controller.".php") && isset($this->listControllers[$controller])){




                /* convert and include controller code*/
                require_once(CONTROLLERS_PATH.$controller.".php");



                $controllerName = $this->listControllers[$controller];
                $controllerOBJ = new $controllerName();

                //check if exist method in controller
                if(method_exists($controllerName,$function)){

                    //return method result
                    return $controllerOBJ->$function($data);

                }
                else{


                    return "Function not found";


                }

            }
            else{

                return "Controller not found";


            }
        }
        catch(Exception $e){

            return $e->getMessage();
        }
    }




}

?>
