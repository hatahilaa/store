
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
   if(isset($_POST['imprimer_tous_le_rapport_detaille'])){
	   echo"<h4>Rapport detailles de produits entrant et sortant du stock   <br/> entres les dates ".$_POST['date_from']." et ".$_POST['date_to']."</h4>
";

	   include("connect.php");
	   $numeros=1;
	   $ibuloke="";
	  $requette="SELECT * FROM `rice_in_out_tbl` where block_id<>'' group by `block_id`";
	  $resultat=mysql_query($requette);
	  while($block=mysql_fetch_object($resultat)){
		  /*echo "<p align=left><b>BLOCK: ".$numeros." <u>".strtoupper($block->block_id)."</u></b></p><br/>";*/
		  $ibuloke=$block->block_id; 
	  $numeros++;
include("connect.php");
$sql="SELECT * FROM `rice_in_out_tbl` WHERE  `op_type`='IN' and `op_date` between '".$_POST['date_from']."' and '".$_POST['date_to']."' and `block_id`='".($block->block_id)."'";





$res=mysql_query($sql)or die (mysql_error());

?>
<table width=500 align="center" border=1 cellpadding=0 cellspacing=0 id="pattern-style-b" summary="Meeting Results">

  <tr><td colspan='5' align="center"><b><u>PRODUITS ENTRANT DANS LE STOCK DE <?php echo strtoupper($block->block_id);?></u></b></td></tr> 
  
  
  <tr><td><b>DATE</b></td> <td><b>PRODUIT</b></td> <td><b>Quantit&eacute;</b></td><td><b>Qt&eacute; A <br/>LA DATE</b></td></tr> 
  
  <tbody>
  <?php



while($row=mysql_fetch_object($res))
{


echo("<tr> <td> $row->op_date</td> <td> $row->type</td><td> $row->nbr_of_sac</td>  <td>$row->available_qty</td></tr> ");
 } ?>
  </tbody>
  <!--</table>-->
  <?php
  ///exit///
  $sql="SELECT * FROM `rice_in_out_tbl` WHERE  `op_type`='OUT' and `op_date` between '".$_POST['date_from']."' and '".$_POST['date_to']."' and `block_id`='".($block->block_id)."'";
  $res=mysql_query($sql)or die (mysql_error());
  if(mysql_num_rows($res)!=0){
  echo "
  <tr align=center><td colspan=5>PRODUITS SORTANT DU STOCK DE ".strtoupper($block->block_id)."</u></td></tr> 
";





?>
<!--<table align="center" border=1 cellpadding=0 cellspacing=0 id="pattern-style-b" summary="Meeting Results">-->
  
  <tr><td><b>DATE</b></td><td><b>PRODUIT</b></td>  <td><b>Quantit&eacute;</b><td><b>Qt&eacute; A <br/>LA DATE</b></td></tr> 

<tbody>
  <?php



while($row=mysql_fetch_object($res))
{


echo("<tr> <td> $row->op_date</td><td> $row->type</td> <td> $row->nbr_of_sac</td>  <td>$row->available_qty</td></tr> ");
 } ?>
  </tbody>
  </table>
  <?php
  }
 } 
   }else if(isset($_GET['imprimer_par_block'])){
	   include("connect.php");
	   $sql="SELECT * FROM `rice_in_out_tbl` WHERE  `op_type`='IN' and `op_date` between '".$_POST['date_from']."' and '".$_POST['date_to']."' and `block_id`='".$_GET['block']."'";





$res=mysql_query($sql)or die (mysql_error());
	   
	   ?>
	   <table width=500 align="center" border=1 cellpadding=0 cellspacing=0 id="pattern-style-b" summary="Meeting Results">

  <tr><td colspan='5' align="center"><b><u>PRODUITS ENTRANT DANS LE STOCK DE <?php echo strtoupper($_GET['block']);?></u></b></td></tr> 
  
  
  <tr><td><b>DATE</b></td> <td><b>PRODUIT</b></td> <td><b>Quantit&eacute;</b></td><td><b>Qt&eacute; A <br/>LA DATE</b></td></tr> 
  
  <tbody>
  <?php



while($row=mysql_fetch_object($res))
{


echo("<tr> <td> $row->op_date</td> <td> $row->type</td><td> $row->nbr_of_sac</td>  <td>$row->available_qty</td></tr> ");
 } ?>
  </tbody>
  <!--</table>-->
  <?php
  ///exit///
  $sql="SELECT * FROM `rice_in_out_tbl` WHERE  `op_type`='OUT' and `op_date` between '".$_POST['date_from']."' and '".$_POST['date_to']."' and `block_id`='".$_GET['block']."'";
  $res=mysql_query($sql)or die (mysql_error());
  if(mysql_num_rows($res)!=0){
  echo "
  <tr align=center><td colspan=5>PRODUITS SORTANT DU STOCK DE ".strtoupper($_GET['block'])."</u></td></tr> 
";





?>
<!--<table align="center" border=1 cellpadding=0 cellspacing=0 id="pattern-style-b" summary="Meeting Results">-->
  
  <tr><td><b>DATE</b></td><td><b>PRODUIT</b></td>  <td><b>Quantit&eacute;</b><td><b>Qt&eacute; A <br/>LA DATE</b></td></tr> 

<tbody>
  <?php



while($row=mysql_fetch_object($res))
{


echo("<tr> <td> $row->op_date</td><td> $row->type</td> <td> $row->nbr_of_sac</td>  <td>$row->available_qty</td></tr> ");
 } ?>
  </tbody>
  </table>
	   <?php
   }
   }
  ?>