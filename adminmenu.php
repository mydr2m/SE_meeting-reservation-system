<style>
@import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Prompt:wght@400;700&display=swap');

* {
    font-family: 'Kanit', sans-serif;
    box-sizing: border-box;
}

header {
    background-image: url('https://2.bp.blogspot.com/-ubgmkV_F1wU/W5dtBcEQU7I/AAAAAAAAIb0/6G285_Q5SGsOPHNFrggvJ1tzjN6iK4_FwCLcBGAs/s1600/5.jpg');
	background-repeat: no-repeat;
	width: 100%;
    height: 18vh;
    background-size: 100%;  
}

header .box {
    width: 100%;
    height: 18vh;
    background-color: #ebebeb52;
    display: flex;
    justify-content: center;
    align-items: center;
}

header .box h1 {
    font-weight: bolder;
    font-size: 3rem;
    text-shadow: 3px 3px 2px rgba(255, 255, 255, 0.8);
}

.navbar {
    position: sticky;
    top: 0;
    left: 0;
    width: 100%;
}
</style>

<header>
    <div class="box">
        <h1>เทศบาลนครขอนแก่น</h1>   
    </div>
</header>

<nav class="navbar navbar-expand-lg navbar-Dark" style="background-color: #ffe595;">
    <div class="container">
        <!-- Just an image -->

        <a class="navbar-brand" href="#">
            <img src="img/logo.png" width="30" height="30" alt="">
        </a>

        <a class="navbar-brand" href="calendar.php" style="color:black">ระบบจองห้องประชุม</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="calendar.php" style="color:black">
                        ปฏิทินการประชุม
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="addmeet.php" style="color:black">
                        จองห้องประชุม
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="addroom.php" style="color:black">
                        ห้องประชุม
                    </a>
                </li>
            </ul>

            <div class="ml-md-2 my-lg-0">
                <?php
                session_start();
                //check session 
                if (isset($_SESSION['user'])) {} else {
                    echo "<script>alert('คุณยังไม่ได้เข้าสู่ระบบ กลับไปยังหน้าเข้าสู่ระบบก่อน')</script>";
                    echo "<script>window.open('login.php','_self')</script>";
                }
                ?>
                <a href="logout.php" class="btn btn-danger" role="button">ออกจากระบบ</a>
            </div>
        </div>
    </div>
</nav>