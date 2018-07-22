<?php

use app\controller\accounts\AccountsAdminInfoController;

class Footer {
    public static function Create() { return new Footer; }
    public function __clone() {}
    public function __construct() {

    //init user's info controller
    $accountData = AccountsAdminInfoController::Create();

    //get user's level
    $level = $accountData->getData('level');
?>

    <div class="back-to-top-wrapper smooth-scroll">
      <a href="#scroll-top">
        <div class="back-to-top">
            <i class="fa fa-arrow-up" style="font-size:18px;"></i>
        </div>
      </a>
    </div>

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./js/popper.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/notify.min.js"></script>
    <script type="text/javascript" src="./js/js.cookie.js"></script>
    <script type="text/javascript" src="./js/mini.rand.lib.js"></script>

    <!-- init -->
    <script type="text/javascript">
    $(document).ready(function() {
        /*** Header-m - Navicon toggle ***/
        function navicon() {
            $('.navicon-icon').click(function() {
                 $('.m-nav').animate({left: '0'});
                 $('.m-transparent-panel').css({display: 'block'});
                 $('body').css({overflow: 'hidden'});
            });
        }
        navicon();

        //hide main nav
        function hide_m_nav() {
            $('.m-btn-close, .btn-close-top, .m-transparent-panel').click(function() {
                $('.m-nav').animate({left: '-270px'});
                $('.m-transparent-panel').css({display: 'none'});
                $('body').css({overflow: 'visible'});
            });
        }
        hide_m_nav();

        //sub menu caret
        function showInventorySub(mainMenu, menuSub) {
            var caret = 0;
            $(mainMenu).click(function()
            {
               $(menuSub).slideToggle();

               if(!caret) {
                  $('.fa-inventory-toggle').removeClass('fa-caret-right').addClass('fa-caret-down');
                  caret = 1;
               } else {
                  $('.fa-inventory-toggle').removeClass('fa-caret-down').addClass('fa-caret-right');
                  caret = 0;
               }
            });
        }
        showInventorySub('li.m-header-main-menu-li-inventory', 'ul.m-header-main-menu-list-sub-inventory');
        showInventorySub('li.m-header-main-menu-li-point-of-sale', 'ul.m-header-main-menu-list-sub-point-of-sale');

        //main menu link
        function main_menu_link() {
            $('ul.m-header-main-menu-list .m-header-main-menu-li:nth-child(1)').click(function() {
                window.location.replace('#');
            });
            $('ul.m-header-main-menu-list .m-header-main-menu-li:nth-child(3)').click(function() {
                window.location.replace('#');
            });
            $('ul.m-header-main-menu-list .m-header-main-menu-li-transaction-log').click(function() {
                window.location.replace('transactionlog');
            });
            //sub
            $('ul.m-header-main-menu-list-sub .m-header-main-menu-li-sub:nth-child(1)').click(function() {
                window.location.replace('pos');
            });
            $('ul.m-header-main-menu-list-sub .m-header-main-menu-li-sub:nth-child(2)').click(function() {
                window.location.replace('inventory');
            });
        }
        main_menu_link();

        /*** back to top smooth-scroll ***/
        function scrollBackToTop(backToTop) {
            //scroll percentage
            $(window).scroll(function() {
                var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
                if(scrollPercent > 2) {
                   $(backToTop).fadeIn('slow');
                   $(backToTop).addClass('animated fadeInUp');
                } else {
                   $(backToTop).slideUp(300);
                }
            });
        }
        scrollBackToTop('.back-to-top');

        //scroll smooth
        function scrollSmooth(scrollSmooth) {
            $(scrollSmooth).on('click', 'a', function (event) {
                event.preventDefault();
                var elAttr = $(this).attr('href'),
                    offset = ($(this).data('offset') ? $(this).data('offset') : 0);
                $('body,html').animate({
                    scrollTop: $(elAttr).offset().top + offset
                }, 700);
            });
        }
        scrollSmooth('.smooth-scroll');

        /*** Animation ***/
        function removeAnimationIESafari() {
            //If the user is using Internet Explorer or Safari
            if (navigator.appName == 'Microsoft Internet Explorer' ||  !!(navigator.userAgent.match(/Trident/) || navigator.userAgent.match(/rv:11/)) || (typeof $.browser !== "undefined" && $.browser.msie == 1) || (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1))
            {
                //remove animation
            }
            else
            {
                new WOW().init();
            }
        }
        //removeAnimationIESafari();

        //init tooltip
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });

        function faClose() {
            $('.fa-window-close').on('click', function() {
                $('.msg-success, .msg-error').hide();
            });
        }

        faClose();

        function pleaseWait() {
            $('.wrapper-please-wait').hide();
            $('.please-wait').hide();
            $('.show-please-wait').on('click', function() {
                $('.wrapper-please-wait').show();
                $('.please-wait').show();
            });
        }

        $('.wrapper-please-wait').hide();
        //pleaseWait();
    });

    function itemNotificationCounter() {
      return (function worker() {
        $.ajax({
            url: 'server-ajax/inventoryitemnotificationcounterajax',
            success: function(data) {
              $('.inventory-item-notificaton-num').html(data);
            },
            complete: function() {
              setTimeout(worker, 5000);
            }
        });
      })();
    }
    </script>

<?php
    print '
    <script type="text/javascript">
        var userlevel;
        userlevel = "'.$level.'";
        if(userlevel == 1 || userlevel == 2) {
          itemNotificationCounter();
        }
    </script>';
?>
<?php }} ?>
