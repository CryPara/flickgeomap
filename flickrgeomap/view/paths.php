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






<div class="container">


    <div class="row">

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="row">

            </div>
        </div>
        <div class="col-md-3"></div>



    </div>

    <div class="row"> 


        <!--div of map-->
        <div class="col-md-8"><div id="googleMap" style="width:100%;height:80%;"></div></div>



        <!--div of option-->
        <div class="col-md-4">


            <!--div of chose (one or more users)-->
            <div class="row">

                <button class="btn btn-success col-md-5" id="showOneUser">One User Path</button>
                <div class="col-md-2"></div>
                <button class="btn btn-success col-md-5" id="showMoreUsers">More Users Paths</button>

            </div>





            <br>




            <!--div of data from and to-->
            <div class="row">
                <div class="row"><div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h4>Select Data Range</h4>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-2 text-center">
                        <h4> From:</h4>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control col-md-10 text-center " type="text" id="datafrom" placeholder="From Data (AAAA-MM-DD HH:MM:SS)" value="2015-07-11 10:10:00">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 text-center">
                        <h4> To:</h4>
                    </div>
                    <div class="col-md-10">
                        <input class="form-control text-center" type="text" id="datato" placeholder="To Data (AAAA-MM-DD HH:MM:SS)" value="2015-07-12 13:22:31">
                    </div>
                </div>



            </div>



            <br>




            <!--divs of selected type of operation-->

            <div id="oneUser" class="row" style="display:none;">

                <div class="row">
                    <div class="col-md-4 text-center">
                        <button  class="btn btn-warning " id="loadUsers">Load Users</button>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" style="display:none;" id="usersList"></select>
                    </div>
                </div>
                <br>
                <div class="row text-center" > 
                    <div class="col-md-12">
                        <button   class="btn btn-danger " id="loadMarker" style="display:none; width:100%;">Draw Path</button>
                    </div>
                </div>

            </div>







            <div id="moreUsers" class="row" style="display:none;">

                <div class="row">
                    <div class="col-md-4 text-center">

                        <button class="btn btn-warning" id="loadMultipleUsers">Load Users</button>


                    </div>
                    <div class="col-md-8">

                        <div class="row"><select class="form-control" name="multipleUsersList[]" id="multipleUsersList"  multiple style="display:none; width: 95%; "></select></div>
                        <div class="row text-center" style="margin-top:8px;"><span class="label label-info" id="multipleUserInfo" style="display:none;"> Ctrl+Click for multiple selection!</span></div>
                    </div>
                </div>
                <br>

                <div class="row text-center" > 

                    <button   class="btn btn-danger btn-sm" id="loadMultipleMarker" style="display:none;">Draw Paths</button>
                    <button   class="btn btn-danger btn-sm" id="loadSingleCentroidsMarker" style="display:none;">Draw Unique Centroid</button>


                    <button  class="btn btn-danger btn-sm" id="loadMultipleCentroidsMarker" style="display:none;">Draw Centroids</button>

                </div>

            </div>










        </div>








    </div>










    <script type="text/javascript" src="view/js/paths_action.js"></script>



</div>

