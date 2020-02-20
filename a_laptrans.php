<?php 	
require 'core/init.php';
protectPage();
adminProtect();
include 'includes/_header.php';

$showPage 	= '';
$batas		= 30;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;


$start	= "";
$end	= date('Y-m-d');
$ket 	= 'Awal - Akhir';
$result = mysql_query("SELECT book_date, book_code, (price * sum(q)) as total
						FROM transactions								
						WHERE book_date BETWEEN '$start' AND '$end'
						GROUP BY book_code LIMIT $offset, $batas") or die (mysql_error());

$q 		= mysql_query("SELECT COUNT(trans_id) from transactions");

if (!empty($_POST)){

	$start 	= date('Y-m-d', strtotime($_POST['start']));
	$end 	= date('Y-m-d', strtotime($_POST['end'])); 

	$result = mysql_query("SELECT book_date, book_code, (price * sum(q)) as total
							FROM transactions								
							WHERE book_date BETWEEN '$start' AND '$end'
							GROUP BY book_code LIMIT $offset, $batas") or die (mysql_error());

	$ket	= date('d F Y', strtotime($_POST['start'])). " - ".date('d F Y', strtotime($_POST['end']));

	$q 		= mysql_query("SELECT COUNT(trans_id) from transactions WHERE book_date BETWEEN '$start' AND '$end'");
} 
$no = 1;
	$jml 		= mysql_fetch_array($q);
	$jmlData	= $jml[0];
 ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Laporan Transaksi Penyewaan</h3>

	</div>
<div class="panel-body">
	<form action="" method="post">
		<div class="container" id="sandbox-container">
		
	<?php if($jmlData > 0) {
		?><a href="xls/laptrans_xls.php?s=<?php echo $start ?>&e=<?php echo $end ?>" class="button small icon fa-download"> Excel</a> |<?php
		} ?> Periode :
				<div class="input-daterange input-group" id="datepicker">
			    	<input type="text" class="form-control" name="start"/>
			    	<span class="input-group-addon">sd</span>
			    	<input type="text" class="form-control" name="end" />
			    	<span class="input-group-btn">
			    	<button class="btn" type="submit">OK</button></span>
			    </div>
			
		</div>
	</form>


	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>
					<th class='text-center'>Tanggal</th>
					<th class='text-center'>Kode Pesan</th>
					<th class='text-center'>Total</th>	
				</tr>
			</thead>
			<tbody>
			<?php 
				$subTotal = 0;
				while($rows = mysql_fetch_array($result)){
					$tgl 	= $rows['book_date'];
					$tgl = date("d F, Y", strtotime($tgl));
					$nama 	= $rows['book_code'];
					$total 	= $rows['total'];
					$subTotal = $subTotal + $total;

				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>
					<td><?php echo $tgl ?></td>
					<td class='text-center'><small><?php echo $nama ?></small></td>
					<td class='text-right'><?php echo number_format($total,0,',','.') ?></td>
				</tr>
				<?php 
					$no++;	
				}
			 ?>
				<tr>		
					<td colspan="3" class='text-right'>
						Total
					</td>		
				 	<td class='text-right'>
				 		<b><?php echo number_format($subTotal,0,',','.') ?></b>
				 	</td>

				</tr>		
			</tbody>
		</table>
	</div>

<div class="col-md-offset-5">
	<ul class="pagination">
	<?php 


	  $jmlPage	= ceil($jmlData / $batas);

	  if($noPage > 1) echo "<li><a href=$_SERVER[PHP_SELF]?f=laporan_view&page=".($noPage-1).">&laquo;</a></li>";

	  for($i=1; $i <= $jmlPage; $i++){

	    if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

	      if(($showPage == 1) && ($i != 2)) echo "<li><a>...</a></li>";

	      if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<li><a>...</a></li>";

	      if($i==$noPage) echo "<li class=active><a>$i</a></li>";

	      else echo "<li><a href=".$_SERVER['PHP_SELF']."?f=laporan_view&page=".$i." > ".$i."</a></li>";

	      $showPage=$i;
	    }  
	  }
	 
	  if ($noPage < $jmlPage) echo "<li><a href=$_SERVER[PHP_SELF]?f=laporan_view&page=".($noPage+1).">&raquo;</a></li>";

	?>
	</ul>
		
</div>
<div class="label label-danger">Total Data : <?php echo $jmlData ?></div><br>
</div>

<?php include 'includes/_footer.php' ?>

<script>
	$(document).ready(function(){
	  $('#sandbox-container .input-daterange').datepicker({
	    format    : 'dd MM yyyy'
	  });
	});

</script>