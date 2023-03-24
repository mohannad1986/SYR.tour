   <!-----------------------------------------footer بداية السكشن--------------------------------------->
   <section class="footer">
       <div class="container">
           <div class="row">
               <div class="col-lg-4 col-md-6">
                   <h3>sitemap</h3>
                   <ul class="list-unstyled three-coulmns">
                       <li>home</li>
                       <li>about</li>
                       <li>login</li>
                       <li>signup</li>
                       <li>logout</li>
                       <li>sitmap</li>
                       <li>contact us</li>
                       <!-- ---------------------- -->
                       <?php foreach ($cities as $city) {
                            echo '<li><a href="#">' . $city['name'] . '</a></li>';
                        }   ?>
                       <!-- ----------------------- -->
                   </ul>
                   <!---عطيت للو ال كلاس من عندي مشان احسن نسقو ع كيفي -->
                   <ul class="list-unstyled social-list">
                       <!-- بدي جيب ايقونات من النت من موقع ابعادها 48*48icon finder   -->
                       <li> <img src="layout/img/social-bookmarks/email.png" alt="aaa"></li>
                       <li> <img src="layout/img/social-bookmarks/facebook.png" alt="aaa"></li>
                       <li> <img src="layout/img/social-bookmarks/g.png" alt="aaa"></li>
                       <li> <img src="layout/img/social-bookmarks/pin.png" alt="aaa"></li>
                       <li> <img src="layout/img/social-bookmarks/rss.png" alt="aaa"></li>
                       <li> <img src="layout/img/social-bookmarks/tw.png" alt="aaa"></li>
                   </ul>
               </div>
               <div class="col-lg-4 col-md-6">
                   <h3>Travel and tourism agencies</h3>
                   <div class="media">
                       <a class="pull-left" href="#">
                           <img class="media-object" src="layout/img/articles/4.png" alt="" />
                       </a>
                       <div class="media-body">
                           <h4 class="media-heading">
                               <a href="https://www.expediagroup.com/home/default.aspx"> Expedia Group. </a>
                           </h4>
                       </div>
                   </div>
                   <div class="media">
                       <a class="pull-left" href="#">
                           <img class="media-object" src="layout/img/articles/5.png" alt="" />
                       </a>
                       <div class="media-body">
                           <h4 class="media-heading">
                               <a href="https://www.save70.com/flights/?nl=0&campaignid=14331174132&adgroupid=131416612252&lpage=alpha&lb=skys&gclid=CjwKCAjw7--KBhAMEiwAxfpkWLPVw7vfdkmdIsojhJOr74xwaBFbRzwEi691aIi9QuC8EnEveo512hoCue4QAvD_BwE"> Flight Centre</a>
                           </h4>
                       </div>
                   </div>
                   <div class="media">
                       <a class="pull-left" href="#">
                           <img class="media-object" src="layout/img/articles/6.png" alt="" />
                       </a>
                       <div class="media-body">
                           <h4 class="media-heading">
                               <a href="https://www.bcdtravel.com/"> BCD Travel.</a>
                           </h4>
                       </div>
                   </div>
               </div>
               <div class="col-lg-4">
                   <h3> our owsem trips</h3>
                   <!--استخدمنا كلاس بوتستراب جاهز للصور اسمو ثمنيل بيعملا لصورة كانها مصغرة-->
                   <img class="img-thumbnail" src="layout/img/work/111.jpg" alt="" />
                   <img class="img-thumbnail" src="layout/img/work/222.jpg" alt="" />
                   <img class="img-thumbnail" src="layout/img/work/333.jpg" alt="" />
               </div>
           </div>
       </div>
       <!--رح اعمل هون ديف للكوبي رايت كلاس جاهز هاد وبنسقو-->
       <div class="copyright text-center">
           copy right &copy;2021 SYR<span>.tour</span>
       </div>
   </section>

   <!-------------------------------------------footer نهاية سكشن---------------------------------------->
   <!-------------------------------------------loadind بداية سكشن---------------------------------------->
   <!--بعمل سكشن بعطيه اسم من عندي-->
   <section class="loading-overlay">
       <!--في غوغل ابحث عن css3 spinner نقي سبنر -->
       <!--كل سبنر له كود قسم اتشتيمل حطو هون وقسم سي اسس-->
       <div class="spinner">
           <div class="double-bounce1"></div>
           <div class="double-bounce2"></div>
       </div>
   </section>
   <!-------------------------------------------loadind نهاية سكشن ---------------------------------------->
   <script src="layout/js/jquery-1.11.1.js"></script>
   <script src="layout/js/bootstrap.min.js"></script>
   <script src="layout/js/plugins.js"></script>
   <script src="layout/js/frontend.js"></script>
   <script src="layout/js/wow.min.js"></script>
   <script>
       new WOW().init();
   </script>
   <!--الدرس 48 : استيراد النايس سكرول-->
   <!--بعد ما استوردو هون بروح ع ملف البلوجينز بشغلو منو روح وشوف-->
   <script src="layout/js/jquery.nicescroll.min.js"></script>
   </body>

   </html>