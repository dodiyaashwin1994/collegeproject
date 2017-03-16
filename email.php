<!-- 
Form
Form is used to take train number, user email and journey date from user and stores in three variable  $trainnum, $email and $jrnydate.

Php Function
Then above three variable are inserted into mysql table 'sms' using insert into query in php.

Javascript
javascript is used to validate two input variables ($trainnum and $email) in the form.
-->

<div class="headline">
   <div class="container">
     <div class="col-lg-12 col-xs-12 home">
        <h1>Train Status on Email</h1>
         <!--googleoff: index-->
           <form name="myForm" method="post" onsubmit="return validateForm()" > 
            <div class="row">
                 <div class="col-md-4 col-xs-12" style="text-align:left; padding-left:0; padding-right:0">
                    <div class="form-group form-group-lg">
                      <i class="fa fa-map-marker input-icon"></i>
                      <label>Enter Train Number</label>
                      <input class="form-control" type="text" name="trainnum" placeholder="enter train number" id="trainnum" style="padding-left:45px;"/>
                    </div>
                 </div>

                 <div class="col-md-4 col-xs-12" style="text-align:left; padding-left:0; padding-right:0">
                    <div class="form-group form-group-lg">
                      <i class="fa fa-map-marker input-icon"></i>
                      <label>Enter Your Email</label>
                      <input class="form-control" type="text" name="email" placeholder="enter your email" id="email" style="padding-left:45px;"/>
                    </div>
                 </div>

                 <div class="col-md-4 col-xs-12" style="text-align:left ; padding-left:0; padding-right:0">
                              <div class="form-group form-group-lg ">
                              <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
                              <label>Journey Date</label>
                                              <select class="form-control" name="jrnydate" style="padding-left:45px;">
                                                      <option value="<?php echo date("Ymd");?>" selected="selected"><?php echo date("d-M-Y");?></option>
                                                      <option value="<?php echo date("Ymd", strtotime('+1 days'));?>"><?php echo date("d-M-Y", strtotime('+1 days'));?>
                                                      </option>  
                                                      <option value="<?php echo date("Ymd", strtotime('+2 days'));?>"><?php echo date("d-M-Y", strtotime('+2 days'));?>
                                                      </option>
                                                      <option value="<?php echo date("Ymd", strtotime('+3 days'));?>"><?php echo date("d-M-Y", strtotime('+3 days'));?>
                                                      </option>
                                                      <option value="<?php echo date("Ymd", strtotime('+4 days'));?>"><?php echo date("d-M-Y", strtotime('+4 days'));?>
                                                      </option>

                                              </select>
                              </div>
                        </div>

                <div class="col-md-4 col-xs-hidden">
                </div>

               <div class="col-md-4 col-xs-12" style="text-align:center; padding-top: 24px; padding-left:0px; padding-right:0px;">
                   <button class="btn btn-primary btn-lg" style="border-radius:0;width:100%;" type="submit" name="submit" value="submit" >Submit</button>
              </div>

              <div class="col-md-4 col-xs-hidden">
              </div>

          </form>
<!--googleon: index-->

       </div>
     </div>
   </div>
   <?php include('ads.php');?>
</div>
</header>
<?php
if(isset($_POST['submit']))
{
$trainnum=mysqli_real_escape_string($conn,$_POST['trainnum']);  //stores train number 
$email=mysqli_real_escape_string($conn,$_POST['email']);        // stores email address of user
$jrnydate=mysqli_real_escape_string($conn,$_POST['jrnydate']);  // stores journey date
if(!empty($trainnum) && !empty($email) && !empty($jrnydate))    // check that all 3 conditions are true
  {
     $sql="INSERT INTO sms (trainnum, email, jrnydate) VALUES('$trainnum','$email','$jrnydate')";  //sql query to insert into sms table
     if(mysqli_query($conn,$sql))   // if query successfully executed then returns true else false
     {
     echo "<div class='container train' style='padding-right: 0 !important; padding-left: 0 !important;'>";
     echo "<div class='row' style='text-align: center; padding: 20px; margin:0;'>";
        echo "<h3>You Have Successfully Registered</h3>"; // prints message of successfull registration
     echo "</div>";
     echo "</div>";
     }
     else{
     echo "<div class='container train' style='padding-right: 0 !important; padding-left: 0 !important;'>";
     echo "<div class='row' style='text-align: center; padding: 20px; margin:0;'>";
        echo "<h3>Failed to Register</h3>"; // prints message of registration failure
     echo "</div>";
     echo "</div>";
     }
     
  }
}

?>
<!--form validation-->
<script>
function validateForm() {
    var x = document.forms["myForm"]["trainnum"].value; //stores value of train number in x
    var y = document.forms["myForm"]["email"].value;    //stores value of email in y
    var atpos = y.indexOf("@"); 
    var dotpos = y.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=y.length) {   // checks postion of @ and dot in y
        alert("Not a valid e-mail address");
        return false;
    }
         if(isNaN(x)||x.indexOf(" ")!=-1)    // check whether x is interger 
           {
              alert("Please enter trainnum")
              return false; 
           }
           
           if (x.length !=5)                 // check whether x lenght of x is 5
           {
                alert("enter 5 digit train number");
                return false;
           }
}

</script>