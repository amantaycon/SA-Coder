<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// check if the user is already logged in
if(isset($_SESSION['server_username']))
{
    if($_SESSION['server_username'] == "yes"){
        if($_SESSION['username'] == "" && isset($_SESSION['newuser'])){ $_SESSION['username'] = $_SESSION['newuser']; ?>
        
            <html lang=en>
            <?php
            include("C:/xampp/htdocs/accounts/header.wma");
            ?>
            <body>
            <div id=main>
                <main>
                    <div id=login_bar1>
                        <div id=container>
                            <center><img src=/picture/logo.png id=logo>
                                <h1 id=logo_name>SA Coder</h1>
                            </center>
                            <center class="email_main"><span class="email_sub"><?php echo $_SESSION['email']; ?></span></center><br>
                            <div>
                                <center><lable>Enter username</lable></center>
                            <center><input type="text" class="newuser" name=newuser placeholder="Enter username" value="<?php echo $_SESSION['username']; ?>" id="username" required></center>
                            <br>
                            <center>
                            <div class="button_main">
                            <button class="next1 f_right" name=next onclick="submit()" id="finise">Finise</button></div></center></div><br><br></div>
                            <div ><ul class="flex_row" style="margin: -10 0;"><li><a class="c_orange" style="margin: 0 10px;" href="/privacy_policy" target="_blank">Privacy</a></li><li><a class="c_orange" style="margin: 0 10px;" href="/term_and_condition" target="_blank">Term</a></li></ul></div>
                            </div>
                            </main>
                            </div>
                            <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js></script>
                            <script>
                                setInterval(chackname, 500);
                                function chackname(){
                                    var input = document.getElementById("username");
                                    if(input.value != "<?php echo $_SESSION['username']; ?>"){
                                    $.post("usernamecheck",{username:input.value},function(e,n){if(e == "no"){input.style.color = "red"; document.getElementById("finise").style.display = "none";}else if(e == "yes"){input.style.color = "green"; document.getElementById("finise").style.display = "block";}
                                    });}else{input.style.color = "black"; document.getElementById("finise").style.display = "block";}
                                }
                            </script>
                            <script src="/js/profile2.js"></script>
                            </body>
                            </html>
                            
                            <?php exit; } 

        if(isset($_SESSION['url'])){
            if($_SESSION['url'] == ""){
                unset($_SESSION['url']);
            }
            else{
                $url = $_SESSION['url'];
                unset($_SESSION['url']);
                header("location: $url");
                exit;
            }
        }
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        :root {
            --orange: rgb(255, 102, 0);
            --light_orange: rgb(152, 61, 0);
            --white: white;
            --light_white: rgb(255, 236, 223);
            --black: black;
            --light_black: rgb(52 52 52);
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"  />
    <title>Profile of <?php if($_SESSION['username'] != ""){ echo $_SESSION['username'];}else{echo $_SESSION['email'];} ?> </title>
</head>
<body>
    <div class="load"></div>
    <header>
        <div id="ulogo" class="header-m">
            <div class="flex_r m-lr-5">
                <div class="center"><img class="header-lg" src=/picture/logo.png alt=""></div>
                <div class="center">
                    <a href="/"><h1 class="font-lg" style="margin: 0px 0 0 5px;"> SA Coder </h1></a>
                </div>
            </div>
            <div class="center">
                <div>
                    <img id="usernav" class="header-up" src="<?php echo $_SESSION['plink']; ?>" alt="">
                    <nav id="usernavli" class="usernav">
                        <ul class="usernavul" >
                            <li class="usernavli userd" ><?php echo $_SESSION['username']; ?></li>
                            <li class="usernavli userd" ><?php echo $_SESSION['email']; ?></li>
                            <li class="usernavli"><a href="/logout">Logout</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div>
            <div id="login_bar">
                <div id="login_bar1">
                    <div id="container"><br><br><br>
                        <div onclick="hide()" style="margin-top: -50px; float: right; cursor: pointer;"><svg
                                class="svg-icon"
                                style="width: 2em; height: 2em;vertical-align: middle;fill: currentColor;overflow: hidden;"
                                viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M810.65984 170.65984q18.3296 0 30.49472 12.16512t12.16512 30.49472q0 18.00192-12.32896 30.33088l-268.67712 268.32896 268.67712 268.32896q12.32896 12.32896 12.32896 30.33088 0 18.3296-12.16512 30.49472t-30.49472 12.16512q-18.00192 0-30.33088-12.32896l-268.32896-268.67712-268.32896 268.67712q-12.32896 12.32896-30.33088 12.32896-18.3296 0-30.49472-12.16512t-12.16512-30.49472q0-18.00192 12.32896-30.33088l268.67712-268.32896-268.67712-268.32896q-12.32896-12.32896-12.32896-30.33088 0-18.3296 12.16512-30.49472t30.49472-12.16512q18.00192 0 30.33088 12.32896l268.32896 268.67712 268.32896-268.67712q12.32896-12.32896 30.33088-12.32896z" />
                            </svg></div>
                        <center>
                            <lable style="color: var(--black);" for="bio">write your sort bio</lable>
                            <input id="bio" class="input" type="text" name="bio" value="<?php echo $_SESSION['bio']; ?>" autocomplete="off">
                        </center>
                        <center>
                            <lable style="color: var(--black);" for="fname">First name</lable>
                            <input id="fname" class="input" type="text" name="fname" value="<?php echo $_SESSION['first']; ?>">
                        </center>
                        <center>
                            <lable style="color: var(--black);" for="lname">Last name</lable>
                            <input id="lname" class="input" type="text" name="lname" value="<?php echo $_SESSION['last']; ?>" >
                        </center>

                        <center>
                            <div>
                                <button onclick="submit()" type="button" class="edit">Save</button>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: 70vh;">
                        <div class="img-container" style="height: 70vh;">
                            <div class="row" style="height: 70vh;">
                                <div class="col-md-8 scroll-color" style="height: 70vh; overflow: scroll;">  
                                    <img id="image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
            <div class="head-cp bg-white">
                <div class="cover-img shado-10c">
                    <img class="cover-img" src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80" alt="">
                </div>

                <div class="head-pro">
                    <div class="head-pro1 img-pro ml-10p">
                        <div class="head-pro1 img-pro shado-10">
                            <a href="<?php echo $_SESSION['plink']; ?>"><img class="img-pro head-pro1" src="<?php echo $_SESSION['plink']; ?>" alt=""></a>
                            <div class="center">
                                <form hidden method="post">
                                    <input id="file" type="file" name="image" class="image" accept="image/*,image/heif,image/heic">
                                </form>
                                <label for="file" class="center">
                                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                    <svg class="camera cemera-lab" fill="black" height="800px" width="800px"
                                        version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 487 487"
                                        xml:space="preserve">
                                        <g>
                                            <g>
                                                <path
                                                    d="M308.1,277.95c0,35.7-28.9,64.6-64.6,64.6s-64.6-28.9-64.6-64.6s28.9-64.6,64.6-64.6S308.1,242.25,308.1,277.95z
        M440.3,116.05c25.8,0,46.7,20.9,46.7,46.7v122.4v103.8c0,27.5-22.3,49.8-49.8,49.8H49.8c-27.5,0-49.8-22.3-49.8-49.8v-103.9
       v-122.3l0,0c0-25.8,20.9-46.7,46.7-46.7h93.4l4.4-18.6c6.7-28.8,32.4-49.2,62-49.2h74.1c29.6,0,55.3,20.4,62,49.2l4.3,18.6H440.3z
        M97.4,183.45c0-12.9-10.5-23.4-23.4-23.4c-13,0-23.5,10.5-23.5,23.4s10.5,23.4,23.4,23.4C86.9,206.95,97.4,196.45,97.4,183.45z
        M358.7,277.95c0-63.6-51.6-115.2-115.2-115.2s-115.2,51.6-115.2,115.2s51.6,115.2,115.2,115.2S358.7,341.55,358.7,277.95z" />
                                            </g>
                                        </g>
                                    </svg>
                                </label>
                            </div>
                        </div>
                    </div>

                </div><br>
                <div class="edit-b">
                    <button onclick="show()" class="edit" type="button">Edit</button>
                </div>
                <div class="ml-10p">
                    <h1 class="font-xl "><?php echo $_SESSION['first']." ".$_SESSION['last']; ?></h1>
                    <h4 class="font-x"><?php echo $_SESSION['username']; ?></h4>
                </div><br>
                <div class="center flex_c">
                    <div class="bio-h center">
                        <h3 class="fl">Bio</h3>
                    </div>
                    <div class="bio-p">
                        <p class="bio-size"><?php echo $_SESSION['bio']; ?></p>
                    </div>
                </div>

            </div><br><br><br><br><br><br><br>
        </div>
    </main>
    
    <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="/js/profile1.js"></script>
</body>
</html>
<?php
}}else{
    header("location: /accounts/");
    exit;
}
?>