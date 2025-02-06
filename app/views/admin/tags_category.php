<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags & Categories Management</title>
    <script src="https://unpkg.com/htmx.org@1.7.0"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <!-- Admin Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <div class="text-2xl font-bold tracking-wider">
                    <i class="fas fa-tags mr-2"></i>Tags & Categories
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
                       class="flex items-center gap-3 px-6 py-4 rounded-lg hover:bg-blue-50 
                              transition-all duration-200 text-gray-700 hover:text-blue-600 text-lg">
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
                       class="flex items-center gap-3 px-6 py-4 rounded-lg bg-blue-50 
                              transition-all duration-200 text-blue-600 text-lg">
                        <i class="fas fa-tags w-8"></i>
                        <span>Categories & Tags</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Tags Section -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-tags text-2xl text-blue-600"></i>
                        <h2 class="text-2xl font-bold text-gray-800">Manage Tags</h2>
                    </div>
                    
                    <form id="mass-insert-form" hx-post="../../controller/admin/add-tags.php" 
                          hx-target="#tags-message" hx-swap="outerHTML">
                        <div class="mb-4">
                            <label for="tags" class="block text-gray-700 font-medium mb-2">
                                Tags (comma-separated):
                            </label>
                            <input type="text" id="tags" name="tags" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 
                                          focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   placeholder="Enter tags separated by commas">
                        </div>
                        <button name="add_tag" type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg 
                                       hover:bg-blue-700 focus:outline-none focus:ring-2 
                                       focus:ring-blue-500 focus:ring-offset-2 transition-all 
                                       flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Add Tags
                        </button>
                    </form>
                    <div id="tags-message" class="mt-4"></div>
                    <div id="tags-list" class="mt-6">
                        <!-- Tags will be loaded here -->
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-folder text-2xl text-green-600"></i>
                        <h2 class="text-2xl font-bold text-gray-800">Manage Categories</h2>
                    </div>
                    
                    <form id="category-form" hx-post="../../controller/admin/add-tags.php" 
                          hx-target="#category-message" hx-swap="outerHTML">
                        <div class="space-y-4">
                            <div>
                                <label for="category" class="block text-gray-700 font-medium mb-2">
                                    Category Name:
                                </label>
                                <input type="text" id="category" name="category" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                                              focus:ring-2 focus:ring-green-500 focus:border-green-500 
                                              transition-all"
                                       placeholder="Enter category name">
                            </div>
                            <div>
                                <label for="description" class="block text-gray-700 font-medium mb-2">
                                    Description:
                                </label>
                                <textarea name="description" id="description" rows="3" 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                                                 focus:ring-2 focus:ring-green-500 focus:border-green-500 
                                                 transition-all"
                                          placeholder="Enter category description"></textarea>
                            </div>
                        </div>
                        <button name="add_category" type="submit" 
                                class="mt-4 px-6 py-2 bg-green-600 text-white font-semibold rounded-lg 
                                       hover:bg-green-700 focus:outline-none focus:ring-2 
                                       focus:ring-green-500 focus:ring-offset-2 transition-all 
                                       flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Add Category
                        </button>
                    </form>
                    <div id="category-message" class="mt-4"></div>
                    <div id="categories-list" class="mt-6">
                        <!-- Categories will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadTags(page = 1) {
            fetch(`get-tags.php?page=${page}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tags-list').innerHTML = html;
                });
        }

        function loadCategories(page = 1) {
            fetch(`get-categories.php?page=${page}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('categories-list').innerHTML = html;
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadTags();
            loadCategories();
        });
    </script>


    <style>
        body {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
    <script>
 
    <?php if(isset($_SESSION['success'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?php echo $_SESSION['success']; ?>',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            background: '#4CAF50',
            color: '#fff'
        });
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?php echo $_SESSION['error']; ?>',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            background: '#F44336',
            color: '#fff'
        });
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    // Confirmation before delete
    function confirmDelete(categoryId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
            
                document.querySelector(`form[data-category-id="${categoryId}"]`).submit();
            }
        });
    }
</script>
</body>
</html>