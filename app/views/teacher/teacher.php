




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
<!-- Sweet Alert Notifications -->
<?php if(isset($_SESSION['error'])): ?>
    <script>
        Swal.fire({
            title: "Error!",
            text: "<?php echo $_SESSION['error']; ?>",
            icon: "error",
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#F87171',
            color: '#fff'
        });
    </script>
<?php unset($_SESSION['error']); ?>
<?php elseif(isset($_SESSION['success'])): ?>
    <script>
        Swal.fire({
            title: "Success!",
            text: "<?php echo $_SESSION['success']; ?>",
            icon: "success",
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#34D399',
            color: '#fff'
        });
    </script>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!-- Header -->
<nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16 items-center">
            <div class="text-2xl font-bold tracking-wider">
                <i class="fas fa-chalkboard-teacher mr-2"></i>Teacher Dashboard
            </div>

            <div class="flex items-center gap-6">
                <div class="relative">
                    <input type="text" placeholder="Search courses..."
                           class="px-4 py-2 bg-white/10 rounded-lg text-white placeholder-gray-300
                                      focus:outline-none focus:ring-2 focus:ring-white/50 transition-all
                                      w-64">
                    <i class="fas fa-search absolute right-3 top-3 text-gray-300"></i>
                </div>
                <div class="flex items-center gap-3 bg-white/10 px-4 py-2 rounded-lg">
                    <i class="fas fa-user-circle text-xl"></i>
                    <span class="font-medium"><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom']; ?></span>
                </div>
                <form method="POST" action="../../controller/public/AuthController.php">
                    <button name="logout" type="submit"
                            class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg
                                       hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400
                                       focus:ring-offset-2 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-sign-out-alt"></i>
                        Log out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="flex min-h-screen">
    <!-- Teacher Sidebar -->
    <div class="w-64 bg-white shadow-xl">
        <div class="p-6">
            <div class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50
                                     transition-all duration-200 text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="get_my_courses.php" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50
                                                      transition-all duration-200 text-gray-700 hover:text-blue-600">
                    <i class="fas fa-book"></i>
                    <span>My Courses</span>
                </a>
                <a href="view_course_students.php" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50
                                     transition-all duration-200 text-gray-700 hover:text-blue-600">
                    <i class="fas fa-users"></i>
                    <span>Students</span>
                </a>
                <a href="statistics.php" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50
                                                  transition-all duration-200 text-gray-700 hover:text-blue-600">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Teacher Main Content -->
    <div class="flex-1 p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-gray-600 font-medium">Total Students</h3>
                        <p class="text-3xl font-bold text-gray-800"><?php echo $totalStudents; ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-gray-600 font-medium">Active Courses</h3>
                        <p class="text-3xl font-bold text-gray-800"><?php echo $topCourses['totalCourse']; ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-star text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-gray-600 font-medium">Average Rating</h3>
                        <p class="text-3xl font-bold text-gray-800">4.8</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course List -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">My Courses</h2>
                    <a href="add-course.php"
                       class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg
                                  hover:bg-blue-700 transition-all duration-200">
                        <i class="fas fa-plus"></i>
                        Add New Course
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($allCourses as $course): ?>
                        <div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-200
                                    transform hover:-translate-y-1">
                            <?php if($course['video']): ?>
                                <img src="../../resourses/videotitle.png" alt="video">
                            <?php else: ?>
                                <img src="../../uploads/<?php echo $course['image'];?>"

                                     alt="Course"
                                     class="w-full h-48 object-cover rounded-t-lg">
                            <?php endif; ?>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800"><?php echo $course['title']; ?></h3>
                                <div class="flex items-center justify-between mt-3">
                                    <p class="text-gray-600 text-sm flex items-center gap-1">
                                        <i class="fas fa-users"></i>
                                        45 Students
                                    </p>
                                    <span class="text-blue-500 flex items-center gap-1">
                                        <i class="fas fa-star"></i>
                                        4.9
                                    </span>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <a href="edit_course.php?id=<?php echo htmlspecialchars($course['id_course']); ?>"><button  class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Current time and user info -->
        <div class="text-sm text-gray-500 text-right mt-4">
            <p>Current Time (UTC): <?php echo date('Y-m-d H:i:s'); ?></p>
            <p>User: <?php echo htmlspecialchars($_SESSION['login'] ?? 'ligh-cloud'); ?></p>
        </div>
    </div>
</div>

<!-- Add subtle pattern to background -->
<style>
    body {
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
</style>
</body>
</html>