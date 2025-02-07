<?php
//
//    require "../model/database.php";
//    require "../model/Course.php";
//    require "../model/category.php";
//
//    $categories = Category::getAll();
//    $courses = Course::getAll();
    ?>
    <!DOCTYPE html>
    <html lang="fr" class="scroll-smooth">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Youdemy - Plateforme d'apprentissage innovante</title>
        <!-- CSS Libraries -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.css">
        <script src="https://unpkg.com/htmx.org@1.7.0"></script>

        <!-- Custom Styles -->
        <style>
            .loading-skeleton {
                animation: skeleton-loading 1s linear infinite alternate;
            }

            @keyframes skeleton-loading {
                0% { background-color: #e5e7eb; }
                100% { background-color: #f3f4f6; }
            }

            .course-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .course-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .category-filter {
                transition: all 0.3s ease;
            }

            .category-filter:hover {
                background-color: #e5e7eb;
            }

            .category-filter.active {
                background-color: #3b82f6;
                color: white;
            }

            #progressBar {
                transition: width 0.3s ease;
            }

            .modal {
                transition: opacity 0.3s ease;
            }
        </style>
    </head>
    <body class="bg-gray-50 min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <img src="/api/placeholder/40/40" alt="Logo" class="h-10 w-10 rounded-lg mr-2">
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text">Youdemy</h1>
                        </div>
                        <div class="hidden lg:flex lg:space-x-8 ml-10">
                            <a href="#" class="nav-link active" data-section="home">Accueil</a>
                            <a href="view/search.php" class="nav-link" data-section="courses">Cours</a>
                            <a href="#" class="nav-link student-only hidden" data-section="my-courses">Mes Cours</a>
                            <a href="#" class="nav-link teacher-only hidden" data-section="manage">Gérer</a>
                            <a href="#" class="nav-link teacher-only hidden" data-section="stats">Statistiques</a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Search Bar -->
                        <div class="hidden md:block relative">
                            <input type="search"
                                id="search-input"
                                class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Rechercher un cours...">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>

                        <!-- Auth Buttons -->
                        <div id="auth-buttons">
                            <button class="login-btn px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                <a href="<?php echo URLROOT ?>/userController/signin">Connexion</a>
                            </button>
                            <button class="register-btn ml-2 px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-full hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                <a href="<?php echo URLROOT ?>/userController/signup">Inscription</a>
                            </button>
                        </div>

                        <!-- User Menu (Hidden by default) -->
                        <div id="user-menu" class="hidden relative">
                            <button class="user-menu-btn flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                <img src="/api/placeholder/32/32" alt="Profile" class="w-8 h-8 rounded-full">
                                <span class="hidden md:inline" id="user-name">John Doe</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="dropdown-content hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user mr-2"></i> Mon Profil
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-cog mr-2"></i> Paramètres
                                    </a>
                                    <hr class="my-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1">
            <!-- Hero Section -->
            <section id="hero" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-4xl md:text-6xl font-bold mb-6" data-aos="fade-up">
                            Apprenez à votre rythme
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 text-blue-100" data-aos="fade-up" data-aos-delay="100">
                            Des milliers de cours pour développer vos compétences
                        </p>
                        <div class="flex justify-center space-x-4" data-aos="fade-up" data-aos-delay="200">
                            <button class="px-8 py-3 bg-white text-blue-600 rounded-full font-medium hover:bg-gray-100 transition-all duration-300">
                                Commencer
                            </button>
                            <button class="px-8 py-3 bg-transparent border-2 border-white rounded-full font-medium hover:bg-white hover:text-blue-600 transition-all duration-300">
                                En savoir plus
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Categories Section -->
            <section class="py-12 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold mb-8 text-center" data-aos="fade-up">Catégories populaires</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="categories-grid">
        <button class="category-filter active px-4 py-2 rounded-full text-sm"
                data-category="all"
                hx-get="controller/public/fetch_courses.php?category=all"
                hx-trigger="click"
                hx-target="#courses-grid"
                hx-swap="innerHTML">
            Tous
        </button>
        <?php foreach ($categories as $category): ?>
            <button class="category-filter px-4 py-2 rounded-full text-sm"
                    data-category="<?php echo htmlspecialchars($category['id']); ?>"
                    hx-get="controller/public/fetch_courses.php?category=<?php echo urlencode($category['id']); ?>"
                    hx-trigger="click"
                    hx-target="#courses-grid"
                    hx-swap="innerHTML">
                <?php echo htmlspecialchars($category['nom']); ?>
            </button>
        <?php endforeach; ?>
    </div>
                    </div>
                </div>
            </section>

            <!-- Courses Section -->
            <section class="py-12" id="courses-section">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                        <h2 class="text-3xl font-bold mb-4 md:mb-0" data-aos="fade-right">Cours disponibles</h2>
                    </div>

                    <!-- Course Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="courses-grid">
                        <?php foreach ($courses as $course): ?>
                            <div class="course-card bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up">
                                <img src="uploads/<?php echo htmlspecialchars($course['image']); ?>"
                                    alt="<?php echo htmlspecialchars($course['title']); ?>"
                                    class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                            <?php echo htmlspecialchars($course['categorie_id']); ?>
                                        </span>
                                        <div class="flex items-center">
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <span class="ml-1 text-gray-600">
                                                <?php echo htmlspecialchars($course['rating'] ?? 'N/A'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-semibold mb-2">
                                        <?php echo htmlspecialchars($course['title']); ?>
                                    </h3>
                                    <p class="text-gray-600 mb-4">
                                        <?php echo htmlspecialchars($course['description']); ?>
                                    </p>
                                    <div class="flex items-center justify-between">

                                        <span class="text-lg font-bold text-blue-600">
                                            <?php echo htmlspecialchars($course['price'] ?? 'Free'); ?>€
                                        </span>
                                    </div>
                                    <button
                                            class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                        <a href="../view/signup.php">Voir le détail</a>
                                    </button>
                                    <button onclick="enrollCourse(<?php echo htmlspecialchars($course['id_course']); ?>)"
                                            class="mt-2 w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                        S'inscrire
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </main>
        <?php if (isset($_SESSION['signup_success'])): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Inscription réussie!',
                    text: 'Votre compte a été créé avec succès.',
                    confirmButtonText: 'OK'
                });
                <?php unset($_SESSION['signup_success']); // Unset the session variable after displaying the message ?>
            </script>
        <?php endif; ?>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">À propos</h3>
                        <p class="text-gray-400">Youdemy est une plateforme d'apprentissage en ligne innovante qui connecte les étudiants aux meilleurs enseignants.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors">Accueil</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Cours</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Enseignants</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><i class="fas fa-envelope mr-2"></i> contact@youdemy.com</li>
                            <li><i class="fas fa-phone mr-2"></i> +33 1 23 45 67 89</li>
                            <li><i class="fas fa-map-marker-alt mr-2"></i> Paris, France</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Suivez-nous</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                    <p>&copy; 2024 Youdemy. Tous droits réservés.</p>
                </div>
            </div>
        </footer>





        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>


        <script>

            AOS.init({
                duration: 800,
                once: true
            });

            const notyf = new Notyf({
                duration: 3000,
                position: { x: 'right', y: 'top' }
            });


            document.querySelectorAll('.category-filter').forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.category-filter').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });


            function enrollCourse(courseId) {

                notyf.success('You need to login !');
            }


            document.getElementById('course-preview-modal').addEventListener('click', (e) => {
                if (e.target === e.currentTarget) {
                    e.currentTarget.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            });


            let searchTimeout;
            document.getElementById('search-input').addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const searchValue = e.target.value;
                    htmx.ajax('GET', `controller/public/fetch_courses.php?search=${encodeURIComponent(searchValue)}`, {
                        target: '#courses-grid',
                        swap: 'innerHTML'
                    });
                }, 300);
            });

            document.addEventListener('DOMContentLoaded', () => {

            });
        </script>
    </body>
    </html>