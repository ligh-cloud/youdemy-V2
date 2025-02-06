<?php
require "../../model/tag.php";
session_start();

$itemsPerPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;


$tags = new Tags([]);
$allTags = $tags->getAllTags($offset, $itemsPerPage);
$totalTags = $tags->getTagsCount();
$totalPages = ceil($totalTags / $itemsPerPage);

?>



<div class="space-y-4">
    <?php if (empty($allTags)): ?>
        <div class="text-center py-6 text-gray-500">
            <i class="fas fa-tags text-4xl mb-2"></i>
            <p>No tags found</p>
        </div>
    <?php else: ?>
        <div class="grid gap-4">
            <?php foreach ($allTags as $tag): ?>
                <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-tag text-blue-500"></i>
                        <span class="font-semibold text-gray-800">
                            <?php echo htmlspecialchars($tag['tag_name']); ?>
                        </span>
                        
                    </div>
                    <form method="POST" action="../../controller/admin/delete_tag.php" 
                          class="ml-4"
                          onsubmit="return confirm('Are you sure you want to delete this tag?');">
                        <input type="hidden" name="tag_id" value="<?php echo $tag['id_tag']; ?>">
                        <button type="submit" 
                                class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 
                                       transition-all duration-200" 
                                title="Delete Tag">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="flex justify-center items-center space-x-2 mt-6">
                <?php if ($page > 1): ?>
                    <button onclick="loadTags(<?php echo $page - 1; ?>)"
                            class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-50 
                                   text-gray-600 flex items-center gap-1">
                        <i class="fas fa-chevron-left text-xs"></i>
                        Previous
                    </button>
                <?php endif; ?>

                <div class="flex items-center space-x-1">
                    <?php
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $page + 2);
                    
                    if ($startPage > 1) {
                        echo '<button onclick="loadTags(1)" 
                                     class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-50 
                                            text-gray-600">1</button>';
                        if ($startPage > 2) {
                            echo '<span class="text-gray-500">...</span>';
                        }
                    }
                    
                    for ($i = $startPage; $i <= $endPage; $i++): 
                    ?>
                        <button onclick="loadTags(<?php echo $i; ?>)"
                                class="px-3 py-1 rounded-lg border <?php echo $i === $page 
                                    ? 'bg-blue-500 text-white border-blue-500' 
                                    : 'border-gray-300 hover:bg-gray-50 text-gray-600'; ?>">
                            <?php echo $i; ?>
                        </button>
                    <?php endfor; 
                    
                    if ($endPage < $totalPages) {
                        if ($endPage < $totalPages - 1) {
                            echo '<span class="text-gray-500">...</span>';
                        }
                        echo '<button onclick="loadTags(' . $totalPages . ')" 
                                     class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-50 
                                            text-gray-600">' . $totalPages . '</button>';
                    }
                    ?>
                </div>

                <?php if ($page < $totalPages): ?>
                    <button onclick="loadTags(<?php echo $page + 1; ?>)"
                            class="px-3 py-1 rounded-lg border border-gray-300 hover:bg-gray-50 
                                   text-gray-600 flex items-center gap-1">
                        Next
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Current datetime and user info -->
    <div class="text-sm text-gray-500 text-right mt-4">
        <p>Current Time (UTC): <?php echo date('Y-m-d H:i:s'); ?></p>
        <p>User: <?php echo htmlspecialchars($_SESSION['nom']); ?></p>
    </div>
</div>