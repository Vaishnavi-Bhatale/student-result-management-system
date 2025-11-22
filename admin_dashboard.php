<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Admin Dashboard</title>
<style>
  *{box-sizing:border-box;font-family:Arial,Helvetica,sans-serif}
  body{margin:0;background:#f4f6f8;color:#222;min-height:100vh;display:flex;flex-direction:column}
  header{background:#2f3a47;color:#fff;padding:14px 20px;display:flex;align-items:center;justify-content:space-between}
  header .title{font-size:18px;font-weight:600}
  header a.logout{background:#e04b4b;padding:8px 12px;border-radius:6px;color:#fff;text-decoration:none}
  header a.logout:hover{opacity:.95}

  .container{display:flex;gap:18px;flex:1;padding:20px}
  /* menu on left, main content on right */
  .left-panel{width:260px;background:#2c3e50;color:#fff;padding:18px;border-radius:10px;box-shadow:0 4px 12px rgba(15,20,25,.06)}
  .left-panel h3{margin:0 0 12px 0;font-size:16px}
  .menu-btn{display:block;width:100%;padding:11px 12px;margin:8px 0;border-radius:8px;background:#34495e;color:#fff;border:none;cursor:pointer;text-align:left;font-weight:600}
  .menu-btn.active{background:#1abc9c;color:#083127}
  .menu-btn:hover{opacity:.95}
  .left-panel a.menu-btn {text-decoration: none;}

  .main{flex:1;background:#fff;padding:18px;border-radius:10px;box-shadow:0 4px 12px rgba(15,20,25,.06);overflow:auto}
  section{display:none}
  section.active{display:block}
  section h3{margin:0 0 10px 0;font-size:18px;color:#2c3e50;border-left:4px solid #3498db;padding-left:10px}
  table{width:100%;border-collapse:collapse;margin-top:12px}
  th,td{padding:10px;border:1px solid #e6e9ee;text-align:left;font-size:14px}
  th{background:#2c3e50;color:#fff}
  tr:nth-child(even){background:#fbfcfe}
  .action-btn{display:inline-block;padding:6px 8px;border-radius:6px;text-decoration:none;font-size:13px;margin-right:6px}
  .edit{background:#27ae60;color:#fff}
  .delete{background:#e74c3c;color:#fff}

  .add-btn{display:inline-block;margin-top:10px;padding:8px 12px;background:#2980b9;color:#fff;border-radius:6px;text-decoration:none}
  @media (max-width:860px){
    .container{flex-direction:column}
    .left-panel{width:100%}
  }
</style>
</head>
<body>

<header>
  <div class="title">Admin Dashboard</div>
</header>

<div class="container">
  <!-- LEFT: menu -->
  <div class="left-panel">
    <h3>View Tables</h3>
    <button class="menu-btn active" data-target="teachers">Teachers 👩‍🏫</button>
    <button class="menu-btn" data-target="students">Students 🎓</button>
    <button class="menu-btn" data-target="departments">Departments 🏛️</button>
    <button class="menu-btn" data-target="subjects">Subjects 📚</button>
    <button class="menu-btn" data-target="results">Results 📝</button>
    <a href="index.php"  class="menu-btn">Logout ⬅️</a>
  </div>

  <!-- RIGHT: main content -->
  <div class="main">
    <!-- Teachers (default visible) -->
    <section id="teachers" class="active">
      <h3>Teachers</h3>
      <?php
        $teachers = $conn->query("SELECT t.teacher_id, t.name, t.username, d.department_name
                                  FROM Teacher t
                                  LEFT JOIN Department d ON t.department_id = d.department_id");
        echo "<table><tr><th>ID</th><th>Name</th><th>Username</th><th>Department</th><th>Action</th></tr>";
        while($t = $teachers->fetch_assoc()){
          echo "<tr>
                  <td>{$t['teacher_id']}</td>
                  <td>{$t['name']}</td>
                  <td>{$t['username']}</td>
                  <td>{$t['department_name']}</td>
                  <td>
                    <a class='action-btn edit' href='edit_teacher.php?id={$t['teacher_id']}'>Edit</a>
                    
                  </td>
                </tr>";
        }
        echo "</table>";
        echo "<a class='add-btn' href='add_teacher.php'>+ Add New Teacher</a>";
      ?>
    </section>

    <!-- Students -->
    <section id="students">
      <h3>Students</h3>
      <?php
        $students = $conn->query("SELECT s.student_id, s.name, s.username, s.roll_no, d.department_name
                                  FROM Student s
                                  LEFT JOIN Department d ON s.department_id = d.department_id");
        echo "<table><tr><th>ID</th><th>Name</th><th>Username</th><th>Roll No</th><th>Department</th><th>Action</th></tr>";
        while($s = $students->fetch_assoc()){
          echo "<tr>
                  <td>{$s['student_id']}</td>
                  <td>{$s['name']}</td>
                  <td>{$s['username']}</td>
                  <td>{$s['roll_no']}</td>
                  <td>{$s['department_name']}</td>
                  <td>
                    <a class='action-btn edit' href='edit_student.php?id={$s['student_id']}'>Edit</a>
                    <a class='action-btn delete' href='delete_student.php?id={$s['student_id']}'>Delete</a>
                  </td>
                </tr>";
        }
        echo "</table>";
        echo "<a class='add-btn' href='add_student.php'>+ Add New Student</a>";
      ?>
    </section>

    <!-- Departments -->
    <section id="departments">
      <h3>Departments</h3>
      <?php
        $departments = $conn->query("SELECT * FROM Department");
        echo "<table><tr><th>ID</th><th>Name</th><th>Action</th></tr>";
        while($dep = $departments->fetch_assoc()){
          echo "<tr>
                  <td>{$dep['department_id']}</td>
                  <td>{$dep['department_name']}</td>
                  <td>
                    <a class='action-btn edit' href='edit_department.php?id={$dep['department_id']}'>Edit</a>
                    
                  </td>
                </tr>";
        }
        echo "</table>";
        echo "<a class='add-btn' href='add_department.php'>+ Add New Department</a>";
      ?>
    </section>

    <!-- Subjects -->
    <section id="subjects">
      <h3>Subjects</h3>
      <?php
        $subjects = $conn->query("SELECT sub.subject_id, sub.subject_name, sub.year, sub.semester, sub.credits,
                                  d.department_name, t.name AS teacher_name
                                  FROM Subject sub
                                  LEFT JOIN Department d ON sub.department_id = d.department_id
                                  LEFT JOIN Teacher t ON sub.teacher_id = t.teacher_id");
        echo "<table><tr><th>ID</th><th>Name</th><th>Year</th><th>Semester</th><th>Credits</th><th>Department</th><th>Teacher</th><th>Action</th></tr>";
        while($sub = $subjects->fetch_assoc()){
          echo "<tr>
                  <td>{$sub['subject_id']}</td>
                  <td>{$sub['subject_name']}</td>
                  <td>{$sub['year']}</td>
                  <td>{$sub['semester']}</td>
                  <td>{$sub['credits']}</td>
                  <td>{$sub['department_name']}</td>
                  <td>{$sub['teacher_name']}</td>
                  <td>
                    <a class='action-btn edit' href='edit_subject.php?id={$sub['subject_id']}'>Edit</a>
                  </td>
                </tr>";
        }
        echo "</table>";
        echo "<a class='add-btn' href='add_subject.php'>+ Add New Subject</a>";
      ?>
    </section>

    <!-- Results -->
    <section id="results">
      <h3>Results</h3>
      <?php
        $results = $conn->query("SELECT r.result_id, s.name AS student_name, s.roll_no, sub.subject_name, r.marks_obtained, r.grade
                                 FROM Result r
                                 LEFT JOIN Student s ON r.student_id = s.student_id
                                 LEFT JOIN Subject sub ON r.subject_id = sub.subject_id");
        echo "<table><tr><th>Student</th><th>Roll No</th><th>Subject</th><th>Marks</th><th>Grade</th><th>Action</th></tr>";
        while($res = $results->fetch_assoc()){
          echo "<tr>
                  <td>{$res['student_name']}</td>
                  <td>{$res['roll_no']}</td>
                  <td>{$res['subject_name']}</td>
                  <td>{$res['marks_obtained']}</td>
                  <td>{$res['grade']}</td>
                  <td>
                    <a class='action-btn edit' href='edit_result.php?id={$res['result_id']}'>Edit</a>
                    <a class='action-btn delete' href='delete_result.php?id={$res['result_id']}'>Delete</a>
                  </td>
                </tr>";
        }
        echo "</table>";
        echo "<a class='add-btn' href='add_result.php'>+ Add New Result</a>";
      ?>
    </section>
  </div>
</div>

<script>
  const buttons = document.querySelectorAll('.menu-btn');
  const sections = document.querySelectorAll('section');

  function showSection(id){
    sections.forEach(s => s.classList.remove('active'));
    const el = document.getElementById(id);
    if(el) el.classList.add('active');
  }

  buttons.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      buttons.forEach(b=>b.classList.remove('active'));
      btn.classList.add('active');
      showSection(btn.getAttribute('data-target'));
      document.querySelector('.main').scrollTop = 0;
    });
  });

  const defaultBtn = document.querySelector('.menu-btn.active');
  if(defaultBtn) showSection(defaultBtn.dataset.target);
</script>

</body>
</html>
