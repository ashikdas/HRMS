<html>
    <head>
        <?php include('Shared/Link.php'); ?>
    </head>
    <body class="container-fluid">
        <?php include('Shared/Menu.php'); ?>
        <div class="container">
            <br/>
            <br/>
            <br/>
            <div class="jumbotron">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img style="height: 300px;width: 100%" src="Images/1.jpg" alt="1.jpg">
                            <div class="carousel-caption">
                                Image 1
                            </div>
                        </div>
                        <div class="item">
                            <img style="height: 300px;width: 100%" src="Images/2.jpg" alt="2.jpg">
                            <div class="carousel-caption">
                                Image 2
                            </div>
                        </div>
                        <div class="item">
                            <img style="height: 300px;width: 100%" src="Images/3.jpg" alt="3.jpg">
                            <div class="carousel-caption">
                                Image 3
                            </div>
                        </div>
                        <div class="item">
                            <img style="height: 300px;width: 100%" src="Images/4.jpg" alt="4.jpg">
                            <div class="carousel-caption">
                                Image 4
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
            <div class="row">
                <?php
                include('FrameWork/ClassCollection.php');
                $list = Notice::GetAll("");
                if(is_array($list))
                {
                    foreach($list as $l)
                    {
                        ?>
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo $l->Title; ?></h3>
                                </div>
                                <div class="panel-body" style="min-height: 70px">
                                    <?php echo $l->Description; ?>
                                </div>
                                <div class="panel-footer">
                                    <a href="Index.php"  class="btn btn-default btn-primary">More</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
        <?php include('Shared/Footer.php'); ?>
    </body>

    <script>

        $(document).ready(function () {

            $('.carousel').carousel({
                interval: 2000
            });

            $('#homeMenu').addClass('active');

        });

    </script>

</html>