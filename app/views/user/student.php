
<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 font-[Inter]">
    <!-- Enhanced Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img src="/api/placeholder/40/40" alt="Logo" class="h-10 w-10 rounded-xl shadow-md">
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text">
                        Youdemy
                    </span>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <input type="text" placeholder="Search courses..."
                            class="w-64 px-4 py-2 pl-10 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900"><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom'] ?></p>
                                <p class="text-xs text-gray-500">Student</p>
                            </div>
                            <img src="/api/placeholder/32/32" class="w-10 h-10 rounded-full border-2 border-blue-500">
                        </div>

                        <form method="POST" action="../../controller/public/AuthController.php">
                            <button name="logout" type="submit"
                                class="px-4 py-2 bg-red-500 text-white font-medium rounded-xl hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition-all flex items-center space-x-2">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex min-h-screen">
        <!-- Enhanced Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <div class="space-y-1">
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="get_all_my_course.php" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <i class="fas fa-book-open"></i>
                        <span>My Courses</span>
                    </a>
                    <a href="search.php" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <i class="fas fa-search"></i>
                        <span>Course Catalog</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <i class="fas fa-chart-line"></i>
                        <span>Progress</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Enhanced Main Content -->
        <div class="flex-1 p-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-100 rounded-xl">
                            <i class="fas fa-book text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Enrolled Courses</h3>
                            <p class="text-3xl font-bold text-blue-600">5</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-green-100 rounded-xl">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Completed Courses</h3>
                            <p class="text-3xl font-bold text-green-600">3</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-100 rounded-xl">
                            <i class="fas fa-clock text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Hours Learned</h3>
                            <p class="text-3xl font-bold text-blue-600">42</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Course Section -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">My Courses</h2>
                        <a href="search.php" class="text-blue-600 hover:text-blue-700 font-medium flex items-center space-x-2">
                            <span>Find more courses</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300">
                            <div class="relative">
                                <img src="/api/placeholder/400/200" alt="Course" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="bg-blue-100 text-blue-600 text-xs font-medium px-2.5 py-1 rounded-lg">
                                        In Progress
                                    </span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-semibold text-lg text-gray-800 mb-2">Web Development Bootcamp</h3>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>12 hours left</span>
                                </div>
                                <div class="mb-4">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Progress</span>
                                        <span class="text-blue-600 font-medium">60%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>
                                <button class="w-full bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center space-x-2">
                                    <i class="fas fa-play-circle"></i>
                                    <span>Continue Learning</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Enhanced Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        /* Loading Spinner */
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Hover Effects */
        .hover-shadow:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
    </style>

    <script>
        const notyf = new Notyf({
            duration: 5000,
            position: {x: 'right', y: 'top'},
            types: [
                {
                    type: 'success',
                    background: '#10B981',
                    icon: {
                        className: 'fas fa-check-circle',
                        tagName: 'i'
                    }
                },
                {
                    type: 'error',
                    background: '#EF4444',
                    icon: {
                        className: 'fas fa-times-circle',
                        tagName: 'i'
                    }
                }
            ]
        });

        <?php if (isset($_SESSION['success'])): ?>
            notyf.success("<?php echo $_SESSION['success']; ?>");
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            notyf.error("<?php echo $_SESSION['error']; ?>");
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </script>
</body>
</html>