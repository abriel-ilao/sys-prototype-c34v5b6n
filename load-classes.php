<?php

/*********************************************/
/******************** app ********************/
/*********************************************/

/******************** DB ********************/
//connection
require_once 'app/db/connection/Connection.php';
require_once 'app/db/connection/DB.php';

/******************** MVC ********************/
//model
require_once 'app/model/accounts/AccountsAdminInfoModel.php';
require_once 'app/model/accounts/AccountsAdminLoginModel.php';
require_once 'app/model/accounts/AccountsAdminModel.php';

//controller
require_once 'app/controller/accounts/AccountsAdminInfoController.php';
require_once 'app/controller/accounts/AccountsAdminLoginController.php';

//view
require_once 'app/view/accounts/AccountsAdminInfoView.php';
require_once 'app/view/accounts/AccountsAdminLoginView.php';

/******************** lib ********************/
//xss
require_once 'app/lib/xss/vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';

//datetime
require_once 'app/lib/datetime/SimpleDate.php';

//datetime
require_once 'app/lib/carbon/SimpleCarbon.php';

//encryption
require_once 'app/lib/encryption/Encryption.php';

//session
require_once 'app/lib/session/Session.php';

//validation
//factory
require_once 'app/lib/validation/factory/Input.php';
require_once 'app/lib/validation/factory/Matches.php';
require_once 'app/lib/validation/factory/Max.php';
require_once 'app/lib/validation/factory/Min.php';
require_once 'app/lib/validation/factory/Required.php';
require_once 'app/lib/validation/factory/Unique.php';

//validator
require_once 'app/lib/validation/validator/MatchesStr.php';
require_once 'app/lib/validation/validator/MaxStr.php';
require_once 'app/lib/validation/validator/MinStr.php';
require_once 'app/lib/validation/validator/RequiredStr.php';
require_once 'app/lib/validation/validator/UniqueStr.php';

/******************** Accounts ********************/
require_once 'app/data/accounts/AccountsModel.php';
require_once 'app/data/accounts/Accounts.php';

/******************** Change Password ********************/
require_once 'app/data/accounts/AccountsChangePass.php';

/******************** Edit Info ********************/
require_once 'app/data/accounts/AccountsEditInfo.php';

/******************** Inventory ********************/
require_once 'app/data/inventory/InventoryModel.php';
require_once 'app/data/inventory/InventoryAdd.php';
require_once 'app/data/inventory/InventoryEdit.php';
require_once 'app/data/inventory/InventoryEditInfo.php';
require_once 'app/data/inventory/InventoryDel.php';
require_once 'app/data/inventory/InventoryPaginate.php';
require_once 'app/data/inventory/InventoryItemNotification.php';
require_once 'app/data/inventory/InventorySearch.php';

/******************** Transaction ********************/
require_once 'app/data/transaction/TransactionAddItem.php';
require_once 'app/data/transaction/TransactItems.php';
require_once 'app/data/transaction/TransactionLog.php';
require_once 'app/data/transaction/TransactionDelReturnItems.php';

/******************** Return Items ********************/
require_once 'app/data/returnitems/ReturnItemsAddItem.php';
require_once 'app/data/returnitems/ReturnItems.php';

/******************** Daily Expenses ********************/
require_once 'app/data/dailyexpenses/AddExpenses.php';
require_once 'app/data/dailyexpenses/ExpensesLog.php';
require_once 'app/data/dailyexpenses/DelExpenses.php';

/******************** Daily Total ********************/
require_once 'app/data/dailytotal/Dailytotal.php';
require_once 'app/data/dailytotal/DelDailyTotal.php';
