<!DOCTYPE html>
<html>
<head>
<title>Faculty Assignment</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
body { background: #f7f0df; color: #000000; display: flex; flex-direction: column; min-height: 100vh; }
.header { background: #741f2b; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
.header h1 { font-size: 24px; }
.back { background: #fffdf7; color: #741f2b; height: 37px; padding: 0 15px; border-radius: 5px; text-decoration: none; font-weight: 500; display: flex; align-items: center; justify-content: center; }
.back:hover { background: #f3e8d2; }
.container { flex: 1; padding: 40px; display: flex; flex-direction: column; align-items: center; }
.box { width: 100%; max-width: 600px; background: #fffdf7; padding: 40px; border-radius: 10px; border: 1px solid #eadfc9; box-shadow: 0 5px 20px rgba(75, 20, 20, 0.12); }
.box h2 { color: #741f2b; text-align: center; font-size: 24px; margin-bottom: 8px; }
.subtitle { text-align: center; color: #333333; margin-bottom: 25px; font-size: 14px; }
.no-data { text-align: center; color: #555555; padding: 20px 0; font-size: 14px; }
.footer { background: #741f2b; color: #fffdf7; text-align: center; padding: 15px 20px; font-size: 14px; margin-top: auto; }

@media (max-width: 600px) {
    .header { padding: 20px; }
    .container { padding: 25px; }
    .box { width: 100%; }
}
</style>
</head>
<body>

<div class="header">
    <h1>Faculty Assignment</h1>
    <a href="course_admin.php" class="back">Back to Dashboard</a>
</div>

<div class="container">
    <div class="box">
        <h2>Assign Faculty</h2>
        <p class="subtitle">Assign teachers to university courses.</p>
        <div class="no-data">
            No faculty assignment data available.
        </div>
    </div>
</div>

<div class="footer">
    <p>&copy; <?php echo date("Y"); ?> University Portal. All Rights Reserved.</p>
</div>

</body>
</html>