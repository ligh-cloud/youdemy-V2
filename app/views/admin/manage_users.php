<?php
session_start();
require "../../model/users.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) { 
    header("Location: ../login.php");
    exit();
}

$allUsers = User::getAll(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Admin Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <div class="text-2xl font-bold tracking-wider">
                    <i class="fas fa-users mr-2"></i>User Management
                </div>

                <div class="flex items-center gap-6">
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
        <div class="w-80 bg-white shadow-xl">
            <div class="p-6">
                <div class="space-y-1">
                    <a href="admin_dashboard.php" 
                       class="flex items-center gap-3 px-6 py-4 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600 text-lg">
                        <i class="fas fa-home w-8"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="teacher_accept.php" 
                       class="flex items-center gap-3 px-6 py-4 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600 text-lg">
                        <i class="fas fa-chalkboard-teacher w-8"></i>
                        <span>Teacher Validation</span>
                    </a>
                    <a href="manage_users.php" 
                       class="flex items-center gap-3 px-6 py-4 rounded-lg bg-blue-50 
                              transition-all duration-200 text-blue-600 text-lg">
                        <i class="fas fa-users w-8"></i>
                        <span>User Management</span>
                    </a>
                    <a href="manage_courses.php" 
                       class="flex items-center gap-3 px-6 py-4 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600 text-lg">
                        <i class="fas fa-book w-8"></i>
                        <span>Course Management</span>
                    </a>
                    <a href="tags_category.php" 
                       class="flex items-center gap-3 px-6 py-4 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600 text-lg">
                        <i class="fas fa-tags w-8"></i>
                        <span>Categories & Tags</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <?php if(isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <?php echo $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    <?php echo $_SESSION['success']; ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">All Users</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($allUsers as $user): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?php echo $user['nom'] . ' ' . $user['prenom']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $user['email']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($user['ban'] === 'true'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Banned
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <form method="post" action="../../controller/admin/user_manage.php">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <?php if ($user['ban'] === 'true'): ?>
                                            <button type="submit" name="action" value="unban"
                                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 
                                                       transition-colors duration-200 flex items-center gap-2">
                                                <i class="fas fa-user-check"></i>
                                                Unban
                                            </button>
                                        <?php else: ?>
                                            <button type="submit" name="action" value="ban"
                                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 
                                                       transition-colors duration-200 flex items-center gap-2">
                                                <i class="fas fa-user-slash"></i>
                                                Ban
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add a subtle pattern to the background -->
    <style>
        body {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</body>
</html>