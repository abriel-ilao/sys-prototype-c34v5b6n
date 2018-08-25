<?php

require_once 'auth.php';
require_once './frontend-ui/header.php';
require_once './frontend-ui/footer.php';

use app\controller\accounts\AccountsAdminInfoController;
use app\data\transaction\TransactionLog;
use app\lib\datetime\SimpleDate;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//init transactionlog
$transactLog = TransactionLog::Create();

//get user's level
$level = $accountData->getData('level');

//active navigation
$active = '3';

//init header with one parameter
Header::Create($active);

?>
	<div class="header-pad">
		<div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h1 class="h6 mt-2"><i class="fa fa-desktop"></i> Transaction Log</h1>
                </div>
            </div>
        </div>
	</div>

    <div class="header-sub mb-2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h1 class="h6 mt-2"><i class="fa fa-desktop"></i> Transaction Log</h1>
                </div>
                <div class="col-12 col-lg-6">
                </div>
            </div>
        </div>
    </div>

    <div class="container panel-x">
  		<div class="row no-gutters">
        <div class="col-12">
          <div class="h6-responsive h-inventory" id="add">
            <div class="form-group">
							Select Year:
              <select class="form-control" id="selectedYear" style="width:100px;">
                <?= $transactLog->getYear(); ?>
              </select>
            </div>
          </div>
        </div>
				<div class="col-12" id="yearly">
					<?php
						if($level == 1 || $level ==2):
							echo '<img class="div-loader" src="img/34.gif" height="40" width="40"/>';
						endif;
					?>
				</div>
  			<div class="col-12 col-lg-4">
          <div id="accordion-1" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="jan">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#january" aria-expanded="false" aria-controls="january">
                    <strong><span class="text-info">January</span></strong>
                  </button>
                </h5>
              </div>
              <div id="january" class="collapse" aria-labelledby="jan" data-parent="#accordionExample">
                <div class="card-body" id="month-1">

                </div>
              </div>
            </div>
          </div>
  			</div>
        <div class="col-12 col-lg-4">
          <div id="accordion-2" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="feb">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#february" aria-expanded="false" aria-controls="february">
                    <strong><span class="text-info">February</span></strong>
                  </button>
                </h5>
              </div>
              <div id="february" class="collapse" aria-labelledby="feb" data-parent="#accordionExample">
                <div class="card-body" id="month-2">

                </div>
              </div>
            </div>
          </div>
  			</div>
        <div class="col-12 col-lg-4">
          <div id="accordion-3" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="mar">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#march" aria-expanded="false" aria-controls="march">
                    <strong><span class="text-info">March</span></strong>
                  </button>
                </h5>
              </div>
              <div id="march" class="collapse" aria-labelledby="mar" data-parent="#accordionExample">
                <div class="card-body" id="month-3">

                </div>
              </div>
            </div>
          </div>
        </div>
  			<div class="col-12 col-lg-4">
					<div id="accordion-4" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="apr">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#april" aria-expanded="false" aria-controls="april">
                    <strong><span class="text-info">April</span></strong>
                  </button>
                </h5>
              </div>
              <div id="april" class="collapse" aria-labelledby="apr" data-parent="#accordionExample">
                <div class="card-body" id="month-4">

                </div>
              </div>
            </div>
          </div>
  			</div>
        <div class="col-12 col-lg-4">
					<div id="accordion-5" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="_may">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#may" aria-expanded="false" aria-controls="may">
                    <strong><span class="text-info">May</span></strong>
                  </button>
                </h5>
              </div>
              <div id="may" class="collapse" aria-labelledby="_may" data-parent="#accordionExample">
                <div class="card-body" id="month-5">

                </div>
              </div>
            </div>
          </div>
  			</div>
        <div class="col-12 col-lg-4">
					<div id="accordion-6" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="jun">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#june" aria-expanded="false" aria-controls="june">
                    <strong><span class="text-info">June</span></strong>
                  </button>
                </h5>
              </div>
              <div id="june" class="collapse" aria-labelledby="jun" data-parent="#accordionExample">
                <div class="card-body" id="month-6">

                </div>
              </div>
            </div>
          </div>
  			</div>
				<div class="col-12 col-lg-4">
					<div id="accordion-7" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="jul">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#july" aria-expanded="false" aria-controls="july">
                    <strong><span class="text-info">July</span></strong>
                  </button>
                </h5>
              </div>
              <div id="july" class="collapse" aria-labelledby="jul" data-parent="#accordionExample">
                <div class="card-body" id="month-7">

                </div>
              </div>
            </div>
          </div>
  			</div>
				<div class="col-12 col-lg-4">
					<div id="accordion-8" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="aug">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#august" aria-expanded="false" aria-controls="august">
                    <strong><span class="text-info">August</span></strong>
                  </button>
                </h5>
              </div>
              <div id="august" class="collapse" aria-labelledby="aug" data-parent="#accordionExample">
                <div class="card-body" id="month-8">

                </div>
              </div>
            </div>
          </div>
  			</div>
				<div class="col-12 col-lg-4">
					<div id="accordion-9" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="sept">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#september" aria-expanded="false" aria-controls="september">
                    <strong><span class="text-info">September</span></strong>
                  </button>
                </h5>
              </div>
              <div id="september" class="collapse" aria-labelledby="sept" data-parent="#accordionExample">
                <div class="card-body" id="month-9">

                </div>
              </div>
            </div>
          </div>
  			</div>
				<div class="col-12 col-lg-4">
					<div id="accordion-10" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="oct">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#october" aria-expanded="false" aria-controls="october">
                    <strong><span class="text-info">October</span></strong>
                  </button>
                </h5>
              </div>
              <div id="october" class="collapse" aria-labelledby="oct" data-parent="#accordionExample">
                <div class="card-body" id="month-10">

                </div>
              </div>
            </div>
          </div>
  			</div>
				<div class="col-12 col-lg-4">
					<div id="accordion-11" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="nov">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#november" aria-expanded="false" aria-controls="november">
                    <strong><span class="text-info">November</span></strong>
                  </button>
                </h5>
              </div>
              <div id="november" class="collapse" aria-labelledby="nov" data-parent="#accordionExample">
                <div class="card-body" id="month-11">

                </div>
              </div>
            </div>
          </div>
  			</div>
				<div class="col-12 col-lg-4">
					<div id="accordion-12" class="accordion m-2">
            <div class="card">
              <div class="card-header" id="dec">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#december" aria-expanded="false" aria-controls="december">
                    <strong><span class="text-info">December</span></strong>
                  </button>
                </h5>
              </div>
              <div id="december" class="collapse" aria-labelledby="dec" data-parent="#accordionExample">
                <div class="card-body" id="month-12">

                </div>
              </div>
            </div>
          </div>
  			</div>
  		</div>
    </div>

<?php

Footer::Create();

$month = SimpleDate::Create()->getFormat('m');

?>

<script type="text/javascript">

	var level = <?php echo $level; ?>

	$(document).ready(function() {
		//**default year value
		//get selected year value
		var yyyy = $('#selectedYear').val();
		//init yearly,monthly,reloadData
		yearly(yyyy);
		monthly(yyyy);
		reloadData(yyyy);

		$('#selectedYear').change(function()
		{
			//please wait
			$('.wrapper-please-wait').show();
			$('.please-wait').show();

			var selectedYear = $(this).val();
			monthly(selectedYear);
			yearly(selectedYear);
			reloadData(selectedYear);
		});
	});

	function reloadData(selectedYear) {

		var btnReload = function(m) {
			$('#reloadMonth-'+m).click(function(e) {
				//please wait
				$('.wrapper-please-wait').show();
				$('.please-wait').show();

				e.preventDefault();
				transactionLog(selectedYear, m);
			});
		}

		for(var m=1; m <= 12; m++)
		{
			btnReload(m);
		}
	}

	function monthly(selectedYear)
	{
		for(var m=1; m <= 12; m++)
		{
			transactionLog(selectedYear, m);
		}
	}

	function transactionLog(selectedYear, m) {
		//alert(value);
		$.ajax({
				url:'server-ajax/transactionlogajax-'+m,
				method:"post",
				data:{year:selectedYear, month:m, level:level, hideLog:0},
				success:function(data)
				{
					//please wait
					$('.wrapper-please-wait').hide();
					$('.please-wait').hide();

					$('#month-'+m).html(data);
				},
				error:function(){
						$('#month-'+m).html('');

						console.log('Error month'+m);

						$('#month-'+m).append('<button id="reloadMonth-'+m+'" class="btn btn-warning btn-sm"><strong>Reload Data</strong></button>');

						reloadData(selectedYear);
				}
		});
	}

	function yearly(selectedYear) {
		//alert(value);
		$.ajax({
				url:"server-ajax/transactionlogyearajax",
				method:"post",
				data:{year:selectedYear, level:level},
				success:function(data)
				{
					$('#yearly').html(data);
				}
		});
	}


</script>

<?php
 //get the current month
 print '
 <script type="text/javascript">
      var currentMonth;
      currentMonth = "'.$month.'";
 </script>';
?>
<script type="text/javascript">
	highlightedMonth(currentMonth);

	function highlightedMonth(currentMonth)
	{
		//console.log(carnr);
		for(i=1; i<=currentMonth; i++)
		{
			if(i==currentMonth)
				//add class to accordion[n]
				$('#accordion-'+i).addClass('current-month');
		}
	}
</script>

<?php

else:
    require_once 'login-form.php';
endif;

?>

</body>
</html>
