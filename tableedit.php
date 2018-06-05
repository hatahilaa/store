<?php
	require_once('auth.php');
?>
<?php
include('db.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Syst&egrave;me inventaire du HVP Gatagara, Branche de Rwamagana</title>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
$("#first_"+ID).show();
$("#last_"+ID).hide();
$("#last_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var first=$("#first_input_"+ID).val();
var last=$("#last_input_"+ID).val();
var dataString = 'id='+ ID +'&price='+first+'&qty_sold='+last;
$("#first_"+ID).html('<img src="load.gif" />');


if(first.length && last.length>0)
{
$.ajax({
type: "POST",
url: "table_edit_ajax.php",
data: dataString,
cache: false,
success: function(html)
{

$("#first_"+ID).html(first);
$("#last_"+ID).html(last);
}
});
}
else
{
alert('Enter something.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});
</script>
<style>
body
{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
padding:10px;
}
.editbox
{
display:none
}
td
{
padding:7px;
border-left:1px solid #fff;
border-bottom:1px solid #fff;
}
table{
border-right:1px solid #fff;
}
.editbox
{
font-size:14px;
width:29px;
background-color:#ffffcc;

border:solid 1px #000;
padding:0 4px;
}
.edit_tr:hover
{
background:url(edit.png) right no-repeat #80C8E5;
cursor:pointer;
}
.edit_tr
{
background: none repeat scroll 0 0 #D5EAF0;
}
th
{
font-weight:bold;
text-align:left;
padding:7px;
border:1px solid #fff;
border-right-width: 0px;
}
.head
{
background: none repeat scroll 0 0 #91C5D4;
color:#00000;

}

</style>
<link rel="stylesheet" href="reset.css" type="text/css" media="screen" />

<link rel="stylesheet" href="tab.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<link href="tabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

var popupWindow=null;

function child_open()
{ 

popupWindow =window.open('printform.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=950, height=400,top=200,left=200");

}
</script>
</head>

<body bgcolor="#dedede">
 <div class="content_banner"><!--<img src="images/banner.png" width=100%/>--></div>
<!--<h1>Inventory System </h1>-->
<div class="menues">
<ol id="toc">
<li><a href="#rapport_synthetique_produit"><span>Inventaire</span></a></li>
<li><a href="#n_produit"><span>Nouveau Produit / Mat&eacute;riel</span></a></li>
<li><a href="#e_produit"><span>Produit / Mat&eacute;riel Existant</span></a></li>
<li><a href="#s_produit"><span>Sortir un produit / Mat&eacute;riel</span></a></li>
<li><a href="#repare_material"><span> Mat&eacute;riel R&eacute;par&eacute;</span></a></li>
<li><a href="#rapport_detalle_produit"><span>Rapport d&eacute;tall&eacute; du Stock</span></a></li>
<li><a href="#rapport_important_sur_materiel_et_produits"><span>Autres Rapports Importants</span></a></li>
    <!--<li><a href="#inventory"><span>Inventory</span></a></li>
    <li><a href="#sales"><span>Sales</span></a></li>
    <li><a href="#alert"><span>To be order</span></a></li>
	<li><a href="#addproitem"><span>Add Item</span></a></li>
    <li><a href="#addpro"><span>Add Product</span></a></li>
    <li><a href="#editprice"><span>Edit Price</span></a></li>-->
	<li><a href="index.php"><span>Logout</span></a></li>
</ol>
</div>
<div class="content" id="rapport_important_sur_materiel_et_produits">
  <?php 
  //echo $_GET['page'];
  include("other_reports.php");?>
</div>
<div class="content" id="n_produit">
  <?php 
 // echo $_GET['page'];
  include("add_product.php");?>
</div>
<div class="content" id="e_produit">
  <?php 
  //echo $_GET['page'];
  include("add_existing_product.php");?>
</div>
<div class="content" id="s_produit">
  <?php 
  //echo $_GET['page'];
  include("sortie_du_product.php");?>
</div>
<div class="content" id="repare_material">
  <?php 
  //echo $_GET['page'];
  include("repare_material.php");?>
</div>
<div class="content" id="rapport_detalle_produit">
  <form action="tableedit.php#rapport_detalle_produit" method="post">
	Block: <select name="localization" required="required">
			    <option></option>
				<option>Tous</option>
			<?php
			/*$sql="SELECT * FROM block";
			$ex=mysqli_query($bd,$sql);
			while($row=mysqli_fetch_object($ex)){
				?>
				<option><?php echo $row->block_id;?></option>
				<?php
			}*/
			?>
			</select>De: <input name="from" type="text" class="tcal" required="required"/>
      &Agrave;: <input name="to" type="text" class="tcal" required="required"/>
	  <input name="detailled_report" type="submit" value="Rechercher" />
	  </form><br />
	  <?php if((isset($_POST['detailled_report']))&&($_POST['localization']=="Tous")) { ?>
	  <form action="spec_report.php" method="post" target="_blank">
	  <input type="hidden" name="date_from" value="<?php echo $_POST['from']?>"/>
	  <input type="hidden" name="date_to" value="<?php echo $_POST['to']?>"/>
	  <?php
	  $ibuloke="";
	  $requette="SELECT * FROM `rice_in_out_tbl` where block_id<>'' group by `block_id`";
	  $resultat=mysqli_query($bd,$requette);
	  ////////It is witin this loop we have to write out the syntetic report for each group///
	  $numeros=1;
	  while($block=mysqli_fetch_object($resultat)){
		  echo "<p align=left><b>BLOCK: ".$numeros." <u>".strtoupper($block->block_id)."</u></b></p><br/>";
		  $ibuloke=$block->block_id; 
	  $numeros++;
	  ?>
	  <table width="60%">
	  <tr><td colspan='4' align="center"><b><u>PRODUITS ENTRANT DANS LE STOCK DE <?php echo " ".strtoupper($block->block_id);?></u></b></td></tr>
<tr class="head">
<th>#</th>
<th>Date</th>
<th>Produit</th>
<th>Quantit&eacute;</th>
<th>Qty a<br/>La date</th>

</tr>
<?php
$da=date("Y-m-d");

$sql=mysqli_query($bd,"SELECT * FROM `rice_in_out_tbl` WHERE  `op_type`='IN' and `op_date` between '".$_POST['from']."' and '".$_POST['to']."' and `block_id`='".($block->block_id)."'");
$i=1;
while($row=mysqli_fetch_array($sql))
{
$id=$row['id'];
$date=$row['op_date'];
$item=$row['type'];
$qtyleft=$row['available_qty'];
$qty=$row['nbr_of_sac'];
//$price=$row['price'];
//$sales=$row['sales'];

if($i%2)
{
?>
<tr id="<?php echo $id; ?>" class="edit_tr">
<?php } else { ?>
<tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
<?php } ?>
<td class="edit_td">
<span class="text"><?php echo $i; ?></span> 
</td>
<td class="edit_td">
<span class="text"><?php echo $date; ?></span> 
</td>
<td>
<span class="text"><?php echo $item; ?></span> 
</td>
<td>
<span class="text"><?php echo $qty; ?></span>
</td>
<td>
<span class="text"><?php echo $qtyleft; ?></span>
</td>
<!--<td>

<span id="last_<?php echo $id; ?>" class="text">
<?php
$sqls=mysqli_query($bd,"select * from sales where date='$da' and product_id='$id'");
while($rows=mysqli_fetch_array($sqls))
{
echo $rows['qty'];
}
?>
</span> 
<input type="text" value="<?php echo $rtrt; ?>"  class="editbox" id="last_input_<?php echo $id; ?>"/>
</td>
<td>
<span id="first_<?php echo $id; ?>" class="text"><?php echo $price; ?></span>
<input type="text" value="<?php echo $price; ?>" class="editbox" id="first_input_<?php echo $id; ?>" />
</td>
<td>

<span class="text"><?php echo $dailysales; ?>
<?php
$sqls=mysqli_query($bd,"select * from sales where date='$da' and product_id='$id'");
while($rows=mysqli_fetch_array($sqls))
{
$rtyrty=$rows['qty'];
$rrrrr=$rtyrty*$price;
echo $rrrrr;
}

?>
</span> 
</td>-->
</tr>
 
<?php
$i++;
}
?>
<tr><td colspan='4' align="center"><b><u>PRODUITS SORTANT DU STOCK DE <?php echo " ".strtoupper($block->block_id);?></u></b></td></tr>
<?php
$sql=mysqli_query($bd,"SELECT * FROM `rice_in_out_tbl` WHERE  `op_type`='OUT' and `op_date` between '".$_POST['from']."' and '".$_POST['to']."' and `block_id`='".($block->block_id)."'");
$i=1;
while($row=mysqli_fetch_array($sql))
{
$id=$row['id'];
$date=$row['op_date'];
$item=$row['type'];
$qtyleft=$row['available_qty'];
$qty=$row['nbr_of_sac'];
//$price=$row['price'];
//$sales=$row['sales'];

if($i%2)
{
?>
<tr id="<?php echo $id; ?>" class="edit_tr">
<?php } else { ?>
<tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
<?php } ?>
<td class="edit_td">
<span class="text"><?php echo $i; ?></span> 
</td>
<td class="edit_td">
<span class="text"><?php echo $date; ?></span> 
</td>
<td>
<span class="text"><?php echo $item; ?></span> 
</td>
<td>
<span class="text"><?php echo $qty; ?></span>
</td>
<td>
<span class="text"><?php echo $qtyleft; ?></span>
</td>
<!--<td>

<span id="last_<?php echo $id; ?>" class="text">
<?php
$sqls=mysqli_query($bd,"select * from sales where date='$da' and product_id='$id'");
while($rows=mysqli_fetch_array($sqls))
{
echo $rows['qty'];
}
?>
</span> 
<input type="text" value="<?php echo $rtrt; ?>"  class="editbox" id="last_input_<?php echo $id; ?>"/>
</td>
<td>
<span id="first_<?php echo $id; ?>" class="text"><?php echo $price; ?></span>
<input type="text" value="<?php echo $price; ?>" class="editbox" id="first_input_<?php echo $id; ?>" />
</td>
<td>

<span class="text"><?php echo $dailysales; ?>
<?php
$sqls=mysqli_query($bd,"select * from sales where date='$da' and product_id='$id'");
while($rows=mysqli_fetch_array($sqls))
{
$rtyrty=$rows['qty'];
$rrrrr=$rtyrty*$price;
echo $rrrrr;
}

?>
</span> 
</td>-->
</tr>

<?php
$i++;
}
?>

<tr><td colspan=4 align="center">
<a href="spec_report.php?block=<?php echo $block->block_id;?>&amp;imprimer_par_block" target="_blank" >Imprimer le rapport du block <?php echo $block->block_id;?></a>
<input type="hidden"  name="block" value="<?php echo $block->block_id;?>"/>
</td></tr>
</table>
	 Nombre Total de transaction entre les dates <?php echo $_POST['from']." et ".$_POST['to'];?> dans le stock de <?php echo " ".($block->block_id);?>:  
	  <?php
	  $a=$_POST['from'];
	  $b=$_POST['to'];
		$result10 = mysqli_query($bd,"SELECT * FROM `rice_in_out_tbl` WHERE `op_date` BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' and `block_id`='".($block->block_id)."'");
		echo mysqli_num_rows($result10 );
		/*while($row = mysqli_fetch_array($result1))
		{
			$rrr=$row['sum(sales)'];
			echo formatMoney($rrr, true);
		 }*/
	  }
	  echo "<br/><input name='imprimer_tous_le_rapport_detaille' type='submit' value='Imprimer tous'  /></form>";
	  } else if((isset($_POST['detailled_report']))&&($_POST['localization']!="Tous")){
		  echo ahooooooooooo;
	  }
		?>
</div>
<div class="content" id="rapport_synthetique_produit">
  <!--<form action="tableedit.php#rapport_synthetique_produit" method="post">
	De: <input name="from" type="text" required="required" class="tcal"/>
      &Agrave;: <input name="to" type="text" required="required" class="tcal"/>
	  <input name="synthetic_report" type="submit" value="Rechercher" />
	  </form><br />-->
	  <?php //if(isset($_POST['synthetic_report'])) { ?>
	  <!--<form action="spec_report.php" method="post" target="_blank">
	  <input type="hidden" name="date_from" value="<?php echo $_POST['from']?>"/>
	  <input type="hidden" name="date_to" value="<?php echo $_POST['to']?>"/>
	  Click the table rows to enter the quantity sold<br><br>-->
	  <form action="synthetic_report.php" method="post" target="_blank">
	  <!--/////////////////this has to be done according to the block////-->
	  <?php
	  $ibuloke="";
	  $requette="SELECT * FROM `rice_in_out_tbl` where block_id<>'' group by `block_id`";
	  $resultat=mysqli_query($bd,$requette);
	  ////////It is witin this loop we have to write out the syntetic report for each group///
	  $numeros=1;
	  while($block=mysqli_fetch_object($resultat)){
		  echo "<p align=left><b>BLOCK: ".$numeros." <u>".strtoupper($block->block_id)."</u></b></p><br/>";
		  $ibuloke=$block->block_id; 
	  $numeros++;
	  ?>
<table width="50%">
<tr class="head">
<!--<th>Date</th>-->
<th>Produit</th>
<th>Qt&eacute; <br/>Entr&eacute;e</th>
<th>Qt&eacute;<br/> Sortie</th>
<th>Qt&eacute;<br/>Presente</th>

</tr>
<?php
$da=date("Y-m-d");

$sql=mysqli_query($bd,"SELECT * FROM `rice_in_out_tbl` where type<>'' and `block_id`='".($block->block_id)."' group by `type`");
$i=1;
while($row=mysqli_fetch_array($sql))
{
//$id=$row['id'];
//$date=$row['date'];
$item=$row['type'];
//$qtyleft=$row['qtyleft'];
$qty_sold=$row['qty_sold'];
//$price=$row['price'];
//$sales=$row['sales'];
$from=$_POST['from'];
$to=$_POST['to'];
$entered_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac FROM `rice_in_out_tbl` WHERE `op_type`='IN' and `type` ='".$item."'")))->nbr_of_sac;
   $out_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac_out FROM `rice_in_out_tbl` WHERE `op_type`='OUT' and `type` ='".$item."'")))->nbr_of_sac_out;

if($i%2)
{
?>
<tr id="<?php echo $id; ?>" class="edit_tr">
<?php } else { ?>
<tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
<?php } ?>

<td>
<span class="text"><?php echo $item; ?></span> 
</td>
<td>
<span class="text"><?php echo $entered_qty; ?></span>
</td>
<td>
<span class="text"><?php echo $out_qty; ?></span>
</td>
<td>
<span class="text"><?php echo ($entered_qty-$out_qty);  ?></span>
</td>
<!--<td>

<span id="last_<?php  ?>" class="text">
<?php
$sqls=mysqli_query($bd,"select * from sales where date='$da' and product_id='$id'");
while($rows=mysqli_fetch_array($sqls))
{
echo $rows['qty'];
}
?>
</span> 
<input type="text" value="<?php echo $rtrt; ?>"  class="editbox" id="last_input_<?php echo $id; ?>"/>
</td>
<td>
<span id="first_<?php echo $id; ?>" class="text"><?php echo $price; ?></span>
<input type="text" value="<?php echo $price; ?>" class="editbox" id="first_input_<?php echo $id; ?>" />
</td>
<td>

<span class="text"><?php echo $dailysales; ?>
<?php
$sqls=mysqli_query($bd,"select * from sales where date='$da' and product_id='$id'");
while($rows=mysqli_fetch_array($sqls))
{
$rtyrty=$rows['qty'];
$rrrrr=$rtyrty*$price;
echo $rrrrr;
}

?>
</span> 
</td>-->
</tr>

<?php
$i++;
}
?>

<tr><td colspan=4 align="center"><a href="synthetic_report.php?block=<?php echo $block->block_id;?>&amp;imprimer_par_block" target="_blank" >Imprimer le rapport du block <?php echo $block->block_id;?></a><input type="hidden" name="block" value="<?php echo $ibuloke; ?>"/></td></tr>
</table>
	  <?php }  ///////End of bock loop//////// ?>
	  <input align="left"  name="imprimer_tout" type="submit" value="Imprimer le rapport grobal"  />
</form>
	  <?php //} ?>
</div>
	  
<!--<div class="content" id="inventory">
Click the table rows to enter the quantity sold<br><br>
<table width="100%">
<tr class="head">
<th>Date</th>
<th>Item</th>
<th>Quantity Left</th>
<th>Qty Sold </th>
<th>Price</th>
<th>Sales</th>
</tr>
<?php
$da=date("Y-m-d");

$sql=mysqli_query($bd,"select * from inventory");
$i=1;
while($row=mysqli_fetch_array($sql))
{
$id=$row['id'];
$date=$row['date'];
$item=$row['item'];
$qtyleft=$row['qtyleft'];
$qty_sold=$row['qty_sold'];
$price=$row['price'];
$sales=$row['sales'];

if($i%2)
{
?>
<tr id="<?php echo $id; ?>" class="edit_tr">
<?php } else { ?>
<tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
<?php } ?>
<td class="edit_td">
<span class="text"><?php echo $da; ?></span> 
</td>
<td>
<span class="text"><?php echo $item; ?></span> 
</td>
<td>
<span class="text"><?php echo $qtyleft; ?></span>
</td>
<td>

<span id="last_<?php echo $id; ?>" class="text">
<?php
$sqls=mysqli_query($bd,"select * from sales where date='$da' and product_id='$id'");
while($rows=mysqli_fetch_array($sqls))
{
echo $rows['qty'];
}
?>
</span> 
<input type="text" value="<?php echo $rtrt; ?>"  class="editbox" id="last_input_<?php echo $id; ?>"/>
</td>
<td>
<span id="first_<?php echo $id; ?>" class="text"><?php echo $price; ?></span>
<input type="text" value="<?php echo $price; ?>" class="editbox" id="first_input_<?php echo $id; ?>" />
</td>
<td>

<span class="text"><?php echo $dailysales; ?>
<?php
$sqls=mysqli_query($bd,"select * from sales where date='$da' and product_id='$id'");
while($rows=mysqli_fetch_array($sqls))
{
$rtyrty=$rows['qty'];
$rrrrr=$rtyrty*$price;
echo $rrrrr;
}

?>
</span> 
</td>
</tr>

<?php
$i++;
}
?>

</table>
<br />
Total Sales of this day:
	    <b>Php <?php
function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}		
$result1 = mysqli_query($bd,"SELECT sum(sales) FROM sales where date='$da'");
while($row = mysqli_fetch_array($result1))
{
    $rrr=$row['sum(sales)'];
	echo formatMoney($rrr, true);
 }

?></b><br /><br />
<input name="" type="button" value="Print" onclick="javascript:child_open()" style="cursor:pointer;" />
</div>-->
<div class="content" id="alert">
	<ul>
	<?php
	$CRITICAL=10;
	$sql2=mysqli_query($bd,"select * from inventory where qtyleft<='$CRITICAL'");
	while($row2=mysqli_fetch_array($sql2))
	{
	echo '<li>'.$row2['item'].'</li>';
	}
	?>
	</ul>
</div>
<div class="content" id="sales">
	<form action="tableedit.php#sales" method="post">
	De: <input name="from" type="text" class="tcal"/>
      &Agrave;: <input name="to" type="text" class="tcal"/>
	  <input name="" type="submit" value="Seach" />
	  </form><br />
	 Nombre Total de transaction entre les dates <?php echo $a." et ".$b;?>:  
	  <?php
	  $a=$_POST['from'];
	  $b=$_POST['to'];
		$result1 = mysqli_query($bd,"SELECT sum(sales) FROM sales where date BETWEEN '$a' AND '$b'");
		while($row = mysqli_fetch_array($result1))
		{
			$rrr=$row['sum(sales)'];
			echo formatMoney($rrr, true);
		 }
		
		?>
</div>
<div class="content" id="addproitem">
<form action="updateproduct.php" method="post">
	<div style="margin-left: 48px;">
	Product name:<?php
	$name= mysqli_query($bd,"select * from inventory");
	
	echo '<select name="ITEM" id="user" class="textfield1">';
	 while($res= mysqli_fetch_assoc($name))
	{
	echo '<option value="'.$res['id'].'">';
	echo $res['item'];
	echo'</option>';
	}
	echo'</select>';
	?>
	</div>
	<br />
	Number of Item To Add:<input name="itemnumber" type="text" /><br />
	<div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Add" /></div>
</form>
</div>
<div class="content" id="addpro">
<form action="saveproduct.php" method="post">
	<div style="margin-left: 48px;">
	Product name:<input name="proname" type="text" />
	</div>
	<br />
	<div style="margin-left: 97px;">
	Price:<input name="price" type="text" />
	</div>
	<br />
	<div style="margin-left: 80px;">
	Quantity:<input name="qty" type="text" />
	</div>
	<div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Add" /></div>
</form>
</div>
<div class="content" id="editprice">
<form action="updateprice.php" method="post">
	<div style="margin-left: 48px;">
	Product name:<?php
	$name= mysqli_query($bd,"select * from inventory");
	
	echo '<select name="ITEM" id="user" class="textfield1">';
	 while($res= mysqli_fetch_assoc($name))
	{
	echo '<option value="'.$res['id'].'">';
	echo $res['item'];
	echo'</option>';
	}
	echo'</select>';
	?>
	</div>
	<br />
	<div style="margin-left: 97px;">Price:<input name="itemprice" type="text" /></div>
	<div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Update" /></div>
</form>
</div>
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['rapport_synthetique_produit', 'n_produit','e_produit','s_produit','repare_material','rapport_detalle_produit','rapport_important_sur_materiel_et_produits','alert', 'sales', 'addproitem', 'addpro', 'editprice']);
</script>
<?php
function msg($cont){
    echo "<div id='msg'>$cont</div>";
   }
?>
<div class="content_footer"><center><font color="#FFFFFF">Tous droits r&eacute;serv&eacute;s. &copy; 2017 HVP Gatagara (Branche de Rwamagana)</font></center></div>
</body>
</html>
