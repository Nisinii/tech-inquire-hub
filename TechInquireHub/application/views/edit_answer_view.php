<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Answer</title>

    <!-- Include external stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/add-question.css'); ?>">

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
                    <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                        <defs></defs>
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                </button>
                <button class="add-btn" title="Add new question" onclick="window.location.href='<?php echo site_url('dashboard/add_question'); ?>'">
                    <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    &nbsp; Add Question
                </button>
            </div>
        </div>

        <div class="app-content">
            <?php $activeLink = 'edit-answer';?>
            <?php include('includes/sidebar.php'); ?>

            <div class="projects-section">
                <div class="projects-section-line">
                    <p>EDIT ANSWER</p>
                </div>
                <div class="project-boxes jsGridView">
                    <div class="project-box-wrapper">
                        <form id="updateForm">
                            <div class="form-group">
                                <label for="content">Content:</label>
                                <p class="form-info">Remember to be specific in your response and keep it as simple as possible.</p>
                                <?php include('includes/editor.php'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Answer</button>
                        </form>
                    </div>
                    <div class="project-box-wrapper">
                        <div class="project-box">
                            <p class="project-box-title">Writing a good answer</p>
                            <p class="project-box-text">
                                This guide will help you craft a clear and helpful answer to someone's question. If you've faced a similar issue, briefly explain how you resolved it.
                            </p>
                            <p class="project-box-steps">
                                Steps:
                            </p>
                            <ul>
                                <li>Carefully read the question to identify the main issue.</li>
                                <li>Note any keywords mentioned.</li>
                                <li>Structure your answer with a clear explanation.</li>
                                <li>Ensure your response is accurate and complete.</li>
                                <li>Review your answer before posting it.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include external JavaScript file -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var answerContent = '<?php echo addslashes($answer["content"]); ?>';
            document.getElementById("editor").innerHTML = answerContent;
        });
    </script>
    <script src="<?php echo base_url('assets/js/mode-editor.js'); ?>"></script>

    <!-- Include jQuery, Underscore.js and Backbone.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>

    <script>
        var AnswerModel = Backbone.Model.extend({
            defaults: {
                answer_content: ''
            }
        });

        var AnswerView = Backbone.View.extend({
            el: "#updateForm",
            events: {
                'submit': 'updateAnswer'
            },

            initialize: function(){
                this.model = new AnswerModel();
            },

            updateAnswer: function(event){
                event.preventDefault();

                // Extract content from the editor div
                var editorContent = document.getElementById('editor').innerHTML.trim();

                this.model.set({
                    answer_content: editorContent
                });

                var formData = new FormData();
                formData.append('answer_content', this.model.get('answer_content'));

                $.ajax({
                    url: 'http://localhost/advanced-server-side-cw/coursework/index.php/api/ProfileApi/update_answer/' + <?php echo $answer['answer_id']; ?>,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Answer updated successfully');
                        window.location.href = 'http://localhost/advanced-server-side-cw/coursework/index.php/profile/index';
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating answer:', error);
                    }
                });
            }
        });

        var answerView = new AnswerView();
    </script>

</body>
</html>
