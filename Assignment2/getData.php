<?php
/*
	Author: Rahul The Great
	Date: Best Date
*/

function cancelAll()
{
  $xmlfile = '../../data/cart.xml';
  $doc = new DOMDocument();
  $doc->load($xmlfile);
    $good= $doc->getElementsByTagName("customer");
   foreach($good as $node)
   {
        $nodeitempCart= $node->getElementsByTagName("itemp");
        $nodeitemqCart= $node->getElementsByTagName("itemq");
        $nodeitemnumCart= $node->getElementsByTagName("itemnumber");
          $nodeitempCart=  $nodeitempCart->item(0)->nodeValue;
          $nodeitemqCart=  	$nodeitemqCart->item(0)->nodeValue;
          $nodeitemnumCart=  	$nodeitemnumCart->item(0)->nodeValue;

                                                              $xmlfile2 = '../../data/goods.xml';

                                                            $doc2 = new DOMDocument();
                                                            $doc2->load($xmlfile2);
                                                              $good2= $doc2->getElementsByTagName("good");

                                                             foreach($good2 as $node2)
                                                             {
                                                                  $nodeitemname= $node2->getElementsByTagName("itemname");
                                                                  $nodeitemp= $node2->getElementsByTagName("itemp");
                                                                  $nodeitemq= $node2->getElementsByTagName("itemq");
                                                                  $nodeitemdef= $node2->getElementsByTagName("itemdef");
                                                                  $nodeitemonhold= $node2->getElementsByTagName("itemonhold");
                                                                  $nodeitemsold= $node2->getElementsByTagName("itemsold");
                                                                  $nodeitemnum= $node2->getElementsByTagName("itemnumber");

                                                                  $nodeitemname=  $nodeitemname->item(0)->nodeValue;
                                                                    $nodeitemdef= $nodeitemdef->item(0)->nodeValue;
                                                                $nodeitemp=  $nodeitemp->item(0)->nodeValue;
                                                                    $nodeitemq=  	$nodeitemq->item(0)->nodeValue;
                                                                    $nodeitemnum=  	$nodeitemnum->item(0)->nodeValue;
                                                                  $nodeitemsold=  $nodeitemsold->item(0)->nodeValue;
                                                                  $nodeitemonhold= $nodeitemonhold->item(0)->nodeValue;

                                                                  if($nodeitemnum==$nodeitemnumCart)
                                                                  {
                                                                    $nodeitemq=  $nodeitemq+ $nodeitemqCart;
                                                                    $nodeitemonhold= $nodeitemonhold-$nodeitemqCart;

                                                                    $node2->getElementsByTagName("itemq")->item(0)->nodeValue=$nodeitemq;
                                                                    $node2->getElementsByTagName("itemonhold")->item(0)->nodeValue=$nodeitemonhold;
                                                                    $doc2->save('../../data/goods.xml');
                                                                  }


                                                      }

  }

}



function finaliseCart($val)
{
if($val==1){
  $xmlfile = '../../data/cart.xml';
  $doc = new DOMDocument();
  $doc->load($xmlfile);
    $good= $doc->getElementsByTagName("customer");
   foreach($good as $node)
   {
        $nodeitempCart= $node->getElementsByTagName("itemp");
        $nodeitemqCart= $node->getElementsByTagName("itemq");
        $nodeitemnumCart= $node->getElementsByTagName("itemnumber");
          $nodeitempCart=  $nodeitempCart->item(0)->nodeValue;
          $nodeitemqCart=  	$nodeitemqCart->item(0)->nodeValue;
          $nodeitemnumCart=  	$nodeitemnumCart->item(0)->nodeValue;

                                                              $xmlfile2 = '../../data/goods.xml';

                                                            $doc2 = new DOMDocument();
                                                            $doc2->load($xmlfile2);
                                                              $good2= $doc2->getElementsByTagName("good");

                                                             foreach($good2 as $node2)
                                                             {
                                                                  $nodeitemname= $node2->getElementsByTagName("itemname");
                                                                  $nodeitemp= $node2->getElementsByTagName("itemp");
                                                                  $nodeitemq= $node2->getElementsByTagName("itemq");
                                                                  $nodeitemdef= $node2->getElementsByTagName("itemdef");
                                                                  $nodeitemonhold= $node2->getElementsByTagName("itemonhold");
                                                                  $nodeitemsold= $node2->getElementsByTagName("itemsold");
                                                                  $nodeitemnum= $node2->getElementsByTagName("itemnumber");

                                                                  $nodeitemname=  $nodeitemname->item(0)->nodeValue;
                                                                    $nodeitemdef= $nodeitemdef->item(0)->nodeValue;
                                                                $nodeitemp=  $nodeitemp->item(0)->nodeValue;
                                                                    $nodeitemq=  	$nodeitemq->item(0)->nodeValue;
                                                                    $nodeitemnum=  	$nodeitemnum->item(0)->nodeValue;
                                                                  $nodeitemsold=  $nodeitemsold->item(0)->nodeValue;
                                                                  $nodeitemonhold= $nodeitemonhold->item(0)->nodeValue;

                                                                  if($nodeitemnum==$nodeitemnumCart)
                                                                  {
                                                                    $nodeitemsold=  $nodeitemsold+ $nodeitemqCart;
                                                                    $nodeitemonhold= $nodeitemonhold-$nodeitemqCart;

                                                                    $node2->getElementsByTagName("itemsold")->item(0)->nodeValue=$nodeitemsold;
                                                                    $node2->getElementsByTagName("itemonhold")->item(0)->nodeValue=$nodeitemonhold;
                                                                    $doc2->save('../../data/goods.xml');
                                                                  }


                                                      }

  }

}
else {
  cancelAll();
}

}
function finaliseCustomerPurchase()
{
  $total= "$".getTotal();
  finaliseCart(1);
  echo "Your purchase has been confirmed and total amount due to pay is $total.";
  unlink('../../data/cart.xml');
}
function   cancelCustomerPurchase()
{
finaliseCart(0);
  echo "Your purchase request has been cancelled, welcome to shop next time";
unlink('../../data/cart.xml');
}


function getTotal()
{
  $total=0;
      $xmlfile = '../../data/cart.xml';
      $doc = new DOMDocument();
      $doc->load($xmlfile);
      // Create a XML document and display it
        $good= $doc->getElementsByTagName("customer");
       foreach($good as $node)
       {
            $nodeitemp= $node->getElementsByTagName("itemp");
            $nodeitemq= $node->getElementsByTagName("itemq");
            $nodeitemnum= $node->getElementsByTagName("itemnumber");

              $nodeitemp=  $nodeitemp->item(0)->nodeValue;
              $nodeitemq=  	$nodeitemq->item(0)->nodeValue;
              $nodeitemnum=  	$nodeitemnum->item(0)->nodeValue;
              $total= $total+ ($nodeitemp*$nodeitemq);
  }
return $total;
}

function   removeNode($pos)
{

  $xmlfile = '../../data/cart.xml';
  $doc = new DOMDocument();
  $doc->load($xmlfile);
$good= $doc->getElementsByTagName("customer")->item($pos);
$good->parentNode->removeChild($good);
$doc->save($xmlfile);
}


function drawShoppingCart()
{

  $xmlfile = '../../data/cart.xml';
  $doc = new DomDocument();
  if (file_exists($xmlfile))
  {


    $HTML="<strong>Shopping Cart<br></strong> <table width=\"80%\" cellspacing=\"2\" cellpadding=\"0\" border=\"5\" align=\"center\" bgcolor=\"#f2e6ff\" >

      <tr width=\"33%\" height=\"67\" cellspacing=\"22\" >
          <th >Item Number</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Remove</th>
        </tr>";
        $itemCount=0;
        $xmlfile = '../../data/cart.xml';
        $doc = new DOMDocument();
        $doc->load($xmlfile);
        // Create a XML document and display it
          $good= $doc->getElementsByTagName("customer");

         foreach($good as $node)
         {
           $itemCount=$itemCount+1;
              $nodeitemp= $node->getElementsByTagName("itemp");
              $nodeitemq= $node->getElementsByTagName("itemq");
              $nodeitemnum= $node->getElementsByTagName("itemnumber");

                $nodeitemp=  $nodeitemp->item(0)->nodeValue;
                $nodeitemq=  	$nodeitemq->item(0)->nodeValue;
                $nodeitemnum=  	$nodeitemnum->item(0)->nodeValue;

        $HTML= $HTML."<tr bgcolor=\"#f2e6ff\">
      <td>$nodeitemnum</td>
      <td>$nodeitemp</td>
      <td>$nodeitemq</td>
      <td><button id=\"$nodeitemnum\"onclick=\"RemoveIt(this.id);\">Remove From Cart</button></td>
      </tr>";
         }
         if ($itemCount==0){
           $totalAmount= 0;
           $HTML="";
         }else{ $totalAmount= getTotal();
           $HTML= $HTML."<tr bgcolor=\"#f8e6ff\">
         <td><button id=\"1\"onclick=\"finalisePurchase(this.id);\">Confirm Purchase</button></td>
          <td><button id=\"0\"onclick=\"finalisePurchase(this.id);\">Cancel Purchase</button></td>
          <td>Total Amount: $totalAmount</td>
         </tr>";
         }

         $doc->save($xmlfile);
  }
  else{
     $HTML="";
  }

echo   $HTML;
}


function updateCartNode($objectid,$itemLocation)
{
	$xmlfile = '../../data/cart.xml';
  $HTML="";
  $doc = new DOMDocument();
  $doc->load($xmlfile);
  // Create a XML document and display it
    $good= $doc->getElementsByTagName("customer");

   foreach($good as $node)
   {
   		  $nodeitemp= $node->getElementsByTagName("itemp");
   			$nodeitemq= $node->getElementsByTagName("itemq");
  			$nodeitemnum= $node->getElementsByTagName("itemnumber");

  		    $nodeitemp=  $nodeitemp->item(0)->nodeValue;
  				$nodeitemq=  	$nodeitemq->item(0)->nodeValue;
  				$nodeitemnum=  	$nodeitemnum->item(0)->nodeValue;

				if($objectid==$nodeitemnum)
				{
          $nodeitemq=$nodeitemq+1;
					$node->getElementsByTagName("itemq")->item(0)->nodeValue=$nodeitemq;
				}


	$HTML= $HTML."<tr bgcolor=\"#f2e6ff\">
<td>$nodeitemnum</td>
<td>$nodeitemp</td>
<td>$nodeitemq</td>
<td><button id=\"$objectid\"onclick=\"RemoveIt(this.id);\">Remove From Cart</button></td>
</tr>";
 //drawShoppingCart();
   }
   $doc->save($xmlfile);

}

function createCart($objectid, $itemPrice)                                                            //Create Shopping Cart
{
$HTML= "";
  $xmlfile = '../../data/cart.xml';
$cartExsistsFlag=false;
$doc = new DomDocument();

if (!file_exists($xmlfile)){ // if the xml file does not exist, create a root node $customers
  $customers = $doc->createElement('customers');
  $cartExsistsFlag=false;
  $doc->appendChild($customers);
  //$HTML="<table width=\"80%\" cellspacing=\"2\" cellpadding=\"0\" border=\"5\" align=\"center\" >

$customers = $doc->getElementsByTagName('customers')->item(0);
$customer = $doc->createElement('customer');
$customers->appendChild($customer);

$itemnum = $doc->createElement('itemnumber');
$customer->appendChild($itemnum);
$iNum = $doc->createTextNode($objectid);
$itemnum->appendChild($iNum);

//create a Email node ....
$itemp= $doc->createElement('itemp');
$customer->appendChild($itemp);
$goodValue = $doc->createTextNode($itemPrice);
$itemp->appendChild($goodValue);

$quantity=1;
$itemq = $doc->createElement('itemq');
$customer->appendChild($itemq);
$iValue = $doc->createTextNode($quantity);
$itemq->appendChild($iValue);


//save the xml file
$doc->formatOutput = true;
$doc->save($xmlfile);

//unlink($xmlfile);
$HTML = $HTML."<tr bgcolor=\"#cccc00\">
<td>$objectid</td>
<td>$itemPrice</td>
<td>$quantity</td>
<td><button id=\"$objectid\"onclick=\"RemoveIt(this.id);\">Remove From Cart</button></td>
</tr>";

//drawShoppingCart();
}
else {
  //$doc->appendChild($customers);                                                                                  // Create cart Node
  //$HTML="<table width=\"80%\" cellspacing=\"2\" cellpadding=\"0\" border=\"5\" align=\"center\" >
  $doc->preserveWhiteSpace = FALSE;
  $doc->load($xmlfile);

$customers = $doc->getElementsByTagName('customers')->item(0);
$customer = $doc->createElement('customer');
$customers->appendChild($customer);

$itemnum = $doc->createElement('itemnumber');
$customer->appendChild($itemnum);
$iNum = $doc->createTextNode($objectid);
$itemnum->appendChild($iNum);

//create a Email node ....
$itemp= $doc->createElement('itemp');
$customer->appendChild($itemp);
$goodValue = $doc->createTextNode($itemPrice);
$itemp->appendChild($goodValue);

$quantity=1;
$itemq = $doc->createElement('itemq');
$customer->appendChild($itemq);
$iValue = $doc->createTextNode($quantity);
$itemq->appendChild($iValue);


//save the xml file
$doc->formatOutput = true;
$doc->save($xmlfile);

//unlink($xmlfile);
$HTML = $HTML."<tr bgcolor=\"#cccc00\">
<td>$objectid</td>
<td>$itemPrice</td>
<td>$quantity</td>
<td><button id=\"$objectid\"onclick=\"RemoveIt(this.id);\">Remove From Cart</button></td>
</tr>";

//drawShoppingCart();
}
}


function checkitemStatus($objectid)
{
$xmlfile = '../../data/goods.xml';
$itemIsThere= true;
$itemPrice=0;
$itemQuantity=0;
$doc = new DOMDocument();
$doc->load($xmlfile);
// Create a XML document and display it
  $good= $doc->getElementsByTagName("good");
//Check if i have quantity in goods
 foreach($good as $node)
 {
      $nodeitemname= $node->getElementsByTagName("itemname");
 		  $nodeitemp= $node->getElementsByTagName("itemp");
 			$nodeitemq= $node->getElementsByTagName("itemq");
			$nodeitemdef= $node->getElementsByTagName("itemdef");
			$nodeitemonhold= $node->getElementsByTagName("itemonhold");
			$nodeitemsold= $node->getElementsByTagName("itemsold");
			$nodeitemnum= $node->getElementsByTagName("itemnumber");
			$nodeitemname=  $nodeitemname->item(0)->nodeValue;
				$nodeitemdef= $nodeitemdef->item(0)->nodeValue;
		$nodeitemp=  $nodeitemp->item(0)->nodeValue;
				$nodeitemq=  	$nodeitemq->item(0)->nodeValue;
				$nodeitemnum=  	$nodeitemnum->item(0)->nodeValue;
			$nodeitemsold=  $nodeitemsold->item(0)->nodeValue;
			$nodeitemonhold= $nodeitemonhold->item(0)->nodeValue;
	if($nodeitemnum==$objectid)
    {
      $itemPrice=$nodeitemp;
      $itemQuantity=$nodeitemq;
      if ($nodeitemq==0){
        $itemIsTherefalse=false;
      }
      else {
			return array ($itemIsThere, $itemPrice, $itemQuantity);
      }}}}


function readCart($itemid)

{
  $xmlfile = '../../data/cart.xml';
  $itemIsThere=false;
  $counter=0;
  $itemlocation=0;
  $currentquantity=0;
  $doc = new DOMDocument();
  $doc->load($xmlfile);
  // Create a XML document and display it
    $good= $doc->getElementsByTagName("customer");

   foreach($good as $node)
   {

   		  $nodeitemp= $node->getElementsByTagName("itemp");
   			$nodeitemq= $node->getElementsByTagName("itemq");
  			$nodeitemnum= $node->getElementsByTagName("itemnumber");

  		    $nodeitemp=  $nodeitemp->item(0)->nodeValue;
  				$nodeitemq=  	$nodeitemq->item(0)->nodeValue;
  				$nodeitemnum=  	$nodeitemnum->item(0)->nodeValue;

          if ($nodeitemnum==$itemid)
          {
            $itemIsThere=true;
            $itemlocation= $counter;
            $currentquantity= $nodeitemq;
          }
$counter=$counter+1;
}

return array( $itemIsThere,$itemlocation,$currentquantity);
}

function updateCart($nodeitemnum,$nodeitemp)
{
$HTML= "";
  $xmlfile = '../../data/cart.xml';
$cartExsistsFlag=false;
$doc = new DomDocument();

if (!file_exists($xmlfile)){ // if the xml file does not exist, create a root node $customers
  $customers = $doc->createElement('customers');
  $cartExsistsFlag=false;
  $doc->appendChild($customers);
  $HTML="<table width=\"80%\" cellspacing=\"2\" cellpadding=\"0\" border=\"5\" align=\"center\" >

    <tr width=\"33%\" height=\"67\" cellspacing=\"22\" >
        <th >Item Number</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Remove</th>
      </tr>";
}
else { // load the xml file
  $doc->preserveWhiteSpace = FALSE;
  $cartExsistsFlag=true;
  $doc->load($xmlfile);
  $itemArray= readCart($nodeitemnum);

}

//create a customer node under customers node
$customers = $doc->getElementsByTagName('customers')->item(0);
$customer = $doc->createElement('customer');
$customers->appendChild($customer);

$itemnum = $doc->createElement('itemnumber');
$customer->appendChild($itemnum);
$iNum = $doc->createTextNode($nodeitemnum);
$itemnum->appendChild($iNum);

//create a Email node ....
$itemp= $doc->createElement('itemp');
$customer->appendChild($itemp);
$goodValue = $doc->createTextNode($nodeitemp);
$itemp->appendChild($goodValue);

$quantity=1;
$itemq = $doc->createElement('itemq');
$customer->appendChild($itemq);
$iValue = $doc->createTextNode($quantity);
$itemq->appendChild($iValue);



//save the xml file
$doc->formatOutput = true;
$doc->save($xmlfile);

//unlink($xmlfile);
$HTML = $HTML."<tr bgcolor=\"#cccc00\">
<td>$nodeitemnum</td>
<td>$nodeitemp</td>
<td>$quantity</td>
<td><button id=\"$nodeitemnum\"onclick=\"RemoveIt(this.id);\">Remove From Cart</button></td>
</tr>";
echo $HTML;
}


function updateGoodsXml($objectid, $quantity)
{
	                                                                                             //This function updates the Good Xml doc
	$xmlfile = '../../data/goods.xml';
	$updateSuccesful=false;
$HTML="";
$doc = new DOMDocument();
$doc->load($xmlfile);
$elementNum=0;
// Create a XML document and display it
$updateSuccesful=false;
  $good= $doc->getElementsByTagName("good");
//Check if i have quantity in goods

 foreach($good as $node)
 {
      $nodeitemname= $node->getElementsByTagName("itemname");
 		  $nodeitemp= $node->getElementsByTagName("itemp");
 			$nodeitemq= $node->getElementsByTagName("itemq");
			$nodeitemdef= $node->getElementsByTagName("itemdef");
			$nodeitemonhold= $node->getElementsByTagName("itemonhold");
			$nodeitemsold= $node->getElementsByTagName("itemsold");
			$nodeitemnum= $node->getElementsByTagName("itemnumber");

			$nodeitemname=  $nodeitemname->item(0)->nodeValue;
				$nodeitemdef= $nodeitemdef->item(0)->nodeValue;
		$nodeitemp=  $nodeitemp->item(0)->nodeValue;
				$nodeitemq=  	$nodeitemq->item(0)->nodeValue;
				$nodeitemnum=  	$nodeitemnum->item(0)->nodeValue;
			$nodeitemsold=  $nodeitemsold->item(0)->nodeValue;
			$nodeitemonhold= $nodeitemonhold->item(0)->nodeValue;


if($quantity==-1)
{	if($nodeitemnum==$objectid)
    {
      $nodeitemq=$nodeitemq-1;
      $nodeitemonhold=$nodeitemonhold+1;
$node->getElementsByTagName("itemq")->item(0)->nodeValue=$nodeitemq;
$node->getElementsByTagName("itemonhold")->item(0)->nodeValue=$nodeitemonhold;

	  $updateSuccesful= true;
      }
    }
else {
  if($nodeitemnum==$objectid)
      {
        $nodeitemq=$nodeitemq+$quantity;
        $nodeitemonhold=$nodeitemonhold-$quantity;
  $node->getElementsByTagName("itemq")->item(0)->nodeValue=$nodeitemq;
  $node->getElementsByTagName("itemonhold")->item(0)->nodeValue=$nodeitemonhold;

  	  $updateSuccesful= true;
        }


}


}
 $doc->save('../../data/goods.xml');
return $updateSuccesful;
}




function readTheXml($xmlfile)
{
$HTML = "<table width=\"80%\" cellspacing=\"2\" cellpadding=\"0\" border=\"5\" align=\"center\" >

  <tr width=\"33%\" height=\"67\" cellspacing=\"22\" >
      <th >Item Number</th>
      <th>Item Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Add</th>
    </tr>";
  $dom = DOMDocument::load($xmlfile);
  $good= $dom->getElementsByTagName("good");
 //echo "check XML-$emailid--$password--<br>";
$doc = new DomDocument();
$doc->load($xmlfile);

  //echo ($doc->saveXML());
	//echo ($doc->saveXML());
 foreach($good as $node)
 {
      $nodeitemname= $node->getElementsByTagName("itemname");
 		  $nodeitemp= $node->getElementsByTagName("itemp");
 			$nodeitemq= $node->getElementsByTagName("itemq");
			$nodeitemdef= $node->getElementsByTagName("itemdef");
			$nodeitemonhold= $node->getElementsByTagName("itemonhold");
			$nodeitemsold= $node->getElementsByTagName("itemsold");
			$nodeitemnum= $node->getElementsByTagName("itemnumber");


			$nodeitemname=  $nodeitemname->item(0)->nodeValue;
				$nodeitemdef= $nodeitemdef->item(0)->nodeValue;
		$nodeitemp=  $nodeitemp->item(0)->nodeValue;
				$nodeitemq=  	$nodeitemq->item(0)->nodeValue;
				$nodeitemnum=  	$nodeitemnum->item(0)->nodeValue;
			$nodeitemsold=  $nodeitemsold->item(0)->nodeValue;
			$nodeitemonhold= $nodeitemonhold->item(0)->nodeValue;
// <span><button type="button">Add to cart</button><br>
			$nodeitemdef=substr($nodeitemdef, 0, 20);
			//displayData($nodeitemname,$nodeitemp,$nodeitemq, $nodeitemdef,$nodeitemnum);
		//"<br><span>item Number: ".$nodeitemnum."</span><br><span>Name: ".$nodeitemname."</span><br> <span>Description: ".	$nodeitemdef."</span><br> <span>Price: ".$nodeitemp."</span><br> <span>Quantity: ".$nodeitemq."</span><br>";

$HTML = $HTML."<tr bgcolor=\"#cccc00\">
<td>$nodeitemnum</td>
<td>$nodeitemname</td>
<td>$nodeitemdef</td>
<td>$nodeitemp</td>
<td>$nodeitemq</td>
<td><button id=\"$nodeitemnum\"onclick=\"AddIt(this.id);\">Add one to Cart</button></td>
</tr>";


//$HTML = $HTML."<br><span>item Number: </span><br>";
//$HTML=$HTML."heluuuuuu";
}
$HTML=$HTML."</table>";
	echo $HTML;
}

if(isset($_GET["listitems"])  )
{

$xmlfile = '../../data/goods.xml';

if (!file_exists($xmlfile)){ // if the xml file does not exist
	echo "There are no items to display";
} else {
	$doc = new DomDocument();
	//$doc->preserveWhiteSpace = FALSE;
	$doc->load($xmlfile);
	readTheXml($xmlfile);
  //	echo "list request";
}}

if(isset($_GET["objectid"])  )                                          //Here i will start Adding item in cart
{
  $removeFlag= $_GET["removeFlag"];
if ($removeFlag==1)
  {                                                     //Remove the items from cart

    $objectid= $_GET["objectid"];
    $itemArray= readCart($objectid);
    updateGoodsXml($objectid,$itemArray[2]);                             //( $itemIsThere,$itemlocation,$currentquantity);
    removeNode($itemArray[1]);
      drawShoppingCart();
  }
    else if ($removeFlag==0){                                     //Add item to cart

      $objectid= $_GET["objectid"];
      $xmlfile = '../../data/cart.xml';
      $doc = new DomDocument();
    $goodsArray=checkitemStatus($objectid);                     //($itemIsThere, $itemPrice, $itemQuantity);

      if($goodsArray[0])
    {
      if (!file_exists($xmlfile)){                              //Create the cart and update XML
        updateGoodsXml($objectid,-1);                         //-1 refers to adding quzntitu by 1
        createCart($objectid, $goodsArray[1]);
        drawShoppingCart();
      }
      else {                                                    //Cart already there so check cart for duplicates
     updateGoodsXml($objectid,-1);
       $itemArray= readCart($objectid);                           //( $itemIsThere,$itemlocation,$currentquantity);
       if($itemArray[0])
       {
         updateCartNode($objectid,$itemArray[1]);
         drawShoppingCart();
       } else{
         //createCartNode($objectid,$goodsArray[1]);
         createCart($objectid, $goodsArray[1]);
         drawShoppingCart();
       }}


     }
     else {
       echo "<br>Sorry This item is not avialable for sale<br>";
       drawShoppingCart();
     }

    }


}


if(isset($_GET["customerChoice"])  )                                          //Here i will start Adding item in cart
{
$choice= $_GET["customerChoice"];
if ($choice==1)
{
  finaliseCustomerPurchase();
}
  else
  {
    cancelCustomerPurchase();
  }


}

if(isset($_GET["logOutFlag"])  )
{
$choice= $_GET["logOutFlag"];
if ($choice==1)
{
  cancelCustomerPurchase();
}

}


?>
