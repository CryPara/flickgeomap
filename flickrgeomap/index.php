<!--

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





-->



<!--

Index page that call header, view page request and footer

-->



<html>

    <head>
        <script type="text/javascript" src="view/js/jquery-1.11.3.min.js"></script>
        <link rel="stylesheet" href="view/css/flatly/bootstrap.css" media="screen">
        <link rel="stylesheet" href="view/css/flatly/bootswatch.min.css">
        <link rel="stylesheet" href="view/css/custom_style.css">
        
        

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>

    <body>

        <?php 


include_once("view/header.php");

if(isset($_GET['page'])){

    //SE IL FILE ESISTE



    include_once('view/'.$_GET['page'].'.php');


    // ALTRIMENTI INCLUDO LA 404

}
else{
    include_once('view/paths.php');
}

include_once("view/footer.php");



        ?>
    </body>

</html>