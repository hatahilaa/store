<form action="saveproduct.php" method="post"
enctype="multipart/form-data">
 <span class="copyright_text">
        <table bgcolor="#F2F2F2" width="70%" border="0" align="center" style=" border:1px solid #00000;">
		<tr align="center">
            <td colspan="2"><font size='3'><b><I>Formulaire d'enregistrement du produit existant</I></b></font></td>
            </tr>
			<tr>
			<td><font size='3' color='#000000'>Block/Localisation</font></td>
			<td><select name="localization" required="required">
			    <option></option>
			<?php
			$sql="SELECT * FROM block";
			$ex=mysqli_query($bd,$sql);
			while($row=mysqli_fetch_object($ex)){
				?>
				<option><?php echo $row->block_id;?></option>
				<?php
			}
			?>
			</select></td></tr>
			<!--<tr>
			<td><font size='3' color='#000000'>Type du Produit</font></td>
			<td><select name="type_type" required="required">
			    <option></option>
			    <option>Consomable</option>
				<option>Non consomable</option>
			</select></td></tr>-->
		    <tr>
			<td><font size='3' color='#000000'>Produit </font></td>
			<td><select name="r_type">
				 <?php
				 include("db.php");
				 $sql="SELECT * FROM `rice_type`";
				 $ex=mysqli_query($bd,$sql);
				 while($row=mysqli_fetch_object($ex)){
				 echo "<option value='$row->type'>$row->type</option>";
				 }
				 ?>
				</select>
			</td></tr>
			
			
			
			<tr>
			<td><font size='3' color='#000000'>Quantit&eacute;</font></td>
			<td><input name="qty" type="text" required="required" id=''/></td></tr>
			<tr>
			<td><font size='3' color='#000000'>Dur&eacute; d'expiration (Anne&eacute;s)</font></td>
			<td><input name="expiration_period" type="text" required="required" id=''/></td></tr>
			<tr>
			<td><font size='3' color='#000000' >Date</font></td>
			<td><input readonly='readonly' name="date" type="text" id='zip' value="<?php echo date('Y-m-d');?>"/></td></tr>
           <tr align="center">
		    
			<td colspan='2'><input name="add_r_not_first_time_btn" type="submit" value="Enregistrer" /></td>
            
          </tr>
         
      </table>
	  </form>