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

/* class that link paths controller to db*/
require_once(UTILS_PATH."settings.php");
require_once (UTILS_PATH."database.php");


class PathsModel{
    protected $db;


    public function __construct() {

        $this->db = new Database();
        $this->db = $this->db->getDb();

    }




    /* return all datas from - to datas parameters*/
    public function onePath($from,$to){

        $query="SELECT id,owner,lon,lat,timestamp FROM Flickr WHERE `timestamp` BETWEEN ".$this->db->quote($from)." AND ".$this->db->quote($to)." ORDER BY `timestamp` ASC";



        
        $toReturn = $this->db->query($query)->fetchAll();
        
        
        
        return $toReturn;


        


    }



}


?>