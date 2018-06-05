<form action="rapport_important.php" method="post" target="_blank">
	Rapport: <select name="report_type" required="required">
			    <option></option>
				<option>Tous</option>
				<option>Objects expir&eacute;s</option>
				<option>Objects endomag&eacute;s</option>
			<?php
			/*$sql="SELECT * FROM block";
			$ex=mysql_query($sql);
			while($row=mysql_fetch_object($ex)){
				?>
				<option><?php echo $row->block_id;?></option>
				<?php
			}*/
			?>
			</select>
	  <input name="detailled_report" type="submit" value="Rechercher" />
	  </form>