<?php

require_once 'auth.php';
require_once './frontend-ui/header.php';
require_once './frontend-ui/footer.php';

use app\controller\accounts\AccountsAdminInfoController;
use app\data\inventory\InventoryPaginate;

if($auth) :

//init user's info controller
$accountData = AccountsAdminInfoController::Create();

//get user's level
$level = $accountData->getData('level');

//active navigation
$active = '2';

//init header with one parameter
Header::Create($active);

//init pagination for inventory
$paginate = InventoryPaginate::Create();

$sql = $paginate->dataQuery();
$records_per_page = $paginate->recordsPerPage();
$newquery = $paginate->paging($sql, $records_per_page);

function subMenuItem($level, $elementPos) {
?>
<div class="col-sm-8 col-md-6">
		<div class="pos-sub-item <?= $elementPos; ?>">
				<ul>
						<?php if($level == 1 || $level == 2) : ?>
								<li><a href="pos#add" class="show-please-wait"><i class="fa fa-cart-arrow-down"></i> Add Item</a></li>
						<?php endif; ?>
						<?php if($level == 3) : ?>
								<li><a href="pos" class="show-please-wait"><i class="fa fa-shopping-bag"></i> Point of Sale</a></li>
						<?php endif; ?>
								<li><a href="inventory" class="active-sub-item"><i class="fa fa-tag"></i> View Items</a></li>
				</ul>
		</div>
</div>
<?php
}

function searchItems() {
?>
<div class="col-sm-8 col-md-6">
    <!--<form class="form-inline">-->
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">Search Items (Item Code, Desc..., Type, Selling Price)</label>
      <div class="input-group">
        <input type="text" class="form-control" id="searchText" placeholder="Search Items (Item Code, Desc..., Type, Selling Price)">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-search"></i></div>
        </div>
      </div>
    </div>
</div>
<?php
}
?>
		<div class="header-sub mb-2">
				<div class="container">
						<div class="row">
							<?php
								if($level == 1 || $level == 2):
									subMenuItem($level, 'text-left');
									searchItems();
								endif;
								if($level == 3):
									searchItems();
									subMenuItem($level, 'text-right');
								endif;
							?>
						</div>
				</div>
		</div>

    <div class="m-search pt-5 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--<form class="form-inline">-->
                    <div class="col-auto">
                      <label class="sr-only" for="inlineFormInputGroup">Search Items (Item Code, Desc..., Type, Selling Price)</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="m-searchText" placeholder="Search Items (Item Code, Desc..., Type, Selling Price)">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-search"></i></div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container panel-x container-search mb-2">
        <div class="row">
            <div class="col-12">
                <div id="searchResult"></div>
            </div>
        </div>
    </div>

    <div class="container panel-x">
		<div class="row">
        	<div class="col-12">
        	<div class="h6-responsive h-inventory" id="view"><i class="fa fa-tag"></i> Inventory Items</div>
					<?php if($level == 1 || $level == 2) : ?>
					<?= $paginate->totalItems(); ?>
            <div class="mb-3"><a href="#" data-toggle="modal" data-target="#compute_items" class="btn btn-info btn-sm">Summation of Inventory</a></div>
					<?php endif; ?>
				<nav aria-label="...">
						<ul class="pagination pagination-sm">
						<?php
							$paginate->pagingLink($sql, $records_per_page);
						?>
					</ul>
				</nav>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
	        <div class="table-responsive table-pad-bottom">
					<table class="table table-bordered table-hover" style="font-size:13px;">
						<thead>
						<tr style="background-color:#d1ecf1;">
							<?php if($level == 1) : ?>
								<th scope="col" colspan="2"></th>
							<?php endif; ?>
							<?php if($level == 2) : ?>
								<th scope="col" colspan="1"></th>
							<?php endif; ?>
    							<th scope="col">Item code</th>
    							<th scope="col">Description</th>
    							<th scope="col">Material Type</th>
							<?php if($level == 1 || $level == 2) : ?>
    							<th scope="col">Purchased Stock</th>
    							<th scope="col">Available Stock</th>
    							<th scope="col">Buying Price</th>
    							<th scope="col">Trucking Fee</th>
    							<th scope="col">Monthly Expenses</th>
							<?php endif; ?>
							    <th scope="col">Selling Price</th>
							<?php if($level == 1 || $level == 2) : ?>
                                <th scope="col">Total Sales</th>
                                <th scope="col">Balance Sales</th>
    							<th scope="col">Profit</th>
    							<th scope="col">Total Profit</th>
    							<th scope="col">Date Added</th>
							<?php endif; ?>
						</tr>
						</thead>
						<tbody>
							<?php if($level == 1) :
								$paginate->dataView($newquery, 1);
							endif; ?>

							<?php if($level == 2) :
								$paginate->dataView($newquery, 2);
							endif; ?>

							<?php if($level == 3) :
								$paginate->dataView($newquery, 3);
							endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

      <div class="row">
        <div class="col-12">
				<nav aria-label="...">
						<ul class="pagination pagination-sm">
						<?php
							$paginate->pagingLink($sql, $records_per_page);
						?>
					</ul>
				</nav>
			</div>
		</div>
    </div>

<?php

Footer::Create();

?>

<script type="text/javascript">
	$(document).ready(function()
    {
    	$('.btn-delete-item').click(function(e) {
    		//preventing a page refresh
    		e.preventDefault();
    		//please wait
            $('.wrapper-please-wait').show();
            $('.please-wait').show();

	    		var target_id = $(this).attr("data-id");
		        $('#selected-item-'+target_id).remove();

	        $.ajax({
							url: "server-ajax/inventorydelajax",
							type: "POST",
							data: "id=" + target_id,
							success: function() {
								//hide please wait
			                    $('.wrapper-please-wait').hide();
			                    $('.please-wait').hide();

			                    var x = Number($('#totalItems').text());
			                    var y = x-1;

			                    $('#totalItems').text(y);

							  	console.log("AJAX request was successfull - action=DELETE");
							},
							error:function() {
						  	console.log("AJAX request was a failure - action=DELETE");
						}
					});
	     });
    });
</script>
<script type="text/javascript">
    $(document).ready(function()
    {
        function loadSearchData(query)
        {
            var level = <?php echo $level; ?>

            $.ajax({
                url:"server-ajax/inventorysearchajax",
                method:"post",
                data:{query:query, level:level},
                success:function(data)
                {
                    $('#searchResult').html(data);
                }
            });
        }

        $('#searchText, #m-searchText').keyup(function() {
            var search = $(this).val();
            if(search != '')
            {
                loadSearchData(search);
                $('.container-search').show();
            }
            else
            {
                $('.container-search').hide();
            }
        });
    });

</script>
<script type="text/javascript">
    for(var i = 1; i <= 4; i++) {
        var comma_a = numberWithCommas($('.num-with-comma-' + i).text());
        $('.num-with-comma-' + i).text(comma_a);
    }
</script>

<?php

else:
    require_once 'login-form.php';
endif;

?>

</body>
</html>
