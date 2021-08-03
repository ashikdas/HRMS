<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="AdminIndex.php">HRMS</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                <li id="homeMenu"><a href="AdminIndex.php">Home</a></li>
                <li id="proMenu"><a href="Profile.php">Profile</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li id="logMenu"><a href="Profile.php">Welcome , <?php echo $_SESSION["UserName"] ?></a></li>
                <li id="logMenu"><a href="Logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
</nav>