<?php
include("db.php");
if($_POST['id'])
{
$id=mysqli_escape_string($_POST['id']);
$qty_sold=mysqli_escape_string($_POST['qty_sold']);
$price=mysqli_escape_string($_POST['price']);
$da=date("Y-m-d");
$sql=mysqli_query("select * from inventory where id='$id'");
while($row=mysqli_fetch_array($sql))
{
$qtyleft=$row['qtyleft'];
$price=$row['price'];
}
$ssss=$qtyleft-$qty_sold;
$sale=$qty_sold*$price;
$sales_sql=mysqli_query("select * from sales where date='$da' and product_id='$id'");
$count=mysqli_num_rows($sales_sql);

if($count==0)
{
mysqli_query("INSERT INTO sales (product_id, qty, date, sales) VALUES ('$id','$qty_sold','$da','$sale')");
}
if($count!=0)
{
mysqli_query("UPDATE sales set qty=qty+'$qty_sold',sales='$sale' where date='$da' and product_id='$id'");
}

$sql = "update inventory set qtyleft='$ssss',price='$price',sales=sales+'$sale',qty_sold=qty_sold+'$qty_sold' where id='$id'";
mysqli_query($sql);
}
?>


