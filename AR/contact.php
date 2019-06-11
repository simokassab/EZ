<!DOCTYPE html>

<html lang="ar">

<?php
include_once ('header.php');
?>



<body class="contact-pg">



    <!-- start page-wrapper -->

    <div class="page-wrapper">



        <!-- start preloader -->

        <div class="preloader">

            <div class="inner">

                <span></span>

                <span></span>

                <span></span>

                <span></span>

                <span></span>

            </div>

        </div>

        <!-- end preloader -->



        <!-- Start header -->

        <?php
        include_once ('nav.php');
        ?>

        <!-- end of header -->





        <!-- start page-title -->

        <section class="page-title">

            <div class="container">

                <div class="row">

                    <div class="col col-xs-12">

                        <h2>اتصل بنا</h2>

                    </div>

                </div> <!-- end row -->

            </div> <!-- end container -->

        </section>

        <!-- end page-title -->





        <!-- start contact-pg-content -->

        <section class="contact-pg-content section-padding">

            <div class="container">

                <div class="row">

                    <div class="col col-md-8 col-md-offset-2">

                        <div class="section-title-s3">

                            <h2>:اتصل بنا</h2>

                            <p>إذا أردت السؤال أو الاستيضاح عن أي شيء، الرجاء الاتصال بنا أو مراسلتنا. نحن متوفرون على مدار الساعة لتزويدكم بأجود وأسرع الخدمات</p>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col col-md-6">

                        <iframe class="contact-location-map"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1656.0155500026333!2d35.55415811379833!3d33.88885287277303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzPCsDUzJzIyLjIiTiAzNcKwMzMnMTcuMyJF!5e0!3m2!1sen!2slb!4v1558953557993!5m2!1sen!2slb"
                                frameborder="0" style="width: 100%; height: 450px; " allowfullscreen>

                        </iframe>

                    </div>

                    <div class="col col-md-6">

                        <div class="contact-form">

                            <form method="post" id="contact-form-s2" class="form row contact-validation-active">

                                <div class="col col-xs-12">

                                    <input type="text" class="form-control" id="name" name="name" placeholder="الاسم">

                                </div>

                                <div class="col col-xs-12">

                                    <input type="email" class="form-control" id="email" name="email" placeholder="البريد الالكتروني">

                                </div>

                                <div class="col col-xs-12">

                                    <input type="text" class="form-control" id="location" name="location" placeholder="العنوان">

                                </div>

                                <div class="col col-xs-12">

                                    <textarea class="form-control" name="message" placeholder="رسالتك"></textarea>

                                </div>

                                <div class="col col-xs-12 submit-btn">

                                    <button type="submit">ارسال</button>

                                    <div id="loader">

                                        <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>

                                    </div>

                                </div>

                                <div class="error-handling-messages">

                                <div id="success">شكرا لك</div>

<div id="error"> هناك خطأ, الرجاء المحاولة لاحقا </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div> <!-- end row -->

            </div> <!-- end container -->

        </section>

        <!-- end contact-pg-content -->









        <!-- start site-footer -->

        <?php
        include_once ('footer.php');
        ?>
        <!-- end site-footer -->

    </div>

    <!-- end of page-wrapper -->







    <!-- All JavaScript files

    ================================================== -->

    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>



    <!-- Plugins for this template -->

    <script src="assets/js/jquery-plugin-collection.js"></script>



    <!-- Google map api -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtX_Enagw1NelD07axZ6HEZEZ-Trq599I"></script>



    <!-- Custom script for this template -->

    <script src="assets/js/script.js"></script>

</body>



</html>