<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question View</title>
</head>
<body>
    <!-- Display Question Details -->
<h2><?php echo $question['title']; ?></h2>
<p><?php echo $question['content']; ?></p>

<!-- Display Answers -->
<h3>Answers:</h3>
<ul>
    <?php foreach ($answers as $answer): ?>
        <div class="answer">
            <p><?php echo $answer['content']; ?></p>

            <!-- Upvote button -->
            <a href="<?php echo site_url('question/upvote_answer/' . $answer['answer_id'] . '/' . $answer['question_id']); ?>">Upvote</a>

            <!-- Downvote button -->
            <a href="<?php echo site_url('question/downvote_answer/' . $answer['answer_id'] . '/' . $answer['question_id']); ?>">Downvote</a>

        </div>
    <?php endforeach; ?>
</ul>

<!-- Form for Submitting Answers -->
<form method="post" action="<?php echo site_url('question/submit_answer/' . $question['question_id']); ?>">
    <label for="answer_content">Your Answer:</label>
    <textarea name="answer_content" required></textarea>
    <button type="submit">Submit Answer</button>
</form>

<!-- Upvote and Downvote Buttons -->

</body>
</html>
