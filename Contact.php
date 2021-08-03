<html>
<head>
    <?php include('Shared/Link.php'); ?>
    <?php include('FrameWork/UserInfo.php'); ?>
</head>
<body class="container-fluid">
    <?php include('Shared/Menu.php'); ?>
    <div style="min-height: 600px">
        <br/>
        <h2>Contact</h2>

        <?php
            $u = UserInfo::GetUser();
            echo $u->FirstName." ".$u->LastName;
        ?>
    </div>
    <?php include('Shared/Footer.php'); ?>
</body>
<script>

    $(document).ready(function () {

        $('#conMenu').addClass('active');

    });

</script>
</html>