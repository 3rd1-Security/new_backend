<?php
include_once('app/config.php');

$user = new User();

// Check if the user is logged in
if (isset($_COOKIE['uid']) && is_numeric($_COOKIE['uid']) && 
    in_array($_COOKIE['uid'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))) {
      
  $user = $user->getUser($mysqli, (int)$_COOKIE['uid']);
  
  $relation = new Relation($mysqli, $user);
} else {
  header('Location: login.php');
}

$msg = '';
$status = array(
  'success' => 'Operation performed Successfully.',
  'failed' => 'Action Failed to process!'
);

if (isset($_COOKIE['status']) && array_key_exists($_COOKIE['status'], $status)) {
  $msg = $status[$_COOKIE['status']];
  // clear the cookie
  setcookie('status', '');
  unset($_COOKIE['status']);
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $user->getName() ?></title>

        <!-- ================= Favicon ================== -->
        <!-- Standard -->
        <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
        <!-- Retina iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
        <!-- Retina iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
        <!-- Standard iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
        <!-- Standard iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

        <!-- Styles -->
        <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
        <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
        <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
        <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">

        <link href="assets/css/lib/helper.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        
        <link href="assets/css/feed.css" rel="stylesheet">
          
      
      <!--scrollFeed-->
        <style type="text/css">
            
            #feedBox{
                height:500px;
                position:fixed;
                width:25%;
            
            }
            #scrollNav{
                position:sticky;
            }
        
h3 {
  margin-top: 30px;
  font-size: 18px;
  color: #555;
}

p { padding-left: 10px; }

.btn {
  box-shadow: 1px 1px 0 rgba(255,255,255,0.5) inset;
  border-radius: 3px;
  border: 1px solid;
  display: inline-block;
  height: 18px;
  line-height: 18px;
  padding: 0 8px;
  position: relative;

  font-size: 12px;
  text-decoration: none;
  text-shadow: 0 1px 0 rgba(255,255,255,0.5);
}
       
.btn-counter { margin-right: 39px; }
.btn-counter:after,
.btn-counter:hover:after { text-shadow: none; }
.btn-counter:after {
  border-radius: 3px;
  border: 1px solid #d3d3d3;
  background-color: #eee;
  padding: 0 8px;
  color: #777;
  content: attr(data-count);
  left: 100%;
  margin-left: 8px;
  margin-right: -13px;
  position: absolute;
  top: -1px;
}
.btn-counter:before {
  transform: rotate(45deg);
  filter: progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865476, M12=-0.7071067811865475, M21=0.7071067811865475, M22=0.7071067811865476, sizingMethod='auto expand');

  background-color: #eee;
  border: 1px solid #d3d3d3;
  border-right: 0;
  border-top: 0;
  content: '';
  position: absolute;
  right: -13px;
  top: 5px;
  height: 6px;
  width: 6px;
  z-index: 1;
  zoom: 1;
}
/*
 * Custom styles
 */
.btn {
  background-color: #dbdbdb;
  border-color: #bbb;
  color: #666;
}
.btn:hover,
.btn.active {
  text-shadow: 0 1px 0 #b12f27;
  background-color: #373757;
  border-color: #000;
}
.btn:active { box-shadow: 0 0 5px 3px rgba(0,0,0,0.2) inset; }
.btn span { color: #373757; }
.btn:hover, .btn:hover span,
.btn.active, .btn.active span { color: #eeeeee; }
.btn:active span {
  color: #b12f27;
  text-shadow: 0 1px 0 rgba(255,255,255,0.3);
}
    </style>
    
      
      
  </head>

  <body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
      <div class="nano">
        <div class="nano-content">
          <div class="logo"><a href="index.html"><!-- <img src="assets/images/logo.png" alt="" /> --><span>Focus</span></a></div>
          <ul>
            <li class="label">Main</li>
            <li class="active"><a class="sidebar-sub-toggle"><i class="ti-home"></i> Dashboard <span class="badge badge-primary">2</span> <span class="sidebar-collapse-icon ti-angle-down"></span></a>
            </li>
            <li><a href="form-basic.html"><i class="ti-view-list-alt"></i> Friends </a></li>
            <li><a href="form-basic.html"><i class="ti-view-list-alt"></i> Sent Requests </a></li>
            <li><a href="form-basic.html"><i class="ti-view-list-alt"></i> Blocked users </a></li>
            <li class="label">Extra</li>
            <li><a class="sidebar-sub-toggle"><i class="ti-files"></i> Invoice <span class="sidebar-collapse-icon ti-angle-down"></span></a>
              <ul>
                <li><a href="invoice.html">Basic</a></li>
                <li><a href="invoice-editable.html">Editable</a></li>
              </ul>
            </li>
            <li><a class="sidebar-sub-toggle"><i class="ti-target"></i> Pages <span class="sidebar-collapse-icon ti-angle-down"></span></a>
              <ul>
                <li><a href="page-login.html">Login</a></li>
                <li><a href="page-register.html">Register</a></li>
                <li><a href="page-reset-password.html">Forgot password</a></li>
              </ul>
            </li>
            <li><a href="../documentation/index.html"><i class="ti-file"></i> Documentation</a></li>
            <li><a><i class="ti-close"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /# sidebar -->


    <div class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="float-left">
              <div class="hamburger sidebar-toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
              </div>
            </div>
            <div class="float-right">
              <ul>

                <li class="header-icon dib"><i class="ti-bell"></i>
                  <div class="drop-down">
                    <div class="dropdown-content-heading">
                      <span class="text-left">Recent Notifications</span>
                    </div>
                    <div class="dropdown-content-body">
                      <ul>
                        <li>
                          <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Mr. John</div>
                                                    <div class="notification-text">5 members joined today </div>
                                                </div>
                                            </a>
                        </li>
                        <li>
                          <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Mariam</div>
                                                    <div class="notification-text">likes a photo of you</div>
                                                </div>
                                            </a>
                        </li>
                        <li>
                          <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Tasnim</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                        </li>
                        <li>
                          <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Mr. John</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                        </li>
                        <li class="text-center">
                          <a href="#" class="more-link">See All</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </li>
                <li class="header-icon dib"><i class="ti-email"></i>
                  <div class="drop-down">
                    <div class="dropdown-content-heading">
                      <span class="text-left">2 New Messages</span>
                      <a href="email.html"><i class="ti-pencil-alt pull-right"></i></a>
                    </div>
                    <div class="dropdown-content-body">
                      <ul>
                        <li class="notification-unread">
                          <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/1.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Michael Qin</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                        </li>
                        <li class="notification-unread">
                          <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Mr. John</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                        </li>
                        <li>
                          <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/3.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Michael Qin</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                        </li>
                        <li>
                          <a href="#">
                                                <img class="pull-left m-r-10 avatar-img" src="assets/images/avatar/2.jpg" alt="" />
                                                <div class="notification-content">
                                                    <small class="notification-timestamp pull-right">02:34 PM</small>
                                                    <div class="notification-heading">Mr. John</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                        </li>
                        <li class="text-center">
                          <a href="#" class="more-link">See All</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </li>
                <li class="header-icon dib"><span class="user-avatar">John <i class="ti-angle-down f-s-10"></i></span>
                  <div class="drop-down dropdown-profile">
                    <div class="dropdown-content-heading">
                      <span class="text-left">Upgrade Now</span>
                      <p class="trial-day">30 Days Trail</p>
                    </div>
                    <div class="dropdown-content-body">
                      <ul>
                        <li><a href="#"><i class="ti-user"></i> <span>Profile</span></a></li>

                        <li><a href="#"><i class="ti-email"></i> <span>Inbox</span></a></li>
                        <li><a href="#"><i class="ti-settings"></i> <span>Setting</span></a></li>

                        <li><a href="#"><i class="ti-lock"></i> <span>Lock Screen</span></a></li>
                        <li><a href="#"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                      </ul>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /# row -->
          <section id="main-content">
              
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div class="user-profile">
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="user-photo m-b-30">
                            <img class="img-fluid" src="assets/images/user-profile.jpg" alt="" />
                          </div>
                          
                        </div>
                        <div class="col-lg-8">
                          <div class="user-profile-name">Adarsh Chaudhary</div>
                          <!--<div class="user-Location"><i class="ti-location-pin"></i> New York, New York</div>
                          <div class="user-job-title">Product Designer</div>
                          <div class="ratings">
                            <h4>Ratings</h4>
                            <div class="rating-star">
                              <span>8.9</span>
                              <i class="ti-star color-primary"></i>
                              <i class="ti-star color-primary"></i>
                              <i class="ti-star color-primary"></i>
                              <i class="ti-star color-primary"></i>
                              <i class="ti-star"></i>
                            </div>
                          </div>
                          <div class="user-send-message"><button class="btn btn-primary btn-addon" type="button"><i class="ti-email"></i>Send Message</button></div>
                          --><div class="custom-tab user-profile-tab">
                            <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active">About</li>
                            </ul>
                            <div class="tab-content">
                              <div role="tabpanel" class="tab-pane active" id="1">
                                <div class="contact-information">
                                  <div class="email-content">
                                    <span class="contact-title">Email:</span>
                                    <span class="contact-email">hello@Admin Board.com</span>
                                  </div>
                                  <div class="website-content">
                                    <span class="contact-title">Qualification:</span>
                                    <span class="contact-website">AAAAAAAAAAA</span>
                                  </div>
                                  <div class="skype-content">
                                    <span class="contact-title">Occupation:</span>
                                    <span class="contact-skype">BBBBBBBBBBBB</span>
                                  </div>
                                </div>
                                <div class="basic-information">
                                  <div class="birthday-content">
                                    <span class="contact-title">Category:</span>
                                    <span class="birth-date">Aspirant</span>
                                  </div>
                                  <div class="gender-content">
                                    <span class="contact-title">Gender:</span>
                                    <span class="gender">Male</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>    
              <div class="col-sm-12 float-left">
                                <div class="card" >
                                    <div class="card-title" align="center">
                                        <h4>Your Recent Posts </h4>
                                    </div>
                                    <div class="card-body" >
                                        <!--
                                        <div data-spy="scroll" data-target="#scrollNav" data-offset="0">-->
                                            <!--<div id="morris-bar-chart"></div>
                                            -->
                                    <div id="feeder">
                                        <div class="facebook-box">
    <div class="content">
      <div class="row header">
        <div class="avatar">
          <img src="http://placehold.it/40x40" alt="" />
        </div>
        <div class="name">
          <h5><a href="http://khoipro.com" target="_blank">Adarsh</a></h5>
          <span class="sub">10 October 2015 at 15:00</span>
        </div>
      </div>
      <div class="row text">
Sed tristique dapibus velit. Sed at mauris porttitor, aliquam erat eu, mollis quam. Morbi sit amet dignissim turpis. Proin sed dui nisl. Quisque lorem risus, cursus eget metus nec, lobortis varius massa.
      </div>
  </div>
  <div class="footer">
    <div class="row text" style="margin: 0;">
        <div class="col-lg-6">
            <a href="#" title="Applaud" class="btn btn-counter" data-count="5"><span><i class="fa fa-thumbs-up"></i></span> Appreciate</a>
        </div>
        <div class="col-lg-6">
            <div class="float-right">
                <a href="#" title="Love it" class="btn btn-counter" data-count="5"><span><i class="fa fa-comment"></i></span> Comment</a>
            </div>
        </div>
        <div class="col-lg-12" style="border-top: 1px solid #000">
        </div>
    </div>
      <div class="small-avatar">
        <img src="http://placehold.it/32x32" alt="" />
      </div>
      <div class="write-comment">
        <input type="text" placeholder="Write your comment...">
      </div>
    </div>
  </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <!--delete-->
                    </section>
                </div>
            </div>
      
      
<script>
/* 
 * Love button for Design it & Code it
 * http://designitcodeit.com/i/9
 */
$('.btn-counter').on('click', function(event, count) {
  event.preventDefault();
  
  var $this = $(this),
      count = $this.attr('data-count'),
      active = $this.hasClass('active'),
      multiple = $this.hasClass('multiple-count');
  
  $.fn.noop = $.noop;
  $this.attr('data-count', ! active || multiple ? ++count : --count  )[multiple ? 'noop' : 'toggleClass']('active');
  
});
    
    
    var yourArrayOfDivElements = $("#feeder div"); 
for (var i=0; i< yourArrayOfDivElements.length; i++)
 {
    
 }
    
</script>
      
      
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js">
      

    </script>
    <!-- bootstrap -->

    <script src="assets/js/scripts.js"></script>
    <!-- scripit init-->





  </body>

</html>
