<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to Dashboard</h1>
    
    <!-- Search form -->
    <form action="<?php echo site_url('dashboard/search'); ?>" method="post">
        <input type="text" name="keyword" placeholder="Search...">
        <button type="submit">Search</button>
    </form>

    <h2>Questions:</h2>
    <ul>
        <?php foreach ($questions as $question): ?>
            <li>
                <a href="<?php echo site_url('question/view/' . $question['question_id']); ?>">
                    <h3><?php echo $question['title']; ?></h3>
                </a>
                <p><?php echo $question['content']; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Add question button -->
    <a href="<?php echo site_url('dashboard/add_question'); ?>"><button>Add Question</button></a>

</body>
</html>