<?php

require_once 'auth.php';
require_once './frontend-ui/header.php';
require_once './frontend-ui/footer.php';

use app\controller\accounts\AccountsAdminInfoController;
use app\data\dailytotal\Dailytotal;
use app\lib\datetime\SimpleDate;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//init DailyTotal
$DailyTotal = DailyTotal::Create();

//get user's level
$level = $accountData->getData('level');

//get user's ID
$userID = $accountData->getData('Id');

//active navigation
$active = '1';

//init header with one parameter
Header::Create($active);

?>

    <div class="header-sub mb-2">
        <div class="container">
            <div class="row">
              <?php
                if($level == 1 || $level == 2):
              ?>
                  <div class="col-sm-8 col-md-6">
                      <div class="pos-sub-item">
                        <ul>
                          <li><a href="dailytotal"><i class="fa fa-calculator"></i> Daily Total</a></li>
                          <li><a href="adddailytotal" class="active-sub-item"><i class="fa fa-shopping-bag"></i> Add D.T.</a></li>
                        </ul>
                      </div>
                  </div>
              <?php
                endif;
              ?>
              <div class="col-sm-8 col-md-6">
                  <!--<form class="form-inline">-->
                  <div class="col-auto">
                    <label class="sr-only" for="inlineFormInputGroup">Search Items (Item Code, Desc..., Type, Selling Price)</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="searchText" placeholder="Search Items (Item Code, Desc..., Type, Selling Price)" disabled style="opacity:0">
                      <div class="input-group-prepend">
                        <div class="input-group-text" style="opacity:0;"><i class="fa fa-search"></i></div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>

    <div class="header-pad">
  		<div class="container">
          <div class="row">
              <div class="col-12 col-md-6">
                  <h1 class="h6 mt-2"><i class="fa fa-shopping-bag"></i> Add D.T. <span class="m-sub-menu-link float-right"><a href="dailytotal" class="text-info"><i class="fa fa-cart-arrow-down"></i> Daily Total</a></h1>
              </div>
              <div class="col-12 col-md-6">
              </div>
          </div>
      </div>
  	</div>

    <div class="container panel-x">
      <?php if($level == 1 || $level == 2) : ?>    
        <div class="row no-gutters">
          <div class="col-12 col-md-6">    
            <!--<form action="pos" method="POST">-->
            <div class="col-12">
              <form action="adddailytotal" method="POST" role="form"> 
                <h5 class="h-inventory"><strong>DATE</strong></h5>
                <input type="text" name="schedDate" id="schedDate" class="form-control validate col-12" placeholder="Click/Tap to add date..." autocomplete="off" required>
                
                <button type="submit" name="btnDailyTotal" class="mt-2 btn btn-sm btn-info"><i class="fa fa-calendar-alt"></i> View Date</button>
              </form>                    
              <?php 
                
                if(isset($_POST['btnDailyTotal'])) {
                  $schedDate = $_POST['schedDate'];
                  $schedDateExploded = explode('/', $schedDate);
                  $month = 'm-'.$schedDateExploded[0];
                  $day = 'd-'.$schedDateExploded[1];
                  $year = 'y-'.$schedDateExploded[2];

                  $sched = $month.'/'.$day.'/'.$year;
                  //m-01/d-01/y-2019

                  $totalSalesPerDay = $DailyTotal->totalSalesPerDay($sched);
                  $totalReturnSalesPerDay = $DailyTotal->totalReturnSalesPerDay($sched);
                  $totalFinalSalesPerDay = ($totalSalesPerDay - $totalReturnSalesPerDay);
                  //
                  //$totalDailyExpenses = $DailyTotal->totalDailyExpenses($sched);
                  //expenses
                  //-- 
                  $expenses1 = $DailyTotal->totalDailyExpenses($sched, 'truck');
                  $expenses2 = $DailyTotal->totalDailyExpenses($sched, 'hilux');
                  $expenses3 = $DailyTotal->totalDailyExpenses($sched, 'picanto');
                  $expenses4 = $DailyTotal->totalDailyExpenses($sched, 'tricycle');
                  $expenses5 = $DailyTotal->totalDailyExpenses($sched, 'generator');
                  $expenses6 = $DailyTotal->totalDailyExpenses($sched, 'internet');
                  $expenses7 = $DailyTotal->totalDailyExpenses($sched, 'norsamelco');
                  $expenses8 = $DailyTotal->totalDailyExpenses($sched, 'ulam');
                  $expenses9 = $DailyTotal->totalDailyExpenses($sched, 'water');
                  $expenses10 = $DailyTotal->totalDailyExpenses($sched, 'gasul');
                  $expenses11 = $DailyTotal->totalDailyExpenses($sched, 'rice');
                  $expenses12 = $DailyTotal->totalDailyExpenses($sched, 'person1');
                  $expenses13 = $DailyTotal->totalDailyExpenses($sched, 'person2');
                  $expenses14 = $DailyTotal->totalDailyExpenses($sched, 'person3');
                  $expenses15 = $DailyTotal->totalDailyExpenses($sched, 'person4');
                  $expenses16 = $DailyTotal->totalDailyExpenses($sched, 'person5');
                  $expenses17 = $DailyTotal->totalDailyExpenses($sched, 'person6');
                  $expenses18 = $DailyTotal->totalDailyExpenses($sched, 'person7');
                  $expenses19 = $DailyTotal->totalDailyExpenses($sched, 'person8');
                  $expenses20 = $DailyTotal->totalDailyExpenses($sched, 'person9');
                  $expenses21 = $DailyTotal->totalDailyExpenses($sched, 'person10');
                  $expenses22 = $DailyTotal->totalDailyExpenses($sched, 'person11');
                  $expenses23 = $DailyTotal->totalDailyExpenses($sched, 'person12');
                  $expenses24 = $DailyTotal->totalDailyExpenses($sched, 'person13');
                  $expenses25 = $DailyTotal->totalDailyExpenses($sched, 'labor');
                  $expenses26 = $DailyTotal->totalDailyExpenses($sched, 'materials');

                  $totalDailyExpenses = $expenses1+$expenses2+$expenses3+$expenses4+$expenses5+$expenses6+$expenses7+$expenses8+$expenses9+$expenses10+$expenses11+$expenses12+$expenses13+$expenses14+$expenses15+$expenses16+$expenses17+$expenses18+$expenses19+$expenses20+$expenses21+$expenses22+$expenses23+$expenses24+$expenses25+$expenses26;    
                  
              ?>
                  <!--echo '<br><br>';
                  echo 'Date Selected: <b>₱'.$schedDate.'</b>';
                  
                  echo 'Total Sales Per Day: <b>₱'.number_format($totalSalesPerDay, 2).'</b>';
                  
                  echo 'Total Return Sales Per Day: <b>₱'.number_format($totalReturnSalesPerDay, 2).'</b>';
                  
                  echo 'Total Final Sales Per Day: <b>₱'.number_format($totalFinalSalesPerDay, 2).'</b>';
                  -->
                  <form action="adddailytotal" method="POST" role="form"> 
                    <table class="mt-3 p-2 table-sm table-bordered table-responsive" style="font-size:14px;">
                      <tr>
                        <td class="text-right p-2">Date Selected:</td>
                        <td><?= '<strong>'.$schedDate.'</strong>'; ?></td>
                        <input type="hidden" name="n_scheddate" value="<?=$schedDate;?>">
                      <tr>
                      <tr>
                        <td class="text-right p-2">Sales Per Day:</td>
                        <td><?= '<strong>₱'.number_format($totalSalesPerDay, 2).'</strong>'; ?></td>                       
                        <input type="hidden" name="n_totalsalesperday" value="<?=$totalSalesPerDay;?>">
                      <tr>
                      <tr>
                        <td class="text-right p-2" style="border-bottom:2px solid gray;">Return Item:</td>
                        <td style="border-bottom:2px solid gray;"><?= '<strong>₱'.number_format($totalReturnSalesPerDay, 2).'</strong>';?></td>
                        <input type="hidden" name="n_totalreturnsalesperday" value="<?=$totalReturnSalesPerDay;?>">
                      </tr>
                      <tr>
                        <td class="text-right p-2" style="border-bottom:2px solid gray;">Daily Sales:</td>
                        <td style="border-bottom:2px solid gray;"><?= '<strong>₱'.number_format($totalFinalSalesPerDay, 2).'</strong>';?></td>
                        <input type="hidden" name="n_totalfinalsalesperday" value="<?=$totalFinalSalesPerDay;?>">
                      </tr>
                      <tr>
                        <td class="text-right p-2" style="border-bottom:2px solid gray;">Daily Expenses:</td>
                        <td style="border-bottom:2px solid gray;"><?= '<strong>₱'.number_format($totalDailyExpenses, 2).'</strong>'; ?></td>
                        <input type="hidden" name="n_totalDailyExpenses" value="<?=$totalDailyExpenses;?>">
                      </tr>
                      <tr>
                        <td class="text-right p-2">Cement:</td>
                        <td><input type="number" step="0.01" name="n_cement" value="0" required></td>
                      </tr>
                      <tr>
                        <td class="text-right p-2">Extra:</td>
                        <td><input type="number" step="0.01" name="n_extra" value="0" required></td>
                      </tr>
                      <tr>
                        <td class="text-right p-2">Savings:</td>
                        <td><input type="number" step="0.01" name="n_savings" value="0" required></td>
                      </tr>
                      <tr>
                        <td class="text-right p-2">Seller:</td>
                        <td><input type="text" name="n_seller" placeholder="Enter Seller.." required></td>
                      </tr>
                      <tr>
                        <td class="text-right p-2">Source:</td>
                        <td><input type="text" name="n_source" placeholder="Enter Source.." required></td>
                      </tr>
                      
                      <tr>
                        <?php 
                          if($totalSalesPerDay == 0) {
                        ?>
                          <td colspan="2"><button type="button" disabled class="mt-2 btn btn-sm btn-danger" data-toggle="modal" data-target="#modalAddDailyTotal"><i class="fa fa-cart-arrow-down"></i> ADD DAILY TOTAL</button></td>
                        <?php
                          } else {
                        ?>
                          <td colspan="2"><button type="button" class="mt-2 btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddDailyTotal"><i class="fa fa-cart-arrow-down"></i> ADD DAILY TOTAL</button></td>
                        <?php
                          }
                        ?>
                        
                      </tr>

                      <!-- Modal -->
                      <div class="modal fade" id="modalAddDailyTotal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-user-account" role="document">
                          <div class="modal-content modal-content-user-account">
                            <div class="modal-header">
                              <h6 class="modal-title" id="exampleModalLabel">DAILY TOTAL</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row no-gutters">
                                <div class="col-12 text-center">
                                  <h5 class="h5-responsive">Please review your inputs!</h5>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="btnAddDailyTotal" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddDailyTotal"><i class="fa fa-cart-arrow-down"></i> SAVE</button>
                              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> CLOSE</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </table>
                  </form>
              <?php
                } else {
                  echo '<div class="mt-3"><h4 style="color:silver;">Please select a date!</h4></div>';
                }
              ?>  
            </div>   
          </div>

          <div class="col-12 col-md-6"> 
            <div class="ml-2">
              <?php 
                if(isset($_POST['btnAddDailyTotal'])) {

                  $n_scheddate              = $_POST['n_scheddate'];         
                  $n_totalsalesperday       = $_POST['n_totalsalesperday'];                  
                  $n_totalreturnsalesperday = $_POST['n_totalreturnsalesperday'];                  
                  $n_totalfinalsalesperday  = $_POST['n_totalfinalsalesperday'];                        
                  $n_totalDailyExpenses     = $_POST['n_totalDailyExpenses'];             
                  $n_cement                 = $_POST['n_cement'];
                  $n_extra                  = $_POST['n_extra'];
                  $n_savings                = $_POST['n_savings'];
                  $n_seller                 = $_POST['n_seller'];
                  $n_source                 = $_POST['n_source'];

                  //net sales = (DailySales - DailyExpenses - Cement - Extra - Savings)        
                  $n_netSales = ($n_totalfinalsalesperday - $n_totalDailyExpenses - $n_cement - $n_extra - $n_savings)

                  ?>

                  <p class="msg-success alert alert-success text-center"><i class="fa fa-check"></i> Successfully added! &nbsp; <i class="fa fa-window-close"></i></p>
                  <div class="display-data">
                    <div class="row no-gutters">
                      <div class="col-6">
                        <p class="p-s-1 text-right">Date Selected:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 text-left"><strong><?=$n_scheddate;?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6">
                        <p class="p-s-1 text-right">Sales Per Day:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 text-left"><strong>₱<?=number_format($n_totalsalesperday, 2);?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6">
                        <p class="p-s-1 text-right">Return Item:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 text-left"><strong>₱<?=number_format($n_totalreturnsalesperday, 2);?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6 pt-2" style="border-top:1px solid silver;">
                        <p class="p-s-1 text-right">Daily Sales:</p>
                      </div>
                      <div class="col-6 pt-2" style="border-top:1px solid silver;">
                        <p class="p-s-2 text-left"><strong>₱<?=number_format($n_totalfinalsalesperday, 2);?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6">
                        <p class="p-s-1 pt-2 text-right" style="border-top:1px solid silver;">Daily Expenses:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 pt-2 text-left" style="border-top:1px solid silver;"><strong>₱<?=number_format($n_totalDailyExpenses, 2);?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6">
                        <p class="p-s-1 pt-2 text-right" style="border-top:1px solid silver;">Cement:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 pt-2 text-left" style="border-top:1px solid silver;"><strong>₱<?=number_format($n_cement, 2);?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6">
                        <p class="p-s-1 text-right">Extra:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 text-left"><strong>₱<?=number_format($n_extra, 2);?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6">
                        <p class="p-s-1 text-right">Savings:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 text-left"><strong>₱<?=number_format($n_savings, 2);?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6">
                        <p class="p-s-1 text-right">Seller:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 text-left"><strong><?=ucwords(strtolower($n_seller));?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6">
                        <p class="p-s-1 text-right">Source:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 text-left"><strong><?=ucwords(strtolower($n_source));?></strong></p>
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-6 pt-1" style="border-top:1px solid gray;">
                        <p class="p-s-1 text-right">Net Sales:</p>
                      </div>
                      <div class="col-6">
                        <p class="p-s-2 pt-1 text-left" style="border-top:1px solid gray;"><strong>₱<?=number_format($n_netSales, 2);?></strong></p>
                      </div>
                    </div>
                  </div>  

                  <?php
                  //echo $_POST['cement'];
                } else {
                  ?>
                    <div class="col-12">
                        <p class="alert alert-info"><i class="fa fa-info-circle"></i> Added daily total goes here!</p>
                    </div>
                  <?php
                }

              //
                //save to db.tbl dailyTotal
                /*@$DailyTotal->insertData(array(
                'n_totalfinalsalesperday' => @$n_totalfinalsalesperday,
                'n_totalDailyExpenses' => @$n_totalDailyExpenses,
                'n_cement' => @$n_cement,
                'n_extra' => @$n_extra,
                'n_savings' => @$n_savings,
                'n_seller' => @$n_seller,
                'n_source' => @$n_source,
                'n_scheddate' => @$n_scheddate));*/

              
                echo @$DailyTotal->insertData(@$n_totalfinalsalesperday, @$n_totalDailyExpenses, @$n_cement, @$n_extra, @$n_savings, @$n_seller, @$n_source, @$n_scheddate);
                    //underconstruction*/
                    //$DailyTotal->save();
                
              ?>
            </div>
          </div>
        </div>
     
        <div class="row">
          
        </div>
      
    </div>
    <?php endif; ?>
  </div>

<?php
Footer::Create();
?>
<!-- delete - selected expenses -->
<script type="text/javascript">
  $(document).ready(function()
    {
      $('.btn-delete-expenses-item').click(function(e) {
        //preventing a page refresh
        e.preventDefault();
        //please wait
            //$('.wrapper-please-wait').show();
            //$('.please-wait').show();

          var target_id = $(this).attr("data-id");
            $('#selected-expenses-item-'+target_id).remove();

          $.ajax({
              url: "server-ajax/dailyexpensesdelajax",
              type: "POST",
              data: "id_expenses_item=" + target_id,
              success: function() {
                //hide please wait
                  $('.wrapper-please-wait').hide();
                  $('.please-wait').hide();

                  console.log("AJAX request was successful - action=DELETE");
              },
              error:function() {
                console.log("AJAX request was a failure - action=DELETE");
            }
          });
       });
    });
</script>
<?php
$month = SimpleDate::Create()->getFormat('m');

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

</body>
</html>
