<?php
include("db.php");
$proname=$_POST['proname'];
$price=$_POST['price'];
$qty=$_POST['qty'];
mysql_query("INSERT INTO inventory (item, price, qtyleft) VALUES ('$proname', '$price','$qty')");
////Add new product////
if(isset($_POST['add_new_product_btn'])){
	include("connect.php");
	mysql_query("INSERT INTO `ciment_mgt_db`.`rice_type` (`type`,`reg_date`) VALUES ('".$_POST['r_type']."','".date('Y-m-d')."')");
	$entered_qty=mysql_fetch_object((mysql_query("SELECT sum(`nbr_of_sac`) as nbr_of_sac FROM `rice_in_out_tbl` WHERE `op_type`='"."IN"."' and `type` ='".$_POST['r_type']."' and `kg_per_sac`='".$_POST['kgs_sac']."'")))->nbr_of_sac;
   $out_qty=mysql_fetch_object((mysql_query("SELECT sum(`nbr_of_sac`) as nbr_of_sac_out FROM `rice_in_out_tbl` WHERE `op_type`='"."OUT"."' and `type` ='".$_POST['r_type']."' and `kg_per_sac`='".$_POST['kgs_sac']."'")))->nbr_of_sac_out;
   mysql_query("INSERT INTO `ciment_mgt_db`.`rice_in_out_tbl` (`id`, `type`, `kg_per_sac`, `nbr_of_sac`, `op_date`, `op_type`, `available_qty`) VALUES (NULL, '".$_POST['r_type']."', '".$_POST['kgs_sac']."', '".$_POST['qty']."', '".date('Y-m-d')."', '"."IN"."', '".(($entered_qty+$_POST['qty'])-$out_qty)."')")or die(mysql_error());
   msg("Operation done");
   //echo"hhh".$entered_qty.$_POST['kgs_sac'];
   //include("display_types.php");
   //include("avalable_quantity.php");
}




function msg($cont){
    echo "<div id='msg'>$cont</div>";
   }


header("location: tableedit.php#page=addpro");
?>