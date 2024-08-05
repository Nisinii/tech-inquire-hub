<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Questions</title>

    <!-- External Stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all-question.css'); ?>">

</head>
<body>
    <div class="app-container">
        <div class="app-header">
            <div class="app-header-left">
                <span class="app-icon"></span>
                <p class="app-name">TechInquireHub</p>
                <div class="search-wrapper">
                    <form action="<?php echo site_url('dashboard/search'); ?>" method="post" id="searchForm">
                        <input class="search-input" type="text" name="keyword" placeholder="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-search" viewBox="0 0 24 24" onclick="submitSearch()">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="M21 21l-4.35-4.35"></path>
                        </svg>
                    </form>
                </div>
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
                    &nbsp; Add Question
                </button>
            </div>
        </div>
        
        <div class="app-content">
            <?php $activeLink = 'all-questions';?>
            <?php include('includes/sidebar.php'); ?>

            <div class="projects-section">
                <div class="projects-section-line">
                    <p>ALL QUESTIONS</p>
                    <div class="pagination-container">
                        <button class="pagination-btn" id="prevPageBtn">Back</button>
                        <span class="page-number">Page <span id="currentPage">1</span></span>
                        <button class="pagination-btn" id="nextPageBtn">Next</button>
                    </div>
                </div>

                <div class="project-boxes jsGridView">
                    <?php foreach ($questions as $question): ?>
                        <div class="project-box-wrapper">
                            <div class="project-box">
                                <div class="project-box-header">
                                    <span><?php echo $question['user_name'] . " asked on " . $question['created_at']; ?></span>
                                </div>

                                <div class="project-box-content-header">
                                    <a href="<?php echo site_url('question/view/' . $question['question_id']); ?>">
                                        <p class="box-content-header"><?php echo $question['title']; ?></p>
                                    </a>
                                    <div class="box-content-details">
                                        <p><span id="voteCount"><?php echo $question['upvotes'] + $question['downvotes']; ?></span> votes</p>
                                        <p><span id="answerCount"><?php echo $question['answer_count']; ?></span> answers</p>
                                    </div>
                                </div>

                                <div class="project-box-footer">
                                    <div class="project-tags">
                                        <?php foreach ($question['tags'] as $tag): ?>
                                            <a class="tag-link" href="<?php echo site_url('tag/view_questions_by_tag/' . $tag['tag_id']); ?>">
                                                <span class="tag"><?php echo $tag['tag_name']; ?></span>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Include external JavaScript file -->
    <script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>

</body>
</html>
