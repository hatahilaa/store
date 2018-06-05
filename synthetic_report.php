
<style type="text/css">
table, th, td {
    border: 1px solid black;
	border-collapse: collapse;
	font-size: 12px;
}
  * {
    margin: 0;
    }
    html, body {
    height: 100%;
    }
    .wrapper {
    min-height: 100%;
    height: auto !important;
   height: 100%;
   margin: 0 auto -4em;
   }
   .footer, .push {
   height: 3em;
   }
</style>
<img src="images/entete_raport.png"><br/>
<b>RWAMAGANA</b>
<hr>
<?php
function msg($cont){
    echo "<div id='msg'>$cont</div>";
   }
include("connect.php");
if(isset($_POST['imprimer_tout'])){
//$sql="SELECT * FROM `rice_in_out_tbl` where type<>'' group by type";
$requette="SELECT * FROM `rice_in_out_tbl` where block_id<>'' group by `block_id`";
	  $resultat=mysql_query($requette);
	  ////////It is witin this loop we have to write out the syntetic report for each group///
	  $numeros=1;
	  while($block=mysql_fetch_object($resultat)){
		  echo "<br/><p align=left><b>BLOCK: ".$numeros." <u>".strtoupper($block->block_id)."</u></b></p><br/>";
		  $ibuloke=$block->block_id; 
	  $numeros++;
	  $sql="SELECT * FROM `rice_in_out_tbl` where type<>'' and `block_id`='".($block->block_id)."' group by type";
//echo"<h4>Rapport synthetique de stock  du block '".$_POST['block']."' <br/> </h4>
//";




$res=mysql_query($sql)or die (mysql_error());
	  ?>
	  <table width=500 align="center" border=1 cellpadding=0 cellspacing=0 id="pattern-style-b" summary="Meeting Results">

  
  
  
  <tr> <td><b>Produit</b></td> <td><b>Quantit&eacute;<br/> Entr&eacute;e</b></td><td><b>Qt&eacute;<br/> Sortie </b></td><td><b>Quantit&eacute;<br/> Pr&eacute;sente</b></td></tr> 
  
  <tbody>
  <?php



while($row=mysql_fetch_object($res))
{

$item=$row->type;
//$qtyleft=$row['qtyleft'];
//$qty_sold=$row['qty_sold'];
//$price=$row['price'];
//$sales=$row['sales'];
//$from=$_POST['from'];
//$to=$_POST['to'];
$entered_qty=mysql_fetch_object((mysql_query("SELECT sum(`nbr_of_sac`) as nbr_of_sac FROM `rice_in_out_tbl` WHERE `op_type`='IN' and `type` ='".$item."'")))->nbr_of_sac;
   $out_qty=mysql_fetch_object((mysql_query("SELECT sum(`nbr_of_sac`) as nbr_of_sac_out FROM `rice_in_out_tbl` WHERE `op_type`='OUT' and `type` ='".$item."'")))->nbr_of_sac_out;
echo("<tr>  <td> $row->type</td>");echo"<td>".$entered_qty." </td>  <td>". $out_qty."</td><td>".($entered_qty-$out_qty)." </td></tr> ";
 } ?>
  </tbody>
  </table>
	  <?php
	  
	  }
}
else if(isset($_GET['imprimer_par_block'])){
$sql="SELECT * FROM `rice_in_out_tbl` where type<>'' and `block_id`='".$_GET['block']."' group by type";
echo"<h4>Rapport synthetique de stock  du block '".$_GET['block']."' <br/> </h4>
";




$res=mysql_query($sql)or die (mysql_error());

?>
<table width=500 align="center" border=1 cellpadding=0 cellspacing=0 id="pattern-style-b" summary="Meeting Results">

  
  
  
  <tr> <td><b>Produit</b></td> <td><b>Quantit&eacute;<br/> Entr&eacute;e</b></td><td><b>Qt&eacute;<br/> Sortie </b></td><td><b>Quantit&eacute;<br/> Pr&eacute;sente</b></td></tr> 
  
  <tbody>
  <?php



while($row=mysql_fetch_object($res))
{

$item=$row->type;
//$qtyleft=$row['qtyleft'];
//$qty_sold=$row['qty_sold'];
//$price=$row['price'];
//$sales=$row['sales'];
//$from=$_POST['from'];
//$to=$_POST['to'];
$entered_qty=mysql_fetch_object((mysql_query("SELECT sum(`nbr_of_sac`) as nbr_of_sac FROM `rice_in_out_tbl` WHERE `op_type`='IN' and `type` ='".$item."'")))->nbr_of_sac;
   $out_qty=mysql_fetch_object((mysql_query("SELECT sum(`nbr_of_sac`) as nbr_of_sac_out FROM `rice_in_out_tbl` WHERE `op_type`='OUT' and `type` ='".$item."'")))->nbr_of_sac_out;
echo("<tr>  <td> $row->type</td>");echo"<td>".$entered_qty." </td>  <td>". $out_qty."</td><td>".($entered_qty-$out_qty)." </td></tr> ";
 } ?>
  </tbody>
  </table>
<?php } ?>
  
  