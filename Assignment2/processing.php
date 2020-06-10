<?php
/*
	Author: Rahul the Great who loves WAD
	102019464
*/
function   removeNode($garray)
{

  $xmlfile = '../../data/goods.xml';
  $doc = new DOMDocument();
  $doc->preserveWhiteSpace = FALSE;
  $doc->load($xmlfile);
  $count=0;
  foreach($garray as $pos)
  {
    $good= $doc->getElementsByTagName("good")->item($pos-$count);
    $good->parentNode->removeChild($good);
    $count=$count+1;
  }
$doc->save($xmlfile);
}


function   processGoods()
{
$xmlfile = '../../data/goods.xml';
 //echo "check XML-$emailid--$password--<br>";
$doc = new DomDocument();
$doc->load($xmlfile);
  $good= $doc->getElementsByTagName("good");
$counter=0;
$stack = array();

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

if($nodeitemsold>0)

{
      	$node->getElementsByTagName("itemsold")->item(0)->nodeValue=0;


}
if(($nodeitemq==0) && ($nodeitemonhold==0))
{
  array_push($stack,$counter );

}

$counter=$counter+1;
}
$doc->save($xmlfile);
echo "Processing Completed";
return $stack;
}



function readTheXml($xmlfile)
{
$HTML = "<table width=\"80%\" cellspacing=\"2\" cellpadding=\"0\" border=\"5\" align=\"center\" >

  <tr width=\"33%\" height=\"67\" cellspacing=\"22\" >
      <th >Item Number</th>
      <th>Item Name</th>
      <th>Price</th>
      <th>Quantity Avialable</th>
      <th>Quantity On Hold</th>
      <th>Quantity sold</th>
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

if($nodeitemsold>0)

{
  $HTML = $HTML."<tr bgcolor=\"#cccc00\">
  <td>$nodeitemnum</td>
  <td>$nodeitemname</td>
  <td>$nodeitemp</td>
  <td>$nodeitemq</td>
  <td>$nodeitemonhold</td>
  <td>$nodeitemsold</td>

  </tr>";
}

}
$HTML= $HTML."<tr bgcolor=\"#f8e6ff\">
<td><button id=\"1\"onclick=\"process(this.id);\">Process</button></td>
</tr>";
$HTML=$HTML."</table>";
	echo $HTML;
}



if(isset($_GET["listitems"])  )
{
  $flag= $_GET["listitems"];
  $xmlfile = '../../data/goods.xml';

  if (!file_exists($xmlfile)){ // if the xml file does not exist
  	echo "There are no items to display";
  } else {
  	$doc = new DomDocument();
  	//$doc->preserveWhiteSpace = FALSE;
  	$doc->load($xmlfile);
  	readTheXml($xmlfile);
    //	echo "list request";
  }

if($flag==1)
{

$goodsArray=  processGoods();
if($goodsArray)
{
  removeNode($goodsArray);
}


}
}
?>
