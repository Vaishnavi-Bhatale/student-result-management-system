🎓 Student Result Management System

A role-based web application designed to manage academic results efficiently.
The system provides separate login access for Students, Teachers, and Admin, ensuring secure and controlled operations.

This project is developed as an academic and resume-level project to demonstrate backend and database management concepts.

🚀 Features

👨‍🎓 Student Module
-Secure student login
-View only own academic results
-Download result for personal use
-Subject-wise marks display

👩‍🏫 Teacher Module
-Secure teacher login
-Add and update marks for assigned subjects only
-View students enrolled under their subject

🧑‍💼 Admin Module
-Add, edit, and delete:
  -Students
  -Teachers
  -Subjects
  -Departments

-Assign:
  -Subjects to teachers
  -Students to departments

-Delete:
  -Department records
  -Individual student results
  -Student, teacher, and subject records
  -Edit all academic data when required

🔐 Role-Based Access Control
| Role    | Access                                 |
| ------- | -------------------------------------- |
| Student | View & download own result             |
| Teacher | Add / edit marks for assigned subjects |
| Admin   | Full system access                     |


🛠️ Tech Stack
-Frontend: HTML, CSS, JavaScript
-Backend: PHP
-Database: MySQL 
-Version Control: Git & GitHub

🧠 System Architecture
User (Student / Teacher / Admin)
            ↓
      Authentication
            ↓
    Role-Based Access
            ↓
      Backend Server
            ↓
        Database

📁 Project Structure
student-result-management-system/

│

├── admin_dashboard.php

├── admin_login.php

├── add_department.php

├── add_result.php

├── add_student.php
├── add_subject.php
├── add_teacher.php
├── db_connect.php
├── delete_department.php
├── delete_result.php
├── delete_student.php
├── delete_subject.php
├── delete_teacher.php
├── edit_department.php
├── edit_result.php
├── edit_student.php
├── edit_subject.php
├── edit_teacher.php
├── index.php
├── logout.php
├── student_dashboard.php
├── student_login.php
├── student_result.sql
├── teacher_dashboard.php
├── teacher_login.php
└── README.md


🗄️ Dataset Information
⚠️ Important Notice
This project uses dummy data only for demonstration and testing purposes.
No real student or institutional data is included.

🎯 Learning Outcomes
-Role-based authentication
-Database design and CRUD operations
-Backend–frontend integration
-Academic workflow implementation
-Clean project documentation

🚀 Future Enhancements
-GPA / CGPA calculation
-Result analytics dashboard
-Bulk marks upload
-Improved authentication security

📌 Disclaimer
This project is developed strictly for educational purposes and does not represent an official academic system.

👩‍💻 Author
Vaishnavi Bhatale
E&TC Engineering Student
Pune Institute of Computer Technology (PICT)
