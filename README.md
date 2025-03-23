# Online Exam Portal

## Overview

Online Exam Portal is a Laravel-based web application designed to manage and deliver online exams. The portal supports multiple user roles including lecturers and students. Lecturers can create and manage classes, subjects, and exam questions (both multiple-choice and open-answer). Students can take exams, view their results, and access a real-time exam timer that persists even if the page is refreshed.

## Features

- **User Roles:**  
  - **Lecturer:** Create/manage classes and subjects, assign multiple-choice or open-answer exam questions, and view exam results.  
  - **Student:** View assigned classes, take exams (with a countdown timer that auto-submits when time runs out), and review exam results.

- **Exam Management:**  
  - Supports both multiple-choice and open-answer questions.
  - Real-time countdown timer implemented with JavaScript and localStorage.
  - Auto-submit feature when time expires.
  - Basic grading system (grades A-F based on percentage score).

- **Result Tracking:**  
  - Records student exam results, including score, grade, and exam date.
  - Students can view their historical exam results.

- **Styling:**  
  - Uses [Tailwind CSS](https://tailwindcss.com) for rapid UI prototyping in some components.
  - Custom CSS is also used for specific pages (e.g., exam timer and student dashboard) to achieve a unique look and persistent layout.

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/AzimAmiziee/online-exam-portal.git
   cd online-exam-portal
