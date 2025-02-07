<?php include "backend.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="img/recycling.png">
    <link rel="stylesheet" href="form.css">
</head>
<body>

<?php if ($ShowAlert == true): ?>
    <div class="notification-bar show">
        <div class="notification-content">
            <div class="notification-message">
                <?php echo $Alert_Content; ?>
            </div>
            <button class="close-button" aria-label="Close notification">x</button>
        </div>
    </div>
<?php endif; ?>

<div class="form">
      
      <ul class="tab-group">
        <li class="tab"><a href="#">Log In</a></li>
      </ul>
      
      <div class="tab-content">

          <div id="login">   
              <h1>Welcome Back!</h1>
              
              <form action="" method="post">
              
                    <div class="field-wrap">
                    <label>
                    Username<span class="req">*</span>
                    </label>
                    <input type="text"required name="username" autocomplete="off"/>
                </div>
                
                <div class="field-wrap">
                    <label>
                    Password<span class="req">*</span>
                    </label>
                    <input type="password"required name="password" autocomplete="off"/>
                </div>
                
                <button class="button button-block" name="login_data">Log In</button>
                
              </form>

          </div>
            
        
      </div>
      
</div> 
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

document.addEventListener('DOMContentLoaded', () => {
            const notificationBar = document.querySelector('.notification-bar');
            const closeButton = document.querySelector('.close-button');
            let isNotificationClosed = false;
            closeButton.addEventListener('click', () => {
                notificationBar.classList.remove('show');
                isNotificationClosed = true;
            });
        });
</script>