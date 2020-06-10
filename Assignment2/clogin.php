<?php
/*
	Author: Rahul The Great
	Date: Best Date
*/

//header('Content-Type: text/xml');
function checkXmlFile($xmlfile, $emailid, $password)
{

 $flag="0";
 $dom = DOMDocument::load($xmlfile);
 $cust= $dom->getElementsByTagName("customer");
//echo "check XML-$emailid--$password--<br>";
foreach($cust as $node)
{
     $nodeEmail= $node->getElementsByTagName("email");
		  $nodePassword= $node->getElementsByTagName("password");
			$nodecid= $node->getElementsByTagName("customerId");
     $nodeEmail = $nodeEmail->item(0)->nodeValue;
		 $nodePassword = $nodePassword->item(0)->nodeValue;
		 $nodecid = $nodecid->item(0)->nodeValue;
//echo "Your data-$nodeEmail--$nodePassword--<br>";

	if (($nodeEmail == $emailid) &&($nodePassword==$password))
    {
     $flag=$nodecid ;
	}
}

return $flag;

}




if(isset($_GET["emailid"])  ){

	$emailid = $_GET["emailid"];
	$password = $_GET["password"];


	$xmlfile = '../../data/customer.xml';

	$doc = new DomDocument();

	if (!file_exists($xmlfile)){ // if the xml file does not exist, create a root node $customers
		echo "Invalid Emailid";

	}
	else { // load the xml file
		$doc->preserveWhiteSpace = FALSE;
		$doc->load($xmlfile);
		$cID= checkXmlFile($xmlfile, $emailid, $password);
		if($cID!=="0")
		{header('Content-Type: application/json');
		echo json_encode(['customerid'=>$cID,'location'=>'buying.htm']);
		exit;

		}
		else{

			echo "<p>Email and Password do not match</p>";
		}
	}



}
?>
