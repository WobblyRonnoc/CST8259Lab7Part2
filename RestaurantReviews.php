<?php
include_once "./Common/Classes.php";
include_once "./Common/Functions.php";

    session_start();
   
    $appConfigs = parse_ini_file("Lab7Part2.ini");
    extract($appConfigs);
    
    extract($_POST);
    $confirmation = false;
    
    $restNames = Array();

    //Add your code here to get all restaurant names from the restaurant review Web API



    
    if (isset($btnRestSelected) && $drpRestaurant !== '-1' && $drpRestaurant !== '-2')
    { 
         //Add your code here to get the user selected restaurant review from the restaurant review Web API
         //and display the result on the page. 

     

         //Uncomment the following line to display the restaurant review.
         //displayRestaurantDataOnPage($rest);

    }  
    else if (isset($btnRestSelected) && $drpRestaurant === '-2')
    {
        $rest = new Restaurant();
        displayRestaurantDataOnPage($rest);
    }
    else if (isset($btnSaveChange))
    {
            $rest = getRestaurantDataFromPage();

            //restore data on the page lost during post.
            $drpRatingMax = $rest->rating->maxRating;
            $drpRatingMin = $rest->rating->minRating;
            $drpCostMax = $rest->cost->maxCost;
            $drpCostMin = $rest->cost->minCost;

            //Add your code here to have save the changed restaurant review to the restaurant review Web API


    }
    else if (isset($btnDelete)) {
        
            //Add your code here to delete the user selected restaurant review from the restaurant review Web API


    }
    else if (isset($btnSaveNew)) {

            $rest = getRestaurantDataFromPage();

            //Add your code here to save the new restaurant review to the restaurant review Web API



    }
    include "./Common/Header.php";
?>

<div class="container"> 
     <div class="row vertical-margin">
        <div class="col-md-10 text-center"><h1>Online Restaurant Review</h1></div>
    </div>
    <br/>
    <form action="RestaurantReviews.php" method="post" id="restaurant-review-form">
        <p>Select a restaurant from the dropdown list to view/edit its review or create a new restaurant review</p>
        <div class="row form-group">
            <div class="col-md-2"><label>Restaurant:</label></div>
            <div class="col-md-6">
                <select name="drpRestaurant" id="drpRestaurant" class="form-control" onchange="onRestaurantChanged();">
                    <option value="-1" >Select ... </option>
                    <?php 
                        for($i = 0; $i < count($restNames); $i++) 
                        {
                             $name = $restNames[$i];
                             print "<option value='$i' ".(isset($drpRestaurant) && $drpRestaurant == $i ? 'Selected' :'' )." >$name</option>";
                        }  
                    ?>
                    <option disabled> ────────── </option>
                    <option value="-2" <?php print(isset($drpRestaurant) && $drpRestaurant === '-2' ? 'Selected' :'' )  ?> >Create a new Restaurant review </option>
                </select>
                <input type="submit" name="btnRestSelected" id="btnRestSelected" style="display: none" value="SelectRest">
            </div>
        </div>
        <div id="restaurant-info" >
            <div class="row form-group" style="display: <?php print isset($drpRestaurant) && $drpRestaurant === '-2' ? 'block':'none';?>">
                <div class="col-md-2"><label>Restaurant Name:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control"  style="width : 100%" name="txtRestName" value="<?php print isset($txtRestName)? $txtRestName:""; ?>"/>
                </div>
            </div>          
            <div class="row form-group">
                <div class="col-md-2"><label>Street Address:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control"  style="width : 100%" name="txtStreetAddress" value="<?php print isset($txtStreetAddress)? $txtStreetAddress:""; ?>"/>
                </div>
            </div>
             <div class="row form-group">
                <div class="col-md-2"><label>City:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control" style="width : 100%" name="txtCity"  value="<?php print isset($txtCity)? $txtCity:""; ?>"/>
                </div>
            </div>
             <div class="row form-group">
                <div class="col-md-2"><label>Province/State:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control"  style="width : 100%" name="txtProvinceState"  value="<?php print isset($txtProvinceState)? $txtProvinceState:""; ?>"/>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-2"><label>Postal/Zip Code:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control"  style="width : 100%" name="txtPostalZipCode"  value="<?php print isset($txtPostalZipCode)? $txtPostalZipCode:"";  ?>"/>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-2"><label>Summary:</label></div>
                <div class="col-md-6">
                    <textarea class="form-control" rows="6" style="width : 100%" name="txtSummary" ><?php print isset($txtSummary)? $txtSummary:"";?></textarea> 
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-2"><label>Food Type:</label></div>
                <div class="col-md-6">
                    <input type="text" class="form-control" style="width : 100%" name="txtFoodType"  value="<?php print isset($txtFoodType)? $txtFoodType:""; ?>"/>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-2"><label>Cost:</label></div>
                <div class="col-md-6">
                    <select name="drpCost" class="form-control">
                        <?php 
                            for($i = $drpCostMin; $i <= $drpCostMax; $i++) 
                            {
                                print "<option value='$i' ".(isset($drpCost) && $drpCost == $i ? 'Selected' :'' )." >$i</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-2"><label>Rating:</label></div>
                <div class="col-md-6">
                    <select name="drpRating" class="form-control">
                        <?php 
                            for($i = $drpRatingMin; $i <= $drpRatingMax; $i++) 
                            {
                                print "<option value='$i' ".(isset($drpRating) && $drpRating == $i ? 'Selected' :'' )." >$i</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row form-group" style="display: <?php print isset($drpRestaurant) && $drpRestaurant === '-2' ? 'none':'block';?>">
                <div class="col-md-10 col-md-offset-2">
                    <input type='submit'  class="btn btn-primary btn-min-width" name='btnSaveChange' value='Save Changes'/>
                    &nbsp; &nbsp;
                    <input type='submit'  class="btn btn-secondary btn-min-width" name='btnDelete' value='Delete This Restaurant'
                           onclick="return confirm('Please confirm to delete restaurant <?php print isset($txtRestName) ? $txtRestName:"" ; ?>');"/>
                </div>
            </div>
            <div class="row form-group" style="display: <?php print isset($drpRestaurant) && $drpRestaurant === '-2' ? 'block':'none';?>">
                <div class="col-md-10 col-md-offset-2">
                    <input type='submit'  class="btn btn-primary btn-min-width" name='btnSaveNew' value='Save New Restaurant'/>
                </div>
            </div>
            <div class="row" style="display: <?php print ($confirmation ?  'block' :'none' )?>" >
                <div class="col-md-8"><Label ID="lblConfirmation" class="form-control alert-success">
                    <?php print isset($confirmation)? $confirmation:""; ?></Label>
                </div>
            </div>
        </div>
    </form>
</div>
<br/>

<script type="text/javascript">
if (document.getElementById('drpRestaurant').value === "-1")
{ 
    document.getElementById('restaurant-info').style.display = 'none';
}

//event handler for restaurant name dropdown list
function onRestaurantChanged( )
{     
    if (document.getElementById('drpRestaurant').value !== "-1")
    {
        var selectRestButton = document.getElementById('btnRestSelected');
        selectRestButton.click();
    } 
    else
    {
         document.getElementById('restaurant-info').style.display = 'none';
    }
} 
 </script>
<?php include "./Common/Footer.php"; ?>