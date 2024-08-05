<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <!-- Include external stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/edit-profile.css'); ?>">

</head>
<body>
    <div class="app-container">
        <div class="app-header">
            <div class="app-header-left">
                <span class="app-icon"></span>
                <p class="app-name">TechInquireHub</p>
            </div>
            <div class="app-header-right">
                <button class="mode-switch" title="Switch theme">
                    <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                        <defs></defs>
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                </button>
                <button class="add-btn" title="Add new question"
                    onclick="window.location.href='<?php echo site_url('dashboard/add_question'); ?>'">
                    <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-plus">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    &nbsp;Add Question
                </button>
            </div>
        </div>

        <div class="app-content">
            <?php $activeLink = 'edit-profile'; ?>
            <?php include('includes/sidebar.php'); ?>

            <div class="projects-section">
                <div class="projects-section-line">
                    <p>EDIT PROFILE</p>
                </div>
                <div class="project-boxes jsGridView">
                    <div class="project-box-wrapper">
                        <form id="editProfileForm">
                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <p class="form-info">This will be the name that is displayed when you post a question or an
                                    answer</p>
                                <input type="text" id="display_name" name="display_name" class="form-control"
                                    value="<?php echo isset($userDetails['display_name']) ? htmlspecialchars($userDetails['display_name']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <p class="form-info">This is your occupation (Example: Student or Undergraduate or
                                    Software engineer)</p>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="<?php echo isset($userDetails['title']) ? htmlspecialchars($userDetails['title']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <p class="form-info">A small description about yourself</p>
                                <textarea id="bio" name="bio" class="form-control" required rows="5">
                                    <?php echo isset($userDetails['bio']) ? htmlspecialchars($userDetails['bio']) : ''; ?>
                                </textarea>
                            </div>
                            <button type="submit" name="submitEditDetails" class="btn btn-primary">Update your profile</button>
                        </form>
                    </div>
                    <div class="project-box-wrapper">
                        <div class="project-box">
                            <p class="project-box-title">Change password</p>
                            <form id="updatePasswordForm">
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" class="form-control-password" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Create New Password</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control-password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control-password" required>
                                </div>
                                <button type="submit" name="submitNewPassword" class="btn btn-primary">Update your password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include external JavaScript file -->
    <script src="<?php echo base_url('assets/js/mode-editor.js'); ?>"></script>
    <!-- Include jQuery, Underscore.js and Backbone.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>

    <script>
        var ProfileModel = Backbone.Model.extend({
            defaults: {
                display_name: '',
                title: '',
                bio: '',
                current_password: '',
                new_password: '',
                confirm_password: ''
            }
        });

        var ProfileView = Backbone.View.extend({
            el: "#editProfileForm",
            events: {
                'submit': 'updateProfile'
            },

            initialize: function () {
                this.model = new ProfileModel();
            },

            updateProfile: function (event) {
                event.preventDefault();

                this.model.set({
                    display_name: this.$('#display_name').val(),
                    title: this.$('#title').val(),
                    bio: this.$('#bio').val()
                });

                var formData = new FormData();
                formData.append('display_name', this.model.get('display_name'));
                formData.append('title', this.model.get('title'));
                formData.append('bio', this.model.get('bio'));

                $.ajax({
                    url: 'http://localhost/advanced-server-side-cw/coursework/index.php/api/ProfileApi/update_details',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log('Profile Updated successfully');
                        window.location.href = 'http://localhost/advanced-server-side-cw/coursework/index.php/profile/index';
                    },
                    error: function (xhr, status, error) {
                        console.error('Error updating profile:', error);
                    }
                });
            }
        });

        var PasswordView = Backbone.View.extend({
            el: "#updatePasswordForm",
            events: {
                'submit': 'updatePassword'
            },

            initialize: function () {
                this.model = new ProfileModel();
            },

            updatePassword: function (event) {
                event.preventDefault();

                this.model.set({
                    current_password: this.$('#current_password').val(),
                    new_password: this.$('#new_password').val(),
                    confirm_password: this.$('#confirm_password').val()
                });

                var formData = new FormData();
                formData.append('current_password', this.model.get('current_password'));
                formData.append('new_password', this.model.get('new_password'));
                formData.append('confirm_password', this.model.get('confirm_password'));

                $.ajax({
                    url: 'http://localhost/advanced-server-side-cw/coursework/index.php/api/ProfileApi/update_password',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log('Password Updated successfully');
                        window.location.href = 'http://localhost/advanced-server-side-cw/coursework/index.php/profile/index';
                    },
                    error: function (xhr, status, error) {
                        console.error('Error updating password:', error);
                    }
                });
            }
        });

        var profileView = new ProfileView();
        var passwordView = new PasswordView();
    </script>

</body>
</html>
