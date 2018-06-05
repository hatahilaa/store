<script language='javascript' >
function reload(form)
{
var block=document.getElementById('block').value;
var produit=document.getElementById('produit').value;
//var user_type=document.getElementById('user_type').value;

//self.location='index.php?groupcpcp=' + groupcpcp + '&course_id=' + course_id + '&course_name=' + course_name + '&nbr_of_credits=' + nbr_of_credits + '&lid=' + lid + '&l=' + l + '&clss=' + clss + '&ty=' + ty + '&d=' + d + '&p=' + p + '&dprt=' + dprt;

self.location='tableedit.php?block=' + block + '&produit=' + produit;
// + '&amp;maid=' + maid
}

 </script> 
<?php //echo "ghghgyy d".$_GET['block'];?>
<form action="saveproduct.php" method="post"
enctype="multipart/form-data">
 <span class="copyright_text">
        <table bgcolor="#F2F2F2" width="50%" border="0" align="center" style=" border:1px solid #00000;">
		<tr align="center">
            <td colspan="2"><font size='3'><b><I>Formulaire de Sortir un produit du stock(Ou d'enregistrement du mat&eacute;riel d&eacute;class&eacute;)</I></b></font></td>
            </tr>
			<tr>
			<td><font size='3' color='#000000'>Block/Localisation</font></td>
			<td><select name="localization" required="required" onchange='reload(this.form)' id='block'>
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
		    <tr>
			<td><font size='3' color='#000000'>Produit/Materiel </font></td>
            <td><select name="r_type" required="required" onchange='reload(this.form)' id='produit'>
			     <option></option>
				 <?php
				 include("connect.php");
				 $sql="SELECT * FROM `rice_type`";
				 $ex=mysqli_query($bd,$sql);
				 while($row=mysqli_fetch_object($ex)){
				 echo "<option value='$row->type'>$row->type</option>";
				 }
				 ?>
				</select></td></tr>
			
			<tr>
			<td><font size='3' color='#000000'>Quantit&eacute;</font></td>
			<td><input name="qty" type="text" id=''/></td></tr>
			
			<tr>
			<td><font size='3' color='#000000' >Date</font></td>
			<td><input readonly='readonly' name="date" type="text" id='zip' value="<?php echo date('Y-m-d');?>"/></td></tr>
			
           <tr align="center">
		    
			<td colspan='2'><input name="out_product_btn" type="submit" value="Valider" /></td>
            
          </tr>
         
      </table></form>