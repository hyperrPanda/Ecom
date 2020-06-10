<?php
/*
	Author: Rahul The Great
	Date: Best Date
*/

header('Content-Type: text/xml');

if(isset($_GET["itemname"])  ){

	$pitemname = $_GET["itemname"];
	$pitemp = $_GET["itemp"];
	$pitemq = $_GET["itemq"];
	$pitemdef = $_GET["itemdef"];



	$xmlfile = '../../data/goods.xml';

	$doc = new DomDocument();

	if (!file_exists($xmlfile)){ // if the xml file does not exist, create a root node $customers
		$goods= $doc->createElement('goods');
		$doc->appendChild($goods);
	}
	else { // load the xml file
		$doc->preserveWhiteSpace = FALSE;
		$doc->load($xmlfile);
	}

	//create a customer node under customers node
	$goods = $doc->getElementsByTagName('goods')->item(0);
	$good = $doc->createElement('good');
	$goods->appendChild($good);

	// create a Name node ....
	$itemname= $doc->createElement('itemname');
	$good->appendChild($itemname);
	$nameValue = $doc->createTextNode($pitemname);
	$itemname->appendChild($nameValue);

	//create a Email node ....
	$itemp= $doc->createElement('itemp');
	$good->appendChild($itemp);
	$goodValue = $doc->createTextNode($pitemp);
	$itemp->appendChild($goodValue);

	//create a pwd node ....
	$itemq = $doc->createElement('itemq');
	$good->appendChild($itemq);
	$iValue = $doc->createTextNode($pitemq);
	$itemq->appendChild($iValue);

	//create a pwd node ....
	$itemdef = $doc->createElement('itemdef');
	$good->appendChild($itemdef);
	$idef = $doc->createTextNode($pitemdef);
	$itemdef->appendChild($idef);


	//create a pwd node ....
	$itemsold = $doc->createElement('itemsold');
	$good->appendChild($itemsold);
	$isold = $doc->createTextNode(0);
	$itemsold->appendChild($isold);


	//create a pwd node ....
	$itemhold = $doc->createElement('itemonhold');
	$good->appendChild($itemhold);
	$ihold = $doc->createTextNode(0);
	$itemhold->appendChild($ihold);

$a = uniqid("BBXTX");
	//create a pwd node ....
	$itemnum = $doc->createElement('itemnumber');
	$good->appendChild($itemnum);
	$iNum = $doc->createTextNode($a);
	$itemnum->appendChild($iNum);

	//save the xml file
	$doc->formatOutput = true;
	$doc->save($xmlfile);
	echo "The item has been listed in the system, and the item number is : $a";

}
?>
