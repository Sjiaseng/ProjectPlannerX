<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login - ProjectPlannerX</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
<link href="ProjectPlanerX.css" rel="stylesheet">
<link href="login.css" rel="stylesheet">
<script src="jquery-3.6.0.min.js"></script>
<script src="wb.validation.min.js"></script>
<script>   
   $(document).ready(function()
   {
      $("#login-form").submit(function(event)
      {
         var isValid = $.validate.form(this);
         return isValid;
      });
      $("#acc-email").validate(
      {
         required: true,
         bootstrap: true,
         type: 'email',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: 'Please enter a valid email address'
      });
      $("#acc-password").validate(
      {
         required: true,
         bootstrap: true,
         type: 'text',
         length_min: '1',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: 'Please enter valid password'
      });
   });
</script>
</head>
<body>
   <div id="wb_LayoutGrid1">
      <div id="LayoutGrid1">
         <div class="row">
            <div class="col-1">
            </div>
            <div class="col-2">
               <div id="wb_Image1" style="display:inline-block;width:100%;height:auto;z-index:0;">
                  <img src="image/Logo2.png" id="Image1" alt="" width="183" height="52">
               </div>
            </div>
            <div class="col-3">
            </div>
            <div class="col-4">
               <a id="nav-login" href="./login.php" style="display:inline-block;width:100px;height:50px;z-index:1;">Login</a>
            </div>
            <div class="col-5">
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid4">
      <div id="LayoutGrid4">
         <div class="row">
            <div class="col-1">
            </div>
            <div class="col-2">
               <div id="wb_login-form">
                  <form name="Login_form" method="post" action="./loginbackend.php" enctype="multipart/form-data" id="login-form">
                     <div class="row">
                        <div class="col-1">
                           <div id="wb_Text1">
                              <span style="color:#7F63F4;">Login to your Account</span><br/>
                           </div>
                           <label class="Lable-status" for="acc-email" id="lbl-email" style="display:block;width:100%;line-height:18px;z-index:16;">Email</label>
                           <div id="wb_acc-email" style="display:inline-block;width:100%;height:40px;z-index:17;">
                              <input type="text" id="acc-email"  name="acc-email" value="" autocomplete="off" spellcheck="false" placeholder="Enter your email">
                              <div class="invalid-feedback">Please enter a valid email address</div>
                           </div>
                           <hr id="HorizontalLine8" style="display:block;width:100%;z-index:18;">
                           <label class="Lable-status" for="acc-password" id="lbl-password" style="display:block;width:100%;line-height:20px;z-index:19;">Password</label>
                           <div id="wb_acc-password" style="display:inline-block;width:100%;height:45px;z-index:20;">
                              <input type="password" id="acc-password"  name="acc-password" value="" autocomplete="off" spellcheck="false" placeholder="Enter your password">
                              <div class="invalid-feedback">Please enter valid password</div>
                           </div>
                           <div id="wb_acc-pass-spgrid">
                              <div id="acc-pass-spgrid">
                                 <div class="row">
                                    <div class="col-1">
                                       <div id="wb_acc-pass-shpass" style="display:inline-block;width:326px;height:47px;z-index:13;">
                                          <label class="cbox"><input type="checkbox" onclick="showPW()">Show Password</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div id="wb_LayoutGrid3">
                              <div id="LayoutGrid3">
                                 <div class="row">
                                    <div class="col-1">
                                       <input type="submit" id="btn-login" name="" value="Login" style="display:inline-block;width:168px;height:44px;z-index:14;">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-3">
            </div>
         </div>
      </div>
   </div>
   <div id="wb_footer">
      <footer id="footer">
         <div class="row">
            <div class="col-1">
               <div id="wb_copyright">
                  <p>2023 Copyrights © ProjectPlannerX for Asia Pacific University SDP Assignment</p>
               </div>
            </div>
         </div>
      </footer>
   </div>
   <script>   
   function showPW(){var x=document.getElementById("acc-password");if(x.type==="password"){x.type="text";}else{x.type="password";}}
   </script>
</body>
</html>