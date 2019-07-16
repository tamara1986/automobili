<!DOCTYPE html>
<html>
    <head>
        <title>Sign in</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
        
    </head>
    <body>
        <div class="wrapper flex">
            <div class="form-wrap flex">
                <form class="form1 flex" method="POST">
                    <h1 class="form-headline">Sign in</h1>
                    <input type="text" id="username" placeholder="Username*">
                    <small id="usernameErr"></small>
                    <input type="password" id="password" placeholder="Password*">
                    <small id="passwordErr"></small>
                    <input type="button" class="sub-btn" value="Login!" id="login">
                </form>
            </div>
  
        </div>
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> 
	    <script type="text/javascript" src="<?php echo URLROOT; ?>/js/main.js"></script>
    </body>
</html>