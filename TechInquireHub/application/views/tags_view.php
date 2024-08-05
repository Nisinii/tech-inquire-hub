<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags</title>

	<!-- External Stylesheets -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/tag.css'); ?>">

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
			<?php $activeLink = 'tag';?>
            <?php include('includes/sidebar.php'); ?>
			
			<div class="projects-section">
                <div class="projects-section-line">
                    <p>TAGS</p>
                </div>

                <div class="project-boxes jsGridView">
					<div class="project-tags">
						<?php foreach ($tags as $tag): ?>
							<a class="tag-link" href="<?php echo site_url('tag/view_questions_by_tag/' . $tag['tag_id']); ?>">
								<span class="tag"><?php echo $tag['tag_name']; ?></span>
							</a>
						<?php endforeach; ?>
					</div>
                </div>
            </div>

        </div>
    </div>

	<!-- Include external JavaScript file -->
	<script src="<?php echo base_url('assets/js/mode-editor.js'); ?>"></script>

</body>
</html>