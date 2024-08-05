<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

	<!-- External Stylesheets -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/profile-view.css'); ?>">

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
			<?php $activeLink = 'profile';?>
            <?php include('includes/sidebar.php'); ?>
			
			<div class="projects-section">
                <div class="projects-section-line">
                    <p>PROFILE</p>
                </div>

                <div class="navigation-bar">
                    <p id="userDetails" class="tab active" onclick="showTab('userDetails')">User Details</p>
                    <p id="questionsTab" class="tab" onclick="showTab('questions')">Questions Posted</p>
                    <p id="answersTab" class="tab" onclick="showTab('answers')">Answers Posted</p>
                </div>

                <div id="userDetails" class="tab-content active">
                    
					<div class="project-boxes jsGridView">
						<div class="project-box-wrapper">
							<div class="profile">
								<p>Username</p>
								<input type="text" class="form-control" readonly value='<?php echo $user['username']; ?>'>

								<p>Email Address</p>
								<input type="text" class="form-control" readonly value='<?php echo $user['email']; ?>'>

								<p>Account Created on</p>
								<input type="text" class="form-control" readonly value='<?php echo $user['created_at']; ?>'>

							</div>
						</div>
						<div class="project-box-wrapper">
							<div class="profile">
								<p>Display Name</p>
								<input type="text" class="form-control" readonly value='<?php echo $user['display_name']; ?>'>

								<p>Title</p>
								<input type="text" class="form-control" readonly value='<?php echo $user['title']; ?>'>

								<p>Bio</p>
								<textarea class="form-control" rows="5" readonly><?php echo $user['bio']; ?></textarea>

								<button class="btn btn-primary"><a href="<?php echo site_url('profile/editDetails/')?>">Edit User Details</a></button>
							</div>
						</div>
					</div>
                </div>


                <div id="questions" class="tab-content">
                    <ul>
                        <?php foreach ($questions as $question): ?>
                            <li>
                                <b><?php echo $question['title']; ?></b></br>
								<div class="content">
									<?php echo $question['content']; ?></b>
								</div>	
								<div class="questions">
                                	<button class="btn btn-primary"><a href="<?php echo site_url('profile/editQuestion/' . $question['question_id']); ?>">Edit</a></button>
									<button class="btn btn-primary"><a href="<?php echo site_url('profile/deleteQuestion/' . $question['question_id']); ?>">Delete</a></button>
								</div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div id="answers" class="tab-content">
                    <ul>
                        <?php foreach ($answers as $answer): ?>
                            <li>
								<div class="content">
									<?php echo $answer['content']; ?></b>
								</div>
								<div class="answers">
                                	<button class="btn btn-primary"><a href="<?php echo site_url('profile/editAnswer/' . $answer['answer_id']); ?>">Edit</a></button>
									<button class="btn btn-primary"><a href="<?php echo site_url('profile/deleteAnswer/' . $answer['answer_id']); ?>">Delete</a></button>
								</div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                   
            </div>
        </div>
    </div>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const tabs = document.querySelectorAll('.tab');
			const tabContents = document.querySelectorAll('.tab-content');

			tabs.forEach((tab, index) => {
				tab.addEventListener('click', () => {
					tabs.forEach(t => t.classList.remove('active'));
					tabContents.forEach(tc => tc.classList.remove('active'));

					tab.classList.add('active');
					tabContents[index].classList.add('active');

					if (tab.id === 'editUserDetails') {
						editDetails();
					}
				});
			});
		});
	</script>

	<!-- Include external JavaScript file -->
	<script src="<?php echo base_url('assets/js/mode-editor.js'); ?>"></script>

</body>
</html>