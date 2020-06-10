<?php
/*
	Author: Rahul the good student
id:102019464
*/


function registerUser()
{
	$fileExistsFlag= false;
	$xmlfile = '../../data/customer.xml';
	$email=($_GET["email"]);
  $name=($_GET["name"]);
  $password=($_GET["password"]);
  $phone=($_GET["phone"]);
 $lastname=($_GET["lastname"]);
	$doc = new DomDocument();

	if (!file_exists($xmlfile)){ // if the xml file does not exist, create a root node $customers
		$customers = $doc->createElement('customers');
		$fileExistsFlag = false;
		$doc->appendChild($customers);

		//create a customer node under customers node
	$customers = $doc->getElementsByTagName('customers')->item(0);
	$customer = $doc->createElement('customer');
	$customers->appendChild($customer);

	// create a Name node ....
	$Name = $doc->createElement('name');
	$customer->appendChild($Name);
	$nameValue = $doc->createTextNode($name);
	$Name->appendChild($nameValue);


	// create a Id node ....
	$cid = $doc->createElement('customerId');
	$customer->appendChild($cid);
	$i=0;
	$idValue= $doc->createTextNode('18851'.$i);
	$cid->appendChild($idValue);


	// create a last Name node ....
	$lName = $doc->createElement('lastname');
	$customer->appendChild($lName);
	$lnameValue = $doc->createTextNode($lastname);
	$lName->appendChild($lnameValue);


	// create a phone node ....
	$phonenum = $doc->createElement('phone');
	$customer->appendChild($phonenum);
	$pValue = $doc->createTextNode($phone);
	$phonenum->appendChild($pValue);

	//create a Email node ....
	$Email = $doc->createElement('email');
	$customer->appendChild($Email);
	$emailValue = $doc->createTextNode($email);
	$Email->appendChild($emailValue);

	//create a pwd node ....
	$pwd = $doc->createElement('password');
	$customer->appendChild($pwd);
	$pwdValue = $doc->createTextNode($password);
	$pwd->appendChild($pwdValue);

	//save the xml file
	$doc->formatOutput = true;
	$doc->save($xmlfile);
	echo "<p>Successfully registerd!</p>";
	echo "<a href=\"buyonline.htm\">Back to homepage</a>";
	}
	else { // load the xml file
		$doc->preserveWhiteSpace = FALSE;
		$doc->load($xmlfile);
		$fileExistsFlag= true;
		$nextId=getid($xmlfile);


	if(!checkXmlFile($xmlfile, $email)){
	//create a customer node under customers node
	$customers = $doc->getElementsByTagName('customers')->item(0);
	$customer = $doc->createElement('customer');
	$customers->appendChild($customer);

	// create a Name node ....
	$Name = $doc->createElement('name');
	$customer->appendChild($Name);
	$nameValue = $doc->createTextNode($name);
	$Name->appendChild($nameValue);


	// create a Id node ....
	$cid = $doc->createElement('customerId');
	$customer->appendChild($cid);
	$i=0;
	if($fileExistsFlag)
	{
		$i=$nextId;
	}
	$idValue= $doc->createTextNode('18851'.$i);
	$cid->appendChild($idValue);


	// create a last Name node ....
	$lName = $doc->createElement('lastname');
	$customer->appendChild($lName);
	$lnameValue = $doc->createTextNode($lastname);
	$lName->appendChild($lnameValue);


	// create a phone node ....
	$phonenum = $doc->createElement('phone');
	$customer->appendChild($phonenum);
	$pValue = $doc->createTextNode($phone);
	$phonenum->appendChild($pValue);

	//create a Email node ....
	$Email = $doc->createElement('email');
	$customer->appendChild($Email);
	$emailValue = $doc->createTextNode($email);
	$Email->appendChild($emailValue);

	//create a pwd node ....
	$pwd = $doc->createElement('password');
	$customer->appendChild($pwd);
	$pwdValue = $doc->createTextNode($password);
	$pwd->appendChild($pwdValue);

	//save the xml file
	$doc->formatOutput = true;
	$doc->save($xmlfile);
	echo "<p>Successfully registerd!</p>";
		echo "<a href=\"buyonline.htm\">Back to homepage</a>";
	}
	else
	{
		echo "<p>Email id already registered</p>";
	}

}
}

function startRegistration(){
  $phone=($_GET["phone"]);
  If (checkTheData() && checkThePassword()  && phoneNumberGood($phone) )
  {

			registerUser();
  }

  else{
  echo "<p>Registration Failed!</p>";
  }


}

function checkXmlFile($xmlfile, $email)
{

 $flag=false;
 $dom = DOMDocument::load($xmlfile);
 $cust= $dom->getElementsByTagName("customer");

foreach($cust as $node)
{
     $nodeEmail= $node->getElementsByTagName("email");
     $nodeEmail = $nodeEmail->item(0)->nodeValue;


	if (($nodeEmail == $email) )
    {
     $flag=true;


	}
}

return $flag;

}

                                                                           //Main program
function getid($xmlfile){
	$count=0;

 $dom = DOMDocument::load($xmlfile);
 $cust= $dom->getElementsByTagName("customer");

foreach($cust as $node)
{

	$count=$count+1;

}

return $count;
}

function checkTheData(){                                                         //data validatioin
  $flag=true;
  $emailid=($_GET["email"]);
  $name=($_GET["name"]);
  $password=($_GET["password"]);
  $cpassword=($_GET["cpassword"]);
  $phone=($_GET["phone"]);
 $lastname=($_GET["lastname"]);

  if(($name=="")||($cpassword=="")||($password=="")||($emailid=="")||($lastname==""))
  {

    $flag= false;
    echo "<p>All fields except Phone are mandatory</p>";
  }
else{
$flag=true;

}
return $flag;
}

function phoneNumberGood($phone)
{
  $flag = true;
if( (preg_match("/^[0]\d \d\d\d\d\d\d\d\d$/", $phone, $match)) || (preg_match("/^[0]\d\d\d\d\d\d\d\d\d$/", $phone, $match) )|| (preg_match("/^$/", $phone, $match)))
{
  $flag = true;
}
  else {
$flag = false;
    echo "<p>Phone format wrong</p>";}

  return $flag;
}

function checkThePassword(){

  $password=($_GET["password"]);
  $cpassword=($_GET["cpassword"]);

  if ($password==$cpassword){
    return true;
  }
  else{
    echo "<p>Password and confirm Password do not match</p>";
    return false;
}
}

if(isset($_GET["email"]))
{
$emailflag=false;

startRegistration();

}
?>
