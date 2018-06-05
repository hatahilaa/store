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
<u><b>BRANCHE DE RWAMAGANA </b>
</u>
<br/><br/><br/>
<?php
//////Tous///
if($_POST['report_type']=="Tous"){
?>
<u><b> SITUATION GENERALE DU MATERIEL ET PRODUITS </b>
</u>
<br/><br/><br/>
<table width=500 align="center" border=1 cellpadding=0 cellspacing=0 id="pattern-style-b" summary="Meeting Results">

  
  
  
  <tr> <td><b>Mat&eacute;riel/Produit</b></td> <td><b>Quantit&eacute;<br/> Entr&eacute;e</b></td><td><b>Qt&eacute;<br/> Sortie </b></td><td><b>Quantit&eacute;<br/> Pr&eacute;sente</b></td></tr> 
  
  <tbody>
  <?php
  include("connect.php");
$sql="SELECT * FROM `rice_in_out_tbl` group by `type`";
$res=mysqli_query($sql);
while($row=mysqli_fetch_object($res))
{

$item=$row->type;
//$qtyleft=$row['qtyleft'];
//$qty_sold=$row['qty_sold'];
//$price=$row['price'];
//$sales=$row['sales'];
//$from=$_POST['from'];
//$to=$_POST['to'];
$entered_qty=mysqli_fetch_object((mysqli_query("SELECT sum(`nbr_of_sac`) as nbr_of_sac FROM `rice_in_out_tbl` WHERE `op_type`='IN' and `type` ='".$item."'")))->nbr_of_sac;
   $out_qty=mysqli_fetch_object((mysqli_query("SELECT sum(`nbr_of_sac`) as nbr_of_sac_out FROM `rice_in_out_tbl` WHERE `op_type`='OUT' and `type` ='".$item."'")))->nbr_of_sac_out;
echo("<tr>  <td> $row->type</td>");echo"<td>".$entered_qty." </td>  <td>". $out_qty."</td><td>".($entered_qty-$out_qty)." </td></tr> ";
 } ?>
  </tbody>
  </table>
<?php } ?>