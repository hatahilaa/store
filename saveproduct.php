<?php
include("db.php");
//$proname=addslashes($_POST['proname']);
//$price=addslashes($_POST['price']);
if(isset($_POST['add_new_product_btn'])){
$qty=addslashes($_POST['qty']);
$rtype=addslashes($_POST['r_type']);
$date=date('Y-m-d');
mysqli_query($bd,"INSERT INTO `ciment_mgt_db`.`rice_type` (`type`,`reg_date`,`type_type`,`Specification`,`avalable_qty`,`nbr_of_working`) VALUES ('$rtype','$date','".addslashes($_POST['type_type'])."','".addslashes($_POST['specification'])."','".addslashes($_POST['qty'])."','".addslashes($_POST['qty'])."')");
mysqli_query($bd,"INSERT INTO `ciment_mgt_db`.`product_per_block` (`id`, `product_id`, `block_id`, `nbr_of_working`, `nbr_of_not_working`, `date_of_verification`) VALUES (NULL, '$rtype', '".addslashes($_POST['localization'])."', '".addslashes($_POST['qty'])."', '', '".date('Y-m-d')."')");
//////Entered QTY by Block. Remember to add KG per sac in the case of Rice, Salt, Suger,...
$entered_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac FROM `rice_in_out_tbl` WHERE `op_type`='IN' and `type` ='".addslashes($_POST['r_type'])."' and `block_id`='".addslashes($_POST['localization'])."'")))->nbr_of_sac;
   $out_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac_out FROM `rice_in_out_tbl` WHERE `op_type`='OUT' and `type` ='".addslashes($_POST['r_type'])."' and `block_id`='".addslashes($_POST['localization'])."'")))->nbr_of_sac_out;
   /////// Obtension of expiration date/////////
   $years=$_POST['expiration_period'];
   $date_object = date_create(date('Y-m-d'));
$next_date_object = date_modify($date_object,$years.' year');
$expiration_date=date_format($date_object,'Y-m-d');
   /////////////////////////////////////////////
   mysqli_query($bd,"INSERT INTO `ciment_mgt_db`.`rice_in_out_tbl` (`id`, `type`, `nbr_of_sac`, `op_date`,`exp_date`, `op_type`, `available_qty`,`block_id`) VALUES (NULL, '".addslashes($_POST['r_type'])."', '".addslashes($_POST['qty'])."', '".date('Y-m-d')."','".$expiration_date."' ,'IN', '".(($entered_qty+addslashes($_POST['qty']))-$out_qty)."','".addslashes($_POST['localization'])."')")or die(mysqli_error($bd));
    
   header("location: tableedit.php#page=n_produit");
  
}else if(isset($_POST['add_r_not_first_time_btn'])){
	//////Normally only working materials are entered into the block////
$last_qty_of_not_working=mysqli_fetch_object(mysqli_query($bd,"SELECT * FROM `product_per_block` WHERE `id`='".(mysqli_fetch_object(mysqli_query($bd,"SELECT MAX(`id`) as id FROM `product_per_block` WHERE `block_id`='".addslashes($_POST['localization'])."' AND `product_id`='".addslashes($_POST['r_type'])."'"))->id)."'"))->nbr_of_not_working;
	//////Entered QTY by Block. Remember to add KG per sac in the case of Rice, Salt, Suger,...
	$entered_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac FROM `rice_in_out_tbl` WHERE `op_type`='IN' and `type` ='".addslashes($_POST['r_type'])."' and `block_id`='".addslashes($_POST['localization'])."'")))->nbr_of_sac;
   $out_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac_out FROM `rice_in_out_tbl` WHERE `op_type`='OUT' and `type` ='".addslashes($_POST['r_type'])."' and `block_id`='".addslashes($_POST['localization'])."'")))->nbr_of_sac_out;
   /////// Obtension of expiration date/////////
   $years=$_POST['expiration_period'];
   $date_object = date_create(date('Y-m-d'));
$next_date_object = date_modify($date_object,$years.' year');
$expiration_date=date_format($date_object,'Y-m-d');
   /////////////////////////////////////////////
	mysqli_query($bd,"INSERT INTO `ciment_mgt_db`.`rice_in_out_tbl` (`id`, `type`, `kg_per_sac`, `nbr_of_sac`, `op_date`,`exp_date`, `op_type`, `available_qty`,`block_id`) VALUES (NULL, '".addslashes($_POST['r_type'])."', '".addslashes($_POST['kgs_sac'])."', '".addslashes($_POST['qty'])."', '".date('Y-m-d')."','".$expiration_date."' ,'IN', '".(($entered_qty+addslashes($_POST['qty']))-$out_qty)."','".addslashes($_POST['localization'])."')");
	///updating the nbr of materials in this bloc/////
	$all_entered_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac FROM `rice_in_out_tbl` WHERE `op_type`='IN' and `type` ='".addslashes($_POST['r_type'])."' ")))->nbr_of_sac;
	$exx=mysqli_query($bd,"SELECT sum(`nbr_of_working`) as nbr_of_working FROM `product_per_block` where `product_id`='".addslashes($_POST['r_type'])."' AND block_id='".addslashes($_POST['localization'])."'")or die($bd);
	$all_working_entered_qty=mysqli_fetch_object($exx)->nbr_of_working;
   $all_out_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac_out FROM `rice_in_out_tbl` WHERE `op_type`='OUT' and `type` ='".addslashes($_POST['r_type'])."' ")))->nbr_of_sac_out;
   $all_not_working_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_not_working`) as nbr_of_not_working FROM `product_per_block` where `product_id`='".addslashes($_POST['r_type'])."' AND block_id='".addslashes($_POST['localization'])."'")))->nbr_of_not_working;
	mysqli_query($bd,"UPDATE `ciment_mgt_db`.`rice_type` SET `avalable_qty` = '".($all_entered_qty-$all_out_qty)."',
`nbr_of_working` = '".($all_entered_qty-$all_not_working_qty)."',
`nbr_of_not_working` = '".$last_qty_of_not_working."' WHERE `type`='".addslashes($_POST['r_type'])."'");


///////Insert in material_per_block table//////////
mysqli_query($bd,"INSERT INTO `ciment_mgt_db`.`product_per_block` (`id`, `product_id`, `block_id`, `nbr_of_working`, `nbr_of_not_working`, `date_of_verification`) VALUES (NULL, '".addslashes($_POST['r_type'])."', '".addslashes($_POST['localization'])."', '".($all_entered_qty-$all_not_working_qty)."', '".$last_qty_of_not_working."', '".date('Y-m-d')."')");
	header("location: tableedit.php#page=e_produit");
} else if(isset($_POST['out_product_btn'])){
	include("connect.php");
	//////Normally only working materials are entered into the block////
$last_qty_of_not_working=mysqli_fetch_object(mysqli_query($bd,"SELECT * FROM `product_per_block` WHERE `id`='".(mysqli_fetch_object(mysqli_query($bd,"SELECT MAX(`id`) as id FROM `product_per_block` WHERE `block_id`='".addslashes($_POST['localization'])."' AND `product_id`='".addslashes($_POST['r_type'])."'"))->id)."'"))->nbr_of_not_working;
$last_qty_of_working=mysqli_fetch_object(mysqli_query($bd,"SELECT * FROM `product_per_block` WHERE `id`='".(mysqli_fetch_object(mysqli_query($bd,"SELECT MAX(`id`) as id FROM `product_per_block` WHERE `block_id`='".addslashes($_POST['localization'])."' AND `product_id`='".addslashes($_POST['r_type'])."'"))->id)."'"))->nbr_of_working;

	$entered_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac FROM `rice_in_out_tbl` WHERE `op_type`='IN' and `type` ='".addslashes($_POST['r_type'])."' and block_id='".addslashes($_POST['localization'])."'")))->nbr_of_sac;
   $out_qty=mysqli_fetch_object((mysqli_query($bd,"SELECT sum(`nbr_of_sac`) as nbr_of_sac_out FROM `rice_in_out_tbl` WHERE `op_type`='OUT' and `type` ='".addslashes($_POST['r_type'])."' and block_id='".addslashes($_POST['localization'])."'")))->nbr_of_sac_out;
   if(($entered_qty-$out_qty)<addslashes($_POST['qty']))
   {
   echo("You are retrieving a big quantity than the availabe one.<br/>The available quantity for ".addslashes($_POST['r_type'])." in ".addslashes($_POST['localization'])." is ".($entered_qty-$out_qty));
   include("tableedit.php");
   //include("RegisterRiceForm.php");
   }
   else{
   
	mysqli_query($bd,"INSERT INTO `ciment_mgt_db`.`rice_in_out_tbl` (`id`, `type`, `kg_per_sac`, `nbr_of_sac`, `op_date`, `op_type`, `available_qty`,`block_id`) VALUES (NULL, '".addslashes($_POST['r_type'])."', '".addslashes($_POST['kgs_sac'])."', '".addslashes($_POST['qty'])."', '".date('Y-m-d')."', 'OUT', '".(($entered_qty)-$out_qty-addslashes($_POST['qty']))."','".addslashes($_POST['localization'])."')");
	mysqli_query($bd,"UPDATE `ciment_mgt_db`.`rice_type` SET `nbr_of_working` = '".($last_qty_of_working-(addslashes($_POST['qty'])))."',
`nbr_of_not_working` = '".($last_qty_of_not_working+addslashes($_POST['qty']))."' WHERE `rice_type`.`type` = '".addslashes($_POST['r_type'])."'");
    mysqli_query($bd,"INSERT INTO `ciment_mgt_db`.`product_per_block` (`id`, `product_id`, `block_id`, `nbr_of_working`, `nbr_of_not_working`, `date_of_verification`) VALUES (NULL, '".addslashes($_POST['r_type'])."', '".addslashes($_POST['localization'])."', '".($last_qty_of_working-(addslashes($_POST['qty'])))."', '".($last_qty_of_not_working+addslashes($_POST['qty']))."', '".date('Y-m-d')."')");
	header("location: tableedit.php#page=s_produit");
   //msg("Operation done");
    //include("avalable_quantity.php");
   }
	
}else if(isset($_POST['repair_material_btn'])){
	////Ceck if the nbr of repaired materials is not greater than domaged ones///////
	//////////////
	$not_working_material=mysqli_fetch_object(mysqli_query($bd,"SELECT * FROM `product_per_block` WHERE `id`='".(mysqli_fetch_object(mysqli_query($bd,"SELECT MAX(`id`) as id FROM `product_per_block` WHERE `block_id`='".addslashes($_POST['localization'])."' AND `product_id`='".addslashes($_POST['r_type'])."'"))->id)."'"))->nbr_of_not_working;
$working_material=mysqli_fetch_object(mysqli_query($bd,"SELECT * FROM `product_per_block` WHERE `id`='".(mysqli_fetch_object(mysqli_query($bd,"SELECT MAX(`id`) as id FROM `product_per_block` WHERE `block_id`='".addslashes($_POST['localization'])."' AND `product_id`='".addslashes($_POST['r_type'])."'"))->id)."'"))->nbr_of_working;
	/////////////
	/*
	$working_material=mysqli_fetch_object(mysqli_query($bd,"SELECT * FROM `rice_type` WHERE `type`='".addslashes($_POST['r_type'])."'"))->nbr_of_working;
	$not_working_material=mysqli_fetch_object(mysqli_query($bd,"SELECT * FROM `rice_type` WHERE `type`='".addslashes($_POST['r_type'])."'"))->nbr_of_not_working;*/
	if($_POST['qty']>$not_working_material){
	echo("Vous avez entr");?>&eacute;<?php echo("un grand nombre du materiel r");?>&eacute;<?php echo("par");?>&eacute;<?php echo(".<br/>Le nombre total de ".addslashes($_POST['r_type'])." endomag");?>&eacute;<?php echo " est ".$not_working_material;
	echo "<font color=FFFFFF>";
   include("tableedit.php");
   echo"</font>";
   //include("RegisterRiceForm.php");	
	}else{
		mysqli_query($bd,"UPDATE `ciment_mgt_db`.`rice_type` SET `nbr_of_working` = '".($working_material+(addslashes($_POST['qty'])))."',
`nbr_of_not_working` = '".($not_working_material-addslashes($_POST['qty']))."' WHERE `rice_type`.`type` = '".addslashes($_POST['r_type'])."'");
    mysqli_query($bd,"INSERT INTO `ciment_mgt_db`.`product_per_block` (`id`, `product_id`, `block_id`, `nbr_of_working`, `nbr_of_not_working`, `date_of_verification`) VALUES (NULL, '".addslashes($_POST['r_type'])."', '".addslashes($_POST['localization'])."', '".($working_material+(addslashes($_POST['qty'])))."', '".($not_working_material-addslashes($_POST['qty']))."', '".date('Y-m-d')."')");
	////////Record the repaired material///////
	mysqli_query($bd,"INSERT INTO `ciment_mgt_db`.`repaired_product` (`repair_id`, `product_id`, `block`, `nbr_of_repaird`, `date_of_repairing`) VALUES (NULL, '".addslashes($_POST['r_type'])."', '".addslashes($_POST['localization'])."', '".addslashes($_POST['qty'])."', '".date('Y-m-d')."')");
	header("location: tableedit.php#page=repare_material");
	}
}
?>