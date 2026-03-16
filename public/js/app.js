/* ========================================
   Green Leaf Kitchen - Premium Admin Dashboard
   Advanced GSAP Animations & Interactions
   ======================================== */

// API Base URL
const API_BASE = 'http://127.0.0.1:8000/api';

// State Management
const state = {
  categories: [],
  menuItems: [],
  users: [],
  currentFilter: 'all',
  searchQuery: '',
  loading: false
};

// Demo Data
const demoData = {
  categories: [
    { id: 1, name: 'Starters', order: 1, items_count: 8 },
    { id: 2, name: 'Main Course', order: 2, items_count: 15 },
    { id: 3, name: 'Salads', order: 3, items_count: 6 },
    { id: 4, name: 'Beverages', order: 4, items_count: 12 },
    { id: 5, name: 'Desserts', order: 5, items_count: 9 }
  ],
  menuItems: [
    { id: 1, name: 'Garden Fresh Salad', description: 'Mixed greens with seasonal vegetables', price: 12.99, category_id: 3, category_name: 'Salads', image: null, is_top_selling: true, is_special: false, is_recommended: true },
    { id: 2, name: 'Grilled Chicken Breast', description: 'Herb-marinated chicken with roasted vegetables', price: 18.99, category_id: 2, category_name: 'Main Course', image: null, is_top_selling: true, is_special: true, is_recommended: false },
    { id: 3, name: 'Spring Rolls', description: 'Crispy vegetable spring rolls with dipping sauce', price: 8.99, category_id: 1, category_name: 'Starters', image: null, is_top_selling: false, is_special: false, is_recommended: true },
    { id: 4, name: 'Mango Smoothie', description: 'Fresh mango blended with yogurt', price: 6.99, category_id: 4, category_name: 'Beverages', image: null, is_top_selling: true, is_special: false, is_recommended: false },
    { id: 5, name: 'Chocolate Lava Cake', description: 'Warm chocolate cake with molten center', price: 9.99, category_id: 5, category_name: 'Desserts', image: null, is_top_selling: false, is_special: true, is_recommended: true }
  ],
  users: [
    { id: 1, name: 'John Doe', email: 'john@example.com', email_verified_at: '2024-01-15', created_at: '2024-01-10' },
    { id: 2, name: 'Jane Smith', email: 'jane@example.com', email_verified_at: null, created_at: '2024-02-20' },
    { id: 3, name: 'Mike Johnson', email: 'mike@example.com', email_verified_at: '2024-03-05', created_at: '2024-03-01' },
    { id: 4, name: 'Sarah Wilson', email: 'sarah@example.com', email_verified_at: '2024-03-10', created_at: '2024-03-08' }
  ]
};

// ========================================
// Premium GSAP Animations
// ========================================

// Page entrance animation
function initPageAnimation() {
  const page = document.querySelector('.page');
  if (!page) return;

  const tl = gsap.timeline();
  
  tl.to(page, {
    opacity: 1,
    y: 0,
    duration: 0.4,
    ease: 'power3.out'
  });
  
  // Animate header
  const header = document.querySelector('.header');
  if (header) {
    gsap.fromTo(header,
      { opacity: 0, y: -20 },
      { opacity: 1, y: 0, duration: 0.4, ease: 'power2.out' }
    );
  }
  
  // Animate bottom nav
  const nav = document.querySelector('.bottom-nav');
  if (nav) {
    gsap.fromTo(nav,
      { opacity: 0, y: 20 },
      { opacity: 1, y: 0, duration: 0.4, delay: 0.1, ease: 'power2.out' }
    );
  }
}

// Stats cards with stagger and bounce
function animateStatsCards() {
  const cards = document.querySelectorAll('.stat-card');
  if (!cards.length) return;

  gsap.fromTo(cards,
    { opacity: 0, y: 30, scale: 0.9 },
    { 
      opacity: 1, 
      y: 0, 
      scale: 1, 
      duration: 0.5, 
      stagger: 0.08, 
      ease: 'back.out(1.5)'
    }
  );
}

// List items slide in with stagger
function animateListItems() {
  const items = document.querySelectorAll('.list-item');
  if (!items.length) return;

  gsap.fromTo(items,
    { opacity: 0, x: -20, scale: 0.98 },
    { 
      opacity: 1, 
      x: 0, 
      scale: 1,
      duration: 0.35, 
      stagger: 0.06, 
      ease: 'power2.out'
    }
  );
}

// Quick actions bounce in
function animateQuickActions() {
  const actions = document.querySelectorAll('.quick-action');
  if (!actions.length) return;

  gsap.fromTo(actions,
    { opacity: 0, scale: 0.7 },
    { 
      opacity: 1, 
      scale: 1, 
      duration: 0.4, 
      stagger: 0.05, 
      ease: 'back.out(2)'
    }
  );
}

// Form groups fade in
function animateFormGroups() {
  const groups = document.querySelectorAll('.form-group');
  if (!groups.length) return;

  gsap.fromTo(groups,
    { opacity: 0, y: 15 },
    { 
      opacity: 1, 
      y: 0, 
      duration: 0.35, 
      stagger: 0.06, 
      ease: 'power2.out'
    }
  );
}

// Section headers
function animateSections() {
  const sections = document.querySelectorAll('.section');
  if (!sections.length) return;
  
  sections.forEach((section, index) => {
    gsap.fromTo(section,
      { opacity: 0, y: 20 },
      { 
        opacity: 1, 
        y: 0, 
        duration: 0.4, 
        delay: 0.2 + (index * 0.1),
        ease: 'power2.out'
      }
    );
  });
}

// Button tap feedback
function animateButton(button) {
  gsap.fromTo(button,
    { scale: 1 },
    { 
      scale: 0.95, 
      duration: 0.08, 
      yoyo: true, 
      repeat: 1, 
      ease: 'power2.inOut'
    }
  );
}

// Delete item animation
function animateItemDelete(element, callback) {
  gsap.to(element, {
    opacity: 0,
    x: -100,
    scale: 0.9,
    height: 0,
    marginBottom: 0,
    paddingTop: 0,
    paddingBottom: 0,
    duration: 0.35,
    ease: 'power2.in',
    onComplete: callback
  });
}

// Modal animations
function animateModalOpen(overlay) {
  const modal = overlay.querySelector('.modal');
  
  gsap.fromTo(overlay, 
    { opacity: 0 }, 
    { opacity: 1, duration: 0.25, ease: 'power2.out' }
  );
  
  gsap.fromTo(modal, 
    { y: '100%', scale: 0.95 }, 
    { y: 0, scale: 1, duration: 0.4, ease: 'power3.out' }
  );
}

function animateModalClose(overlay, callback) {
  const modal = overlay.querySelector('.modal');
  
  gsap.to(modal, { 
    y: '100%', 
    scale: 0.95,
    duration: 0.3, 
    ease: 'power2.in' 
  });
  
  gsap.to(overlay, { 
    opacity: 0, 
    duration: 0.25, 
    delay: 0.05,
    onComplete: callback 
  });
}

// Counter animation with easing
function animateCounter(elementId, target) {
  const element = document.getElementById(elementId);
  if (!element) return;
  
  const obj = { value: 0 };
  
  gsap.to(obj, {
    value: target,
    duration: 0.8,
    ease: 'power2.out',
    onUpdate: () => {
      element.textContent = Math.round(obj.value);
    }
  });
}

// Filter pills animation
function animateFilterPills() {
  const pills = document.querySelectorAll('.filter-pill');
  if (!pills.length) return;
  
  gsap.fromTo(pills,
    { opacity: 0, y: 10 },
    { 
      opacity: 1, 
      y: 0, 
      duration: 0.3, 
      stagger: 0.04, 
      ease: 'power2.out'
    }
  );
}

// Search box focus animation
function initSearchAnimation() {
  const searchInput = document.querySelector('.search-input');
  if (!searchInput) return;
  
  searchInput.addEventListener('focus', () => {
    gsap.to(searchInput, {
      scale: 1.01,
      duration: 0.2,
      ease: 'power2.out'
    });
  });
  
  searchInput.addEventListener('blur', () => {
    gsap.to(searchInput, {
      scale: 1,
      duration: 0.2,
      ease: 'power2.out'
    });
  });
}

// Ripple effect on tap
function createRipple(event, element) {
  const ripple = document.createElement('span');
  const rect = element.getBoundingClientRect();
  const size = Math.max(rect.width, rect.height);
  const x = event.clientX - rect.left - size / 2;
  const y = event.clientY - rect.top - size / 2;
  
  ripple.style.cssText = `
    position: absolute;
    width: ${size}px;
    height: ${size}px;
    left: ${x}px;
    top: ${y}px;
    background: rgba(20, 184, 166, 0.2);
    border-radius: 50%;
    pointer-events: none;
    transform: scale(0);
  `;
  
  element.style.position = 'relative';
  element.style.overflow = 'hidden';
  element.appendChild(ripple);
  
  gsap.to(ripple, {
    scale: 2.5,
    opacity: 0,
    duration: 0.5,
    ease: 'power2.out',
    onComplete: () => ripple.remove()
  });
}

// ========================================
// Toast Notifications
// ========================================

function showToast(message, type = 'default') {
  const container = document.querySelector('.toast-container') || createToastContainer();
  
  const toast = document.createElement('div');
  toast.className = `toast ${type === 'success' ? 'toast-success' : type === 'error' ? 'toast-error' : ''}`;
  toast.textContent = message;
  
  container.appendChild(toast);
  
  gsap.to(toast, { 
    opacity: 1, 
    y: 0, 
    duration: 0.35, 
    ease: 'back.out(1.5)' 
  });
  
  setTimeout(() => {
    gsap.to(toast, { 
      opacity: 0, 
      y: -20, 
      scale: 0.9,
      duration: 0.25, 
      ease: 'power2.in',
      onComplete: () => toast.remove() 
    });
  }, 2500);
}

function createToastContainer() {
  const container = document.createElement('div');
  container.className = 'toast-container';
  document.body.appendChild(container);
  return container;
}

// ========================================
// Modal Functions
// ========================================

function openModal(modalId) {
  const overlay = document.getElementById(modalId);
  if (!overlay) return;
  
  overlay.classList.add('active');
  animateModalOpen(overlay);
  document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
  const overlay = document.getElementById(modalId);
  if (!overlay) return;
  
  animateModalClose(overlay, () => {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  });
}

// ========================================
// API Functions
// ========================================

async function fetchData(endpoint) {
  try {
    const response = await fetch(`${API_BASE}${endpoint}`);
    if (!response.ok) throw new Error('Network response was not ok');
    return await response.json();
  } catch (error) {
    return null;
  }
}

async function postData(endpoint, data) {
  try {
    const response = await fetch(`${API_BASE}${endpoint}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(data)
    });
    if (!response.ok) throw new Error('Network response was not ok');
    return await response.json();
  } catch (error) {
    return null;
  }
}

async function putData(endpoint, data) {
  try {
    const response = await fetch(`${API_BASE}${endpoint}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(data)
    });
    if (!response.ok) throw new Error('Network response was not ok');
    return await response.json();
  } catch (error) {
    return null;
  }
}

async function deleteData(endpoint) {
  try {
    const response = await fetch(`${API_BASE}${endpoint}`, {
      method: 'DELETE',
      headers: {
        'Accept': 'application/json'
      }
    });
    if (!response.ok) throw new Error('Network response was not ok');
    return true;
  } catch (error) {
    return false;
  }
}

// ========================================
// Data Loading Functions
// ========================================

async function loadCategories() {
  const data = await fetchData('/categories');
  state.categories = data?.data || demoData.categories;
  return state.categories;
}

async function loadMenuItems() {
  const data = await fetchData('/menu-items');
  state.menuItems = data?.data || demoData.menuItems;
  return state.menuItems;
}

async function loadUsers() {
  const data = await fetchData('/users');
  state.users = data?.data || demoData.users;
  return state.users;
}

// ========================================
// Render Functions
// ========================================

function renderCategoriesList(categories, container) {
  container.innerHTML = categories.map(cat => `
    <div class="list-item" data-id="${cat.id}">
      <div class="drag-handle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/>
          <circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/>
        </svg>
      </div>
      <div class="list-item-content">
        <div class="list-item-title">${escapeHtml(cat.name)}</div>
        <div class="list-item-subtitle">${cat.items_count || 0} items</div>
      </div>
      <div class="list-item-actions">
        <a href="categories-edit.html?id=${cat.id}" class="btn btn-ghost btn-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
          </svg>
        </a>
        <button class="btn btn-ghost btn-icon" onclick="confirmDelete('category', ${cat.id}, '${escapeHtml(cat.name)}')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
          </svg>
        </button>
      </div>
    </div>
  `).join('');
  
  setTimeout(animateListItems, 50);
}

function renderMenuItemsList(items, container) {
  const filteredItems = filterMenuItems(items);
  
  if (filteredItems.length === 0) {
    container.innerHTML = `
      <div class="empty-state">
        <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2M7 2v20M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
        </svg>
        <div class="empty-title">No items found</div>
        <div class="empty-description">Try adjusting your filters or add a new item.</div>
      </div>
    `;
    return;
  }
  
  container.innerHTML = filteredItems.map(item => `
    <div class="list-item" data-id="${item.id}">
      ${item.image 
        ? `<img src="${item.image}" alt="${escapeHtml(item.name)}" class="list-item-image"/>`
        : `<div class="list-item-image" style="display:flex;align-items:center;justify-content:center;color:var(--primary);">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
              <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2M7 2v20M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
            </svg>
          </div>`
      }
      <div class="list-item-content">
        <div class="list-item-title">${escapeHtml(item.name)}</div>
        <div class="list-item-subtitle">
          ${item.category_name || 'Uncategorized'} • $${parseFloat(item.price).toFixed(2)}
        </div>
        <div class="flex gap-1 mt-1">
          ${item.is_top_selling ? '<span class="badge badge-success">Top</span>' : ''}
          ${item.is_special ? '<span class="badge badge-warning">Special</span>' : ''}
          ${item.is_recommended ? '<span class="badge badge-primary">Pick</span>' : ''}
        </div>
      </div>
      <div class="list-item-actions">
        <a href="menu-items-edit.html?id=${item.id}" class="btn btn-ghost btn-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
          </svg>
        </a>
        <button class="btn btn-ghost btn-icon" onclick="confirmDelete('menu-item', ${item.id}, '${escapeHtml(item.name)}')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
          </svg>
        </button>
      </div>
    </div>
  `).join('');
  
  setTimeout(animateListItems, 50);
}

function renderUsersList(users, container) {
  const filteredUsers = users.filter(user => {
    if (!state.searchQuery) return true;
    const query = state.searchQuery.toLowerCase();
    return user.name.toLowerCase().includes(query) || user.email.toLowerCase().includes(query);
  });
  
  if (filteredUsers.length === 0) {
    container.innerHTML = `
      <div class="empty-state">
        <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/>
        </svg>
        <div class="empty-title">No users found</div>
        <div class="empty-description">Try adjusting your search query.</div>
      </div>
    `;
    return;
  }
  
  container.innerHTML = filteredUsers.map(user => `
    <div class="list-item" data-id="${user.id}">
      <div class="avatar">${getInitials(user.name)}</div>
      <div class="list-item-content">
        <div class="list-item-title">${escapeHtml(user.name)}</div>
        <div class="list-item-subtitle">${escapeHtml(user.email)}</div>
        <div class="flex gap-2 mt-1">
          ${user.email_verified_at 
            ? '<span class="badge badge-success">Verified</span>' 
            : '<span class="badge badge-warning">Pending</span>'}
        </div>
      </div>
      <div class="list-item-actions">
        <button class="btn btn-ghost btn-icon" onclick="confirmDelete('user', ${user.id}, '${escapeHtml(user.name)}')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
          </svg>
        </button>
      </div>
    </div>
  `).join('');
  
  setTimeout(animateListItems, 50);
}

// ========================================
// Helper Functions
// ========================================

function filterMenuItems(items) {
  return items.filter(item => {
    if (state.currentFilter !== 'all') {
      if (state.currentFilter === 'top-selling' && !item.is_top_selling) return false;
      if (state.currentFilter === 'special' && !item.is_special) return false;
      if (state.currentFilter === 'recommended' && !item.is_recommended) return false;
      if (!isNaN(state.currentFilter) && item.category_id !== parseInt(state.currentFilter)) return false;
    }
    
    if (state.searchQuery) {
      const query = state.searchQuery.toLowerCase();
      return item.name.toLowerCase().includes(query) || 
             (item.description && item.description.toLowerCase().includes(query));
    }
    
    return true;
  });
}

function escapeHtml(text) {
  const div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}

function getInitials(name) {
  return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
}

function formatDate(dateString) {
  if (!dateString) return 'N/A';
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
}

function getUrlParam(param) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param);
}

// ========================================
// Delete Confirmation
// ========================================

let deleteTarget = { type: null, id: null, name: null };

function confirmDelete(type, id, name) {
  deleteTarget = { type, id, name };
  
  const modal = document.getElementById('delete-modal');
  if (modal) {
    modal.querySelector('.modal-description').textContent = 
      `Are you sure you want to delete "${name}"? This action cannot be undone.`;
    openModal('delete-modal');
  }
}

async function executeDelete() {
  if (!deleteTarget.type || !deleteTarget.id) return;
  
  const endpoints = {
    'category': '/categories',
    'menu-item': '/menu-items',
    'user': '/users'
  };
  
  const endpoint = endpoints[deleteTarget.type];
  if (!endpoint) return;
  
  const element = document.querySelector(`[data-id="${deleteTarget.id}"]`);
  
  await deleteData(`${endpoint}/${deleteTarget.id}`);
  
  if (element) {
    animateItemDelete(element, () => {
      element.remove();
      
      if (deleteTarget.type === 'category') {
        state.categories = state.categories.filter(c => c.id !== deleteTarget.id);
      } else if (deleteTarget.type === 'menu-item') {
        state.menuItems = state.menuItems.filter(m => m.id !== deleteTarget.id);
      } else if (deleteTarget.type === 'user') {
        state.users = state.users.filter(u => u.id !== deleteTarget.id);
      }
    });
  }
  
  closeModal('delete-modal');
  showToast(`${deleteTarget.name} deleted`, 'success');
  
  deleteTarget = { type: null, id: null, name: null };
}

// ========================================
// Switch Toggle
// ========================================

function initSwitches() {
  document.querySelectorAll('.switch').forEach(switchEl => {
    switchEl.addEventListener('click', function() {
      this.classList.toggle('active');
      animateButton(this);
    });
  });
}

// ========================================
// Image Upload Preview
// ========================================

function initImageUpload() {
  const uploads = document.querySelectorAll('.image-upload input[type="file"]');
  
  uploads.forEach(input => {
    input.addEventListener('change', function() {
      const file = this.files[0];
      if (!file) return;
      
      const reader = new FileReader();
      const container = this.closest('.image-upload');
      
      reader.onload = function(e) {
        let preview = container.querySelector('.image-upload-preview');
        
        if (!preview) {
          preview = document.createElement('img');
          preview.className = 'image-upload-preview';
          container.appendChild(preview);
        }
        
        preview.src = e.target.result;
        
        gsap.fromTo(preview, 
          { opacity: 0, scale: 1.05 },
          { opacity: 1, scale: 1, duration: 0.3, ease: 'power2.out' }
        );
      };
      
      reader.readAsDataURL(file);
    });
  });
}

// ========================================
// Form Handling
// ========================================

async function handleCategorySubmit(e) {
  e.preventDefault();
  
  const form = e.target;
  const formData = new FormData(form);
  const data = {
    name: formData.get('name'),
    order: parseInt(formData.get('order')) || 1
  };
  
  const id = getUrlParam('id');
  const isEdit = !!id;
  
  let result;
  if (isEdit) {
    result = await putData(`/categories/${id}`, data);
  } else {
    result = await postData('/categories', data);
  }
  
  showToast(`Category ${isEdit ? 'updated' : 'created'} successfully`, 'success');
  
  setTimeout(() => {
    window.location.href = 'categories.html';
  }, 500);
}

async function handleMenuItemSubmit(e) {
  e.preventDefault();
  
  const form = e.target;
  const formData = new FormData(form);
  
  const data = {
    name: formData.get('name'),
    description: formData.get('description'),
    price: parseFloat(formData.get('price')) || 0,
    category_id: parseInt(formData.get('category_id')) || null,
    is_top_selling: document.getElementById('is_top_selling')?.classList.contains('active') || false,
    is_special: document.getElementById('is_special')?.classList.contains('active') || false,
    is_recommended: document.getElementById('is_recommended')?.classList.contains('active') || false
  };
  
  const id = getUrlParam('id');
  const isEdit = !!id;
  
  let result;
  if (isEdit) {
    result = await putData(`/menu-items/${id}`, data);
  } else {
    result = await postData('/menu-items', data);
  }
  
  showToast(`Menu item ${isEdit ? 'updated' : 'created'} successfully`, 'success');
  
  setTimeout(() => {
    window.location.href = 'menu-items.html';
  }, 500);
}

// ========================================
// Filter Functions
// ========================================

function setFilter(filter) {
  state.currentFilter = filter;
  
  document.querySelectorAll('.filter-pill').forEach(pill => {
    pill.classList.toggle('active', pill.dataset.filter === filter);
  });
  
  const container = document.getElementById('items-list');
  if (container) {
    renderMenuItemsList(state.menuItems, container);
  }
}

function handleSearch(query) {
  state.searchQuery = query;
  
  const itemsContainer = document.getElementById('items-list');
  const usersContainer = document.getElementById('users-list');
  
  if (itemsContainer) {
    renderMenuItemsList(state.menuItems, itemsContainer);
  }
  
  if (usersContainer) {
    renderUsersList(state.users, usersContainer);
  }
}

// ========================================
// Debounce
// ========================================

function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// ========================================
// Initialize
// ========================================

document.addEventListener('DOMContentLoaded', () => {
  initPageAnimation();
  initSwitches();
  initImageUpload();
  initSearchAnimation();
  
  // Init search with debounce
  const searchInput = document.querySelector('.search-input');
  if (searchInput) {
    searchInput.addEventListener('input', debounce((e) => {
      handleSearch(e.target.value);
    }, 250));
  }
  
  // Init filter pills
  document.querySelectorAll('.filter-pill').forEach(pill => {
    pill.addEventListener('click', () => {
      setFilter(pill.dataset.filter);
    });
  });
  
  // Add tap feedback to buttons
  document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      animateButton(btn);
    });
  });
  
  // Add tap feedback to list items
  document.querySelectorAll('.list-item').forEach(item => {
    item.addEventListener('touchstart', (e) => {
      createRipple(e, item);
    }, { passive: true });
  });
});
