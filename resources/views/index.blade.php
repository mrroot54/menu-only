<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Menu | Green Leaf Kitchen</title>
    
    <!-- Fonts & CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'premium': '#333333', 'muted': '#64748b', 'brand': '#14B8A6',
                        'brand-light': '#CCFBF1', 'brand-dark': '#0D9488',
                    },
                    fontFamily: { 'sans': ['Inter', 'sans-serif'], 'head': ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>

    <style>
        body { background-color: #FFFFFF; font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; overflow-x: hidden; }
        ::-webkit-scrollbar { width: 0px; background: transparent; }
        .fade-up { opacity: 0; transform: translateY(20px); }
        .slider-container { position: relative; overflow: hidden; }
        .slider-track { display: flex; }

        .menu-item-card {
            background-color: #FFFFFF; padding: 16px; margin-bottom: 12px; border-radius: 16px;
            border: 1px solid #F1F5F9;
            transition: box-shadow 0.6s ease, transform 0.5s ease;
        }
        .menu-item-card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.06); transform: translateY(-2px); }
        .img-zoom-container { overflow: hidden; border-radius: 12px; }
        .img-zoom-container img { transition: transform 1.2s ease; object-fit: cover; }
        .menu-item-card:hover .img-zoom-container img { transform: scale(1.05); }

        .filter-btn { display: flex; align-items: center; gap: 6px; }
        .filter-btn.active { background-color: #14B8A6; color: white; border-color: #14B8A6; box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3); }

        .page-btn { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; border: 1px solid #E5E7EB; transition: all 0.2s; background-color: white; }
        .page-btn.active { background-color: #14B8A6; color: white; border-color: #14B8A6; }
        
        .slider-btn { width: 36px; height: 36px; background: #14B8A6; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3); position: absolute; top: 50%; transform: translateY(-50%); z-index: 20; border: none; color: white; }
        .slider-btn.left { left: 8px; }
        .slider-btn.right { right: 8px; }

        .serial-badge { width: 24px; height: 24px; background-color: #F0FDFA; color: #0D9488; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; }

        #searchOverlay { position: fixed; top: 56px; left: 0; right: 0; z-index: 40; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(241, 245, 249, 0.5); }

        .special-card { position: relative; border-radius: 20px; overflow: hidden; height: 160px; width: 100%; box-shadow: 0 10px 20px rgba(0,0,0,0.08); cursor: pointer; }
        .special-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 2s ease; }
        .special-card:hover img { transform: scale(1.1); }
        .special-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to right, rgba(0,0,0,0.7), transparent); display: flex; flex-direction: column; justify-content: center; padding: 20px; }
        
        /* Top Selling Grid Style */
        .top-selling-card { background: white; border-radius: 12px; border: 1px solid #F1F5F9; overflow: hidden; transition: 0.3s; }
        .top-selling-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); }

        /* Voice Search Animation */
        .voice-btn { transition: all 0.3s; }
        .voice-btn.listening { 
            color: #EF4444; 
            animation: pulse-ring 1.5s cubic-bezier(0.215, 0.61, 0.355, 1) infinite; 
        }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
            100% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
        }
    </style>
</head>
<body class="text-premium pb-20">

    <!-- HEADER -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-3xl mx-auto px-5 h-14 flex items-center justify-between">
            <a href="#" class="font-head text-xl font-bold tracking-tight text-brand">Green Leaf 🥗</a>
            <button id="searchBtn" class="text-muted hover:text-brand transition-colors p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </button>
        </div>
    </header>

    <!-- SEARCH OVERLAY -->
    <div id="searchOverlay" class="hidden">
        <div class="max-w-3xl mx-auto px-5 py-3">
            <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-2xl px-4 py-3 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" id="searchInput" placeholder="Search food..." class="w-full bg-transparent outline-none text-sm text-premium font-medium">
                
                <!-- VOICE SEARCH BUTTON -->
                <button id="voiceSearchBtn" class="voice-btn p-2 rounded-full hover:bg-gray-100 text-muted hover:text-brand-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                    </svg>
                </button>

                <button id="closeSearchBtn" class="text-xs text-brand font-bold px-3 py-1 hover:bg-brand/10 rounded-full">Close</button>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="max-w-3xl mx-auto px-5 pt-20">
        <!-- HERO -->
        <section class="mb-6 fade-up">
            <h1 class="font-head text-3xl font-bold leading-tight mb-1 text-premium">Eat Fresh, Stay Healthy</h1>
            <p class="text-muted text-xs tracking-wide">Nutritious & Delicious food for you.</p>
        </section>

        <!-- RESTAURANT INTRO -->
        <section class="mb-10 fade-up">
            <div class="bg-gradient-to-r from-brand-light to-white border border-brand/10 rounded-2xl p-5 flex items-center gap-4 shadow-sm">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-2xl">🌿</div>
                <div>
                    <h3 class="text-sm font-semibold text-brand-dark mb-1">Welcome to Green Leaf</h3>
                    <p class="text-xs text-muted leading-relaxed">We serve organic, fresh, and delicious meals.</p>
                </div>
            </div>
        </section>

        <!-- 1. TODAY'S SPECIAL SECTION (is_special) -->
        <section class="mb-10" id="specialSection">
            <h2 class="text-xs font-semibold uppercase tracking-widest text-muted mb-4">Today’s Special ⭐</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="specialsContainer"></div>
        </section>

        <!-- 2. RECOMMENDED SLIDER (is_recommended) -->
        <section class="mb-12" id="sliderSection">
            <h2 class="text-xs font-semibold uppercase tracking-widest text-muted mb-4">Recommended 🔥</h2>
            <div class="slider-container" id="topPicksWrapper">
                <button class="slider-btn left" id="prevBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <div class="slider-track" id="recommendedContainer"></div>
                <button class="slider-btn right" id="nextBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </section>

        <!-- 3. TOP SELLING GRID (is_top_selling) -->
        <section class="mb-12" id="topSellingSection">
            <h2 class="text-xs font-semibold uppercase tracking-widest text-muted mb-4">Top Selling 🏆</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4" id="topSellingContainer"></div>
        </section>

        <!-- CATEGORIES FILTER -->
        <section class="mb-6 fade-up" id="categorySection">
            <div class="flex gap-2 overflow-x-auto no-scrollbar -mx-5 px-5" id="categoryFilters"></div>
        </section>

        <!-- MENU LIST -->
        <section id="menuList"><div class="text-center py-10 text-muted">Loading menu...</div></section>

        <!-- PAGINATION -->
        <div id="paginationContainer" class="flex justify-center items-center gap-2 mt-8 mb-10"></div>

        <!-- THANK YOU -->
        <section class="mb-10 fade-up">
             <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-brand-light via-white to-brand-light p-6 border border-brand/10 text-center shadow-sm">
                <div class="relative z-10">
                    <div class="inline-block bg-white p-2 rounded-xl shadow-sm mb-3"><span class="text-2xl">🌿</span></div>
                    <h3 class="font-head text-lg font-bold text-premium">Thank you for visiting Green Leaf Kitchen</h3>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="text-center py-4 text-xs text-muted border-t border-gray-100 bg-white">
        <div class="max-w-3xl mx-auto px-5"><span>© 2026 Green Leaf Kitchen</span></div>
    </footer>

   
    <!-- JAVASCRIPT -->
    <script>
        // FIX: Force HTTPS to avoid Mixed Content error on Railway
        const API_URL = window.location.origin.replace('http://', 'https://') + "/api";

        // DOM Elements
        const recommendedContainer = document.getElementById('recommendedContainer');
        const topPicksWrapper = document.getElementById('topPicksWrapper');
        const categoryFilters = document.getElementById('categoryFilters');
        const menuList = document.getElementById('menuList');
        const paginationContainer = document.getElementById('paginationContainer');
        const specialsContainer = document.getElementById('specialsContainer');
        const topSellingContainer = document.getElementById('topSellingContainer');
        const searchBtn = document.getElementById('searchBtn');
        const searchOverlay = document.getElementById('searchOverlay');
        const searchInput = document.getElementById('searchInput');
        const closeSearchBtn = document.getElementById('closeSearchBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const voiceSearchBtn = document.getElementById('voiceSearchBtn');

        // State
        let allMenuItems = [];
        let allCategories = [];
        let currentFilter = 'all';
        let currentPage = 1;
        const itemsPerPage = 10;
        let sliderPosition = 0;
        let cardWidth = 160; 
        let totalCards = 0;

        document.addEventListener('DOMContentLoaded', () => {
            initApp();
            initEvents();
            initVoiceSearch();
        });

        async function initApp() {
            try {
                const [catRes, menuRes] = await Promise.all([
                    fetch(`${API_URL}/categories`),
                    fetch(`${API_URL}/menu-items`)
                ]);

                const catData = await catRes.json();
                const menuData = await menuRes.json();

                allCategories = catData.data || [];
                allMenuItems = (menuData.data || []).map(item => ({
                    ...item,
                    desc: item.description,
                    img: item.image_url
                }));

                console.log(`Total Items: ${allMenuItems.length}`);

                renderCategories();
                renderSpecials(allMenuItems.filter(i => i.is_special));
                renderRecommended(allMenuItems.filter(i => i.is_recommended));
                renderTopSelling(allMenuItems.filter(i => i.is_top_selling));
                applyFilter('all');
                initSectionAnimations();

            } catch (error) {
                console.error("Error:", error);
                menuList.innerHTML = `<p class="text-center text-red-500 py-10">Failed to load menu. Check API URL or Network tab.</p>`;
            }
        }

        // --- Render Functions ---

        function renderCategories() {
            categoryFilters.innerHTML = '';
            const allBtn = createFilterBtn('All', 'all', '🍽️');
            categoryFilters.appendChild(allBtn);
            allCategories.forEach(cat => {
                categoryFilters.appendChild(createFilterBtn(cat.name, cat.id, cat.icon));
            });
        }

        function createFilterBtn(name, id, icon) {
            const btn = document.createElement('button');
            const isActive = id === currentFilter;
            btn.className = `filter-btn px-4 py-2 text-xs font-medium border border-gray-200 rounded-full whitespace-nowrap transition-colors hover:border-brand text-premium ${isActive ? 'active' : ''}`;
            btn.innerHTML = `<span>${icon}</span> ${name}`;
            btn.addEventListener('click', () => {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                applyFilter(id);
            });
            return btn;
        }

        // 1. Today's Special Render
        function renderSpecials(items) {
            specialsContainer.innerHTML = '';
            if(items.length === 0) { document.getElementById('specialSection').style.display = 'none'; return; }
            
            items.forEach(item => {
                const card = document.createElement('div');
                card.className = "special-card";
                card.innerHTML = `
                    <img src="${item.img}" alt="${item.name}">
                    <div class="special-overlay">
                        <span class="text-white/60 text-[10px] uppercase tracking-widest font-bold">Limited Offer</span>
                        <h3 class="text-white font-head font-bold text-xl mt-1">${item.name}</h3>
                        <div class="mt-3"><span class="bg-brand text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">₹${item.price}</span></div>
                    </div>`;
                specialsContainer.appendChild(card);
            });
        }

        // 2. Recommended Render (Slider)
        function renderRecommended(items) {
            recommendedContainer.innerHTML = '';
            if(items.length === 0) { document.getElementById('sliderSection').style.display = 'none'; return; }

            items.forEach(item => {
                const card = document.createElement('div');
                card.className = "pick-card flex-shrink-0 mr-4"; 
                card.innerHTML = `
                    <div class="w-36 rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-100">
                        <div class="h-28 w-full overflow-hidden"><img src="${item.img}" class="w-full h-full object-cover"></div>
                        <div class="p-3">
                            <h4 class="text-sm font-semibold text-premium truncate">${item.name}</h4>
                            <p class="text-xs text-muted mt-0.5 mb-2">₹${item.price}</p>
                        </div>
                    </div>`;
                recommendedContainer.appendChild(card);
            });
            initSlider();
        }

        // 3. Top Selling Render (Grid)
        function renderTopSelling(items) {
            topSellingContainer.innerHTML = '';
            if(items.length === 0) { document.getElementById('topSellingSection').style.display = 'none'; return; }

            items.forEach(item => {
                const card = document.createElement('div');
                card.className = "top-selling-card";
                card.innerHTML = `
                    <div class="w-full h-24 overflow-hidden"><img src="${item.img}" class="w-full h-full object-cover"></div>
                    <div class="p-2 text-center">
                        <h4 class="text-xs font-semibold text-premium truncate">${item.name}</h4>
                        <p class="text-xs text-brand font-bold mt-1">₹${item.price}</p>
                    </div>`;
                topSellingContainer.appendChild(card);
            });
        }

        // --- Filter & Pagination Logic ---
        
        function applyFilter(filterId) {
            currentFilter = filterId;
            currentPage = 1;
            updateView();
        }

        function updateView() {
            let filteredItems = allMenuItems;
            if (currentFilter !== 'all') {
                filteredItems = allMenuItems.filter(i => i.category_id == currentFilter);
            }

            const totalItems = filteredItems.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedItems = filteredItems.slice(startIndex, endIndex);

            renderMenuItems(paginatedItems, startIndex);
            renderPagination(totalPages);
        }

        function renderMenuItems(items, startIndex) {
            menuList.innerHTML = '';
            if (items.length === 0) {
                menuList.innerHTML = `<p class="text-center text-muted py-20 text-sm bg-gray-50 rounded-xl">No items found.</p>`;
                return;
            }
            
            items.forEach((item, index) => {
                const globalIndex = startIndex + index + 1;
                const card = document.createElement('div');
                card.className = "menu-item-card";
                card.innerHTML = `
                    <div class="flex gap-4 items-start">
                        <div class="serial-badge">${globalIndex}</div>
                        <div class="flex-1 flex flex-col justify-between min-h-[80px]">
                            <div>
                                <h3 class="text-sm font-semibold text-premium mb-1">${item.name}</h3>
                                <p class="text-xs text-muted leading-relaxed line-clamp-2">${item.desc}</p>
                            </div>
                            <div class="mt-2">
                                <span class="text-sm font-bold text-brand">₹${item.price}</span>
                            </div>
                        </div>
                        <div class="img-zoom-container w-20 h-20 bg-gray-50 flex-shrink-0 self-start">
                            <img src="${item.img}" class="w-full h-full object-cover">
                        </div>
                    </div>`;
                menuList.appendChild(card);
            });
            gsap.fromTo("#menuList > div", { opacity: 0, y: 20 }, { opacity: 1, y: 0, stagger: 0.05, duration: 0.5 });
        }

        function renderPagination(totalPages) {
            paginationContainer.innerHTML = '';
            if (totalPages <= 1) return;
            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.className = `page-btn ${i === currentPage ? 'active' : 'bg-white text-premium hover:bg-gray-50'}`;
                btn.textContent = i;
                btn.addEventListener('click', () => {
                    currentPage = i;
                    updateView();
                    window.scrollTo({ top: menuList.offsetTop - 140, behavior: 'smooth' });
                });
                paginationContainer.appendChild(btn);
            }
        }

        // --- Voice Search Logic ---
        function initVoiceSearch() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (SpeechRecognition) {
                const recognition = new SpeechRecognition();
                recognition.continuous = false;
                recognition.lang = 'en-US'; // Change to 'hi-IN' for Hindi

                recognition.onstart = () => {
                    voiceSearchBtn.classList.add('listening');
                    searchInput.placeholder = "Listening...";
                    searchInput.value = ""; // Clear previous text
                };

                recognition.onend = () => {
                    voiceSearchBtn.classList.remove('listening');
                    searchInput.placeholder = "Search food...";
                };

                recognition.onresult = (event) => {
                    const transcript = event.results[0][0].transcript;
                    searchInput.value = transcript;
                    // Trigger search
                    searchInput.dispatchEvent(new Event('input'));
                };

                recognition.onerror = (event) => {
                    console.error("Speech Error:", event.error);
                    voiceSearchBtn.classList.remove('listening');
                };

                voiceSearchBtn.addEventListener('click', () => {
                    recognition.start();
                });

            } else {
                voiceSearchBtn.style.display = 'none'; // Hide if not supported
                console.warn("Voice Search not supported in this browser.");
            }
        }

        // --- Events & Slider Logic ---
        function initEvents() {
            nextBtn.addEventListener('click', slideNext);
            prevBtn.addEventListener('click', slidePrev);

            searchBtn.addEventListener('click', () => {
                searchOverlay.classList.remove('hidden');
                gsap.fromTo(searchOverlay, { y: -20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.4 });
                setTimeout(() => searchInput.focus(), 100);
            });

            closeSearchBtn.addEventListener('click', () => {
                gsap.to(searchOverlay, { y: -20, opacity: 0, duration: 0.3, onComplete: () => searchOverlay.classList.add('hidden') });
                searchInput.value = '';
                applyFilter(currentFilter);
            });

            searchInput.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                if(!term) { applyFilter(currentFilter); return; }
                const res = allMenuItems.filter(i => i.name.toLowerCase().includes(term));
                currentPage = 1;
                renderMenuItems(res, 0); 
                paginationContainer.innerHTML = ''; 
            });
        }

        function initSlider() {
            const cards = recommendedContainer.querySelectorAll('.pick-card');
            totalCards = cards.length;
            updateSliderButtons();
        }
        function slideNext() {
            const containerWidth = topPicksWrapper.offsetWidth;
            const maxScroll = (totalCards * cardWidth) - containerWidth;
            if (Math.abs(sliderPosition) < maxScroll) {
                sliderPosition -= cardWidth * 1;
                gsap.to(recommendedContainer, { x: sliderPosition, duration: 0.5, ease: "power2.out" });
            }
            updateSliderButtons();
        }
        function slidePrev() {
            if (sliderPosition < 0) {
                sliderPosition += cardWidth * 1;
                gsap.to(recommendedContainer, { x: sliderPosition, duration: 0.5, ease: "power2.out" });
            }
            updateSliderButtons();
        }
        function updateSliderButtons() {
            const containerWidth = topPicksWrapper.offsetWidth;
            const maxScroll = (totalCards * cardWidth) - containerWidth;
            if(sliderPosition >= 0) prevBtn.style.opacity = 0; else prevBtn.style.opacity = 1;
            if (Math.abs(sliderPosition) >= maxScroll - 10) nextBtn.style.opacity = 0; else nextBtn.style.opacity = 1;
        }

        function initSectionAnimations() {
            gsap.to(".fade-up", { opacity: 1, y: 0, duration: 1, stagger: 0.1, ease: "power2.out" });
        }
    </script>
</body>
</html>