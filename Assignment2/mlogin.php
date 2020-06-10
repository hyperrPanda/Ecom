                                                                          <!-- Here is the PHP code to create customers-->
<?php
/*
	Author: Rahul the Great who loves WAD
	102019464
*/
echo "Hi Today is " . date("Y-m-d-l");


function checkManagerLogin()
{

$uname= $_GET["uname"];
$password= $_GET["password"];

  $file = "../../data/manager.txt";
  if(!file_exists($file))
    echo "Manager file missing";
  else {
    $managers=file($file);
    $flag=0;
    for($i=0;$i<count($managers);$i++) {
      $curUsername= explode(",",$managers[$i]);

      if($uname==$curUsername[0])
        {
            $flag=1;
              if(strcmp($curUsername[1],$password)==1)
              {
                echo "<p>Welcome Manager->$uname</p>";
                echo "<p>Enter<a href=\"listing.htm\">Listings</a></p>";
                  echo "Go to<a href=\"processing.htm\">Processing</a>";
              }
                else {
                  echo "<p>Password wrong, Username Correct</p>";


                }
        }

      }
      if($flag==0)
      {
          echo "<p>Username not found</p>";
      }
    }

  }




if(isset($_GET["uname"]))
{
checkManagerLogin();


}


?>
