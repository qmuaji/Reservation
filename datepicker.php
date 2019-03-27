<!DOCTYPE html>
<html>
<head>
    <title>Date Picker</title>
    <link href="./assets/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="./assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<body>



<div class="container">
    <form action="PDF.php" method="post">
 <legend>Date Time Picker Bootstrap</legend>
        <fieldset>
   <div class="form-group">
                <label for="dtp_input2" class="col-md-2 control-label">Tanggal</label>
                <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="10" type="text" name="dari">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
    <input type="hidden" id="dtp_input2" value=""/>

            </div>
        </fieldset>
  
    </form>
</div>

<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="assets/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
 $('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
    });
</script>

</body>
</html>
