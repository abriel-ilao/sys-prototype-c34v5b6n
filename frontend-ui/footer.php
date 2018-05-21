<?php 
class Footer {
    public static function Create() { return new Footer; }   
    public function __clone() {}
    public function __construct() {
?>
    <!-- Optional JavaScript -->
    <script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>

    <!-- init -->
    <script type="text/javascript">

    $(document).ready(function() {

        /*** back to top smooth-scroll ***/
        function scrollBackToTop(backToTop, scrollSmooth) {
            //scroll percentage
            $(window).scroll(function() {
                var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());               
                if(scrollPercent > 2) {
                   $(backToTop).css({'display' : 'block'}).addClass('animated fadeInDown');
                   $(backToTop).addClass('animated fadeInUp'); 
                } else {
                   $(backToTop).slideUp(300);
                }

                //console.log($(window).scrollTop());
                //console.log($(document).height());
                //console.log($(window).height());
            });
            //smooth
            $(scrollSmooth).on('click', 'a', function (event) {
                event.preventDefault();
                var elAttr = $(this).attr('href'),
                    offset = ($(this).data('offset') ? $(this).data('offset') : 0);
                $('body,html').animate({
                    scrollTop: $(elAttr).offset().top + offset
                }, 700);
            }); 
        }
        //scrollBackToTop('.back-to-top', '.smooth-scroll');

       /* function scrollSmooth(scrollSmooth) {
            $(scrollSmooth).on('click', 'a', function (event) {
                event.preventDefault();
                var elAttr = $(this).attr('href'),
                    offset = ($(this).data('offset') ? $(this).data('offset') : 0);
                $('body,html').animate({
                    scrollTop: $(elAttr).offset().top + offset
                }, 700);
            }); 
        }*/
       // scrollSmooth('#service, #station, #drivers');

        /*** Init Animation ***/
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

        function labelFocus() {
            $('label').on('click', function() {
                var label = $(this);
                var input = label.siblings('input')[0];

                label.addClass('active');
                input.focus();        
            }); 
        }
       // labelFocus();

        function faClose() {
            $('.fa-close').on('click', function() {
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
                      // Schedule the next request when the current one's complete
                      setTimeout(worker, 3000);
                    }
                });
            })();  
        }

        itemNotificationCounter();

    /*
    $.post( "check.php", { user: $("#username").val() }, function (data){if(data=='1'){//do 1 }
      elseif(data=='0'){//do 0 }});if(!isset($_POST['user'] || empty($_POST['user'])){
       echo '0'; exit();} $username = trim($_POST['user']); 
    */
    </script>

<?php }} ?>
