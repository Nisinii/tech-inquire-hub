-- Users Table
CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    display_name VARCHAR(255) NOT NULL,
    bio VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL
);

-- Tags Table
CREATE TABLE IF NOT EXISTS tags (
    tag_id INT PRIMARY KEY AUTO_INCREMENT,
    tag_name VARCHAR(255) NOT NULL
);

-- Questions Table with Tags Relationship
CREATE TABLE IF NOT EXISTS questions (
    question_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Questions-Tags Relationship Table
CREATE TABLE IF NOT EXISTS question_tags (
    question_id INT,
    tag_id INT,
    PRIMARY KEY (question_id, tag_id),
    FOREIGN KEY (question_id) REFERENCES questions(question_id),
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id)
);
-- Answers Table
CREATE TABLE IF NOT EXISTS answers (
    answer_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    question_id INT,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (question_id) REFERENCES questions(question_id)
);

-- Votes Table (for upvotes and downvotes)
CREATE TABLE IF NOT EXISTS votes (
    vote_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    answer_id INT,
    question_id INT,
    vote_type ENUM('upvote', 'downvote') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (answer_id) REFERENCES answers(answer_id),
    FOREIGN KEY (question_id) REFERENCES questions(question_id)
);

-- Saved Questions Table
CREATE TABLE IF NOT EXISTS saved_questions (
    user_id INT,
    question_id INT,
    PRIMARY KEY (user_id, question_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (question_id) REFERENCES questions(question_id)
);

-- Modify questions and answers Tables to add image column
ALTER TABLE questions ADD COLUMN image VARCHAR(255);
ALTER TABLE answers ADD COLUMN image VARCHAR(255);
