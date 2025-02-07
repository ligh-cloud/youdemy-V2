<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
<!-- Header -->
<header class="bg-purple-600 text-white py-4 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <div class="text-xl font-bold">Add New Course</div>
        <form method="POST" action="../../controller/public/AuthController.php" class="flex justify-center items-center">
            <button
                name="logout"
                type="submit"
                class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition-all">
                Log out
            </button>
        </form>
    </div>
</header>

<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Add New Course</h2>
    <form action="<?php echo URLROOT; ?>/teacherController/addCourse" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Course Title</label>
            <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded-lg mt-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Course Description</label>
            <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg mt-2" rows="4" required></textarea>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-gray-700">Category</label>
            <select id="category" name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <?php foreach ($data['allCategories'] as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat['id']); ?>"><?php echo htmlspecialchars($cat['nom']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="tag" class="block text-gray-700">Tags</label>
            <select id="tag" name="tag" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <?php foreach ($data['allTags'] as $tag): ?>
                    <option value="<?php echo htmlspecialchars($tag['id_tag']); ?>"><?php echo htmlspecialchars($tag['tag_name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="document" class="block text-gray-700">Course Document</label>
            <input type="file" name="document" id="document" class="w-full px-4 py-2 border rounded-lg mt-2">
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Course Image</label>
            <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-lg mt-2">
        </div>
        <div class="mb-4">
            <label for="video" class="block text-gray-700">Course Video</label>
            <input type="file" name="video" id="video" class="w-full px-4 py-2 border rounded-lg mt-2">
        </div>
        <div class="flex justify-between items-center">
            <a href="teacher_dashboard.php" class="text-purple-600 hover:underline">Back to Dashboard</a>
            <button name="add_course" type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Add Course</button>
        </div>
    </form>
</div>

<!-- Footer -->
<footer class="bg-purple-600 text-white py-4 mt-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
        © 2025 Teacher Dashboard. All rights reserved.
    </div>
</footer>
</body>

</html>