<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question</title>

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
            <?php $activeLink = 'edit-question'; ?>
            <?php include('includes/sidebar.php'); ?>

            <div class="projects-section">
                <div class="projects-section-line">
                    <p>EDIT QUESTION</p>
                </div>
                <div class="project-boxes jsGridView">
                    <div class="project-box-wrapper">
                        <form id="updateForm">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <p class="form-info">Be specific and imagine you're asking a question to another person. Minimum 50 characters.</p>
                                <input type="text" id="title" name="title" class="form-control" value="<?php echo $question['title']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Content:</label>
                                <p class="form-info">Introduce the problem and expand on what you put in the title. Minimum 100 characters.</p>
                                <?php include('includes/editor.php'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Question</button>
                        </form>
                    </div>
                    <div class="project-box-wrapper">
                        <div class="project-box">
                            <p class="project-box-title">Writing a good question</p>
                            <p class="project-box-text">
                                This form will guide you through the process of asking a programming-related question, detailing the steps to ensure your query is clear and well-presented.
                            </p>
                            <p class="project-box-steps">
                                Steps:
                            </p>
                            <ul>
                                <li>Describe the problem you're facing in more detail.</li>
                                <li>Explain what steps you've already taken and what you expected to occur.</li>
                                <li>Add relevant tags to make your question easier to find for the community.</li>
                                <li>Note: Uploaded images cannot be deleted or changed.</li>
                                <li>Review your question before posting it.</li>
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
            var answerContent = '<?php echo addslashes($question["content"]); ?>';
            document.getElementById("editor").innerHTML = answerContent;
        });
    </script>
    <script src="<?php echo base_url('assets/js/mode-editor.js'); ?>"></script>

    <!-- Include jQuery, Underscore.js and Backbone.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>

    <script>
        var QuestionModel = Backbone.Model.extend({
            defaults: {
                title: '',
                question_content: ''
            }
        });

        var QuestionView = Backbone.View.extend({
            el: "#updateForm",
            events: {
                'submit': 'updateQuestion'
            },

            initialize: function(){
                this.model = new QuestionModel();
            },

            updateQuestion: function(event){
                event.preventDefault();

                // Extract content from the editor div
                var editorContent = document.getElementById('editor').innerHTML.trim();

                this.model.set({
                    title: this.$('#title').val(),
                    question_content: editorContent
                });

                var formData = new FormData();
                formData.append('title', this.model.get('title'));
                formData.append('question_content', this.model.get('question_content'));

                $.ajax({
                    url: 'http://localhost/advanced-server-side-cw/coursework/index.php/api/ProfileApi/update_question/' + <?php echo $question['question_id']; ?>,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Question updated successfully');
                        window.location.href = 'http://localhost/advanced-server-side-cw/coursework/index.php/profile/index';
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating question:', error);
                    }
                });
            }
        });

        var questionView = new QuestionView();
    </script>
</body>
</html>
