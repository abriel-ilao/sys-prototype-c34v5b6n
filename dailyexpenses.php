<?php

require_once 'auth.php';
require_once './frontend-ui/header.php';
require_once './frontend-ui/footer.php';

use app\controller\accounts\AccountsAdminInfoController;
use app\data\dailyexpenses\AddExpenses;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//init AddExpenses - adding daily expenses
$AddExpenses = AddExpenses::Create();

//get user's level
$level = $accountData->getData('level');

//get user's ID
$userID = $accountData->getData('Id');
$username = $accountData->getData('username');

//active navigation
$active = '6';

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
                          <li><a href="dailyexpenses" class="active-sub-item"><i class="fa fa-cart-arrow-down"></i> Add Expenses</a></li>
                          <li><a href="expenseslog"><i class="fa fa-shopping-bag"></i> Expenses Log</a></li>
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
                  <!--<h1 class="h6 mt-2"><i class="fa fa-edit"></i> Add Expenses</h1>-->

              </div>
          </div>
      </div>
  	</div>

    <?php
      if($AddExpenses->createData()) :
    ?>
      <p class="msg-success alert alert-success text-center"><i class="fa fa-check"></i> New Expenses was successfully added! &nbsp; <i class="fa fa-window-close"></i></p>
    <?php
      endif;
    ?>

    <div class="container panel-x">
        <?php if($level == 1 || $level == 2) : ?>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="h6-responsive h-inventory" id="add"><i class="fa fa-cart-arrow-down"></i> Add New Expenses <span class="m-sub-menu-link float-right"><a href="expenseslog" class="text-info"><i class="fa fa-tag"></i> View</a></span></div>
                    <form action="dailyexpenses" method="POST" role="form">
                        <!--<form action="pos" method="POST">-->
                        <div class="col-12">
                          <h5 class="h-inventory"><strong>DATE</strong></h5>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Date:</label>
                            <div class="col-sm-8">
                              <input type="text" name="schedDate" id="schedDate" class="form-control validate" placeholder="Click/Tap to add date..." autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-12">
                          <h5 class="h-inventory"><strong>DIESEL</strong></h5>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">TRUCK:</label>
                            <div class="col-sm-8">
                              <input type="number" step="0.01" value="0" name="ex_truck" id="ex_truck" class="form-control form-control-sm" autocomplete="off" placeholder="TRUCK" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">HILUX:</label>
                            <div class="col-sm-8">
                              <input type="number" step="0.01" value="0" name="ex_hilux" id="ex_hilux" class="form-control form-control-sm" autocomplete="off" placeholder="HILUX" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">PICANTO:</label>
                            <div class="col-sm-8">
                              <input type="number" step="0.01" value="0" name="ex_picanto" id="ex_picanto" class="form-control form-control-sm" autocomplete="off" placeholder="PICANTO" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">TRICYCLE:</label>
                            <div class="col-sm-8">
                              <input type="number" step="0.01" value="0" name="ex_tricycle" id="ex_tricycle" class="form-control form-control-sm" autocomplete="off" placeholder="TRICYCLE" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">GENERATOR:</label>
                            <div class="col-sm-8">
                              <input type="number" step="0.01" value="0" name="ex_generator" id="ex_generator" class="form-control form-control-sm" autocomplete="off" placeholder="GENERATOR" required>
                            </div>
                        </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong>INTERNET:</strong></label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_internet" id="ex_internet" class="form-control form-control-sm" autocomplete="off" placeholder="INTERNET" required>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong>NORSAMELCO:</strong></label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_norsamelco" id="ex_norsamelco" class="form-control form-control-sm" autocomplete="off" placeholder="NORSAMELCO" required>
                          </div>
                      </div>

                      <div class="col-12">
                        <h5 class="h-inventory"><strong>FOOD</strong></h5>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">ULAM:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_ulam" id="ex_ulam" class="form-control form-control-sm" autocomplete="off" placeholder="ULAM" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">WATER:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_water" id="ex_water" class="form-control form-control-sm" autocomplete="off" placeholder="WATER" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">GASUL:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_gasul" id="ex_gasul" class="form-control form-control-sm" autocomplete="off" placeholder="GASUL" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">RICE (SACK):</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_rice" id="ex_rice" class="form-control form-control-sm" autocomplete="off" placeholder="RICE (SACK)" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">BIGAS:</label>
                          <div class="col-sm-8">
                            <input type="text" name="ex_bigas" id="ex_bigas" value="empty" class="form-control form-control-sm" autocomplete="off" placeholder="BIGAS" required>
                          </div>
                      </div>

                      <div class="col-12">
                        <h5 class="h-inventory"><strong>WORKERS</strong></h5>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person1();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person1" id="ex_person1" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person1();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person2();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person2" id="ex_person2" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person2();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person3();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person3" id="ex_person3" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person3();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person4();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person4" id="ex_person4" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person4();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person5();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person5" id="ex_person5" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person5();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person6();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person6" id="ex_person6" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person6();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person7();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person7" id="ex_person7" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person7();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person8();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person8" id="ex_person8" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person8();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person9();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person9" id="ex_person9" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person9();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person10();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person10" id="ex_person10" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person10();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person11();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person11" id="ex_person11" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person11();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person12();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person12" id="ex_person12" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person12();?>" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right"><strong><?=$AddExpenses->person13();?></strong>:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_person13" id="ex_person13" class="form-control form-control-sm" autocomplete="off" placeholder="<?=$AddExpenses->person13();?>" required>
                          </div>
                      </div>

                      <div class="col-12">
                        <h5 class="h-inventory"><strong>EXTRA</strong></h5>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">LABOR:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_labor" id="ex_labor" class="form-control form-control-sm" autocomplete="off" placeholder="LABOR" required>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">MATERIALS:</label>
                          <div class="col-sm-8">
                            <input type="number" step="0.01" value="0" name="ex_materials" id="ex_materials" class="form-control form-control-sm" autocomplete="off" placeholder="MATERIALS" required>
                            <input type="hidden" name="username" value="<?=$username;?>">
                          </div>
                      </div>

                      <div class="form-group row">
                          <div class="col-sm-4"></div>
                          <div class="col-sm-8 smooth-scroll">
                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modalSubmit"><i class="fa fa-cart-arrow-down"></i> ADD EXPENSES</button>
                          </div>
                      </div>
                </div>
                <div class="item-info col-12 col-lg-6">

                    <?php
                      if($AddExpenses->createData()):
                    ?>
                      <p class="alert alert-success"><i class="fa fa-check"></i> New Expenses was successfully added!</p>
                    <?php
                    else:
                    ?>
                      <p class="alert alert-info"><i class="fa fa-info-circle"></i> Item information goes here!</p>
                    <?php
                      endif
                    ?>
                    <?= @$AddExpenses->readData(); ?>
                </div>

              </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="modalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-user-account" role="document">
                  <div class="modal-content modal-content-user-account">
                      <div class="modal-header">
                          <h6 class="modal-title" id="exampleModalLabel">Add New Expenses</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body admin-modal-body">
                          <div class="row no-gutters">
                            Please review your inputs...
                          </div>
                      </div>
                      <div class="modal-footer">
                        <!--<button type="button" name="submit" class="btn btn-default btn-md" id="accountReg" data-dismiss="modal">Save Changes</button>-->
                        <button type="button" id="submitSaveF" class="btn btn-default btn-sm"><i class="fa fa-cart-plus"></i> SAVE</button>
                        <button type="submit" id="submitSave" class="btn btn-primary btn-sm" name="submitSave"><i class="fa fa-cart-plus"></i> SAVE</button> &nbsp;
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                      </div>
                  </div>
              </div>
          </div>
        </form>

        <?php endif; ?>

    </div>
<?php

Footer::Create();

?>

<script type="text/javascript">
  $(document).ready(function()
  {
      inputFocus();
      submitSave();
      $('#submitSaveF').hide();
  });

  function inputFocus() {
      $("input").focus(function() {
          $('.display-data').hide();
      });
  }

  function submitSave() {
    $('#submitSave').click(function() {
      $(this).hide();
      $('#submitSaveF').fadeIn('fast');
    });
  }
</script>

<?php
    else:
        require_once 'login-form.php';
    endif;
?>

</body>
</html>
