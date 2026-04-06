# 🎓 Student Result Management System

A role-based web application designed to manage academic results efficiently. The system provides separate login access for Students, Teachers, and Admin, ensuring secure and controlled operations.

This project is developed as an academic and resume-level project to demonstrate backend, database management, and role-based access control concepts.

---

## 🚀 Features

### 👨‍🎓 Student Module
- Secure student login  
- View only own academic results  
- Download results  
- Subject-wise marks display  

### 👩‍🏫 Teacher Module
- Secure teacher login  
- Add and update marks for assigned subjects  
- View students under assigned subjects  

### 🧑‍💼 Admin Module
- Add, edit, and delete:
  - Students  
  - Teachers  
  - Subjects  
  - Departments  

- Assign:
  - Subjects to teachers  
  - Students to departments  

- Manage:
  - Student results  
  - Department records  
  - Complete academic data  

---

## 🔐 Role-Based Access Control

| Role    | Access                                  |
|--------|------------------------------------------|
| Student | View & download own results              |
| Teacher | Add/Edit marks for assigned subjects     |
| Admin   | Full system access                       |

---

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP  
- **Database:** MySQL  
- **Version Control:** Git & GitHub  

---

## 🧠 System Architecture

User (Student / Teacher / Admin)  
↓  
Authentication  
↓  
Role-Based Access Control  
↓  
Backend Server (PHP)  
↓  
Database (MySQL)  

---

## 📁 Project Structure
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


---

## 📊 Mapping to Finance Dashboard Requirements

Although this project is a Student Result Management System, it aligns with the Finance Dashboard assignment in the following ways:

- **Dashboard Overview**  
  The system dashboards (Admin, Teacher, Student) provide structured views of academic data, similar to how financial dashboards present summaries.

- **Transactions Analogy**  
  Academic records can be interpreted as transaction-like data:
  - Marks → Amount  
  - Subjects → Categories  
  - Exam results → Transactions  

- **Role-Based UI**  
  The system implements:
  - Student (view-only access)  
  - Teacher (add/edit data)  
  - Admin (full control)  
  This fulfills the role-based UI requirement.

- **Data Handling & State Management**  
  The application dynamically interacts with the database and handles CRUD operations, reflecting structured state and data flow.

- **Insights (Basic)**  
  Users can observe subject-wise performance and overall results, providing analytical understanding similar to financial insights.

---

## ⚠️ Note

Due to time constraints, advanced financial visualizations (charts) and detailed analytics are not included. However, the system demonstrates strong fundamentals in UI structuring, role-based interaction, and data management.

---

## 🗄️ Dataset Information

This project uses **dummy data only** for demonstration and testing purposes.  
No real student or institutional data is used.

---

## 🎯 Learning Outcomes

- Role-based authentication  
- Database design and CRUD operations  
- Backend–frontend integration  
- Academic workflow implementation  
- Structured UI design  

---

## 🚀 Future Enhancements

- GPA / CGPA calculation  
- Result analytics dashboard (charts & graphs)  
- Bulk marks upload  
- Enhanced authentication security  
- Advanced filtering and reporting  

---

## 📌 Disclaimer

This project is developed strictly for educational purposes and does not represent an official academic system.

---

## 🔗 Links

- **GitHub Repository:** (Add your repo link here)  
- **Live Demo:** (Add deployed link here, if available)  

---

## 👩‍💻 Author

**Vaishnavi Bhatale**  
E&TC Engineering Student  
Pune Institute of Computer Technology (PICT)
