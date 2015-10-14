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




/* Link with sqlite database using medoo framework (http://medoo.in/about) */


require_once("settings.php");
require_once(LIBS_PATH."db/medoo.php");






/*This class is used to interact with the database*/
class Database{

    protected $db;

    function __construct(){	


        $database_file = LIBS_PATH."db/flickr.sqlite";



        
        /* create new instance of medoo and set type and database file*/
        $this->db = new medoo([
            'database_type' => 'sqlite',
            'database_file' => $database_file
        ]);

        
    }
    
    
    /*return medoo instance (is protected)*/
    
    public function getDb(){
        
        return $this->db;
        
    }





}
?>
