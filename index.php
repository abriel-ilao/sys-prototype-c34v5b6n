<?php

require 'flight/Flight.php';

Flight::route('/test', function(){
    include 'test.php';
});

Flight::route('/', function(){
    include 'loremipsum.php';
});

Flight::route('/locked', function(){
    include 'locked.php';
});

/* POS, INVENTORY ITEMS, Item notification, and so on... */

Flight::route('/pos', function(){
    include 'pos.php';
});

Flight::route('/inventory', function(){
    include 'inventory.php';
});

Flight::route('/item', function(){
    include 'inventoryedit.php';
});

Flight::route('/changepass', function(){
    include 'changepass.php';
});

Flight::route('/notify', function(){
    include 'inventoryitemnotification.php';
});

Flight::route('/transactionlog', function(){
    include 'transactionlog.php';
});

/* server-ajax requests */
Flight::route('/server-ajax/inventoryajax', function(){
    include './server-ajax/inventoryajax.php';
});

Flight::route('/server-ajax/inventoryeditajax', function(){
    include './server-ajax/inventoryeditajax.php';
});

Flight::route('/server-ajax/inventoryeditrefreshajax', function(){
    include './server-ajax/inventoryeditrefreshajax.php';
});

Flight::route('/server-ajax/inventorydelajax', function(){
    include './server-ajax/inventorydelajax.php';
});

Flight::route('/server-ajax/inventoryitemnotificationajax', function(){
    include './server-ajax/inventoryitemnotificationajax.php';
});

Flight::route('/server-ajax/inventoryitemnotificationcounterajax', function(){
    include './server-ajax/inventoryitemnotificationcounterajax.php';
});

Flight::route('/server-ajax/inventorysearchajax', function(){
    include './server-ajax/inventorysearchajax.php';
});

Flight::route('/server-ajax/transactionaddajax', function(){
    include './server-ajax/transactionaddajax.php';
});

Flight::route('/server-ajax/transactajax', function(){
    include './server-ajax/transactajax.php';
});

Flight::route('/server-ajax/transactionlogajax', function(){
    include './server-ajax/transactionlogajax.php';
});

Flight::route('/server-ajax/transactionlogyearajax', function(){
    include './server-ajax/transactionlogyearajax.php';
});

/*Flight::route('/??/@id:[0-9]{2}', function($id){
    include '??.php';
});

Flight::route('/??/@id:[0-9]{1}', function($id){
    include '??.php';
});*/

Flight::start();
