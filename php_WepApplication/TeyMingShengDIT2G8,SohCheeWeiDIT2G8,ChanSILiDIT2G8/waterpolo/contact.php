<?php


include('includes/header.php');
?>
<html>
    
    <head>
        
        <title>CSS Contact Form</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="styles.css" type="text/css" media="all"/>
        <style>
            body{
                background-image: url(web/img/gg1.jpg);
                
          }
          .contact-title{
                text-align: center;
                margin-top: 100px;
                
                text-transform: cover;
                transition: all 4s ease-in-out;
          }
          .contract-title h2{
                font-size: 32px;
                line-height: 10px;
          }
          form{
              margin-top: 50px;
              transition: all 4s ease-in-out;
             
          }
          .form-control{
              width: 600px;
              background: transparent;
              border: none;
              outline: none;
              border-bottom:1px solid gray;
              color: #333;
              font-size: 18px;
              margin-bottom: 16px;
          }
          input{
              height: 45px;
          }
          form.submit{
              background: #ff5722;
              border-color: transparent;
              color: #fff;
              font-size: 20px;
              font-weight: bold;
              letter-spacing: 2px;
              height: 50px;
              margin-top: 20px;
              
          }
          form.submit:hover{
              background-color: #f44336;
              cursor: pointer;
          }
        </style>
    </head>
<body>
    <div class="contact-title">
    <h2>Contact us</h2>
    <div class="contact-form">
    <form id="contact-form" class="form">
        <table align="center" cellpadding="5" cellspacing="0">
        <p class="name">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Teemo Bae"/>
            
        </p>
        <p class="email">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="teemo@gmail.com"/>
            
        </p>
        <p class="web">
            <label for="web">Website:</label>
            <input type="text" name="web" id="web" placeholder="www.teemoBae.com"/>
            
        </p>
        
        <p class="text">
            <textarea name="text" placeholder="Write something to us"/></textarea>
            
        </p>
        <p class="submit">
            <input type="submit" class="form-control" value="Send"/>
        </p>    
            </table>
   
        
        
           
            
    </form>
    </div>    
</body>
</div>
    <?php
include('includes/footer.php');
?>
</html>
