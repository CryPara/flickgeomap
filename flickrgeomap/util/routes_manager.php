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


/*

Class that manage routing of pages

*/




require_once("routes.php");

$router = new Router();

if(isset($_POST)){
    
    /* return result of controller function and data passed by POST*/
    echo $router->execController($_POST['controller'],$_POST['function'],$_POST['data']);
}
else{
    header("Location ../");
}


?>