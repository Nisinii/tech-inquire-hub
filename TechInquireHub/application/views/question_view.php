<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question View</title>

	<!-- Include external stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/question.css'); ?>">

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
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        &nbsp Add Question
                    </button>
                </div>
            </div>
            
            <div class="app-content">
                <?php $activeLink = 'question';?>
                <?php include('includes/sidebar.php'); ?>
                
                <div class="projects-section">
                    <div class="project-boxes jsGridView">
                        <div class="project-box-wrapper">
                            <div class="projects-section-line">
                                <p><?php echo $question['title']; ?></p>

                                <?php
                                // Get the actual user ID from your session
                                $user_id = $this->session->userdata('user_id');

                                // Assume you have a $question array with question details
                                $question_id = $question['question_id'];

                                $is_saved = $this->SavedQuestions_model->is_question_saved($user_id, $question_id);
        

                                if ($is_saved) {
                                    $url = site_url('savedQuestions/unsave/' . $question['question_id']);
                                    $path = '<path fill="currentColor" d="M20.496 5.627A2.25 2.25 0 0 1 22 7.75v10A4.25 4.25 0 0 1 17.75 22h-10a2.25 2.25 0 0 1-2.123-1.504l2.097.004H17.75a2.75 2.75 0 0 0 2.75-2.75v-10l-.004-.051zM17.246 2a2.25 2.25 0 0 1 2.25 2.25v12.997a2.25 2.25 0 0 1-2.25 2.25H4.25A2.25 2.25 0 0 1 2 17.247V4.25A2.25 2.25 0 0 1 4.25 2zM10.75 6.75a.75.75 0 0 0-.743.648L10 7.5V10H7.5a.75.75 0 0 0-.102 1.493l.102.007H10V14a.75.75 0 0 0 1.493.102L11.5 14v-2.5H14a.75.75 0 0 0 .102-1.493L14 10h-2.5V7.5a.75.75 0 0 0-.75-.75" />';
                                } else {
                                    $url = site_url('savedQuestions/save/' . $question['question_id']);
                                    $path = '<path fill="currentColor" d="M20.496 5.627A2.25 2.25 0 0 1 22 7.75v10A4.25 4.25 0 0 1 17.75 22h-10a2.25 2.25 0 0 1-2.123-1.504l2.097.004H17.75a2.75 2.75 0 0 0 2.75-2.75v-10l-.004-.051zM17.246 2a2.25 2.25 0 0 1 2.25 2.25v12.997a2.25 2.25 0 0 1-2.25 2.25H4.25A2.25 2.25 0 0 1 2 17.247V4.25A2.25 2.25 0 0 1 4.25 2zm0 1.5H4.25a.75.75 0 0 0-.75.75v12.997c0 .414.336.75.75.75h12.997a.75.75 0 0 0 .75-.75V4.25a.75.75 0 0 0-.75-.75M10.75 6.75a.75.75 0 0 1 .75.75V10H14a.75.75 0 0 1 0 1.5h-2.5V14a.75.75 0 0 1-1.5 0v-2.5H7.5a.75.75 0 0 1 0-1.5H10V7.5a.75.75 0 0 1 .75-.75" />';
                                }
                                ?>

                                <a href="<?php echo $url; ?>" title="<?= $is_saved ? 'Unsave' : 'Save' ?> question" class="save-question">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <?php echo $path; ?>
                                    </svg>
                                </a>
                            </div>

                            <div class="box-content-details">
                                <span>Asked by <strong><?php echo $question['user_name']; ?></strong> on <strong><?php echo $question['created_at']; ?></strong></span>
                                <span id="voteCount"><strong><?php echo $question['upvotes'] + $question['downvotes']; ?></strong> votes</span> 
                                <span id="answerCount"><strong><?php echo $question['answer_count']; ?></strong> answers </span>
                            </div>
                            <div class="content">
                                <?php
                                    // Decode HTML entities and apply special styling to text inside <code> and <blockquote> tags
                                    $decodedContent = htmlspecialchars_decode($question['content']);
                                    $decodedContent = preg_replace_callback(
                                        '/<code>(.*?)<\/code>|<blockquote>(.*?)<\/blockquote>/s',
                                        function ($matches) {
                                            // Apply the desired styling to text inside <code> and <blockquote> tags
                                            if (!empty($matches[1])) {
                                                // Handle <code> tags
                                                return '<code class="code">' . $matches[1] . '</code>';
                                            } elseif (!empty($matches[2])) {
                                                // Handle <blockquote> tags
                                                return '<blockquote style="border-left: 4px solid #c8ccd0; padding-left: 10px; margin-top: 10px; margin-bottom: 10px;">' . $matches[2] . '</blockquote>';
                                            }
                                        },
                                        $decodedContent
                                    );
                                    ?>
                                    <p><?php echo $decodedContent; ?></p>
                            </div>
                            <?php if (!empty($question['image'])): ?>
                                <img src="<?php echo base_url($question['image']); ?>" alt="Question Image" class="question-image" />
                            <?php endif; ?>
                            <div class="project-tags">
                                <?php foreach ($question['tags'] as $tag): ?>
                                    <span class="tag"><?php echo $tag; ?></span>
                                <?php endforeach; ?>
                            </div>
        
                            <div class="answer-content">
                                <!-- Display Answers -->
                                <h3><?php echo $question['answer_count']; ?> Answers:</h3>
                                
                                    <div class="answer-header">
                                        <?php foreach ($answers as $answer): ?>
                                            <div class="box-content-details-answer">
                                                <span id="voteCount"><strong><?php echo $answer['upvotes'] + $answer['downvotes']; ?></strong> Total votes</span> 
                                                <span id="voteCount"><strong><?php echo $answer['upvotes']?></strong> Upvotes</span> 
                                                <span id="voteCount"><strong><?php echo $answer['downvotes']; ?></strong> Downvotes</span> 
                                            </div>
                                            <div class="answer">
                                                <?php
                                                // Decode HTML entities and apply special styling to text inside <code> and <blockquote> tags
                                                $decodedContent = htmlspecialchars_decode($answer['content']);
                                                $decodedContent = preg_replace_callback(
                                                    '/<code>(.*?)<\/code>|<blockquote>(.*?)<\/blockquote>/s',
                                                    function ($matches) {
                                                        // Apply the desired styling to text inside <code> and <blockquote> tags
                                                        if (!empty($matches[1])) {
                                                            // Handle <code> tags
                                                            return '<code class="code">' . $matches[1] . '</code>';
                                                        } elseif (!empty($matches[2])) {
                                                            // Handle <blockquote> tags
                                                            return '<blockquote style="border-left: 4px solid #c8ccd0; padding-left: 10px; margin-top: 10px; margin-bottom: 10px;">' . $matches[2] . '</blockquote>';
                                                        }
                                                    },
                                                    $decodedContent
                                                );
                                                ?>
                                                <p><?php echo $decodedContent; ?></p>

                                                <?php if (!empty($answer['image'])): ?>
                                                    <img src="<?php echo base_url($answer['image']); ?>" alt="Answer Image" class="answer-image" />
                                                <?php endif; ?>

                                                <!-- Upvote button -->
                                                <a class="vote-button upvote <?php echo ($answer['vote_type'] == 'upvote') ? 'voted' : ''; ?>" href="<?php echo site_url('question/upvote_answer/' . $answer['answer_id'] . '/' . $answer['question_id']); ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
                                                        <path fill="currentColor" d="M8.834.066c.763.087 1.5.295 2.01.884c.505.581.656 1.378.656 2.3c0 .467-.087 1.119-.157 1.637L11.328 5h1.422c.603 0 1.174.085 1.668.333c.508.254.911.679 1.137 1.2c.453.998.438 2.447.188 4.316l-.04.306c-.105.79-.195 1.473-.313 2.033c-.131.63-.315 1.209-.668 1.672C13.97 15.847 12.706 16 11 16c-1.848 0-3.234-.333-4.388-.653c-.165-.045-.323-.09-.475-.133c-.658-.186-1.2-.34-1.725-.415A1.75 1.75 0 0 1 2.75 16h-1A1.75 1.75 0 0 1 0 14.25v-7.5C0 5.784.784 5 1.75 5h1a1.75 1.75 0 0 1 1.514.872c.258-.105.59-.268.918-.508C5.853 4.874 6.5 4.079 6.5 2.75v-.5c0-1.202.994-2.337 2.334-2.184M4.5 13.3c.705.088 1.39.284 2.072.478l.441.125c1.096.305 2.334.598 3.987.598c1.794 0 2.28-.223 2.528-.549c.147-.193.276-.505.394-1.07c.105-.502.188-1.124.295-1.93l.04-.3c.25-1.882.189-2.933-.068-3.497a.921.921 0 0 0-.442-.48c-.208-.104-.52-.174-.997-.174H11c-.686 0-1.295-.577-1.206-1.336c.023-.192.05-.39.076-.586c.065-.488.13-.97.13-1.328c0-.809-.144-1.15-.288-1.316c-.137-.158-.402-.304-1.048-.378C8.357 1.521 8 1.793 8 2.25v.5c0 1.922-.978 3.128-1.933 3.825a5.831 5.831 0 0 1-1.567.81ZM2.75 6.5h-1a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25v-7.5a.25.25 0 0 0-.25-.25" />
                                                    </svg>
                                                </a>

                                                <!-- Downvote button -->
                                                <a class="vote-button downvote <?php echo ($answer['vote_type'] == 'downvote') ? 'voted' : ''; ?>" href="<?php echo site_url('question/downvote_answer/' . $answer['answer_id'] . '/' . $answer['question_id']); ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
                                                        <path fill="currentColor" d="M7.083 15.986c-.763-.087-1.499-.295-2.011-.884c-.504-.581-.655-1.378-.655-2.299c0-.468.087-1.12.157-1.638l.015-.112H3.167c-.603 0-1.174-.086-1.669-.334a2.415 2.415 0 0 1-1.136-1.2c-.454-.998-.438-2.447-.188-4.316l.04-.306C.32 4.108.41 3.424.526 2.864c.132-.63.316-1.209.669-1.672C1.947.205 3.211.053 4.917.053c1.848 0 3.234.332 4.388.652l.474.133c.658.187 1.201.341 1.726.415a1.75 1.75 0 0 1 1.662-1.2h1c.966 0 1.75.784 1.75 1.75v7.5a1.75 1.75 0 0 1-1.75 1.75h-1a1.75 1.75 0 0 1-1.514-.872c-.259.105-.59.268-.919.508c-.671.491-1.317 1.285-1.317 2.614v.5c0 1.201-.994 2.336-2.334 2.183m4.334-13.232c-.706-.089-1.39-.284-2.072-.479l-.441-.125c-1.096-.304-2.335-.597-3.987-.597c-1.794 0-2.28.222-2.529.548c-.147.193-.275.505-.393 1.07c-.105.502-.188 1.124-.295 1.93l-.04.3c-.25 1.882-.19 2.933.067 3.497a.923.923 0 0 0 .443.48c.208.104.52.175.997.175h1.75c.685 0 1.295.577 1.205 1.335c-.022.192-.049.39-.075.586c-.066.488-.13.97-.13 1.329c0 .808.144 1.15.288 1.316c.137.157.401.303 1.048.377c.307.035.664-.237.664-.693v-.5c0-1.922.978-3.127 1.932-3.825a5.878 5.878 0 0 1 1.568-.809Zm1.75 6.798h1a.25.25 0 0 0 .25-.25v-7.5a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25" />
                                                    </svg>
                                                </a>
                                                <div class="box-content-details">
                                                    <span>Answered by <strong><?php echo $answer['username']; ?></strong> on <strong><?php echo $answer['created_at']; ?></strong></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                

                                <!-- Form for Submitting Answers -->
                                <form id="answerForm">
                                    <div class="form-group">
                                        <label for="answer_content">Your Answer:</label>
                                        <p class="form-info">Know someone who can answer? Share a link to this question via email, Twitter, or Facebook.</p>
                                        <?php include('includes/editor.php'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Upload Image</label></br>
                                        <p class="form-info">Upload an image related to your question.</p>
                                        <input type="file" id="image" name="image" class="file-input">
                                        <label for="image" class="file-input-label">Choose a file</label>
                                        <span class="file-name">No file chosen</span>
                                    </div>
                                    <div class="btn-container">
                                        <button type="submit" class="btn btn-primary">Post your answer</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="project-box-wrapper">
                            <div class="project-box">
                                <p class="project-box-title">Most Voted Questions</p>
                                <?php foreach ($questions as $question): ?>
                                    <div class="box-content-subheader">
                                        <a href="<?php echo site_url('question/view/' . $question['question_id']); ?>" class="questions-link">
                                                <div class="questions-img">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24">
                                                        <path fill="#000" d="M20 17.17L18.83 16H4V4h16zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2" />
                                                    </svg>
                                                </div>
                                                <p class="questions-title"><?php echo ($question['title']); ?>
                                            </p>
                                        </a>									
                                    </div>
                                <?php endforeach; ?>
                            </div>
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
		var questionId = <?php echo json_encode($question_id); ?>;

        var AnswerModel = Backbone.Model.extend({
            defaults: {
                answer_content: '',
                image: ''
            }
        });

        var AnswerView = Backbone.View.extend({
            el: "#answerForm",
            events: {
                'submit': 'saveAnswer'
            },

            initialize: function(){
                this.model = new AnswerModel();
            },

            saveAnswer: function(event){
                event.preventDefault();

				// Extract content from the editor div
				var editorContent = document.getElementById('editor').innerHTML.trim();

                this.model.set({
                    answer_content: editorContent,
                    image: this.$('#image')[0].files[0]
                });

                var formData = new FormData();
                formData.append('answer_content', this.model.get('answer_content'));
                formData.append('image', this.model.get('image'));

                $.ajax({
                    url: 'http://localhost/advanced-server-side-cw/coursework/index.php/api/QuestionApi/save_answer/' + questionId,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Answer saved successfully');
                        window.location.href = 'http://localhost/advanced-server-side-cw/coursework/index.php/question/view/'  + questionId;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving answer:', error);
                    }
                });
            }
        });

        var answerView = new AnswerView();
    </script>

</body>
</html>
