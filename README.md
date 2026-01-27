# TECHNICAL Q&A HUB

<img width="1330" height="823" alt="Question Posting" src="https://github.com/user-attachments/assets/a695e8a3-5f01-404d-87c1-5830afd9e763" />

> **The Collaborative Pulse of Technical Problem Solving.** > A full-stack Q&A ecosystem designed to bridge the gap between complex technical hurdles and community-driven solutions through real-time interaction and rich-text expression.

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-EE4323?style=for-the-badge&logo=codeigniter&logoColor=white)](https://codeigniter.com/)
[![Backbone.js](https://img.shields.io/badge/Backbone.js-003049?style=for-the-badge&logo=backbone.js&logoColor=white)](https://backbonejs.org/)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://www.w3.org/html/)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://www.w3schools.com/css/)

---

## The Concept

**Technical Q&A Hub** is a knowledge-sharing platform built to transform how developers troubleshoot issues. By combining a robust PHP-based backend with a dynamic Backbone.js frontend, it creates a seamless environment where users can document, categorize, and solve engineering challenges.

The platform focuses on three core pillars:
* **Rich Expression:** Utilizing a comprehensive rich text editor to make code snippets and technical documentation legible and professional.
* **Community Validation:** Implementing a democratic upvote/downvote system to ensure the highest quality solutions rise to the top.
* **Semantic Organization:** A tag-based architecture that allows for instant discovery of relevant content across different technology stacks.

<img width="1328" height="818" alt="Technical Q&A Platform" src="https://github.com/user-attachments/assets/0a8cdaae-b7bf-45ce-8a63-d74e6fc605e6" />
<img width="1324" height="823" alt="Answer Interface" src="https://github.com/user-attachments/assets/4cfe8f05-24b9-450d-8960-4d70abd5c66a" />
<img width="1324" height="819" alt="Account Management" src="https://github.com/user-attachments/assets/aab1e484-5306-4e64-a774-92ad53c68ff8" />

## Key Features

* **Advanced User Orchestration:** Secure registration and session management for personalized profiles and tracking activity.
* **Dynamic Q&A Engine:** Post deep technical queries with support for multiple tags to reach the right audience.
* **Reputation & Feedback System:** Community-driven upvoting and downvoting to validate the accuracy of technical answers.
* **Integrated Multimedia:** Direct image uploads within posts to provide visual context for debugging complex UI or architectural issues.
* **Personalized Experience:** A persistent theme toggle allowing users to switch between high-contrast light mode and a developer-centric dark mode.
* **Smart Content Discovery:** Search functionality indexed by both titles and specific tags, paired with a "trending" highlights section.

---

## How It Works

### 1. The Core Framework (PHP / CodeIgniter)
The backend acts as a high-performance RESTful API provider:
* **MVC Architecture:** Separation of concerns ensures scalable data handling for users, questions, and voting logic.
* **Secure Persistence:** Protects user credentials and maintains the relational integrity of the tag-to-question database.

### 2. The Interactive Layer (Backbone.js)
The frontend provides a Single Page Application (SPA) feel:
* **Event-Driven UI:** Synchronizes views with models in real-time for seamless upvoting and navigation without full page reloads.
* **State Management:** Handles the complexity of the rich text editor and dynamic search results.

### 3. Personalization & UX
* **Dynamic Theming:** Uses CSS variables and JavaScript to toggle the global UI atmosphere without breaking the visual hierarchy.
* **Responsive Layouts:** Built with HTML5/CSS3 to ensure technical documentation is readable across all devices.

---

## Project Structure

```bash
Technical-QA-Hub/
├── application/         # CodeIgniter Core (PHP)
│   ├── controllers/     # API Endpoints & Page Logic
│   ├── models/          # Database Interaction (Users, Questions, Tags)
│   └── views/           # Server-side Templates
├── assets/              # Frontend Resources
│   ├── js/              # Backbone.js Models, Views, and Collections
│   ├── css/             # Light/Dark mode stylesheets
│   └── images/          # Uploaded media assets
├── system/              # CodeIgniter System Files
└── index.php            # Entry Point
```

## Tech Stack

### Frontend & Interactivity
* **Backbone.js** (MV* Framework)
* **jQuery** (DOM Manipulation)
* **Underscore.js** (Templating & Utilities)
* **HTML5 & CSS3** (Responsive UI Design)

### Backend & Database
* **PHP** (Core Language)
* **CodeIgniter** (Server-side Framework)
* **MySQL** (Relational Data Storage)

### Tools & Editors
* **TinyMCE / CKEditor** (Rich Text Integration)
* **Theme Engine** (Custom JS-based Toggle)

---

## Getting Started

### 1. Clone & Prepare
```bash
git clone https://github.com/Nisinii/TechInquireHub.git
cd Technical-QA-Hub
```

## Server Requirements & Setup

### 2. Server Requirements
Ensure you have a local server environment (like **XAMPP** or **WAMP**) running with the following specifications:
* **PHP:** 7.4 or higher
* **MySQL:** 5.7 or higher
* **Apache:** `mod_rewrite` must be enabled for clean URL routing.

### 3. Database Setup
1. Open **PHPMyAdmin** in your browser.
2. Create a new database (e.g., `technical_qa`).
3. **Import** the provided `.sql` file found in the project root into your new database.
4. Update your database credentials in the following file:
   `application/config/database.php`

### 4. Configure Base URL
Update your `base_url` to match your local development path (e.g., your folder name in `htdocs` or `www`):
* File: `application/config/config.php`
* Code:
  ```php
  $config['base_url'] = 'http://localhost/Technical-QA-Hub/';
  ```
  
#### Check out the Live Demo at: https://youtu.be/FI4slRmiqko

---

## Author

**Nisini Niketha** *Software Engineer & Digital Architect*

* [GitHub](https://github.com/Nisinii)
* [LinkedIn](https://www.linkedin.com/in/nisini-niketha/)
* [Contact](mailto:wnisini.niketha@gmail.com)
