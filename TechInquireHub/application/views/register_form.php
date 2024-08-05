<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Registration</title>

    <!-- External Stylesheets -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/auth.css'); ?>">

</head>
<body>
    <div class="card">
        <h2>User Registration</h2>
        <?php echo validation_errors(); ?>
        <div id="message" style="display: none; color: green;">User Successfully Registered!</div>
        <form id="registerForm">
            <div class="form-group">
                <input type="text" class="form-style" id="username" name="username" placeholder="Username" required>
                <i class="input-icon uil uil-user"></i>
            </div>
            <div class="input-group">
                <input type="password" class="form-style"  id="password" name="password" placeholder="Password" required>
                <i class="input-icon uil uil-lock-alt"></i>
            </div>
            <div class="input-group">
                <input type="email" class="form-style" id="email" name="email" placeholder="Email" required>
                <i class="input-icon uil uil-at"></i>
            </div>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href='http://localhost/advanced-server-side-cw/coursework/index.php/Auth/login'>Login Here</a></p>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>

    <script>
        var UserModel = Backbone.Model.extend({
            defaults: {
                username: '',
                password: '',
                email: ''
            }
        });

        var UserView = Backbone.View.extend({
            el: "#registerForm",
            events: {
                'submit': 'saveUser'
            },

            initialize: function(){
                this.model = new UserModel();
            },

            saveUser: function(event){
                event.preventDefault();

                this.model.set(
                    {username: this.$('#username').val(), 
                    password: this.$('#password').val(),
                    email: this.$('#email').val()}
                );

                // Send data to the server using ajax
                $.ajax({
                    url: 'http://localhost/advanced-server-side-cw/coursework/index.php/api/AuthApi/register',
                    type: 'POST',
                    data: this.model.toJSON(),
                    xhrFields: {
                        withCredentials: true
                    },

                    success: function(response) {
                        console.log('Request successful');
                        window.location.href = 'http://localhost/advanced-server-side-cw/coursework/index.php/auth/login';
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving data:', error);
                        var message = 'Registration failed! Check validation';
                        $('#message').text(message).css('color', 'red').show();
                    }
                });
            }
        });

        var UserView = new UserView();
    </script>

</body>
</html>
