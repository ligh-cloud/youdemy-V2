<!DOCTYPE html>
<?php session_start() ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>

<body class="bg-gray-50">
    <!-- Admin Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <div class="text-2xl font-bold tracking-wider">
                    <i class="fas fa-chart-line mr-2"></i>Admin Dashboard
                </div>

                <div class="flex items-center gap-6">
                    <div class="relative">
                        <input type="text" placeholder="Search..." 
                               class="px-4 py-2 bg-white/10 rounded-lg text-white placeholder-gray-300 
                                      focus:outline-none focus:ring-2 focus:ring-white/50 transition-all
                                      w-64">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-300"></i>
                    </div>
                    <div class="flex items-center gap-3 bg-white/10 px-4 py-2 rounded-lg">
                        <i class="fas fa-user-circle text-xl"></i>
                        <span class="font-medium"><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom'] ?></span>
                    </div>
                    <form method="POST" action="../../controller/public/AuthController.php">
                        <button
                            name="logout"
                            type="submit"
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
        <!-- Admin Sidebar -->
        <div class="w-64 bg-white shadow-xl">
            <div class="p-6">
                <div class="space-y-1">
                    <a href="admin_dashboard.php" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="teacher_accept.php" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Teacher Validation</span>
                    </a>
                    <a href="manage_users.php" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                    <a href="manage_courses.php" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-book"></i>
                        <span>Course Management</span>
                    </a>
                    <a href="tags_category.php" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-tags"></i>
                        <span>Categories & Tags</span>
                    </a>
                </div>
            </div>
        </div>

        <?php include "admin_stats.php"; ?>
    </div>

    <!-- Add a subtle pattern to the background -->
    <style>
        body {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</body>

</html>