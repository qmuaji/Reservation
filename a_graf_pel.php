
<div class="panel panel-default">

	<div class="panel-body">
		<html>
	<head>
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/highcharts.js" type="text/javascript"></script>

<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'pelanggan',
            type: 'column'
         },   
         title: {
            text: 'Grafik Total Pelanggan / Bulan  '
         },
         xAxis: {
            categories: ['Total Pelanggan']
         },
         yAxis: {
            title: {
               text: 'Total'
            }
         },
              series:             
            [
            <?php 
        	//include('../koneksi.php');
           $sql   = "SELECT count(user_id)as Total, DATE_FORMAT(join_date, '%Y-%m') as bulan from users Group BY bulan LIMIT 12";
            $query = mysql_query( $sql )  or die(mysql_error());
            while( $ret = mysql_fetch_array( $query ) ){
            	$a=$ret[0];       
              $b=date('M, Y', strtotime($ret[1]));                       
                  ?>
                  {
                      name: '<?php echo $b; ?>',
                      data: [<?php echo $a; ?>]
                  },
                  <?php } ?>
            ]
      });
   });	
</script>
	</head>
	<body>
		<div id='pelanggan'></div>		
	</body>
</html>
	</div>

</div>
