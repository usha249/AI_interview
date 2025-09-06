-- AI Interview Tool schema
CREATE DATABASE IF NOT EXISTS ai_interview CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ai_interview;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(150) NOT NULL UNIQUE,
  email VARCHAR(255),
  password VARCHAR(255) NOT NULL,
  role ENUM('candidate','recruiter','admin') DEFAULT 'candidate',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question_text TEXT NOT NULL,
  difficulty VARCHAR(50) DEFAULT 'medium',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS interviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  finished_at TIMESTAMP NULL,
  score INT DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS answers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  interview_id INT,
  user_id INT,
  question_id INT,
  answer_text TEXT,
  score INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (interview_id) REFERENCES interviews(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample questions
INSERT INTO questions (question_text, difficulty) VALUES
('Explain the difference between HTTP and HTTPS.' , 'easy'),
('What is a primary key in a database and why is it important?' , 'easy'),
('Describe the concept of normalization in relational databases.' , 'medium'),
('Explain how a TCP three-way handshake works.' , 'medium'),
('What is object-oriented programming and name its main principles?' , 'easy'),
('How does garbage collection work in managed languages like Java?' , 'hard'),
('Describe a RESTful API and its constraints.' , 'medium'),
('What is a race condition and how can it be prevented?' , 'hard'),
('Explain how indexing in databases improves query performance.' , 'medium'),
('What are web security threats like SQL injection and XSS?' , 'medium');
