// Projects Page JavaScript
// Modern interactive animations and effects

document.addEventListener('DOMContentLoaded', function() {
    // Initialize scroll animations
    initScrollAnimations();
    
    // Initialize hover effects
    initHoverEffects();
    
    // Initialize parallax effects
    initParallaxEffects();
    
    // Initialize smooth scrolling
    initSmoothScrolling();
    
    // Initialize canvas animation
    initCanvasAnimation();
});

// Canvas Animation Initialization
function initCanvasAnimation() {
    const canvas = document.getElementById("bannerCanvas");
    
    if (!canvas) {
        console.warn("Canvas element #bannerCanvas not found");
        return;
    }

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = document.body.scrollHeight;
    }

    resizeCanvas();

    window.addEventListener("resize", resizeCanvas);
    window.addEventListener("scroll", resizeCanvas);

    // Check if FluidSimulation library exists
    if (typeof FluidSimulation !== "undefined") {
        try {
            new FluidSimulation(canvas);
        } catch (error) {
            console.error("Error initializing FluidSimulation:", error);
            // Fallback to simple canvas animation
            initSimpleCanvasAnimation(canvas);
        }
    } else {
        console.warn("FluidSimulation library not found, using simple canvas animation");
        initSimpleCanvasAnimation(canvas);
    }
}

// Simple Canvas Animation Fallback
function initSimpleCanvasAnimation(canvas) {
    const ctx = canvas.getContext('2d');
    const particles = [];
    const colors = ['#DAF301', '#ffffff', '#888888'];
    
    // Create particles
    for (let i = 0; i < 50; i++) {
        particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            size: Math.random() * 3 + 1,
            speedX: (Math.random() - 0.5) * 0.5,
            speedY: (Math.random() - 0.5) * 0.5,
            color: colors[Math.floor(Math.random() * colors.length)]
        });
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Draw connections
        ctx.strokeStyle = 'rgba(218, 243, 1, 0.1)';
        ctx.lineWidth = 1;
        
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < 100) {
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }
        
        // Update and draw particles
        particles.forEach(particle => {
            particle.x += particle.speedX;
            particle.y += particle.speedY;
            
            // Bounce off edges
            if (particle.x < 0 || particle.x > canvas.width) particle.speedX *= -1;
            if (particle.y < 0 || particle.y > canvas.height) particle.speedY *= -1;
            
            ctx.fillStyle = particle.color;
            ctx.beginPath();
            ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            ctx.fill();
        });
        
        requestAnimationFrame(animate);
    }
    
    animate();
}

// Scroll Animation System
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = entry.target.getAttribute('data-delay') || 0;
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, delay);
            }
        });
    }, observerOptions);

    // Observe all project cards
    const projectCards = document.querySelectorAll('.project-card');
    projectCards.forEach(card => {
        observer.observe(card);
    });
}

// Enhanced Hover Effects
function initHoverEffects() {
    const projectCards = document.querySelectorAll('.project-card');
    
    projectCards.forEach(card => {
        const image = card.querySelector('.project-image');
        const overlay = card.querySelector('.project-overlay');
        const title = card.querySelector('.project-title');
        const link = card.querySelector('.project-link');
        
        // Mouse move parallax effect
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            card.style.transform = `translateY(-10px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            image.style.transform = `translate(${(x - centerX) * 0.05}px, ${(y - centerY) * 0.05}px) scale(1.05)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(-10px) rotateX(0) rotateY(0)';
            image.style.transform = 'scale(1.05)';
        });
        
        // Enhanced overlay animation
        card.addEventListener('mouseenter', () => {
            overlay.style.opacity = '1';
            title.style.transform = 'translateY(-5px)';
            link.style.transform = 'translateX(5px)';
        });
        
        card.addEventListener('mouseleave', () => {
            overlay.style.opacity = '0';
            title.style.transform = 'translateY(0)';
            link.style.transform = 'translateX(0)';
        });
    });
}

// Parallax Scrolling Effects
function initParallaxEffects() {
    const hero = document.querySelector('.projects-hero');
    const heroContent = document.querySelector('.hero-content');
    
    if (hero && heroContent) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            hero.style.transform = `translateY(${rate}px)`;
            heroContent.style.transform = `translateY(${rate * 0.5}px)`;
        });
    }
}

// Smooth Scrolling for CTA Button
function initSmoothScrolling() {
    const ctaButton = document.querySelector('.cta-button');
    
    if (ctaButton) {
        ctaButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            const contactLink = this.getAttribute('href');
            if (contactLink && contactLink.startsWith('#')) {
                const target = document.querySelector(contactLink);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            } else {
                window.location.href = contactLink;
            }
        });
    }
}

// Enhanced Scroll Indicator Animation
function initScrollIndicator() {
    const scrollIndicator = document.querySelector('.hero-scroll-indicator');
    
    if (scrollIndicator) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const maxScroll = document.body.scrollHeight - window.innerHeight;
            const scrollPercent = (scrolled / maxScroll) * 100;
            
            // Fade out scroll indicator as user scrolls
            scrollIndicator.style.opacity = 1 - (scrollPercent / 100);
            scrollIndicator.style.transform = `translateX(-50%) translateY(${scrollPercent}px)`;
        });
    }
}

// Performance-optimized resize handler
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        // Re-initialize animations on resize
        initScrollAnimations();
        initHoverEffects();
    }, 250);
});

// Lazy loading for images (performance optimization)
function initLazyLoading() {
    const images = document.querySelectorAll('.project-image ');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => {
            imageObserver.observe(img);
        });
    }
}

// Initialize lazy loading
initLazyLoading();

// Add some modern CSS-in-JS animations
(function() {
    // Add custom properties for dynamic theming
    const root = document.documentElement;
    root.style.setProperty('--primary-color', '#DAF301');
    root.style.setProperty('--text-color', '#ffffff');
    root.style.setProperty('--bg-color', '#000000');
    
    // Add subtle background animation
    const style = document.createElement('style');
    style.textContent = `
        .projects_page::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(218, 243, 1, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
            animation: float 20s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    `;
    document.head.appendChild(style);
})();








