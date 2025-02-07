<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Statistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Admin Statistics</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4">Total Courses</h2>
        <p class="text-lg"><?php echo $data['totalCourses']; ?></p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4">Courses by Category</h2>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Category</th>
                <th class="py-2 px-4 border-b">Total Courses</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['coursesByCategory'] as $category): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($category['nom']); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($category['total']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4">Course with Most Students</h2>
        <p class="text-lg">
            <?php if($data['courseWithMostStudents']): ?>
                <?php echo htmlspecialchars($data['courseWithMostStudents']['title']); ?> (<?php echo htmlspecialchars($data['courseWithMostStudents']['students']); ?> students)
            <?php else: ?>
        <h2 class="text-2xl font-semibold text-red-600 mb-4">No data</h2>
        <?php endif; ?>
        </p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4">Top 3 Teachers</h2>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Teacher</th>
                <th class="py-2 px-4 border-b">Total Courses</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['topTeachers'] as $teacher): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($teacher['nom']); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($teacher['courses']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>